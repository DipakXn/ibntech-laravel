@php
    $img = fn (string $file): string => asset('images/cpa-outsourcing/'.$file);

    $taxTabs = [
        [
            'title' => 'Personal Tax Return Preparation (Form 1040)',
            'heading' => 'Personal Tax Return Preparation (Form 1040)',
            'columns' => [
                [
                    'Client Data Acquisition',
                    'Tax Organizer Examination',
                    'Prior Year Return Comparison',
                    'Preliminary Assessment and Information Request',
                    'Tax Return Compilation',
                ],
                [
                    'Electronic Filing Verification',
                    'Client Correspondence and Updates',
                    'Tax Planning Support/Analysis',
                    'Process Management via Tax Software Platforms',
                    'Tax returns review',
                ],
            ],
        ],
        [
            'title' => 'Business Tax Returns (1120/1120S/1065)',
            'heading' => 'Business Tax Returns (1120/1120S/1065)',
            'groups' => [
                [
                    'title' => 'Transaction Processing',
                    'items' => [
                        'Financial Statement Analysis',
                        'Review prior year returns and Entity Structure Evaluation',
                        'Tax Reconciliation Documentation Preparation',
                        'Special Filing Requirements Assessment',
                        'Quality Assurance Review',
                    ],
                ],
                [
                    'title' => 'Management Activities',
                    'items' => [
                        'Book-to-Tax Adjustment Computation',
                        'Corporate/Partnership Tax Return Compilation',
                        'Electronic Filing Validation',
                        'Client Liaison and Correspondence',
                        'Tax Workflow Optimization',
                        'Strategic Tax Consultation and Forecasting',
                    ],
                ],
            ],
        ],
    ];

    $offerTabs = [
        [
            'title' => 'Accounts Payable',
            'items' => [
                'Vendor management and data maintenance',
                'Purchase order creation and processing',
                'Invoice verification and three-way matching',
                'Vendor payments and reconciliations',
                'AP aging reporting and analysis',
                'Expense management',
            ],
        ],
        [
            'title' => 'Accounts Receivable',
            'items' => [
                'Customer data management',
                'Billing, credit, and adjustments',
                'Credit control and debt collections',
                'Customer support and inquiries',
                'Customer deposit applications and reconciliations',
                'AR aging analysis and DSO optimization',
            ],
        ],
        [
            'title' => 'Inventory Bookkeeping',
            'items' => [
                'Inventory valuation and optimization',
                'Order fulfillment and processing',
                'Forecasting and planning',
                'Inventory analysis and reporting',
            ],
        ],
        [
            'title' => 'Payroll',
            'items' => [
                'Payroll calculations and processing',
                'Payroll tax management and filing support',
                'Employee benefits administration',
                'Time and attendance tracking',
                'Payroll reporting and compliance',
                'Payroll cost analysis',
                'Payroll audits and reviews',
            ],
        ],
        [
            'title' => 'Reporting',
            'items' => [
                'Monthly, quarterly, and annual financial closing',
                'General ledger maintenance',
                'Bank reconciliations',
                'Treasury management support',
                'Estimated tax calculations and tracking',
                'US GAAP compliance',
                'Fixed assets and depreciation accounting',
                'Job-cost accounting',
                'Project profitability reporting',
                'Financial statement preparation',
                'Audit support services',
            ],
        ],
        [
            'title' => 'Financial Planning and Analysis',
            'items' => [
                'Budgeting and forecasting',
                'Financial modeling',
                'Performance management and analysis',
                'Variance analysis',
                'Cost analysis',
                'Investment analysis',
                'Strategic planning assistance',
                'Cash flow management',
                'Financial reporting',
                'Business valuation',
            ],
        ],
    ];

    $whyCards = [
        [
            'file' => 'dedicated-team.webp',
            'alt' => 'Dedicated Team',
            'title' => 'Dedicated Team',
            'text' => 'Our Customized staffing model ensures that you receive a team of specialists dedicated exclusively to your project.',
        ],
        [
            'file' => 'sustainable-solutions.webp',
            'alt' => 'Sustainable Solutions',
            'title' => 'Sustainable Solutions',
            'text' => 'We deliver a robust and sustainable staffing solution to our clients, boasting a consistently low attrition rate year after year',
        ],
        [
            'file' => 'structured-workflows.webp',
            'alt' => 'Structured Workflows',
            'title' => 'Structured Workflows',
            'text' => 'Throughout the transition and knowledge transfer phases, our team creates a comprehensive and detailed workflow document.',
        ],
        [
            'file' => 'prompt-responsiveness.webp',
            'alt' => 'Prompt Responsiveness',
            'title' => 'Prompt Responsiveness',
            'text' => 'Following our best practices, we guarantee a timely response to all emails and calls, ensuring you never have to wait.',
        ],
        [
            'file' => 'rigorous-quality-control.webp',
            'alt' => 'Rigorous Quality Control',
            'title' => 'Rigorous Quality Control',
            'text' => 'We implement stringent quality control processes to ensure that our services consistently meet the highest standards of excellence.',
        ],
        [
            'file' => 'scalable-services.webp',
            'alt' => 'Scalable Services for small business',
            'title' => 'Scalable Services',
            'text' => 'Our staffing solutions are designed to scale with your business needs, providing flexible options that grow alongside your company.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/cpa-outsourcing.css'])
