---
title: Blogs and articles
group: Content modules
summary: How to create posts and articles, including categories, dates, and templates.
sort: 20
keywords: blog, article, category, template, featured image, published_at
---

Blogs and articles are available to administrators and authors.

## Create a blog post

1. Open **Content → Blogs → New**.
2. Set **Title**. The slug should stay unique. It becomes `/blog/{slug}/`.
3. Choose a **Template**. Options come from the blog Blade templates discovered for that module. `default` is the usual choice.
4. Under **Publishing**, pick a blog category. The category list only includes categories whose module is Blogs. You can create a category inline; it is stored as a blog category.
5. Set **Status** to Draft or Published. New blog posts default to Published, so switch to Draft if the post is not ready.
6. Set **Publish date**. The public site uses this date for display and ordering. It does not change the record's created timestamp.
7. Upload a **Featured image** (max 4 MB). It is the banner and the thumbnail. Replacing it removes the previous featured image.
8. Add body blocks in the Content Builder.
9. Complete SEO if the post should be indexed. See [SEO metadata](topic:seo-metadata).
10. Save, then use **Preview** before you rely on the public URL.

Category archives are `/blog/category/{slug}/`.

## Create an article

1. Open **Content → Articles → New**.
2. Follow the same title, slug, status, publish date, featured image, content, and SEO flow.
3. The public URL is `/article/{slug}/`. The index is `/article/`, not `/articles/`.

Article categories are managed under **Content → Articles → Categories** and do not mix with blog categories.

## Listing behavior

Only **Published** records appear on the public index and detail URLs. The list orders by publish date, falling back to the created time when publish date is empty.
