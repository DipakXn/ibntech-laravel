@php
    $img = fn (string $file): string => asset('images/bookeeping-for-uk/'.$file);

    $serviceTabs = [
        [
            'title' => 'Finance and Accounting Services',
            'heading' => 'Finance and Accounting Services',
            'text' => 'Manage your financial health with automated accounting solutions by outsourcing your needs to India. Benefit from digital tools for streamlined financial statements, budgeting, forecasting, and tax preparation',
            'columns' => [
                [
                    'Automated Financial Statement Preparation',
                    'Digital Monthly, Quarterly & Annual Reports',
                    'Automated Financial Assessment Reports',
                ],
                [
                    'Digital Budgeting & Forecasting Tools',
                    'General Ledger Review with Automation',
                    'Online Bill Paying Services',
                ],
            ],
        ],
        [
            'title' => 'Bookkeeping Services',
            'heading' => 'Outsourced Bookkeeping Services',
            'text' => 'Simplify your financial life by utilizing bookkeeping services outsourcing. Our expert team will handle your accounting needs, from data entry to financial reporting, ensuring accuracy and efficiency',
            'groups' => [
                [
                    'title' => 'Transaction Processing',
                    'items' => [
                        'Accurate Data Entry',
                        'Invoice Management',
                        'Payroll Made Easy',
                        'Bank & Credit Card Tracking',
                    ],
                ],
                [
                    'title' => 'Management Activities',
                    'items' => [
                        'Automated Data Entry',
                        'Continuous Invoice Processing',
                        'Streamlined Payroll Transactions',
                    ],
                ],
                [
                    'title' => 'Reconciliation Reporting',
                    'items' => [
                        'Match & Verify',
                        'Continuous Invoice Processing',
                        'Track Receivables & Payables',
                    ],
                ],
            ],
        ],
        [
            'title' => 'Payroll Processing',
            'heading' => 'Payroll Processing',
            'text' => 'Ensure accurate and timely payroll through automated solutions. We handle compliance, reporting, and benefits management, reducing manual tasks and keeping your payroll operations smooth and hassle-free',
            'columns' => [
                [
                    'Automated Payroll Calculation and Processing',
                    'Benefits and Deductions Management',
                    'Automatically generate payroll sheets',
                ],
                [
                    'Minimal manual intervention',
                    'Automate state and federal reports generation and filing',
                ],
            ],
        ],
        [
            'title' => 'Tax Preparation Support',
            'heading' => 'Tax Preparation Support',
            'text' => 'Stay compliant and ready with our digital tax support services. We streamline tax documentation, review and preparation of tax forms, and collaborate with tax advisors to maximize the efficiency of your tax strategy',
            'columns' => [
                [
                    'Tax Documentation Degitization',
                    'Tax Review',
                    'Tax Preparation of Forms',
                ],
                [
                    'Tax planning and strategy',
                    'Liaison with tax advisors',
                ],
            ],
        ],
        [
            'title' => 'Intelligent Process Automation',
            'heading' => 'Intelligent Process Automation',
            'text' => 'Ensure timely payments and collections with our AI-driven invoice processing and vendor management services. Our system automates invoicing, optimizes follow-ups, and provides clear aging reports, enhancing your financial efficiency and accuracy',
            'columns' => [
                [
                    'Digital Aging Reports',
                    'Collections And Follow-Ups',
                ],
                [
                    'Customer Invoicing',
                    'Automatic Invoice Processing and Payment',
                ],
            ],
        ],
        [
            'title' => 'Financial Reporting',
            'heading' => 'Financial Reporting',
            'text' => 'Gain a transparent view of your business’s financial health with our automated reporting services. We deliver detailed income statements, balance sheets, and customized reports, empowering you to make informed decisions effortlessly',
            'columns' => [
                [
                    'Cash Flow Statement',
                    'Balance Sheet',
                    'Key Performance Indicators (KPIs) Analysis',
                ],
                [
                    'Income Statement',
                    'Custom Financial Reports',
                    'Custom Financial Reports',
                ],
            ],
        ],
        [
            'title' => 'Year-End Accounting',
            'heading' => 'Year-End Accounting',
            'text' => 'A full range of year-end accounting services to ensure smooth closing and on-time filing of returns',
            'columns' => [
                [
                    'Bookkeeping',
                    'Transaction Management',
                ],
                [
                    'Financial Reporting',
                    'Tax Preparation Support',
                ],
            ],
        ],
        [
            'title' => 'Controller Services',
            'heading' => 'Controller Services',
            'text' => 'Enhance your strategic decision-making with our automated financial management solutions. Our services include:',
            'columns' => [
                [
                    'Fixed Asset Management',
                    'Cash Flow Preparation & Forecasting',
                    'Yearly Budget Preparation & periodical analysis',
                ],
                [
                    'Costing, MIS Reports Preparation',
                    'Preparation of financial statements',
                ],
            ],
        ],
    ];

    $signColumns = [
        [
            'In-house team overwhelmed by transactions',
            'High costs of maintaining an in-house team',
            'Lack of specialized financial expertise',
            'Global business needing 24/7 support',
        ],
        [
            'Need to focus on core activities',
            'Errors in financial reports',
            'Complex, changing tax laws',
            'Outdated bookkeeping methods',
            'Growth straining accounting processes',
        ],
    ];

    $whyOutsource = [
        [
            'num' => '01',
            'color' => '#ff9900',
            'title' => 'Cost Efficiency',
            'text' => 'Save up to 50% by paying only for what you need',
        ],
        [
            'num' => '05',
            'color' => '#b117df',
            'title' => 'Quick Turnaround',
            'text' => '24x5 global delivery for fast, responsive service',
        ],
        [
            'num' => '02',
            'color' => '#ff3333',
            'title' => 'Custom Reports',
            'text' => 'Get tailored financial insights for smarter decisions',
        ],
        [
            'num' => '06',
            'color' => '#f10ab8',
            'title' => 'Data Security',
            'text' => 'CERT certified, ensuring strict data protection',
        ],
        [
            'num' => '03',
            'color' => '#009999',
            'title' => 'Compliance',
            'text' => 'Adhere to GAAP, UK standards, and ISO-certified processes',
        ],
        [
            'num' => '07',
            'color' => '#27dd9b',
            'title' => 'Scalability',
            'text' => 'Flexible services tailored to your business needs',
        ],
        [
            'num' => '04',
            'color' => '#1cbf36',
            'title' => 'ROI',
            'text' => 'Boost efficiency and focus on core business for greater financial gains',
        ],
        [
            'num' => '08',
            'color' => '#2a5712',
            'title' => 'Risk Mitigation',
            'text' => 'Stay compliant and avoid penalties with expert guidance',
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
            'label' => 'Hospitality',
            'file' => 'hospitality.webp',
            'alt' => 'hospitality',
            'slug' => 'hospitality-bookkeeping-and-accounting-services',
        ],
        [
            'label' => 'Retail',
            'file' => 'retail.webp',
            'alt' => 'retail',
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
            'alt' => 'healthcare',
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
            'slug' => 'supply-chain-management-manufacturing',
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
            'alt' => 'Marketing',
            'slug' => 'marketing-and-advertising-bookkeeping-services',
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
    @vite(['resources/css/pages/bookeeping-for-uk.css'])
@endpush

@section('content')
    <div class="bkuk-page">
        {{-- Hero --}}
        <section class="bkuk-hero" aria-labelledby="bkuk-hero-title">
            <div class="site-shell bkuk-hero__inner">
                <div class="bkuk-hero__copy">
                    <h1 id="bkuk-hero-title">
                        Experience Seamless Outsourced Bookkeeping in the United Kingdom
                    </h1>
                    <p class="bkuk-hero__lede">
                        Cut operational costs by up to 50% while ensuring tax-efficient, accurate, and efficient management of your financial records
                    </p>
                </div>

                <aside class="bkuk-hero__form" id="contact-us" aria-labelledby="bkuk-hero-form-title">
                    <h2 id="bkuk-hero-form-title">Want to Improve Your Accounting?</h2>
                    <p class="bkuk-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="bookeeping-for-uk"
                        id-prefix="bkuk"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we best support your bookkeeping needs?"
                        submit-label="BOOK A FREE CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="bkuk-intro" aria-labelledby="bkuk-intro-title">
            <div class="site-shell">
                <div class="bkuk-intro__card">
                    <h2 id="bkuk-intro-title">
                        Expert Bookkeeping in the UK - Your Future-Ready Financial Partner!
                    </h2>
                    <p>
                        IBN offers top-tier outsourced bookkeeping and accounting services across the UK. With over 26+ years of experience, we provide businesses of all sizes with confidential, cloud-based solutions that comply with UK legal and tax standards. Our services optimize operations, boost efficiency, and ensure accuracy. We proactively safeguard your business against future accounting challenges
                    </p>
                </div>
            </div>
        </section>

        {{-- Outsourced services accordion tabs --}}
        <section class="bkuk-section" aria-labelledby="bkuk-services-title">
            <div class="site-shell">
                <div class="bkuk-heading">
                    <h2 id="bkuk-services-title">Outsourced Bookkeeping Services in UK</h2>
                </div>

                <div
                    class="bkuk-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bkuk-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bkuk-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bkuk-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bkuk-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                                <i class="fa-solid fa-chevron-down bkuk-tabs__chevron" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>

                    <div class="bkuk-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            <div
                                class="bkuk-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bkuk-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bkuk-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bkuk-tabs__content">
                                    <h3>{{ $tab['heading'] }}</h3>
                                    <p>{{ $tab['text'] }}</p>

                                    @if (! empty($tab['groups']))
                                        <div class="bkuk-tabs__groups">
                                            @foreach ($tab['groups'] as $group)
                                                <div class="bkuk-tabs__group">
                                                    <h4>{{ $group['title'] }}</h4>
                                                    <ul>
                                                        @foreach ($group['items'] as $item)
                                                            <li>
                                                                <span class="bkuk-check" aria-hidden="true">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                                <span>{{ $item }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="bkuk-tabs__lists">
                                            @foreach ($tab['columns'] as $column)
                                                <ul>
                                                    @foreach ($column as $item)
                                                        <li>
                                                            <span class="bkuk-check" aria-hidden="true">
                                                                <i class="fa-solid fa-check"></i>
                                                            </span>
                                                            <span>{{ $item }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif

                                    <a
                                        href="#"
                                        class="bkuk-btn bkuk-btn--navy bkuk-tabs__cta"
                                        data-contact-modal-trigger
                                    >
                                        SCHEDULE A CALL WITH OUR ACCOUNTING EXPERT NOW
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Signs You Need Offshore Bookkeeping --}}
        <section class="bkuk-signs" aria-labelledby="bkuk-signs-title">
            <div class="site-shell">
                <h2 id="bkuk-signs-title" class="bkuk-signs__title">Signs You Need Offshore Bookkeeping</h2>
                <div class="bkuk-signs__inner">
                    <div class="bkuk-signs__copy">
                        <div class="bkuk-signs__lists">
                            @foreach ($signColumns as $column)
                                <ul>
                                    @foreach ($column as $item)
                                        <li>
                                            <span class="bkuk-signs__check" aria-hidden="true">
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
                    <div class="bkuk-signs__media">
                        <img
                            src="{{ $img('signs-you-need-offshore-bookkeeping.webp') }}"
                            alt="Signs You Need Offshore Bookkeeping"
                            width="650"
                            height="650"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Why Outsource --}}
        <section class="bkuk-section" aria-labelledby="bkuk-why-outsource-title">
            <div class="site-shell">
                <div class="bkuk-heading bkuk-heading--center">
                    <h2 id="bkuk-why-outsource-title">
                        Why Outsource Your <span class="bkuk-accent">Bookkeeping</span> to us?
                    </h2>
                </div>

                <div class="bkuk-benefits" role="list">
                    @foreach ($whyOutsource as $item)
                        <article class="bkuk-benefit" role="listitem">
                            <div
                                class="bkuk-benefit__num"
                                style="--bkuk-num-bg: {{ $item['color'] }}"
                                aria-hidden="true"
                            >
                                {{ $item['num'] }}
                            </div>
                            <div class="bkuk-benefit__body">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="bkuk-section__cta">
                    <a href="#" class="bkuk-btn bkuk-btn--green" data-contact-modal-trigger>
                        Get Started Now
                    </a>
                </div>
            </div>
        </section>

        {{-- Stats --}}
        <section class="bkuk-section bkuk-section--soft" aria-labelledby="bkuk-why-title">
            <div class="site-shell">
                <div class="bkuk-heading bkuk-heading--center">
                    <h2 id="bkuk-why-title">
                        Why We're the Top Bookkeeping Choice Among UK Outsourcing Companies
                    </h2>
                </div>

                <div class="bkuk-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bkuk-stat" role="listitem">
                            <p class="bkuk-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bkuk-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bkuk-section__cta">
                    <a href="#" class="bkuk-btn bkuk-btn--green" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- HMRC CTA band --}}
        <section class="bkuk-band" aria-labelledby="bkuk-band-title">
            <div class="site-shell bkuk-band__inner">
                <div class="bkuk-band__copy">
                    <h2 id="bkuk-band-title">Ensure HMRC VAT &amp; CIS Compliance with Confidence!</h2>
                    <p>
                        Leverage our expertise in HMRC VAT regulations and CIS compliance to streamline your submissions and maximize benefits. With proven success across diverse industries, we provide timely, accurate guidance for business optimization.
                    </p>
                    <p>Get started now with your free month of bookkeeping services!</p>
                </div>
                <a href="#" class="bkuk-btn bkuk-btn--green bkuk-btn--lg" data-contact-modal-trigger>
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- How We Work --}}
        <section class="bkuk-section" aria-labelledby="bkuk-work-title">
            <div class="site-shell">
                <div class="bkuk-heading bkuk-heading--center">
                    <h2 id="bkuk-work-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>
                <div class="bkuk-work__media">
                    <img
                        src="{{ $img('how-we-work.webp') }}"
                        alt="How We Work"
                        width="950"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkuk-software" aria-labelledby="bkuk-software-title">
            <div class="site-shell bkuk-software__inner">
                <div class="bkuk-software__copy">
                    <h2 id="bkuk-software-title">
                        Software <span>Expertise</span>
                    </h2>
                    <p>
                        Our expert solutions ensure smooth data flow and enhanced efficiency across your accounting and financial systems. Boost performance and optimize processes with our seamless integration services.
                    </p>
                </div>
                <div class="bkuk-software__media">
                    <img
                        src="{{ $img('software-expertise.webp') }}"
                        alt="Software expertise"
                        width="800"
                        height="677"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="bkuk-industries-section" aria-labelledby="bkuk-industries-title">
            <div class="site-shell bkuk-industries-section__inner">
                <div class="bkuk-industries-section__copy">
                    <h2 id="bkuk-industries-title">Industries We Specialize In</h2>
                    <p>
                        Every industry has its own unique needs. Our tailored, industry-specific solutions are designed to help you operate efficiently.
                    </p>
                    <p>
                        Don’t see your industry listed? That’s because you’re one of a kind, and we’re here to meet your unique needs.
                    </p>
                    <a
                        href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                        class="bkuk-btn bkuk-btn--green"
                        id="book-button"
                    >
                        Explore More About Industry
                    </a>
                </div>

                <div class="bkuk-industries" role="list">
                    @foreach ($industries as $industry)
                        <a
                            href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                            class="bkuk-industry"
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
        <section class="bkuk-testimonials" aria-labelledby="bkuk-testimonials-title">
            <div class="site-shell">
                <div class="bkuk-heading bkuk-heading--center">
                    <p class="bkuk-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bkuk-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bkuk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bkuk-testimonials__nav bkuk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkuk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bkuk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bkuk-testimonials__nav bkuk-testimonials__nav--next"
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
