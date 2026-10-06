# IBN Technologies — GitHub and cPanel Deployment Guide

Deployment runbook for the IBN Technologies Laravel 12 website.

Local development is Windows with XAMPP. Staging and production are Linux cPanel accounts. Application code and the public document root stay in separate directories. This guide does not change that layout.

Repository facts below were read from this project on 6 October 2026. Anything that cannot be confirmed from the repository is marked **TO VERIFY ON SERVER**.

Related documents:

- `deploy-config.sh.example` — committed template for the server-only config
- `docs/PRODUCTION_DEPLOYMENT.md` — earlier cPanel notes (some paths in that file predate the confirmed layout in this guide)
- `docs/media-uploads-deployment.md` — media disk background

---

## Permanent deployment rules

These rules override any later sentence that would copy or replace the same files.

### `.env` is permanent and server-only

Git deployment must never copy, overwrite, delete, or sync `.env`.

| Environment | File |
|---|---|
| Staging | `/home/devtech/ibntech-core/.env` |
| Production | `/home/ibntech/ibntech-core/.env` |

The same ban applies to `.env.*` on the server (`.env.backup`, `.env.production`, and any other sibling). Do not copy either environment's file onto the other. Do not print the file in logs.

`.gitignore` contains `.env` and `.env.*`, and `!.env.example` keeps `.env.example` tracked. Server `.env` and `.env.*` files are permanently server-only. Deployment must never copy, overwrite, delete, or synchronize them. Taking `.env` out of the Git index is not a deployment step. The index still lists `.env` until that removal is committed; the ignore rules alone do not drop a file that is already indexed.

### `.htaccess` is permanent and server-only

The live files differ between staging and production. Git deployment must never copy, overwrite, delete, or sync them.

| Environment | File |
|---|---|
| Staging | `/home/devtech/public_html/.htaccess` |
| Production | `/home/ibntech/public_html/.htaccess` |

There is no preserve-marker and no "copy when the files match" path. Exclude `.htaccess` from every sync, including `public/.htaccess` inside the core tree. Do not copy the staging file onto production, or the production file onto staging.

### Files deployment must not touch

```text
.env
.env.*
public/.htaccess
storage/
public/uploads/
public/hot
bootstrap/cache/*.php
```

`rsync --delete` must never target `public_html/` or `public_html/uploads/`. `--delete` is allowed only for the `build/` directory.

Do not add `--delete-excluded`. Without that flag, excluded files stay on the destination. With it, a deploy could delete `.env`, `.htaccess`, `storage/`, or `uploads/`.

### Files that still deploy from Git

- Application code into `ibntech-core`
- `public/index.php`
- `public/bootstrap-path.php`
- `public/build/` into both `{APP_DIR}/public/build/` and `public_html/build/`

Other Git-tracked static directories (`css/`, `js/`, `fonts/`, `images/`, `favicon_io/`, `favicon.ico`) may still be copied. They are not a reason to sync `public_html` as a whole. `public/robots.txt` is not copied: the tracked file is a local development copy.

---

## 1. Architecture that must stay in place

The Laravel application is not the website document root. Apache serves only the public directory. `public/index.php` loads the application through `public/bootstrap-path.php`.

| | Staging | Production |
|---|---|---|
| cPanel account home | `/home/devtech/` | `/home/ibntech/` |
| Domain | `dev.ibntech.com` | `ibntech.com` |
| Laravel application | `/home/devtech/ibntech-core/` | `/home/ibntech/ibntech-core/` |
| Public document root | `/home/devtech/public_html/` | `/home/ibntech/public_html/` |
| Environment file | `/home/devtech/ibntech-core/.env` | `/home/ibntech/ibntech-core/.env` |
| Uploaded media | `/home/devtech/public_html/uploads/` | `/home/ibntech/public_html/uploads/` |

Confirmed public files on each document root:

```text
public_html/
├── build/
├── uploads/
├── bootstrap-path.php
└── index.php
```

`bootstrap-path.php` chooses the core directory from the request host:

- `dev.ibntech.com` → `/home/devtech/ibntech-core`
- `ibntech.com` and `www.ibntech.com` → `/home/ibntech/ibntech-core`
- `localhost` / `127.0.0.1` → the directory above `public/` (local XAMPP)

Do not point either domain's document root at:

- `/home/devtech/ibntech-core/`
- `/home/ibntech/ibntech-core/`
- `/home/devtech/ibntech-core/public/`
- `/home/ibntech/ibntech-core/public/`

Those directories hold `.env`, `storage`, `vendor`, and application code. They must stay outside the web root.

Laravel's `public_path()` is not overridden in this codebase. On the server it resolves to `{APP_DIR}/public` (for example `/home/devtech/ibntech-core/public`). Apache serves `{PUBLIC_DIR}` (`public_html`). Deployment therefore publishes web files to both places:

1. `{APP_DIR}/public/` so Laravel can see `build/manifest.json`, `images/`, and `robots.txt`.
2. `{PUBLIC_DIR}/` so browsers and Apache can request those same files.

Uploaded media does not follow that dual copy. It stays only in `public_html/uploads/`, addressed by `MEDIA_ROOT` in that server's `.env`.

---

## 2. What this repository actually contains

Confirmed from the project. Do not replace these with assumptions from another application.

