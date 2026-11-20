@php
    $img = fn (string $file): string => asset('images/boost-your-business-with-accounting-offers/'.$file);

    $heroChecks = [
        'See Expertise in Action',
        'Experience 100% dedicated support',
        'Transform Your Business’s Financial Future',
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $clutchReviews = [
        [
            'rating' => '5.0',
            'quote' => 'I always felt like IBN Technologies LLC was here to support me.',
            'role' => 'CEO, Red River Chamber of Commerce',
        ],
        [
            'rating' => '5.0',
            'quote' => 'They were very responsive.',
            'role' => 'Managing Partner, The Spa of Charleston',
        ],
        [
            'rating' => '4.5',
            'quote' => 'Their work ethic, availability, and response are impressive.',
            'role' => 'President, FLYR2',
        ],
    ];

    $testimonials = \App\Support\Testimonials\Testimonials::cites('boost-your-business-with-accounting-offers');
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/boost-your-business-with-accounting-offers.css'])
@endpush

@section('content')
    <div class="bybao-page">
        {{-- Hero --}}
        <section class="bybao-hero" aria-labelledby="bybao-hero-title">
            <div class="site-shell bybao-hero__inner">
                <div class="bybao-hero__copy">
                    <p class="bybao-hero__offer">Reduce Operational Cost by Up to 70%</p>

                    <h1 id="bybao-hero-title">Get 50% Off and Simplify Your Bookkeeping</h1>

                    <p class="bybao-hero__lede">Special Savings Just For You at IBN Technologies!</p>

                    <ul class="bybao-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <span class="bybao-hero__check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="bybao-hero__form" id="contact-us" aria-label="Contact form">
                    <livewire:forms.contact-form
                        form-name="boost-your-business-with-accounting-offers"
                        id-prefix="bybao"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Process (WordPress GIF) --}}
        <section class="bybao-process" aria-label="Hire accounting and bookkeeping experts">
            <div class="site-shell">
                <img
                    class="bybao-process__image"
                    src="{{ $img('gif-new-2.gif') }}"
                    alt="Remote Services for Businesses"
                    width="1920"
                    height="1080"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- Clutch reviews (WordPress [clutch_widget]) --}}
        <section class="bybao-clutch" aria-labelledby="bybao-clutch-title">
            <div class="site-shell">
                <div class="bybao-clutch__header">
                    <div class="bybao-clutch__brand">
                        <h2 id="bybao-clutch-title">IBN Technologies LLC Reviews</h2>
                        <div class="bybao-clutch__score" aria-label="4.9 out of 5 from 11 reviews">
                            <span class="bybao-clutch__score-value">4.9</span>
                            <span class="bybao-clutch__stars" aria-hidden="true">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </span>
                            <a
                                class="bybao-clutch__count"
                                href="https://clutch.co/profile/ibn-technologies"
                                target="_blank"
                                rel="noopener noreferrer"
                            >11 reviews</a>
                        </div>
                    </div>
                    <a
                        class="bybao-clutch__powered"
                        href="https://clutch.co/profile/ibn-technologies"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Powered by Clutch"
                    >
                        <span>Powered by</span>
                        <strong>Clutch</strong>
                    </a>
                </div>

                <div class="bybao-clutch__grid">
                    @foreach ($clutchReviews as $review)
                        <article class="bybao-clutch-card">
                            <div class="bybao-clutch-card__rating" aria-label="{{ $review['rating'] }} out of 5">
                                <span>{{ $review['rating'] }}</span>
                                <span class="bybao-clutch-card__stars" aria-hidden="true">
                                    @php
                                        $full = (int) floor((float) $review['rating']);
                                        $half = ((float) $review['rating'] - $full) >= 0.5;
                                    @endphp
                                    @for ($i = 0; $i < $full; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @if ($half)
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    @endif
                                </span>
                            </div>
                            <p class="bybao-clutch-card__quote">“{{ $review['quote'] }}”</p>
                            <p class="bybao-clutch-card__role">{{ $review['role'] }}</p>
                            <a
                                class="bybao-clutch-card__verified"
                                href="https://clutch.co/profile/ibn-technologies"
                                target="_blank"
                                rel="noopener noreferrer"
                            >Verified Review</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bybao-testimonials" aria-labelledby="bybao-testimonials-title">
            <div class="site-shell">
                <div class="bybao-testimonials__heading">
                    <p class="bybao-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bybao-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bybao-testimonials__carousel"
                    x-data="{
                        index: 3,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.total > 0 ? (this.index - 1 + this.total) % this.total : 0); },
                        next() { this.index = (this.total > 0 ? (this.index + 1) % this.total : 0); }
                    }"
                >
                    <button
                        type="button"
                        class="bybao-testimonials__nav bybao-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bybao-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bybao-testimonial{{ $i === 3 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }} ? 'true' : 'false'"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        class="bybao-testimonials__nav bybao-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
