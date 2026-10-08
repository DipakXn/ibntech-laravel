# URL audit report

Read-only audit of hardcoded hosts and application URLs. No application code, database rows, or `.env` values were changed.

Target origins:

| Environment | Origin |
| --- | --- |
| Local | `http://localhost:8000` |
| Staging | `https://dev.ibntech.com` |
| Production | `https://www.ibntech.com` |

The local `.env` already sets `APP_URL=http://localhost:8000`. Generated URLs from `url()`, `route()`, and `asset()` follow that value. Stored canonicals and a few Blade links do not.

Searched: `app/`, `resources/`, `routes/`, `config/`, `database/` (seeders and the live database), `public/` (excluding compiled Filament and Vite bundles), `resources/js`, email views, and SEO/sitemap code. `vendor/`, `storage/framework/views`, and `public/build` were excluded as generated output.

Priority:

- **Critical** — public pages can advertise the wrong origin (canonical, Open Graph, JSON-LD, or a sitewide link).
- **High** — same-site links or seed data are locked to one host.
- **Medium** — fallback or scheme behavior is wrong only when `APP_URL` is missing or the page is served over HTTP.
- **Low** — comment, placeholder, or example text.

---

## Critical

These rows publish a fixed host instead of the current `APP_URL`.

| File | Line | Current URL | Recommended solution | Priority |
| --- | --- | --- | --- | --- |
| `app/Services/SeoService.php` | 66 | Stored `canonical_url`, else `url()->current()` | Prefer `url()->current()` when the stored canonical is this site (`ibntech.com`, `www.ibntech.com`, `dev.ibntech.com`, `localhost`, `127.0.0.1`). Keep a stored canonical only when it is a genuinely different host. `route()` / `url()` already follow `APP_URL`. | Critical |
| `app/Services/SeoService.php` | 256–259 | Same stored canonical in JSON-LD `url` and `@id` | Use the same resolved canonical as the `<link rel="canonical">` tag. | Critical |
| `resources/views/layouts/app.blade.php` | 23, 76 | `{{ $seo['canonical_url'] ?? url()->current() }}` | No Blade change once `SeoService` stops passing a cross-environment canonical. Layouts already use `url()->current()` as the fallback. | Critical |
| `resources/views/layouts/landing.blade.php` | 26, 78 | Same pattern as the main layout | Same as the main layout. | Critical |
| Database `seo_meta` (`App\Models\Page`) | 172 rows | `https://www.ibntech.com/...` | Clear same-site `canonical_url` values (set them to null) so each environment emits its own origin. Do not copy this column between environments. Re-seeding from `WordPressPagesSeeder` writes these production URLs back. | Critical |
| Database `seo_meta` (`App\Models\Industry`) | 10 rows | `https://www.ibntech.com/industry/...` | Same as pages. Source is `database/seeders/IndustrySeeder.php`. | Critical |
| Database `seo_meta` (`App\Models\Newsletter`) | 3 rows | `https://www.ibntech.com/newsletter/...` | Same as pages. Source is `database/seeders/NewsletterSeeder.php`. | Critical |
| Database `seo_meta` (`App\Models\LandingPage`) | 2 rows | `https://www.ibntech.com/lp/...` | Same as pages. Source is `database/seeders/LandingPageSeeder.php`. | Critical |
| Database `seo_meta` (`App\Models\Blog`) | 522 rows | `http://localhost:8000/...` | These match local, and they are wrong on staging and production if this database is promoted. Store null and let `url()->current()` build the loc. Sitemap code already rebuilds locs from `config('app.url')`; the HTML canonical does not. | Critical |
| `resources/views/components/landing/footer.blade.php` | 52 | `https://ibntech.com/privacy-policy/` | `route('page.show', ['slug' => 'privacy-policy'])`. This is the apex host, not `https://www.ibntech.com`, so local and staging leave the current site. | Critical |
| `resources/views/components/landing/footer.blade.php` | 54 | `https://ibntech.com/terms-of-use/` | `route('page.show', ['slug' => 'terms-of-use'])`. | Critical |

`og:url` in both layouts uses the same canonical value, so the 187 production canonicals also become the Open Graph URL on local and staging.

Canonical host counts in `seo_meta` (read-only):

| Content type | `http://localhost:8000` | `https://www.ibntech.com` | Empty |
| --- | ---: | ---: | ---: |
| Blog | 522 | 0 | 5 |
| Page | 0 | 172 | 16 |
| Industry | 0 | 10 | 0 |
| Newsletter | 0 | 3 | 0 |
| Landing page | 0 | 2 | 12 |
| Article, case study, ebook, press release, white paper | 0 | 0 | all rows |

