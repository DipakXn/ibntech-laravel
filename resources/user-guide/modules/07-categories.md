---
title: Categories
group: Content modules
summary: How module-scoped categories work, including parent and child relationships.
sort: 60
keywords: category, parent, module, blog, case_study, ebook
---

Categories are not one global list. Each category belongs to a module, and editors only see categories for the record they are editing.

| Module value | Used by |
|---|---|
| `blog` | Blogs |
| `article` | Articles |
| `case_study` | Case studies |
| `ebook` | eBooks |
| `press_release` | Press releases |
| `white_paper` | White papers |

Pages, industries, landing pages, and newsletters do not use this category list.

## Create a category

1. Open the module, for example **Content → Blogs**.
2. Open its **Categories** screen.
3. Set the name. The slug fills from the name and must be unique for that module.
4. Optionally choose a parent category to build a hierarchy.
5. Save.

You can also create a category from the category dropdown on the record form. That new category is saved against the current module automatically.

## Public category URLs

Blog category archives are `/blog/category/{slug}/`, including paginated archives. Other modules use categories for filtering and organization inside their own templates; they do not all publish a `/category/{slug}/` URL.

## Editing rules

Authors and administrators can manage categories for the six modules above. Changing a category's module after content is assigned will hide it from the original module's dropdown, so create the category in the correct module instead of reusing one.
