---
title: Publish, preview, and trash
group: Workflows
summary: Take a record live, review it before it is public, or move it to trash and restore it.
sort: 10
keywords: draft, published, scheduled, preview, trash, restore, status
---

Blogs, articles, case studies, eBooks, white papers, and press releases use **Draft**, **Scheduled**, and **Published**. Pages, industries, landing pages, and newsletters stay on **Draft** and **Published**. Only Published records whose publish date is empty or already due are included on public indexes and detail URLs.

Some forms open as Published (blogs) and some as Draft (eBooks). Check the status field before the first save.

## Publish a record

1. Open the record.
2. Confirm the slug. Changing a published slug changes the public URL.
3. Set **Status** to Published for a record that should be live now.
4. Set the publish date. On an editorial record, a future date is stored as Scheduled and the public URL stays offline until that time. The scheduler then marks it Published. Listing order uses that date, then the created time if the date is empty. A draft is never auto-published.
5. Save.
6. Open the public URL from [Content map](topic:content-map), including the trailing slash, and confirm the page. A scheduled URL returns not found until the publish time.

Unpublish by switching the status back to Draft and saving. The public URL stops serving that record.

## Preview

1. Open the edit screen for a record you are allowed to edit.
2. Use the **Preview** action. It opens in a new tab.
3. The panel creates a signed preview URL. Unsigned or expired links return not found.
4. Signed links last 72 hours by default (`cms.preview_ttl_hours` in `config/cms.php`).

Preview works for drafts and scheduled records. Trashed records are excluded from preview. Generate a new preview from the edit screen if a link has expired. Do not share a preview URL as a permanent public link.

## Move to trash

1. From the list or the edit screen, choose **Move to Trash**.
2. Confirm. The success message is "Moved to trash".
3. The record leaves the public site and the default list.

## Restore

1. Open the module list.
2. Switch to the **Trash** tab.
3. Restore the record from its row actions.

Trash is a soft delete. Restoring brings the record back with its previous status. A restored draft is still a draft until you publish it.
