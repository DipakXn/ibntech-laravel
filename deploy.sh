#!/bin/bash
set -euo pipefail

# cPanel sometimes runs without HOME set
if [ -z "${HOME:-}" ]; then
  if ! HOME="$(cd ~ && pwd)"; then
    printf '%s\n' "Refusing to deploy: HOME is unset and ~ could not be resolved." >&2
    exit 1
  fi
  export HOME
fi

LOCK_WAIT_SECONDS=30
LOG_FILE=""
BACKUP_ARCHIVE=""
ROLLBACK_READY=0

die() {
  local msg="$1"
  if [ -n "${LOG_FILE:-}" ]; then
    printf '%s\n' "$msg" >> "$LOG_FILE" || true
  fi
  printf '%s\n' "$msg" >&2
  exit 1
}

open_deploy_log() {
  local dir="${1%/}"
  mkdir -p "$dir" || die "Cannot create log directory $dir"
  LOG_FILE="$dir/deploy-$(date +%Y%m%d-%H%M%S).log"
  : > "$LOG_FILE" || die "Cannot write $LOG_FILE"
  exec > >(tee -a "$LOG_FILE") 2>&1
  echo "Logging to $LOG_FILE"
}

SOURCE_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)" || die "Cannot resolve deploy.sh directory."

case "${HOME:-}" in
  /home/devtech)
    CONFIG_FILE="/home/devtech/deploy-configs/staging/deploy-config.sh"
    ;;
  /home/ibntech)
    CONFIG_FILE="/home/ibntech/deploy-configs/production/deploy-config.sh"
    ;;
  *)
    if [ -n "${HOME:-}" ] && mkdir -p "${HOME}/deploy-logs" 2>/dev/null; then
      open_deploy_log "${HOME}/deploy-logs"
    fi
    die "Refusing to deploy: unknown HOME '${HOME:-}'."
    ;;
esac

# Log before config, path checks, and the lock. Failures above this line
# have no account log directory yet.
open_deploy_log "${HOME}/deploy-logs"

if [ ! -r "$CONFIG_FILE" ]; then
  die "Cannot read $CONFIG_FILE (permissions?)"
fi

# The config file lives only on the server and may have been edited on
# Windows. Strip any CRLF line endings so bash does not see a literal \r
# at the end of every line. Only do this if the file is writable; if not,
# log a warning and continue (the source call will still work if the file
# happens to be LF already).
if [ -w "$CONFIG_FILE" ]; then
  if ! /bin/sed -i 's/\r$//' "$CONFIG_FILE"; then
    echo "WARNING: could not strip CRLF from $CONFIG_FILE (sed failed). Continuing anyway."
  fi
else
  echo "WARNING: $CONFIG_FILE is not writable; CRLF stripping skipped."
fi

# shellcheck disable=SC1090
source "$CONFIG_FILE" || die "Failed to read $CONFIG_FILE"

for required_var in DEPLOY_ENV APP_DIR PUBLIC_DIR PHP_BIN COMPOSER_BIN BACKUP_DIR LOG_DIR LOCK_FILE; do
  if [ -z "${!required_var:-}" ]; then
    die "Missing ${required_var} in $CONFIG_FILE"
  fi
done

if [ "${LOG_DIR%/}" != "${HOME}/deploy-logs" ]; then
  echo "LOG_DIR is ${LOG_DIR%/}; switching to that log directory."
  open_deploy_log "$LOG_DIR"
fi

if [ "$PHP_BIN" = "TO_VERIFY_ON_SERVER" ] || [ "$COMPOSER_BIN" = "TO_VERIFY_ON_SERVER" ]; then
  die "Set PHP_BIN and COMPOSER_BIN in $CONFIG_FILE before deploying."
fi

if [ "$HOME" = "/home/devtech" ] && [ "$APP_DIR" != "/home/devtech/ibntech-core" ]; then
  die "Staging config APP_DIR is not /home/devtech/ibntech-core"
fi

if [ "$HOME" = "/home/ibntech" ] && [ "$APP_DIR" != "/home/ibntech/ibntech-core" ]; then
  die "Production config APP_DIR is not /home/ibntech/ibntech-core"
