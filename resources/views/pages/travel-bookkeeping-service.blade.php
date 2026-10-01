@php
    $img = fn (string $file): string => asset('images/travel-bookkeeping-service/'.$file);

    $serviceTabs = [
        [
            'id' => 'bookkeeping',
            'label' => 'Bookkeeping Services',
            'lead' => 'We provide custom solutions for travel agencies and tour operators:',
            'features' => [
                ['title' => 'Invoice Reconciliation', 'text' => 'Streamline vendor payments and accurately recognize revenue for each package.'],
                ['title' => 'Expense Allocation', 'text' => 'Track finances across services with precision.'],
                ['title' => 'Package Costing', 'text' => 'Calculate travel package costs accurately.'],
                ['title' => 'Automated Transaction Matching', 'text' => 'Quickly reconcile bookings with payments.'],
                ['title' => 'Integrated Accounting Software', 'text' => 'Enhance efficiency with streamlined financial processes.'],
                ['title' => 'Data Security', 'text' => 'Ensure robust protection for your financial data.'],
            ],
            'image' => 'strategic-revenue-recognition.webp',
            'image_alt' => 'Strategic Revenue Recognition',
        ],
        [
            'id' => 'financial-management',
            'label' => 'Financial Management',
            'lead' => 'Enhance your financial strategies with our expert management:',
            'features' => [
                ['title' => 'Multi-Currency Management', 'text' => 'Handle global transactions and exchange rates with precision.'],
                ['title' => 'Commission Tracking', 'text' => 'Ensure accurate and timely management of commissions.'],
                ['title' => 'Seasonal Budgeting', 'text' => 'Strategically plan for demand fluctuations.'],
                ['title' => 'Travel Tax Compliance', 'text' => 'Adhere to travel-specific and international tax laws like UK, TOMs (Tour Operators’ Margin Scheme)'],
            ],
            'image' => 'advanced-financial-management.webp',
            'image_alt' => 'Advanced Financial Management',
        ],
        [
            'id' => 'ap-ar-management',
            'label' => 'AP/AR Management',
            'lead' => 'Optimize your accounts payable and receivable processes:',
            'features' => [
                ['title' => 'Payment Automation', 'text' => 'Enhance efficiency with automated processes.'],
                ['title' => 'Credit Management', 'text' => 'Effectively negotiate and manage credit terms.'],
                ['title' => 'Cash Flow Protection', 'text' => 'Minimize the impact of delayed payments.'],
            ],
            'image' => 'efficient-ap-ar-management.webp',
            'image_alt' => 'Efficient AP-AR Management',
        ],
        [
            'id' => 'payroll-processing',
            'label' => 'Payroll Processing Services',
            'lead' => 'Ensure smooth payroll operations:',
            'features' => [
                ['title' => 'Complex Pay Structures', 'text' => 'Handle incentives and commissions smoothly.'],
                ['title' => 'Global Compliance', 'text' => 'Ensure legal compliance for international staff.'],
                ['title' => 'Prompt Payments', 'text' => 'Guarantee accurate and timely payroll.'],
            ],
            'image' => 'reliable-payroll-services.webp',
            'image_alt' => 'Reliable Payroll Services',
        ],
        [
            'id' => 'cfo-expertise',
            'label' => 'CFO Expertise',
            'lead' => '',
            'features' => [
                ['title' => 'Strategic Leadership', 'text' => 'Access US-based CFOs for financial guidance.'],
                ['title' => 'Investment Strategy', 'text' => 'Make informed decisions in emerging markets.'],
                ['title' => 'Risk and M&A Advisory', 'text' => 'Navigate financial risks and manage mergers effectively.'],
            ],
            'image' => 'cfo-expertise.webp',
            'image_alt' => 'CFO Expertise',
        ],
        [
            'id' => 'revenue-recognition',
            'label' => 'Revenue Recognition',
            'lead' => 'Optimize every revenue stream with our precise tracking and management solutions:',
            'features' => [
                ['title' => 'Booking & Sales Tracking', 'text' => 'Accurately monitor revenue streams from the point of sale.'],
                ['title' => 'Deferred Revenue Management', 'text' => 'Expertly manage prepayments and gift certificates.'],
                ['title' => 'Real-time Reporting', 'text' => 'Make strategic decisions with up-to-date revenue data.'],
            ],
            'image' => 'comprehensive-travel-bookkeeping-services-revenue-recognition.webp',
            'image_alt' => 'Comprehensive Travel Bookkeeping Services Revenue Recognition',
        ],
    ];

    $whyOutsourceItems = [
        ['icon' => 'increased-efficiency.webp', 'title' => 'Increased Efficiency'],
        ['icon' => 'cost-reduction.webp', 'title' => 'Cost Reduction'],
        ['icon' => 'enhanced-competitiveness.webp', 'title' => 'Enhanced Competitiveness'],
        ['icon' => 'time-savings.webp', 'title' => 'Time Savings for Market Expansion'],
        ['icon' => 'compliance-and-regulatory-adherence.webp', 'title' => 'Compliance and Regulatory Adherence'],
        ['icon' => 'advanced-technology-and-infrastructure.webp', 'title' => 'Advanced Technology and Infrastructure'],
        ['icon' => 'scalability-and-flexibility.webp', 'title' => 'Scalability and Flexibility'],
        ['icon' => 'data-security-and-privacy.webp', 'title' => 'Data Security and Privacy'],
        ['icon' => 'automation-and-accuracy.webp', 'title' => 'Automation and Accuracy'],
        ['icon' => 'improved-customer-relationships.webp', 'title' => 'Improved Customer Relationships'],
        ['icon' => 'global-expertise-and-network.webp', 'title' => 'Global Expertise and Network'],
        ['icon' => '247-support.webp', 'title' => '24/7 Support'],
    ];

    $industrySegments = [
        ['icon' => 'airlines.webp', 'title' => 'Airlines', 'slug' => 'healthcare-bookkeeping-services'],
        ['icon' => 'tour-operator.webp', 'title' => 'Tour Operators', 'slug' => 'travel-bookkeeping-service'],
        ['icon' => 'travel-agencies.webp', 'title' => 'Travel Agencies', 'slug' => 'restaurants-bookkeeping-services'],
        ['icon' => 'destination-management-company-dmc.webp', 'title' => 'DMC', 'slug' => 'ecommerce-bookkeeping-services'],
        ['icon' => 'online-travel-aggregator-ota.webp', 'title' => 'OTA', 'slug' => 'legal-bookkeeping-services'],
        ['icon' => 'cruise.webp', 'title' => 'Cruise', 'slug' => 'bookkeeping-services-for-retail-stores'],
        ['icon' => 'online-travelling.webp', 'title' => 'Online Travelling', 'slug' => 'travel-bookkeeping-service'],
        ['icon' => 'travel-management-company-tmc.webp', 'title' => 'TMC', 'slug' => 'marketing-and-advertising-bookkeeping-services'],
        ['icon' => 'b2b-travel-company.webp', 'title' => 'B2B Travel Companies', 'slug' => 'food-and-beverage-bookkeeping-services'],
        ['icon' => 'car-rentals.webp', 'title' => 'Car Rentals', 'slug' => 'finance-businesses-bookkeeping-service'],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '27+', 'label' => 'Years of Experience'],
        ['value' => '200+', 'label' => 'Active Global Clients'],
        ['value' => '50%', 'label' => 'Save operational cost'],
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '99.99%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '20+', 'label' => 'Accounting Software Expertise'],
        ['value' => '120+', 'label' => 'Qualified & Certified Bookkeepers'],
        ['value' => '10+', 'label' => 'Client-centric Account Managers'],
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
            'quote' => "I first searched for an outsourcing company based in India via google. There were 100’s of choices and not being based in India or heard of any of the companies, I really did not know who to use so I clicked on IBN and arranged for a call. \nAlthough the cost was to my liking, it was the total professionalism of the people I spoke to initially and then to the people who were going to take care of me on a daily/weekly basis that impressed me the most. \nOnce the work got started and I saw their spreadsheets and work patterns, and their total understanding of my work, I realized how good they are. IBN has made my life easier to take more clients on and then to be cheeky enough to help with the workload so that I can offer the client other services. There might be 100 similar companies out there, but this is the one for me!",
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
    @vite(['resources/css/pages/travel-bookkeeping-service.css'])
