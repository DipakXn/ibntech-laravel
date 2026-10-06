@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-california/'.$file);

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

    $bestBenefits = [
        [
            'num' => '01',
            'color' => '#ff9900',
            'title' => 'Save Time and Money',
            'text' => 'No need to hire or train a full-time bookkeeper.',
        ],
        [
            'num' => '02',
            'color' => '#ff3333',
            'title' => 'Qualified Bookkeepers',
            'text' => 'Accurate and insightful financial management.',
        ],
        [
            'num' => '03',
            'color' => '#009999',
            'title' => 'Qualified Bookkeepers',
            'text' => 'Accurate and insightful financial management.',
        ],
        [
            'num' => '04',
            'color' => '#1cbf36',
            'title' => 'California Expertise',
            'text' => 'Tailored services for California\'s diverse business landscape.',
        ],
        [
            'num' => '05',
            'color' => '#b117df',
            'title' => '24/7 Support',
            'text' => 'Always available for questions and concerns.',
        ],
        [
            'num' => '06',
            'color' => '#f10ab8',
            'title' => 'Flexible Pricing',
            'text' => 'Choose and adjust service levels as needed.',
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
        ['value' => '27+', 'label' => 'Years of Experience'],
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
            'alt' => 'Restaurant',
            'slug' => 'restaurants-bookkeeping-services',
        ],
        [
            'label' => 'Finance Business',
            'file' => 'finance-business.webp',
            'alt' => 'Finance Business',
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
    @vite(['resources/css/pages/bookkeeping-services-california.css'])
@endpush

@section('content')
    <div class="bkca-page">
        {{-- Hero --}}
        <section class="bkca-hero" aria-labelledby="bkca-hero-title">
            <div class="site-shell bkca-hero__inner">
                <div class="bkca-hero__copy">
                    <h1 id="bkca-hero-title">
                        Trusted Outsource Partner for California Accounting &amp; Bookkeeping
                    </h1>
                    <p class="bkca-hero__lede">
                        Experience 95% Satisfaction and Minimize Operational Costs by Up to 50% with Our Accounting and Bookkeeping Services
                    </p>
                </div>

                <aside class="bkca-hero__form" id="contact-us" aria-labelledby="bkca-hero-form-title">
                    <h2 id="bkca-hero-form-title">Get Started with Our Bookkeeping Services</h2>
                    <p class="bkca-hero__form-sub">Fill Out the Form and Simplify Your Books</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-california"
                        id-prefix="bkca"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="Message"
                        submit-label="Submit"
                        layout="home"
                        thank-you-url="/thanks-you-for-bookkeeping/"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="bkca-intro" aria-labelledby="bkca-intro-title">
            <div class="site-shell">
                <div class="bkca-intro__card">
                    <h2 id="bkca-intro-title">
                        Simplified accounting and bookkeeping services for growing businesses
                    </h2>
                    <p>
                        IBN Technologies is a <strong>Top Bookkeeping Outsourcing Service Provider in California (CA).</strong>
                        Our skilled team simplifies your bookkeeping with expert financial management, real-time insights, and seamless day-to-day operations.
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services tabs --}}
        <section class="bkca-section" aria-labelledby="bkca-services-title">
            <div class="site-shell">
                <div class="bkca-heading bkca-heading--center">
                    <h2 id="bkca-services-title">Outsourced Bookkeeping Services in California</h2>
                </div>

                <div
                    class="bkca-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bkca-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bkca-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bkca-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bkca-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="bkca-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bkca-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bkca-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bkca-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bkca-tabs__media">
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
                                        class="bkca-btn bkca-btn--navy bkca-tabs__cta"
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
        <section class="bkca-band" aria-labelledby="bkca-band-title">
            <div class="site-shell bkca-band__inner">
                <div class="bkca-band__copy">
                    <p id="bkca-band-title">
                        <strong>Outsource your California bookkeeping and accounting</strong>
                        to lower overhead costs. Trust us to manage assets, liabilities, and key metrics while you focus on business goals.
                    </p>
                    <p>Get started now with a free consultation; bookkeeping starts at just $10 per hour!</p>
                </div>
                <a href="#" class="bkca-btn bkca-btn--green" data-contact-modal-trigger>
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkca-software" aria-labelledby="bkca-software-title">
            <div class="site-shell bkca-software__inner">
                <div class="bkca-software__copy">
                    <h2 id="bkca-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bkca-software__media">
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

        {{-- Best Bookkeeping Services --}}
        <section class="bkca-section bkca-section--soft" aria-labelledby="bkca-best-title">
            <div class="site-shell">
                <div class="bkca-heading bkca-heading--center">
                    <h2 id="bkca-best-title">Best Bookkeeping Services in California</h2>
                    <p>
                        If you're seeking reliable and affordable bookkeeping services to bring order to your records and business, IBN Technologies is here to help.
                    </p>
                </div>

                <div class="bkca-benefits" role="list">
                    @foreach ($bestBenefits as $item)
                        <article class="bkca-benefit" role="listitem">
                            <div
                                class="bkca-benefit__num"
                                style="--bkca-num-bg: {{ $item['color'] }}"
                                aria-hidden="true"
                            >
                                {{ $item['num'] }}
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <p class="bkca-benefits__note">
                    We deliver nationwide, support multiple software platforms, and ensure certified data security. Get a quote today to experience expert bookkeeping with California-specific knowledge.
                </p>

                <div class="bkca-section__cta">
                    <a href="#" class="bkca-btn bkca-btn--green" data-contact-modal-trigger>
                        Schedule a Bookkeeping strategy session
                    </a>
                </div>
            </div>
        </section>

        {{-- What You Get --}}
        <section class="bkca-what" aria-labelledby="bkca-what-title">
            <div class="site-shell bkca-what__inner">
                <div class="bkca-what__copy">
                    <h2 id="bkca-what-title">What You Get with Our Bookkeeping Services in California</h2>

                    <div class="bkca-what__lists">
                        @foreach ($whatYouGet as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="bkca-what__check" aria-hidden="true">
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

                <div class="bkca-what__media">
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
        <section class="bkca-section" aria-labelledby="bkca-why-title">
            <div class="site-shell">
                <div class="bkca-heading bkca-heading--center">
                    <h2 id="bkca-why-title">
                        Why IBN Tech is the Leading Bookkeeping Outsourcing Provider in the California
                    </h2>
                </div>

                <div class="bkca-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bkca-stat" role="listitem">
                            <h3 class="bkca-stat__label">{{ $stat['label'] }}</h3>
                            <p class="bkca-stat__value">{{ $stat['value'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="bkca-section__cta">
                    <a href="#" class="bkca-btn bkca-btn--green" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="bkca-section" aria-labelledby="bkca-industries-title">
            <div class="site-shell">
                <div class="bkca-heading bkca-heading--center">
                    <h2 id="bkca-industries-title">Industries We Serve</h2>
                </div>

                <div class="bkca-industries" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bkca-industry bkca-industry--link"
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
                            <article class="bkca-industry" role="listitem">
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

        {{-- Save 50% banner --}}
        <section class="bkca-save" aria-labelledby="bkca-save-title">
            <div class="site-shell bkca-save__inner">
                <div class="bkca-save__copy">
                    <h2 id="bkca-save-title">Save 50% on In-House Costs!</h2>
                    <p>Discover how you can reduce costs with our services. Begin with a FREE trial—no obligations!</p>
                </div>
                <a href="#" class="bkca-btn bkca-btn--navy bkca-save__btn" data-contact-modal-trigger>
                    LET'S GET STARTED
                </a>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bkca-testimonials" aria-labelledby="bkca-testimonials-title">
            <div class="site-shell">
                <div class="bkca-heading bkca-heading--center">
                    <p class="bkca-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bkca-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bkca-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bkca-testimonials__nav bkca-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkca-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bkca-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bkca-testimonials__nav bkca-testimonials__nav--next"
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
