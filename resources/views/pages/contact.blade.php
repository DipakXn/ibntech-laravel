@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/contact.css'])
@endpush

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Contact</p>
            <h1>Talk to the team.</h1>
            <p class="inner-hero__lede">
                Share your goals, migration scope, or content operations challenges and we will respond with a practical next step.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell contact-grid">
            <div class="contact-directory">
                <div class="contact-directory__top">
                    <article class="contact-office">
                        <h2>IBN Technologies LLC.</h2>
                        <div class="contact-office__address">
                            <span class="contact-flag contact-flag--us" aria-hidden="true"></span>
                            <p>66 West Flagler Street Suite<br>900 Miami, FL 33130</p>
                        </div>
                        <div class="contact-office__line">
                            <strong>For Cybersecurity and Cloud:</strong>
                            <a href="tel:+12815440740"><i class="fa-solid fa-phone" aria-hidden="true"></i> +1-281-544-0740</a>
                        </div>
                        <div class="contact-office__line">
                            <strong>For Finance &amp; Accounting and Others:</strong>
                            <a href="tel:+18446448440"><i class="fa-solid fa-phone" aria-hidden="true"></i> +1-844-644-8440</a>
                        </div>
                    </article>

                    <article class="contact-office">
                        <h2>IBN Tech Ltd.</h2>
                        <div class="contact-office__address">
                            <span class="contact-flag contact-flag--uk" aria-hidden="true"></span>
                            <p>30 Orange Street, London UK<br>WC2H 7HF</p>
                        </div>
                        <div class="contact-office__line">
                            <strong>For Cybersecurity and Cloud:</strong>
                            <a href="tel:+442037699111"><i class="fa-solid fa-phone" aria-hidden="true"></i> +44-203-769-9111</a>
                        </div>
                        <div class="contact-office__line">
                            <strong>For Finance &amp; Accounting and Others:</strong>
                            <a href="tel:+448000418618"><i class="fa-solid fa-phone" aria-hidden="true"></i> +44-800-041-8618</a>
                        </div>
                    </article>
                </div>

                <article class="contact-office contact-office--wide">
                    <h2>IBN Technologies Ltd.</h2>
                    <div class="contact-office__address">
                        <span class="contact-flag contact-flag--in" aria-hidden="true"></span>
                        <p>Kohinoor House, 2nd floor, 691/A/1B, Plot no. 7, bibwewadi Road,<br>Pune-411037, Maharashtra, India</p>
                    </div>
                    <div class="contact-office__line">
                        <strong>For Cybersecurity and Cloud:</strong>
                        <a href="tel:+912071179586"><i class="fa-solid fa-phone" aria-hidden="true"></i> 020-711-79586</a>
                    </div>
                    <div class="contact-office__line">
                        <strong>For Finance &amp; Accounting and Others:</strong>
                        <a href="tel:+91741182300"><i class="fa-solid fa-phone" aria-hidden="true"></i> +91 7411 82300</a>
                    </div>
                </article>

                <a class="contact-email" href="mailto:sales@ibntech.com">
                    <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                    sales@ibntech.com
                </a>
            </div>

            <div class="form-card contact-form-card">
                <div class="contact-form-card__inner">
                    <livewire:forms.contact-form />
                </div>
            </div>
        </div>
    </section>
@endsection
