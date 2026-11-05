# PHP 8.4.27 Compatibility Report

Project: `ibntech-laravel`  
Audit date: 5 November 2026  
Target runtime: PHP 8.4.27 (ZTS, Visual C++ 2022, x64)  
Scope: read-only. No packages, configuration, source files, migrations, or database rows were changed. The only file added is this report.

This assessment uses the installed tree (`composer.json`, `composer.lock`, `vendor/`, application code, and `C:\xampp84\php`). A package is treated as acceptable for 8.4.27 only when Composer’s own semver library accepts the locked constraint, or when a runtime check on PHP 8.4.27 succeeded. The Laravel major version alone is not treated as proof.

## 1. Executive Summary

The application boots on PHP 8.4.27 and can query its MariaDB database through Laravel’s database layer. Every locked Composer package accepts PHP 8.4.27. First-party PHP (`app`, `bootstrap`, `config`, `database`, `routes`, `tests`) has no implicit nullable parameters and no calls to functions removed or deprecated by PHP 8.4.

One platform requirement fails on this PHP build: `ext-zip` is commented out, while `openspout/openspout` (required by Filament actions) constructs `ZipArchive` for XLSX and ODS files. The framework still boots without that extension. The process currently serving `http://127.0.0.1:8000` is PHP 8.2.12 from `C:\xampp\php`, not the PHP 8.4.27 binary under `C:\xampp84\php`.

**Status: Compatible with Minor Fixes**

The fixes are environment fixes: enable `extension=zip` in the PHP 8.4 `php.ini`, and run Artisan, queue workers, and the local server with `C:\xampp84\php\php.exe`. No application code change is required for PHP 8.4.27.

## 2. Current Environment Details

| Item | Value | How it was established |
| --- | --- | --- |
| PHP 8.4 CLI | 8.4.27, built 20 October 2026, ZTS VC++ 2022 x64 | `C:\xampp84\php\php.exe -v` |
| PHP 8.4 ini | `C:\xampp84\php\php.ini` | `php --ini` for that binary |
| PATH `php` | 8.2.12, built 24 October 2023, ini `C:\xampp\php\php.ini` | `php -v` with the default PATH |
| Dev server on port 8000 | `C:\xampp\php\php.exe artisan serve` and the built-in server on `127.0.0.1:8000` | Process command lines |
| Apache module | `C:/xampp84/php/php8apache2_4.dll` | `C:\xampp84\apache\conf\extra\httpd-xampp.conf` line 20 |
| Apache ini directive | `PHPINIDir "C:/xampp84/php"` | same file, line 42 |
| Apache `PHPRC` | `SetEnv PHPRC "\\xampp\\php"` | same file, line 10 |
| OpenSSL | 3.0.22, 25 August 2026 | `OPENSSL_VERSION_TEXT` on PHP 8.4.27 |
| cURL | 8.23.0 | `curl_version()` |
| PCRE | 10.44, 7 June 2024 | `PCRE_VERSION` and Composer platform check |
| MySQL client library | mysqlnd 8.4.27 | `mysqli_get_client_info()` |
| Database server | MariaDB 10.11.16 | `SELECT VERSION()` through Laravel on PHP 8.4.27 |
| Database name | `ibntech_laravel_12` on `127.0.0.1:3306` | `.env` `DB_*` plus `SELECT DATABASE()` |
| App environment | `APP_ENV=local`, `APP_DEBUG=true`, `APP_URL=http://localhost:8000` | `.env` |
| Cache / session / queue | `database` / `database` / `database` | `.env` |
| Redis client setting | `phpredis`, host `127.0.0.1:6379` | `.env` |
| Log channel | `daily` | `.env` |
| Deprecation log | `null` | `.env` `LOG_DEPRECATIONS_CHANNEL=null` and `config/logging.php` lines 34–37 |
| Bcrypt rounds | 12 | `.env` `BCRYPT_ROUNDS=12` |
| Composer lock platform | `"php": "^8.2"` | `composer.lock` `platform` |
| Composer plugin API | 2.6.0 | `composer.lock` |
| Lock content hash | `80875a042e3471d9cea66d4dd6fdf11f` | `composer.lock` |

PHP 8.4.27 modules that are loaded: bcmath, bz2, calendar, Core, ctype, curl, date, dom, exif, fileinfo, filter, ftp, gd, gettext, hash, iconv, intl, json, libxml, mbstring, mysqli, mysqlnd, openssl, pcre, PDO, pdo_mysql, pdo_sqlite, Phar, random, readline, Reflection, session, SimpleXML, SPL, standard, tokenizer, xml, xmlreader, xmlwriter, zlib.

