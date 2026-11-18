# CMS capability review

**Reviewed:** 18 November 2026  
**Site:** IBN Technologies — services in finance and accounting, cybersecurity, cloud, AI, and SAP.

IBN Technologies is a services site. The control panel publishes thought leadership and runs the site well. It does not yet let marketing change the pages, menus, and leads that win the work.

> **Build the commercial surface next, not more editorial tools.**  
> Blogs, articles, case studies, eBooks, white papers, and press releases already have a content builder, preview, trash, and SEO. Service pages, industries, landing pages, the menu, the footer, and testimonials do not. That is the gap that slows the site’s actual job.

## What the site asks of the CMS

Visitors come for a service, a proof point, or a download. The CMS has to keep those pages accurate, capture the inquiry, and protect the search URLs carried over from the previous site. Publishing a blog post is already covered. Changing a service page, placing it in the menu, and working the lead are not.

| Metric | Value |
| --- | --- |
| Types with a body editor | 6 |
| Types bound to a template | 4 |
| Roles, and no review step | 2 |
| Forms in one inbox | 16+ |

## Where editors have control

Counts are content types in the Filament panel, from the resource forms and public templates.

### Content types by who can change the body

| Category | Body editable in the panel | Template only |
| --- | ---: | ---: |
| Editorial types | 6 | 0 |
| Commercial types | 0 | 4 |

### Recommendations by when to do them

| When | Count |
| --- | ---: |
| Now | 5 |
| Next | 6 |
| Later | 4 |

## Current modules

The sidebar is Workspace, Content, Sales, and Administration. Authors see the six editorial types and their categories. Administrators also see pages, industries, landing pages, newsletters, submissions, and operations.

### Content

| Module | Public role | What works | Limit |
| --- | --- | --- | --- |
| Blogs | Thought leadership | Categories, search, content builder, featured image, SEO, preview, and trash. New posts default to Published. | Defaulting to Published is easy to miss. No review, no history, and no schedule. |
| Articles | Second editorial stream | Same editor as blogs, with its own categories and `/article/` URLs. | The panel does not explain how an article differs from a blog, so authors maintain two nearly identical modules. |
| Case studies | Proof and a gated PDF | Content builder plus a signed download after the form. | No related services, and the lead has no status after it arrives. |
| eBooks | Gated research | PDF limited to 10 MB, signed download, and the form stored as `ebook_download`. | Same lead-inbox limit as case studies. |
| White papers | Research | Content builder, categories, SEO, and a public index. | No PDF and no download form, unlike the other two research types. |
| Press releases | Announcements | Content builder and a simple public archive. Appropriate for the job. | No embargo or scheduled release. |
| Pages | Home and service URLs | Slug, status, template picker, featured image, and full SEO, including sitemap overrides. | No body field. Home, contact, and every service page are Blade templates. |
| Industries | Sector pages | Same publishing controls as pages, at `/industry/{slug}/`. No public index, which fits. | Copy is the template. A new industry needs a new view file. |
| Landing pages | Campaigns | Template, thank-you page, and a form named `lp-{slug}` with a short duplicate window. | Campaign layout and questions are code. Marketers cannot launch a new layout from the panel. |
| Newsletters | Public issue archive | Index and issue URLs, administrator-only. | Archives a page. Does not compose or send email. The inquiry form is a separate lead. |
| Categories | Per content type | Nested under each editorial module, so blog categories never mix with articles. | Six separate category screens. Usable, and not worth merging until the types themselves are clearer. |

### Sales and operations

| Module | What works | Limit |
| --- | --- | --- |
| Control center | Greeting, content counts, recent activity, and for administrators a 7-day look at submissions and visitors. | A snapshot. It does not show unpublished work due this week, or which page created a lead. |
| Submissions | Search, form filter, page URL, IP, and the extra answers stored on each form. | An inbox. Rows can be edited or deleted. They cannot be assigned, progressed, exported, or marked spam. |
| Old submissions | Read-only archive of the imported history, kept off the live table. | Doing its job. Leave it read-only. |
| Users | Administrator and Author, invitations, a 12-character password rule, deactivation, an audit trail, and CSV export. | No reviewer. Authors who can edit a type can also publish it. |
| Website settings | Brand, default SEO, sitemap, offices, social links, per-form recipients, analytics IDs, and global scripts. | Strong as site configuration. It is not a place to edit navigation or page copy. |
| SEO on each record | Title, description, Open Graph, Twitter, article tags, JSON-LD, canonical, robots, sitemap inclusion, and a redirect URL. | The redirect field is per record and easy to forget. Nothing lists broken or duplicate metadata. |
| SMTP, queues, logs | Mail settings, a test send, email logs, a queue monitor, and application logs. The right place to see why a lead email never arrived. | Operational, and already sufficient. |
| Cookie management | Categories, a cookie registry, integrations, consent copy, and accept, reject, and custom counts. | Counts are lifetime totals, not a date range. Enough for operating the banner, thin as a compliance report. |
| Visitor analytics | First-party visitors and page views, with ranges, content type, and excluded IPs. | No conversions, and no referrer or campaign breakdown. |
| Cache, Cloudflare, maintenance | Separate cache actions, Cloudflare purge, and a public maintenance page. The public toolbar can clear application cache for administrators. | Solid. Keep these as their own screens. |
| User guide | In-panel handbook for administrators, grouped and searchable. | A few topics describe content blocks on pages and industries that the forms do not offer. Update those topics when the forms change. |

