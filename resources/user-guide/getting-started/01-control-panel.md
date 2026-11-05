---
title: Control panel
group: Getting started
summary: What IBNTECH Control manages and how the dashboard is organized.
sort: 10
keywords: filament, dashboard, workspace, content, sales, administration, toolbar
---

IBNTECH Control is the Filament admin panel for this CMS. It is the place to publish the public website, review form submissions, and operate mail, cache, queues, and logs.

The public site is Blade-rendered. Editors do not write page templates in the panel. They manage records, and the site renders the published ones.

## Where to start

1. Sign in at `/ibn-tech-cms-login`. The dashboard itself is `/admin`.
2. Use the sidebar groups below. Groups collapse, and the sidebar can collapse to icons on desktop.
3. Open **Administration → User Guide** for the rest of this handbook. The guide is visible only to administrators.

## Sidebar groups

| Group | What lives there |
|---|---|
| Workspace | The control-center dashboard: content coverage, recent activity, and, for administrators, submission and visitor snapshots. |
| Content | Pages, industries, landing pages, newsletters, blogs, articles, case studies, eBooks, white papers, press releases, and their categories. |
| Sales | Form submissions, plus the archived Old Submissions import. Both are administrator-only. |
| Administration | Users, this guide, website settings, SMTP, Cloudflare, visitor analytics, maintenance, the queue monitor, application logs, and excluded analytics IPs. |

Authors see a shorter sidebar. Pages, industries, landing pages, newsletters, Sales, and Administration items are not registered for them. See [Roles and access](topic:roles-and-access).

## Public site toolbar

A signed-in administrator or author who can open the panel also sees an admin toolbar on the public website. It links back to the dashboard and offers create shortcuts the current user is allowed to use.

The toolbar **Clear cache** action is administrator-only. It clears the application cache and leaves content, sessions, and compiled views in place. The same application-cache action is available under [Queues, logs, and maintenance](topic:queues-logs-and-maintenance).

## What this guide covers

- Features and modules, with the public URLs the site actually serves
- Publishing, preview, trash, SEO, and gated downloads
- Website settings, mail, sitemaps, analytics, and environment values operators change
- Day-to-day administration

When a screen in the panel and a paragraph here disagree, trust the screen and then update the topic. See [Maintaining this guide](topic:maintaining-this-guide).
