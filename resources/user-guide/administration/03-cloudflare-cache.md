---
title: Cloudflare cache
group: Administration
summary: Store the zone credentials and purge Cloudflare without deleting site content.
sort: 30
keywords: cloudflare, purge, api token, cdn
---

**Administration → Cloudflare Cache** is administrator-only. The API token is stored encrypted. The screen can show it again so an administrator can review or replace it.

## Save credentials

1. Open **Administration → Cloudflare Cache**.
2. Enter the zone ID and API token in **Cloudflare Configuration**.
3. Save.

The token is encrypted with the application key. If `APP_KEY` changes, the saved token must be entered again.

## Purge

Use the purge actions on that screen when a public page is still serving an old Cloudflare copy after the CMS and the application cache are already correct.

- Purge the zone when a template, stylesheet, or global setting changed.
- Purge specific URLs when one page is stale. Paste the public URL, including the trailing slash for HTML pages.

Purging Cloudflare does not delete media from `public/uploads` and does not clear the Laravel sitemap cache. Use [Queues, logs, and maintenance](topic:queues-logs-and-maintenance) for Laravel cache, then purge Cloudflare if the edge copy is still old.

If a purge fails, read the notification on the page and the matching entry in Application logs. A wrong zone ID or a token without cache-purge permission is the usual cause.
