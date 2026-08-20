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

    $testimonials = [
        [
            'quote' => 'We have been with IBN for just a short of year now, and we are extremely happy with the service. They provide support and back-office accounts for us. The response time is often less than an hour and they have become instrumental in our daily running and have been able to tackle big projects without any problems. They are very professional, efficient and reliable and provide the results that we need, often on short notice. IBN are by far the best accountants I have worked with, and I would highly recommend IBN for anyone looking for an account’s solution.',
            'cite' => 'Janikin Rooke Contracts',
        ],
        [
            'quote' => 'IBN has been providing excellent accounting services to our company for many years. Their staff is highly knowledgeable in GAAP standards. They perform very detailed analyses of all aspects of accounts and provide very professional reports. I would highly recommend them.',
            'cite' => 'Graviton Consulting Services',
        ],
        [
            'quote' => 'We have been utilizing IBN now for about 6months, initially we were reluctant to allow access to our sensitive information, but we soon overcame these challenges. We have been working closely with Aniket the entire time, he is our dedicated reprehensive and we really enjoy his service. He started by doing standard banking reconciling for all our accounts. This has graduated to Invoicing, Banking, A/R Reporting, Imports & Exports, weekly P&L & journal entries. Not only has this really helped us streamline our process, but our overall Local accounting cost have been cut in half.',
            'cite' => 'Mandi Loayza, Carnahan Group',
        ],
        [
            'quote' => 'The IBN team is great to work with and communicates efficiently and timely. They provided substantial assistance with our company needs and helped us push through projects.',
            'cite' => 'Sampson Business Solutions LLC',
        ],
        [
            'quote' => 'I first searched for an outsourcing company based in India via google. There were 100’s of choices and not being based in India or heard of any of the companies, I really did not know who to use so I clicked on IBN and arranged for a call. Although the cost was to my liking, it was the total professionalism of the people I spoke to initially and then to the people who were going to take care of me on a daily/weekly basis that impressed me the most. Once the work got started and I saw their spreadsheets and work patterns, and their total understanding of my work, I realized how good they are. IBN has made my life easier to take more clients on and then to be cheeky enough to help with the workload so that I can offer the client other services. There might be 100 similar companies out there, but this is the one for me!',
            'cite' => 'AKS Accountants',
        ],
        [
            'quote' => 'We have been utilizing IBN now for about 6months, initially we were reluctant to allow access to our sensitive information, but we soon overcame these challenges. We have been working closely with Aniket the entire time, he is our dedicated reprehensive and we really enjoy his service. He started by doing standard banking reconciling for all our accounts. This has graduated to Invoicing, Banking, A/R Reporting, Imports & Exports, weekly P&L & journal entries. Not only has this really helped us streamline our process, but our overall Local accounting cost have been cut in half.',
            'cite' => 'RLCS INC',
        ],
    ];
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
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
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