No `seo_meta` canonical uses `https://dev.ibntech.com` or the apex `https://ibntech.com`. `og_image`, `twitter_image`, and `redirect_url` have no absolute `http` URLs. `website_settings.robots_txt` and `sitemap_custom_urls` do not contain a site URL. Sitemap XML is built with `url()` / `config('app.url')`.

---

## High

Same-site links and import/seed data locked to production or to local.

| File | Line | Current URL | Recommended solution | Priority |
| --- | --- | --- | --- | --- |
| `resources/views/pages/bookkeeping-services-new-york.blade.php` | 278 | `https://www.ibntech.com/blog/outsourced-bookkeeping-in-new-york/` | `route('blog.show', ['slug' => 'outsourced-bookkeeping-in-new-york'])` | High |
| `resources/views/pages/treasury-management-services-outsourcing.blade.php` | 167 | `https://www.ibntech.com/case-study/treasury-operations-for-pennsylvania-based-company/` | `route('case-studies.show', ['slug' => 'treasury-operations-for-pennsylvania-based-company'])` | High |
| `app/Services/WordPress/LinkRewriter.php` | 10 | Rewrites only `https://(www.)ibntech.com/blog/...` to a root-relative path, and only during import | Extend the rewriter to every same-site path (`/`, `/industry/`, `/case-study/`, `/lp/`, images). Apply it when content is rendered, not only at import, so stored HTML does not have to be rewritten per environment. `dev.ibntech.com` is not rewritten today. | High |
| Database `blogs.content` | 506 rows | `https://www.ibntech.com/...` inside block JSON | Render-time rewrite to a root-relative path or `url($path)`. A one-time content update can do the same. Do not hardcode `www`. | High |
| Database `press_releases.content` | 57 rows | `https://www.ibntech.com/...` | Same render-time rewrite. Leave links to other publishers (`prnewswire.com`, `pymnts.com`, and similar) unchanged. | High |
| Database `articles.content` | 3 rows | `https://www.ibntech.com/...` | Same render-time rewrite. Leave `irs.gov` and other external citations unchanged. | High |
| Database `case_studies.content` | 1 row | `https://www.ibntech.com/...` | Same render-time rewrite. | High |
| `database/seeders/WordPressPagesSeeder.php` | about 1136–1837 (100 `canonical_url` values) | `https://www.ibntech.com/{slug}/` | Stop seeding absolute canonicals. Leave `canonical_url` null. | High |
| `database/seeders/IndustrySeeder.php` | 22, 32, 42, 52, 62, 72, and five further industry rows (10 total) | `https://www.ibntech.com/industry/{slug}/` | Leave `canonical_url` null. | High |
| `database/seeders/NewsletterSeeder.php` | 21, 31, 39 | `https://www.ibntech.com/newsletter/{slug}/` | Leave `canonical_url` null. | High |
| `database/seeders/LandingPageSeeder.php` | 23, 34, 45, 58, 71, 84, 97, 108 | `https://www.ibntech.com/lp/{slug}/` | Leave `canonical_url` null. | High |
| `database/seeders/LandingPageSeeder.php` | 46, 59, 72, 85 | `https://www.ibntech.com/wp-content/uploads/...` | Do not seed production WordPress image URLs. Use a local media path via the media disk (`MEDIA_URL`, currently `/uploads`) or `asset()`. These values are not currently stored in `seo_meta.og_image`. | High |
| `database/seeders/_tmp_ctes_seo.php` | 27 | `https://www.ibntech.com/construction-takeoff-estimation-services/` | One-off script that writes a production canonical. Do not run it. Remove it when code changes are allowed. | High |

`LinkRewriter` does not rewrite image URLs or non-blog paths, which is why hundreds of content rows still contain `https://www.ibntech.com` after import.

---

## Medium