## What to do next

Priority follows the site’s job: accurate service pages, leads that get worked, and URLs that keep their search equity.

| When | Action | Module | Why this, for this site |
| --- | --- | --- | --- |
| Now | Improve | Pages, industries, and landing pages | These URLs sell the services. Editors can set the title, slug, Blade template, image, and SEO. The page copy itself lives in templates, so a wording change is a deploy. The in-panel guide already describes content blocks on these modules; the forms do not include them. |
| Now | Improve | Submissions | Sixteen named forms, plus one per landing page, land in a single inbox. There is no status, owner, internal note, spam flag, or CSV export. For a lead-generation site, capture without a working queue is where follow-up gets lost. |
| Now | Improve | White papers | eBooks and case studies gate a PDF behind a form and a signed download link. White papers, a core research asset, have a body and no file gate, so that traffic does not become a lead. |
| Now | Add | Redirect manager | Legacy WordPress URLs are permanent redirects written in application routes. A published slug can also change with no automatic 301. Each of those drops search equity this migration already worked to keep. A from/to list, plus a redirect when a live slug changes, belongs in the panel. |
| Now | Add | Navigation and footer | The mega menu and footer are templates. A new service page stays off both until someone edits markup. Editors need to attach a published page to a menu location without a release. |
| Next | Improve | Publish date | Status Published is public immediately. The publish date only sorts and displays the record, including when that date is in the future. A future date should hold the URL until then. |
| Next | Add | Review step and version history | Authors publish blogs, articles, case studies, eBooks, white papers, and press releases with no second approval, and nothing stores the previous body. Two roles are enough if Administrator is the publisher and each save keeps a restorable version. |
| Next | Improve | Visitor analytics | The panel counts visitors and page views, and separately counts form rows. It does not show which URL produced a submission or a gated download, which is the number marketing uses to judge an asset. |
| Next | Add | Testimonials | Client quotes on the home page are a fixed list in a template, while the public testimonials link points at a CMS page. Social proof for a services firm should be a record: quote, name, role, service, and where it appears. |
| Next | Add | Lead delivery | Notification email already routes by form. Sales still has to work the inbox. A webhook, or a CSV that matches the submission filters, lets a CRM receive the same payload the panel stores. |
| Next | Add | Media library | Images and PDFs attach to one record. Reusing a diagram, replacing a logo everywhere, or finding an orphaned file means hunting through content. A shared library fits the upload disk you already have. |
| Later | Add | Site search | Blog has search. Service pages, case studies, and the other resource types do not. Visitors looking for a service name should hit those URLs, not only posts. |
| Later | Add | SEO health list | Each record already has a full SEO section, sitemap inclusion, and robots controls. Nobody sees a list of published URLs missing a description, sharing image, or accidentally set to noindex. |
| Later | Add | Campaign form fields | New questions on a landing page require a new form class. After commercial pages are editable, a small set of extra fields on a landing page is the next constraint on campaign speed. |
| Later | Improve | Newsletters | The module archives public issues. It does not send them. Leave it as an archive unless email distribution is an actual goal. A send tool is a product of its own. |

**How to read the bands:** Now is five items because they unblock marketers and sales on the live site. Next makes publishing safer and shows which content earns the inquiry. Later is useful once those two are in place. Keep newsletters as an archive unless you decide to send email from this panel.

## Leave in place

| Decision | Area | Reason |
| --- | --- | --- |
| Keep | The six editorial modules and the content builder | Blocks, HTML conversion, preview links, and trash already match how this team publishes. Extending that builder onto commercial pages is the change, not replacing it. |
| Keep | Old submissions, SMTP, queues, cache, and Cloudflare | These are operating tools with a clear job. A new CRM screen should read the live submission table and leave the imported archive alone. |
| Keep | Two roles until a review step exists | Adding Editor, SEO, and Legal roles before there is an approval state only lengthens the sidebar. Make Administrator the publisher first. |
| Defer | Comments, localization, A/B tests, and a free-form page builder | The site is not a community, and US and UK offers are already separate pages. Editable service copy is enough. A free-form builder would fight the templates that give the site its layout. |

---

*Static export of the in-chat CMS capability review canvas (November 2026).*