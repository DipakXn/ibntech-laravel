---
title: Gated downloads
group: Workflows
summary: Offer a case study or eBook PDF only after the visitor submits the download form.
sort: 30
keywords: download, pdf, ebook_download, case_study_download, gate
---

Only case studies and eBooks have download endpoints. White papers do not.

## Attach the file

1. Edit the case study or eBook.
2. Upload a PDF to **Download PDF** (case study) or **eBook PDF** (eBook). Both use the `download_pdf` media collection.
3. Publish the record. A draft does not have a public page for the form to sit on.
4. Save.

Case study PDFs are restricted to the PDF file type. eBook PDFs are restricted to PDF and 10 MB.

## What the visitor does

1. They open `/case-study/{slug}/` or `/ebook/{slug}/`.
2. They submit the download form.
3. The submission is stored and a notification is queued.
4. The file is served from `/case-study/{slug}/download` or `/ebook/{slug}/download`.

Form names stored on the submission are `case_study_download` and `ebook_download`. Find them under **Sales → Submissions**. Notification routing is in [Mail and notifications](topic:mail-and-notifications).

## If the download fails

- Confirm the record is Published.
- Confirm a PDF is attached to `download_pdf`, not only a featured image.
- Confirm the visitor completed the form. The download routes are the file endpoints; the form is what captures the lead.
- Search Submissions for `case_study_download` or `ebook_download` if the lead is missing. If mail did not arrive, check SMTP and the queue monitor next.
