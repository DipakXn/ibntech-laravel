@php
    $img = fn (string $file): string => asset('images/ap-ar-automation/'.$file);

    $heroChecks = [
        '30% Faster Cash Flow',
        '25% Increase in On-Time Payments',
        '20% Lower Processing Costs',
    ];

    $whyAutomate = [
        [
            'icon' => 'fa-triangle-exclamation',
            'title' => 'Improved accuracy',
            'text' => 'OCR + validation rules minimize data entry mistakes and duplicate invoices.',
        ],
        [
            'icon' => 'fa-rotate',
            'title' => 'Faster cycles',
            'text' => 'Touchless approvals and auto-matching cut AP cycle times from weeks to days.',
        ],
        [
            'icon' => 'fa-money-bill-wave',
            'title' => 'Cash acceleration',
            'text' => 'Automated dunning and payment portals reduce DSO and improve collections.',
        ],
        [
            'icon' => 'fa-eye',
            'title' => 'Real-time visibility',
            'text' => 'Unified dashboards across AP and AR to track liabilities, receipts, and cash.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Stronger controls',
            'text' => 'Segregation of duties, audit trails, and policy enforcement out of the box.',
        ],
        [
            'icon' => 'fa-circle-check',
            'title' => 'Compliance-ready',
            'text' => 'Built-in documentation to support month-end close and audit readiness.',
        ],
    ];

    $deliveryCards = [
        [
            'title' => 'Implementation',
            'text' => 'Configure workflows, controls, and mappings; migrate vendors and customers; and integrate bank feeds.',
        ],
        [
            'title' => 'Change management',
            'text' => 'Role-based training, pilot rollouts, and documentation to drive adoption and policy compliance.',
        ],
        [
            'title' => 'Ongoing success',
            'text' => 'Quarterly reviews, SLA monitoring, and optimization for continuous efficiency gains.',
        ],
    ];

    $stackLogos = [
        ['file' => 'syspro.webp', 'alt' => 'SYSPRO'],
        ['file' => 'ifs.webp', 'alt' => 'IFS'],
        ['file' => 'sage-1.webp', 'alt' => 'Sage'],
        ['file' => 'quicbooks.webp', 'alt' => 'QuickBooks'],
        ['file' => 'oracle-netsuite.webp', 'alt' => 'Oracle NetSuite'],
        ['file' => 'dynamics-365.webp', 'alt' => 'Dynamics 365'],
        ['file' => 'acumatica.webp', 'alt' => 'Acumatica'],
        ['file' => 'sap.webp', 'alt' => 'SAP'],
    ];

    $customBenefits = [
        '30% Faster Payments with digital invoicing and automated collections',
        '40% Reduction in DSO through intelligent dunning workflows',
        '95%+ Touchless Cash Application using AI-powered matching',
        '50% Decrease in Bad Debt via proactive credit risk management',
        '100% Visibility into receivables, disputes, and cash forecasts',
    ];

    $apCapabilities = [
        ['icon' => 'electronic.webp', 'title' => '90% Task Automation', 'text' => 'Free your team from manual work'],
        ['icon' => 'pay-day.webp', 'title' => 'Smart Payment Scheduling', 'text' => 'Capture early payment discounts'],
        ['icon' => 'bill.webp', 'title' => 'Touchless Invoice Processing', 'text' => 'AI + OCR for 50% higher throughput'],
        ['icon' => 'real-time.webp', 'title' => 'Real-Time Spend Visibility', 'text' => 'Live dashboards for instant insights'],
        ['icon' => 'identity.webp', 'title' => 'Fraud & Risk Management', 'text' => 'Multi-layered security to prevent errors'],
        ['icon' => 'algorithm.webp', 'title' => 'ERP Integration', 'text' => 'Seamless with SAP, Oracle, NetSuite & more'],
        ['icon' => 'paperless.webp', 'title' => 'Paperless Workflows', 'text' => 'Support ESG goals with digital processing'],
        ['icon' => '24h.webp', 'title' => '24/7 Vendor Help Desk', 'text' => 'Fast dispute resolution and support'],
    ];

    $arCapabilities = [
        ['icon' => 'invoice.webp', 'title' => 'Automated Invoicing', 'text' => 'Email, EDI, and portal delivery'],
        ['icon' => 'atm-card.webp', 'title' => 'Flexible Payment Options', 'text' => 'ACH, UPI, cards, wallets'],
        ['icon' => 'programming.webp', 'title' => 'AI-Powered Follow-Ups', 'text' => 'Reduce DSO by up to 30%'],
        ['icon' => 'idea.webp', 'title' => 'Dispute Management', 'text' => 'Collaborative resolution workflows'],
        ['icon' => 'loan.webp', 'title' => 'Cash Application Automation', 'text' => '95%+ accuracy with AI'],
        ['icon' => 'forecast-analytics.webp', 'title' => 'Cash Flow Forecasting', 'text' => 'Real-time analytics for better planning'],
        ['icon' => 'software-integration.webp', 'title' => 'ERP & CRM Integration', 'text' => 'Salesforce, SAP, Oracle, Dynamics'],
        ['icon' => 'survey.webp', 'title' => 'Audit-Ready Compliance', 'text' => 'GAAP, tax, and revenue standards'],
    ];

    $valueProps = [
        [
            'icon' => 'fa-trophy',
            'title' => 'Industry-Leading Expertise',
            'text' => '15+ years of proven success in automating and outsourcing financial processes for global enterprises',
        ],
        [
            'icon' => 'fa-robot',
            'title' => 'AI-Driven Technology',
            'text' => 'Secure, AI-powered platforms for faster, more accurate AP/AR management',
        ],
        [
            'icon' => 'fa-screwdriver-wrench',
            'title' => 'Customized Solutions',
            'text' => 'Customized automation built around your workflows, systems, and business goals',
        ],
    ];

    $approachSteps = [
        [
            'icon' => 'statistics.webp',
            'title' => 'Audit & Needs Assessment',
            'text' => 'Identify inefficiencies and automation opportunities',
        ],
        [
            'icon' => 'problem-solving.webp',
            'title' => 'Strategy & Solution Design',
            'text' => 'Custom-fit automation for your workflows',
        ],
        [
            'icon' => 'testing.webp',
            'title' => 'Implementation & Onboarding',
            'text' => 'Seamless deployment and team training',
        ],
        [
            'icon' => '24-hours.webp',
            'title' => 'Ongoing Support & Optimization',
            'text' => '24/7 support and continuous improvement',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/ap-ar-automation.css'])
@endpush

@section('content')
    <div class="apar-page">
        {{-- Hero --}}
        <section class="apar-hero" aria-labelledby="apar-hero-title">
            <div class="site-shell apar-hero__inner">
                <div class="apar-hero__copy">
                    <h1 id="apar-hero-title">Accelerate Business with Smarter AP And AR Automation Services</h1>
                    <p class="apar-hero__lede">
                        Digitize invoices, reconcile payments, and forecast cash with confidence. Our team implements workflow automation solutions that reduce manual entry, improve accuracy, and accelerate time-to-cash.
                    </p>
                    <ul class="apar-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="apar-hero__actions">
                        <a href="#" class="apar-btn apar-btn--light" data-contact-modal-trigger>
                            Request Consultation
                        </a>
                    </div>
                </div>

                <div class="apar-hero__media">
                    <div class="apar-hero__media-card">
                        <img
                            src="{{ $img('AP-AR-Automation-Banner.webp') }}"
                            alt="AP AR Automation Banner"
                            width="385"
                            height="385"
                            fetchpriority="high"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Why automate --}}
        <section class="apar-section" aria-labelledby="apar-why-title">
            <div class="site-shell">
                <div class="apar-heading">
                    <h2 id="apar-why-title">
                        Why You Need to <span class="apar-accent">Automate AP and AR</span> Now
                    </h2>
                    <p>Cut costs, shorten cycle times, and tighten controls across your payables and receivables.</p>
                </div>

                <div class="apar-card-grid apar-card-grid--3" role="list">
                    @foreach ($whyAutomate as $item)
                        <article class="apar-feature-card" role="listitem">
                            <span class="apar-feature-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Intelligent / Efficient / Reliable --}}
        <section class="apar-section apar-section--tight" aria-labelledby="apar-intel-title">
            <div class="site-shell apar-split">
                <div class="apar-split__copy">
                    <h2 id="apar-intel-title">
                        INTELLIGENT. <span class="apar-accent">EFFICIENT.</span> RELIABLE
                    </h2>
                    <p>
                        Technology is transforming the way businesses manage accounts payable and receivable, enabling faster and more accurate financial reviews. Automated solutions process large volumes of transactional data to identify overpayments, missed invoices, discrepancies, thereby reducing manual errors and improving operational efficiency.
                    </p>
                    <p>
                        As an expert automation solution provider, IBN Technologies combines intelligent automation with expert financial analysis to deliver measurable results. Just as advanced systems require skilled professionals to operate effectively, our tech-enabled assessments are guided by experienced specialists who ensure every insight drives value. Strengthen your financial controls, streamline processes, and unlock hidden opportunities with our smart financial review services.
                    </p>
                </div>

                <div class="apar-delivery" role="list">
                    @foreach ($deliveryCards as $card)
                        <article class="apar-delivery__card" role="listitem">
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="apar-cta-banner" aria-labelledby="apar-cta-modernize-title">
            <div class="site-shell apar-cta-banner__inner">
                <h2 id="apar-cta-modernize-title">Ready to modernize AP and AR?</h2>
                <p>Book a 30-minute walkthrough to see how automation can cut costs and speed up cash.</p>
                <a href="#" class="apar-btn apar-btn--green" data-contact-modal-trigger>
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Schedule Your Consultation
                </a>
            </div>
        </section>

        {{-- Stack logos --}}
        <section class="apar-section" aria-labelledby="apar-stack-title">
            <div class="site-shell">
                <div class="apar-heading">
                    <h2 id="apar-stack-title">
                        Works With Your Existing <span class="apar-accent">Stack</span>
                    </h2>
                    <p>Connect your ERP, accounting, banking, and payment systems to orchestrate end-to-end cash operations.</p>
                </div>

                <div
                    class="apar-logos"
                    x-data="{
                        index: 0,
                        perView: 6,
                        total: {{ count($stackLogos) }},
                        get maxIndex() { return Math.max(0, this.total - this.perView); },
                        prev() { this.index = Math.max(0, this.index - 1); },
                        next() { this.index = Math.min(this.maxIndex, this.index + 1); },
                        resize() {
                            this.perView = window.innerWidth < 640 ? 2 : (window.innerWidth < 900 ? 3 : (window.innerWidth < 1100 ? 4 : 6));
                            this.index = Math.min(this.index, this.maxIndex);
                        }
                    }"
                    x-init="resize(); window.addEventListener('resize', () => resize())"
                >
                    <button type="button" class="apar-logos__nav" @click="prev()" :disabled="index === 0" aria-label="Previous logos">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="apar-logos__viewport">
                        <div
                            class="apar-logos__track"
                            :style="`transform: translateX(calc(-${index} * (100% / ${perView}))); --per-view: ${perView}`"
                        >
                            @foreach ($stackLogos as $logo)
                                <div class="apar-logos__item">
                                    <img
                                        src="{{ $img($logo['file']) }}"
                                        alt="{{ $logo['alt'] }}"
                                        width="140"
                                        height="56"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="apar-logos__nav" @click="next()" :disabled="index >= maxIndex" aria-label="Next logos">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        {{-- Customized solutions --}}
        <section class="apar-section" aria-labelledby="apar-custom-title">
            <div class="site-shell">
                <div class="apar-heading">
                    <h2 id="apar-custom-title">
                        Customized Process <span class="apar-accent">Automation</span> Solutions
                    </h2>
                    <p>Implement only what you need, modular services that snap into your current processes.</p>
                </div>

                <div class="apar-custom">
                    <ul class="apar-check-list">
                        @foreach ($customBenefits as $benefit)
                            <li>
                                <i class="fa-solid fa-check" aria-hidden="true"></i>
                                <span>{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="apar-custom__media">
                        <img
                            src="{{ $img('Customized-Process-Automation-Solutions.webp') }}"
                            alt="Customized Process Automation Solutions"
                            width="532"
                            height="270"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Growth CTA --}}
        <section class="apar-cta-banner" aria-labelledby="apar-cta-growth-title">
            <div class="site-shell apar-cta-banner__inner">
                <h2 id="apar-cta-growth-title">Discover how automation can unlock new growth opportunities</h2>
                <p>Schedule a personalized consultation to identify which processes are costing you the most - and how automation can turn them into growth drivers.</p>
                <a href="#" class="apar-btn apar-btn--green" data-contact-modal-trigger>
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Book Your Consultation
                </a>
            </div>
        </section>

        {{-- AP capabilities --}}
        <section class="apar-section" aria-labelledby="apar-ap-title">
            <div class="site-shell">
                <div class="apar-heading">
                    <h2 id="apar-ap-title">
                        <span class="apar-accent">Accounts Payable Automation</span> – Capabilities That Deliver
                    </h2>
                    <p>Cut AP Cycle Times Now with Automation and Unlock Real Business Impact</p>
                </div>

                <div class="apar-capability">
                    <div class="apar-process-card">
                        <h3>Accounts Payable Automation Process</h3>
                        <img
                            src="{{ $img('Accounts-Payable-Automation-Process.gif') }}"
                            alt="Accounts Payable Automation Process"
                            width="530"
                            height="550"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <ul class="apar-cap-list">
                        @foreach ($apCapabilities as $item)
                            <li>
                                <img src="{{ $img($item['icon']) }}" alt="" width="64" height="64" loading="lazy" decoding="async">
                                <div>
                                    <strong>{{ $item['title'] }}</strong>
                                    <span>– {{ $item['text'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- AR capabilities --}}
        <section class="apar-section" aria-labelledby="apar-ar-title">
            <div class="site-shell">
                <div class="apar-heading">
                    <h2 id="apar-ar-title">
                        <span class="apar-accent">Accounts Receivable Automation</span> – Smarter, Faster Collections
                    </h2>
                    <p>Improve Cash Flow with an AR Automation That Covers Its Own Cost</p>
                </div>

                <div class="apar-capability apar-capability--reverse">
                    <ul class="apar-cap-list">
                        @foreach ($arCapabilities as $item)
                            <li>
                                <img src="{{ $img($item['icon']) }}" alt="" width="64" height="64" loading="lazy" decoding="async">
                                <div>
                                    <strong>{{ $item['title'] }}</strong>
                                    <span>– {{ $item['text'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="apar-process-card">
                        <h3>AR automation workflow</h3>
                        <img
                            src="{{ $img('AR-automation-workflow.gif') }}"
                            alt="AR automation workflow"
                            width="530"
                            height="550"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Transform CTA --}}
        <section class="apar-cta-banner apar-cta-banner--ruled" aria-labelledby="apar-cta-transform-title">
            <div class="site-shell apar-cta-banner__inner">
                <h2 id="apar-cta-transform-title">Let's Transform Your Finance Function</h2>
                <p>Connect with our AP/AR automation experts to explore how we can help you reduce costs, improve cash flow, and scale with confidence</p>
                <a href="#apar-consult" class="apar-btn apar-btn--light">
                    Book a Consultation
                </a>
            </div>
        </section>

        {{-- Value props --}}
        <section class="apar-section apar-section--soft" aria-labelledby="apar-value-title">
            <div class="site-shell">
                <div class="apar-heading">
                    <h2 id="apar-value-title">
                        Simplify. Streamline. Grow With Smart <span class="apar-accent">AP Automation Solutions</span>
                    </h2>
                    <p>Let's automate, optimize, and scale - together</p>
                </div>

                <div class="apar-card-grid apar-card-grid--3" role="list">
                    @foreach ($valueProps as $item)
                        <article class="apar-value-card" role="listitem">
                            <span class="apar-value-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- 4-step approach --}}
        <section class="apar-section" aria-labelledby="apar-steps-title">
            <div class="site-shell">
                <div class="apar-heading apar-heading--ruled">
                    <h2 id="apar-steps-title">
                        Our Proven <span class="apar-accent">4-Step Approach</span>
                    </h2>
                </div>

                <div class="apar-steps" role="list">
                    @foreach ($approachSteps as $index => $step)
                        <article class="apar-steps__item" role="listitem">
                            <div class="apar-steps__circle">
                                <span class="apar-steps__number">{{ $index + 1 }}</span>
                                <img
                                    src="{{ $img($step['icon']) }}"
                                    alt=""
                                    width="60"
                                    height="60"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </article>
                        @if (! $loop->last)
                            <div class="apar-steps__arrow" aria-hidden="true"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Consultation form --}}
        <section class="apar-section apar-section--soft" id="apar-consult" aria-labelledby="apar-consult-title">
            <div class="site-shell apar-consult">
                <div class="apar-consult__media">
                    <img
                        src="{{ $img('ap-ar-automation-free-consultation.webp') }}"
                        alt="AP AR automation free consultation"
                        width="800"
                        height="800"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <aside class="apar-consult__card">
                    <h2 id="apar-consult-title">Let's Transform Your Finance Function</h2>
                    <p>Connect with our AP/AR automation experts to explore how we can help you reduce costs, improve cash flow, and scale with confidence</p>

                    <livewire:forms.contact-form
                        form-name="ap-ar-automation"
                        id-prefix="apar"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell Us About Your Specific Bookkeeping Needs"
                        submit-label="BOOK CONSULTATION"
                        layout="default"
                        thank-you-url="/thanks-you-for-ap-ar-management/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
