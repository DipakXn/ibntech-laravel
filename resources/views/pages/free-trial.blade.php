@php
    $gains = [
        'A dedicated expert to review your books',
        'No credit card required to start',
        'Access to real-time financial data',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/pages/free-consultation-lead.css',
    ])
@endpush

@section('content')
    <div class="fclead-page fclead-page--trial">
        <section class="fclead-hero" aria-labelledby="fctrial-hero-title">
            <div class="site-shell fclead-hero__inner">
                <div class="fclead-hero__copy">
                    <h1 id="fctrial-hero-title">Take Control of Your Business Books – Free Trial Just for You</h1>
                    <p class="fclead-hero__lede">
                        Professional bookkeeping starts here — with results you can trust. Choose a Bookkeeping plan and get started with 20 Hours of Professional Bookkeeping – absolutely free.
                    </p>

                    <h2>What You Get</h2>
                    <ul class="fclead-hero__list">
                        @foreach ($gains as $item)
                            <li>
                                <span class="fclead-check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="fclead-hero__form" id="contact-us" aria-labelledby="fctrial-form-title">
                    <h2 id="fctrial-form-title">Schedule Your Free Trial Today</h2>
                    <livewire:forms.contact-form
                        form-name="free-trial"
                        id-prefix="fctrial"
                        layout="trial"
                        :show-company="true"
                        :show-service="false"
                        company-placeholder="Company Name"
                        message-placeholder="Use your free hours wisely—what do you need help with?"
                        submit-label="BOOK A FREE TRIAL"
                        :message-rows="3"
                    />
                </aside>
            </div>
        </section>

        <x-home.testimonials
            title="Client Testimonial"
            subtitle="We redefine possibilities, helping you gain fresh perspectives, uncover new opportunities, and achieve remarkable results that transform aspirations into reality."
        />
    </div>
@endsection
