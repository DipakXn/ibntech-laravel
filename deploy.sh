#!/bin/bash
set -euo pipefail

# cPanel sometimes runs without HOME set
if [ -z "${HOME:-}" ]; then
  export HOME="$(cd ~ && pwd)"
fi

SOURCE_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

case "${HOME:-}" in
  /home/devtech)
    CONFIG_FILE="/home/devtech/deploy-configs/staging/deploy-config.sh"
    ;;
  /home/ibntech)
    CONFIG_FILE="/home/ibntech/deploy-configs/production/deploy-config.sh"
    ;;
  *)
    echo "Refusing to deploy: unknown HOME '${HOME:-}'." >&2
    exit 1
    ;;
esac

if [ ! -r "$CONFIG_FILE" ]; then
  echo "Cannot read $CONFIG_FILE (permissions?)" >&2
  exit 1
fi

# shellcheck disable=SC1090
source "$CONFIG_FILE"

: "${DEPLOY_ENV:?}"
: "${APP_DIR:?}"
: "${PUBLIC_DIR:?}"
: "${PHP_BIN:?}"
: "${COMPOSER_BIN:?}"
: "${BACKUP_DIR:?}"
: "${LOG_DIR:?}"
: "${LOCK_FILE:?}"

if [ "$PHP_BIN" = "TO_VERIFY_ON_SERVER" ] || [ "$COMPOSER_BIN" = "TO_VERIFY_ON_SERVER" ]; then
  echo "Set PHP_BIN and COMPOSER_BIN in $CONFIG_FILE before deploying." >&2
  exit 1
fi

if [ "$HOME" = "/home/devtech" ] && [ "$APP_DIR" != "/home/devtech/ibntech-core" ]; then
  echo "Staging config APP_DIR is not /home/devtech/ibntech-core" >&2
  exit 1
fi

if [ "$HOME" = "/home/ibntech" ] && [ "$APP_DIR" != "/home/ibntech/ibntech-core" ]; then
  echo "Production config APP_DIR is not /home/ibntech/ibntech-core" >&2
  exit 1
fi

if [ "$HOME" = "/home/devtech" ] && [ "$PUBLIC_DIR" != "/home/devtech/public_html" ]; then
  echo "Staging config PUBLIC_DIR is not /home/devtech/public_html" >&2
  exit 1
fi

if [ "$HOME" = "/home/ibntech" ] && [ "$PUBLIC_DIR" != "/home/ibntech/public_html" ]; then
  echo "Production config PUBLIC_DIR is not /home/ibntech/public_html" >&2
  exit 1
fi

if [ "$APP_DIR" = "$PUBLIC_DIR" ] || [ "$APP_DIR" = "$SOURCE_DIR" ]; then
  echo "APP_DIR must be separate from PUBLIC_DIR and from the Git clone." >&2
  exit 1
fi

if [[ "$APP_DIR" == *public_html* ]] || [[ "$PUBLIC_DIR" == *ibntech-core* ]]; then
  echo "Refusing to swap the core directory and the document root." >&2
  exit 1
fi

for required in "$APP_DIR/artisan" "$APP_DIR/.env" "$PUBLIC_DIR/index.php" "$PUBLIC_DIR/uploads"; do
  if [ ! -e "$required" ]; then
    echo "Missing required path: $required" >&2
    exit 1
  fi
done

if [ ! -x "$PHP_BIN" ]; then
  echo "PHP_BIN is not executable: $PHP_BIN" >&2
  exit 1
fi

mkdir -p "$BACKUP_DIR" "$LOG_DIR" "$(dirname "$LOCK_FILE")"

exec 9>"$LOCK_FILE"
if ! flock -n 9; then
  echo "Another deployment holds $LOCK_FILE" >&2
  exit 1
fi

LOG_FILE="$LOG_DIR/deploy-$(date +%Y%m%d-%H%M%S).log"
exec > >(tee -a "$LOG_FILE") 2>&1

echo "Deploy started: env=$DEPLOY_ENV host=${SITE_HOST:-unknown} commit=$(git -C "$SOURCE_DIR" rev-parse HEAD)"

BACKUP_ARCHIVE="$BACKUP_DIR/release-$(date +%Y%m%d-%H%M%S).tar.gz"
ROLLBACK_READY=0

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
  if [ -f "$APP_DIR/artisan" ]; then
    (cd "$APP_DIR" && "$PHP_BIN" artisan up) 2>&1 | tee -a "$LOG_FILE" || true
  fi
  echo "Deploy finished with status $status"
  exit "$status"
}
trap cleanup EXIT

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
  --exclude '.htaccess' \
  --exclude 'public/.htaccess' \
  --exclude '.git/' \
  --exclude 'node_modules/' \
  --exclude 'storage/' \
  --exclude 'bootstrap/cache/*.php' \
  --exclude 'public/hot' \
  --exclude 'public/uploads/' \
  --exclude 'deploy-config.sh' \
  "$SOURCE_DIR/" "$APP_DIR/"

cd "$APP_DIR"
"$PHP_BIN" "$COMPOSER_BIN" install \
  --no-dev \
  --optimize-autoloader \
  --no-interaction \
  --no-scripts

# Compiled assets. --delete is limited to build/, never to public_html or uploads.
mkdir -p "$APP_DIR/public/build" "$PUBLIC_DIR/build"
rsync -a --delete "$SOURCE_DIR/public/build/" "$APP_DIR/public/build/"
rsync -a --delete "$SOURCE_DIR/public/build/" "$PUBLIC_DIR/build/"

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

# Git-managed public entry points. .htaccess and robots.txt are not in this list.
for file in index.php bootstrap-path.php favicon.ico; do
  cp -a "$APP_DIR/public/$file" "$PUBLIC_DIR/$file"
done

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

echo "Code deployment complete. Database migrations were not run."
