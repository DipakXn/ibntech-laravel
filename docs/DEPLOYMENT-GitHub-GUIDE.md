# IBN Technologies — GitHub and cPanel Deployment Guide

Deployment runbook for the IBN Technologies Laravel 12 website.

Local development is Windows with XAMPP. Staging and production are Linux cPanel accounts. Application code and the public document root stay in separate directories. This guide does not change that layout.

Repository facts below were read from this project on 7 October 2026. Anything that cannot be confirmed from the repository is marked **TO VERIFY ON SERVER**.

Related documents:

- `deploy.sh` and `.cpanel.yml` — the deploy that cPanel runs. Both are in the repository root
- `deploy-config.sh.example` — committed template for the server-only config
- `docs/PRODUCTION_DEPLOYMENT.md` — cPanel requirements, cron, and the same directory layout
- `docs/media-uploads-deployment.md` — media disk paths for local, staging, and production
- `docs/media-library-architecture.md` — folder map under the media disk

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

`.gitignore` contains `.env` and `.env.*`, and `!.env.example` keeps `.env.example` tracked. `.env` is not in the Git index. Server `.env` and `.env.*` files are permanently server-only. Deployment must never copy, overwrite, delete, or synchronize them.

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

`rsync --delete` must never target `public_html/` or `public_html/uploads/`. `--delete` is used on the application tree copied into `ibntech-core` (with the exclusion list below) and on the two `build/` directories. It is not used on `css/`, `js/`, `fonts/`, `images/`, or `favicon_io/`.

Do not add `--delete-excluded`. Without that flag, excluded files stay on the destination. With it, a deploy could delete `.env`, `.htaccess`, `storage/`, or `uploads/`.

### Files that still deploy from Git

- Application code into `ibntech-core`
- `public/index.php`
- `public/bootstrap-path.php`
- `public/build/` into both `{APP_DIR}/public/build/` and `public_html/build/`

Other Git-tracked static directories (`css/`, `js/`, `fonts/`, `images/`, `favicon_io/`, `favicon.ico`, and the other `favicon*` files) are copied to both `{APP_DIR}/public/` and `public_html/`. They are not a reason to sync `public_html` as a whole. `public/robots.txt` is excluded from the app rsync and is not copied. The CMS writes that file at runtime.

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

1. `{APP_DIR}/public/` so Laravel's `public_path()` can see `build/manifest.json`, `css/`, `js/`, `fonts/`, `images/`, and `favicon_io/`.
2. `{PUBLIC_DIR}/` so browsers and Apache can request those same files.

`robots.txt` is not part of that dual copy. `WebsiteSettingService::syncRobotsTxt()` writes `public_path('robots.txt')`, which is `{APP_DIR}/public/robots.txt`. Apache serves `{PUBLIC_DIR}/robots.txt`. Deploy does not copy either file.

