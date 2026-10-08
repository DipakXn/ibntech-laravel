# URL migration implementation

Code now builds public URLs from the current `APP_URL`. The database was not queried or updated. `.env` and `.htaccess` were not edited. Nothing was deployed or pushed.

| Environment | `APP_URL` |
| --- | --- |
| Local | `http://localhost:8000` |
| Staging | `https://dev.ibntech.com` |
| Production | `https://www.ibntech.com` |

Same-site means a host of `localhost`, `127.0.0.1`, `ibntech.com`, `www.ibntech.com`, `dev.ibntech.com`, or any other `*.ibntech.com` host. A canonical on any other host is left unchanged.

## 1. Code files changed

- `app/Support/ApplicationUrl.php` (new)
- `app/Services/SeoService.php`
- `app/Services/WordPress/LinkRewriter.php`
- `app/Support/BlockContent.php`
- `app/Filament/Pages/CloudflareCache.php`
- `resources/views/components/landing/footer.blade.php`
- `resources/views/pages/bookkeeping-services-new-york.blade.php`
- `resources/views/pages/treasury-management-services-outsourcing.blade.php`
- `database/seeders/WordPressPagesSeeder.php`
- `database/seeders/IndustrySeeder.php`
- `database/seeders/NewsletterSeeder.php`
- `database/seeders/LandingPageSeeder.php`
- `database/seeders/_tmp_ctes_seo.php` (removed)
- `.env.example`
- `database/sql/local-url-fix.sql` (new, not executed)
- `database/sql/staging-url-fix.sql` (new, not executed)

## 2. What was changed

`ApplicationUrl` rebuilds a same-site URL on `config('app.url')` and keeps the path and query. `https://www.ibntech.com/about-us/` becomes `http://localhost:8000/about-us/` when `APP_URL` is the local origin, and `https://dev.ibntech.com/about-us/` when `APP_URL` is staging. `https://example.com/about-us/` stays as stored.

`SeoService` uses that helper for the canonical tag, Open Graph `og:url` (the layouts already print `canonical_url`), and JSON-LD `url` / `@id`. Same-site image URLs used for Open Graph, Twitter, and JSON-LD images are rebuilt the same way. `og:image:secure_url` is upgraded from `http` to `https` only when `APP_URL` itself is `https`, so local does not emit `https://localhost:8000/...`.

`LinkRewriter` now rewrites every same-site absolute URL (pages, blog, industry, case study, landing pages, and files such as `/wp-content/...`) to a root-relative path. `dev.ibntech.com`, `localhost`, and `127.0.0.1` are included. File URLs do not gain a trailing slash. External hosts are not rewritten. `BlockContent::prepareForRender()` runs this rewriter, so stored CMS HTML follows the host that is serving the page without a database update. WordPress import still rewrites blocks before they are saved.

Blade links that pointed at this site now use `route()`:

- Landing footer privacy and terms: `route('page.show', ...)`
- New York bookkeeping blog link: `route('blog.show', ...)`
- Treasury case study link: `route('case-studies.show', ...)`

The Cloudflare purge field placeholder is `config('app.url')` instead of a fixed production URL.

Seeders no longer contain `https://www.ibntech.com` canonicals or `wp-content` image URLs, and their `updateOrCreate` payloads no longer write `canonical_url`. Re-running a seeder will not put a production canonical back and will not null a canonical that is already stored. The one-off script `database/seeders/_tmp_ctes_seo.php` was removed so it cannot be run.

`.env.example` now shows `APP_URL=http://localhost:8000`, with comments for the staging and production values. The real `.env` was not changed.

`config/app.php` still falls back to `http://localhost` only when `APP_URL` is empty. `config/mail.php`, database, Redis, and cache defaults were not changed. `public/bootstrap-path.php` host detection was not changed.

## 3. Database issues found

These were read during the earlier audit. This implementation did not query or update them.

