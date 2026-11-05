---
title: Mail and notifications
group: Configuration
summary: Choose who receives form mail and confirm SMTP before a campaign goes live.
sort: 20
keywords: smtp, email, notification, queue, form_notification_to
---

Form mail is queued. A saved submission does not mean the email already left the server. The queue worker has to run, and SMTP has to accept the message.

## Who receives the email

The recipient is chosen in this order:

1. A per-form override in **Website Settings → Admin notification recipients**
2. **Default Form Notification Email** on that same screen
3. `MAIL_LEAD_NOTIFICATION_TO` in the environment
4. The mail from-address

Overrides are matched on the form name, such as `contact` or `ebook_download`. Landing pages appear in the override list by their title and use `lp-{slug}`. Leave an override address blank to fall back to the default.

Visitor thank-you messages are separate and are not changed by these admin recipient fields.

## Configure SMTP

1. Open **Administration → SMTP Settings → Configuration**.
2. Set the SMTP connection: host, port, encryption, username, and password.
3. Set message defaults, including the from address and from name visitors and staff should see.
4. Save.
5. Open **Test SMTP** and send a test to an inbox you can read.
6. Open **Email Logs** to confirm the test was recorded.

SMTP Settings, the test screen, and email logs are administrator-only.

## When mail fails

1. Confirm the submission row exists under **Sales → Submissions**.
2. Open **Queue monitor**. A failed `SendLeadSubmissionNotification` job can be retried from that screen.
3. Open **Application logs** and search for the mail exception.
4. Re-test SMTP after correcting the host, port, or password.

Local development often uses the `log` mailer, which writes the message into `storage/logs` instead of sending it. Production should use SMTP. The environment keys are listed in [Environment reference](topic:environment-reference).