@endpush

@section('content')
    <div class="cpao-page">
        {{-- Hero --}}
        <section class="cpao-hero" aria-labelledby="cpao-hero-title">
            <div class="site-shell cpao-hero__inner">
                <div class="cpao-hero__copy">
                    <h1 id="cpao-hero-title">Outsourcing Services for CPA &amp; Accounting Firms</h1>
                    <p class="cpao-hero__lede">
                        Experience 99.99% accuracy, satisfaction, and business growth with our expert CPA accounting and bookkeeping services. Trusted by Clients Across the UK, USA, and Worldwide
                    </p>
                </div>

                <aside class="cpao-hero__form" id="contact-us" aria-labelledby="cpao-hero-form-title">
                    <h2 id="cpao-hero-form-title">Want to Improve Your Accounting?</h2>
                    <p class="cpao-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="cpa-outsourcing"
                        id-prefix="cpao"
                        :show-company="false"
                        :show-service="true"
                        service-placeholder="Please Select Services"
                        :service-options="[
                            'Bookkeeping Services',
                            'Payroll Processing',
                            'Procure to Pay',
                            'Accounts Payable and Receivable',
                            'Financial Reporting',
                            'Controller Services',
                        ]"
                        message-placeholder="What kind of accounting solution..."
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="cpao-intro" aria-labelledby="cpao-intro-title">
            <div class="site-shell">
                <div class="cpao-intro__card">
                    <h2 id="cpao-intro-title">Tax Return Preparation and Support Services</h2>
                    <p>
                        IBN Technologies offers experienced tax professionals to assist CPA firms with preparing and reviewing tax returns for individuals (1040) and businesses (1120/1120S/1065) during peak tax season.
                    </p>
                </div>
            </div>
        </section>

        {{-- Tax return tabs --}}
        <section class="cpao-section" aria-labelledby="cpao-tax-title">
            <div class="site-shell">
                <div class="cpao-heading cpao-heading--center">
                    <h2 id="cpao-tax-title" class="cpao-heading--green">UK Outsourced Bookkeeping Solutions</h2>
                </div>

                <div class="cpao-tax-tabs" x-data="{ active: 0 }">
                    <div class="cpao-tax-tabs__nav" role="tablist" aria-label="Tax return preparation categories">
                        @foreach ($taxTabs as $i => $tab)
                            <button
                                type="button"
                                class="cpao-tax-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="cpao-tax-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="cpao-tax-panel-{{ $i }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="cpao-tax-tabs__panels">
                        @foreach ($taxTabs as $i => $tab)
                            <div
                                class="cpao-tax-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="cpao-tax-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="cpao-tax-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :hidden="active !== {{ $i }}"
                            >
                                <div class="cpao-tax-tabs__content">
                                    <h3>{{ $tab['heading'] }}</h3>

                                    @if (! empty($tab['groups']))
                                        <div class="cpao-tax-tabs__groups">
                                            @foreach ($tab['groups'] as $group)
                                                <div class="cpao-tax-tabs__group">
                                                    <h4>{{ $group['title'] }}</h4>
                                                    <ul>
                                                        @foreach ($group['items'] as $item)
                                                            <li>
                                                                <span class="cpao-check" aria-hidden="true">
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
                                        <div class="cpao-tax-tabs__lists">
                                            @foreach ($tab['columns'] as $column)
                                                <ul>
                                                    @foreach ($column as $item)
                                                        <li>
                                                            <span class="cpao-check" aria-hidden="true">
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
                                        href="#contact-us"
                                        class="cpao-btn cpao-btn--navy cpao-tax-tabs__cta"
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

        {{-- E-book CTA --}}
        <section class="cpao-ebook" aria-labelledby="cpao-ebook-title">
            <div class="site-shell cpao-ebook__inner">
                <h2 id="cpao-ebook-title">Get organized for tax season with our free e-book</h2>
                <a href="{{ route('page.show', ['slug' => 'ebook']) }}" class="cpao-btn cpao-btn--green cpao-ebook__btn">
                    Download Now
                </a>
                <img
                    src="{{ $img('ebook-images.png') }}"
                    alt="ebook-images"
                    width="220"
                    height="220"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        {{-- CPA bookkeeping solutions --}}
        <section class="cpao-section" aria-labelledby="cpao-offer-title">
            <div class="site-shell">
                <div class="cpao-heading cpao-heading--center">
                    <h2 id="cpao-offer-title">CPA Bookkeeping Solutions We Offer</h2>
                    <p>
                        We are a top provider of <strong>Financial and Accounting Services</strong>, with a team of experienced CPAs delivering exceptional services to clients worldwide
                    </p>
                </div>

                <div class="cpao-offer-tabs" x-data="{ active: 0 }">
                    <div class="cpao-offer-tabs__nav" role="tablist" aria-label="CPA bookkeeping solutions">
                        @foreach ($offerTabs as $i => $tab)
                            <button
                                type="button"
                                class="cpao-offer-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="cpao-offer-tab-{{ $i }}"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                :class="{ 'is-active': active === {{ $i }} }"
                                @click="active = {{ $i }}"
                                aria-controls="cpao-offer-panel-{{ $i }}"
                            >
                                {{ $tab['title'] }}
                            </button>
                        @endforeach
                    </div>

                    @foreach ($offerTabs as $i => $tab)
                        <div
                            class="cpao-offer-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                            id="cpao-offer-panel-{{ $i }}"
                            role="tabpanel"
                            aria-labelledby="cpao-offer-tab-{{ $i }}"
                            :class="{ 'is-active': active === {{ $i }} }"
                            :hidden="active !== {{ $i }}"
                        >
                            <ul>
                                @foreach ($tab['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Software expertise --}}
        <section class="cpao-software" aria-labelledby="cpao-software-title">
            <div class="site-shell cpao-software__inner">
                <div class="cpao-software__media">
                    <img
                        src="{{ $img('software-logo-tax.webp') }}"
                        alt="Tax Software"
                        width="960"
                        height="475"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="cpao-software__copy">
                    <h2 id="cpao-software-title">
                        Software
                        <span>Expertise</span>
                    </h2>
                    <p>
                        Experience streamlined data integration with our specialized solutions, enhancing efficiency in tax preparation support. Our seamless integration services simplify processes and boost overall performance.
                    </p>
                </div>
            </div>
        </section>

        {{-- Bookkeeping software platforms --}}
        <section class="cpao-section" aria-labelledby="cpao-platforms-title">
            <div class="site-shell">
                <div class="cpao-heading cpao-heading--center">
                    <h2 id="cpao-platforms-title">Bookkeeping Software Platforms</h2>
                </div>
                <div class="cpao-platforms">
                    <img
                        src="{{ $img('bookkeeping-software.webp') }}"
                        alt="Bookkeeping software"
                        width="1920"
                        height="825"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Why outsource --}}
        <section class="cpao-section cpao-section--soft" aria-labelledby="cpao-why-title">
            <div class="site-shell">
                <div class="cpao-heading cpao-heading--center">
                    <h2 id="cpao-why-title">Why Outsource CPA Services to IBN Technologies</h2>
                </div>

                <div class="cpao-why" role="list">
                    @foreach ($whyCards as $card)
                        <article class="cpao-why__card" role="listitem">
                            <img
                                src="{{ $img($card['file']) }}"
                                alt="{{ $card['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
