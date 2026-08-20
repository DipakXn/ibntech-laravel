@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-san-jose/'.$file);

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
            'tone' => 'green',
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
    @vite(['resources/css/pages/bookkeeping-services-san-jose.css'])
@endpush

@section('content')
    <div class="bksj-page">
        {{-- Hero --}}
        <section class="bksj-hero" aria-labelledby="bksj-hero-title">
            <div class="site-shell bksj-hero__inner">
                <div class="bksj-hero__copy">
                    <h1 id="bksj-hero-title">BOOKKEEPING SERVICES IN SAN JOSE</h1>
                    <p class="bksj-hero__tagline">RESHAPE YOUR BOOKS FOR SUCCESS IN SAN JOSE</p>
                    <p class="bksj-hero__lede">
                        Streamlining financial responsibilities in SAN JOSE: Let us help you master the full scope of your business accounting needs.
                    </p>
                </div>

                <aside class="bksj-hero__form" id="contact-us" aria-labelledby="bksj-hero-form-title">
                    <h2 id="bksj-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="bksj-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-san-jose"
                        id-prefix="bksj"
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
        <section class="bksj-intro" aria-labelledby="bksj-intro-title">
            <div class="site-shell">
                <div class="bksj-intro__card">
                    <h2 id="bksj-intro-title">
                        Expert Accounting and Bookkeeping Services for SAN JOSE Businesses
                    </h2>
                    <p>
                        <strong>IBN Technologies</strong> specializes in managing the complexities of SAN JOSE business finances, including local taxes and regulations. We provide expert bookkeeping with advanced software and extensive knowledge of Illinois and SAN JOSE tax laws. Our services include real-time financial insights, enhanced compliance, fully outsourced solutions, support during busy periods, and expertise in complex accounting matters such as IFRS.
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services tabs --}}
        <section class="bksj-section" aria-labelledby="bksj-services-title">
            <div class="site-shell">
                <div class="bksj-heading bksj-heading--center">
                    <h2 id="bksj-services-title">Outsourced Bookkeeping Services in SAN JOSE</h2>
                </div>

                <div
                    class="bksj-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bksj-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bksj-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bksj-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bksj-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="bksj-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bksj-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bksj-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bksj-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bksj-tabs__media">
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
                                        class="bksj-btn bksj-btn--navy bksj-tabs__cta"
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
        <section class="bksj-narrative" aria-label="Bookkeeping services for San Jose businesses">
            <div class="bksj-narrative__media" aria-hidden="true">
                <img
                    src="{{ $img('narrative-office.jpg') }}"
                    alt=""
                    width="900"
                    height="600"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="bksj-narrative__copy">
                <p>
                    One of the biggest pain points businesses face is staying on top of their books without shifting their focus away from other vital operations. Without proper bookkeeping, businesses face the risk of falling into financial hardship due to inaccurate tracking or incomplete data.
                    We eliminate this issue with our comprehensive solutions that keep your finances organized and up-to-date. Our team takes care of all the details for you, so you can stay focused on running your business successfully.
                    IBN provides professional bookkeeping services that help businesses in San Jose accurately account for all their financial transactions. Our team of experienced bookkeepers has the expertise to handle all the ins and outs of bookkeeping. From accounts receivable and payable, budgeting, and forecasting, to document processing and reporting, we can help any business at any stage keep its books in order.
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="bksj-btn bksj-btn--green">
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Why San Jose businesses choose us --}}
        <section class="bksj-section" aria-labelledby="bksj-why-choose-title">
            <div class="site-shell">
                <div class="bksj-heading bksj-heading--center">
                    <h2 id="bksj-why-choose-title">
                        Why SAN JOSE Businesses Choose Us for Expert Bookkeeping Solutions
                    </h2>
                </div>

                <div class="bksj-solutions" role="list">
                    @foreach ($whySolutions as $card)
                        <article class="bksj-solution bksj-solution--{{ $card['tone'] }}" role="listitem">
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

                <div class="bksj-section__cta">
                    <a href="#" class="bksj-btn bksj-btn--green" data-contact-modal-trigger>
                        Schedule a Bookkeeping strategy session
                    </a>
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bksj-software" aria-labelledby="bksj-software-title">
            <div class="site-shell bksj-software__inner">
                <div class="bksj-software__copy">
                    <h2 id="bksj-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bksj-software__media">
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
        <section class="bksj-section" aria-labelledby="bksj-why-title">
            <div class="site-shell">
                <div class="bksj-heading bksj-heading--center">
                    <h2 id="bksj-why-title">
                        Why IBN Tech is the Leading <span class="bksj-accent">Bookkeeping</span> Outsourcing Provider in the SAN JOSE
                    </h2>
                </div>

                <div class="bksj-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bksj-stat" role="listitem">
                            <p class="bksj-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bksj-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bksj-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'free-consultation']) }}" class="bksj-btn bksj-btn--green">
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- What You Get --}}
        <section class="bksj-what" aria-labelledby="bksj-what-title">
            <div class="site-shell bksj-what__inner">
                <div class="bksj-what__copy">
                    <h2 id="bksj-what-title">
                        What You Get with Our <span class="bksj-accent">Bookkeeping</span> Services in SAN JOSE
                    </h2>

                    <div class="bksj-what__lists">
                        @foreach ($whatYouGet as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="bksj-what__check" aria-hidden="true">
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

                <div class="bksj-what__media">
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
        <section class="bksj-section" aria-labelledby="bksj-industries-title">
            <div class="site-shell">
                <div class="bksj-heading bksj-heading--center">
                    <h2 id="bksj-industries-title">Industries We Serve</h2>
                </div>

                <div class="bksj-industries" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bksj-industry bksj-industry--link"
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
                            <article class="bksj-industry" role="listitem">
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
        <section class="bksj-trial" aria-labelledby="bksj-trial-title">
            <div class="site-shell bksj-trial__inner">
                <p id="bksj-trial-title">
                    Discover how you can reduce costs with our services. Begin with a FREE trial—no obligations!
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-trial']) }}" class="bksj-btn bksj-btn--green">
                    Get Free Trial
                </a>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bksj-testimonials" aria-labelledby="bksj-testimonials-title">
            <div class="site-shell">
                <div class="bksj-heading bksj-heading--center">
                    <p class="bksj-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bksj-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bksj-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bksj-testimonials__nav bksj-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bksj-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bksj-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bksj-testimonials__nav bksj-testimonials__nav--next"
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