| Item | Confirmed state |
|---|---|
| Framework | Laravel `v12.64.0` (`composer.lock`), constraint `^12.0` |
| PHP | `^8.2` in `composer.json` |
| Admin | Filament `v5.7.5`, panel path `/admin`, Vite theme `resources/css/filament/admin/theme.css` |
| Front end | Vite 7, Tailwind CSS 4, `laravel-vite-plugin`. Build script: `npm run build` |
| Lockfiles | `composer.lock` and `package-lock.json` are present and tracked |
| `public/build/` | Tracked. Includes `public/build/manifest.json`. Node.js is not required on the server to serve assets |
| `public/hot` | Tracked. Contents are the local Vite URL `http://[::1]:5173`. Must not be deployed |
| `public/uploads/` | Only `public/uploads/.gitignore` is tracked. Upload files are ignored |
| `public/index.php` | Tracked. Loads `bootstrap-path.php`, then the core `vendor/autoload.php` and `bootstrap/app.php` |
| `public/bootstrap-path.php` | Tracked. Host map for local, staging, and production in one file |
| `public/.htaccess` | Tracked in Git. Live staging and production copies differ and are never deployed |
| Other tracked public paths | `css/`, `fonts/`, `images/`, `js/`, `favicon_io/`, `favicon.ico`, `robots.txt` |
| `public/storage` | Present on the local disk, not tracked. Media does not use `storage:link` |
| `.env` | Listed in `.gitignore`. The index still contains the file until that removal is committed. Permanently server-only. Never copied, overwritten, deleted, or synchronized. See [Environment files](#12-environment-files) |
| `.env.example` | Tracked. Safe template. No live passwords |
| `vendor/` | Listed in `.gitignore`, but about 8,052 files are already tracked. Git ignore does not untrack them |
| `node_modules/` | Listed in `.gitignore`, but about 3,886 files are already tracked |
| `bootstrap/cache/*.php` | Not tracked. `bootstrap/cache/.gitignore` ignores everything except itself |
| `deploy.sh`, `.cpanel.yml` | Not in the repository. Specified in this guide. Do not treat them as already installed |
| `deploy-config.sh` | Must not be committed. Template: `deploy-config.sh.example` |
| Cache default | `CACHE_STORE=database` (`config/cache.php`) |
| Session default | `SESSION_DRIVER=database` |
| Queue default | `QUEUE_CONNECTION=database`. Scheduler in `bootstrap/app.php` runs `queue:monitor` every minute when the queue is `database` |
| Optimize command | `php artisan cms:optimize` in `routes/console.php` runs `config:cache`, `route:cache`, and `view:cache` |
| Maintenance | `APP_MAINTENANCE_DRIVER=file` in `.env.example`. `index.php` loads `{core}/storage/framework/maintenance.php` when that file exists |
| Media | Disk `media`. `MEDIA_ROOT` may be relative locally (`public/uploads`) or absolute on cPanel. No symlink required |
| PHP binary on the server | **TO VERIFY ON SERVER** |
| Composer binary on the server | **TO VERIFY ON SERVER** |
| cPanel Git clone directory | **TO VERIFY ON SERVER** (create it; it must not be `public_html` or `ibntech-core`) |
| Live `public_html/.htaccess` | Different on staging and production. Never replaced by Git |
| Live `robots.txt` | Not part of the deploy copy. Tracked Git file is a local development copy |

`package.json` also depends on Playwright, PDF.js, and `@napi-rs/canvas`. Those are local tooling. They are not part of serving the site. The server does not need Node.js, npm, or those packages when `public/build/` is deployed from Git.

`docs/PRODUCTION_DEPLOYMENT.md` contains example CLI paths such as `/usr/local/bin/php` and `/usr/local/bin/ea-php84`. This guide does not treat either path as confirmed. Verify the binaries in cPanel Terminal before writing them into `deploy-config.sh`.

---

## 3. Branch strategy

One GitHub repository:

`https://github.com/DipakXn/ibntech-laravel.git`

Two deployment branches:

| Branch | Deploys to | cPanel account | Domain |
|---|---|---|---|
| `staging` | Staging only | `/home/devtech/` | `https://dev.ibntech.com` |
| `main` | Production only | `/home/ibntech/` | `https://ibntech.com` |

```text
Local development (Windows / XAMPP)
        ↓
GitHub staging branch
        ↓
cPanel staging repository (devtech)
        ↓
Staging deployment
        ↓
Testing / verification
        ↓
Merge staging → main
        ↓
GitHub main branch
        ↓
cPanel production repository (ibntech)
        ↓
Production deployment
```

Production is deployed only after the same commit has been verified on staging.

`.cpanel.yml` and `deploy.sh` stay identical on `staging` and `main`. Environment paths live only in the server file `deploy-config.sh`, which is not in Git.

Do not create a third long-lived deployment branch for production hotfixes unless it is merged back into `staging` and `main`. A production-only commit that never lands on `staging` will make the next staging merge overwrite or conflict with it.

---

## 4. Server directories to create

These paths are the intended layout. They are not assumed to exist today. Create any that are missing, as the cPanel user who owns the account.

### Staging (`devtech`)

```text
/home/devtech/ibntech-core/                          application (already the live core)
/home/devtech/public_html/                           document root (already the live web root)
/home/devtech/repositories/ibntech-laravel/          cPanel Git clone — create; not the live site
/home/devtech/deploy-configs/staging/deploy-config.sh
/home/devtech/deploy-configs/staging/deploy.lock     created by the deploy script
/home/devtech/deploy-backups/                        release archives
/home/devtech/deploy-logs/                           deploy logs
```

### Production (`ibntech`)

```text
/home/ibntech/ibntech-core/
/home/ibntech/public_html/
/home/ibntech/repositories/ibntech-laravel/
/home/ibntech/deploy-configs/production/deploy-config.sh
/home/ibntech/deploy-configs/production/deploy.lock
/home/ibntech/deploy-backups/
/home/ibntech/deploy-logs/
```

The clone directory is only a suggestion. Any private path is acceptable when all of the following are true:

- it is not `public_html`
- it is not `ibntech-core`
- it is not inside either of those trees
- `deploy.sh` discovers it from its own location, so the path is not hard-coded in Git

```bash
# Staging examples — run as the devtech user
mkdir -p /home/devtech/repositories
mkdir -p /home/devtech/deploy-configs/staging
mkdir -p /home/devtech/deploy-backups
mkdir -p /home/devtech/deploy-logs
chmod 700 /home/devtech/deploy-configs /home/devtech/deploy-backups /home/devtech/deploy-logs
```

Repeat on the production account with `/home/ibntech/...` and `deploy-configs/production`.

---

## 5. Verify PHP and Composer

On each server, in cPanel Terminal:

```bash
which php
php -v
which composer
composer -V
```

Record the absolute paths. The application requires PHP 8.2 or newer. If `php -v` is older than 8.2, select the account's MultiPHP / EasyApache 8.2+ binary and record that absolute path instead. The exact binary name is **TO VERIFY ON SERVER**.

If `composer` is a PHP script whose shebang points at an older PHP, call it with the verified binary:

```bash
"$PHP_BIN" "$COMPOSER_BIN" -V
```

Put the verified values in that server's `deploy-config.sh` only.

---

## 6. Server-only configuration

`deploy-config.sh.example` in the repository root is the template. The filled file stays on the server and is listed in `.gitignore`.

```bash
# Staging
cp deploy-config.sh.example /home/devtech/deploy-configs/staging/deploy-config.sh
chmod 600 /home/devtech/deploy-configs/staging/deploy-config.sh
```

```bash
# Production — start from the same template, then change every path
cp deploy-config.sh.example /home/ibntech/deploy-configs/production/deploy-config.sh
chmod 600 /home/ibntech/deploy-configs/production/deploy-config.sh
```

Staging file, after the binaries are verified:

```bash
DEPLOY_ENV="staging"
SITE_HOST="dev.ibntech.com"
SITE_NAME="IBN Technologies staging"

APP_DIR="/home/devtech/ibntech-core"
PUBLIC_DIR="/home/devtech/public_html"

PHP_BIN="TO_VERIFY_ON_SERVER"
COMPOSER_BIN="TO_VERIFY_ON_SERVER"

BACKUP_DIR="/home/devtech/deploy-backups"
LOG_DIR="/home/devtech/deploy-logs"
LOCK_FILE="/home/devtech/deploy-configs/staging/deploy.lock"

MAINTENANCE_SECRET=""
BACKUP_RETENTION=5
```

Production file:

```bash
DEPLOY_ENV="production"
SITE_HOST="ibntech.com"
SITE_NAME="IBN Technologies production"

APP_DIR="/home/ibntech/ibntech-core"
PUBLIC_DIR="/home/ibntech/public_html"

PHP_BIN="TO_VERIFY_ON_SERVER"
COMPOSER_BIN="TO_VERIFY_ON_SERVER"

BACKUP_DIR="/home/ibntech/deploy-backups"
LOG_DIR="/home/ibntech/deploy-logs"
LOCK_FILE="/home/ibntech/deploy-configs/production/deploy.lock"

MAINTENANCE_SECRET=""
BACKUP_RETENTION=5
```

`MAINTENANCE_SECRET` is optional. If you set one, set it only in the server file. It becomes the bypass path while the site is down (`https://dev.ibntech.com/{secret}`). Do not put a real secret in Git, in this guide, or in a chat log.

Never copy `deploy-config.sh` from staging to production. Never point staging `APP_DIR` at `/home/ibntech/...` or the reverse.

The future `deploy.sh` must reject the run when:

- the config file is missing
- `PHP_BIN` or `COMPOSER_BIN` is still `TO_VERIFY_ON_SERVER`
- `APP_DIR` or `PUBLIC_DIR` is missing
- `APP_DIR` does not contain `artisan`
- `PUBLIC_DIR` does not contain `index.php`
- `APP_DIR` and `PUBLIC_DIR` are the same directory
- `APP_DIR` is `public_html` or ends in `/public_html`
- the account home does not match the config (`/home/devtech` can load only the staging file; `/home/ibntech` can load only the production file)
- the Git clone directory and `APP_DIR` are the same directory

---

## 7. cPanel Git Version Control

Install this once per account. The clone is the source checkout. It is not the live application and it is not the document root.

### Staging

1. cPanel → **Git Version Control** → **Create**.
2. Clone URL: `https://github.com/DipakXn/ibntech-laravel.git`
3. Branch: `staging`
4. Repository path: `/home/devtech/repositories/ibntech-laravel` (or another private path that passes the rules in [section 4](#4-server-directories-to-create))
5. Do not set the repository path to `/home/devtech/public_html` or `/home/devtech/ibntech-core`.
6. After `.cpanel.yml` exists on `staging`, use **Update from Remote**, then **Deploy HEAD Commit**.

### Production

Same steps on the production cPanel account, with:

- Branch: `main`
- Repository path: `/home/ibntech/repositories/ibntech-laravel`

Production's clone tracks `main` only. Do not point it at `staging`.

### Each release

1. Confirm the GitHub branch has the commit you intend to release.
2. Open that account's repository in **Git Version Control**.
3. **Update from Remote** — fetches the branch. This does not by itself publish the live site.
4. **Deploy HEAD Commit** — runs `.cpanel.yml`, which runs `deploy.sh`.
5. Read the deployment log in cPanel and the file under `LOG_DIR`.
6. Run the verification in [Deployment verification](#20-deployment-verification).
7. Run database migrations only when that release contains migrations, as a separate step ([Database migrations](#21-database-migrations)).

cPanel runs deployment tasks from the clone directory, as the cPanel user, without a terminal prompt. `deploy.sh` must not ask questions.

---

## 8. `.cpanel.yml`

This file is not in the repository yet. Add the same file to both `staging` and `main`.

```yaml
---
deployment:
  tasks:
    - /bin/bash deploy.sh
```

cPanel runs that task with the clone as the working directory. `deploy.sh` then loads the server-only config and copies code into `ibntech-core` and web files into `public_html`.

Do not put `/home/devtech` or `/home/ibntech` inside `.cpanel.yml`.

---

## 9. Future `deploy.sh`

Do not add `deploy.sh` until this behaviour is reviewed. The script belongs in the repository root and stays identical on both branches. It should do the following, in this order.

1. **Detect the account** from `$HOME`.
   - `/home/devtech` loads `/home/devtech/deploy-configs/staging/deploy-config.sh`
   - `/home/ibntech` loads `/home/ibntech/deploy-configs/production/deploy-config.sh`
   - any other home aborts
2. **Load** that config. Abort if a required variable is empty or still `TO_VERIFY_ON_SERVER`.
3. **Validate directories** before changing the site. Rules are in [section 6](#6-server-only-configuration). Confirm `.env` already exists in `APP_DIR`. Confirm `PUBLIC_DIR/uploads` exists. If uploads is missing, stop and ask an administrator to create it. Do not invent an empty uploads tree over a path you have not checked.
4. **Take a lock** with `flock` on `LOCK_FILE`. A second deploy exits immediately with a clear log line.
5. **Open a log** at `$LOG_DIR/deploy-YYYYMMDD-HHMMSS.log`. Log the environment name, host, commit (`git rev-parse HEAD` inside the clone), `APP_DIR`, and `PUBLIC_DIR`. Do not log `.env` contents.
6. **Back up** the current release ([Backups](#16-backups)).
7. **Maintenance mode** from the existing application, before files are replaced:

   ```bash
   cd "$APP_DIR"
   if [ -n "$MAINTENANCE_SECRET" ]; then
     "$PHP_BIN" artisan down --retry=60 --secret="$MAINTENANCE_SECRET"
   else
     "$PHP_BIN" artisan down --retry=60
   fi
   ```

   `index.php` already looks for `$laravelPath/storage/framework/maintenance.php`. That file lives in the core `storage` directory, which deployment does not delete.

8. **Update application code** from the clone (`SOURCE_DIR`, the directory that contains `deploy.sh`) into `APP_DIR`.
9. **Install PHP dependencies** in `APP_DIR` from `composer.lock`:

   ```bash
   cd "$APP_DIR"
   "$PHP_BIN" "$COMPOSER_BIN" install \
     --no-dev \
     --optimize-autoloader \
     --no-interaction \
     --no-scripts
   ```

   `--no-dev` omits PHPUnit, Pint, Debugbar, Sail, Pail, and Collision. Telescope stays, because `laravel/telescope` is in `require`, not `require-dev`.

   `--no-scripts` avoids `composer.json`'s `post-autoload-dump` hook, which runs `php artisan filament:upgrade` in the middle of install. The script runs `filament:upgrade` itself after caches are cleared.

   `vendor/` is currently committed from Windows. The Linux `composer install` is the copy that must actually run. Do not skip Composer because `vendor/` arrived in the Git checkout.

10. **Publish web files** ([section 10](#10-frontend-assets) and [section 11](#11-uploads)).
11. **Leave server-only files untouched.** Never copy, overwrite, delete, or sync `.env`, `.env.*`, `public/.htaccess`, `storage/`, `public/uploads/`, `public/hot`, or `bootstrap/cache/*.php`. See [Permanent deployment rules](#permanent-deployment-rules).
12. **Remove Windows runtime cache and rebuild it on Linux** ([Commands the deploy must run on Linux](#commands-the-deploy-must-run-on-linux)).
13. **Bring the site back** with an `EXIT` trap that runs `php artisan up` from `APP_DIR` even when a later command fails.
14. **On failure, roll back** the code and public files from the backup taken in step 6, then leave maintenance mode ([Rollback](#22-rollback)).
15. **Do not** run `php artisan migrate`.
16. **Do not** run destructive database commands.

### Exclusions while copying into `APP_DIR`

The sync into `ibntech-core` must exclude:

- `.env` and `.env.*` (do not copy `.env.example` onto the server either)
- `.htaccess` and `public/.htaccess`
- `storage/` (keep the server tree: logs, private files, `storage/app/old-submissions/`, framework runtime)
- `bootstrap/cache/*.php`
- `node_modules/`
- `public/hot`
- `public/uploads/`
- `.git/`
- `deploy-config.sh`

Do not delete `bootstrap/` itself. Do not delete `storage/` itself. Do not delete `public/hot` as part of deploy; exclude it so it is neither copied nor removed. The reference script uses `rsync --delete` only for the application tree and for `build/`. That application-tree delete is safe only while the exclusions above are present and `--delete-excluded` is absent. `rsync` does not delete excluded destination files unless `--delete-excluded` is set. Never add that flag. Never point `rsync --delete` at `public_html/`.

Linux cache rebuild may delete generated files inside `bootstrap/cache/` and `storage/framework/views` after the sync, then recreate them on the server. That is not a copy from Git. It does not delete the `bootstrap` or `storage` directories, and it does not delete `storage/app`.

### `EXIT` trap

```bash
cleanup() {
  local status=$?
  if [ "$status" -ne 0 ]; then
    rollback || true
  fi
  if [ -d "$APP_DIR" ] && [ -f "$APP_DIR/artisan" ]; then
    (cd "$APP_DIR" && "$PHP_BIN" artisan up) || true
  fi
  exit "$status"
}
trap cleanup EXIT
```

The trap is the mechanism that returns the site to visitors. Do not rely on a final `artisan up` that is skipped when `set -e` aborts the script.

### Reference script

This is the specification to place in `deploy.sh` later. It is not installed by this document.

```bash
#!/bin/bash
set -euo pipefail

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

if [ ! -f "$CONFIG_FILE" ]; then
  echo "Missing $CONFIG_FILE" >&2
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
    rollback || true
  fi
  if [ -f "$APP_DIR/artisan" ]; then
    (cd "$APP_DIR" && "$PHP_BIN" artisan up) || true
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
```

`rsync` must be available on the server. **TO VERIFY ON SERVER** (`which rsync`). If it is missing, stop and install it through the host. Do not replace this sync with a copy of the whole `public_html` tree.

`rsync --delete` for `build/` runs twice, once into `{APP_DIR}/public/build/` (what Laravel's `public_path()` reads) and once into `public_html/build/` (what Apache serves). Both sources are the Git checkout. Neither command may be pointed at `public_html/` or `uploads/`.

`.env`, `.htaccess`, and the entire `storage/` directory are not copied, not deleted, and not restored from the release archive. The archive does not contain `storage/`, so extracting it cannot overwrite or restore that directory. There is no `.htaccess.deploy-preserve` marker.

---

## 9.1 Windows runtime cache must not reach Linux

This project has already failed this way. A Windows-generated `bootstrap/cache/config.php` contained resolved Windows absolute paths. On Linux those strings were treated as directory names, so the server created malformed folders whose names looked like `C:\...` paths.

Windows development runtime cache must not be deployed to Linux.

That includes files produced on a developer machine by:

- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan event:cache`
- `php artisan optimize`
- `php artisan cms:optimize`
- `php artisan filament:optimize`

`cms:optimize` is defined in `routes/console.php`. It caches config, routes, and views. Run it on the destination Linux server only.

### What Git does today

`bootstrap/cache/.gitignore` ignores every file in that directory except `.gitignore`. `config.php`, `packages.php`, `services.php`, and route/event caches are not tracked. Keep it that way. Do not `git add -f bootstrap/cache`.

`storage/framework/views/*.php`, cache data, and sessions are ignored by the storage `.gitignore` files. Do not force-add them.

### What deployment must do

- Do not copy `bootstrap/cache/*.php` from a Windows workspace into the clone or into `ibntech-core`.
- Do not delete the `bootstrap` directory.
- Do not delete the `storage` directory.
- After the new code is in `APP_DIR`, delete generated cache files before Artisan boots. A Windows `config.php` can stop `artisan` from starting, so the script removes `bootstrap/cache/*.php` (everything in that directory except `.gitignore`), compiled views, and file-cache data with `find` first. It does not remove the `bootstrap` or `storage` directories.
- Then rebuild caches with the Linux PHP binary so every cached path starts with `/home/devtech/ibntech-core` or `/home/ibntech/ibntech-core`.

### Commands the deploy must run on Linux

From the core directory, using the verified PHP binary:

```bash
cd /home/devtech/ibntech-core
# production: cd /home/ibntech/ibntech-core

"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan filament:upgrade
"$PHP_BIN" artisan cms:optimize
"$PHP_BIN" artisan filament:optimize
"$PHP_BIN" artisan queue:restart
```

`optimize:clear` removes cached config, routes, views, events, and compiled files. It does not remove `storage/app`, uploaded media, or the `bootstrap` directory.

`cms:optimize` then recreates, on this server:

- `bootstrap/cache/config.php`
- the route cache
- compiled Blade views under `storage/framework/views/`

`filament:upgrade` publishes Filament assets into `{APP_DIR}/public`. The reference script copies `css`, `js`, `fonts`, `images`, and `favicon_io` into `public_html` again after that command so the document root receives the published files.

`filament:optimize` and, when an admin navigation item is missing, `filament:cache-components`, also run on the server. They must not be generated on Windows and uploaded.

If malformed `C:\...` directories already exist under `public_html` or `ibntech-core`, delete only those wrongly named directories after Linux caches have been rebuilt. Do not delete `build`, `uploads`, `storage`, or `bootstrap` while cleaning them up.

### Local rule before every commit

On Windows, do not run the cache commands above before committing. If they were run locally:

```bash
php artisan optimize:clear
```

Then confirm `git status` does not list `bootstrap/cache/*.php` or `storage/framework/views/*.php`.

---

## 10. Frontend assets

Node.js stays on the developer machine. The server serves the committed Vite build.

```text
Windows / XAMPP
        ↓
npm ci
npm run build
        ↓
public/build/          (manifest.json + assets/)
        ↓
git commit on staging
        ↓
GitHub
        ↓
cPanel deploy
        ↓
ibntech-core/public/build/     Laravel public_path()
public_html/build/             Apache / the browser
```

`public/build/` is tracked, including `manifest.json`. A commit that changes CSS, JS, or Blade asset references must include a fresh `npm run build`. If the manifest is missing on the server, Laravel reports that the Vite manifest cannot be found.

`rsync --delete` may be used for `public/build/` only, and only for that directory on each destination (`ibntech-core/public/build/` and `public_html/build/`). Hashed filenames change every build. Old files in `build/` are safe to remove. The same `--delete` must never target:

- `public_html/`
- `public_html/uploads/`
- `ibntech-core/`
- `ibntech-core/storage/`

### Do not deploy `public/hot`

`public/hot` is currently tracked and contains `http://[::1]:5173`. If that file is present, Laravel loads the Vite development server instead of `public/build`. Remove it from the index and ignore it:

```bash
git rm --cached public/hot
```

Add this line to `.gitignore`:

```gitignore
/public/hot
```

The local file can remain on the Windows machine while `npm run dev` is running. Deployment excludes `public/hot`. It does not copy it and it does not delete a copy already on the server. If a live site is loading `http://[::1]:5173`, an administrator removes `public_html/hot` and `ibntech-core/public/hot` by hand. That cleanup is not part of deploy.

### Static files besides `build/`

Git also tracks `public/css`, `public/js`, `public/fonts`, `public/images`, `public/favicon_io`, and `public/favicon.ico`. Blade templates call `public_path('images/...')` and the site requests `/images/...`. Publish these directories to both `{APP_DIR}/public/` and `public_html/`.

Copy them without `rsync --delete` until an administrator confirms the live document root has no extra files in those folders that Git does not know about. **TO VERIFY ON SERVER** whether `public_html` currently contains `css/`, `js/`, `fonts/`, `images/`, and `favicon_io/` in addition to the four paths listed in [section 1](#1-architecture-that-must-stay-in-place).

Filament's admin theme is compiled by Vite into `public/build` (`theme-*.css` in the manifest). `filament:upgrade` may also publish package assets under `public/css`, `public/js`, and `public/fonts`. Both mechanisms are required. A styled `/admin` page needs the Vite build and the published Filament assets in `public_html`.

---

## 11. Uploads

Live media directories:

- Staging: `/home/devtech/public_html/uploads/`
- Production: `/home/ibntech/public_html/uploads/`

Set `MEDIA_ROOT` in that server's `.env` to the absolute path above, and `MEDIA_URL=/uploads`. Local development keeps the relative value `MEDIA_ROOT=public/uploads`.

Deployment must not:

- delete `uploads/`
- replace `uploads/`
- archive-and-empty `uploads/` as part of a code deploy
- run `rsync --delete` against `public_html/` or against `uploads/`
- copy staging uploads onto production, or production uploads onto staging

Git tracks only `public/uploads/.gitignore`. A normal checkout contains no media files. The deploy excludes `public/uploads/` from the core sync so a Git checkout cannot wipe a directory of user files.

Spatie media is served directly by Apache from `MEDIA_ROOT`. `php artisan storage:link` is not required for uploads. The legacy `public` disk symlink (`public/storage` → `storage/app/public`) is not part of this deployment.

Permissions on the uploads tree must allow the PHP user to write new Filament uploads. `775` on the directory is the starting point. If the host PHP user is not the account user, use the least permission that allows uploads. **TO VERIFY ON SERVER** after the first media save.

`storage/app/old-submissions/` holds private historical CSV imports. Those files are gitignored, live under the core `storage` tree, and must not be moved into `public_html` or `uploads`.

---

## 12. Environment files

`.env` is a permanent server-only file. Git deployment must never copy, overwrite, delete, or sync it.

| Environment | File | Rule |
|---|---|---|
| Local | project `.env` | Never commit |
| Staging | `/home/devtech/ibntech-core/.env` | Remains on that server |
| Production | `/home/ibntech/ibntech-core/.env` | Remains on that server |

These files must:

- never be copied by Git deployment
- never be overwritten by Git deployment
- never be deleted by Git deployment
- never be synced by `rsync`, `cp`, or a backup restore
- never be copied from staging to production or from production to staging
- never be committed
- never have their secrets pasted into this guide, tickets, or deploy logs

`.env.*` is under the same rule. `.env.example` remains tracked and must not be copied over a server `.env`. `.gitignore` matches `.env`, and the index still lists `.env` until the removal is committed.

`.gitignore` already contains:

```gitignore
.env
.env.*
!.env.example
```

Deployment still excludes `.env` and `.env.*` so a checkout cannot write the server files. That exclusion is not a step that removes anything from Git.

On each server, after any deploy, confirm the existing `.env` is still present and was not modified by the deploy:

```bash
test -f /home/devtech/ibntech-core/.env && echo "staging env present"
test -f /home/ibntech/ibntech-core/.env && echo "production env present"
```

The historical commit still contains the old `.env` blob. Treat any secret that was ever committed as exposed. Rotate database passwords, `APP_KEY` only with a planned re-encrypt of stored data, mail passwords, and reCAPTCHA secrets on the servers. Do not print the old or new values in the deploy log. Rotating `APP_KEY` invalidates encrypted cookies and encrypted database values. Do that as its own change, not in the middle of a code deploy.

### Values that must differ per server

Use `.env.example` as the key list. Set values on the server. Do not copy this table's placeholders into Git.

| Key | Staging | Production |
|---|---|---|
| `APP_ENV` | `staging` | `production` |
| `APP_DEBUG` | `false` | `false` |
| `APP_URL` | `https://dev.ibntech.com` | `https://ibntech.com` |
| `APP_KEY` | already on that server | already on that server; not shared |
| `DB_*` | staging database | production database |
| `SESSION_DOMAIN` | `dev.ibntech.com` | `ibntech.com` |
| `MEDIA_ROOT` | `/home/devtech/public_html/uploads` | `/home/ibntech/public_html/uploads` |
| `MEDIA_URL` | `/uploads` | `/uploads` |
| `TELESCOPE_ENABLED` | `false` unless deliberately gated | `false` |
| `DEBUGBAR_ENABLED` | `false` | `false` |
| `MAIL_LEAD_NOTIFICATION_TO` | a staging mailbox | the production mailbox |
| `RECAPTCHA_SITE_KEY` / `RECAPTCHA_SECRET_KEY` | keys registered for `dev.ibntech.com` | keys registered for `ibntech.com` |

`CACHE_STORE=database`, `SESSION_DRIVER=database`, and `QUEUE_CONNECTION=database` match the application defaults. Changing them requires the matching tables or services and a Linux `cms:optimize` afterward.

After any `.env` edit:

```bash
cd "$APP_DIR"
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan cms:optimize
```

---

## 13. Public entry points

`public/index.php` and `public/bootstrap-path.php` are Git-managed. They are not generated, and they are not separate files per server.

`index.php` does four things:

1. Loads `bootstrap-path.php` to obtain the core directory.
2. If `{core}/storage/framework/maintenance.php` exists, it shows the maintenance page and stops.
3. Loads `{core}/vendor/autoload.php`.
4. Boots `{core}/bootstrap/app.php` and handles the request.

`bootstrap-path.php` is the host map in [section 1](#1-architecture-that-must-stay-in-place). One file is correct for local, staging, and production because the host decides the path. Deployment copies the Git version to:

- `{APP_DIR}/public/index.php` and `{APP_DIR}/public/bootstrap-path.php`
- `{PUBLIC_DIR}/index.php` and `{PUBLIC_DIR}/bootstrap-path.php`

Apache uses the `public_html` copies. The copies inside `ibntech-core/public` keep the core tree aligned with Git. They are not the document root.

Do not keep a hand-edited `public_html/index.php` that drifts from Git. Do not overwrite the staging file with a production-only variant. The repository does not contain one. If a live server file differs from Git, **TO VERIFY ON SERVER**, diff it before the first deploy and merge any real local fix back into Git first.

A request whose host matches none of the rules falls through to `dirname(__DIR__)`. For a file sitting in `public_html`, that is `/home/devtech` or `/home/ibntech`, not `ibntech-core`. The host comparisons are exact (`dev.ibntech.com`, `ibntech.com`, `www.ibntech.com`). A different hostname will boot the wrong directory.

---

## 14. `.htaccess` and `robots.txt`

### `.htaccess`

Live `.htaccess` files are different on staging and production. They stay on the server. Git deployment must never copy, overwrite, delete, or sync them.

| Environment | File |
|---|---|
| Staging | `/home/devtech/public_html/.htaccess` |
| Production | `/home/ibntech/public_html/.htaccess` |

The repository also contains `public/.htaccess`. That tracked file is not the live configuration. Deployment excludes `.htaccess` everywhere, including `{APP_DIR}/public/.htaccess`. There is no `.htaccess.deploy-preserve` marker and no comparison step that copies the Git file when it looks similar.

Do not copy `/home/devtech/public_html/.htaccess` onto production. Do not copy `/home/ibntech/public_html/.htaccess` onto staging. Edit a live file only on that server, outside deployment.

Trailing slashes are enforced by `App\Http\Middleware\EnsureTrailingSlash`. If a redirect loop appears, change the `.htaccess` on that server only.

### `robots.txt`

`public/robots.txt` is tracked. The committed file is a local development copy: it disallows many crawlers and ends with `Sitemap: http://localhost:8000/sitemap.xml`. Deployment does not copy it to `public_html`. There is no `robots.txt.deploy-preserve` marker.

`App\Services\WebsiteSettingService::syncRobotsTxt()` writes `robots.txt` to `public_path('robots.txt')`, which is `{APP_DIR}/public/robots.txt`, not automatically `public_html/robots.txt`. **TO VERIFY ON SERVER** which file the live site is serving. Do not replace one environment's `robots.txt` with the other's.

---

## 15. Preserved files and deployed files

### Preserved on the server

| Path | Why |
|---|---|
| `{APP_DIR}/.env` and `{APP_DIR}/.env.*` | Permanent server-only environment files |
| `{PUBLIC_DIR}/.htaccess` and `{APP_DIR}/public/.htaccess` | Permanent server-only Apache config. Staging and production differ |
| `{APP_DIR}/storage/` | Logs, private files, old-submission CSVs, sessions if any. Not synced from Git |
| `{APP_DIR}/bootstrap/` directory | Application bootstrap. `bootstrap/cache/*.php` is not copied from Git |
| `{PUBLIC_DIR}/uploads/` and `public/uploads/` | User and CMS media |
| `public/hot` | Excluded. Deploy does not copy it and does not delete it |
| `{PUBLIC_DIR}/robots.txt` | Not copied from Git |
| `deploy-config.sh`, backups, deploy logs | Outside Git |

### Deployed from Git, then adjusted on Linux

| Path | Destination |
|---|---|
| Application code (`app/`, `bootstrap/*.php`, `config/`, `database/`, `resources/`, `routes/`, `artisan`, `composer.json`, `composer.lock`) | `{APP_DIR}` |
| `vendor/` | Rebuilt in `{APP_DIR}` by `composer install` from `composer.lock` |
| `public/build/` | `{APP_DIR}/public/build/` and `{PUBLIC_DIR}/build/` with `--delete` limited to `build/` |
| `public/css`, `js`, `fonts`, `images`, `favicon_io`, `favicon.ico` | Both public locations, without `--delete` |
| `public/index.php`, `public/bootstrap-path.php` | Both public locations |
| Linux cache files | Created on the server in `{APP_DIR}/bootstrap/cache` and `{APP_DIR}/storage/framework` after the sync. Not copied from Windows |

### Never deployed

| Path | Why |
|---|---|
| `.env`, `.env.*` | Permanent server-only files |
| `.htaccess`, `public/.htaccess` | Permanent server-only files. Live copies differ by environment |
| `node_modules/` | Not required on the server. Currently tracked by mistake |
| `public/hot` | Vite dev-server marker. Excluded from every sync |
| `bootstrap/cache/*.php` from Git or Windows | Breaks Linux paths. Rebuilt on the server |
| `public/uploads/*` from Git | Would replace live media. Git has no media files |
| `storage/` | Server runtime and private files. Not synced |
| `public/robots.txt` | Tracked local development copy. Not copied to `public_html` |
| `deploy-config.sh` | Server-only |

---

## 16. Backups

Take a release backup after validation and before maintenance mode replaces files. The reference script writes:

```text
/home/devtech/deploy-backups/release-YYYYMMDD-HHMMSS.tar.gz
/home/ibntech/deploy-backups/release-YYYYMMDD-HHMMSS.tar.gz
```

The archive contains application code and the deployable public assets the deploy is allowed to replace. It excludes the entire `{APP_DIR}/storage/` directory, not only `storage/logs`. It also excludes `.env`, `.env.*`, `public_html/.htaccess`, `node_modules`, and `public_html/uploads`. A code rollback extracts only that archive and excludes `storage/` again on extract, so it cannot overwrite or restore `storage/`. Media is large, and this deploy does not change it. Back up uploads on a separate schedule (cPanel backup or an archive of that directory) so a disk failure is recoverable. Do not restore an uploads archive over the live directory unless you intend to replace media.

Keep `BACKUP_RETENTION` archives (the template uses 5). Store them on that server only. Do not copy a production archive onto staging or into Git.

Database backups are not part of the code deploy. Take one before a manual migration ([Database migrations](#21-database-migrations)). cPanel backup or a dump from the account is appropriate. Do not put the dump in `public_html` or in Git.

---

## 17. Maintenance mode

`APP_MAINTENANCE_DRIVER=file` writes `storage/framework/maintenance.php` inside the core. `public_html/index.php` includes that file when it exists, so visitors see the maintenance page even though the document root is separate from the core.

The deploy enables maintenance mode only after the pre-flight checks and the backup, and only against the current `APP_DIR`:

```bash
cd /home/devtech/ibntech-core
"$PHP_BIN" artisan down --retry=60
```

Production uses `/home/ibntech/ibntech-core` and the production PHP binary.

The `EXIT` trap always attempts:

```bash
"$PHP_BIN" artisan up
```

If a deploy is cancelled and the trap does not run, bring the site back manually with that command. Confirm `storage/framework/maintenance.php` is gone afterward.

A secret bypass is optional and lives in `MAINTENANCE_SECRET` on that server. Do not reuse one secret across staging and production if it has been shared.

---

## 18. Staging release procedure

1. On Windows, update `staging` from GitHub and make the change.
2. If CSS, JS, or the Filament theme changed: `npm ci` then `npm run build`. Commit `public/build/`.
3. Run `php artisan optimize:clear` locally if any cache command was used. Do not commit `bootstrap/cache/*.php`.
4. Run the test suite you normally run for the change.
5. Push `staging` to GitHub.
6. On the staging server, confirm `deploy-config.sh` still points at `/home/devtech/ibntech-core` and `/home/devtech/public_html`.
7. cPanel → Git Version Control → staging repository → **Update from Remote**.
8. **Deploy HEAD Commit**.
9. Read `/home/devtech/deploy-logs/` and confirm the script did not run migrations.
10. Verify `https://dev.ibntech.com` using [Deployment verification](#20-deployment-verification).
11. If `database/migrations` changed, follow [Database migrations](#21-database-migrations) on staging only.
12. Stop if staging is not acceptable. Do not merge to `main`.

---

## 19. Production release procedure

Start this only after staging verification of the same changes.

1. Merge `staging` into `main` and push `main`.
2. On the production server, confirm `deploy-config.sh` points at `/home/ibntech/ibntech-core` and `/home/ibntech/public_html`.
3. cPanel → Git Version Control → production repository → **Update from Remote**.
4. **Deploy HEAD Commit**.
5. Read `/home/ibntech/deploy-logs/`.
6. Verify `https://ibntech.com`.
7. Run production migrations only if this release added migration files, after a database backup.

Do not deploy production from the `staging` branch. Do not point the production clone at the staging remote URL or the staging directory.

---

## 20. Deployment verification

Run this on the environment that was just deployed.

### Staging

- `https://dev.ibntech.com` loads over HTTPS.
- `https://dev.ibntech.com/up` returns the Laravel health response.
- A public page shows CSS and JavaScript from `/build/`, not from `http://[::1]:5173`.
- View source or the network panel: there must be no request to a Vite dev server.
- `https://dev.ibntech.com/build/manifest.json` is not required to be public; the assets it names must load.
- `/admin` renders the IBNTECH Control login page with styles.
- Submit one staging form only if `MAIL_LEAD_NOTIFICATION_TO` is a staging mailbox.
- Open an existing `/uploads/...` image and confirm it still loads.
- Upload a new test file in Filament and confirm it appears under `/home/devtech/public_html/uploads/` and was not written into `ibntech-core`.
- `test -f /home/devtech/ibntech-core/.env`
- `test -d /home/devtech/public_html/uploads`
- `test ! -f /home/devtech/public_html/hot`
- `test ! -f /home/devtech/ibntech-core/public/hot`
- `bootstrap/cache/config.php`, if present, contains `/home/devtech/ibntech-core` and does not contain `C:\` or `C:/`.
- No new directory whose name starts with `C:` under `public_html` or `ibntech-core`.
- `storage/logs` shows no fresh exception from the request you just made.

### Production

Repeat the same checks on `https://ibntech.com` and `/home/ibntech/...`.

Also confirm:

- `APP_DEBUG` is false (a thrown error must not show a stack trace to the browser).
- Staging hostnames, staging database names, and `localhost` do not appear in the production page source.
- Queue worker cron is still calling the production core ([Queues and the scheduler](#23-queues-and-the-scheduler)).

---

## 21. Database migrations

Code deployment is not a database migration.

The deploy script must not execute `php artisan migrate`. Run migrations only when the release contains new files under `database/migrations/`, and only after the code deploy for that environment has succeeded and the site is up.

Order:

1. Deploy the code.
2. Verify the deployment.
3. Back up that environment's database.
4. Check migration status.
5. Run the migration manually against that environment.
6. Verify the application again.

Staging:

```bash
cd /home/devtech/ibntech-core
# PHP_BIN is TO VERIFY ON SERVER
"$PHP_BIN" artisan migrate:status
"$PHP_BIN" artisan migrate --force
```

Production, only after the staging migration has been verified:

```bash
cd /home/ibntech/ibntech-core
"$PHP_BIN" artisan migrate:status
"$PHP_BIN" artisan migrate --force
```

`--force` is required because `APP_ENV` is not `local`. It is not permission to rebuild the database.

Run the status command first and read the pending list. It must match the migrations that were in the release. If it shows unexpected pending migrations, stop.

Do not run destructive database commands. Do not point the staging command at the production core, or the production command at the staging core.

`php artisan db:seed --force` is a first-install action. Do not run it on a database that already has CMS content.

After migrating, rebuild caches if the migration changed configuration assumptions:

```bash
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan cms:optimize
```

---

## 22. Rollback

Use this when the new code is on the server and the site is wrong, and a database migration has not been applied.

1. Note the failing commit from the deploy log.
2. If the `EXIT` trap already restored the backup, confirm the restored commit's behaviour and stop.
3. If it did not, restore the archive written at the start of that deploy:

   ```bash
   # Staging example. Use the archive name from the log.
   # storage/ is not in the archive. The extract excludes it again.
   tar -C / -xzf /home/devtech/deploy-backups/release-YYYYMMDD-HHMMSS.tar.gz \
     --exclude='home/devtech/ibntech-core/storage' \
     --exclude='home/devtech/ibntech-core/storage/*'
   ```

   Production uses `/home/ibntech/deploy-backups/...` and excludes `home/ibntech/ibntech-core/storage`.

   This restore does not touch `.env`, `.env.*`, `storage/`, `public_html/.htaccess`, or `public/uploads/`. The release archive excludes those paths, and `storage/` is excluded again on extract, so the rollback cannot overwrite or restore it.

4. Rebuild Linux caches on the restored code:

   ```bash
   cd /home/devtech/ibntech-core
   "$PHP_BIN" artisan optimize:clear
   "$PHP_BIN" artisan cms:optimize
   "$PHP_BIN" artisan up
   ```

5. Verify the site.
6. On GitHub, revert or fix forward on `staging`. Do not leave `main` ahead of a known-bad commit if production was updated. Prefer a new commit over rewriting history that cPanel has already fetched.

If a migration has already run, restoring code is not enough. Restore the database backup taken before that migration, then restore the matching code. Do that only with an explicit decision for that incident. This guide does not automate database restore.

A second rollback path, when the previous Git commit is known good and the backup archive is missing:

1. Check out the last good commit on the server clone (`staging` or `main`).
2. Run **Deploy HEAD Commit** again.

Do not reset the live `ibntech-core` directory with Git. It is not the clone, and it holds `.env` and `storage`.

---

## 23. Queues and the scheduler

Lead mail and media conversions use the database queue. `bootstrap/app.php` schedules `queue:monitor` every minute when `QUEUE_CONNECTION=database`.

cPanel Cron Jobs, one per account, every minute. Replace `PHP_BIN` with the verified binary. **TO VERIFY ON SERVER.**

Staging scheduler:

```bash
PHP_BIN /home/devtech/ibntech-core/artisan schedule:run >> /home/devtech/deploy-logs/schedule.log 2>&1
```

Staging queue drain:

```bash
PHP_BIN /home/devtech/ibntech-core/artisan queue:work database --queue=media,default --stop-when-empty --tries=3 --timeout=900 >> /home/devtech/deploy-logs/queue.log 2>&1
```

Production uses `/home/ibntech/ibntech-core` and the production PHP binary. Run the queue cron every one to five minutes.

The deploy script's `queue:restart` only signals workers that are already running. Cron workers that use `--stop-when-empty` pick up new code on the next run.

---

## 24. Repository hygiene before the first Git deploy

`.gitignore` already lists `.env` and `.env.*`, and `!.env.example` keeps the template tracked. The index still lists `.env` until that removal is committed. Do not treat that index change as a deployment step. Deployment must still never copy, overwrite, delete, or synchronize the server files.

Do the following on `staging` before cPanel clones the repository. Each command removes a path from the index and leaves the working file on disk.

`public/hot` (required):

```bash
git rm --cached public/hot
```

`node_modules/` (required before clone; the directory is large and must not be deployed):

```bash
git rm -r --cached node_modules
```

`vendor/` (required so Linux Composer, not a Windows tree, is the runtime):

```bash
git rm -r --cached vendor
```

`.gitignore` already lists `.env`, `.env.*`, `!.env.example`, `/node_modules`, `/vendor`, and `/deploy-config.sh`. Add `/public/hot` when `public/hot` is removed from the index.

Commit the `public/hot`, `node_modules`, and `vendor` index removals together with that ignore update. Push `staging`, deploy and verify staging, then merge to `main`.

The future `deploy.sh` still excludes `.env`, `.env.*`, `node_modules`, `public/hot`, and Windows cache files, and it still runs Composer on the server. Excluding `.env` does not change the server file. Removing `node_modules` and `vendor` from Git avoids a multi-thousand-file checkout and avoids a Windows `vendor/` directory being what PHP loads if Composer fails halfway.

---

## 25. Troubleshooting

### Malformed folders named like `C:\...`

A Windows `bootstrap/cache/config.php` or view cache was deployed. On the server:

```bash
cd /home/devtech/ibntech-core
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan cms:optimize
```

Then remove only the wrongly named directories. Confirm new cache files contain Linux paths under `/home/devtech/ibntech-core` or `/home/ibntech/ibntech-core`.

### Vite manifest not found

`public/build/manifest.json` is missing from `{APP_DIR}/public/build` or was not published to `public_html/build`. Commit a local `npm run build` and redeploy. Do not run `npm` on the server as the normal path.

### The site requests `[::1]:5173` or port 5173

`public/hot` is on the server. Deployment will not remove it. An administrator deletes `public_html/hot` and `ibntech-core/public/hot` by hand. Future deploys exclude `public/hot` and do not copy it back.

### 500 before Laravel logs anything

`bootstrap-path.php` returned the wrong directory, so `vendor/autoload.php` was not found. Check the request host against the map. `www` is mapped for production only. `dev.ibntech.com` is exact.

Also confirm PHP is 8.2 or newer for that domain in MultiPHP Manager. The CLI binary and the web binary can differ. **TO VERIFY ON SERVER.**

### 500 after a successful boot

Read `{APP_DIR}/storage/logs/laravel-*.log` (daily channel). Typical causes: missing `.env`, unreadable `storage` or `bootstrap/cache`, or a config cache that still has Windows paths. Permissions starting point: `775` on `storage` and `bootstrap/cache`.

### Maintenance page will not go away

```bash
cd "$APP_DIR"
"$PHP_BIN" artisan up
```

If Artisan cannot boot, remove `{APP_DIR}/storage/framework/maintenance.php` only.

### Uploaded images disappear after deploy

The sync used `rsync --delete` on `public_html` or on `uploads`. Restore uploads from the media backup. Fix the script so `--delete` is limited to `build/`.

### Admin has no styles, or a Filament page is missing

```bash
cd "$APP_DIR"
"$PHP_BIN" artisan filament:upgrade
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan cms:optimize
"$PHP_BIN" artisan filament:optimize
"$PHP_BIN" artisan filament:cache-components
```

Copy `public/css`, `public/js`, `public/fonts`, and `public/build` to `public_html` again afterward.

### Composer fails on PHP version

`PHP_BIN` is older than 8.2 or is not the binary Composer is using. Run `"$PHP_BIN" "$COMPOSER_BIN" install ...` so Composer and Artisan share one PHP.

### Deploy log says the lock is held

A deploy is running, or a previous run died before `flock` released. Confirm no deploy process is active, then remove the lock file named in that server's config and run again.

### `.env` changed after deploy

That is a failed deploy. `.env` must never be copied, overwritten, deleted, or synced. Restore that server's own `.env` from the administrator's copy for that environment. Do not take it from Git, from the release archive, or from the other environment. Then `optimize:clear` and `cms:optimize` on that server.

### `.htaccess` changed after deploy

That is a failed deploy. Restore the `.htaccess` that belonged on that server before the deploy. Do not replace staging with production, production with staging, or either file with `public/.htaccess` from Git.

### Trailing-slash redirect loop

The live `.htaccess` on that server is stripping slashes while `EnsureTrailingSlash` adds them. Edit only that server's `public_html/.htaccess`. Do not deploy a replacement from Git.

### Two deploys at once

Expected behaviour is a lock refusal. Wait for the first log to finish. Do not delete `ibntech-core` to clear the lock.

---

## 26. Release checklist

### Before pushing `staging`

- [ ] Tests for the change have been run.
- [ ] `npm run build` output is committed when front-end sources changed.
- [ ] `public/hot` is not in the commit.
- [ ] `bootstrap/cache/*.php` is not in the commit.
- [ ] The commit does not add `.env` or `.env.*`. `.env.example` remains tracked.
- [ ] `composer.lock` is updated if PHP dependencies changed.

### Staging deploy

- [ ] `deploy-config.sh` exists only on the server, mode `600`, paths under `/home/devtech`.
- [ ] PHP and Composer binaries were verified on that server.
- [ ] **Update from Remote**, then **Deploy HEAD Commit**.
- [ ] Log shows the staging commit and does not mention a migration.
- [ ] `/home/devtech/ibntech-core/.env` is still present and was not replaced.
- [ ] `/home/devtech/public_html/.htaccess` is still the staging file and was not replaced.
- [ ] `storage/`, `public/hot`, and `public_html/uploads/` were not synced or deleted.
- [ ] Verification section passed on `https://dev.ibntech.com`.
- [ ] Migrations, if any, were run manually after a database backup.

### Production deploy

- [ ] The staging verification above is done for this release.
- [ ] `staging` is merged into `main` and pushed.
- [ ] Production config paths are under `/home/ibntech` only.
- [ ] **Update from Remote**, then **Deploy HEAD Commit** on the production clone.
- [ ] `/home/ibntech/ibntech-core/.env` is still present and was not replaced.
- [ ] `/home/ibntech/public_html/.htaccess` is still the production file and was not replaced.
- [ ] Verification passed on `https://ibntech.com`.
- [ ] Production migrations, if any, were a separate manual step after a production database backup.

---

## 27. Commands this guide does not automate

- Creating the cPanel databases or mailboxes.
- Issuing SSL certificates.
- Changing the document root.
- Copying media between staging and production.
- Running migrations inside `deploy.sh`.
- Seeding an existing CMS database.
- Editing live secrets.

Those stay manual, on the specific server, by an administrator who can see that server's Terminal output.
