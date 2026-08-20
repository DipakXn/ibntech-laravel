# IBN Technologies — Production & Staging Deployment Guide (cPanel)

Comprehensive, step-by-step production deployment documentation for the **IBN Technologies Laravel CMS Platform**. This guide details how to deploy, configure, secure, and maintain the application in a cPanel hosting environment for both **Main Domain** (`production`) and **Staging Subdomain** (`staging`).

Related media-focused guides:

- [`docs/media-uploads-deployment.md`](media-uploads-deployment.md) — environment-specific `MEDIA_*` setup
- [`docs/media-library-architecture.md`](media-library-architecture.md) — disk layout, path map, and migration options

---

## Table of Contents

1. [System Requirements & Architecture Overview](#1-system-requirements--architecture-overview)
2. [cPanel Deployment Architecture Options](#2-cpanel-deployment-architecture-options)
3. [Environment Configuration (`.env`)](#3-environment-configuration-env)
4. [Pre-Deployment Local Preparation](#4-pre-deployment-local-preparation)
5. [Step-by-Step Deployment Instructions](#5-step-by-step-deployment-instructions)
   - [Step 1: Database Setup in cPanel](#step-1-database-setup-in-cpanel)
   - [Step 2: File Upload & Directory Placement](#step-2-file-upload--directory-placement)
   - [Step 3: Environment Setup & Encryption Key](#step-3-environment-setup--encryption-key)
   - [Step 4: Database Migrations & Initial Seeding](#step-4-database-migrations--initial-seeding)
   - [Step 5: Media Storage Setup & Migration](#step-5-media-storage-setup--migration)
   - [Step 6: File & Directory Permissions](#step-6-file--directory-permissions)
   - [Step 7: Framework Cache & Asset Optimization](#step-7-framework-cache--asset-optimization)
6. [Staging Environment Setup](#6-staging-environment-setup)
7. [Automating Background Tasks & Queues in cPanel](#7-automating-background-tasks--queues-in-cpanel)
   - [Laravel Scheduler (Cron Job)](#laravel-scheduler-cron-job)
   - [Queue Worker Management](#queue-worker-management)
8. [Post-Deployment Verification Protocol](#8-post-deployment-verification-protocol)
9. [Troubleshooting & Common Deployment Issues](#9-troubleshooting--common-deployment-issues)
10. [Production Deployment Checklist](#10-production-deployment-checklist)
11. [Future Updates, Maintenance & Backups](#11-future-updates-maintenance--backups)

---

## 1. System Requirements & Architecture Overview

Before deploying, ensure the target cPanel server meets the following software requirements:

### Server Requirements

| Component | Minimum Version | Recommended Version | Notes |
|---|---|---|---|
| **PHP** | `8.2.0` | `8.3.x` | Required for Laravel 12, Filament v5, Livewire v4 |
| **MySQL / MariaDB** | `8.0+` / `10.6+` | MySQL `8.0+` | InnoDB engine with `utf8mb4` support |
| **Web Server** | Apache `2.4+` / Nginx | Apache with `mod_rewrite` | Enabled `mod_deflate`, `mod_expires`, `mod_headers` |
| **SSL Certificate** | TLS 1.2+ | AutoSSL / Let's Encrypt | HTTPS mandatory for forms, sessions, and canonical URLs |
| **Node.js** *(Local Build)* | `18.x` | `20.x+` | Assets are pre-compiled locally via Vite |
| **Composer** | `2.6+` | `2.7+` | Production dependencies installed via `--no-dev` |

### Required PHP Extensions

Ensure the following PHP extensions are enabled in cPanel (**PHP Select** or **MultiPHP Manager**):

- `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `gd` or `imagick` (required for Spatie Media Library image conversions), `intl` (required for E.164 phone validation / `intl-tel-input` workflows), `json`, `libxml`, `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `tokenizer`, `xml`, `zip`.

### Core Application Characteristics

- **Framework**: Laravel 12.x
- **Admin Panel**: Filament v5 served at `/admin` (IBNTECH Control branding)
- **Frontend Stack**: Vite, Tailwind CSS v4, Alpine.js (via Livewire), `intl-tel-input`
- **Livewire**: v4 form components for contact, lead, newsletter, and gated downloads
- **Media Management**: Spatie Media Library using dedicated `media` disk (`MEDIA_ROOT` / `MEDIA_URL`), eliminating `storage:link` symlink dependency for uploads
- **Path Bootstrapping**: Dynamic base path resolver (`public/bootstrap-path.php`) for Local, Staging, and Production document-root separation
- **SEO & Canonical URLs**: Trailing slash enforcement (`EnsureTrailingSlash` middleware) on public routes
- **Asynchronous Mail**: Database queue (`QUEUE_CONNECTION=database`) for lead notification emails
- **Database Caching & Sessions**: `CACHE_STORE=database` and `SESSION_DRIVER=database` by default
- **Observability**: Laravel Telescope (disable or tightly gate in production), Filament Queue Monitor & Log Viewer

---

## 2. cPanel Deployment Architecture Options

By default, cPanel assigns `public_html` as the web root for the primary domain. Hosting a Laravel application directly inside `public_html` without separating sensitive core files creates security risks (exposing `.env`, `storage/logs`, and source code).

Choose one of the two recommended architecture options below.

> Replace `USER` with your cPanel username, and adjust hostnames (`ibntech.com`, `dev.ibntech.com`) to match the live DNS configuration.

### Architecture A: Secure Core Separation (RECOMMENDED)

Core application files are placed **above** `public_html` in a private directory, and only the contents of Laravel's `public/` folder are placed inside `public_html`.

```
/home/USER/
├── ibntech/                          <-- Core Production Laravel Files (NOT web-accessible)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── .env
│
├── ibntech-staging/                  <-- Core Staging Laravel Files (NOT web-accessible)
│   └── ...
│
└── public_html/                      <-- Document Root (Web-accessible)
    ├── build/                        <-- Vite output assets (manifest.json, CSS, JS)
    ├── favicon_io/                   <-- Favicon package
    ├── uploads/                      <-- Direct Media Root (MEDIA_ROOT)
    ├── web-img/                      <-- Static marketing / error images (if used)
    ├── .htaccess                     <-- Rewrite & cache control
    ├── bootstrap-path.php            <-- Dynamic Base Path Resolver
    ├── index.php                     <-- Clean Entry Point (uses bootstrap-path.php)
    ├── robots.txt                    <-- Managed via Website Settings (optional overwrite)
    └── favicon.ico
```

> [!TIP]
> This structure guarantees that sensitive configuration files (including `.env`) are physically located outside the web root and cannot be accessed via a web browser. With `bootstrap-path.php`, `index.php` does not need hardcoded path edits per environment — only the host → path map in `bootstrap-path.php` must match your server layout.

### Architecture B: Custom Document Root (cPanel Domains Manager)

If your cPanel account permits changing the Document Root for the main domain or subdomain (available under **Domains** in modern cPanel installations):

1. Upload the entire Laravel codebase to `/home/USER/ibntech`.
2. Change the Document Root of the domain to `/home/USER/ibntech/public`.
3. Set `MEDIA_ROOT` to the absolute path of that public uploads directory (e.g. `/home/USER/ibntech/public/uploads`).

Architecture B is simpler operationally; Architecture A is preferred when the primary domain Document Root cannot leave `public_html`.

---

## 3. Environment Configuration (`.env`)

Create a production `.env` file based on `.env.example`. Replace placeholders with actual production credentials.

### Production `.env` Template

```env
APP_NAME="IBN Technologies"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://ibntech.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

LOG_CHANNEL=daily
LOG_STACK=daily
LOG_LEVEL=error
LOG_DAILY_DAYS=14

DEBUGBAR_ENABLED=false
TELESCOPE_ENABLED=false

# Database Configuration (cPanel MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cpaneluser_ibntech
DB_USERNAME=cpaneluser_ibnuser
DB_PASSWORD=SecureProductionPassword123!

# Session & Cache (Database-backed for stability on shared hosting)
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_PATH=/
SESSION_DOMAIN=ibntech.com

FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
QUEUE_FAILED_DRIVER=database-uuids
QUEUE_MONITOR_MAX=100
CACHE_STORE=database

# Dedicated Spatie Media Library Disk (no storage:link required)
MEDIA_DISK=media
MEDIA_ROOT=/home/USER/public_html/uploads
MEDIA_URL=/uploads
# MEDIA_PREFIX=
# MEDIA_FALLBACK_PATH=media/miscellaneous/{YYYY}/{MM}
# MEDIA_QUEUE=media
# MEDIA_QUEUE_CONNECTION=database

# SMTP Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=mail.ibntech.com
MAIL_PORT=465
MAIL_USERNAME=notifications@ibntech.com
MAIL_PASSWORD=YourMailPasswordHere
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="notifications@ibntech.com"
MAIL_FROM_NAME="IBN Technologies"

# Lead notification destination (Contact, Lead, Newsletter, gated downloads)
MAIL_LEAD_NOTIFICATION_TO="sales@ibntech.com"

# Google reCAPTCHA v2 (Production Keys)
RECAPTCHA_SITE_KEY=6Lxxxxxx_YOUR_PRODUCTION_SITE_KEY
RECAPTCHA_SECRET_KEY=6Lxxxxxx_YOUR_PRODUCTION_SECRET_KEY

# Vite App Name
VITE_APP_NAME="${APP_NAME}"
```

### Media PATH `.env` Setup by Environment

To eliminate `storage:link` dependencies and store uploads directly in the webserver directory across environments, set `MEDIA_ROOT` in each environment's `.env`:

#### 1. Local Development
```env
MEDIA_DISK=media
MEDIA_ROOT=public/uploads
MEDIA_URL=/uploads
```

*(Windows absolute path example, if preferred: `MEDIA_ROOT=C:\path\to\ibntech-laravel\public\uploads`)*

#### 2. Staging Environment
```env
MEDIA_DISK=media
MEDIA_ROOT=/home/USER/public_html/dev/uploads
MEDIA_URL=/uploads
```

#### 3. Production Environment
```env
MEDIA_DISK=media
MEDIA_ROOT=/home/USER/public_html/uploads
MEDIA_URL=/uploads
```

`MEDIA_ROOT` may be:

- **Relative** to the Laravel base path (`public/uploads`) — convenient locally
- **Absolute** on the server — **recommended on cPanel** when the document root is not the Laravel `public/` folder

> [!IMPORTANT]
> `MAIL_LEAD_NOTIFICATION_TO` is required for async lead emails (`SendLeadSubmissionNotification`). Contact, Lead, Newsletter Inquiry, eBook download, and Case Study download notifications will not reach your team if this variable is missing or incorrect.

> [!WARNING]
> Never set `APP_DEBUG=true` in production. Debug mode can expose database passwords, API keys, and stack traces to visitors during errors. Also keep `DEBUGBAR_ENABLED=false` and `TELESCOPE_ENABLED=false` (or tightly gate Telescope) on production.

### Optional: Redis (VPS / Dedicated)

When Redis is available, prefer it for cache, queue, and sessions:

```env
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Optional: Cloud Media (S3 / R2 / Spaces)

For multi-server or CDN setups:

```env
MEDIA_DISK=s3
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=...
AWS_USE_PATH_STYLE_ENDPOINT=false
```

No application code changes are required when media collections resolve the disk through `config('media-library.disk_name')`.

---

## 4. Pre-Deployment Local Preparation

Compile frontend assets and prepare vendor dependencies on your local development machine or CI/CD runner before uploading.

### 1. Execute Fresh Asset Build

```bash
# Clean previous build artifacts
rm -rf public/build

# Install Node dependencies
npm ci

# Build optimized production assets
npm run build
```

*Verify that `public/build/manifest.json` and compiled assets in `public/build/assets/` exist. Filament admin theme assets are compiled via Vite (`resources/css/filament/admin/theme.css`).*

### 2. Install Production PHP Dependencies

```bash
# Install PHP packages without development tools
composer install --no-dev --optimize-autoloader
```

### 3. Create Deployment Archive

Compress the project into a `.zip` archive for upload.

**Exclude the following from the zip:**

- `node_modules/`
- `.git/`
- `.github/`
- `tests/`
- `.env` *(create on the target server)*
- `storage/logs/*.log`
- `storage/framework/cache/data/*` (optional; regenerated on server)
- Local debug artifacts (`storage/debugbar/`, etc.)

**Always include:**

- `vendor/` *(if you cannot run Composer on the server)*
- `public/build/` *(required — Vite production assets)*
- `public/uploads/.gitignore` *(directory scaffolding; do not wipe existing production uploads on update)*

---

## 5. Step-by-Step Deployment Instructions

### Step 1: Database Setup in cPanel

1. Log into your cPanel account.
2. Navigate to **MySQL® Databases** (or **MySQL® Database Wizard**).
3. Create a new database (e.g., `cpaneluser_ibntech`).
4. Create a new database user (e.g., `cpaneluser_ibnuser`) with a strong, random password.
5. Add the user to the database and grant **ALL PRIVILEGES**.
6. Ensure the database collation is set to `utf8mb4_unicode_ci` or `utf8mb4_0900_ai_ci`.

---

### Step 2: File Upload & Directory Placement

#### 1. Upload & Extract Core Code

- Open cPanel **File Manager**.
- Navigate to your home directory (`/home/USER/`).
- Upload the deployment archive.
- Extract the archive to `/home/USER/ibntech/`.

#### 2. Move Public Assets to `public_html`

- Go inside `/home/USER/ibntech/public/`.
- Select **ALL** files and folders (including hidden files like `.htaccess`).
- Move/copy them into `/home/USER/public_html/`.

> [!CAUTION]
> On subsequent deploys, **do not overwrite** or delete `public_html/uploads/` — that directory contains live media. Sync only code and `build/` assets unless you intentionally restore media from backup.

#### 3. Base Path Resolver (`bootstrap-path.php`) & `index.php`

`public/bootstrap-path.php` resolves the Laravel core directory from the request host so `index.php` stays environment-agnostic.

**Configure host → path mappings for this project before go-live.** Example for IBN Technologies:

```php
<?php

/*
|--------------------------------------------------------------------------
| Laravel Base Path Resolver
|--------------------------------------------------------------------------
|
| This file determines the Laravel application root based on the current
| environment. No changes are required to index.php.
|
*/

$host = $_SERVER['HTTP_HOST'] ?? '';

return match (true) {

    // Local Development
    str_contains($host, 'localhost'),
    str_contains($host, '127.0.0.1') =>
        dirname(__DIR__),

    // Staging
    $host === 'dev.ibntech.com' =>
        '/home/USER/ibntech-staging',

    // Production
    $host === 'ibntech.com' ||
    $host === 'www.ibntech.com' =>
        '/home/USER/ibntech',

    // Fallback
    default =>
        dirname(__DIR__),
};
```

**`public/index.php`** (shipped with the project — no per-environment edits required):

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$laravelPath = require __DIR__ . '/bootstrap-path.php';

if (file_exists($maintenance = $laravelPath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $laravelPath . '/vendor/autoload.php';

$app = require_once $laravelPath . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

> [!IMPORTANT]
> Confirm that the hostnames and absolute paths in `bootstrap-path.php` match your real cPanel account and DNS. Incorrect mappings produce missing `vendor/autoload.php` / blank 500 responses.

#### 4. Trailing Slash Compatibility (`.htaccess`)

The application enforces trailing slashes via `EnsureTrailingSlash` middleware (301). Laravel’s default `public/.htaccess` *removes* trailing slashes for non-directories, which can conflict on some hosts.

For production document roots using Architecture A, prefer rewrite rules that **do not strip** trailing slashes from application routes, and that exclude static asset paths. Example Apache rules (adapt as needed; keep Authorization / XSRF header handling from the project `.htaccess`):

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Handle X-XSRF-Token Header
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Optional: legacy /storage media URLs → /uploads (transition period)
    RewriteRule ^storage/(.*)$ /uploads/$1 [L,R=301]

    # Enforce trailing slash for app routes (exclude real files/dirs & known assets)
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_METHOD} GET
    RewriteCond %{REQUEST_URI} !(.*)/$
    RewriteCond %{REQUEST_URI} !(.*)uploads
    RewriteCond %{REQUEST_URI} !(.*)build
    RewriteCond %{REQUEST_URI} !(.*)assets
    RewriteCond %{REQUEST_URI} !(.*)favicon_io
    RewriteCond %{REQUEST_URI} !(.*)admin
    RewriteCond %{REQUEST_URI} !(.*)livewire
    RewriteCond %{REQUEST_URI} !(.*)telescope
    RewriteCond %{REQUEST_URI} !^/robots\.txt$
    RewriteCond %{REQUEST_URI} !^/favicon\.ico$
    RewriteCond %{REQUEST_URI} !^/up$
    RewriteCond %{REQUEST_URI} !\.(.[a-zA-Z0-9]+)$
    RewriteRule ^(.*)$ %{REQUEST_URI}/ [L,R=301]

    # Front controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

### Step 3: Environment Setup & Encryption Key

1. Inside `/home/USER/ibntech/`, create a `.env` file.
2. Paste the production configuration from [Section 3](#3-environment-configuration-env).
3. Open cPanel **Terminal** (or connect via SSH) and generate a secure `APP_KEY`:

```bash
cd /home/USER/ibntech
php artisan key:generate
```

---

### Step 4: Database Migrations & Initial Seeding

Run database migrations and seed the default users, website settings, and demo CMS content (first install only — or seed selectively on empty databases):

```bash
cd /home/USER/ibntech

# Run migrations in production mode
php artisan migrate --force

# Seed initial admin/author users, website settings, and demo CMS content
php artisan db:seed --force
```

> [!NOTE]
> Default accounts created by `DatabaseSeeder`:
>
> | Role | Email | Password |
> |---|---|---|
> | Administrator | `admin@example.com` | `password` |
> | Author | `author@example.com` | `password` |
>
> **Change these passwords immediately** after first login at `/admin`. Prefer creating production users with real emails before go-live and disabling or deleting demo accounts.

> [!TIP]
> On an existing production database that already has content, run **only** `php artisan migrate --force`. Do **not** re-seed `CmsDemoSeeder` unless you intentionally want demo content.

---

### Step 5: Media Storage Setup & Migration

Spatie Media Library stores uploaded media (featured images, OG images, logos, PDFs for case studies/ebooks, content-block images) under `MEDIA_ROOT` (e.g. `/home/USER/public_html/uploads`).

**No symbolic links (`php artisan storage:link`) are required for media serving.** Apache/Nginx serves files directly from the uploads directory.

#### Ensure uploads directory exists

```bash
mkdir -p /home/USER/public_html/uploads
chmod 755 /home/USER/public_html/uploads
```

#### Migrating existing legacy media

If migrating from an installation that used `storage/app/public` (legacy `public` disk):

```bash
cd /home/USER/ibntech

# Preview changes
php artisan media:migrate-to-uploads-disk --dry-run

# Copy files and update media.disk columns
php artisan media:migrate-to-uploads-disk

# Optional: move into purpose-based folders (blogs/featured, logos, seo, etc.)
php artisan media:migrate-to-uploads-disk --reorganize
```

This command:

1. Copies media files from the source disk (default `public`) to the target media disk.
2. Updates `disk` / related columns on Spatie `media` records.
3. Optionally reorganizes into the purpose-based layout described in `docs/media-library-architecture.md`.

After migration, rebuild config cache so `MEDIA_*` values are active:

```bash
php artisan config:cache
```

---

### Step 6: File & Directory Permissions

Incorrect file permissions will trigger `500 Internal Server Error` or prevent uploads. Set permissions as follows:

```bash
# Directories set to 755
find /home/USER/ibntech -type d -exec chmod 755 {} \;
find /home/USER/public_html -type d -exec chmod 755 {} \;

# Files set to 644
find /home/USER/ibntech -type f -exec chmod 644 {} \;
find /home/USER/public_html -type f -exec chmod 644 {} \;

# Storage and Bootstrap Cache must be writable by the web server
chmod -R 775 /home/USER/ibntech/storage
chmod -R 775 /home/USER/ibntech/bootstrap/cache

# Uploads must be writable for Filament / Spatie uploads
chmod -R 775 /home/USER/public_html/uploads
```

Some shared hosts require `777` on `storage` / `bootstrap/cache` / `uploads` if the PHP user differs from the account owner — use the least privilege that works.

---

### Step 7: Framework Cache & Asset Optimization

Compile configurations, routes, and Blade views into production caches:

```bash
cd /home/USER/ibntech

# Clear any stale development cache
php artisan optimize:clear

# Rebuild production caches (project helper)
php artisan cms:optimize
# Equivalent to: config:cache + route:cache + view:cache

# Optional additional caches
php artisan event:cache

# Upgrade / optimize Filament admin assets
php artisan filament:upgrade
php artisan filament:optimize
```

Confirm Vite assets are present at `public_html/build/manifest.json`.

---

## 6. Staging Environment Setup

Deploying a staging subdomain (e.g., `dev.ibntech.com`) allows safe testing of code updates before releasing to production.

### Directory Layout for Staging

```
/home/USER/
├── ibntech/                          <-- Production Core
├── ibntech-staging/                  <-- Staging Core
│
└── public_html/                      <-- Web Document Root
    ├── build/                        <-- Production Vite Assets
    ├── uploads/                      <-- Production Uploads
    ├── bootstrap-path.php            <-- Maps hosts → core paths
    ├── index.php
    └── dev/                          <-- Staging Document Root (if subdomain points here)
        ├── build/                    <-- Staging Vite Assets
        ├── uploads/                  <-- Staging Uploads
        ├── bootstrap-path.php
        └── index.php
```

### Staging Configuration Checklist

1. **Subdomain Creation**: In cPanel, navigate to **Domains** → **Create A New Domain**. Set domain to `dev.ibntech.com` and Document Root to `public_html/dev` (or shared `public_html` if using host-based bootstrap only).
2. **Dedicated Staging Database**: Create a separate MySQL database (e.g. `cpaneluser_ibn_stg`) and user. Never share the production database with staging.
3. **Staging `.env` Configuration**:

```env
APP_ENV=staging
APP_DEBUG=false
APP_URL=https://dev.ibntech.com
DB_DATABASE=cpaneluser_ibn_stg

MEDIA_DISK=media
MEDIA_ROOT=/home/USER/public_html/dev/uploads
MEDIA_URL=/uploads

TELESCOPE_ENABLED=false
DEBUGBAR_ENABLED=false

# Prefer staging SMTP or a safe sink; never point staging leads at production inboxes by accident
MAIL_LEAD_NOTIFICATION_TO="staging-leads@ibntech.com"

# Use Google reCAPTCHA keys registered for the staging hostname
RECAPTCHA_SITE_KEY=...
RECAPTCHA_SECRET_KEY=...
```

4. **Prevent Search Engine Indexing**: In Website Settings / SEO defaults for staging, set robots to `noindex, nofollow` (and ensure staging `robots.txt` disallows crawling) to avoid duplicate-content penalties.
5. **Automatic Path Bootstrapping**: Ensure `bootstrap-path.php` maps `$host === 'dev.ibntech.com'` to `/home/USER/ibntech-staging`.

---

## 7. Automating Background Tasks & Queues in cPanel

IBN Technologies relies on background processes for:

1. **Scheduled Tasks**: Queue backlog monitoring (`queue:monitor`) when `QUEUE_CONNECTION=database` (see `bootstrap/app.php`).
2. **Database Queue**: Asynchronous lead notification emails and Spatie media conversions (Blog hero/thumb WebP + responsive images).

### Laravel Scheduler (Cron Job)

Set up a system Cron Job in cPanel to invoke Laravel's schedule runner every minute.

1. Log into cPanel and click **Cron Jobs**.
2. Under **Common Settings**, select **Once Per Minute (`* * * * *`)**.
3. Set the command to:

```bash
/usr/local/bin/php /home/USER/ibntech/artisan schedule:run >> /dev/null 2>&1
```

*(Replace `/usr/local/bin/php` with the explicit path to your cPanel PHP 8.2+ CLI binary if the default PHP differs. Confirm with `which php` or MultiPHP INI Editor.)*

Optional Telescope prune (only if Telescope remains enabled):

```bash
# Daily at 02:00 — example cron
0 2 * * * /usr/local/bin/php /home/USER/ibntech/artisan telescope:prune --hours=48 >> /dev/null 2>&1
```

---

### Queue Worker Management

Media conversions should use a long timeout; lead emails are short jobs. Prefer processing **`media` then `default`**:

```bash
php artisan queue:work --queue=media,default --tries=1 --timeout=900
```

Because standard cPanel shared hosting does not include Supervisor, use one of the strategies below.

#### Strategy 1: cPanel Cron Job Worker (Recommended for Shared Hosting)

Run a cron job every 1–5 minutes to process queued jobs and exit cleanly:

```bash
/usr/local/bin/php /home/USER/ibntech/artisan queue:work database --queue=media,default --stop-when-empty --tries=3 --timeout=900 >> /dev/null 2>&1
```

- `--stop-when-empty`: Processes pending jobs then exits (low memory footprint).
- `--tries=3`: Retries failed jobs before moving them to `failed_jobs`.
- `--timeout=900`: Allows long-running image conversions; shorten if your host kills long PHP processes.

#### Strategy 2: Persistent Daemon / Supervisor (VPS / Dedicated)

If your host supports Supervisor (`/etc/supervisor/conf.d/ibntech-worker.conf`):

```ini
[program:ibntech-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/USER/ibntech/artisan queue:work database --queue=media,default --sleep=3 --tries=3 --timeout=900 --max-time=3600
autostart=true
autorestart=true
user=USER
numprocs=1
redirect_stderr=true
stdout_logfile=/home/USER/ibntech/storage/logs/worker.log
stopwaitsecs=3600
```

After deploy or code change that affects jobs:

```bash
php artisan queue:restart
```

---

## 8. Post-Deployment Verification Protocol

Complete this verification protocol immediately following every production release.

### Public Website Checklist

- [ ] **HTTPS Redirect**: Access `http://ibntech.com` and verify automatic redirect to `https://ibntech.com`.
- [ ] **Trailing Slash Enforcement**: Access a content URL without a trailing slash and verify 301 redirect to the slashed canonical URL.
- [ ] **Core Content Types Load**: Verify Home / CMS pages, Blog listing & detail, Articles, Case Studies, eBooks, White Papers, Press Releases, Industry pages (`/industry/{slug}/`), Landing pages (`/lp/{slug}/`), Newsletter listing & detail.
- [ ] **Gated Downloads**: Case Study and eBook download flows create a lead and return/serve the PDF.
- [ ] **Custom / Error Pages**: Confirm branded 404 (and any static assets under `/uploads/web-img/` or `web-img/`) render correctly.
- [ ] **Compiled Assets**: Confirm CSS, Livewire interactions, and `intl-tel-input` country dropdowns work without console errors.
- [ ] **Health Endpoint**: Visit `https://ibntech.com/up` and confirm a successful health response.
- [ ] **robots.txt**: Visit `/robots.txt` and confirm expected production directives.

### Admin Panel & CMS Checklist

- [ ] **Filament Login**: Visit `https://ibntech.com/admin` and verify the IBNTECH Control login page renders with correct styling.
- [ ] **Dashboard Widgets**: Log in and verify content overview / recent activity / recent leads widgets load without error.
- [ ] **Website Settings**: Navigate to Website Settings; save a change; verify logo / favicon uploads land under `/uploads/...` and update on the frontend.
- [ ] **Queue Monitor**: Open Queue Monitor (administrator role) and confirm connection/backlog display.
- [ ] **Log Viewer**: Confirm application logs are readable from the admin panel when present.
- [ ] **Media Upload Smoke Test**: Upload a Blog featured image; confirm file appears under `uploads/` and conversions complete after the queue worker runs.

### Forms & Async Mail Verification

- [ ] **Contact Form**: Submit a test message. Confirm reCAPTCHA passes, success UI displays, record appears under Form Submissions / Leads, and email arrives at `MAIL_LEAD_NOTIFICATION_TO`.
- [ ] **Lead Form**: Submit and verify record + notification.
- [ ] **Newsletter Inquiry**: Submit email-only opt-in and verify record + notification.
- [ ] **eBook / Case Study Download Forms**: Complete gated download; verify lead capture and file delivery.

### Security Hardening Spot-Checks

- [ ] `APP_DEBUG=false`, `DEBUGBAR_ENABLED=false`, `TELESCOPE_ENABLED=false` (or Telescope gated).
- [ ] `.env` is **not** web-accessible (Architecture A / custom document root).
- [ ] Default seeder passwords changed.
- [ ] Production reCAPTCHA keys are hostname-correct.

---

## 9. Troubleshooting & Common Deployment Issues

### Issue 1: `Vite manifest not found at: .../public/build/manifest.json`

**Root Cause**: Frontend assets were not built prior to upload, or `public/build/` was omitted during transfer.

**Solution**:

1. Run `npm run build` on your local machine.
2. Upload the generated `public/build/` directory into `public_html/build/`.
3. Verify `public_html/build/manifest.json` exists.

---

### Issue 2: Broken Images / Uploaded Media 404 Errors

**Root Cause**: `MEDIA_ROOT` / `MEDIA_URL` misconfigured, uploads directory missing/unreadable, or media still on the legacy `public` disk.

**Solution**:

1. Confirm `.env` has the correct values for the environment (see [Section 3](#3-environment-configuration-env)).
2. Ensure the uploads directory exists and is readable/writable (`chmod -R 755` or `775`).
3. Clear and rebuild config cache after env changes:

```bash
php artisan config:clear
php artisan config:cache
```

4. If migrating legacy files:

```bash
php artisan media:migrate-to-uploads-disk --dry-run
php artisan media:migrate-to-uploads-disk
```

5. For Blog conversions still pending, ensure the queue worker is running with `--queue=media,default`.
6. Optional transition rewrite: `/storage/*` → `/uploads/*` (see Step 2).

---

### Issue 3: `500 Internal Server Error`

**Root Cause**: Permission error, missing `.env`, ungenerated `APP_KEY`, wrong `bootstrap-path.php` mapping, or missing PHP extension.

**Solution**:

1. Inspect `ibntech/storage/logs/laravel-*.log` (daily channel) or cPanel **Errors**.
2. If the log indicates a missing application key: `php artisan key:generate`.
3. Verify permissions: `chmod -R 775 storage bootstrap/cache`.
4. Ensure PHP version is **8.2 or 8.3** in MultiPHP Manager.
5. Confirm `bootstrap-path.php` returns the correct absolute path for the current host (a wrong path fails before Laravel can log usefully).

---

### Issue 4: Filament Admin Dashboard Appears Unstyled

**Root Cause**: Vite/Filament theme assets missing from `public_html/build/`, or Filament assets not upgraded after deploy.

**Solution**:

```bash
cd /home/USER/ibntech
php artisan filament:upgrade
php artisan optimize:clear
php artisan cms:optimize
php artisan filament:optimize
```

Also re-upload a fresh local `npm run build` output to `public_html/build/`.

---

### Issue 5: Form Submissions Fail or Emails Are Not Sending

**Root Cause**: SMTP credentials incorrect, `MAIL_LEAD_NOTIFICATION_TO` missing, reCAPTCHA failing, or queue worker not running.

**Solution**:

1. Confirm `.env` defines `MAIL_LEAD_NOTIFICATION_TO`, valid SMTP settings, and production reCAPTCHA keys.
2. Process the queue manually:

```bash
php artisan queue:work database --queue=media,default --once
```

3. Inspect failed jobs:

```bash
php artisan queue:failed
```

4. Check Filament Queue Monitor for backlog growth (`QUEUE_MONITOR_MAX`).

---

### Issue 6: Trailing Slash Infinite Redirect Loop

**Root Cause**: Conflict between server `.htaccess` trailing-slash *removal* and Laravel `EnsureTrailingSlash` *addition*.

**Solution**:

Use the production `.htaccess` pattern from [Step 2](#step-2-file-upload--directory-placement) that enforces (or at least does not strip) trailing slashes for application routes, while excluding `uploads`, `build`, `admin`, `livewire`, and static files.

---

### Issue 7: `Class "Imagick" not found` / Failed Media Conversions

**Root Cause**: Neither `imagick` nor a working `gd` extension is available for Spatie conversions.

**Solution**: Enable `gd` or `imagick` in MultiPHP extensions, then retry failed jobs:

```bash
php artisan queue:retry all
```

---

### Issue 8: Telescope or Debugbar Interfering in Production

**Root Cause**: Dev tooling left enabled.

**Solution**:

```env
TELESCOPE_ENABLED=false
DEBUGBAR_ENABLED=false
APP_DEBUG=false
```

Then:

```bash
php artisan optimize:clear
php artisan config:cache
```

If Telescope must remain on, restrict access in `TelescopeServiceProvider::gate()` to trusted admin emails/IPs only.

---

## 10. Production Deployment Checklist

Use this checklist for every production release.

### Phase 1: Pre-Deployment (Local)

- [ ] All automated tests pass (`php artisan test` / `composer test`).
- [ ] Code formatted (`./vendor/bin/pint` or `./vendor/bin/pint --test`).
- [ ] Fresh production asset bundle generated (`npm ci && npm run build`).
- [ ] Production dependencies installed (`composer install --no-dev --optimize-autoloader`).
- [ ] Backup created of production database (`mysqldump`) **and** `uploads/` media tree.
- [ ] Staging smoke-tested when the release includes schema or media changes.

### Phase 2: Deployment Execution (cPanel)

- [ ] Enable maintenance mode:

```bash
php artisan down --secret="ibn-deploy-2026"
```

  *(Bypass URL: `https://ibntech.com/{secret}` while down.)*

- [ ] Upload updated core files to `/home/USER/ibntech/` (preserve `.env` and `storage/`).
- [ ] Upload updated Vite build to `public_html/build/`.
- [ ] Confirm `bootstrap-path.php` host mappings still correct.
- [ ] Execute database migrations (`php artisan migrate --force`).
- [ ] Execute media migration only if needed (`php artisan media:migrate-to-uploads-disk`).
- [ ] Verify permissions (`775` on `storage`, `bootstrap/cache`, and writable `uploads`).
- [ ] Clear and rebuild caches (`php artisan cms:optimize`, `filament:optimize`).
- [ ] Restart queue workers (`php artisan queue:restart` or rely on cron `--stop-when-empty`).
- [ ] Disable maintenance mode (`php artisan up`).

### Phase 3: Post-Deployment Verification

- [ ] Verify homepage and key content modules load under HTTPS.
- [ ] Log into Filament admin (`/admin`) with a non-default password account.
- [ ] Submit a test Contact form and verify queued mail delivery.
- [ ] Upload/replace a media asset and confirm `/uploads/...` URLs work.
- [ ] Check `storage/logs/laravel-*.log` for new exceptions.
- [ ] Confirm Queue Monitor backlog is draining.

---

## 11. Future Updates, Maintenance & Backups

### Updating Code on Production

To deploy incremental code updates:

```bash
cd /home/USER/ibntech

# 1. Put application into maintenance mode
php artisan down --secret="ibn-maintenance-key"

# 2. Upload updated files / pull git changes (preserve .env, storage/, and public uploads)
# git pull origin main

# 3. Install production PHP deps if composer.lock changed
# composer install --no-dev --optimize-autoloader

# 4. Sync new public/build assets into the document root

# 5. Run database migrations
php artisan migrate --force

# 6. Clear and rebuild framework caches
php artisan optimize:clear
php artisan cms:optimize
php artisan filament:upgrade
php artisan filament:optimize

# 7. Signal queue workers to restart
php artisan queue:restart

# 8. Bring application back online
php artisan up
```

### Automated Database Backup Strategy

Set up automated daily database backups via cPanel Cron Job (or cPanel Backup / JetBackup):

```bash
mkdir -p /home/USER/backups
mysqldump -u cpaneluser_ibnuser -p'SecureProductionPassword123!' cpaneluser_ibntech | gzip > /home/USER/backups/db_backup_$(date +\%Y\%m\%d_\%H\%M\%S).sql.gz
```

Also back up the media tree independently — databases do not contain binary uploads:

```bash
tar -czf /home/USER/backups/uploads_$(date +\%Y\%m\%d).tar.gz -C /home/USER/public_html uploads
```

Retain off-site copies (external storage / object storage) for disaster recovery.

### Log Maintenance & Cleanup

- Application logging defaults to the **daily** channel (`LOG_CHANNEL=daily`). Tune retention with `LOG_DAILY_DAYS` (example production value: `14`).
- Use the Filament Log Viewer to inspect or clear noisy logs when needed.
- If Telescope is enabled temporarily for an investigation, prune regularly (`php artisan telescope:prune`).

### Media & Deploy Hygiene

- Never wipe `public_html/uploads` during releases.
- Keep `MEDIA_ROOT` outside release-temporary directories if you adopt a releases/ symlink deploy style later.
- After changing any `MEDIA_*` or mail/queue env vars, always rebuild config cache.

---

<div align="center">

**IBN Technologies Deployment Documentation** · Built for Laravel 12, Filament v5 & Livewire v4

</div>
