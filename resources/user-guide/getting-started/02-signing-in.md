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

Use the user menu in the top bar to open your profile. You can change your name, email, and password there. Changing your role is done by another administrator on the Users screen, not from the profile page.

## Appearance

The panel follows the system theme and also offers light and dark modes from the user menu. The brand colors are the green primary (`#4caf50`) and the blue info color (`#2e2e80`).

## Session length

Sessions use the database driver. The default lifetime is 120 minutes (`SESSION_LIFETIME`). After that, sign in again. Signing out uses the user menu and returns you to the login page.

## If you cannot sign in

- Confirm the account exists and the email is spelled the same way as in Users.
- Authors can sign in, but they will not see this guide or other administrator screens.
- A user whose email is `admin@example.com` is always treated as an administrator, even when the role field says Author. Do not reuse that address for an author account.
