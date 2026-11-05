---
title: Queues, logs, and maintenance
group: Administration
summary: Inspect failed jobs, read application logs, and clear cache without touching content.
sort: 20
keywords: queue, failed job, log viewer, cache, compiled views, QUEUE_MONITOR_MAX
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

## System maintenance

Open **Administration → System Maintenance**. Each action asks you to confirm.

| Action | Effect |
|---|---|
| Clear Sitemap Cache | Drops cached XML. The next sitemap request builds it again. |
| Clear Cache | Clears the application cache store. |
| Clear Compiled Views | Deletes compiled Blade templates so the next request compiles them again. |

The public-site toolbar **Clear cache** button runs only the application-cache clear, and only for administrators.

Run these after a deploy or after a settings change that still looks stale. They do not move content to trash and they do not purge Cloudflare. Cloudflare is a separate screen.
