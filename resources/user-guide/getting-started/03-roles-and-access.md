---
title: Roles and access
group: Getting started
summary: What administrators can operate and what authors are limited to.
sort: 30
keywords: administrator, author, permission, canAccess, role
---

Two roles exist: **Administrator** and **Author**. Both may sign in to IBNTECH Control. Authorization is the role on the user record, checked in each Filament page and resource.

## Author

Authors can list, create, edit, and move to trash:

- Blogs and blog categories
- Articles and article categories
- Case studies and case study categories
- eBooks and eBook categories
- White papers and white paper categories
- Press releases and press release categories

Authors do not see Pages, Industries, Landing Pages, Newsletters, Sales, Users, Website Settings, SMTP, analytics, Cloudflare, maintenance, queues, logs, excluded IPs, or this User Guide.

## Administrator

Administrators can do everything authors can, and also:

| Area | Screen |
|---|---|
| Site pages | Content → Pages, Industries, Landing Pages, Newsletters |
| Sales | Sales → Submissions and Old Submissions |
| Accounts | Administration → Users |
| This handbook | Administration → User Guide |
| Site configuration | Website Settings, SMTP Settings |
| Operations | Cloudflare Cache, Visitor analytics, Excluded IPs, System Maintenance, Queue monitor, Application logs |

The public-site toolbar follows the same rules. An author does not get administrator shortcuts, and **Clear cache** returns forbidden for anyone who is not an administrator.

## Special case

`User::isAdministrator()` is true when the role is `administrator` **or** the email is `admin@example.com`. Treat that mailbox as an administrator account only.

## Changing access

1. Open **Administration → Users**.
2. Edit the person.
3. Set Role to Administrator or Author.
4. Save.

The new role applies on their next request. You do not need to edit code or redeploy to change a role.
