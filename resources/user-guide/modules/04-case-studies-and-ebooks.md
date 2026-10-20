---
title: Case studies and eBooks
group: Content modules
summary: Proof stories and gated PDFs, including the download file each record needs.
sort: 30
keywords: case study, ebook, pdf, download_pdf, gated
---

Administrators and authors can manage both modules. Downloads are a separate step from publishing the page. See [Gated downloads](topic:gated-downloads).

## Case study

1. Open **Content → Case Studies → New**.
2. Set the title and a unique slug. The public page is `/case-study/{slug}/`.
3. Choose a case study category, status, and publish date.
4. Upload the featured image.
5. Upload **Download PDF** when this story should offer a file. The field accepts a PDF and stores it on the `download_pdf` media collection.
6. Build the page body and SEO, then save.

The index is `/case-study/`. The file endpoint is `/case-study/{slug}/download` and does not use a trailing slash.

## eBook

1. Open **Content → eBooks → New**.
2. Set the title and slug. The public page is `/ebook/{slug}/`.
3. Choose an eBook category and status. New eBooks default to **Draft**.
4. Set the published date when you are ready for the public index. Leave it empty while the record stays a draft.
5. Upload the cover as the featured image (max 4 MB).
6. Upload **eBook PDF** (max 10 MB) to the `download_pdf` collection.
7. Add content blocks and SEO, then save.

The index is `/ebook/`. The file endpoint is `/ebook/{slug}/download`.

## Categories

Create categories from the category screen nested under the module, or inline while editing a record. A case study category never appears on an eBook, and the reverse is also true.
