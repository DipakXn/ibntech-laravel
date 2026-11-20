@php
    $img = fn (string $file): string => asset('images/bpo-services/'.$file);

    $industries = [
        [
            'label' => 'Real Estate',
            'file' => 'real-estate.webp',
            'alt' => 'Real Estate',
            'slug' => 'real-estate-construction-bookkeeping-services',
        ],
        [
            'label' => 'Hospitality',
            'file' => 'hospitality.webp',
            'alt' => 'Hospitality',
            'slug' => 'hospitality-bookkeeping-and-accounting-services',
        ],
        [
            'label' => 'Retail',
            'file' => 'retail.webp',
            'alt' => 'Retail',
            'slug' => 'bookkeeping-services-for-retail-stores',
        ],
        [
            'label' => 'E-com',
            'file' => 'ecommerce.webp',
            'alt' => 'Ecommerce',
            'slug' => 'ecommerce-bookkeeping-services',
        ],
        [
            'label' => 'Health Care',
            'file' => 'healthcare.webp',
            'alt' => 'Healthcare',
            'slug' => 'healthcare-bookkeeping-services',
        ],
        [
            'label' => 'CPA Firm',
            'file' => 'cpa.webp',
            'alt' => 'CPA',
            'slug' => 'cpa-outsourcing',
        ],
        [
            'label' => 'Travel',
            'file' => 'travel.webp',
            'alt' => 'Travel',
            'slug' => 'travel-bookkeeping-service',
        ],
        [
            'label' => 'Legal',
            'file' => 'legal.webp',
            'alt' => 'Legal',
            'slug' => 'legal-bookkeeping-services',
        ],
        [
            'label' => 'Manufacturing',
            'file' => 'manufacturing.webp',
            'alt' => 'Manufacturing',
            'slug' => 'manufacturing-accounting-and-bookkeeping-services',
        ],
        [
            'label' => 'Financial Business',
            'file' => 'financial-services.webp',
            'alt' => 'Financial',
            'slug' => 'finance-businesses-bookkeeping-service',
        ],
        [
            'label' => 'Marketing',
            'file' => 'marketing-advertising.webp',
            'alt' => 'Marketing Advertising',
            'slug' => 'marketing-and-advertising-bookkeeping-services',
        ],
        [
            'label' => 'IT Business',
            'file' => 'it-business.webp',
            'alt' => 'IT Business',
            'slug' => 'it-business-bookkeeping-service',
        ],
    ];

    $testimonials = \App\Support\Testimonials\Testimonials::cites('bpo-services');
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bpo-services.css'])
@endpush

@section('content')
    <div class="bpo-page">
        {{-- Hero --}}
        <section class="bpo-hero" aria-labelledby="bpo-hero-title">
            <div class="bpo-hero__bg" aria-hidden="true">
                <img
                    src="{{ $img('bpo-services.webp') }}"
                    alt="Business process outsourcing services"
                    width="1920"
                    height="640"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
            <div class="site-shell bpo-hero__inner">
                <div class="bpo-hero__copy">
                    <h1 id="bpo-hero-title">BPO Services</h1>
                    <div class="bpo-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="bpo-btn bpo-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="bpo-industries" aria-labelledby="bpo-industries-title">
            <div class="site-shell">
                <div class="bpo-industries__heading">
                    <h2 id="bpo-industries-title">Industries We Specialize In</h2>
                </div>

                <div class="bpo-industries__grid" role="list">
                    @foreach ($industries as $industry)
                        <a
                            href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                            class="bpo-industry"
                            role="listitem"
                        >
                            <img
                                src="{{ $img($industry['file']) }}"
                                alt="{{ $industry['alt'] }}"
                                width="75"
                                height="75"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $industry['label'] }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bpo-testimonials" aria-labelledby="bpo-testimonials-title">
            <div class="site-shell">
                <div class="bpo-testimonials__heading">
                    <p class="bpo-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bpo-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bpo-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.total > 0 ? (this.index - 1 + this.total) % this.total : 0); },
                        next() { this.index = (this.total > 0 ? (this.index + 1) % this.total : 0); }
                    }"
                >
                    <button
                        type="button"
                        class="bpo-testimonials__nav bpo-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </button>

                    <div class="bpo-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bpo-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bpo-testimonials__nav bpo-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <svg aria-hidden="true" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection
