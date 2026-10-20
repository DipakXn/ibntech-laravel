---
title: Users
group: Administration
summary: Create administrator and author accounts and reset access.
sort: 10
keywords: users, role, password, administrator, author
---

**Administration → Users** is administrator-only.

## Create a user

1. Open **Administration → Users → New**.
2. Enter the name and a unique email.
3. Choose **Administrator** or **Author**. New users default to Author.
4. Set a password. The field is required on create and can be revealed while you type.
5. Save and send the person the login URL `/ibn-tech-cms-login` and their password through a channel you trust.

Role behavior is documented in [Roles and access](topic:roles-and-access).

## Change a user

1. Open the user.
2. Update the name, email, or role.
3. Enter a new password only when you need to replace the current one. A blank password on edit leaves the current password in place.
4. Save.

## Access notes

- Both roles can sign in. Authors never receive this User Guide or other administrator navigation.
- The email `admin@example.com` is always an administrator, regardless of the role dropdown. Do not assign that email to an author.
- There is no self-service registration. To revoke access, open the user and delete the account, or change the password so the old credentials stop working. You cannot delete the account you are currently signed in with.

Users manage their own name, email, and password from the profile menu after they sign in.