fi

if [ "$HOME" = "/home/devtech" ] && [ "$PUBLIC_DIR" != "/home/devtech/public_html" ]; then
  die "Staging config PUBLIC_DIR is not /home/devtech/public_html"
fi

if [ "$HOME" = "/home/ibntech" ] && [ "$PUBLIC_DIR" != "/home/ibntech/public_html" ]; then
  die "Production config PUBLIC_DIR is not /home/ibntech/public_html"
fi

if [ "$APP_DIR" = "$PUBLIC_DIR" ] || [ "$APP_DIR" = "$SOURCE_DIR" ]; then
  die "APP_DIR must be separate from PUBLIC_DIR and from the Git clone."
fi

if [[ "$APP_DIR" == *public_html* ]] || [[ "$PUBLIC_DIR" == *ibntech-core* ]]; then
  die "Refusing to swap the core directory and the document root."
fi

for required in "$APP_DIR/artisan" "$APP_DIR/.env" "$PUBLIC_DIR/index.php" "$PUBLIC_DIR/uploads"; do
  if [ ! -e "$required" ]; then
    die "Missing required path: $required"
  fi
done

if [ ! -x "$PHP_BIN" ]; then
  die "PHP_BIN is not executable: $PHP_BIN"
fi

mkdir -p "$BACKUP_DIR" "$(dirname "$LOCK_FILE")" || die "Cannot create backup or lock directories."

backup_release() {
  local item
  local -a paths=()
  # Do not archive .env, .htaccess, or storage/. A later restore must not write them.
  for item in \
    "$APP_DIR" \
    "$PUBLIC_DIR/build" \
    "$PUBLIC_DIR/css" \
    "$PUBLIC_DIR/js" \
    "$PUBLIC_DIR/fonts" \
    "$PUBLIC_DIR/images" \
    "$PUBLIC_DIR/favicon_io" \
    "$PUBLIC_DIR/index.php" \
    "$PUBLIC_DIR/bootstrap-path.php" \
    "$PUBLIC_DIR/favicon.ico"
  do
    if [ -e "$item" ]; then
      paths+=("${item#/}")
    fi
  done

  tar -C / -czf "$BACKUP_ARCHIVE" \
    --exclude="${APP_DIR#/}/.env" \
    --exclude="${APP_DIR#/}/.env.*" \
    --exclude="${APP_DIR#/}/public/.htaccess" \
    --exclude="${APP_DIR#/}/node_modules" \
    --exclude="${APP_DIR#/}/storage" \
    --exclude="${APP_DIR#/}/storage/*" \
    --exclude="${PUBLIC_DIR#/}/.htaccess" \
    --exclude="${PUBLIC_DIR#/}/uploads" \
    "${paths[@]}"
  ROLLBACK_READY=1
  echo "Backup written: $BACKUP_ARCHIVE"
}

rollback() {
  if [ "$ROLLBACK_READY" -ne 1 ] || [ ! -f "$BACKUP_ARCHIVE" ]; then
    echo "No backup available to restore."
    return 1
  fi
  echo "Restoring $BACKUP_ARCHIVE"
  # storage/ is not in the archive. Exclude it on extract as well so a
  # rollback cannot overwrite or restore it.
  tar -C / -xzf "$BACKUP_ARCHIVE" \
    --exclude="${APP_DIR#/}/storage" \
    --exclude="${APP_DIR#/}/storage/*"
  if [ -f "$APP_DIR/artisan" ]; then
    (cd "$APP_DIR" && "$PHP_BIN" artisan optimize:clear) || true
  fi
}

cleanup() {
  local status=$?
  if [ "$status" -ne 0 ]; then
    rollback 2>&1 | tee -a "$LOG_FILE" || true
  fi
  if [ -f "${APP_DIR:-}/artisan" ]; then
    (cd "$APP_DIR" && "$PHP_BIN" artisan up) 2>&1 | tee -a "$LOG_FILE" || true
  fi
  echo "Deploy finished with status $status"
  exit "$status"
}
trap cleanup EXIT

