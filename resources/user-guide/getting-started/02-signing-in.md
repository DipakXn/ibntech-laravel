---
title: Signing in
group: Getting started
summary: How to reach the panel, update your profile, and use light or dark mode.
sort: 20
keywords: login, ibn-tech-cms-login, password, profile, dark mode
---

## Sign in

1. Open `/ibn-tech-cms-login`.
2. Enter the email and password on your user record.
3. You land on `/admin`.

There is no public registration page. An administrator creates accounts under **Administration → Users**. Guests who open `/admin` are sent to the login page.

`/admin/login` is not the login URL. The panel login route is mounted at the site root as `/ibn-tech-cms-login`.

## Profile and password

Use the user menu in the top bar to open your profile. You can change your name, email, and password there. A new password needs at least 12 characters, with uppercase and lowercase letters, a number, and a symbol. Changing your role is done by another administrator on the Users screen, not from the profile page.

If you forget the password, open `/admin/password-reset/request` and use the email on your account. An administrator can also send that reset link from the user record. Two-factor authentication is not enabled.

## Appearance

The panel follows the system theme and also offers light and dark modes from the user menu. The brand colors are the green primary (`#4caf50`) and the blue info color (`#2e2e80`).

## Session length

Sessions use the database driver. The default lifetime is 120 minutes (`SESSION_LIFETIME`). After that, sign in again. Signing out uses the user menu and returns you to the login page.

## If you cannot sign in

- Confirm the account exists and the email is spelled the same way as in Users.
- Authors can sign in, but they will not see this guide or other administrator screens.
- An inactive account cannot sign in, even when the email and password are correct.
- Production administrator access follows the role stored on the user. Do not reuse `admin@example.com` for an author account in local development, because that mailbox stays an administrator there unless `CMS_LEGACY_SUPER_ADMIN_EMAILS` is set.
