---
title: Pages, industries, landing pages, and newsletters
group: Content modules
summary: Administrator-only site pages, campaign URLs, and newsletter issues.
sort: 50
keywords: page, industry, landing page, newsletter, lp, template
---

These four modules are administrator-only. Authors do not see them in the sidebar.

## Pages

**Content → Pages** holds general CMS pages such as the home page and `/contact-us/`.

1. Create or edit a page.
2. Set the title and slug. The public URL is `/{slug}/`.
3. Choose the page template when the form offers one.
4. Set status and publish date.
5. Add the featured image, content blocks, and SEO.
6. Save.

`/contact` is a permanent redirect to `/contact-us/`. Do not create a second page at the slug `contact` expecting it to replace that redirect.

The public home page is the published CMS page whose slug is `home`. It is served at `/`. Other pages use `/{slug}/`.

## Industries

**Content → Industries** manages industry landing pages.

- There is no industry index route.
- Each published industry is `/industry/{slug}/`.
- Status, featured image, content blocks, and SEO work the same way as other pages.

## Landing pages

**Content → Landing Pages** manages campaign pages at `/lp/{slug}/`.

Landing pages can include an inquiry form. Submissions are stored with the form name `lp-{slug}` and show up under **Sales → Submissions**. A repeat of the same email, form, and IP within 120 seconds is treated as already received: the visitor still sees success, and a second submission row is not created.

Thank-you variants of a landing page are excluded from the form-notification override list.

## Newsletters

**Content → Newsletters** manages archived newsletter issues.

- Index: `/newsletter/`
- Issue: `/newsletter/{slug}/`

The public newsletter inquiry form (`newsletter_inquiry`) is separate from these issue pages. Inquiry submissions are reviewed in Sales. See [Form submissions](topic:form-submissions).
