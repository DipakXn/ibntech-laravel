---
title: Form submissions
group: Workflows
summary: Where website forms are stored, which form name each one uses, and how to review them.
sort: 40
keywords: lead, submission, contact, newsletter, sales, form_submissions
---

Public forms are Livewire forms. A successful submit writes a row in `form_submissions` and queues an email to the administrator recipient. The panel label for those rows is **Sales → Submissions**. Only administrators can open it.

## Review a submission

1. Open **Sales → Submissions**.
2. Search or filter by the form name.
3. Open the row to read the name, email, phone, company, message, page URL, and payload.
4. Use the list widgets for recent volume. The dashboard also summarizes submissions from the last seven days for administrators.

**Sales → Old Submissions** is a separate read-only archive of imported historical rows. New website forms do not land there.

## Form names

| Form name | Source |
|---|---|
| `contact` | Contact form |
| `homepage-contact` | Homepage contact |
| `header-contact-modal` | Header contact modal |
| `lead` | Short lead form |
| `newsletter_inquiry` | Newsletter inquiry |
| `ebook_download` | eBook download |
| `case_study_download` | Case study download |
| `pricing-enquire` | Pricing enquiry |
| `free-trial` | Free trial |
| `free-consultation-for-construction` | Construction consultation |
| `free-consultation-for-ipa` | IPA consultation |
| `free-consultation-for-payroll-service` | Payroll consultation |
| `free-consultation-for-tax-return` | Tax return consultation |
| `vapt-services-quote` | VAPT services quote |
| `vapt-pricing-quote` | VAPT pricing quote |
| `general` | General |
| `lp-{slug}` | Inquiry on a landing page |

Landing-page inquiries ignore a duplicate from the same email, form name, and IP for 120 seconds. The visitor still sees the success state, and a second row is not stored.

## Spam checks

Forms that include reCAPTCHA require it when both `RECAPTCHA_SITE_KEY` and `RECAPTCHA_SECRET_KEY` are set. If either key is empty, that check is skipped. The construction consultation form and landing inquiries are among the forms that use it.

## If a notification never arrives

The row can exist even when email fails, because mail is queued. Check **SMTP Settings**, then **Queue monitor**, then **Application logs**. Recipient order is in [Mail and notifications](topic:mail-and-notifications).