Not loaded, and relevant to this project: zip, redis, sodium. GD on this build includes JPEG, PNG, WebP, GIF, BMP, and AVIF.

`C:\xampp84\php\php.ini` line 485 sets `error_reporting=E_ALL & ~E_DEPRECATED & ~E_STRICT`. After boot, Laravel replaces that with `error_reporting(-1)` in `vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/HandleExceptions.php` line 47. Deprecations are then reported only to the `deprecations` log channel. That channel is `null`, so they are discarded. They are not turned into exceptions. Unit tests also ignore them unless `LOG_DEPRECATIONS_WHILE_TESTING` is set (`HandleExceptions.php` lines 125–129). `phpunit.xml` does not set `failOnDeprecation`.

## 3. Laravel Framework Compatibility

Installed framework: **Laravel 12.64.0**.

```48:48:vendor/laravel/framework/src/Illuminate/Foundation/Application.php
    const VERSION = '12.64.0';
```

`vendor/laravel/framework/composer.json` requires `"php": "^8.2"`. Composer’s semver library evaluates `^8.2` as `>=8.2.0 <9.0.0`, so 8.4.27 is inside the constraint. The same package requires `symfony/polyfill-php84` and `symfony/polyfill-php85`. The PHP 8.4 polyfill returns immediately when `PHP_VERSION_ID >= 80400` (`vendor/symfony/polyfill-php84/bootstrap.php` lines 14–16), so it does not redeclare `array_find`, `mb_trim`, or the other PHP 8.4 functions.

Composer’s generated platform check allows this runtime:

```6:8:vendor/composer/platform_check.php
if (!(PHP_VERSION_ID >= 80200)) {
    $issues[] = 'Your Composer dependencies require a PHP version ">= 8.2.0". You are running ' . PHP_VERSION . '.';
}
```

PHP 8.4.27 is 64-bit, so the companion `PHP_INT_SIZE === 8` check also passes. The `trigger_error(..., E_USER_ERROR)` call later in that file runs only when a platform check fails. It does not run on this binary. Passing `E_USER_ERROR` to `trigger_error()` is deprecated in PHP 8.4, but that line is a latent failure-path warning, not a current one.

**Confirmed runtime:** `C:\xampp84\php\php.exe artisan --version` printed `Laravel Framework 12.64.0`. A separate bootstrap of `bootstrap/app.php` on the same binary, followed by `DB::select('select VERSION() as version, DATABASE() as db')`, returned framework 12.64.0, PHP 8.4.27, database `ibntech_laravel_12`, and server `10.11.16-MariaDB`. The Laravel connection’s `PDO::ATTR_EMULATE_PREPARES` value was boolean `false`, which is what `vendor/laravel/framework/src/Illuminate/Database/Connectors/Connector.php` lines 23–24 configure.

The application skeleton already accounts for the PHP 8.5 move of PDO MySQL constants. On 8.4.27 the 8.4 branch is the one that runs:

```3:3:config/database.php
use Pdo\Mysql;
```

```62:64:config/database.php
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
```

The same expression is repeated for the `mariadb` connection at line 83. On PHP 8.4.27, `PHP_VERSION_ID` is 80427, so the code uses `PDO::MYSQL_ATTR_SSL_CA`. Both `PDO::MYSQL_ATTR_SSL_CA` (value 1009) and `Pdo\Mysql::ATTR_SSL_CA` exist, and reading the old constant did not emit a deprecation. The `use Pdo\Mysql` import is safe because the class exists on this build.

Service providers registered in `bootstrap/providers.php`:

- `App\Providers\AppServiceProvider`
- `App\Providers\Filament\AdminPanelProvider`
- `App\Providers\TelescopeServiceProvider` only when `APP_ENV` is `local` or `staging`

Middleware registered in `bootstrap/app.php`:

- cookie encryption exception for `ibn_cookie_consent`
- CSRF exception for `cookie-consent`
- global `App\Http\Middleware\EnsureTrailingSlash`
- web `App\Http\Middleware\TrackPublicPageView`
- web `App\Http\Middleware\PreventAuthenticatedPublicCache`

Those providers and middleware files were included in the syntax scan in section 7. Nothing in them is a PHP 8.4 break. Telescope 5.20.0 and Filament 5.7.5 are covered by the dependency results below.