| File | Line | Current URL | Recommended solution | Priority |
| --- | --- | --- | --- | --- |
| `app/Services/SeoService.php` | 597–598 | Any `http://` image URL is rewritten to `https://` for `og:image:secure_url` | Upgrade the scheme only when `config('app.url')` is `https`. On local this turns `http://localhost:8000/uploads/...` into `https://localhost:8000/uploads/...`. | Medium |
| `.env.example` | 5 | `APP_URL=http://localhost` | Document `APP_URL=http://localhost:8000` for local. Staging and production examples should be `https://dev.ibntech.com` and `https://www.ibntech.com`. The real `.env` is already `http://localhost:8000`. | Medium |
| `config/app.php` | 55 | Fallback `http://localhost` when `APP_URL` is empty | Keep a fallback, and do not default it to production. Require `APP_URL` in each deployed environment. An empty `APP_URL` drops `:8000` locally and would be the wrong host in production. | Medium |
| `app/Support/Sitemap/SitemapUrlNormalizer.php` | 233–236 | Fallback `http://localhost` (no port) | Same rule: this runs only when `config('app.url')` is empty. With the current `.env`, sitemap locs use `http://localhost:8000`. | Medium |
| `config/mail.php` | 49 | EHLO domain parsed from `APP_URL`, fallback host `localhost` | Leave the fallback. Set `APP_URL` (or `MAIL_EHLO_DOMAIN`) per environment so staging and production do not EHLO as `localhost`. | Medium |

Docs in `README.md`, `docs/PRODUCTION_DEPLOYMENT.md`, and `docs/DEPLOYMENT-GitHub-GUIDE.md` often show production as `https://ibntech.com` (apex). Seed data and stored page canonicals use `https://www.ibntech.com`. Pick one production origin. This audit treats **`https://www.ibntech.com`** as that origin, with the apex host redirecting to `www`. `APP_URL` on production should be the `www` origin. `public/bootstrap-path.php` already treats both hosts as the production filesystem root; that part should stay.

---

## Low

| File | Line | Current URL | Recommended solution | Priority |
| --- | --- | --- | --- | --- |
| `app/Filament/Pages/CloudflareCache.php` | 181 | Placeholder `https://www.ibntech.com/` | Placeholder only. Optional: `config('app.url')` so the hint matches the current environment. Validation already requires any absolute `http`/`https` URL. | Low |
| `app/Console/Commands/MigratePagePublishedAtCommand.php` | 163–164 | Comment examples `https://www.ibntech.com/it-services/` and `.../bookkeeping-services/payroll/` | Comments only. Leave them. | Low |
| `app/Support/Sitemap/SitemapUrlNormalizer.php` | 91, 95, 245 | Host checks for `localhost`, `127.0.0.1`, `.localhost` | Environment detection, not a public link. Leave it. `dev.*` is already treated as non-production. | Low |

---

## Helpers to use

| Need | Helper |
| --- | --- |
| Public page, blog, case study, industry, landing page, newsletter | `route()` with the named route in `routes/web.php` |
| Canonical, Open Graph URL, sitemap `<loc>`, robots `Sitemap:` line | `url()->current()` or `url($path)`, which read `config('app.url')` |
| Built CSS/JS | `@vite` / `asset()` |
| Uploaded media | Media library URL (`MEDIA_URL=/uploads` is already root-relative) |
| Console, mail, and queued jobs with no HTTP request | `config('app.url')` via `APP_URL` |
| External sites (social, maps, booking, reCAPTCHA, Cloudflare API, share buttons) | Keep the absolute third-party URL |

`routes/web.php` has no domain constraints. `resources/js/app.js` and `resources/js/bootstrap.js` do not hardcode a site origin. Axios uses relative URLs. Email Blade templates (`resources/views/emails/`) do not hardcode a site URL. Sitemap Blade views only contain the sitemap schema namespace.

Most page templates already call `route()`. The landing footer and the two page links above are the Blade exceptions.

---

## URLs that should stay unchanged

