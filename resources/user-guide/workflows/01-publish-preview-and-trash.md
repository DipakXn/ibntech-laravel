---
title: Publish, preview, and trash
group: Workflows
summary: Take a record live, review it before it is public, or move it to trash and restore it.
sort: 10
keywords: draft, published, preview, trash, restore, status
---

Every content module uses **Draft** and **Published**. Only Published records are included on public indexes and detail URLs.

Some forms open as Published (blogs) and some as Draft (eBooks). Check the status field before the first save.

## Publish a record

1. Open the record.
2. Confirm the slug. Changing a published slug changes the public URL.
3. Set **Status** to Published.
4. Set the publish date. Listing order uses that date, then the created time if the date is empty.
5. Save.
6. Open the public URL from [Content map](topic:content-map), including the trailing slash, and confirm the page.

Unpublish by switching the status back to Draft and saving. The public URL stops serving that record.

## Preview

1. Open the edit screen for a record you are allowed to edit.
2. Use the **Preview** action. It opens in a new tab.
3. The panel creates a signed preview URL. Unsigned or expired links return not found.
4. Signed links last 72 hours by default (`cms.preview_ttl_hours` in `config/cms.php`).

Preview works for drafts. Trashed records are excluded from preview. Generate a new preview from the edit screen if a link has expired. Do not share a preview URL as a permanent public link.

## Move to trash

1. From the list or the edit screen, choose **Move to Trash**.
2. Confirm. The success message is "Moved to trash".
3. The record leaves the public site and the default list.

## Restore

1. Open the module list.
2. Switch to the **Trash** tab.
3. Restore the record from its row actions.

Trash is a soft delete. Restoring brings the record back with its previous status. A restored draft is still a draft until you publish it.