## 4. Composer Dependency Compatibility

`composer.json` requires PHP `^8.2`. The lockfile contains 157 packages (production and development). Each `require.php` constraint was checked with `Composer\Semver\Semver::satisfies('8.4.27', $constraint)`.

| Result | Count |
| --- | --- |
| `php` constraint accepts 8.4.27 | 156 |
| `php` constraint rejects 8.4.27 | 0 |
| No `php` key | 1 (`maennchen/zipstream-php` 3.1.2) |

`maennchen/zipstream-php` 3.1.2 requires `php-64bit: ^8.2` instead of `php`. `composer check-platform-reqs`, executed with `C:\xampp84\php\php.exe` on PATH, reported `php 8.4.27 success` and `php-64bit 8.4.27 success`.

No locked constraint excludes 8.4. The caret range `^8.2` includes 8.3 and 8.4. These locked constraints name 8.4 explicitly and still accept 8.4.27:

| Package | Locked version | PHP constraint |
| --- | --- | --- |
| `openspout/openspout` | v4.28.5 | `~8.2.0 \|\| ~8.3.0 \|\| ~8.4.0` |
| `dragonmantank/cron-expression` | v3.6.0 | `^8.2\|^8.3\|^8.4\|^8.5` |
| `nette/php-generator` | v4.2.2 | `8.1 - 8.5` |
| `nette/schema` | v1.3.5 | `8.1 - 8.5` |
| `nette/utils` | v4.1.5 | `8.2 - 8.5` |

`composer check-platform-reqs` reported every required extension present except `ext-zip`. Details are in section 6.

### Direct requirements

| Package | Locked | PHP constraint | 8.4.27 |
| --- | --- | --- | --- |
| `php` | platform `^8.2` | `^8.2` | Accepted |
| `filament/filament` | v5.7.5 | `^8.2` | Accepted |
| `filament/spatie-laravel-media-library-plugin` | v5.7.5 | `^8.2` | Accepted |
| `laravel/framework` | v12.64.0 | `^8.2` | Accepted |
| `laravel/telescope` | v5.20.0 | `^8.0` | Accepted |
| `laravel/tinker` | v2.11.1 | `^7.2.5\|^8.0` | Accepted |
| `livewire/livewire` | v4.3.5 | `^8.1` | Accepted |
| `spatie/laravel-medialibrary` | 11.23.3 | `^8.2` | Accepted |
| `barryvdh/laravel-debugbar` (dev) | v4.2.8 | `^8.2` | Accepted |
| `fakerphp/faker` (dev) | v1.24.1 | `^7.4 \|\| ^8.0` | Accepted |
| `laravel/pail` (dev) | v1.2.6 | `^8.2` | Accepted |
| `laravel/pint` (dev) | v1.29.0 | `^8.2.0` | Accepted |
| `laravel/sail` (dev) | v1.57.0 | `^8.0` | Accepted |
| `mockery/mockery` (dev) | 1.6.12 | `>=7.3` | Accepted |
| `nunomaduro/collision` (dev) | v8.9.3 | `^8.2.0` | Accepted |
| `phpunit/phpunit` (dev) | 11.5.55 | `>=8.2` | Accepted |

Filament v5.7.5, Livewire v4.3.5, and Symfony 7.4 components are the installed set. Their constraints accept 8.4.27. That is a constraint result, not a claim that each upstream project published a separate 8.4.27 certification.

### Dependency conflicts

The lockfile is a resolved install. Conflict rules in the lock are upstream guards against other packages, and those conflicting packages are not installed at the forbidden versions. Examples that were inspected:

- `laravel/framework` v12.64.0 conflicts with `tightenco/collect` `<5.5.33`. That package is not installed.
- `nunomaduro/collision` v8.9.3 conflicts with `laravel/framework` `<11.48.0 || >=14.0.0` and `phpunit/phpunit` `<11.5.50 || >=14.0.0`. Installed versions are 12.64.0 and 11.5.55.
- `spatie/laravel-medialibrary` 11.23.3 conflicts with `php-ffmpeg/php-ffmpeg` `<0.6.1`. php-ffmpeg is not installed.
- Symfony 7.4 components conflict with Symfony 6.3-and-older packages. Those are not installed.

`composer check-platform-reqs` did not report a version conflict. The only platform failure is the missing zip extension.

### Broad constraints

