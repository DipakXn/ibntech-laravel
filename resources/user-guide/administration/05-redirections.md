---
title: Redirections
group: Administration
summary: Redirections for any public URL, including 301, 302, 307, 410, and 451 responses, plus published slug changes.
sort: 40
keywords: redirection, redirect, 301, 302, 307, 410, 451, slug, wordpress, legacy, hits
---

**Administration → Redirections** is administrator-only.

The list shows **From**, **To**, **Type**, **Hits**, **Created**, and **Last Accessed**. Tabs split the list into **All**, **Active**, **Inactive**, and **Trash**. Search matches the source and destination. Bulk actions activate, deactivate, move to trash, restore, or delete permanently.

A **301**, **302**, or **307** sends the visitor to the destination and keeps the incoming query string. If the destination already has a query string, those parameters win when the names overlap. A **410** tells the visitor the URL is gone. A **451** tells the visitor the URL is unavailable for legal reasons. Neither 410 nor 451 uses a destination.

## Add a redirection

1. Open **Administration → Redirections → Add New**.
2. Enter one or more source URLs. Use **Add another** for extra sources that share the destination. **Exact** matches the whole path. **Contains**, **Starts With**, and **End With** match part of the path. **Regex** matches a regular expression against the path, such as `^/old-page`. **Ignore Case** also matches a different capitalization. A pattern cannot match an admin or system URL, and the destination cannot match the same pattern.
3. Enter the destination path or a full `http(s)` URL.
4. Choose the redirection type: **301 Permanent Move**, **302 Temporary Move**, **307 Temporary Redirect**, **410 Content Deleted**, or **451 Content Unavailable for Legal Reasons**.
5. Leave **Status** on **Activate**.
6. Save with **Add Redirection**.

Open a row to change it, then choose **Update Redirection**. **Cancel** returns to the list.

The source cannot be the same as the destination, cannot already exist, and cannot point at a chain that comes back to itself. A source that is already a published page is rejected. Change that record’s slug instead.

## Moved route rules

The old WordPress 301 rules and the 410 responses that used to live in `routes/web.php` are stored here. They are applied from the database. Deactivate or trash one when it should stop.

## Published slug changes

When a published page, industry, landing page, or newsletter slug changes, the old public URL is added here as a 301 to the new URL. Draft slug changes do not create a redirection. Trashing or permanently deleting the content record removes redirections that used its URL. Creating a record with that slug again clears a leftover redirection so the live URL opens.