| Location | URL | Why it stays |
| --- | --- | --- |
| `public/bootstrap-path.php` lines 18–28 | `localhost`, `127.0.0.1`, `dev.ibntech.com`, `ibntech.com`, `www.ibntech.com` | Maps the request host to the Laravel root on disk. Not a generated public URL. |
| `config/database.php`, `config/cache.php`, `config/queue.php`, `config/mail.php` | `127.0.0.1` / `localhost` | Default MySQL, Redis, Memcached, Beanstalk, and SMTP hosts. Overridden by `DB_HOST`, `REDIS_HOST`, `MAIL_HOST`. |
| `.env` `APP_URL` | `http://localhost:8000` | Already the local target. Do not commit `.env`. |
| `phpunit.xml` line 22 | `APP_URL=http://localhost` | Test suite base URL. Feature tests assert this host on purpose. |
| `public/hot` | `http://[::1]:5173` | Vite dev server. Gitignored. Not an application URL. |
| `resources/views/components/landing/footer.blade.php` lines 5–25 | Facebook, LinkedIn, X, Instagram, YouTube | External profiles. |
| `resources/views/pages/ibn-team.blade.php` | `https://in.linkedin.com/in/...` | External profiles. |
| `resources/views/pages/contact-us.blade.php` lines 11, 33 | `https://maps.app.goo.gl/...` | External maps. |
| `resources/views/pages/thank-you.blade.php` line 22 | `https://outlook.office365.com/book/IBNBookkeepingServices@cloudibn.com/` | External booking page. |
| `resources/views/landing-pages/construction-engineering-services.blade.php` line 5 | `https://bookings.cloud.microsoft/book/...@ibntech.com/` | External booking page. The mailbox is `@ibntech.com`; the host is Microsoft. |
| `resources/views/pages/treasury-management-services-outsourcing.blade.php` line 74 | `https://www.cloudibn.com/` | Sister site, not this application. |
| Share buttons in article, press release, and white-paper templates | `facebook.com`, `twitter.com`, `linkedin.com` | Share endpoints. The shared URL already comes from `request()->fullUrl()`. |
| `resources/views/layouts/landing.blade.php` | Google Tag Manager, gtag, reCAPTCHA, Font Awesome CDN | Third-party scripts. IDs come from website settings. |
| `app/Rules/ReCaptcha.php` | `https://www.google.com/recaptcha/api/siteverify` | Google API. |
| `app/Services/CloudflareCacheService.php` | `https://api.cloudflare.com/client/v4` | Cloudflare API. |
| `app/Support/BlockContent.php` | YouTube and Vimeo embed hosts | External players. |
| Sitemap XML namespaces | `http://www.sitemaps.org/schemas/sitemap/0.9` | Schema identifier. |
| SVG `xmlns` | `http://www.w3.org/2000/svg` | Markup namespace. |
| Contact `mailto:` addresses (`sales@`, `info@`, `recruitment@`, and similar) | Email addresses, not site URLs | Keep as contact details. |
| `tests/` | `http://localhost` and `https://www.ibntech.com` fixtures | Assertions for the URL normalizer and SEO behavior. They should keep using those hosts. |
| Database `blog_imports.source_url`, `press_release_imports.source_url`, `media.custom_properties.source_url` | `https://www.ibntech.com/...` | Import provenance, used to avoid downloading the same WordPress file twice. Not a public href. |
| Database `old_submissions.page_url`, `form_submissions.page_url`, `email_logs` | Historical `www.ibntech.com` or `http://localhost:8000/livewire-...` | Records of past requests and sent mail. Do not rewrite. |
| `config/cloudflare.php` comment | “Production (ibntech.com)” | Comment only. Proxy IP ranges stay. |

---

## Summary

1. **Total findings:** 32 actionable rows in the tables above (11 critical, 13 high, 5 medium, 3 low). Routes, frontend JS, email templates, and sitemap generation do not hardcode an application origin.
2. **Critical findings:** 11. `SeoService` prints stored absolute canonicals. 187 `seo_meta` rows are `https://www.ibntech.com` (pages, industries, newsletters, landing pages). 522 blog canonicals are `http://localhost:8000`. The landing footer links to `https://ibntech.com` (apex, not `www`).
3. **Files affected:** `app/Services/SeoService.php`, `app/Services/WordPress/LinkRewriter.php`, `app/Support/Sitemap/SitemapUrlNormalizer.php`, `app/Filament/Pages/CloudflareCache.php`, `resources/views/layouts/app.blade.php`, `resources/views/layouts/landing.blade.php`, `resources/views/components/landing/footer.blade.php`, `resources/views/pages/bookkeeping-services-new-york.blade.php`, `resources/views/pages/treasury-management-services-outsourcing.blade.php`, `config/app.php`, `config/mail.php`, `.env.example`, four seeders plus `database/seeders/_tmp_ctes_seo.php`, and live rows in `seo_meta`, `blogs`, `press_releases`, `articles`, and `case_studies`.
4. **Recommended changes (not applied):**
   - Set each environment’s `APP_URL` to the origin in the table at the top. Local is already correct.
   - Generate same-site canonicals with `url()->current()` instead of a stored production or localhost URL.
   - Replace the four Blade `ibntech.com` links with `route()`.
   - Rewrite same-site URLs in CMS HTML at render time (broader than today’s `/blog/`-only importer).
   - Stop seeding absolute `canonical_url` and `wp-content` image URLs.
   - Use `https://www.ibntech.com` as the single production origin. Point the apex host at `www`.
5. **Leave unchanged:** host detection in `public/bootstrap-path.php`, database/Redis/mail `127.0.0.1` defaults, `phpunit.xml`, Vite `public/hot`, third-party and sister-site URLs, booking links, mailto addresses, schema namespaces, tests, and import/history columns (`source_url`, old submissions, form submissions, email logs).
