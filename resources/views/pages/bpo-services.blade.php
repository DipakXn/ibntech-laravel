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

    $testimonials = [
        [
            'quote' => 'We have been with IBN for just a short of year now, and we are extremely happy with the service. They provide support and back-office accounts for us. The response time is often less than an hour and they have become instrumental in our daily running and have been able to tackle big projects without any problems. They are very professional, efficient and reliable and provide the results that we need, often on short notice. IBN are by far the best accountants I have worked with, and I would highly recommend IBN for anyone looking for an account’s solution.',
            'cite' => 'Janikin Rooke Contracts',
        ],
        [
            'quote' => 'We have been utilizing IBN now for about 6months, initially we were reluctant to allow access to our sensitive information, but we soon overcame these challenges. We have been working closely with Aniket the entire time, he is our dedicated reprehensive and we really enjoy his service. He started by doing standard banking reconciling for all our accounts. This has graduated to Invoicing, Banking, A/R Reporting, Imports & Exports, weekly P&L & journal entries. Not only has this really helped us streamline our process, but our overall Local accounting cost have been cut in half.',
            'cite' => 'RLCS Inc',
        ],
        [
            'quote' => 'We’ve had the opportunity to work with IBN Tech for over a year now and really enjoy the services they provide. The team is incredibly responsive, and the quality of work is wonderful – they are just an overall pleasure to work with.',
            'cite' => 'Mandi Loayza, Carnahan Group',
        ],
        [
            'quote' => 'I first searched for an outsourcing company based in India via google. There were 100’s of choices and not being based in India or heard of any of the companies, I really did not know who to use so I clicked on IBN and arranged for a call. Although the cost was to my liking, it was the total professionalism of the people I spoke to initially and then to the people who were going to take care of me on a daily/weekly basis that impressed me the most. Once the work got started and I saw their spreadsheets and work patterns, and their total understanding of my work, I realized how good they are. IBN has made my life easier to take more clients on and then to be cheeky enough to help with the workload so that I can offer the client other services. There might be 100 similar companies out there, but this is the one for me!',
            'cite' => 'AKS Accountants',
        ],
        [
            'quote' => 'The IBN team is great to work with and communicates efficiently and timely. They provided substantial assistance with our company needs and helped us push through projects.',
            'cite' => 'Sampson Business Solutions LLC',
        ],
        [
            'quote' => 'IBN has been providing excellent accounting services to our company for many years. Their staff is highly knowledgeable in GAAP standards. They perform very detailed analyses of all aspects of accounts and provide very professional reports. I would highly recommend them.',
            'cite' => 'Graviton Consulting Services',
        ],
    ];
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
                    alt=""
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
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
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
