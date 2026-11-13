---
title: Users
group: Administration
summary: Create administrator and author accounts, reset access, and review account history.
sort: 10
keywords: users, role, password, administrator, author, invitation, deactivate, export
---

**Administration → Users** is administrator-only.

The list shows initials, name, email, role, whether the account is active, when it was created, and **Last session activity**. That activity column is the latest timestamp in the current sessions table. It is not a permanent login history. An empty value means there is no active session. Your own row is marked **Signed in as this user**.

Filter by **Administrator** or **Author**, and by active or inactive accounts. Search matches name and email. **Export CSV** downloads the same account fields and never includes password hashes.

## Create a user

1. Open **Administration → Users → New**.
2. Enter the name and a unique email. People sign in at `/ibn-tech-cms-login`.
3. Choose **Administrator** or **Author**. New users default to Author.
4. Leave the account **Active**. Inactive accounts cannot sign in.
5. Either set a password and confirm it, or turn on **Email a password setup link**.
6. Save.

Passwords need at least 12 characters, with uppercase and lowercase letters, a number, and a symbol. The same rule applies when someone changes a password from their profile or from a reset link.

An invitation email contains a link to choose a password. It does not contain the password. If mail is not configured, set the password yourself and share it through a channel you trust.

## Change a user

1. Open the user.
2. Update the name, email, role, or active state.
3. Enter a new password only when you need to replace the current one. Confirm it. A blank password leaves the current password in place.
4. Save.

You cannot change your own role or deactivate your own account. Another administrator has to do that. The last active administrator cannot be demoted, deactivated, or deleted.

**Email password reset** sends a reset link to that person. Their current password keeps working until they choose a new one. The public request page is `/admin/password-reset/request`.

The **Audit history** tab records creates, updates, password changes, invitations, reset emails, and deletions. Password values are not stored.

## Access notes

- Both roles can sign in while the account is active. Authors never receive this User Guide or other administrator navigation.
- Administrator access comes from the role on the user record. A break-glass mailbox list can be set with `CMS_LEGACY_SUPER_ADMIN_EMAILS`. Leave that empty in production.
- There is no self-service registration and no two-factor prompt. To revoke access, deactivate the account or delete it. You cannot delete the account you are currently signed in with.
- Deleting a user does not delete the audit row. The history keeps the email address.

Users manage their own name, email, and password from the profile menu after they sign in. Profile passwords use the same strength rules.
