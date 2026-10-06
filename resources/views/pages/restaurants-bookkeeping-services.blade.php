@php
    $img = fn (string $file): string => asset('images/restaurants-bookkeeping-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $costControlFeatures = [
        [
            'icon' => 'vendor-invoice-management_ar-automation.webp',
            'alt' => 'vendor invoice management ar automation',
            'title' => 'Vendor Invoice Management',
            'href' => route('page.show', ['slug' => 'finance-and-accounting-services']),
            'text' => 'Negotiate the best prices and terms with our thorough invoice reviews and reconciliations.',
        ],
        [
            'icon' => 'inventory-tracking.webp',
            'alt' => 'inventory tracking',
            'title' => 'Inventory Tracking',
            'href' => '#',
            'text' => 'From gourmet cheeses to the finest wines, track your ingredients to prevent spoilage and excess stock.',
        ],
        [
            'icon' => 'labor-cost-analysis.webp',
            'alt' => 'labor cost analysis',
            'title' => 'Labor Cost Analysis',
            'href' => route('page.show', ['slug' => 'treasury-management-services-outsourcing']),
            'text' => 'Align staffing with demand to optimize your workforce costs without compromising service quality.',
        ],
    ];

    $revenueFeatures = [
        [
            'title' => 'Point of Sale Reconciliation:',
            'text' => 'Every transaction is carefully recorded and reconciled for complete financial accuracy.',
        ],
        [
            'title' => 'Deferred Revenue Management:',
            'text' => 'We skillfully manage gift cards, catering deposits, and vouchers, ensuring revenue is recognized in accordance with GAAP standards.',
        ],
    ];

    $outsourcedFeatures = [
        [
            'title' => 'Cash Flow Management:',
            'text' => 'Stay informed about daily sales and maintain a steady cash flow to keep your restaurant running smoothly.',
        ],
        [
            'title' => 'Payroll Administration:',
            'text' => 'Streamlined payroll processes ensure your staff is paid accurately and on time while managing Tip Reporting to maintain compliance with tax obligations.',
        ],
        [
            'title' => 'Budgeting and Forecasting:',
            'text' => 'Plan for the future with our insights helping you to budget for slow seasons and capitalize on the peak dining periods.',
        ],
        [
            'title' => 'Profit and Loss Statements:',
            'text' => 'Regular, detailed P&L statements give you a clear view of your financial health, helping you to make informed decisions.',
        ],
    ];

    $complianceFeatures = [
        [
            'title' => 'Compliance Assurance:',
            'text' => 'We ensure that all financial practices are in line with the latest regulations, so you can focus on your restaurant, worry-free.',
        ],
        [
            'title' => 'Maintaining Confidentiality:',
            'text' => 'Your financial data is treated with the utmost confidentiality and security measures.',
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

    $workSteps = [
        [
            'icon' => 'consultation.webp',
            'alt' => 'consultation',
            'title' => 'Step 1: Consultation',
            'text' => 'Understand your business needs.',
        ],
        [
            'icon' => 'onboarding.webp',
            'alt' => 'onboarding',
            'title' => 'Step 2 : Onboarding',
            'text' => 'Seamlessly integrate with your existing systems.',
        ],
        [
            'icon' => 'execution.webp',
            'alt' => 'execution',
            'title' => 'Step 3: Execution',
            'text' => 'Expert team members handle your bookkeeping tasks.',
        ],
        [
            'icon' => 'review.webp',
            'alt' => 'review',
            'title' => 'Step 4 : Review',
            'text' => 'Regular check-ins and reports ensure transparency.',
        ],
    ];

    $areasColumns = [
        [
            ['label' => 'California', 'slug' => 'bookkeeping-services-california'],
            ['label' => 'San Francisco', 'slug' => 'bookkeeping-services-san-francisco'],
            ['label' => 'Los Angeles', 'slug' => 'bookkeeping-services-los-angeles'],
            ['label' => 'San Diego', 'slug' => 'bookkeeping-services-san-diego'],
            ['label' => 'Las Vegas', 'slug' => 'bookkeeping-services-las-vegas'],
        ],
        [
            ['label' => 'San Jose', 'slug' => 'bookkeeping-services-san-jose'],
            ['label' => 'Chicago', 'slug' => 'bookkeeping-services-chicago'],
            ['label' => 'New York', 'slug' => 'bookkeeping-services-new-york'],
            ['label' => 'Florida', 'slug' => 'bookkeeping-services-florida'],
            ['label' => 'Texas', 'slug' => 'bookkeeping-services-texas'],
        ],
        [
            ['label' => 'Vermont', 'slug' => 'bookkeeping-services-vermont'],
            ['label' => 'Hartford', 'slug' => 'bookkeeping-services-hartford'],
            ['label' => 'Austin', 'slug' => 'bookkeeping-services-austin'],
            ['label' => 'Phoenix', 'slug' => 'bookkeeping-services-phoenix'],
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
    @vite(['resources/css/pages/restaurants-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="rstbk-page">
        {{-- Hero --}}
        <section class="rstbk-hero" aria-labelledby="rstbk-hero-title">
            <div class="site-shell rstbk-hero__inner">
                <div class="rstbk-hero__copy">
                    <p class="rstbk-hero__eyebrow">Unlock Savings and Efficiency with IBN Tech’s</p>
                    <h1 id="rstbk-hero-title">Outsource Bookkeeping Services for Restaurants</h1>
                    <p class="rstbk-hero__lede">
                        <strong>IBN Tech</strong> helps restaurants reduce their financial outlay and boost operational efficiency by providing real-time financial insights.
                    </p>
                    <div class="rstbk-hero__actions">
                        <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="rstbk-hero__media">
                    <img
                        src="{{ $img('bookkeeping-restaurants.webp') }}"
                        alt="bookkeeping-restaurants"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="rstbk-section" aria-labelledby="rstbk-intro-title">
            <div class="site-shell rstbk-split">
                <div class="rstbk-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-the-essence-of.webp') }}"
                        alt="at ibn tech we understand the essence of"
                        width="526"
                        height="346"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rstbk-split__copy">
                    <h2 id="rstbk-intro-title" class="sr-only">Restaurant Bookkeeping Services</h2>
                    <p>
                        At IBN Tech, we understand that the essence of your restaurant business is serving exceptional culinary experiences. However, the financial health of your restaurant is just as critical to ensure that those experiences can be delivered consistently. Managing a restaurant's finances comes with unique challenges, from inventory management to dynamic pricing.
                    </p>
                    <p>
                        Our dedicated Restaurant Bookkeeping Services are crafted to handle your establishment’s financial needs, streamline your revenue cycle, manage operational costs effectively, and ensure compliance, freeing you up to focus on delighting your patrons.
                    </p>
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Cost Control Strategies --}}
        <section class="rstbk-section rstbk-section--soft" aria-labelledby="rstbk-cost-title">
            <div class="site-shell">
                <div class="rstbk-heading rstbk-heading--center">
                    <p class="rstbk-heading__eyebrow">Cost Control Strategies</p>
                    <h2 id="rstbk-cost-title">Essential for Margins and Growth</h2>
                    <p>
                        Controlling costs in a restaurant goes far beyond portion sizes. It's about strategic purchasing, waste reduction, and inventory management. Our services provide:
                    </p>
                </div>

                <div class="rstbk-feature-grid" role="list">
                    @foreach ($costControlFeatures as $item)
                        <article class="rstbk-feature-card" role="listitem">
                            <a href="{{ $item['href'] }}" class="rstbk-feature-card__icon" tabindex="-1" aria-hidden="true">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt=""
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </a>
                            <h3>
                                <a href="{{ $item['href'] }}">{{ $item['title'] }}</a>
                            </h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="rstbk-section__cta">
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Accurate Revenue Recognition --}}
        <section class="rstbk-section" aria-labelledby="rstbk-revenue-title">
            <div class="site-shell rstbk-split">
                <div class="rstbk-split__copy">
                    <h2 id="rstbk-revenue-title">Accurate Revenue Recognition</h2>
                    <p class="rstbk-subhead">Maximize Profits with Precision</p>
                    <p>
                        Effective financial management in the restaurant industry is about understanding the flow of your revenue streams. Our team ensures that your income is accurately tracked and enhanced. We offer:
                    </p>
                    @foreach ($revenueFeatures as $item)
                        <p>
                            <strong>{{ $item['title'] }}</strong>
                            {{ $item['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="rstbk-split__media">
                    <img
                        src="{{ $img('accurate-revenue-recognition.webp') }}"
                        alt="accurate revenue recognition"
                        width="536"
                        height="525"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Outsourced Bookkeeping Services --}}
        <section class="rstbk-section rstbk-section--soft" aria-labelledby="rstbk-outsourced-title">
            <div class="site-shell rstbk-split">
                <div class="rstbk-split__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="outsourced bookkeeping services"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rstbk-split__copy">
                    <h2 id="rstbk-outsourced-title">Outsourced Bookkeeping Services</h2>
                    <p class="rstbk-subhead">Designed to Suit Your Restaurant's Needs</p>
                    <p>
                        Whether you operate a bistro or a national chain, our bookkeeping services are customized to the palate of your financial needs. We provide:
                    </p>
                    @foreach ($outsourcedFeatures as $item)
                        <p>
                            <strong>{{ $item['title'] }}</strong>
                            {{ $item['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Compliance and Confidentiality --}}
        <section class="rstbk-section" aria-labelledby="rstbk-compliance-title">
            <div class="site-shell rstbk-split">
                <div class="rstbk-split__copy">
                    <h2 id="rstbk-compliance-title">Compliance and Confidentiality</h2>
                    <p class="rstbk-subhead">Ensuring the Safety and Security of Your Restaurant's Data</p>
                    <p>
                        We treat your sensitive financial information with the highest level of care. Our commitment includes:
                    </p>
                    @foreach ($complianceFeatures as $item)
                        <p>
                            <strong>{{ $item['title'] }}</strong>
                            {{ $item['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="rstbk-split__media">
                    <img
                        src="{{ $img('compliance-and-confidentiality.webp') }}"
                        alt="compliance and confidentiality"
                        width="526"
                        height="456"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- What Makes IBN Tech --}}
        <section class="rstbk-section rstbk-stats-section" aria-labelledby="rstbk-stats-title">
            <div class="site-shell">
                <div class="rstbk-heading rstbk-heading--center">
                    <h2 id="rstbk-stats-title">What Makes IBN Tech</h2>
                    <p class="rstbk-heading__sub">
                        Best Bookkeeping Services Provider for Restaurant Business
                    </p>
                </div>

                <div class="rstbk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="rstbk-stat" role="listitem">
                            <p class="rstbk-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="rstbk-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="rstbk-section__cta">
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Dining CTA banner --}}
        <section class="rstbk-banner" aria-labelledby="rstbk-banner-title">
            <div class="site-shell rstbk-banner__inner">
                <h2 id="rstbk-banner-title">You've perfected the Dining experience</h2>
                <p>Let us perfect your Books.</p>
                <a href="#contact-us" class="rstbk-btn rstbk-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="rstbk-section" aria-labelledby="rstbk-software-title">
            <div class="site-shell">
                <div class="rstbk-heading rstbk-heading--center">
                    <h2 id="rstbk-software-title" class="rstbk-software-title">
                        Software <span>Expertise</span>
                    </h2>
                </div>
                <div class="rstbk-software">
                    <img
                        src="{{ $img('software-bookkeeping.webp') }}"
                        alt="Software-Bookkeeping"
                        width="1920"
                        height="900"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- How We Work --}}
        <section class="rstbk-section" aria-labelledby="rstbk-work-title">
            <div class="site-shell">
                <div class="rstbk-heading rstbk-heading--center">
                    <h2 id="rstbk-work-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="rstbk-steps" role="list">
                    @foreach ($workSteps as $step)
                        <article class="rstbk-step" role="listitem">
                            <img
                                src="{{ $img($step['icon']) }}"
                                alt="{{ $step['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="rstbk-section__cta">
                    <a href="#contact-us" class="rstbk-btn rstbk-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Areas We Serve --}}
        <section class="rstbk-section rstbk-section--soft" aria-labelledby="rstbk-areas-title">
            <div class="site-shell">
                <div class="rstbk-heading rstbk-heading--center">
                    <h2 id="rstbk-areas-title">Areas We Serve</h2>
                </div>

                <div class="rstbk-areas">
                    @foreach ($areasColumns as $column)
                        <ul class="rstbk-areas__col">
                            @foreach ($column as $area)
                                <li>
                                    <a href="{{ route('page.show', ['slug' => $area['slug']]) }}">
                                        <svg aria-hidden="true" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                        </svg>
                                        <span>{{ $area['label'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="rstbk-section rstbk-consult" id="contact-us" aria-labelledby="rstbk-consult-title">
            <div class="site-shell rstbk-consult__inner">
                <aside class="rstbk-consult__card" aria-labelledby="rstbk-consult-title">
                    <div class="rstbk-consult__header">
                        <h2 id="rstbk-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="rstbk-consult__body">
                        <livewire:forms.contact-form
                            form-name="restaurants-bookkeeping-services"
                            id-prefix="rstbk"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="rstbk-consult__media">
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
        <section class="rstbk-testimonials" aria-labelledby="rstbk-testimonials-title">
            <div class="site-shell">
                <div class="rstbk-heading rstbk-heading--center">
                    <p class="rstbk-testimonials__eyebrow">Discover Why IBN Tech is the</p>
                    <h2 id="rstbk-testimonials-title">Best Bookkeeping Firms in the USA</h2>
                </div>

                <div
                    class="rstbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="rstbk-testimonials__nav rstbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="rstbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="rstbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="rstbk-testimonials__nav rstbk-testimonials__nav--next"
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
