# Laravel cPanel Cron Command Reference

This guide is for the staging/production Laravel setup where SSH access
is not available and commands need to be executed through cPanel Cron
Jobs.

## Server Paths

Current staging structure:

``` text
/home/devtech/
├── ibntech-core/          # Laravel application root
│   ├── artisan
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── storage/
│   └── vendor/
│
└── public_html/           # Document root
    ├── build/
    ├── uploads/
    ├── bootstrap-path.php
    └── index.php
```

Laravel Artisan commands must run from `/home/devtech/ibntech-core`.

Current staging PHP binary:

``` text
/usr/local/bin/ea-php84
```

## Standard Artisan Cron Format

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan COMMAND > /home/devtech/cron-COMMAND.log 2>&1
```

For one-time maintenance commands, use **Once Per Minute**, let it
execute once, check the log, then delete the cron job.

## Laravel Commands

### Queue worker

A normal `queue:work` is long-running and should not be used as a
temporary cron job.

For a one-time queue drain:

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan queue:work --stop-when-empty > /home/devtech/queue-work.log 2>&1
```

For a permanently running queue worker, use a process manager such as
Supervisor.

### Tinker

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan tinker
```

**Do not use Tinker as a normal cron job.** It is interactive. If an
operation must be automated, create a dedicated non-interactive Artisan
command.

### Optimize

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan optimize > /home/devtech/laravel-optimize.log 2>&1
```

### Clear all optimization caches

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan optimize:clear > /home/devtech/optimize-clear.log 2>&1
```

### Project production cache helper

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan cms:optimize > /home/devtech/cms-optimize.log 2>&1
```

`cms:optimize` is the project helper for rebuilding configuration,
routes, and Blade caches.

### Individual caches

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan config:cache > /home/devtech/config-cache.log 2>&1
```

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan route:cache > /home/devtech/route-cache.log 2>&1
```

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan event:cache > /home/devtech/event-cache.log 2>&1
```

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan view:cache > /home/devtech/view-cache.log 2>&1
```

### Filament

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan filament:upgrade > /home/devtech/filament-upgrade.log 2>&1
```

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan filament:optimize > /home/devtech/filament-optimize.log 2>&1
```

Use these only when required by a Filament update/deployment.

## Recommended Production Cache Sequence

When production/staging caches need to be completely rebuilt:

### 1. Clear stale caches

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan optimize:clear > /home/devtech/optimize-clear.log 2>&1
```

### 2. Rebuild project caches

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan cms:optimize > /home/devtech/cms-optimize.log 2>&1
```

### 3. Optional event cache

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan event:cache > /home/devtech/event-cache.log 2>&1
```

Do not run this sequence every minute permanently.

## Node / Vite Commands

These require Node.js/npm rather than PHP.

### Remove previous build

``` bash
cd /home/devtech/ibntech-core && rm -rf public/build
```

### Install Node dependencies

``` bash
cd /home/devtech/ibntech-core && npm ci
```

### Build production assets

``` bash
cd /home/devtech/ibntech-core && npm run build
```

**Important:** `public_html` is the document root while `ibntech-core`
is the Laravel core. Confirm the project's asset/deployment
configuration before assuming that
`/home/devtech/ibntech-core/public/build` is the directory served by the
staging website.

Do not run `npm ci` or `npm run build` through a permanent recurring
cron.

## Composer

Install production PHP dependencies:

``` bash
cd /home/devtech/ibntech-core && composer install --no-dev --optimize-autoloader > /home/devtech/composer-install.log 2>&1
```

If `composer` is not available in PATH, confirm the Composer binary path
with the server team.

Do not run Composer installation through a permanent recurring cron.

## Laravel Scheduler

If the project uses Laravel's scheduler, one permanent cron is normally
enough:

``` bash
* * * * * cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan schedule:run >> /home/devtech/laravel-scheduler.log 2>&1
```

## cPanel Cron Procedure

1.  Open **cPanel → Cron Jobs**.
2.  Click **Add New Cron Job**.
3.  Select **Once Per Minute** for a one-time maintenance command.
4.  Paste the required command.
5.  Add output redirection to a log file.
6.  Create the cron job.
7.  Wait approximately 1--2 minutes.
8.  Open the generated log under `/home/devtech/`.
9.  Confirm successful completion.
10. **Delete the temporary cron job.**

Example:

``` bash
cd /home/devtech/ibntech-core && /usr/local/bin/ea-php84 artisan optimize:clear > /home/devtech/optimize-clear.log 2>&1
```

## Quick Reference

  ---------------------------------------------------------------------------------------
  Purpose                             Command
  ----------------------------------- ---------------------------------------------------
  Clear caches                        `artisan optimize:clear`

  Rebuild project caches              `artisan cms:optimize`

  Optimize                            `artisan optimize`

  Config cache                        `artisan config:cache`

  Route cache                         `artisan route:cache`

  Event cache                         `artisan event:cache`

  View cache                          `artisan view:cache`

  One-time queue processing           `artisan queue:work --stop-when-empty`

  Interactive Tinker                  `artisan tinker`

  Filament upgrade                    `artisan filament:upgrade`

  Filament optimize                   `artisan filament:optimize`

  Install Node dependencies           `npm ci`

  Build Vite assets                   `npm run build`

  Install production Composer         `composer install --no-dev --optimize-autoloader`
  packages                            
  ---------------------------------------------------------------------------------------

## Important Deployment Rules

1.  **Never copy local Laravel cache files to production.** In
    particular, do not deploy environment-specific files such as
    `bootstrap/cache/config.php` or `bootstrap/cache/routes-v7.php` from
    local to staging/production.
2.  Generate Laravel production caches on the staging/production server
    using that server's own `.env`.
3.  Do not leave one-time maintenance commands running every minute.
4.  Delete temporary cron jobs after successful execution.
5.  Remove temporary log files when they are no longer needed.
6.  Do not use `queue:work` as a repeatedly started cron process. Use
    `--stop-when-empty` for a one-time queue drain or a process manager
    for a permanent worker.
7.  Do not use interactive `tinker` through cron.
8.  Do not assume Node build output belongs in `public_html`; verify the
    project's deployment/asset mapping first.
