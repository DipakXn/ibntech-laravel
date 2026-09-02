@php
    $gains = [
        '99% Accuracy',
        '100% Client Satisfaction',
        '100% Pre and Post Filing Support',
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
    <div class="fclead-page fclead-page--tax">
        <section class="fclead-hero" aria-labelledby="fctax-hero-title">
            <div class="site-shell fclead-hero__inner">
                <div class="fclead-hero__copy">
                    <h1 id="fctax-hero-title">Accurate Tax Return Preparation. Expert Support. Zero Stress.</h1>
                    <p class="fclead-hero__lede">
                        Let experts handle your tax support – so you don’t have to. We provide quick assistance and keep you 100% compliant. We handle forms like 1120, 1120S, 1040, 1065, 990, and 1099 with confidence.
                    </p>

                    <h2>What You’ll Get:</h2>
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

                <aside class="fclead-hero__form" id="contact-us" aria-labelledby="fctax-form-title">
                    <h2 id="fctax-form-title">Get Your Free Tax Prep Consultation Today!</h2>
                    <livewire:forms.contact-form
                        form-name="free-consultation-for-tax-return"
                        id-prefix="fctax"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we best support your Tax Return Preparation needs?"
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
