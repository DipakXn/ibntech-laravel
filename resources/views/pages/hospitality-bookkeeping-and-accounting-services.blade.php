@php
    $img = fn (string $file): string => asset('images/hospitality-bookkeeping-and-accounting-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $serviceColumns = [
        [
            'Accounts Reconciliation',
            'Financial Reports & Cash Flow Monitoring',
            'Accounts Payable & Receivable Management',
        ],
        [
            'Tax Processing Services',
            'General Ledger Maintenance',
            'Bank and Credit Card Reconciliation',
        ],
    ];

    $challenges = [
        [
            'icon' => 'continuous-operations.webp',
            'alt' => 'Continuous Operations',
            'title' => 'Continuous Operations:',
            'text' => 'Manage room rates, restaurant services, and additional amenities seamlessly.',
        ],
        [
            'icon' => 'multiple-revenue-streams-and-expenses.webp',
            'alt' => 'Multiple Revenue Streams and Expenses',
            'title' => 'Multiple Revenue Streams and Expenses',
            'text' => 'Manage room rates, restaurant services, and additional amenities seamlessly.',
        ],
        [
            'icon' => 'dynamic-pricing.webp',
            'alt' => 'Dynamic Pricing',
            'title' => 'Dynamic Pricing:',
            'text' => 'Adjust for fluctuating occupancy rates, seasonal demand, and special events.',
        ],
        [
            'icon' => 'vendor-contracts.webp',
            'alt' => 'Vendor Contracts',
            'title' => 'Vendor Contracts:',
            'text' => 'Track and manage payments with diverse vendors for seamless supply chain management.',
        ],
        [
            'icon' => 'complex-payroll-costs.webp',
            'alt' => 'Complex Payroll Costs',
            'title' => 'Complex Payroll Costs:',
            'text' => 'Efficiently manage high employee turnover, varied payment structures, and complex payroll processes.',
        ],
    ];

    $whyChoose = [
        [
            'title' => 'Industry-Specific Expertise:',
            'text' => 'With over 27+ years of experience, we understand the unique challenges of hospitality accounting, including high transaction volumes, multiple revenue streams, and fluctuating occupancy rates.',
        ],
        [
            'title' => 'Customized Solutions:',
            'text' => 'We provide tailored packages designed for your specific needs, ensuring optimal financial management.',
        ],
        [
            'title' => '24/7 Support:',
            'text' => 'We understand your business never stops, and neither do we.',
        ],
        [
            'title' => 'Cutting-Edge Technology:',
            'text' => 'Our integration of accounting systems with your operational software (PMS, POS) ensures seamless, real-time data tracking, reducing errors and enhancing efficiency.',
        ],
    ];

    $complianceItems = [
        [
            'title' => 'GAAP/IFRS Compliance:',
            'text' => 'Ensure adherence to Generally Accepted Accounting Principles (GAAP) and International Financial Reporting Standards (IFRS).',
        ],
        [
            'title' => 'USALI Guidelines:',
            'text' => 'Follow the Uniform System of Accounts for the Lodging Industry (USALI) to maintain standardized financial reporting across all properties.',
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

    $checkSvg = '<svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>';
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/hospitality-bookkeeping-and-accounting-services.css'])
@endpush

@section('content')
    <div class="hpbk-page">
        {{-- Hero --}}
        <section class="hpbk-hero" aria-labelledby="hpbk-hero-title">
            <div class="site-shell hpbk-hero__inner">
                <h1 id="hpbk-hero-title">Hospitality Accounting &amp; Bookkeeping for Seamless Finances</h1>
                <p class="hpbk-hero__lede">
                    Tailored bookkeeping services to help you manage revenue, expenses, and payroll with precision, driving profitability in your hospitality business.
                </p>
                <a href="#request-form-demo" class="hpbk-btn hpbk-btn--green">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="hpbk-intro" aria-labelledby="hpbk-intro-title">
            <div class="site-shell">
                <div class="hpbk-intro__card">
                    <h2 id="hpbk-intro-title">Streamline Your Hospitality Finances with us</h2>
                    <p>
                        With over 26 years of experience in the
                        <strong>
                            <a href="{{ route('page.show', ['slug' => 'bookkeeping-services-usa']) }}">USA</a>
                        </strong>
                        and
                        <strong>
                            <a href="{{ route('page.show', ['slug' => 'bookeeping-for-uk']) }}">UK</a>
                        </strong>,
                        we provide expert bookkeeping services for the hospitality industry, including hotels, events, and tourism. Our customized solutions streamline your financial operations by integrating accounting with your property management (PMS) and point-of-sale (POS) systems, ensuring accurate and up-to-date records for better decision-making.
                    </p>
                </div>
            </div>
        </section>

        {{-- Comprehensive services --}}
        <section class="hpbk-section" aria-labelledby="hpbk-services-title">
            <div class="site-shell hpbk-services">
                <div class="hpbk-services__copy">
                    <h2 id="hpbk-services-title">Our Comprehensive Hospitality Bookkeeping Services</h2>
                    <div class="hpbk-services__lists">
                        @foreach ($serviceColumns as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="hpbk-check" aria-hidden="true">{!! $checkSvg !!}</span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="hpbk-services__media">
                    <img
                        src="{{ $img('our-comprehensive-hospitality-bookkeeping-services.webp') }}"
                        alt="Our Comprehensive Hospitality Bookkeeping Services"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
            <div class="site-shell">
                <p class="hpbk-services__note">
                    Partner with experts who have <strong>hospitality-specific knowledge</strong> to manage your bookkeeping efficiently, delivering reliable financial insights and supporting your business growth.
                </p>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="hpbk-cta-banner" aria-labelledby="hpbk-cta-title">
            <div class="site-shell hpbk-cta-banner__inner">
                <h2 id="hpbk-cta-title">Get Started with a free consultation call</h2>
                <a href="#request-form-demo" class="hpbk-btn hpbk-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Challenges --}}
        <section class="hpbk-section hpbk-challenges-wrap" aria-labelledby="hpbk-challenges-title">
            <div class="site-shell">
                <div class="hpbk-heading hpbk-heading--center">
                    <h2 id="hpbk-challenges-title">Key Hospitality Bookkeeping Challenges We Solve</h2>
                </div>

                <div class="hpbk-challenges" role="list">
                    @foreach ($challenges as $item)
                        <article class="hpbk-challenge" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="173"
                                height="167"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="hpbk-section hpbk-software" aria-labelledby="hpbk-software-title">
            <div class="site-shell">
                <h2 id="hpbk-software-title" class="hpbk-software__title">
                    <span>Software</span>
                    <span class="hpbk-software__accent">Expertise</span>
                </h2>
                <div class="hpbk-software__media">
                    <img
                        src="{{ $img('software-expertise.webp') }}"
                        alt="Software expertise of IBN Technologies"
                        width="1920"
                        height="825"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="hpbk-section hpbk-why" aria-labelledby="hpbk-why-title">
            <div class="site-shell">
                <div class="hpbk-heading hpbk-heading--center">
                    <h2 id="hpbk-why-title">Why Choose Our Hospitality Outsourcing Services?</h2>
                </div>

                <div class="hpbk-why__grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="hpbk-why__card" role="listitem">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Compliance --}}
        <section class="hpbk-section hpbk-compliance" aria-labelledby="hpbk-compliance-title">
            <div class="site-shell hpbk-compliance__inner">
                <div class="hpbk-compliance__copy">
                    <h2 id="hpbk-compliance-title">Compliance &amp; Regulatory Expertise</h2>
                    <p>We help you stay compliant with both national and international accounting standards:</p>

                    <div class="hpbk-compliance__cards" role="list">
                        @foreach ($complianceItems as $item)
                            <article class="hpbk-compliance__card" role="listitem">
                                <span class="hpbk-check" aria-hidden="true">{!! $checkSvg !!}</span>
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="hpbk-compliance__media">
                    <img
                        src="{{ $img('compliance-regulatory-expertise.webp') }}"
                        alt="Compliance &amp; Regulatory Expertise"
                        width="800"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Secondary CTA --}}
        <section class="hpbk-cta-banner hpbk-cta-banner--copy" aria-labelledby="hpbk-cta-two-title">
            <div class="site-shell hpbk-cta-banner__inner">
                <div class="hpbk-cta-banner__copy">
                    <h2 id="hpbk-cta-two-title">Ready to streamline your hospitality operations?</h2>
                    <p>Partner with us for affordable, results-oriented solutions delivered by expert professionals. Our adaptive support services ensure your business gets the tailored attention it deserves.</p>
                </div>
                <a href="#request-form-demo" class="hpbk-btn hpbk-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="hpbk-section hpbk-consult" id="request-form-demo" aria-labelledby="hpbk-consult-title">
            <div class="site-shell hpbk-consult__inner">
                <aside class="hpbk-consult__card" aria-labelledby="hpbk-consult-title">
                    <div class="hpbk-consult__header">
                        <h2 id="hpbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="hpbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="hospitality-bookkeeping-and-accounting-services"
                            id-prefix="hpbk"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="SUBMIT"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="hpbk-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="form Image"
                        width="540"
                        height="364"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="hpbk-testimonials" aria-labelledby="hpbk-testimonials-title">
            <div class="site-shell">
                <div class="hpbk-heading hpbk-heading--center">
                    <p class="hpbk-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="hpbk-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="hpbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="hpbk-testimonials__nav hpbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="hpbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="hpbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }}"
                            >
                                <p>{{ $item['quote'] }}</p>
                                <cite>{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        class="hpbk-testimonials__nav hpbk-testimonials__nav--next"
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
