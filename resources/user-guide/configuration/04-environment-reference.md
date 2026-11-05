---
title: Environment reference
group: Configuration
summary: The environment values that change how the running site behaves.
sort: 40
keywords: env, APP_URL, MEDIA_ROOT, queue, cache, recaptcha, telescope
---

These values live in the server `.env` file. Changing them is a deploy or server task, not a Filament field, except where this guide names a screen that overrides them.

## Application

| Variable | Role |
|---|---|
| `APP_URL` | Public base URL. Sitemaps and generated links use it. It must match the real domain. |
| `APP_DEBUG` | Leave `false` in production. |
| `APP_KEY` | Encryption key. Do not rotate it casually; encrypted values such as the Cloudflare token depend on it. |

## Content and traffic

| Variable | Role |
|---|---|
| `MEDIA_DISK` | `media` for local or server uploads. `s3` switches the media disk to S3. |
| `MEDIA_ROOT` | Absolute `public_html/uploads` path on cPanel. A project-relative path is not served by Apache there. |
| `MEDIA_URL` | Public prefix, normally `/uploads`. |
| `RECAPTCHA_SITE_KEY` / `RECAPTCHA_SECRET_KEY` | Both must be set or form reCAPTCHA is skipped. |
| `TELESCOPE_ENABLED` | Laravel Telescope. Disable it in production unless you intend to keep it. Telescope is limited to administrators. |

Preview links expire after `preview_ttl_hours` in `config/cms.php` (72 hours unless that config value changes).

## Queue, cache, session, logs

| Variable | Default role |
|---|---|
| `QUEUE_CONNECTION` | `database` unless you move it to Redis |
| `QUEUE_MONITOR_MAX` | Backlog size that raises the queue-busy warning. Default 100. |
| `CACHE_STORE` | `database` by default. Redis is supported. |
| `SESSION_DRIVER` | `database` |
| `SESSION_LIFETIME` | Minutes before a panel session expires. Default 120. |
| `LOG_CHANNEL` | `daily`, files in `storage/logs`, kept for `LOG_DAILY_DAYS` (30). |

## Mail

| Variable | Role |
|---|---|
| `MAIL_MAILER` | `log` writes messages to the log. Production SMTP is configured in the SMTP Settings screen. |
| `MAIL_LEAD_NOTIFICATION_TO` | Fallback form recipient when website settings do not set one. |

Do not commit `.env` or paste live passwords into this guide.