These packages accept 8.4.27 because their floor is very old. Acceptance here means “Composer will install them,” not “their source was fully type-checked”:

| Package | Locked | PHP constraint |
| --- | --- | --- |
| `masterminds/html5` | 2.10.1 | `>=5.3.0` |
| `scrivo/highlight.php` | v9.18.1.10 | `>=5.4` |
| `ralouphie/getallheaders` | 3.0.3 | `>=5.6` |

A complete abstract-syntax scan of `vendor/` did not finish. First-party code was fully scanned. The residual risk is recorded in section 9 as low, because the framework boot and the database query already executed the installed Laravel, Symfony, Filament, and Livewire code paths that run at startup.

## 5. PHP Deprecated Features and Breaking Changes

Source for the language changes: the PHP 8.4 `UPGRADING` notes (php-src branch `PHP-8.4`). PHP 8.4.27 is a patch release of that minor; it does not add a new language break beyond 8.4.0.

### Changes that were checked and are not present in application code

Searches of `app/`, `database/`, `routes/`, and `tests/` found no uses of:

- `utf8_encode`, `utf8_decode`, `create_function`, `strftime`, `gmstrftime`, `money_format`
- `lcg_value`
- `mysqli_ping`, `mysqli_kill`, `mysqli_refresh`
- `xml_set_object`, `CURLOPT_BINARYTRANSFER`
- `E_STRICT`, `E_USER_ERROR`
- `get_class()` or `get_parent_class()` called with no arguments
- `${var}` string interpolation
- a class named `_`

`md5()` and `sha1()` are used as content fingerprints, not as password storage:

- `app/Support/BlockContent.php` line 272, `md5($level.'|'.$text)`
- `app/Services/WordPress/WordpressPost.php` line 31, `sha1(...)`
- `app/Services/WordPress/PressReleasePost.php` line 26, `sha1(...)`

The shipped PHP 8.4 deprecation list does not include `md5()`, `sha1()`, or `uniqid()`. Proposals to deprecate them were not part of the final 8.4 upgrade notes. These calls are not a PHP 8.4 defect.

`$records->each(...)` in `app/Filament/Tables/ContentBulkActions.php` and similar model queries are `Illuminate\Support\Collection::each` and Eloquent’s `each`. They are not the removed PHP `each()` function.

No application code defines `array_find`, `array_any`, `array_all`, `array_find_key`, `mb_trim`, `bcround`, `bcfloor`, `bcceil`, or `bcdivmod`. A search of `vendor/` found no unconditional `function` declarations of those names. The Symfony polyfill defines them only when they are missing, and on 8.4 it returns before those definitions.

### Implicit nullable parameters

PHP 8.4 deprecates a typed parameter with a `null` default that is not explicitly nullable (`function foo(string $bar = null)`). The fix shape is `?string` or `string|null`. Untyped `$bar = null` is not this deprecation.

A PHP-Parser walk of `app/`, `bootstrap/` (excluding `bootstrap/cache/`), `config/`, `database/`, `routes/`, and `tests/` found **zero** implicit nullable parameters.

`Illuminate\Database` was also searched for the same pattern and produced no matches. The rest of `vendor/` was not fully parsed; see the low residual item in section 9.

### CSV escape parameter

PHP 8.4 deprecates calling `fgetcsv()`, `fputcsv()`, `str_getcsv()`, and the `SplFileObject` CSV methods without an explicit `$escape` argument. The runtime message on 8.4.27 is: `the $escape parameter must be provided as its default value will change`. The default has not yet changed; omitting the argument warns, and passing it does not.

**Confirmed:** a throwaway call that omitted `$escape` raised `E_DEPRECATED` (8192). The same buffer read with an explicit `"\\"` or `""` did not warn.

Application code already passes the escape:

```31:31:app/Services/OldSubmissions/ElementorCsvReader.php
            $header = fgetcsv($handle, 0, ',', '"', '\\');
```

```43:43:app/Services/OldSubmissions/ElementorCsvReader.php
            while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {
```

Those two calls do not hit the deprecation. They keep today’s backslash-escape behavior when the future default changes.

League CSV 9.28, used by Filament actions, also passes escape explicitly. `vendor/league/csv/src/Stream.php` line 391 calls `fgetcsv($this->stream, 0, $this->delimiter, $this->enclosure, $this->escape)`. `Reader.php` lines 199 and 249 call `setCsvControl` with the escape argument. `get_class()` in `AbstractCsv.php` is called with an argument, so the zero-argument `get_class()` deprecation does not apply. The package also uses the PHP 8.4 `#[Deprecated]` attribute (`use Deprecated` in `EscapeFormula.php`), which exists on 8.4.27.

