@php
    $img = fn (string $file): string => asset('images/bookkeeping-services-usa/'.$file);

    $heroChecks = [
        'Save up to 70% on operational bookkeeping costs',
        '99% Data Security & Accuracy - with Expert Insights',
        'Actionable strategies - Time & cost-saving',
    ];

    $trustBadges = [
        ['icon' => 'fa-check', 'label' => 'USA GAAP Standards'],
        ['icon' => 'fa-lock', 'label' => 'ISO 27001 Secure'],
        ['icon' => 'fa-globe', 'label' => '24/7 Support'],
    ];

    $pillars = [
        [
            'icon' => 'fa-cogs',
            'title' => 'Customized Offshoring',
            'text' => 'Built for business needs',
        ],
        [
            'icon' => 'fa-sync',
            'title' => 'Streamlined Processes',
            'text' => 'Policy-driven delivery',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Client-Centric Focus',
            'text' => 'Your success is our goal',
        ],
        [
            'icon' => 'fa-headset',
            'title' => 'Consulting-Led Service',
            'text' => 'Expert guidance always',
        ],
    ];

    $serviceTabs = [
        [
            'title' => 'Finance and Accounting Services',
            'text' => 'Manage your financial health with automated accounting solutions by outsourcing your needs to India. Benefit from digital tools for streamlined financial statements, budgeting, forecasting, and tax preparation',
            'items' => [
                'Fixed Asset Management',
                'Cash Flow Preparation & Forecasting',
                'Yearly Budget Preparation & periodical analysis',
                'Costing, MIS Reports Preparation',
                'Preparation of financial statements',
            ],
        ],
        [
            'title' => 'Bookkeeping Services',
            'text' => 'Simplify your financial life by utilizing bookkeeping services outsourcing. Our expert team will handle your accounting needs, from data entry to financial reporting, ensuring accuracy and efficiency',
            'items' => [
                'Accurate Financial Recording',
                'Billing and Invoice Handling',
                'Account Reconciliation',
                'Payroll Processing',
                'Payable and Receivable Management',
            ],
        ],
        [
            'title' => 'Payroll Processing',
            'text' => 'Ensure accurate and timely payroll through automated solutions. We handle compliance, reporting, and benefits management, reducing manual tasks and keeping your payroll operations smooth and hassle-free',
            'items' => [
                'Automated Payroll Calculation and Processing',
                'Benefits and Deductions Management',
                'Automatically generate payroll sheets',
                'Minimal manual intervention',
                'Automate state and federal reports generation and filing',
            ],
        ],
        [
            'title' => 'Tax Preparation Support',
            'text' => 'Stay compliant and ready with our digital tax support services. We streamline tax documentation, review and preparation of tax forms, and collaborate with tax advisors to maximize the efficiency of your tax strategy',
            'items' => [
                'Tax Documentation Degitization',
                'Tax Review',
                'Tax Preparation of Forms',
                'Tax planning and strategy',
                'Liaison with tax advisors',
            ],
        ],
        [
            'title' => 'Intelligent Process Automation',
            'text' => 'Ensure timely payments and collections with our AI-driven invoice processing and vendor management services. Our system automates invoicing, optimizes follow-ups, and provides clear aging reports, enhancing your financial efficiency and accuracy',
            'items' => [
                'Digital Aging Reports',
                'Collections And Follow-Ups',
                'Customer Invoicing',
                'Automatic Invoice Processing and Payment',
            ],
        ],
        [
            'title' => 'Financial Reporting',
            'text' => 'Gain a transparent view of your business\'s financial health with our automated reporting services. We deliver detailed income statements, balance sheets, and customized reports, empowering you to make informed decisions effortlessly',
            'items' => [
                'Cash Flow Statement',
                'Balance Sheet',
                'Key Performance Indicators (KPIs) Analysis',
                'Income Statement',
                'Custom Financial Reports',
            ],
        ],
        [
            'title' => 'Year-End Accounting',
            'text' => 'A full range of year-end accounting services to ensure smooth closing and on-time filing of returns',
            'items' => [
                'Bookkeeping',
                'Transaction Management',
                'Financial Reporting',
                'Tax Preparation Support',
            ],
        ],
        [
            'title' => 'Controller Services',
            'text' => 'Enhance your strategic decision-making with our automated financial management solutions. Our services include:',
            'items' => [
                'Fixed Asset Management',
                'Cash Flow Preparation & Forecasting',
                'Yearly Budget Preparation & periodical analysis',
                'Costing, MIS Reports Preparation',
                'Preparation of financial statements',
            ],
        ],
    ];

    $signs = [
        ['icon' => 'fa-exchange-alt', 'label' => 'In-house team overwhelmed by transactions'],
        ['icon' => 'fa-money-bill-wave', 'label' => 'High costs of maintaining an in-house team'],
        ['icon' => 'fa-lightbulb', 'label' => 'Lack of specialized financial expertise'],
        ['icon' => 'fa-globe-americas', 'label' => 'Global business needing 24/7 support'],
        ['icon' => 'fa-bullseye', 'label' => 'Need to focus on core activities'],
        ['icon' => 'fa-exclamation-triangle', 'label' => 'Errors in financial reports'],
        ['icon' => 'fa-balance-scale', 'label' => 'Complex, changing tax laws'],
        ['icon' => 'fa-archive', 'label' => 'Outdated bookkeeping methods'],
        ['icon' => 'fa-chart-line', 'label' => 'Growth straining accounting processes'],
    ];

    $benefits = [
        [
            'num' => '01',
            'color' => '#ff9900',
            'title' => 'Value-Driven Approach',
            'text' => 'We aim to provide services that go beyond affordability, ensuring the value you receive justifies your investment',
        ],
        [
            'num' => '02',
            'color' => '#ff3333',
            'title' => 'USA Expertise',
            'text' => 'Tailored services for USA\'s diverse business landscape',
        ],
        [
            'num' => '03',
            'color' => '#009999',
            'title' => 'Best Accounting Tools',
            'text' => 'Our professionals work with your preferred accounting software or recommend the best tools to meet your needs',
        ],
        [
            'num' => '04',
            'color' => '#1cbf36',
            'title' => 'Minimal Input Required',
            'text' => 'With our qualified team, you can stay hands-off, while we handle all aspects of your bookkeeping seamlessly',
        ],
        [
            'num' => '05',
            'color' => '#b117df',
            'title' => 'Ready to Scale',
            'text' => 'Our operational efficiency allows you to scale your bookkeeping needs quickly as your business grows',
        ],
        [
            'num' => '06',
            'color' => '#f10ab8',
            'title' => 'Data Security',
            'text' => 'We prioritize your data security, utilizing advanced technology and adhering to ISO 27001 certification standards to protect all sensitive information',
        ],
    ];

    $stats = [
        ['value' => '30+', 'label' => 'Industry Served'],
        ['value' => '26+', 'label' => 'Years of Experience'],
        ['value' => '1400+', 'label' => 'Active Global Clients'],
        ['value' => '50%', 'label' => 'Save operational cost'],
        ['value' => '95%', 'label' => 'Client Retention Rate'],
        ['value' => '98%', 'label' => 'Accuracy in Deliverables'],
        ['value' => '21+', 'label' => 'Accounting Software Expertise'],
        ['value' => '100+', 'label' => 'Qualified & Certified Bookkeepers'],
        ['value' => '10+', 'label' => 'Client-centric Account Managers'],
    ];

    $automation = [
        [
            'file' => 'innovation-at-the-core.webp',
            'alt' => 'Innovation at the Core',
            'title' => 'Innovation at the Core',
            'text' => 'IBN Tech continually updates its processes with the latest automation tools and AI technologies.',
        ],
        [
            'file' => 'efficiency-accuracy.webp',
            'alt' => 'Efficiency and Accuracy',
            'title' => 'Efficiency & Accuracy',
            'text' => 'Bookkeeping Automation reduces errors and speeds up processes.',
        ],
        [
            'file' => 'custom-solutions.webp',
            'alt' => 'Custom Solutions',
            'title' => 'Custom Solutions',
            'text' => 'IBN Tech\'s AI-driven solutions are tailored to your specific business needs, ensuring optimal results.',
        ],
    ];

    $industries = [
        [
            'label' => 'Real Estate and Construction',
            'file' => 'hook.webp',
            'alt' => 'Real Estate and Construction',
            'slug' => 'real-estate-construction-bookkeeping-services',
        ],
        [
            'label' => 'Travel and Hospitality',
            'file' => 'pin.webp',
            'alt' => 'Travel and Hospitality',
            'slug' => 'hospitality-bookkeeping-and-accounting-services',
        ],
        [
            'label' => 'E-commerce and Retail',
            'file' => 'market.webp',
            'alt' => 'E-commerce and Retail',
            'slug' => 'ecommerce-bookkeeping-services',
        ],
        [
            'label' => 'Legal Firm',
            'file' => 'balance-sheet.webp',
            'alt' => 'Legal Firm',
            'slug' => 'legal-bookkeeping-services',
        ],
        [
            'label' => 'Manufacturing',
            'file' => 'conveyor.webp',
            'alt' => 'Manufacturing',
            'slug' => 'manufacturing-accounting-and-bookkeeping-services',
        ],
        [
            'label' => 'Chemical & Energy',
            'file' => 'chemistry.webp',
            'alt' => 'Chemical and Energy',
            'slug' => 'contact-us',
        ],
        [
            'label' => 'Healthcare & Pharma',
            'file' => 'healthcare.webp',
            'alt' => 'Healthcare and Pharma',
            'slug' => 'healthcare-bookkeeping-services',
        ],
        [
            'label' => 'BFSI',
            'file' => 'report.webp',
            'alt' => 'BFSI',
            'slug' => 'finance-businesses-bookkeeping-service',
        ],
        [
            'label' => 'Logistics and Transportation',
            'file' => 'logistics-delivery.webp',
            'alt' => 'Logistics and Transportation',
            'slug' => 'transport-and-logistics',
        ],
        [
            'label' => 'ICT',
            'file' => 'telecommunications.webp',
            'alt' => 'ICT',
            'slug' => 'it-business-bookkeeping-service',
        ],
    ];

    $areas = [
        ['label' => 'California', 'slug' => 'bookkeeping-services-california'],
        ['label' => 'San Francisco', 'slug' => 'bookkeeping-services-san-francisco'],
        ['label' => 'Los Angeles', 'slug' => 'bookkeeping-services-los-angeles'],
        ['label' => 'San Diego', 'slug' => 'bookkeeping-services-san-diego'],
        ['label' => 'Las Vegas', 'slug' => 'bookkeeping-services-las-vegas'],
        ['label' => 'San Jose', 'slug' => 'bookkeeping-services-san-jose'],
        ['label' => 'Chicago', 'slug' => 'bookkeeping-services-chicago'],
        ['label' => 'New York', 'slug' => 'bookkeeping-services-new-york'],
        ['label' => 'Florida', 'slug' => 'bookkeeping-services-florida'],
        ['label' => 'Texas', 'slug' => 'bookkeeping-services-texas'],
        ['label' => 'Vermont', 'slug' => 'bookkeeping-services-vermont'],
        ['label' => 'Hartford', 'slug' => 'bookkeeping-services-hartford'],
        ['label' => 'Austin', 'slug' => 'bookkeeping-services-austin'],
        ['label' => 'Phoenix', 'slug' => 'bookkeeping-services-phoenix'],
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
    @vite(['resources/css/pages/bookkeeping-services-usa.css'])
@endpush

@section('content')
    <div class="bkusa-page">
        {{-- Hero --}}
        <section class="bkusa-hero" aria-labelledby="bkusa-hero-title">
            <div class="site-shell bkusa-hero__inner">
                <div class="bkusa-hero__copy">
                    <h1 id="bkusa-hero-title">
                        Experience Hassle-Free <span class="bkusa-accent">Outsource Bookkeeping</span> USA
                    </h1>
                    <p class="bkusa-hero__lede">
                        Transform your finance operations with expert offshore bookkeeping support - delivering high accuracy, cost efficiency, and strategic insights.
                    </p>

                    <ul class="bkusa-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <span class="bkusa-hero__check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="bkusa-hero__trust" aria-label="Trust badges">
                        @foreach ($trustBadges as $badge)
                            <li>
                                <i class="fa-solid {{ $badge['icon'] }}" aria-hidden="true"></i>
                                <span>{{ $badge['label'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="bkusa-hero__form" id="contact-us" aria-labelledby="bkusa-hero-form-title">
                    <h2 id="bkusa-hero-form-title">Start Your 20-Hour Free Trial Today</h2>

                    <livewire:forms.contact-form
                        form-name="bookkeeping-services-usa"
                        id-prefix="bkusa"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we best support your bookkeeping needs?"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-bookkeeping/"
                    />
                </aside>
            </div>
        </section>

        {{-- Precision pillars (overlapping intro card) --}}
        <section class="bkusa-intro" aria-labelledby="bkusa-pillars-title">
            <div class="site-shell">
                <div class="bkusa-intro__card">
                    <h2 id="bkusa-pillars-title">Outsource Bookkeeping for Precision in Every Transaction</h2>
                    <p>At IBN Tech, we transform your finance operations to enhance efficiency and drive growth</p>

                    <div class="bkusa-pillars" role="list">
                        @foreach ($pillars as $pillar)
                            <article class="bkusa-pillar" role="listitem">
                                <div class="bkusa-pillar__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $pillar['icon'] }}"></i>
                                </div>
                                <div class="bkusa-pillar__body">
                                    <h3>{{ $pillar['title'] }}</h3>
                                    <p>{{ $pillar['text'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Services tabs --}}
        <section class="bkusa-section bkusa-section--soft" aria-labelledby="bkusa-services-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-services-title">Outsourced Bookkeeping Services in USA</h2>
                    <p>Comprehensive financial operations management - from daily bookkeeping to strategic controller services.</p>
                </div>

                <div
                    class="bkusa-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="bkusa-tabs__nav" role="tablist" aria-label="Bookkeeping service categories">
                        @foreach ($serviceTabs as $i => $tab)
                            <button
                                type="button"
                                class="bkusa-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="bkusa-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="bkusa-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                                <i class="fa-solid fa-chevron-down bkusa-tabs__chevron" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>

                    <div class="bkusa-tabs__panels">
                        @foreach ($serviceTabs as $i => $tab)
                            @php
                                $mid = (int) ceil(count($tab['items']) / 2);
                                $columns = [
                                    array_slice($tab['items'], 0, $mid),
                                    array_slice($tab['items'], $mid),
                                ];
                            @endphp
                            <div
                                class="bkusa-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="bkusa-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="bkusa-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="bkusa-tabs__content">
                                    <h3>{{ $tab['title'] }}</h3>
                                    <p>{{ $tab['text'] }}</p>

                                    <div class="bkusa-tabs__lists">
                                        @foreach ($columns as $column)
                                            @if (count($column))
                                                <ul>
                                                    @foreach ($column as $item)
                                                        <li>
                                                            <span class="bkusa-check" aria-hidden="true">
                                                                <i class="fa-solid fa-check"></i>
                                                            </span>
                                                            <span>{{ $item }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>

                                    <a
                                        href="#"
                                        class="bkusa-btn bkusa-btn--navy bkusa-tabs__cta"
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
        <section class="bkusa-signs" aria-labelledby="bkusa-signs-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center bkusa-heading--light">
                    <h2 id="bkusa-signs-title">Signs You Need Offshore Bookkeeping</h2>
                    <p>Recognize any of these? It may be time to make a change.</p>
                </div>

                <div class="bkusa-signs__grid" role="list">
                    @foreach ($signs as $sign)
                        <article class="bkusa-sign" role="listitem">
                            <div class="bkusa-sign__icon" aria-hidden="true">
                                <i class="fa-solid {{ $sign['icon'] }}"></i>
                            </div>
                            <h3>{{ $sign['label'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="bkusa-section" aria-labelledby="bkusa-benefits-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-benefits-title">Benefits of Outsourcing Bookkeeping with IBN Tech</h2>
                    <p>Six reasons businesses choose us to manage their financial operations.</p>
                </div>

                <div class="bkusa-benefits" role="list">
                    @foreach ($benefits as $item)
                        <article class="bkusa-benefit" role="listitem">
                            <div
                                class="bkusa-benefit__num"
                                style="--bkusa-num-bg: {{ $item['color'] }}"
                                aria-hidden="true"
                            >
                                {{ $item['num'] }}
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Stats --}}
        <section class="bkusa-section bkusa-section--soft" aria-labelledby="bkusa-stats-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-stats-title">
                        Why IBN Tech is the Leading Bookkeeping Outsourcing Provider in the USA
                    </h2>
                </div>

                <div class="bkusa-stats" role="list">
                    @foreach ($stats as $stat)
                        <article class="bkusa-stat" role="listitem">
                            <p class="bkusa-stat__value">{{ $stat['value'] }}</p>
                            <h3 class="bkusa-stat__label">{{ $stat['label'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="bkusa-section__cta">
                    <a href="#" class="bkusa-btn bkusa-btn--green" data-contact-modal-trigger>
                        LET'S GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Bookkeeping Automation --}}
        <section class="bkusa-section" aria-labelledby="bkusa-automation-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-automation-title">Bookkeeping Automation</h2>
                    <p>Embrace the Future of Bookkeeping with AI &amp; Automation</p>
                </div>

                <div class="bkusa-automation" role="list">
                    @foreach ($automation as $card)
                        <article class="bkusa-auto-card" role="listitem">
                            <div class="bkusa-auto-card__media">
                                <img
                                    src="{{ $img($card['file']) }}"
                                    alt="{{ $card['alt'] }}"
                                    width="480"
                                    height="320"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <div class="bkusa-auto-card__body">
                                <h3>{{ $card['title'] }}</h3>
                                <p>{{ $card['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why USA Businesses Trust band --}}
        <section class="bkusa-trust-band" aria-labelledby="bkusa-trust-title">
            <div class="site-shell bkusa-trust-band__inner">
                <div class="bkusa-trust-band__copy">
                    <h2 id="bkusa-trust-title">Why USA Businesses Trust IBN Tech for Bookkeeping</h2>
                    <p>
                        We uphold USA GAAP standards, offering personalized bookkeeping services tailored to meet the unique challenges of businesses nationwide.
                    </p>
                    <p>Get started now with your free month of bookkeeping services!</p>
                    <a href="#" class="bkusa-btn bkusa-btn--green bkusa-btn--lg" data-contact-modal-trigger>
                        GET STARTED NOW
                    </a>
                </div>
                <div class="bkusa-trust-band__media">
                    <img
                        src="{{ $img('signs-you-need-offshore-bookkeeping.webp') }}"
                        alt="Why USA businesses trust IBN Tech for offshore bookkeeping"
                        width="520"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Software Expertise --}}
        <section class="bkusa-software" aria-labelledby="bkusa-software-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-software-title">
                        Software <span class="bkusa-accent">Expertise</span>
                    </h2>
                    <p>We work seamlessly with your preferred accounting platforms.</p>
                </div>
                <div class="bkusa-software__media">
                    <img
                        src="{{ $img('software-bookkeeping.webp') }}"
                        alt="Accounting software expertise"
                        width="1200"
                        height="560"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="bkusa-industries-section" aria-labelledby="bkusa-industries-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-industries-title">Industries We Specialize In</h2>
                    <p>Every industry has its own unique needs. Our tailored, industry-specific solutions are designed to help you operate efficiently.</p>
                </div>

                <div class="bkusa-industries" role="list">
                    @foreach ($industries as $industry)
                        <a
                            href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                            class="bkusa-industry"
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

        {{-- Areas We Serve --}}
        <section class="bkusa-section" aria-labelledby="bkusa-areas-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <h2 id="bkusa-areas-title">Areas We Serve</h2>
                    <p>Delivering expert bookkeeping services across major USA cities and states.</p>
                </div>

                <ul class="bkusa-areas">
                    @foreach ($areas as $area)
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
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="bkusa-testimonials" aria-labelledby="bkusa-testimonials-title">
            <div class="site-shell">
                <div class="bkusa-heading bkusa-heading--center">
                    <p class="bkusa-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="bkusa-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="bkusa-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.index - 1 + this.total) % this.total; },
                        next() { this.index = (this.index + 1) % this.total; }
                    }"
                >
                    <button
                        type="button"
                        class="bkusa-testimonials__nav bkusa-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="bkusa-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="bkusa-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="bkusa-testimonials__nav bkusa-testimonials__nav--next"
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