@endpush

@section('content')
    <div class="trvbk-page">
        {{-- Hero Banner --}}
        <section class="trvbk-hero" aria-labelledby="trvbk-hero-title">
            <div class="site-shell trvbk-hero__inner">
                <div class="trvbk-hero__media">
                    <img
                        src="{{ $img('travel-bookkeeping-banner.webp') }}"
                        alt="Travel Bookkeeping Banner"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                        class="trvbk-hero__img"
                    >
                </div>

                <div class="trvbk-hero__copy">
                    <h1 id="trvbk-hero-title" class="trvbk-hero__title">
                        Elevate Your Travel Finances with Travel Bookkeeping Services
                    </h1>
                    <p class="trvbk-hero__lede">
                        Maximize revenue and minimize costs by optimizing your bookkeeping and financial strategies with our customized solutions, lifting your travel business to new heights.
                    </p>
                    <div class="trvbk-hero__actions">
                        <a
                            href="#"
                            id="california-btn"
                            class="trvbk-btn trvbk-btn--green"
                            data-contact-modal-trigger
                        >
                            Get started now
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Intro Card --}}
        <section class="trvbk-intro" aria-labelledby="trvbk-intro-title">
            <div class="site-shell">
                <div class="trvbk-intro__card">
                    <h2 id="trvbk-intro-title" class="trvbk-intro__title">
                        IBN Tech - Leading Travel Bookkeeping Outsourcing Company
                    </h2>
                    <p class="trvbk-intro__text">
                        IBN Tech enhances operations and drives growth for travel agencies in the
                        <strong><a href="{{ route('page.show', ['slug' => 'bookkeeping-services-usa']) }}" class="trvbk-text-link">USA</a></strong>
                        and
                        <strong><a href="{{ route('page.show', ['slug' => 'bookeeping-for-uk']) }}" class="trvbk-text-link">UK</a></strong>
                        through cost-effective outsourcing, backed by deep industry insights. Our expert solutions streamline financial management, allowing agencies to focus on memorable client experiences while staying competitive. Our tailored Travel Bookkeeping Services address industry-specific challenges, ensuring compliance and reducing administrative burdens.
                    </p>
                </div>
            </div>
        </section>

        {{-- Optimize Profitability Section --}}
        <section class="trvbk-profitability" aria-labelledby="trvbk-profit-title">
            <div class="site-shell trvbk-profitability__inner">
                <div class="trvbk-profitability__copy">
                    <h2 id="trvbk-profit-title" class="trvbk-profitability__title">
                        Optimize Your Travel Business's Profitability
                    </h2>
                    <h3 class="trvbk-profitability__subtitle">
                        Precise Expense Management
                    </h3>
                    <p class="trvbk-profitability__desc">
                        Our expert team ensures accurate tracking from booking to trip completion, providing:
                    </p>

                    <ul class="trvbk-checklist">
                        <li class="trvbk-checklist__item">
                            <span class="trvbk-checklist__icon" aria-hidden="true">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                </svg>
                            </span>
                            <span class="trvbk-checklist__label">Vendor Payments &amp; Reconciliations</span>
                        </li>
                        <li class="trvbk-checklist__item">
                            <span class="trvbk-checklist__icon" aria-hidden="true">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                </svg>
                            </span>
                            <span class="trvbk-checklist__label">Operational Cost Tracking</span>
                        </li>
                        <li class="trvbk-checklist__item">
                            <span class="trvbk-checklist__icon" aria-hidden="true">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                </svg>
                            </span>
                            <span class="trvbk-checklist__label">Compliance Assurance</span>
                        </li>
                    </ul>
                </div>

                <div class="trvbk-profitability__media">
                    <img
                        src="{{ $img('precise-expense-management.webp') }}"
                        alt="Precise Expense Management"
                        width="1080"
                        height="1080"
                        loading="lazy"
                        decoding="async"
                        class="trvbk-profitability__img"
                    >
                </div>
            </div>
        </section>

        {{-- Comprehensive Travel Bookkeeping Services (Tabs) --}}
        <section
            class="trvbk-tabs-section"
            aria-labelledby="trvbk-tabs-title"
            x-data="{ activeTab: 'bookkeeping' }"
        >
            <div class="site-shell">
                <div class="trvbk-heading trvbk-heading--center">
                    <h2 id="trvbk-tabs-title" class="trvbk-heading__title">
                        Comprehensive Travel Bookkeeping Services
                    </h2>
                </div>

                <div class="trvbk-tabs-layout">
                    {{-- Tab Navigation --}}
                    <div class="trvbk-tabs-nav" role="tablist" aria-label="Comprehensive Travel Bookkeeping Services">
                        @foreach ($serviceTabs as $tab)
                            <button
                                type="button"
                                role="tab"
                                id="tab-btn-{{ $tab['id'] }}"
                                class="trvbk-tab-btn"
                                :class="{ 'is-active': activeTab === '{{ $tab['id'] }}' }"
                                :aria-selected="activeTab === '{{ $tab['id'] }}'"
                                :tabindex="activeTab === '{{ $tab['id'] }}' ? 0 : -1"
                                aria-controls="tab-panel-{{ $tab['id'] }}"
                                @click="activeTab = '{{ $tab['id'] }}'"
                            >
                                <span class="trvbk-tab-btn__indicator" aria-hidden="true">
                                    <svg viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <path d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z" />
                                    </svg>
                                </span>
                                <h3>{{ $tab['label'] }}</h3>
                                <span class="trvbk-tab-btn__arrow" aria-hidden="true"></span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Tab Content Panels --}}
                    <div class="trvbk-tabs-content">
                        @foreach ($serviceTabs as $tab)
                            <div
                                class="trvbk-tab-panel"
                                id="tab-panel-{{ $tab['id'] }}"
                                role="tabpanel"
                                aria-labelledby="tab-btn-{{ $tab['id'] }}"
                                x-show="activeTab === '{{ $tab['id'] }}'"
                                x-cloak
                            >
                                <div class="trvbk-tab-card">
                                    <div class="trvbk-tab-card__media">
                                        <img
                                            src="{{ $img($tab['image']) }}"
                                            alt="{{ $tab['image_alt'] }}"
                                            width="778"
                                            height="618"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>

                                    <div class="trvbk-tab-card__copy">
                                        @if (!empty($tab['lead']))
                                            <p class="trvbk-tab-card__lead">
                                                <strong>{{ $tab['lead'] }}</strong>
                                            </p>
                                        @endif

                                        <ul class="trvbk-tab-card__list">
                                            @foreach ($tab['features'] as $feature)
                                                <li>
                                                    <strong>{{ $feature['title'] }}:</strong> {{ $feature['text'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="trvbk-tab-cta">
                                    <a
                                        href="#"
                                        id="popup-form-button"
                                        class="trvbk-btn trvbk-btn--tab-cta"
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

        {{-- CTA Banner 1 --}}
        <section class="trvbk-cta-bar" aria-label="Consultation Banner">
            <div class="site-shell trvbk-cta-bar__inner">
                <p class="trvbk-cta-bar__text">
                    Discover How Our Travel Bookkeeping Services Can Simplify Your Processes, Enhance Customer Experience, and Increase Revenue!
                </p>
                <a
                    href="#"
                    class="trvbk-btn trvbk-btn--green trvbk-cta-bar__btn"
                    data-contact-modal-trigger
                >
                    Schedule a Free Consultation Now
                </a>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="trvbk-software" aria-labelledby="trvbk-software-title">
            <div class="site-shell trvbk-software__inner">
                <div class="trvbk-software__copy">
                    <h2 id="trvbk-software-title" class="trvbk-software__title">
                        Software <span class="trvbk-highlight">Expertise</span>
                    </h2>
                    <p class="trvbk-software__text">
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>

                <div class="trvbk-software__media">
                    <img
                        src="{{ $img('software-logo.webp') }}"
                        alt="Software Expertise provided by IBN technologies"
                        title="xero expertise"
                        width="800"
                        height="450"
                        loading="lazy"
                        decoding="async"
                        class="trvbk-software__img"
                    >
                </div>
            </div>
        </section>

        {{-- Why Travel Companies Outsource Bookkeeping --}}
        <section class="trvbk-why-outsource" aria-labelledby="trvbk-why-title">
            <div class="site-shell trvbk-why-outsource__inner">
                <div class="trvbk-why-outsource__col-left">
                    <h2 id="trvbk-why-title" class="trvbk-why-outsource__title">
                        Why Travel Companies Outsource Bookkeeping
                    </h2>
                    <div class="trvbk-why-outsource__media">
                        <img
                            src="{{ $img('why-travel-companies-ourtsourcing.webp') }}"
                            alt="why travel companies ourtsourcing"
                            width="1090"
                            height="1090"
                            loading="lazy"
                            decoding="async"
                            class="trvbk-why-outsource__img"
                        >
                    </div>
                    <div class="trvbk-why-outsource__action">
                        <a
                            href="#"
                            class="trvbk-btn trvbk-btn--green"
                            data-contact-modal-trigger
                        >
                            Get Started Now
                        </a>
                    </div>
                </div>

                <div class="trvbk-why-outsource__col-right">
                    <div class="trvbk-why-grid">
                        @foreach ($whyOutsourceItems as $item)
                            <div class="trvbk-why-card">
                                <figure class="trvbk-why-card__icon">
                                    <img
                                        src="{{ $img($item['icon']) }}"
                                        alt="{{ $item['title'] }}"
                                        width="65"
                                        height="65"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </figure>
                                <h3 class="trvbk-why-card__title">{{ $item['title'] }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Key Industry Segments --}}
        <section class="trvbk-segments" aria-labelledby="trvbk-segments-title">
            <div class="site-shell">
                <div class="trvbk-heading trvbk-heading--center">
                    <h2 id="trvbk-segments-title" class="trvbk-heading__title">
                        Explore Our Travel Outsourcing Services for Key Industry Segments
                    </h2>
                </div>

                <div class="trvbk-segments-grid">
                    @foreach ($industrySegments as $segment)
                        <div class="trvbk-segment-card">
                            <figure class="trvbk-segment-card__icon">
                                <img
                                    src="{{ $img($segment['icon']) }}"
                                    alt="{{ $segment['title'] }}"
                                    width="75"
                                    height="75"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3 class="trvbk-segment-card__title">
                                <a href="{{ route('page.show', ['slug' => $segment['slug']]) }}">
                                    {{ $segment['title'] }}
                                </a>
                            </h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Success Indicators --}}
        <section class="trvbk-stats" aria-labelledby="trvbk-stats-title">
            <div class="site-shell">
                <div class="trvbk-heading trvbk-heading--center">
                    <h2 id="trvbk-stats-title" class="trvbk-heading__title">
                        Success Indicators
                    </h2>
                </div>

                <div class="trvbk-stats-grid">
                    @foreach ($stats as $stat)
                        <div class="trvbk-stat-card">
                            <span class="trvbk-stat-card__val">{{ $stat['value'] }}</span>
                            <h3 class="trvbk-stat-card__lbl">{{ $stat['label'] }}</h3>
                        </div>
                    @endforeach
                </div>

                <div class="trvbk-stats__action">
                    <a
                        href="#"
                        class="trvbk-btn trvbk-btn--green"
                        data-contact-modal-trigger
                    >
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- CTA Banner 2 --}}
        <section class="trvbk-cta-bar" aria-label="Consultation Banner">
            <div class="site-shell trvbk-cta-bar__inner">
                <p class="trvbk-cta-bar__text">
                    Discover How Our Travel Bookkeeping Services Can Simplify Your Processes, Enhance Customer Experience, and Increase Revenue!
                </p>
                <a
                    href="#"
                    class="trvbk-btn trvbk-btn--green trvbk-cta-bar__btn"
                    data-contact-modal-trigger
                >
                    Schedule a Free Consultation Now
                </a>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="trvbk-testimonials" aria-labelledby="trvbk-testimonials-title">
            <div class="site-shell">
                <div class="trvbk-heading trvbk-heading--center">
                    <p class="trvbk-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="trvbk-testimonials-title" class="trvbk-testimonials__title">
                        HERE IS WHAT THEY ARE SAYING
                    </h2>
                </div>

                <div
                    class="trvbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="trvbk-testimonials__nav trvbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="trvbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="trvbk-testimonial"
                                :class="{ 'is-active': index === {{ $i }} }"
                                :aria-hidden="index !== {{ $i }}"
                                x-show="index === {{ $i }}"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-x-4"
                                x-transition:enter-end="opacity-100 transform translate-x-0"
                            >
                                <p class="trvbk-testimonial__quote">{!! nl2br(e($item['quote'])) !!}</p>
                                <cite class="trvbk-testimonial__cite">{{ $item['cite'] }}</cite>
                            </blockquote>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        class="trvbk-testimonials__nav trvbk-testimonials__nav--next"
                        @click="next()"
                        aria-label="Next testimonial"
                    >
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="trvbk-testimonials__action">
                    <a
                        href="{{ route('page.show', ['slug' => 'testimonials']) }}"
                        class="trvbk-btn-text"
                    >
                        EXPLORE MORE TESTIMONIALS
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
