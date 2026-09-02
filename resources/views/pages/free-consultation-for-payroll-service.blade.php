@php
    $gains = [
        '100% Accuracy Guarantee',
        '24/5 expert support from real payroll specialists',
        'Year-end reporting (W-2s, 1099s, etc.)',
        'Compliance with labor laws & tax codes',
        'Timely processing payroll payments',
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
    <div class="fclead-page">
        <section class="fclead-hero" aria-labelledby="fcpay-hero-title">
            <div class="site-shell fclead-hero__inner">
                <div class="fclead-hero__copy">
                    <h1 id="fcpay-hero-title">Outsourced Payroll Processing – that’s actually easy and accurate</h1>
                    <p class="fclead-hero__lede">
                        You didn’t sign up for spreadsheets, tax codes, and deadlines. With our outsourced payroll service, you get reliable, expert support — and more time to do what you do best.
                    </p>

                    <h2>What You Get with Our Payroll Services</h2>
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

                <aside class="fclead-hero__form" id="contact-us" aria-labelledby="fcpay-form-title">
                    <h2 id="fcpay-form-title">Perfect Your Payroll in Hours—Sign Up Today!</h2>
                    <livewire:forms.contact-form
                        form-name="free-consultation-for-payroll-service"
                        id-prefix="fcpay"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we best support your Payroll Service needs?"
                        submit-label="BOOK A FREE CONSULTATION"
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
