---
title: SEO metadata
group: Workflows
summary: Fill the SEO section on a record and the defaults that apply when a field is empty.
sort: 20
keywords: seo, meta, open graph, twitter, json-ld, canonical, sitemap, robots
---

Each content record has an SEO section. Site-wide defaults live in **Administration → Website Settings** and are described in [Website settings](topic:website-settings).

## Fill in a record

1. Edit the record and open the SEO section.
2. **Basic SEO** — meta title, description, keywords, and focus keyword.
3. **Open Graph / Social** — title, description, image, and image alt for link previews.
4. **Twitter** — card type, title, description, image, and profile handles.
5. **Article Metadata** — author, published and modified dates, section, tags, and reading time in minutes. These tags are SEO article tags, not the blog category list.
6. **Schema / Structured Data** — optional raw JSON-LD. Leave auto-generate enabled when you want the built-in BlogPosting schema. Enable FAQ schema only when the page has a real FAQ block.
7. **Advanced / Technical** — canonical URL, robots, custom meta robots, redirect URL, sitemap inclusion, and custom head code.
8. Save the record.

## Images used in previews

Social images resolve in this order:

1. An Open Graph or Twitter image uploaded on the SEO record
2. A direct image URL stored in that SEO field
3. The record's featured image

## Indexing controls

- **Include in sitemap** defaults to on. Turn it off to omit that record from the XML sitemap.
- A `noindex` robots value, a redirect URL, or a canonical URL that points somewhere else also keeps the record out of the sitemap.
- Custom head code is injected for that record. Keep it to metadata. Do not paste untrusted scripts.

Sitemap generation itself is configured under Website Settings. See [Sitemap, robots, and analytics](topic:sitemap-robots-and-analytics).