Uploaded media does not follow that dual copy. On the server it stays only in `public_html/uploads/`, addressed by an absolute `MEDIA_ROOT` in that server's `.env`. Locally, `MEDIA_ROOT=public/uploads` resolves under the project `public/` directory.

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
| `public/hot` | Not tracked. `.gitignore` lists `/public/hot`. A local Vite file may still exist on disk (`http://[::1]:5173`). Must not be deployed |
| `public/uploads/` | Only `public/uploads/.gitignore` is tracked. Upload files are ignored |
| `public/index.php` | Tracked. Loads `bootstrap-path.php`, then the core `vendor/autoload.php` and `bootstrap/app.php` |
| `public/bootstrap-path.php` | Tracked. Host map for local, staging, and production in one file |
| `public/.htaccess` | Tracked in Git. Live staging and production copies differ and are never deployed |
| Other tracked public paths | `css/`, `fonts/`, `images/`, `js/`, `favicon_io/`, `favicon.ico`, `robots.txt` |
| `public/storage` | Present on the local disk, not tracked. Media does not use `storage:link` |
| `.env` | Not tracked. `.gitignore` lists `.env` and `.env.*`. Permanently server-only. Never copied, overwritten, deleted, or synchronized. See [Environment files](#12-environment-files) |
| `.env.example` | Tracked. Safe template. No live passwords |
| `vendor/` | Not tracked. `/vendor` is in `.gitignore`. `deploy.sh` runs `composer install` on the server |
| `node_modules/` | Not tracked. `/node_modules` is in `.gitignore`. The server does not need it |
| `bootstrap/cache/*.php` | Not tracked. `bootstrap/cache/.gitignore` ignores everything except itself |
| `deploy.sh`, `.cpanel.yml` | Tracked in the repository root. Identical on `staging` and `main`. `.cpanel.yml` runs `/bin/bash $PWD/deploy.sh` |
| `deploy-config.sh` | Must not be committed. Template: `deploy-config.sh.example` |
| Cache default | `CACHE_STORE=database` (`config/cache.php`) |
| Session default | `SESSION_DRIVER=database` |
| Queue default | `QUEUE_CONNECTION=database`. Scheduler in `bootstrap/app.php` runs `queue:monitor` every minute when the queue is `database` |
| Optimize command | `php artisan cms:optimize` in `routes/console.php` runs `config:cache`, `route:cache`, and `view:cache` |
| Maintenance | `APP_MAINTENANCE_DRIVER=file` in `.env.example`. `index.php` loads `{core}/storage/framework/maintenance.php` when that file exists |
| Media | Disk `media`. `MEDIA_ROOT` may be relative locally (`public/uploads`) or absolute on cPanel. No symlink required |
| PHP binary on staging | `/usr/local/bin/ea-php84` in the staging `deploy-config.sh`. EasyApache names the binary `ea-phpXX`, not `phpXX` |
| Composer binary on staging | `/home/devtech/composer.phar` |
| PHP and Composer on production | Set in `/home/ibntech/deploy-configs/production/deploy-config.sh`. Confirm that account's EasyApache path before the first `main` deploy |
| cPanel Git clone, staging | `/home/devtech/repositories/ibntech-laravel`, branch `staging`. Not `public_html` and not `ibntech-core` |
| cPanel Git clone, production | Must not be `public_html` or `ibntech-core`. Branch `main`. **TO VERIFY ON SERVER** the directory path |
| Live `public_html/.htaccess` | Different on staging and production. Never replaced by Git |
| Live `robots.txt` | Not part of the deploy copy. Tracked Git file is a local development copy |

`package.json` also depends on Playwright, PDF.js, and `@napi-rs/canvas`. Those are local tooling. They are not part of serving the site. The server does not need Node.js, npm, or those packages when `public/build/` is deployed from Git.

Staging uses `/usr/local/bin/ea-php84` and `/home/devtech/composer.phar`. Production must use the binaries recorded in that account's `deploy-config.sh`. Do not assume the default `php` on the terminal is 8.2 or newer.

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

If the first staging deploy does not start, produces no log, or the site returns 500 after a successful deploy, work through [Appendix A](#appendix-a--deployment-issues-encountered-and-fixes) before changing any part of the script.

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

The repository root already contains this file. Keep the same file on `staging` and `main`.

```yaml
---
deployment:
  tasks:
    - /bin/bash $PWD/deploy.sh
```

`$PWD` is required. A relative `deploy.sh` path does not run, because cPanel does not guarantee that the task starts in the clone root. `deploy.sh` then loads the server-only config, copies code into `ibntech-core`, and publishes web files into both `{APP_DIR}/public/` and `public_html`.

Do not put `/home/devtech` or `/home/ibntech` inside `.cpanel.yml`.

---

## 9. `deploy.sh`

The script is `deploy.sh` in the repository root. It stays identical on both branches. It does the following, in this order.

1. **Detect the account** from `$HOME`.
   - `/home/devtech` loads `/home/devtech/deploy-configs/staging/deploy-config.sh`
   - `/home/ibntech` loads `/home/ibntech/deploy-configs/production/deploy-config.sh`
   - any other home aborts
2. **Load** that config. Abort if a required variable is empty or still `TO_VERIFY_ON_SERVER`.
3. **Validate directories** before changing the site. Rules are in [section 6](#6-server-only-configuration). Confirm `.env` already exists in `APP_DIR`. Confirm `PUBLIC_DIR/uploads` exists. If uploads is missing, stop and ask an administrator to create it. Do not invent an empty uploads tree over a path you have not checked.
4. **Open a log** at `$LOG_DIR/deploy-YYYYMMDD-HHMMSS.log` before the lock, the config checks, and any later failure. Log the environment name, host, commit (`git rev-parse HEAD` inside the clone), `APP_DIR`, and `PUBLIC_DIR`. Do not log `.env` contents.
5. **Take a lock** with `flock -w 30` on `LOCK_FILE`. The lock file stores the deploy PID. A dead PID is removed. A live PID, or a missing or non-numeric PID, is not deleted. A second deploy that still cannot take the lock exits with a log line.
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

   `vendor/` is not in Git. The Linux `composer install` is the only copy that runs. Do not skip Composer.

10. **Publish web files** ([section 10](#10-frontend-assets) and [section 11](#11-uploads)).
11. **Leave server-only files untouched.** Never copy, overwrite, delete, or sync `.env`, `.env.*`, `public/.htaccess`, `storage/`, `public/uploads/`, `public/hot`, `public/robots.txt`, or `bootstrap/cache/*.php`. See [Permanent deployment rules](#permanent-deployment-rules).
12. **Remove Windows runtime cache and rebuild it on Linux** ([Commands the deploy must run on Linux](#commands-the-deploy-must-run-on-linux)).
13. **Bring the site back** with an `EXIT` trap that runs `php artisan up` from `APP_DIR` even when a later command fails.
14. **On failure, roll back** the code and public files from the backup taken in step 6, then leave maintenance mode ([Rollback](#22-rollback)).
15. **Do not** run `php artisan migrate`.
16. **Do not** run destructive database commands.
17. **Check protected paths** still exist: `{APP_DIR}/.env`, `{APP_DIR}/storage`, `{APP_DIR}/storage/app`, `{APP_DIR}/storage/logs`, `{PUBLIC_DIR}/uploads`, and `{PUBLIC_DIR}/.htaccess`. A missing path exits 1. The `EXIT` trap then restores the release archive and runs `artisan up`. An empty `uploads/` directory is a warning, not a failure.

### Exclusions while copying into `APP_DIR`

The sync into `ibntech-core` must exclude:

- `.env` and `.env.*` (do not copy `.env.example` onto the server either)
- `.htaccess` and `public/.htaccess`
- `storage/` (keep the server tree: logs, private files, `storage/app/old-submissions/`, framework runtime)
- `bootstrap/cache/*.php`
- `node_modules/`
- `public/hot`
- `public/uploads/`
- `public/robots.txt`
- `.git/`
- `vendor/`
- `deploy-config.sh`
- `.idea/`
- `.vscode/`

Do not delete `bootstrap/` itself. Do not delete `storage/` itself. Do not delete `public/hot` as part of deploy; exclude it so it is neither copied nor removed. The reference script uses `rsync --delete` only for the application tree and for `build/`. That application-tree delete is safe only while the exclusions above are present and `--delete-excluded` is absent. `rsync` does not delete excluded destination files unless `--delete-excluded` is set. Never add that flag. Never point `rsync --delete` at `public_html/`.

Linux cache rebuild may delete generated files inside `bootstrap/cache/` and `storage/framework/views` after the sync, then recreate them on the server. That is not a copy from Git. It does not delete the `bootstrap` or `storage` directories, and it does not delete `storage/app`.

### `EXIT` trap

```bash
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
```

The trap is the mechanism that returns the site to visitors. Do not rely on a final `artisan up` that is skipped when `set -e` aborts the script.

### Reference script

The script cPanel runs is the repository file `deploy.sh`. This guide does not keep a second copy.

The app sync copies `$SOURCE_DIR/` into `$APP_DIR/` only:

```bash
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
```

Web files are then published to both `{APP_DIR}/public/` and `{PUBLIC_DIR}/`:

- `build/` with `rsync -a --delete`
- `css/`, `js/`, `fonts/`, `images/`, `favicon_io/` with `rsync -a` and no `--delete`
- `favicon.ico` and the other `favicon*` files with `cp -f`
- `index.php` and `bootstrap-path.php` with `cp -f`

`robots.txt` is not in that list. `publish_static_public()` still copies `css/`, `js/`, `fonts/`, `images/`, and `favicon_io/` from `{APP_DIR}/public/` to `public_html/` after `filament:upgrade`.

After `queue:restart`, the script checks that these paths still exist:

- `$APP_DIR/.env`
- `$APP_DIR/storage`
- `$APP_DIR/storage/app`
- `$APP_DIR/storage/logs`
- `$PUBLIC_DIR/uploads`
- `$PUBLIC_DIR/.htaccess`

A missing path exits 1. The `EXIT` trap then restores the release archive and runs `artisan up`. An empty `uploads/` directory is logged as a warning and does not fail the deploy. The log ends with `Code deployment complete. Database migrations were not run.`
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

`.env.*` is under the same rule. `.env.example` remains tracked and must not be copied over a server `.env`. `.gitignore` matches `.env`. The index does not list `.env`.

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

`public/robots.txt` is tracked. The committed file is a local development copy. Deploy excludes `public/robots.txt` from the app rsync and does not `cp` it to `{APP_DIR}/public/` or `public_html/`. There is no `robots.txt.deploy-preserve` marker.

`App\Services\WebsiteSettingService::syncRobotsTxt()` writes `public_path('robots.txt')`, which is `{APP_DIR}/public/robots.txt`. Apache serves `{PUBLIC_DIR}/robots.txt`. Those are different files. A CMS save updates the core copy. It does not by itself update `public_html/robots.txt`. Do not replace one environment's file with the other's.

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
| `{APP_DIR}/public/robots.txt` and `{PUBLIC_DIR}/robots.txt` | CMS-owned. Not copied from Git |
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
| `node_modules/` | Not required on the server. Not tracked |
| `public/hot` | Vite dev-server marker. Excluded from every sync |
| `bootstrap/cache/*.php` from Git or Windows | Breaks Linux paths. Rebuilt on the server |
| `public/uploads/*` from Git | Would replace live media. Git has no media files |
| `storage/` | Server runtime and private files. Not synced |
| `public/robots.txt` | Tracked local development copy. Not copied to either public directory |
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

On shared hosting without SSH, the cron-job method in [Appendix A.8](#a8--site-returned-http-500-after-deploy-missing-database-table) is the most reliable way to run migrations. Always delete the cron job after the migration log shows success.

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

These paths are not in the Git index. `.gitignore` keeps them out. Do not add them back.

| Path | Rule |
|---|---|
| `.env`, `.env.*` | Server-only. `.env.example` stays tracked |
| `/vendor` | Built on the server by `composer install` |
| `/node_modules` | Not used on the server |
| `/public/hot` | Local Vite marker. A file may still exist on a developer machine |
| `/public/uploads/*` | CMS media. `public/uploads/.gitignore` stays tracked |
| `/storage/media-library/` | Spatie temporary conversions |
| `/storage/public/` | Not a disk this application writes. Do not commit files here |
| `/storage/app/old-submissions/**` | Private CSV imports. The directory's `.gitignore` stays tracked |
| `/deploy-config.sh` | Server-only. Commit `deploy-config.sh.example` only |

`deploy.sh` excludes `.env`, `.env.*`, `node_modules/`, `vendor/`, `public/hot`, `public/uploads/`, `public/robots.txt`, `storage/`, and `bootstrap/cache/*.php`. Excluding `.env` does not change the server file. Composer on the server is what builds `vendor/`.

---

## 25. Troubleshooting

The initial staging setup exposed several issues that are not obvious from the runtime troubleshooting alone. See [Appendix A](#appendix-a--deployment-issues-encountered-and-fixes) for the full list, root causes, and fixes.

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

---

## Appendix A — Deployment issues encountered and fixes

Record of the first staging setup. Apply the same checks on production before the first `main` deploy.

### A.1 — cPanel clone created on `main`, not `staging`

**Symptom** — The staging repository showed "Currently Checked-Out Branch: main". A deploy from that checkout would have published `main` onto `dev.ibntech.com`.

**Root cause** — cPanel Git Version Control does not reliably clone a chosen branch from a `#branch` suffix on the Clone URL. The clone uses the repository default branch.

**Diagnostic** — In the clone directory:

```bash
git rev-parse --abbrev-ref HEAD
```

The cPanel repository page also shows "Currently Checked-Out Branch".

**Fix** — Create the cPanel repository without a `#branch` suffix. Switch the checked-out branch to `staging` in the cPanel UI. If the UI will not switch it, delete the clone and create it again, then confirm the branch before **Deploy HEAD Commit**. The production clone stays on `main`.

### A.2 — Deploy HEAD Commit did nothing

**Symptom** — **Deploy HEAD Commit** changed nothing. "Last Deployment Information" stayed "Last Deployed on: Not available." No file appeared in `/home/devtech/deploy-logs/`.

**Root cause** — Two separate failures.

1. `.cpanel.yml` invoked `/bin/bash deploy.sh` with a relative path. cPanel does not guarantee that deployment tasks start in the repository root. When `deploy.sh` was not found, cPanel recorded no deployment.
2. After that path was fixed, `deploy.sh` took the lock before it opened the log. A lock left by an earlier failed run made the script exit before any log line was written.

**Diagnostic** — "Last Deployed on" remained "Not available." `/home/devtech/deploy-logs/` stayed empty. After logging was moved first, the next failure appeared in that directory.

**Fix** —

1. Invoke the script from `$PWD`:

```yaml
---
deployment:
  tasks:
    - /bin/sed -i 's/\r$//' $PWD/deploy.sh
    - /bin/bash $PWD/deploy.sh
```

The `sed` task strips a Windows CRLF ending from `deploy.sh` before bash reads it.

2. Open the log file before any check, lock, or validation. Each later `die` appends to that log and to stderr. Take the lock only after logging is running.
3. Replace immediate `flock -n` with `flock -w "$LOCK_WAIT_SECONDS"` so a short overlap waits instead of failing at once.
4. After the lock is acquired, write the deploy PID into the lock file. On the next run, if `kill -0` shows that PID is dead, remove the lock and continue. If the PID is missing, non-numeric, or its liveness is uncertain, do not delete the lock. Exit with a log line that names the file.

Until this order was in place, a failed deploy left no log.

### A.3 — `/usr/local/bin/php84` does not exist

**Symptom** — The deploy log ended with `PHP was not found at: /usr/local/bin/php84`.

**Root cause** — cPanel EasyApache names the binary `ea-phpXX`, not `phpXX`. The path in `deploy-config.sh` was wrong.

**Diagnostic** — A temporary `check-paths.php` in `public_html/` tested each candidate with `file_exists()` and `is_executable()`. Delete that file after the check. See [A.9](#a9--diagnostic-helper-scripts).

**Fix** — Set `PHP_BIN` in the server-only `deploy-config.sh`. On this host:

```bash
PHP_BIN="/usr/local/bin/ea-php84"
```

### A.4 — Composer is not installed on the shared host

**Symptom** — After `PHP_BIN` was corrected, the deploy log ended with `Composer was not found at: /home/devtech/composer.phar`.

**Root cause** — The shared host does not provide Composer. `shell_exec()` is disabled, so the usual `php -r "copy(...)"` installer cannot be run from the deploy script.

**Diagnostic** — The deploy log named the missing `COMPOSER_BIN` path. A one-time `install-composer.php` in `public_html/` printed which download method succeeded.

**Fix** — Place `install-composer.php` in `public_html/` once. It must:

- Try `copy()` first.
- Fall back to `curl` if `copy()` fails.
- Fall back to `include` of the installer if `shell_exec` is disabled.
- Print the result in the browser.
- Be deleted from `public_html/` as soon as it succeeds.

That run installed `/home/devtech/composer.phar`. Set `COMPOSER_BIN` in `deploy-config.sh` to that path.

Do not install Composer from a cPanel cron that calls `copy('https://...')`. CLI PHP on this host has `allow_url_fopen` disabled, so that copy fails without a useful error. Use the web script when SSH is unavailable.

### A.5 — Deploy lock held by a previous failed run

**Symptom** — After the path, PHP, and Composer fixes, the deploy exited with `Another deployment holds /home/devtech/deploy-configs/staging/deploy.lock`. Before logging was reordered, the same condition exited with no message and no log.

**Root cause** — A failed deploy left the lock file on disk. Linux releases `flock` when the process exits, but the file remains. The next deploy tried to take the same lock and stopped.

**Diagnostic** — The log line names `/home/devtech/deploy-configs/staging/deploy.lock`. If no log exists, the script still exited before the log was opened (see [A.2](#a2--deploy-head-commit-did-nothing)).

**Fix** — In `deploy.sh`:

1. Acquire the lock with `flock -w 30`.
2. Write the acquiring PID into the lock file. Before the next acquire, read that PID and run `kill -0`. If the process is dead, remove the lock file and continue. If the process is alive, stop and log the PID. If the PID is missing, empty, or non-numeric, do not delete the lock. Exit with a log line that says why.

### A.6 — CRLF in `deploy-config.sh` broke variable values

**Symptom** — The first deploy that reached `source` logged:

```text
.../deploy-config.sh: line 4: $'\r': command not found
.../deploy-config.sh: line 7: $'\r': command not found
Staging config APP_DIR is not /home/devtech/ibntech-core
```

**Root cause** — `deploy-config.sh` was saved on Windows with CRLF endings. Bash kept the trailing `\r` on each value, so `APP_DIR` was `/home/devtech/ibntech-core\r`.

**Diagnostic** — The `$'\r': command not found` lines identify the config file. The following equality failure names `APP_DIR`.

**Fix** —

1. Recreate `deploy-config.sh` in cPanel File Manager so the editor writes LF. Do not paste it from a Windows editor.
2. Strip CRLF in `deploy.sh` immediately before `source "$CONFIG_FILE"`:

```bash
if [ -w "$CONFIG_FILE" ]; then
  if ! /bin/sed -i 's/\r$//' "$CONFIG_FILE"; then
    echo "WARNING: could not strip CRLF from $CONFIG_FILE"
  fi
fi
```

A later run on an LF file does not change it. If the file is not writable, log a warning and continue.

3. `.cpanel.yml` runs `/bin/sed -i 's/\r$//' $PWD/deploy.sh` before bash, so a Windows-saved `deploy.sh` does not break the task.

### A.7 — Web assets reached `public_html/` and not `{APP_DIR}/public/`

**Symptom** — The deploy finished and the site responded, but some pages and admin views kept stale assets. File Manager showed new timestamps under `public_html/build/`, `css/`, `js/`, `fonts/`, `images/`, and `favicon_io/`. The same paths under `ibntech-core/public/` were older.

**Root cause** — The publish block wrote compiled assets only to `$PUBLIC_DIR`. It did not write them to `$APP_DIR/public/`. `public_path()` is `{APP_DIR}/public`, so a read of `public_path('build/manifest.json')` could see an old manifest. `filament:upgrade` writes into `{APP_DIR}/public/`, and `publish_static_public()` then copies that output to `$PUBLIC_DIR`. The earlier static set (`build/`, `css/`, `js/`, `fonts/`, `images/`, `favicon_io/`, and the tracked static files) was not written to `{APP_DIR}/public/` in that same pass.

**Diagnostic** — Compare mtimes of `public_html/build/manifest.json` and `{APP_DIR}/public/build/manifest.json`.

**Fix** — Publish each static asset to both `$APP_DIR/public/` and `$PUBLIC_DIR/`:

- `build/` — `rsync -a --delete` to both destinations
- `css/`, `js/`, `fonts/`, `images/`, `favicon_io/` — `rsync -a` to both
- `favicon.ico` and the other favicon files — `cp -f` to both

`robots.txt` was in that copy list when this fix was applied. The current `deploy.sh` does not copy it. See [robots.txt](#robotstxt).

Leave the post-`filament:upgrade` `publish_static_public()` call in place. It copies the new Filament files from `{APP_DIR}/public/` to `$PUBLIC_DIR/`.

Keep `--delete` on `build/` only. Do not point it at `public_html/`, `public_html/uploads/`, or the rest of the application tree.

### A.8 — Site returned HTTP 500 after deploy: missing database table

**Symptom** — The deploy log ended with `Code deployment complete. Database migrations were not run.` The host answered, and every public request returned HTTP 500. The response was the framework error page.

**Root cause** — `deploy.sh` does not run migrations. Migration files in the release had not been applied on the staging database. The first request queried a table that was not there.

**Diagnostic** — Read `{APP_DIR}/storage/logs/laravel-YYYY-MM-DD.log`. The staging failure was:

```text
[YYYY-MM-DD HH:MM:SS] local.ERROR: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'devtech_ibntech_laravel_12.analytics_excluded_ips' doesn't exist (Connection: mysql, Host: 127.0.0.1, Port: 3306, Database: devtech_ibntech_laravel_12, SQL: select `ip_address` from `analytics_excluded_ips` where `is_enabled` = 1 order by `id` asc)
```

The exception came from `App\Services\Analytics\ExcludedIpMatcher::rules()`, called by `App\Http\Middleware\TrackPublicPageView`. `public_html/` has no copy of this log.

**Fix** — After the code deploy is verified, run migrations for that environment only. On a host without SSH, use one of these methods. Prefer them in this order.

**Way 1 — cPanel Cron Job (one-time)**

Used on staging. No SSH and no route change. The job runs once and writes a log. Delete it as soon as that log shows the migration output.

In cPanel → Cron Jobs → Add New Cron Job:

- Common Settings: `Once Per Minute (* * * * *)`. Delete the cron as soon as it has run.
- Command (staging, PHP 8.4 EasyApache):

```bash
/usr/local/bin/ea-php84 /home/devtech/ibntech-core/artisan migrate --force >> /home/devtech/deploy-logs/migrate-staging.log 2>&1
```

- Command (production, same host layout, different account):

```bash
/usr/local/bin/ea-php84 /home/ibntech/ibntech-core/artisan migrate --force >> /home/ibntech/deploy-logs/migrate-production.log 2>&1
```

If `deploy-config.sh` records a different `PHP_BIN`, use that path instead of `/usr/local/bin/ea-php84`.

Do not leave the cron in place. A leftover job runs migrations every minute.

**Way 2 — Temporary secret web route**

Use this only when the route is already in the deployed code and checks a token. Add `DEPLOY_MIGRATE_TOKEN` (a random string, 40–80 characters) to the server `.env` only. Visit:

```text
https://dev.ibntech.com/deploy/migrate/YOUR_TOKEN/
```

The route reads the token from `.env` on the request, compares it with the URL, and calls `Artisan::call('migrate', ['--force' => true])`. The response is the migration output as plain text. Remove the token from `.env` immediately afterward. Do not ship the route without that check. An open `migrate` URL can take over the site.

**Way 3 — One-time PHP file in `public_html/`**

Last resort. Put `run-migrate.php` in `public_html/`, require a query-string secret, and run:

```php
exec("$PHP_BIN $APP_DIR/artisan migrate --force 2>&1")
```

Print the output. Delete the file immediately after. Do not leave it in the document root.

**Verification**

- Reload the site. Pages must render.
- `{APP_DIR}/storage/logs/laravel-*.log` must not gain new `42S02` lines.
- `/admin` must render with its styles.

The deploy log is supposed to end with:

```text
Code deployment complete. Database migrations were not run.
```

That line is intentional. Migrations stay outside `deploy.sh`.

### A.9 — Diagnostic helper scripts

**Symptom** — None. This records the temporary tools used during setup.

**Root cause** — SSH was not available, so path checks and the Composer install had to run from the document root.

**Diagnostic** — `check-paths.php` tested PHP binary candidates. `install-composer.php` installed Composer. Both lived in `public_html/` only for that check.

**Fix** — Delete both files as soon as they succeed. Remove any later one-time script from `public_html/` before calling the deploy finished. A diagnostic script left on the public site is a security exposure.