acquire_deploy_lock() {
  local lock_pid="" kill_msg="" kill_rc=0

  if [ -f "$LOCK_FILE" ]; then
    lock_pid="$(head -n 1 "$LOCK_FILE" 2>/dev/null || true)"
    lock_pid="${lock_pid//$'\r'/}"
    lock_pid="${lock_pid#"${lock_pid%%[![:space:]]*}"}"
    lock_pid="${lock_pid%"${lock_pid##*[![:space:]]}"}"

    if [ -z "$lock_pid" ]; then
      echo "Lock file $LOCK_FILE has no PID. Refusing to delete it."
    elif [[ ! "$lock_pid" =~ ^[0-9]+$ ]]; then
      echo "Lock file $LOCK_FILE PID is not numeric. Refusing to delete it."
    else
      set +e
      kill_msg="$(kill -0 "$lock_pid" 2>&1)"
      kill_rc=$?
      set -e
      if [ "$kill_rc" -eq 0 ]; then
        echo "Deploy lock PID $lock_pid is still running. Not deleting $LOCK_FILE."
      elif printf '%s\n' "$kill_msg" | grep -qi 'no such process'; then
        echo "WARNING: stale deploy lock. PID $lock_pid is not running. Removing $LOCK_FILE"
        rm -f -- "$LOCK_FILE" || die "Could not remove stale lock $LOCK_FILE"
      else
        echo "WARNING: PID check for $lock_pid was uncertain (${kill_msg:-exit $kill_rc}). Refusing to delete $LOCK_FILE."
      fi
    fi
  fi

  touch "$LOCK_FILE" || die "Cannot create $LOCK_FILE"
  # Do not truncate before flock. A live holder still owns this inode.
  exec 9<>"$LOCK_FILE" || die "Cannot open $LOCK_FILE"

  echo "Waiting up to ${LOCK_WAIT_SECONDS}s for $LOCK_FILE"
  if ! flock -w "$LOCK_WAIT_SECONDS" 9; then
    die "Another deployment still holds $LOCK_FILE after ${LOCK_WAIT_SECONDS}s. Exiting."
  fi

  printf '%s\n' "$$" > "$LOCK_FILE" || die "Could not record PID in $LOCK_FILE"
  echo "Lock acquired by PID $$ on $LOCK_FILE"
}

acquire_deploy_lock

echo "Deploy started: env=$DEPLOY_ENV host=${SITE_HOST:-unknown} commit=$(git -C "$SOURCE_DIR" rev-parse HEAD)"

BACKUP_ARCHIVE="$BACKUP_DIR/release-$(date +%Y%m%d-%H%M%S).tar.gz"

backup_release

cd "$APP_DIR"
if [ -n "${MAINTENANCE_SECRET:-}" ]; then
  "$PHP_BIN" artisan down --retry=60 --secret="$MAINTENANCE_SECRET"
else
  "$PHP_BIN" artisan down --retry=60
fi

# --delete removes stale application files. It does not delete excluded
# paths unless --delete-excluded is added. Do not add --delete-excluded:
# that would remove .env, .htaccess, storage/, uploads, and public/hot.
# Never point --delete at public_html.
rsync -a --delete \
  --exclude '.env' \
  --exclude '.env.*' \
  --exclude '.git/' \
  --exclude '.htaccess' \
  --exclude 'public/.htaccess' \
  --exclude 'public/hot' \
  --exclude 'public/uploads/' \
  --exclude 'public/robots.txt' \
  --exclude 'storage/' \
  --exclude 'bootstrap/cache/*.php' \
  --exclude 'node_modules/' \
  --exclude 'vendor/' \
  --exclude 'deploy-config.sh' \
  --exclude '.idea/' \
  --exclude '.vscode/' \
  "$SOURCE_DIR/" "$APP_DIR/"

cd "$APP_DIR"
"$PHP_BIN" "$COMPOSER_BIN" install \
  --no-dev \
  --optimize-autoloader \
  --no-interaction \
  --no-scripts

echo "Copying compiled website files. Uploads and Apache files are left alone."

# --delete is limited to these two build directories, never public_html or uploads.
mkdir -p "$APP_DIR/public/build" "$PUBLIC_DIR/build"
rsync -a --delete "$SOURCE_DIR/public/build/" "$APP_DIR/public/build/"
rsync -a --delete "$SOURCE_DIR/public/build/" "$PUBLIC_DIR/build/"

for dir in css js fonts images favicon_io; do
  if [ -d "$SOURCE_DIR/public/$dir" ]; then
    mkdir -p "$APP_DIR/public/$dir" "$PUBLIC_DIR/$dir"
    rsync -a "$SOURCE_DIR/public/$dir/" "$APP_DIR/public/$dir/"
    rsync -a "$SOURCE_DIR/public/$dir/" "$PUBLIC_DIR/$dir/"
  fi
done

# favicon.ico is code. robots.txt is CMS-owned at runtime.
# Deploying robots.txt would overwrite CMS edits on every release.
for file in favicon.ico; do
  if [ -f "$SOURCE_DIR/public/$file" ]; then
    cp -f "$SOURCE_DIR/public/$file" "$APP_DIR/public/$file"
    cp -f "$SOURCE_DIR/public/$file" "$PUBLIC_DIR/$file"
  fi
done

for file in "$SOURCE_DIR/public"/favicon*; do
  [ -f "$file" ] || continue
  base="$(basename "$file")"
  if [ "$base" = "favicon.ico" ]; then
    continue
  fi
  cp -f "$file" "$APP_DIR/public/$base"
  cp -f "$file" "$PUBLIC_DIR/$base"
done

for file in index.php bootstrap-path.php; do
  if [ -f "$SOURCE_DIR/public/$file" ]; then
    cp -f "$SOURCE_DIR/public/$file" "$APP_DIR/public/$file"
    cp -f "$SOURCE_DIR/public/$file" "$PUBLIC_DIR/$file"
  fi
done

echo "Web assets published to $APP_DIR/public and $PUBLIC_DIR."

publish_static_public() {
  local dir
  for dir in css js fonts images favicon_io; do
    if [ -d "$APP_DIR/public/$dir" ]; then
      mkdir -p "$PUBLIC_DIR/$dir"
      rsync -a "$APP_DIR/public/$dir/" "$PUBLIC_DIR/$dir/"
    fi
  done
}

publish_static_public

cd "$APP_DIR"
# Drop generated caches before Artisan boots. A Windows config.php can
# prevent artisan from starting, so do not rely on optimize:clear alone.
find "$APP_DIR/bootstrap/cache" -type f ! -name '.gitignore' -delete
find "$APP_DIR/storage/framework/views" -type f ! -name '.gitignore' -delete
find "$APP_DIR/storage/framework/cache/data" -type f ! -name '.gitignore' -delete
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan filament:upgrade
publish_static_public
"$PHP_BIN" artisan cms:optimize
"$PHP_BIN" artisan filament:optimize
"$PHP_BIN" artisan queue:restart

# --- Post-deploy integrity check ---
echo "Verifying protected paths were not touched."

integrity_fail=0
for protected in \
  "$APP_DIR/.env" \
  "$APP_DIR/storage" \
  "$APP_DIR/storage/app" \
  "$APP_DIR/storage/logs" \
  "$PUBLIC_DIR/uploads" \
  "$PUBLIC_DIR/.htaccess"
do
  if [ ! -e "$protected" ]; then
    echo "INTEGRITY FAILURE: missing after deploy: $protected"
    integrity_fail=1
  fi
done

if [ -d "$PUBLIC_DIR/uploads" ]; then
  count=$(find "$PUBLIC_DIR/uploads" -mindepth 1 -maxdepth 1 | wc -l)
  if [ "$count" -eq 0 ]; then
    echo "WARNING: $PUBLIC_DIR/uploads is empty after deploy."
  fi
fi

if [ "$integrity_fail" -ne 0 ]; then
  echo "Post-deploy integrity check failed. See log for details."
  exit 1
fi

echo "Protected paths verified intact."

echo "Code deployment complete. Database migrations were not run."
