---
title: Content map
group: Content modules
summary: Every content module, who can edit it, and the public URL it serves.
sort: 10
keywords: routes, blog, article, case study, ebook, white paper, press release, landing page, newsletter, industry
---

Published records appear on the public site. Drafts stay off the public URL until you publish them. Use **Preview** to review a draft. See [Publish, preview, and trash](topic:publish-preview-and-trash).

Public HTML URLs redirect to a trailing slash (`/blog/`, `/article/my-post/`). Admin URLs, download URLs, and files that already have an extension do not.

## Modules

| Module | Who edits it | Public URL |
|---|---|---|
| Pages | Administrator | `/{slug}/`. The published page with slug `home` is served at `/`. |
| Blog | Administrator and author | `/blog/`, `/blog/{slug}/`, `/blog/category/{slug}/` |
| Articles | Administrator and author | `/article/`, `/article/{slug}/` |
| Case studies | Administrator and author | `/case-study/`, `/case-study/{slug}/`, `/case-study/{slug}/download` |
| eBooks | Administrator and author | `/ebook/`, `/ebook/{slug}/`, `/ebook/{slug}/download` |
| White papers | Administrator and author | `/whitepapers/`, `/whitepapers/{slug}/` |
| Press releases | Administrator and author | `/pressrelease/`, `/pressrelease/{slug}/` |
| Industries | Administrator | `/industry/{slug}/` |
| Landing pages | Administrator | `/lp/{slug}/` |
| Newsletters | Administrator | `/newsletter/`, `/newsletter/{slug}/` |

The paths above are the ones registered in `routes/web.php`. Older notes that say `/articles/`, `/case-studies/`, `/ebooks/`, `/white-papers/`, or `/press-releases/` do not match this application.

## Shared editing pattern

Most records use the same three areas:

1. **Details** — title, slug, and sometimes a Blade template.
2. **Publishing** — category (where the module has one), status, publish date, and featured image.
3. **Content Builder** and **SEO** — body blocks and search metadata.

Step-by-step publishing is in [Publish, preview, and trash](topic:publish-preview-and-trash). Block types are in [Content builder and media](topic:content-builder-and-media).

## Home and contact

The home page is the CMS page served by the home route, not a separate module. `/contact` permanently redirects to `/contact-us/`.

Two legacy white-paper paths also redirect:

- `/white-paper-2` → `/whitepapers/how-cfos-benefit-from-profitcents/`
- `/white-paper-3` → `/whitepapers/how-ibn-helping-cfos-by-combining-efforts-with-profitcents/`