### Password hashing

PHP 8.4 raises the default bcrypt cost from 10 to 12. A `password_hash(..., PASSWORD_BCRYPT)` call on this binary reported cost 12.

Laravel does not rely on that default. `vendor/laravel/framework/src/Illuminate/Hashing/BcryptHasher.php` line 18 sets `protected $rounds = 12`, and the constructor uses the configured rounds. `.env` sets `BCRYPT_ROUNDS=12`. `phpunit.xml` sets `BCRYPT_ROUNDS` to 4 for tests only. Existing hashes continue to verify regardless of the cost used to create them. No password reset is required for this PHP upgrade.

### PDO MySQL return types

PHP 8.4’s `PDO_MYSQL::getAttribute()` returns booleans for `ATTR_AUTOCOMMIT`, `ATTR_EMULATE_PREPARES`, and `MYSQL_ATTR_DIRECT_QUERY`. A raw PDO connection on this binary returned boolean `true` for both autocommit and emulate-prepares. Laravel’s own connection, after boot, returned boolean `false` for emulate-prepares because the framework sets the attribute itself (`Connector.php` lines 23–24). Application `getAttribute()` calls are Eloquent and DOM attribute reads, not `PDO::getAttribute()`.

### mysqlnd wait-timeout error code

PHP 8.4 mysqlnd reports MySQL server wait timeouts as error 4031 instead of 2006 for MySQL server 8.0.24 and newer. This server is MariaDB 10.11.16. Laravel’s detector matches message text, including the inactivity sentence, rather than the number 2006 alone:

```60:61:vendor/laravel/framework/src/Illuminate/Database/LostConnectionDetector.php
            'The client was disconnected by the server because of inactivity. See wait_timeout and interactive_timeout for configuring this behavior.',
```

That covers the message MySQL emits for this timeout. No application change is indicated.

### Other 8.4 behavior that does not show up in this code

- `exit` / `die` are closer to real functions and can throw `TypeError` for invalid status types. No invalid `exit` usage was found in application code.
- `round()` throws `ValueError` for an invalid mode, and a few previously mis-rounded values change. No application `round()` mode was flagged as invalid. This is a general numeric behavior change, not a located defect.
- `tempnam()` suffixes are 13 bytes longer. The application uses short prefixes `primg` and `wpimg` in `app/Services/WordPress/PressReleaseMediaImporter.php` line 122 and `app/Services/WordPress/MediaImporter.php` line 122. No length check against the old suffix was found. This is a low residual risk, not a confirmed break.
- IMAP, OCI8, PDO_OCI, and Pspell were unbundled. Nothing in the lockfile requires them.
- `session.use_only_cookies`, `session.use_trans_sid`, `session.trans_sid_tags`, and `session.referer_check` are deprecated to change. See section 8.

## 6. PHP Extension Requirements

`composer check-platform-reqs` was run with PHP 8.4.27. Every requirement succeeded except zip.

| Requirement | Result on PHP 8.4.27 |
| --- | --- |
| `php` 8.4.27 | Success |
| `php-64bit` | Success |
| `composer-runtime-api` 2.2.2 | Success |
| `ext-ctype`, `ext-filter`, `ext-hash`, `ext-mbstring`, `ext-openssl`, `ext-session`, `ext-tokenizer` | Success (Laravel) |
| `ext-intl` | Success (Filament support). The extension is loaded, not only polyfilled |
| `ext-exif`, `ext-fileinfo`, `ext-json` | Success (media library, images, Guzzle) |
| `ext-dom`, `ext-libxml`, `ext-xml`, `ext-xmlreader`, `ext-xmlwriter` | Success |
| `ext-iconv`, `ext-pcre`, `ext-phar`, `ext-zlib` | Success |
| `lib-pcre` 10.44 | Success |
| `ext-zip` | **Missing.** `openspout/openspout` requires it |

`ext-mbstring` is both loaded and covered by `symfony/polyfill-mbstring`. `ext-ctype` is covered by the ctype polyfill; the ctype extension is also loaded.

`pdo_mysql` is loaded. It is not a Composer `ext-pdo_mysql` constraint on these packages, but Laravel’s MySQL connection cannot be created without it. It is present.

### Confirmed gap: zip