`seo_meta.canonical_url` is a nullable string. On the local database the audit found:

- 172 page rows, 10 industry rows, 3 newsletter rows, and 2 landing-page rows stored as `https://www.ibntech.com/...`
- 522 blog rows stored as `http://localhost:8000/...`

No canonical used `https://dev.ibntech.com` or the apex `https://ibntech.com`. `og_image`, `twitter_image`, and `redirect_url` had no absolute `http` URLs.

CMS `content` on blogs (506 rows), press releases (57), articles (3), and case studies (1) still contains `https://www.ibntech.com/...` inside block JSON. That is corrected at render time by `LinkRewriter`. The SQL files do not rewrite content, because a string replace inside JSON is easy to corrupt and those columns are not the canonical field.

Import provenance (`blog_imports.source_url`, `press_release_imports.source_url`, `media.custom_properties.source_url`) and historical rows (`old_submissions`, `form_submissions`, `email_logs`) were left alone. They are not public links.

Staging and production were not inspected. Their row IDs are not assumed to match local.

Until the SQL is run, published pages are still correct: the code swaps the origin at render time and keeps the stored path. After the SQL sets those canonicals to NULL, the tag becomes the current request URL (`url()->current()`). Run the SQL only if you want the stored value cleared. If any row’s canonical path is intentionally a different page on this site, skip that row or do not run the SQL; the code already serves it on the current host.

## 4. Local SQL file created

`database/sql/local-url-fix.sql`

Not executed.

## 5. Staging SQL file created

`database/sql/staging-url-fix.sql`

Not executed. No production SQL file was created. After this code is deployed, production canonicals on `www.ibntech.com` already match `APP_URL=https://www.ibntech.com`, and any localhost or staging canonical is rewritten in code. A production `UPDATE` is not required for the pages to advertise the right host.

## 6. SQL statements and what they change

Both files contain one `UPDATE` on `seo_meta`. It sets `canonical_url` to `NULL` when the value is an absolute URL on `www.ibntech.com`, `ibntech.com`, `dev.ibntech.com`, `localhost` (any port, including `:8000`), or `127.0.0.1` (any port). Matching is on the URL text, not on `id`.

The local file is only for the local database. The staging file is only for the staging database. They use the same condition because both environments should stop storing an environment-specific origin. A database that has none of those values updates 0 rows, which is a successful no-op.

The statement does not delete rows, does not change other columns, and does not touch canonicals on other hosts. Each file includes a commented `SELECT` you can run first.

## 7. URLs intentionally left unchanged

- `public/bootstrap-path.php` host map for local, staging, and production filesystem roots
- `config/database.php`, `config/cache.php`, `config/queue.php`, and `config/mail.php` defaults of `127.0.0.1` / `localhost`
- `config/app.php` empty-`APP_URL` fallback `http://localhost`
- `phpunit.xml` `APP_URL=http://localhost`
- `app/Support/Sitemap/SitemapUrlNormalizer.php` local-host detection and empty-`APP_URL` fallback
- `app/Console/Commands/MigratePagePublishedAtCommand.php` comment examples
- Analytics copy that mentions “localhost” as an office IP example
- External profiles, maps, Google, reCAPTCHA, Cloudflare API, Font Awesome, YouTube, Vimeo, sitemap and SVG namespaces
- `https://www.cloudibn.com/`
- Outlook and Microsoft booking links, including the mailbox `@ibntech.com`
- `mailto:` addresses
- Tests under `tests/`
- Vite `public/hot` (`http://[::1]:5173`), which is gitignored

## 8. .env changes required manually

`.env` was not modified. Local `APP_URL` is already `http://localhost:8000`.

Set these on each server. Do not copy one environment’s `.env` to another.

Local:

```
APP_URL=http://localhost:8000
```

Staging:

```
APP_URL=https://dev.ibntech.com
```

Production:

```
APP_URL=https://www.ibntech.com
```

