---
title: Website settings
group: Configuration
summary: Brand, default SEO, contacts, social links, scripts, and the default form recipient.
sort: 10
keywords: website settings, brand, logo, robots, contact, social, scripts
---

**Administration → Website Settings** is administrator-only. Save writes one settings record, refreshes robots.txt, and clears the sitemap cache so the next request rebuilds XML.

## Sections

| Section | What to edit |
|---|---|
| Brand identity | Logos and brand assets used by the public site |
| General metadata defaults | Default meta title and description when a page does not set its own |
| Open Graph defaults | Default social title, description, and image |
| Twitter / X defaults | Default card text and images |
| Robots meta defaults | Default index and follow behavior |
| XML sitemap | Enable the sitemap, cache lifetime, and which URL tags to emit |
| Content types | Per-type sitemap inclusion and defaults |
| Custom URLs | Extra sitemap URLs, including query strings |
| Header contacts | Phone and email shown in the header |
| Office addresses | Addresses shown on the site |
| Social profile URLs | Profile links |
| Admin notification recipients | Default inbox for form mail, plus per-form overrides |
| Analytics & verification | Analytics IDs and site-verification codes |
| Global scripts | Site-wide head or body snippets |

Record-level SEO overrides these defaults. See [SEO metadata](topic:seo-metadata).

## Save

1. Change the fields you need.
2. Save settings (or use the save shortcut).
3. Check the public page that should reflect the change. Brand and contact fields are immediate. Sitemap XML updates after the cache clear that runs on save.

Do not paste secrets into Global scripts. Analytics IDs and verification tokens belong in Analytics & verification.

Form recipient fields are covered in [Mail and notifications](topic:mail-and-notifications). Sitemap fields are covered in [Sitemap, robots, and analytics](topic:sitemap-robots-and-analytics).