`C:\xampp84\php\php.ini` line 949 is `;extension=zip`. `class_exists('ZipArchive')` is false on this binary.

`vendor/filament/actions/composer.json` lines 17–18 require `league/csv` and `openspout/openspout`. OpenSpout creates a `ZipArchive` for XLSX and ODS:

```30:35:vendor/openspout/openspout/src/Writer/Common/Helper/ZipHelper.php
    public function createZip(string $tmpFolderPath): ZipArchive
    {
        $zip = new ZipArchive();
        $zipFilePath = $tmpFolderPath.self::ZIP_EXTENSION;

        $zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
```

The same class is constructed in `vendor/openspout/openspout/src/Reader/XLSX/Reader.php` and the ODS reader. A request that exports or imports XLSX through Filament/OpenSpout will fatal with a missing `ZipArchive` class. CSV through League CSV does not need zip. Application boot does not instantiate `ZipArchive`: Artisan and the database bootstrap succeeded with zip disabled.

`maennchen/zipstream-php` 3.1.2, used for streamed downloads, requires `ext-zlib` (loaded) and `ext-mbstring`. Its `ext-zip` requirement is in `require-dev` only.

### Redis and sodium

`ext-redis` is not installed. `.env` sets `REDIS_CLIENT=phpredis`, but cache, session, and queue use the database drivers. Boot and the database query did not need Redis. A later switch of those drivers to Redis, or any `Redis::` call, will fail until the extension exists.

`ext-sodium` is commented out at `php.ini` line 945. `config/app.php` line 98 sets `'cipher' => 'AES-256-CBC'`. Encryption uses OpenSSL, which is loaded. Sodium is not required for the current cipher.

## 7. Custom Code Compatibility Findings

The parser and text searches covered first-party PHP under `app/`, `bootstrap/`, `config/`, `database/`, `routes/`, and `tests/`. Blade templates had no `fgetcsv`, `utf8_encode`, or `create_function` usage.

| Check | Result |
| --- | --- |
| Implicit nullable parameters | None |
| Removed PHP functions and `${}` interpolation | None |
| PHP 8.4-deprecated function calls | None in first-party code |
| `fgetcsv` without `$escape` | None. The only calls pass `'\\'` |
| Dynamic-feature collisions (`array_find`, `mb_trim`, `bcround`) | None defined by the application |
| PDO constant branch for 8.4 vs 8.5 | Correct for 8.4.27 |
| Service providers and middleware | Booted as part of the successful Laravel bootstrap |
| `md5` / `sha1` fingerprints | Present, and not a PHP 8.4 deprecation |

`App\Providers\AppServiceProvider` adjusts Livewire nesting, SMTP settings, sitemap observers, and Cloudflare proxy trust. Those are ordinary typed PHP 8 methods. The bootstrap that executed them on PHP 8.4.27 completed and then ran SQL.

`config/hashing.php` is not published. Hashing uses the framework default bcrypt hasher with `BCRYPT_ROUNDS=12`.

No first-party code overrides `DOMDocument::registerNodeClass`, `SplHeap::insert`, or the other methods that gained tentative return types in PHP 8.4. Those tentative types would deprecate mismatched child methods; they would not fatal by themselves.

## 8. Database and Configuration Compatibility

### Confirmed database connectivity

A read-only Laravel query on PHP 8.4.27 succeeded:

- Driver configured in `.env`: `mysql` (`DB_CONNECTION=mysql`)
- Server: MariaDB 10.11.16
- Database: `ibntech_laravel_12`
- Framework PDO emulate-prepares: `false`
- Client: mysqlnd 8.4.27
- `pdo_mysql`: loaded

The `mysql` driver is the correct Laravel driver for this MariaDB server. Laravel also ships a `mariadb` driver in `config/database.php`. The application is not using that key. That is a configuration choice, not a PHP 8.4 failure. No migrations were run and no rows were written.

A separate raw PDO connection, before the framework configured the handle, also succeeded with `SELECT 1`. Server charset is `utf8mb4`. Server collation is `utf8mb4_general_ci`. Server `sql_mode` is `NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION`.

The application connection config sets charset `utf8mb4`, collation `utf8mb4_unicode_ci`, and `strict => true` (`config/database.php` lines 56–60). Laravel’s MySQL connector applies charset, collation, and strict SQL mode after it connects. The raw server defaults above are what MariaDB reports before that session setup. This difference exists on any PHP version; it is not a new 8.4 break. It is recorded so the two collations are not mistaken for a driver failure.

