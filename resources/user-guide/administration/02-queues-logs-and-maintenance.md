---
title: Queues, logs, and maintenance
group: Administration
summary: Inspect failed jobs, read application logs, and clear cache without touching content.
sort: 20
keywords: queue, failed job, log viewer, cache, cache management, compiled views, QUEUE_MONITOR_MAX, website health, scheduler, ssl
---

These screens are administrator-only. None of them deletes CMS content.

## Queue monitor

Open **Administration → Queue monitor**.

The page shows the database queue backlog, reserved jobs, failed jobs, and the monitoring threshold from `QUEUE_MONITOR_MAX`.

1. Choose **Refresh** to reload the counts.
2. Expand a failed job to read its exception.
3. **Retry** pushes that one job back onto its original queue and removes that failed-job row. Other jobs, sessions, cache, and CMS records stay as they are.

Form notification mail and media conversions are the jobs you will see most often. Media work belongs on the `media` queue. A worker for that queue needs a long timeout because image conversions are slow.

If the backlog stays high, the server worker is not running. The panel can retry a failed job; it does not replace a stopped worker.

## Application logs

Open **Administration → Application logs**.

1. Filter the file list by name or date. Daily files look like `laravel-YYYY-MM-DD.log`.
2. Select a file.
3. Search the message text, or limit the levels.
4. Switch between **Parsed** entries and **Raw log**.
5. Large files are scanned from the newest portion only. The file on disk is not modified.

Use this after a failed queue retry or a public error. Telescope, when enabled, is a separate developer tool and is also limited to administrators.

## Cache Management

Open **Administration → Cache Management**. Monitor and manage application, framework, and sitemap caches. Each action asks you to confirm.

The page also shows the cache store name and whether a route or configuration cache file exists. That status is read-only.

| Action | Effect |
|---|---|
| Clear Sitemap Cache | Drops cached XML. The next sitemap request builds it again. |
| Clear Application Cache | Empties the application cache store, including sitemap XML, cached settings, the cookie-consent snapshot, and rate-limit counters. Sessions, jobs, content, and cache locks stay. |
| Clear View Cache | Deletes compiled Blade templates so the next request compiles them again. |
| Clear Route Cache | Deletes the cached route file. Routes are not rebuilt. |
| Clear Configuration Cache | Deletes the cached configuration file. Configuration is not rebuilt. |
| Clear All Application Cache | Clears configuration, routes, compiled views, and the application cache, in that order. If one step fails, it stops and names that step. |

The public-site toolbar **Clear cache** button asks for confirmation, then runs only the application-cache clear, and only for administrators.

Run these after a deploy or after a settings change that still looks stale. They do not rebuild configuration, routes, or views, they do not move content to trash, and they do not purge Cloudflare. Cloudflare is a separate screen.

## Website health

Open **Administration → Website health**.

The page reports whether the public site responded, whether the database responded, whether storage is writable, how much disk space is free, whether the scheduler and queue worker have checked in, certificate expiry for an HTTPS application URL, the application environment, and recent error lines from the application log. It also keeps the last checks so you can see a failure and a recovery.

**Run check** records one new snapshot. It does not clear cache, change maintenance mode, retry jobs, delete files, or restart anything. The button waits while that request is running, and a second request is ignored until the first one finishes. A check also cannot be started again for 30 seconds.

Status meanings:

| Status | Meaning |
|---|---|
| Healthy | The check passed. |
| Warning | Something needs attention, such as a full disk trend, a failed job, a certificate inside 14 days, or maintenance mode answering the public site. |
| Critical | The check failed. A missing scheduler signal, a site that did not respond, or a certificate that failed verification is critical. |
| Not applicable | The check does not apply here. Local HTTP has no SSL check. The sync queue driver does not use a worker. |
| Unknown | The check could not be measured. |

The scheduler row stays critical until the server runs `php artisan schedule:run` every minute. The queue worker row stays a warning until a worker processes the single signal job. Those are server processes. This screen does not start them. Clearing the application cache does not reset those signals.

The certificate check verifies the certificate presented for the application hostname. On a site behind Cloudflare, that is usually the edge certificate. A failed verification is reported as critical. The check does not turn verification off to inspect an untrusted certificate.
