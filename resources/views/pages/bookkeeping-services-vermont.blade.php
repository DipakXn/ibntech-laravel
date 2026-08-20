@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-vermont/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $serviceTabs = [
        [
            'title' => 'Bookkeeping Services',
            'image' => 'bookkeeping-services-1.webp',
            'alt' => 'Bookkeeping Services in USA',
        ],
        [
            'title' => 'Payroll Processing',
            'image' => 'payroll-processing.webp',
            'alt' => 'Payroll Processing Services in USA',
        ],
        [
            'title' => 'Financial Reporting',
            'image' => 'financial-reporting-1.webp',
            'alt' => 'Financial Reporting Service in USA',
        ],
        [
            'title' => 'Accounting Services',
            'image' => 'accounting-services-1.webp',
            'alt' => 'Accounting Services in USA',
        ],
        [
            'title' => 'Controller Services',
            'image' => 'controller-services-1.webp',
            'alt' => 'Best Controller Services In USA',
        ],
        [
            'title' => 'Accounts Payable and Receivable',
            'image' => 'accounts-payable-and-receivable-1.webp',
            'alt' => 'Accounts Payable and Receivable Services In USA',
        ],
    ];

    $whyChoose = [
        [
            'num' => '01',
            'color' => '#ff9900',
            'title' => 'Value-Driven Approach',
            'text' => 'We aim to provide services that go beyond affordability, ensuring the value you receive justifies your investment.',
        ],
        [
            'num' => '02',
            'color' => '#ff3333',
            'title' => 'Ready to Scale',
            'text' => 'Our operational efficiency allows you to scale your bookkeeping needs quickly as your business grows',
        ],
        [
            'num' => '03',
            'color' => '#009999',
            'title' => 'Minimal Input Required',
            'text' => 'With our qualified team, you can stay hands-off, while we handle all aspects of your bookkeeping seamlessly',
        ],
        [
            'num' => '04',
            'color' => '#1cbf36',
            'title' => 'Vermont Expertise',
            'text' => 'Tailored services for Vermont’s diverse business landscape.',
        ],
        [
            'num' => '05',
            'color' => '#b117df',
            'title' => 'Leverage the Best Accounting Tools',
            'text' => 'Our professionals work with your preferred accounting software or recommend the best tools to meet your needs',
        ],
        [
            'num' => '06',
            'color' => '#f10ab8',
            'title' => 'Your Data is Safe',
            'text' => 'We prioritize your data security, utilizing advanced technology and adhering to ISO 27001 certification standards to protect all sensitive information.',
        ],
    ];

    $whatYouGet = [
        [
            'Detailed Report Creation',
            'E-Document Management',
            'Quick Document Submission',
            'Access to Accounting Systems',
            'MIS and other Management Reporting',
        ],
        [
            'Ensuring GAAP Compliance',
            'Accounting Advisory Services',
            'Month Close and Ongoing Support',
            'Budget V/S Actual reporting and analysis',
        ],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '26+', 'label' => 'Years of Experience'],
        ['value' => '1,500+', 'label' => 'Active Global Clients'],
        ['value' => '50%', 'label' => 'Save operational cost'],
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '99.99%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '21+', 'label' => 'Accounting Software Expertise'],
        ['value' => '120+', 'label' => 'Qualified & Certified Bookkeepers'],
        ['value' => '10+', 'label' => 'Client-centric Account Managers'],
    ];

    $industries = [
        [
            'label' => 'Real Estate',
            'file' => 'real-estate.webp',
            'alt' => 'real estate',
            'slug' => 'real-estate-construction-bookkeeping-services',
        ],
        [
            'label' => 'Healthcare',
            'file' => 'healthcare.webp',
            'alt' => 'healthcare',
            'slug' => 'healthcare-bookkeeping-services',
        ],
        [
            'label' => "Restaurant's",
            'file' => 'restaurant.webp',
            'alt' => 'Restaurent',
            'slug' => 'restaurants-bookkeeping-services',
        ],
        [
            'label' => 'Finance Business',
            'file' => 'finance-business.webp',
            'alt' => 'Manufacturing',
            'slug' => 'finance-businesses-bookkeeping-service',
        ],
        [
            'label' => 'Retail Store',
            'file' => 'retail.webp',
            'alt' => 'retail',
            'slug' => 'bookkeeping-services-for-retail-stores',
        ],
        [
            'label' => 'Travel',
            'file' => 'travel.webp',
            'alt' => 'Travel',
            'slug' => 'travel-bookkeeping-service',
        ],
        [
            'label' => 'CPA Firms',
            'file' => 'cpa.webp',
            'alt' => 'CPA',
            'slug' => null,
        ],
        [
            'label' => 'E-Commerce',
            'file' => 'ecommerce.webp',
            'alt' => 'Ecommerce',
            'slug' => 'ecommerce-bookkeeping-services',
        ],
        [
            'label' => 'Legal Firms',
            'file' => 'legal.webp',
            'alt' => 'Legal',
            'slug' => 'legal-bookkeeping-services',
        ],
        [
            'label' => 'Marketing & Advertising',
            'file' => 'marketing-advertising.webp',
            'alt' => 'Marketing',
            'slug' => 'marketing-and-advertising-bookkeeping-services',
        ],
        [
            'label' => 'Food & Beverage',
            'file' => 'food-beverage.webp',
            'alt' => 'Bookkeeping for Food & Beverage',
            'slug' => 'food-and-beverage-bookkeeping-services',
        ],
        [
            'label' => 'IT Business',
            'file' => 'it-business.webp',
            'alt' => 'IT-Business',
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
    @vite(['resources/css/pages/bookkeeping-services-vermont.css'])
@endpush

@section('content')
    <div class="bkvt-page">
        {{-- Hero --}}
        <section class="bkvt-hero" aria-labelledby="bkvt-hero-title">
            <div class="site-shell bkvt-hero__inner">
                <div class="bkvt-hero__copy">
                    <h1 id="bkvt-hero-title">
                        Vermont Bookkeeping Services – Save 50% on Operational Costs
                    </h1>
                    <p class="bkvt-hero__lede">
                        Trusted bookkeeping for Vermont businesses – precision you can count on, service you can trust. Locally rooted, reliably delivered.
                    </p>
                </div>

                <aside class="bkvt-hero__form" id="contact-us" aria-labelledby="bkvt-hero-form-title">
                    <h2 id="bkvt-hero-form-title">Get Started with Our Bookkeeping Services</h2>
                    <p class="bkvt-hero__form-sub">Fill Out the Form and Simplify Your Books</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-vermont"
                        id-prefix="bkvt"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="Message"
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="bkvt-intro" aria-labelledby="bkvt-intro-title">
            <div class="site-shell">
                <div class="bkvt-intro__card">
                    <h2 id="bkvt-intro-title">
                        Vermont's Trusted Partner for Precise and Personalized Bookkeeping Solutions
                    </h2>
                    <p>
                        <strong><a href="{{ url('/') }}">IBN Technologies</a></strong>
                        specializes in providing small to medium-sized businesses across Vermont (VT) with meticulous, reliable, and locally tailored bookkeeping solutions. Our team is dedicated to simplifying your financial management. With deep local expertise and a personalized approach, we ensure your records are accurate, compliant, and ready for informed decision-making.
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services tabs --}}
        <section class="bkvt-section" aria-labelledby="bkvt-services-title">
            <div class="site-shell">
                <div class="bkvt-heading bkvt-heading--center">
                    <h2 id="bkvt-services-title">Outsourced Bookkeeping Services in Vermont</h2>
                </div>

                <div
                    class="bkvt-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bkvt-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bkvt-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bkvt-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bkvt-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="bkvt-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bkvt-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bkvt-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bkvt-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bkvt-tabs__media">
                                    <img
                                        src="{{ $img($tab['image']) }}"
                                        alt="{{ $tab['alt'] }}"
                                        width="850"
                                        height="450"
                                        @if ($i === 0) loading="eager" fetchpriority="high" @else loading="lazy" @endif
                                        decoding="async"
                                    >
                                    <a
                                        href="#"
                                        class="bkvt-btn bkvt-btn--navy bkvt-tabs__cta"
                                        data-contact-modal-trigger
                                    >
                                        Schedule a call with our accounting Expert Now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Navy CTA band --}}
        <section class="bkvt-band" aria-labelledby="bkvt-band-title">
            <div class="site-shell bkvt-band__inner">
                <div class="bkvt-band__copy">
                    <p id="bkvt-band-title">
                        <strong>Free up time and cut costs with Vermont's expert bookkeeping.</strong>
                        Precision-driven, we help your business thrive, one balanced book at a time.
                    </p>
                    <p>Get started now with a free consultation; bookkeeping starts at just $10 per hour!</p>
                </div>
                <a href="#" class="bkvt-btn bkvt-btn--green" data-contact-modal-trigger>
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkvt-software" aria-labelledby="bkvt-software-title">
            <div class="site-shell bkvt-software__inner">
                <div class="bkvt-software__copy">
                    <h2 id="bkvt-software-title">
                        Software <span class="bkvt-accent">Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bkvt-software__media">
                    <img
                        src="{{ $img('software-logo-img.webp') }}"
                        alt="Best accounting software expertise in IBN"
                        width="688"
                        height="321"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why Vermont businesses choose us --}}
        <section class="bkvt-section" aria-labelledby="bkvt-why-choose-title">
            <div class="site-shell">
                <div class="bkvt-heading bkvt-heading--center">
                    <h2 id="bkvt-why-choose-title">
                        Why Vermont Businesses Choose Us for Expert Bookkeeping Solutions
                    </h2>
                </div>

                <div class="bkvt-benefits" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="bkvt-benefit" role="listitem">
                            <div
                                class="bkvt-benefit__num"
                                style="--bkvt-num-bg: {{ $item['color'] }}"
                                aria-hidden="true"
                            >
                                {{ $item['num'] }}
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="bkvt-section__cta">
                    <a href="#" class="bkvt-btn bkvt-btn--green" data-contact-modal-trigger>
                        GET A QUOTE
                    </a>
                </div>
            </div>
        </section>

        {{-- What You Get --}}
        <section class="bkvt-what" aria-labelledby="bkvt-what-title">
            <div class="site-shell bkvt-what__inner">
                <div class="bkvt-what__copy">
                    <h2 id="bkvt-what-title">
                        What You Get with Our <span class="bkvt-accent">Bookkeeping</span> Services in Vermont
                    </h2>

                    <div class="bkvt-what__lists">
                        @foreach ($whatYouGet as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="bkvt-what__check" aria-hidden="true">
                                            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                            </svg>
                                        </span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>

                <div class="bkvt-what__media">
                    <img
                        src="{{ $img('what-you-get.webp') }}"
                        alt="what-you-get-with-our-bookkeeping-services"
                        width="540"
                        height="540"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why IBN / Stats --}}
        <section class="bkvt-section" aria-labelledby="bkvt-why-title">
            <div class="site-shell">
                <div class="bkvt-heading bkvt-heading--center">
                    <h2 id="bkvt-why-title">
                        Why IBN Tech is the Leading <span class="bkvt-accent">Bookkeeping</span> Outsourcing Provider in Vermont
                    </h2>
                </div>

                <div class="bkvt-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bkvt-stat" role="listitem">
                            <p class="bkvt-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bkvt-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bkvt-section__cta">
                    <a href="#" class="bkvt-btn bkvt-btn--green" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Free trial CTA --}}
        <section class="bkvt-trial" aria-labelledby="bkvt-trial-title">
            <div class="site-shell bkvt-trial__inner">
                <p id="bkvt-trial-title">
                    Discover how you can reduce costs with our services. Begin with a FREE trial—no obligations !
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-trial']) }}" class="bkvt-btn bkvt-btn--green">
                    Get Free Trial
                </a>
            </div>
        </section>

        {{-- Industries --}}
        <section class="bkvt-section" aria-labelledby="bkvt-industries-title">
            <div class="site-shell">
                <div class="bkvt-heading bkvt-heading--center">
                    <h2 id="bkvt-industries-title">Industries We Serve</h2>
                </div>

                <div class="bkvt-industries" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bkvt-industry bkvt-industry--link"
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
                        @else
                            <article class="bkvt-industry" role="listitem">
                                <img
                                    src="{{ $img($industry['file']) }}"
                                    alt="{{ $industry['alt'] }}"
                                    width="75"
                                    height="75"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <h3>{{ $industry['label'] }}</h3>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bkvt-testimonials" aria-labelledby="bkvt-testimonials-title">
            <div class="site-shell">
                <div class="bkvt-heading bkvt-heading--center">
                    <p class="bkvt-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bkvt-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bkvt-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bkvt-testimonials__nav bkvt-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkvt-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bkvt-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bkvt-testimonials__nav bkvt-testimonials__nav--next"
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