### Session ini

`C:\xampp84\php\php.ini` sets:

- line 1333, `session.use_only_cookies=1`
- line 1427, `session.use_trans_sid=0`
- line 1439, `session.trans_sid_tags="a=href,area=href,frame=src,form="`

PHP 8.4 deprecates changing `session.trans_sid_tags`. Setting that directive from the command line with `error_reporting=E_ALL` produced:

`PHP Deprecated: PHP Startup: Usage of session.trans_sid_tags INI setting is deprecated`

Loading the project ini itself, whose `error_reporting` hides `E_DEPRECATED`, did not print that warning. Laravel turns error reporting back on only after startup, so it does not replay the startup notice. `session.use_trans_sid` remains `0`, so session IDs are not being written into URLs. This is a deprecated setting, not a broken session store. The application uses `SESSION_DRIVER=database`, so PHP file sessions are not the app session backend.

`session.use_strict_mode=0` (line 1319) is a pre-existing session setting. It is not a PHP 8.4 incompatibility.

### Two PHP installs

**Confirmed:** the site URL in `.env` is `http://localhost:8000`, and the live process on that port is `C:\xampp\php\php.exe` 8.2.12. Apache is configured to load the PHP 8.4 module, with `PHPINIDir` pointed at `C:/xampp84/php`. The same Apache file also sets `PHPRC` to `\\xampp\\php`, which is the PHP 8.2 tree. Which file Apache actually loads was not observed through a live phpinfo request, so the `PHPRC` override is a **potential** risk. The CLI split is confirmed.

`php.ini` also still names `E_STRICT` in `error_reporting`. The constant is deprecated and its error level was removed. With the current mask, startup did not print a warning. Leaving the token in the expression is harmless on 8.4.27 and will matter if that ini expression is evaluated while deprecations are visible.

## 9. Issues Categorized

### Critical

None. The application framework boots on PHP 8.4.27 and runs a read-only database query. No locked package refuses this PHP version.

### High

1. **`ext-zip` is disabled. Confirmed.**  
   `php.ini` line 949 comments out `extension=zip`. Composer platform check fails. OpenSpout XLSX/ODS code constructs `ZipArchive` (`ZipHelper.php` lines 30–35). Hitting that path fatals. Ordinary page boot does not.

2. **The process on port 8000 is PHP 8.2.12. Confirmed.**  
   `C:\xampp\php\php.exe artisan serve` is the running dev server. Compatibility results in this report were produced with `C:\xampp84\php\php.exe`. Traffic to `localhost:8000` does not exercise PHP 8.4.27.

### Medium

1. **`ext-redis` is absent while `REDIS_CLIENT=phpredis`. Potential for the current drivers, confirmed if Redis is selected.**  
   Cache, session, and queue are `database`, and boot did not load Redis. Changing those drivers, or calling Redis directly, will fatal until the extension is installed.

2. **Deprecations are discarded. Confirmed configuration.**  
   `LOG_DEPRECATIONS_CHANNEL=null` and `config/logging.php` lines 34–37. PHP 8.4 deprecations will not show in `laravel.log`. That hides residual vendor deprecations during a burn-in. It does not break requests.

### Low

1. **`session.trans_sid_tags` is set. Confirmed deprecated directive, currently masked.**  
   `php.ini` line 1439. The deprecation was reproduced when the directive was set with deprecations visible. The project ini hides it. `session.use_trans_sid=0`.

2. **Apache `PHPRC` points at the other XAMPP tree. Potential.**  
   `httpd-xampp.conf` line 10 sets `PHPRC` to `\\xampp\\php`, while line 42 sets `PHPINIDir` to `C:/xampp84/php`. A live Apache request was not captured, so it is not confirmed which ini the module loads.

3. **`error_reporting` still mentions `E_STRICT`. Confirmed ini text, no warning observed.**  
   `php.ini` line 485. The level no longer exists. The constant is deprecated.

4. **`tempnam()` names are longer. Potential, no failing call site found.**  
   Prefixes `primg` and `wpimg` only. No code checks the old suffix length.

5. **Server collation differs from the Laravel connection collation. Confirmed as two different settings, not a connection failure.**  
   Server: `utf8mb4_general_ci`. Config default: `utf8mb4_unicode_ci` (`config/database.php` line 57). Laravel applies the config value on connect.