`config/app.php` is only a fallback when `APP_URL` is missing. An empty `APP_URL` on a server would generate `http://localhost` links.

## 9. .htaccess changes required manually

None. `public/.htaccess` was not modified and does not need a URL change for this work.

Production should use `https://www.ibntech.com` as the canonical host. If the apex host `ibntech.com` must redirect to `www`, do that in hosting or Cloudflare, not in this `.htaccess` file.

## 10. Remaining hardcoded URLs

Searched `app/`, `resources/`, `config/`, `database/`, `public/` (excluding compiled Filament and Vite bundles), `.env.example`, and `phpunit.xml` for `localhost`, `127.0.0.1`, `dev.ibntech.com`, `www.ibntech.com`, and `https://ibntech.com`.

| Location | Classification |
| --- | --- |
| `app/Support/ApplicationUrl.php`, `app/Services/WordPress/LinkRewriter.php` | Intentional. Host lists used to detect this application and rewrite it. |
| `app/Support/Sitemap/SitemapUrlNormalizer.php` | Intentional. Local and empty-`APP_URL` detection. |
| `app/Filament/Resources/AnalyticsExcludedIps/...` | Intentional. Admin help text, not a link. |
| `app/Console/Commands/MigratePagePublishedAtCommand.php` lines 163–164 | Intentional. Comment examples only. |
| `config/app.php`, `config/database.php`, `config/cache.php`, `config/queue.php`, `config/mail.php` | Intentional. Framework defaults for the app URL fallback, MySQL, Redis, Memcached, Beanstalk, and SMTP. |
| `public/bootstrap-path.php` | Intentional. Request-host to filesystem map, including `ibntech.com` and `www.ibntech.com`. |
| `.env.example` `APP_URL=http://localhost:8000` and the staging/production comments | Intentional. Example only. The live `.env` was not edited. |
| `.env.example` `DB_HOST`, `MEMCACHED_HOST`, `REDIS_HOST`, `MAIL_HOST` | Intentional. Service hosts, not the public site. |
| `phpunit.xml` | Test/development. PHPUnit base URL is `http://localhost` with no port. |
| `tests/` fixtures using `http://localhost` and `https://www.ibntech.com` | Test/development. Left unchanged. `SeoMetaTagsTest` passed after the canonical change. |
| `database/sql/local-url-fix.sql` and `database/sql/staging-url-fix.sql` | Intentional. Match conditions for the manual cleanup. Not application links. |
| `docs/PRODUCTION_DEPLOYMENT.md` (`APP_URL=https://ibntech.com` and `APP_URL=https://dev.ibntech.com`) and `docs/media-uploads-deployment.md` (`APP_URL=https://ibntech.com`) | Requires manual review. Deployment notes still show the apex production origin. This implementation uses `https://www.ibntech.com`. Update those docs when you next edit them. |
| Blade, `resources/js`, routes, and email templates | No remaining same-site absolute URL. |

`resources/views` has no remaining `localhost`, `127.0.0.1`, `dev.ibntech.com`, `www.ibntech.com`, or `https://ibntech.com`.

## 11. Validation performed

- `php -l` reported no syntax errors for `ApplicationUrl.php`, `LinkRewriter.php`, `BlockContent.php`, `SeoService.php`, `CloudflareCache.php`, and the four edited seeders.
- A local check with `APP_URL=http://localhost:8000` rebased `www`, `localhost:8000`, and `dev.ibntech.com` paths onto `http://localhost:8000`, left `https://example.com/...` unchanged, and rewrote same-site HTML links to root-relative paths while leaving `cloudibn.com` and the Outlook booking URL unchanged.
- `php artisan view:clear` succeeded.
- `php artisan config:clear` succeeded.
- `php artisan test --filter=SeoMetaTagsTest` passed: 3 tests, 78 assertions.

Not run: migrations, seeders, the SQL files, and any database update.
