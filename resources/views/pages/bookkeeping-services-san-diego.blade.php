@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-san-diego/'.$file);

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
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-services-san-diego.css'])
@endpush

@section('content')
    <div class="bksd-page">
        {{-- Hero --}}
        <section class="bksd-hero" aria-labelledby="bksd-hero-title">
            <div class="site-shell bksd-hero__inner">
                <div class="bksd-hero__copy">
                    <h1 id="bksd-hero-title">BOOKKEEPING SERVICES IN SAN DIEGO</h1>
                    <p class="bksd-hero__tagline">RESHAPE YOUR BOOKS FOR SUCCESS IN SAN DIEGO</p>
                    <p class="bksd-hero__lede">
                        Streamlining financial responsibilities in SAN DIEGO: Let us help you master the full scope of your business accounting needs.
                    </p>
                </div>

                <aside class="bksd-hero__form" id="contact-us" aria-labelledby="bksd-hero-form-title">
                    <h2 id="bksd-hero-form-title">Want to Improve Your Accounting ?</h2>
                    <p class="bksd-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-san-diego"
                        id-prefix="bksd"
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
        <section class="bksd-intro" aria-labelledby="bksd-intro-title">
            <div class="site-shell">
                <div class="bksd-intro__card">
                    <h2 id="bksd-intro-title">
                        Expert Accounting and Bookkeeping Services for SAN DIEGO Businesses
                    </h2>
                    <p>
                        <strong>IBN Technologies</strong> specializes in managing the complexities of SAN DIEGO business finances, including local taxes and regulations. We provide expert bookkeeping with advanced software and extensive knowledge of Illinois and SAN DIEGO tax laws. Our services include real-time financial insights, enhanced compliance, fully outsourced solutions, support during busy periods, and expertise in complex accounting matters such as IFRS.
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services tabs --}}
        <section class="bksd-section" aria-labelledby="bksd-services-title">
            <div class="site-shell">
                <div class="bksd-heading bksd-heading--center">
                    <h2 id="bksd-services-title">Outsourced Bookkeeping Services in SAN DIEGO</h2>
                </div>

                <div
                    class="bksd-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bksd-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bksd-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bksd-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bksd-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="bksd-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bksd-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bksd-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bksd-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bksd-tabs__media">
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
                                        class="bksd-btn bksd-btn--navy bksd-tabs__cta"
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
        <section class="bksd-narrative" aria-label="Reliable bookkeeping services in San Diego">
            <div class="bksd-narrative__media" aria-hidden="true">
                <img
                    src="{{ $img('narrative-office.jpg') }}"
                    alt=""
                    width="900"
                    height="600"
                    loading="lazy"
                    decoding="async"
                >
            </div>
            <div class="bksd-narrative__copy">
                <p>
                    If you're looking for reliable bookkeeping services in San Diego, look no further than IBN. Our team of knowledgeable professionals delivers fast and accurate accounting, bookkeeping, and payroll services.
                </p>
                <p>
                    Utilizing a combination of cutting-edge technology, expert skills, and our dedication to customer service, we provide customized solutions for business and individual needs. We specialize in recording financial transactions, reconciling bank account statements, analyzing financial data, and providing crucial advice as it pertains to financial management. Whether you're a small business just starting out or an established firm, we have the experience to handle all of your financial needs.
                </p>
                <p>
                    Our strategic approach to streamlining accounting processes will help ensure that everything is done correctly and efficiently. Plus, with our commitment to keeping up with the latest software tools and best practices, you can be sure you're getting top-notch service that meets the highest standards. So contact us today to learn more about how IBN can help bring clarity and order to your finances!
                </p>
                <a href="#" class="bksd-btn bksd-btn--green" data-contact-modal-trigger>
                    Get Started Now
                </a>
            </div>
        </section>

        {{-- Why San Diego businesses choose us --}}
        <section class="bksd-section" aria-labelledby="bksd-why-choose-title">
            <div class="site-shell">
                <div class="bksd-heading bksd-heading--center">
                    <h2 id="bksd-why-choose-title">
                        Why SAN DIEGO Businesses Choose Us for Expert Bookkeeping Solutions
                    </h2>
                </div>

                <div class="bksd-solutions" role="list">
                    @foreach ($whySolutions as $card)
                        <article class="bksd-solution bksd-solution--{{ $card['tone'] }}" role="listitem">
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

                <div class="bksd-section__cta">
                    <a href="#" class="bksd-btn bksd-btn--green" data-contact-modal-trigger>
                        Schedule a Bookkeeping strategy session
                    </a>
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bksd-software" aria-labelledby="bksd-software-title">
            <div class="site-shell bksd-software__inner">
                <div class="bksd-software__copy">
                    <h2 id="bksd-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bksd-software__media">
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
        <section class="bksd-section" aria-labelledby="bksd-why-title">
            <div class="site-shell">
                <div class="bksd-heading bksd-heading--center">
                    <h2 id="bksd-why-title">
                        Why IBN Tech is the Leading <span class="bksd-accent">Bookkeeping</span> Outsourcing Provider in the SAN DIEGO
                    </h2>
                </div>

                <div class="bksd-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bksd-stat" role="listitem">
                            <p class="bksd-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bksd-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bksd-section__cta">
                    <a href="#" class="bksd-btn bksd-btn--green" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- What You Get --}}
        <section class="bksd-what" aria-labelledby="bksd-what-title">
            <div class="site-shell bksd-what__inner">
                <div class="bksd-what__copy">
                    <h2 id="bksd-what-title">
                        What You Get with Our <span class="bksd-accent">Bookkeeping</span> Services in SAN DIEGO
                    </h2>

                    <div class="bksd-what__lists">
                        @foreach ($whatYouGet as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="bksd-what__check" aria-hidden="true">
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

                <div class="bksd-what__media">
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
        <section class="bksd-section" aria-labelledby="bksd-industries-title">
            <div class="site-shell">
                <div class="bksd-heading bksd-heading--center">
                    <h2 id="bksd-industries-title">Industries We Serve</h2>
                </div>

                <div class="bksd-industries" role="list">
                    @foreach ($industries as $industry)
                        @if ($industry['slug'])
                            <a
                                href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                                class="bksd-industry bksd-industry--link"
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
                            <article class="bksd-industry" role="listitem">
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
        <section class="bksd-trial" aria-labelledby="bksd-trial-title">
            <div class="site-shell bksd-trial__inner">
                <p id="bksd-trial-title">
                    Discover how you can reduce costs with our services. Begin with a FREE trial—no obligations !
                </p>
                <a href="{{ route('page.show', ['slug' => 'free-trial']) }}" class="bksd-btn bksd-btn--green">
                    Get Free Trial
                </a>
            </div>
        </section>
    </div>
@endsection
