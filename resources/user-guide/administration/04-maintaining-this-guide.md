---
title: Maintaining this guide
group: Administration
summary: How to add or edit a topic so the handbook stays aligned with the panel.
sort: 40
keywords: markdown, user-guide, front matter, topic link
---

This handbook is markdown in `resources/user-guide`. The panel reads those files when an administrator opens **Administration → User Guide**. Authors never receive the page or the navigation item.

## Add a topic

1. Create a file such as `resources/user-guide/workflows/05-new-topic.md`.
2. The filename must be two digits, a hyphen, then the slug: `05-new-topic.md`. The slug in the URL is `new-topic`.
3. Start the file with front matter:

```yaml
---
title: New topic
group: Workflows
summary: One sentence that appears in the sidebar and in search.
sort: 50
keywords: optional words people might search
---
```

4. Write the body in GitHub-flavored markdown. Tables, lists, and fenced code are supported. Raw HTML is stripped.
5. Link to another topic with `[Publish, preview, and trash](topic:publish-preview-and-trash)`. The `topic:` target must be an existing slug.
6. Use a `group` of Getting started, Content modules, Workflows, Configuration, or Administration. Any other group is rejected.

`sort` orders topics inside a group. Lower numbers come first.

## Check it

Search in the panel should find the title, summary, keywords, and body. A broken `topic:` link or a bad filename fails the user-guide test suite.

From the project root:

```bash
php artisan test --filter=UserGuide
```

Topic files are read on each request. Editing markdown does not require a cache clear.

This panel caches discovered Filament components. After a new admin page class is added, rebuild that cache or the page returns 404 on a server that uses it:

```bash
php artisan filament:optimize
```

## What to update

Update a topic when a public URL, a Filament label, a role rule, or a workflow changes. Do not copy secrets, production passwords, or customer data into these files. Prefer the screen name the administrator sees, and mention the underlying field or form name when that is what they must match.
