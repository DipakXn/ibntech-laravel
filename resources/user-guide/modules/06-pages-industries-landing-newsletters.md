---
title: Pages, industries, landing pages, and newsletters
group: Content modules
summary: Administrator-only site pages, campaign URLs, and newsletter issues. Blade and CSS are created with the record and edited in Cursor.
sort: 50
keywords: page, industry, landing page, newsletter, lp, template, blade, css, slug, redirect
---

These four modules are administrator-only. Authors do not see them in the sidebar.

The Blade file is the page design. The matching CSS file is the page stylesheet. The CMS record stores the URL, publish state, template name, featured image, and SEO. It does not edit Blade, HTML, or CSS.

## Create a record

1. Open **Content → Pages**, **Industries**, **Landing Pages**, or **Newsletters**.
2. Choose **New**.
3. Set the title and slug. The slug uses lowercase letters, numbers, and hyphens.
4. The template name is filled from the slug and stays read-only.
5. Save.

The first save creates a starter Blade file and a starter CSS file when those paths are empty. It does not overwrite a file that is already there. Saving again, publishing, trashing, or restoring does not regenerate or delete those files.

| Module | Blade | CSS |
|---|---|---|
| Pages | `resources/views/pages/{slug}.blade.php` | `resources/css/pages/{slug}.css` |
| Industries | `resources/views/industries/{slug}.blade.php` | `resources/css/industries/{slug}.css` |
| Landing pages | `resources/views/landing-pages/{slug}.blade.php` | `resources/css/landing-pages/{slug}.css` |
| Newsletters | `resources/views/newsletters/{slug}.blade.php` | `resources/css/newsletters/{slug}.css` |

Customize both files in Cursor. Commit them and deploy them with the database record. A record created only on the server does not put the files in the repository until someone copies them back.

`vite.config.js` already registers every CSS file in those folders. Restart `npm run dev` after a new stylesheet is created. Production needs `npm run build` before that stylesheet is served.

The edit screen shows **Blade file** and **CSS file** as Available or Missing. The list shows the same. Preview stays disabled while the Blade file is missing. Publishing is blocked while either file is missing.

The featured image is for SEO, social sharing, and listings. The in-page hero stays in the Blade file.

## Template and slug

The template name is the file basename. It is set once, from the slug, when the record is created.

The slug is the public URL. Changing it later does not rename the Blade or CSS file. The original filenames stay in place.

## Trash and delete

Moving a record to trash, deleting it permanently, or restoring it from trash affects only the CMS database record. The Blade and CSS files stay on disk. The confirmation dialog states this before you move to trash or delete permanently. Restore brings the record back; it does not remove or recreate files.

Reserved slugs are rejected. Pages cannot use slugs that already belong to other routes, including `blog`, `contact`, and `newsletter`. Landing pages cannot use `index`. Newsletters cannot use `index` or `footer`.

## Publish and redirects

Only **Published** records are public. A published record whose slug changes keeps a 301 from the old public URL to the new one. Drafts do not create that redirect. The redirect is stored for these records only. There is no separate redirect screen.

Newsletters have their own public URL, `/newsletter/{slug}/`, so a published newsletter slug change redirects too.

## Pages

**Content → Pages** holds general CMS pages such as the home page and `/contact-us/`.

The public URL is `/{slug}/`. The published page whose slug is `home` is served at `/`.

`/contact` is a permanent redirect to `/contact-us/`. Do not create a page with the slug `contact`.

## Industries

**Content → Industries** manages industry pages.

- There is no industry index route.
- Each published industry is `/industry/{slug}/`.

## Landing pages

**Content → Landing Pages** manages campaign pages at `/lp/{slug}/`.

The starter Blade file uses the existing campaign layout and inquiry form. The landing layout loads `resources/css/landing-pages/{template}.css` when that file exists, plus the shared landing layout stylesheet.

Landing pages can include an inquiry form. Submissions are stored with the form name `lp-{slug}` and show up under **Sales → Submissions**. A repeat of the same email, form, and IP within 120 seconds is treated as already received: the visitor still sees success, and a second submission row is not created.

The thank-you page list includes only other published landing pages. It omits the page being edited and thank-you pages.

Thank-you variants of a landing page are excluded from the form-notification override list.

## Newsletters

**Content → Newsletters** manages newsletter issues. The starter uses the newsletter layout, the shared newsletter stage, and the inquiry sidebar. It does not replace an existing designed issue.

- Index: `/newsletter/`
- Issue: `/newsletter/{slug}/`

The public newsletter inquiry form (`newsletter_inquiry`) is separate from these issue pages. Inquiry submissions are reviewed in Sales. See [Form submissions](topic:form-submissions).
