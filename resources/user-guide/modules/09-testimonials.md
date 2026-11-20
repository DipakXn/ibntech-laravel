---
title: Testimonials
group: Content modules
summary: Client quotes for the homepage carousel and the service pages that already show testimonials.
sort: 55
keywords: testimonial, quote, client, homepage, rating, company, section
---

Testimonials are administrator-only. Authors do not see this module.

A testimonial is one client quote. The Blade template still controls the carousel, the heading, and the HTML. This screen chooses the words, the person, and which existing section receives the quote.

## What you can edit

- **Customer name**, **designation**, and **company name**.
- **Testimonial text**.
- **Rating**, optional. The homepage carousel shows that many stars. Leave it empty to hide the stars there. Sections that do not show stars ignore the rating.
- **Client image or logo**, optional. The homepage avatar uses it. With no image, or if the file is missing, that avatar stays the user icon.
- **Related service**, optional. This records which service the quote is about. It does not place the quote on that page by itself.

## When a quote is public

All three have to be true:

1. Status is **Published**.
2. **Active** is on.
3. The quote is added to at least one **section**.

Unpublished and inactive quotes stay off the website. Deleting a quote removes it from every section.

## Sections and order

Each section is a part of the site that already has a testimonial carousel.

- **Homepage and shared carousel** is the homepage, the testimonials page, the contact page, and the free-consultation pages that share that carousel.
- Every other section is the carousel on that service or location page.

**Display order** is per section. Lower numbers appear first. The same quote can be on more than one section, with a different order on each.

The layout of a new section is still a Blade template. Add the section key in `App\Support\Testimonials\TestimonialPlacements`, then read `Testimonials::cards()` or `Testimonials::cites()` from that template.
