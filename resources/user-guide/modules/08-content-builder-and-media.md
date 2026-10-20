---
title: Content builder and media
group: Content modules
summary: Body blocks, pasted HTML, featured images, and where uploaded files are stored.
sort: 70
keywords: content builder, blocks, html, media, uploads, featured image, gallery
---

The Content Builder is the body editor on content records. Add a block, fill it in, and drag blocks into order. Blocks can be collapsed.

## Blocks

| Block | Use it for |
|---|---|
| Paragraph | Rich text with headings, lists, links, quotes, and code styling inside the paragraph |
| Heading | A standalone H2, H3, or H4, left or center aligned |
| Image | One image, alt text, and an optional caption |
| Gallery | Several images with alt text |
| Quote | A quotation with optional author and role |
| Buttons | Up to three buttons, each with label, URL, style, and same-tab or new-tab |
| CTA | A call-to-action band with heading, description, button, icon, and theme |
| Embed | An embed URL with title and caption |
| HTML Code | A temporary paste workspace. It is converted into native blocks and is not stored as raw HTML |
| Code | A fenced snippet with a language and optional filename |
| Table | Header cells and rows |
| FAQ | A title plus questions and answers |
| Callout | A short note with an info, success, warning, or danger tone |

## Paste HTML

1. Add an **HTML Code** block.
2. Paste the markup. The preview strips scripts and unsafe markup.
3. Choose **Convert to Content Blocks**.
4. Review the generated heading, paragraph, and other native blocks, then remove the workspace if it is still present.

The converter expands HTML workspaces when the record is saved, so the stored body stays in native blocks.

## Images on a record

- **Featured image** is the hero or thumbnail for that record. Replacing a blog featured image removes the previous one.
- **Image** and **Gallery** blocks are inline media.
- Case study and eBook PDFs use the separate **Download PDF** / **eBook PDF** field, not an image block. See [Gated downloads](topic:gated-downloads).

Alt text is limited to 255 characters on image blocks.

## Additional CSS and JavaScript

The Content Builder also has a collapsed **Additional CSS & JavaScript** section. It is available to administrators and authors. CSS and JavaScript entered there apply only on that record's detail page. They are not stored as content blocks and are not printed on listing or archive pages.

## Where files go

Uploads use the `media` disk. Locally that is `public/uploads`, served at `/uploads`. On staging and production the disk root must be the account's `public_html/uploads` path (`MEDIA_ROOT`). A relative root inside the Laravel project is not the directory Apache serves on cPanel.

Files are stored in purpose-based folders, for example featured images under a folder for that content type. You do not need a `storage:link` symlink for this disk.