6. **Full `vendor/` nullable scan did not finish. Residual.**  
   First-party code is clean. Startup code from Laravel, Symfony, Filament, and Livewire already ran on 8.4.27. A deprecated signature in a cold path could still log a warning once the deprecation channel is enabled. It would not be a fatal error in PHP 8.4.

7. **`platform_check.php` uses `E_USER_ERROR` only when the platform check fails. Latent.**  
   The check passes on this binary, so the deprecated call does not run.

### Reviewed and not issues

- Bcrypt default cost change. Application cost is already 12.
- `PDO::MYSQL_ATTR_SSL_CA` on 8.4.27. Defined, not deprecated, and selected by the version check.
- `md5()` / `sha1()` content hashes. Not deprecated in the shipped PHP 8.4 list.
- mysqlnd timeout code 4031. The installed lost-connection detector matches the inactivity message.
- League CSV escape handling. The escape argument is passed explicitly.
- Unbundled IMAP, OCI8, PDO_OCI, and Pspell. Not required.

## 10. Recommended Fixes and Upgrade Plan

No application code, `composer.json`, or `composer.lock` change is required for PHP 8.4.27. Do not run `composer update` as part of this PHP switch.

1. **Use the 8.4 binary for every CLI entry point.**  
   Call `C:\xampp84\php\php.exe artisan ...` for serve, queue workers, scheduler, and one-off commands. The `php` command on PATH is 8.2.12 until the PATH order is changed. Restart the current `artisan serve` on port 8000 with the 8.4 binary so local traffic matches Apache.

2. **Enable zip in the PHP 8.4 ini.**  
   In `C:\xampp84\php\php.ini`, change line 949 from `;extension=zip` to `extension=zip`. Restart Apache. Confirm `class_exists('ZipArchive')` is true under `C:\xampp84\php\php.exe` and, separately, under the Apache module. Then run `C:\xampp84\php\php.exe` `composer check-platform-reqs` and expect `ext-zip` to succeed. This is an ini change, not a Composer change.

3. **Confirm which ini Apache loads.**  
   `PHPINIDir` is `C:/xampp84/php`. `PHPRC` is `\\xampp\\php`. Check a local phpinfo response, or align `PHPRC` with `C:/xampp84/php`, before treating Apache as the 8.4 runtime. The `safe_mode` flags in that Apache file are inert on PHP 8.4; they do not need an application change.

4. **Leave Redis and sodium alone unless a feature needs them.**  
   Install `ext-redis` only if cache, session, or queue will move off `database`, or if code starts calling Redis. Sodium is unused while the cipher is `AES-256-CBC`.

5. **Turn deprecation logging on for a burn-in, then review it.**  
   Set `LOG_DEPRECATIONS_CHANNEL` to a real channel such as `daily` for the trial window. Exercise admin login, a public page, media upload, the old-submission CSV import, and an XLSX export if the admin UI exposes one. Deprecations found there are warnings for a later cleanup. They are not PHP 8.4 fatals. Set the channel back to `null` if the noise is not useful after the trial.

6. **Do not reset passwords and do not migrate for this upgrade.**  
   Bcrypt rounds are already 12. The database connection already works. Schema changes are outside this compatibility fix.

7. **Optional ini cleanup, after the burn-in.**  
   Remove `session.trans_sid_tags` and the `E_STRICT` token from `error_reporting` so a future PHP that removes them does not warn at startup. Keep `session.use_trans_sid=0`.

## 11. Final Compatibility Assessment

| Question | Answer |
| --- | --- |
| Does Laravel 12.64.0 run on PHP 8.4.27? | Yes. Artisan reported 12.64.0 and a framework database query ran. |
| Do locked Composer constraints allow 8.4.27? | Yes. 156 of 156 `php` constraints accept it. The remaining package accepts it through `php-64bit: ^8.2`. |
| Is there a platform-check failure? | Yes. `ext-zip` only. |
| Does first-party code use removed or PHP 8.4-deprecated language features? | No issue found. |
| Does the database connect through PDO on PHP 8.4.27? | Yes. MariaDB 10.11.16, mysqlnd 8.4.27, Laravel driver `mysql`. |
| Are application code changes required? | No. |

**Compatible with Minor Fixes**

Enable the zip extension in the PHP 8.4 configuration and run the application with `C:\xampp84\php\php.exe` (CLI and the dev server). After that, the installed Laravel 12.64.0 application is compatible with PHP 8.4.27. No source, Composer, or schema change is required for the language upgrade.
