@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-los-angeles/'.$file);

    $formIndustryOptions = [
        'Real Estate',
        'Manufacturing',
        'E-Commerce',
        'Hospitality',
        "Restaurant's",
        'Finance Business',
        'Retail Store',
        'Travel',
        'CPA Firms',
        'Legal Firms',
        'Marketing & Advertising',
        'Food & Beverage',
        'IT Business',
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

    $whySolutions = [
        [
            'tone' => 'navy',
            'title' => 'Bookkeeping Services',
            'items' => [
                'Electronic Document Management',
                'Revenue Reconciliation with Bank Deposits',
                'Reconciliations (Checking and Credit Cards)',
                'Accounts Payable (Vendor Bills and Payments)',
                'Accounts Receivable (Customer Invoices and Collections)',
            ],
        ],
        [
            'tone' => 'green',
            'title' => 'Controller Service',
            'items' => [
                'Preparation of financial statements',
                'Cash Flow Preparation & Forecasting',
                'Yearly Budget Preparation & periodical analysis',
                'Accounts Payable (Vendor Bills and Payments)',
                'Costing, MIS Reports Preparation, Vertical & Horizontal analysis',
            ],
        ],
        [
            'tone' => 'green-dark',
            'title' => 'Accounting System & Integration',
            'items' => [
                'Accounts Payable (Vendor Bills and Payments)',
                'Accounts Receivable (Customer Invoices and Collections)',
                'Reconciliations (Checking and Credit Cards)',
                'Revenue Reconciliation with Bank Deposits',
                'Electronic Document Management',
            ],
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
        ['value' => '200+', 'label' => 'Active Global Clients'],
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
    @vite(['resources/css/pages/bookkeeping-services-los-angeles.css'])
@endpush

@section('content')
    <div class="bkla-page">
        {{-- Hero --}}
        <section class="bkla-hero" aria-labelledby="bkla-hero-title">
            <div class="site-shell bkla-hero__inner">
                <div class="bkla-hero__copy">
                    <h1 id="bkla-hero-title">BOOKKEEPING SERVICES IN LOS ANGELES</h1>
                    <p class="bkla-hero__tagline">IBN COUPLES TECHNOLOGY WITH FINANCES</p>
                    <p class="bkla-hero__lede">
                        Minimize paperwork and generate real-time insights with our extensive bookkeeping services in Los Angeles.
                    </p>
                </div>

                <aside class="bkla-hero__form" id="contact-us" aria-labelledby="bkla-hero-form-title">
                    <h2 id="bkla-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="bkla-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-los-angeles"
                        id-prefix="bkla"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formIndustryOptions"
                        service-placeholder="Please Select Industries"
                        message-placeholder="Message"
                        submit-label="Get Started Now"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="bkla-intro" aria-labelledby="bkla-intro-title">
            <div class="site-shell">
                <div class="bkla-intro__card">
                    <h2 id="bkla-intro-title">
                        Expert Accounting and Bookkeeping Services for LOS ANGELES Businesses
                    </h2>
                    <p>
                        <strong>IBN Technologies</strong> specializes in managing the complexities of LOS ANGELES business finances, including local taxes and regulations. We provide expert bookkeeping with advanced software and extensive knowledge of Illinois and LOS ANGELES tax laws. Our services include real-time financial insights, enhanced compliance, fully outsourced solutions, support during busy periods, and expertise in complex accounting matters such as IFRS.
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services tabs --}}
        <section class="bkla-section" aria-labelledby="bkla-services-title">
            <div class="site-shell">
                <div class="bkla-heading bkla-heading--center">
                    <h2 id="bkla-services-title">Outsourced Bookkeeping Services in LOS ANGELES</h2>
                </div>

                <div
                    class="bkla-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bkla-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bkla-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bkla-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bkla-panel-{{ $i }}"
                            >
                                <i class="fa-solid fa-chevron-down bkla-tabs__chevron" aria-hidden="true"></i>
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="bkla-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bkla-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bkla-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bkla-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bkla-tabs__media">
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
                                        class="bkla-btn bkla-btn--navy bkla-tabs__cta"
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

        {{-- Narrative split --}}
        <section class="bkla-narrative" aria-label="Bookkeeping services for Los Angeles businesses">
            <div class="bkla-narrative__media" aria-hidden="true">
                <img
                    src="{{ $img('narrative-office.jpg') }}"
                    alt=""
                    width="900"
                    height="600"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="bkla-narrative__copy">
                <p>
                    Combining the power of technology with standard accounting procedures is the USP of our bookkeeping services in Los Angeles. We’ve been helping businesses in Los Angeles manage their finances with our extensive suite of accounting services. Our certified bookkeepers are experts in streamlining accounts for financial reporting and other such purposes.
                </p>
                <p>
                    Our bookkeepers are well-trained in the most popular accounting tools, which means they can use the accounting software of your choice to manage accounts for you. We can also suggest you the best accounting software that not only allows you to go paperless but also store your data in secure cloud environments.
                </p>
                <p>
                    During the initial client engagements, our accounting experts aim to understand the specific requirements, and based on them, they suggest the suite of necessary bookkeeping services. However, our extensive suite of bookkeeping services includes tracking and categorization of business income/expenses, accounting payables/receivables, financial reporting, etc.
                </p>
                <p>
                    We also have a dedicated support team that is available 24/7 for any requests or queries our clients have.
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="bkla-btn bkla-btn--green">
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Why Los Angeles businesses choose us --}}
        <section class="bkla-section" aria-labelledby="bkla-why-choose-title">
            <div class="site-shell">
                <div class="bkla-heading bkla-heading--center">
                    <h2 id="bkla-why-choose-title">
                        Why <span class="bkla-accent">Los Angeles</span> Businesses Choose Us for Expert Bookkeeping Solutions
                    </h2>
                </div>

                <div class="bkla-solutions" role="list">
                    @foreach ($whySolutions as $card)
                        <article class="bkla-solution bkla-solution--{{ $card['tone'] }}" role="listitem">
                            <h3>{{ $card['title'] }}</h3>
                            <ul>
                                @foreach ($card['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-right" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <div class="bkla-section__cta">
                    <a href="#" class="bkla-btn bkla-btn--green" data-contact-modal-trigger>
                        Schedule a Bookkeeping strategy session
                    </a>
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkla-software" aria-labelledby="bkla-software-title">
            <div class="site-shell bkla-software__inner">
                <div class="bkla-software__copy">
                    <h2 id="bkla-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bkla-software__media">
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

        {{-- Why IBN / Stats --}}
        <section class="bkla-section" aria-labelledby="bkla-why-title">
            <div class="site-shell">
                <div class="bkla-heading bkla-heading--center">
                    <h2 id="bkla-why-title">
                        Why IBN Tech is the Leading <span class="bkla-accent">Bookkeeping</span> Outsourcing Provider in the Los Angeles
                    </h2>
                </div>

                <div class="bkla-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bkla-stat" role="listitem">
                            <p class="bkla-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bkla-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bkla-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="bkla-btn bkla-btn--green">
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- What You Get --}}
        <section class="bkla-what" aria-labelledby="bkla-what-title">
            <div class="site-shell bkla-what__inner">
                <div class="bkla-what__copy">
                    <h2 id="bkla-what-title">
                        What You Get with Our <span class="bkla-accent">Bookkeeping</span> Services in Los Angeles
                    </h2>

                    <div class="bkla-what__lists">
                        @foreach ($whatYouGet as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="bkla-what__check" aria-hidden="true">
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

                <div class="bkla-what__media">
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

        {{-- Industries --}}
        <section class="bkla-section" aria-labelledby="bkla-industries-title">
            <div class="site-shell">
                <div class="bkla-heading bkla-heading--center">
                    <h2 id="bkla-industries-title">Industries We Serve</h2>
                </div>

                <div class="bkla-industries" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bkla-industry bkla-industry--link"
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
                            <article class="bkla-industry" role="listitem">
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

        {{-- Free trial CTA --}}
        <section class="bkla-trial" aria-labelledby="bkla-trial-title">
            <div class="site-shell bkla-trial__inner">
                <p id="bkla-trial-title">
                    Discover how you can reduce costs with our services. Begin with a FREE trial—no obligations !
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-trial']) }}" class="bkla-btn bkla-btn--green">
                    Get Free Trial
                </a>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bkla-testimonials" aria-labelledby="bkla-testimonials-title">
            <div class="site-shell">
                <div class="bkla-heading bkla-heading--center">
                    <p class="bkla-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bkla-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bkla-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bkla-testimonials__nav bkla-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkla-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bkla-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bkla-testimonials__nav bkla-testimonials__nav--next"
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
