@php
    $img = fn (string $file): string => asset('images/procure-to-pay/'.$file);

    $stats = [
        ['value' => '27+', 'label' => 'Years of Experience'],
        ['value' => '30+', 'label' => 'Industries Served'],
        ['value' => '120+', 'label' => 'Experienced Professionals'],
    ];

    $features = [
        [
            'icon' => 'optimized-vendor-sourcing.svg',
            'alt' => 'optimized vendor sourcing',
            'title' => 'Vendor Management',
            'text' => 'Tired of juggling suppliers? We take the reins—selecting top vendors, onboarding them smoothly, and keeping performance on track.',
        ],
        [
            'icon' => 'invoice-processing.svg',
            'alt' => 'invoice processing',
            'title' => 'Invoice Processing',
            'text' => 'Say goodbye to invoice pileups. We handle every step—receiving, verifying, and processing—with laser precision.',
        ],
        [
            'icon' => 'spend-analysis.svg',
            'alt' => 'spend analysis',
            'title' => 'Spend Analysis',
            'text' => 'Unlock hidden savings. We dig into your spending data, spotlighting opportunities to cut costs and optimize budgets.',
        ],
        [
            'icon' => 'payment-processing-1.svg',
            'alt' => 'payment processing',
            'title' => 'Payment Processing',
            'text' => 'Cash flow chaos? Not anymore. We schedule and disburse payments perfectly aligned with your terms.',
        ],
        [
            'icon' => 'reconciliation-services.svg',
            'alt' => 'reconciliation services',
            'title' => 'Reconciliation Services',
            'text' => 'Numbers not adding up? We make sure every transaction matches your records, delivering accuracy and peace of mind.',
        ],
        [
            'icon' => 'supplier-relationship-management.svg',
            'alt' => 'supplier relationship management',
            'title' => 'Supplier Relationship Management',
            'text' => 'Build bridges, not barriers. We go beyond the basics, fostering lasting supplier partnerships through collaboration.',
        ],
        [
            'icon' => 'ai-powered-insights.svg',
            'alt' => 'ai-powered insights',
            'title' => 'AI-Powered Insights',
            'text' => 'Leverage cutting-edge AI to predict procurement trends and optimize your supply chain with unprecedented accuracy.',
        ],
        [
            'icon' => 'ordering.png',
            'alt' => 'ordering',
            'title' => 'Purchase Order Processing',
            'text' => 'Ordering made simple. We create, approve, and track POs seamlessly, bridging the gap between what you need and what you get.',
        ],
    ];

    $processSteps = [
        [
            'title' => 'Vendor Management & Sourcing',
            'text' => 'We identify and onboard the best suppliers, ensuring competitive pricing and quality service.',
        ],
        [
            'title' => 'Purchase Requisition & Approval',
            'text' => 'Streamlined requisition creation and approval workflows that eliminate bottlenecks.',
        ],
        [
            'title' => 'Purchase Order Processing',
            'text' => 'Automated PO creation, transmission, and tracking for complete visibility.',
        ],
        [
            'title' => 'Invoice Processing & Matching',
            'text' => 'Accurate three-way matching between POs, receipts, and invoices to prevent errors.',
        ],
        [
            'title' => 'Payment Processing',
            'text' => 'Timely, accurate payments that maintain vendor relationships and capture early payment discounts.',
        ],
        [
            'title' => 'Reporting & Analytics',
            'text' => 'Comprehensive insights that drive continuous improvement and strategic decision-making.',
        ],
    ];

    $consultBenefits = [
        'Personalized solution tailored to your business needs',
        'Detailed cost-saving analysis for your organization',
        'No obligation, risk-free consultation with our experts',
    ];

    $valueItems = [
        [
            'icon' => 'strategic-cost-optimization.svg',
            'alt' => 'strategic cost optimization',
            'title' => 'Strategic Cost Optimization',
            'text' => 'Reduce procurement costs with actionable strategies for measurable savings',
        ],
        [
            'icon' => 'supplier-centric-solutions.svg',
            'alt' => 'supplier-centric solutions',
            'title' => 'Supplier-Centric Solutions',
            'text' => 'Enhance supplier relationships with optimized pricing and timely payments',
        ],
        [
            'icon' => 'future-proof-scalability.svg',
            'alt' => 'future-proof scalability',
            'title' => 'Future-Proof Scalability',
            'text' => 'Scalable P2P solutions that grow with your business needs',
        ],
        [
            'icon' => 'predictive-modeling.svg',
            'alt' => 'predictive modeling',
            'title' => 'Predictive Modeling',
            'text' => 'Use advanced data analytics to identify potential issues and opportunities before they arise',
        ],
        [
            'icon' => 'operational-efficiency.svg',
            'alt' => 'operational efficiency',
            'title' => 'Operational Efficiency',
            'text' => 'Automate processes to reduce errors and ensure compliance, speeding up the procurement cycle',
        ],
        [
            'icon' => 'accelerated-procurement.svg',
            'alt' => 'accelerated procurement',
            'title' => 'Accelerated Procurement',
            'text' => 'Faster requisition-to-payment cycles for swift market adaptation',
        ],
        [
            'icon' => 'real-time-visibility.svg',
            'alt' => 'real-time visibility',
            'title' => 'Real-Time Visibility',
            'text' => 'Gain data-driven insights for continuous procurement optimization',
        ],
        [
            'icon' => 'data-security-assurance.svg',
            'alt' => 'data security assurance',
            'title' => 'Data Security Assurance',
            'text' => 'Top-tier protection for your sensitive procurement data',
        ],
        [
            'icon' => 'enhanced-financial-management.svg',
            'alt' => 'enhanced financial management',
            'title' => 'Enhanced Financial Management',
            'text' => 'Integrate procurement with financial systems for real-time visibility and accurate forecasting',
        ],
        [
            'icon' => 'tighter-control.svg',
            'alt' => 'tighter control',
            'title' => 'Tighter Control',
            'text' => 'Streamline procurement oversight to prevent unauthorized spending and uncover cost-saving opportunities',
        ],
    ];

    $apTabs = [
        [
            'title' => 'Invoice Processing',
            'items' => [
                'Automated invoice capture and data extraction',
                'AI-powered validation and error detection',
                'Seamless integration with ERP systems',
            ],
        ],
        [
            'title' => 'Payment Automation',
            'items' => [
                'Scheduled payment processing',
                'Multi-currency and international payment support',
                'Fraud prevention and payment security',
            ],
        ],
        [
            'title' => 'Reporting',
            'items' => [
                'Customizable dashboards and KPI tracking',
                'Spend analytics and supplier performance metrics',
                'Audit-ready reporting and compliance documentation',
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/procure-to-pay.css'])
@endpush

@section('content')
    <div class="p2p-page">
        {{-- Hero --}}
        <section class="p2p-hero" aria-labelledby="p2p-hero-title">
            <div class="site-shell p2p-hero__inner">
                <div class="p2p-hero__copy">
                    <h1 id="p2p-hero-title">Streamline Your Business with IBN Tech's Procure-to-Pay Solutions</h1>
                    <p>
                        IBN Tech's end-to-end Procure-to-Pay services simplify your procurement process, saving time and costs while boosting efficiency. Focus on growth, not paperwork.
                    </p>
                    <a href="#contact-us-section" class="p2p-btn p2p-btn--navy">Get Free Consultation</a>
                </div>
                <div class="p2p-hero__media">
                    <img
                        src="{{ $img('side-banner.png') }}"
                        alt="Procure-to-pay workflow showing purchase order, invoice, and payment tracking"
                        width="560"
                        height="520"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Stats --}}
        <section class="p2p-stats" aria-label="Company statistics">
            <div class="site-shell p2p-stats__inner">
                @foreach ($stats as $stat)
                    <div class="p2p-stats__item">
                        <strong>{{ $stat['value'] }}</strong>
                        <span>{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Yellow CTA --}}
        <section class="p2p-banner" aria-labelledby="p2p-banner-title">
            <div class="site-shell p2p-banner__inner">
                <div class="p2p-banner__copy">
                    <h2 id="p2p-banner-title">Ready to Transform Your Procurement?</h2>
                    <p>Don't let outdated processes hold you back. Outsource your Procure-to-Pay needs to IBN Tech and experience a smoother, smarter way to manage your business finances. Thousands of companies across the USA, UK, and beyond trust us to deliver results—now it's your turn!</p>
                </div>
                <a href="#contact-us-section" class="p2p-btn p2p-btn--navy">Get Started Now</a>
            </div>
        </section>

        {{-- Features --}}
        <section class="p2p-section p2p-features" aria-labelledby="p2p-features-title">
            <div class="site-shell">
                <div class="p2p-heading">
                    <h2 id="p2p-features-title">Supercharge Your Business with Procure-to-Pay Outsourcing Services</h2>
                    <p>Transform your procurement and payment headaches into a streamlined success story. Here's how each piece of our Procure-to-Pay (P2P) solution delivers value—and why it's time to rethink your approach:</p>
                </div>

                <div class="p2p-features__grid" role="list">
                    @foreach ($features as $feature)
                        <article class="p2p-feature" role="listitem">
                            <img
                                src="{{ $img($feature['icon']) }}"
                                alt="{{ $feature['alt'] }}"
                                width="72"
                                height="72"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $feature['title'] }}</h3>
                            <p>{{ $feature['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="p2p-center-cta">
                    <a href="#contact-us-section" class="p2p-btn p2p-btn--navy">Get Started Now</a>
                </div>
            </div>
        </section>

        {{-- Process timeline --}}
        <section class="p2p-section p2p-process" aria-labelledby="p2p-process-title">
            <div class="site-shell">
                <div class="p2p-heading">
                    <h2 id="p2p-process-title">Our Comprehensive Procure to Pay Outsourcing Services</h2>
                    <p>Optimizes Every Step of Your Procure-to-Pay Process with Automation</p>
                </div>

                <ol class="p2p-timeline">
                    @foreach ($processSteps as $step)
                        <li class="p2p-timeline__item">
                            <span class="p2p-timeline__marker" aria-hidden="true">{{ $loop->iteration }}</span>
                            <div class="p2p-timeline__content">
                                <h3>{{ $step['title'] }}</h3>
                                <p>{{ $step['text'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        {{-- Process callout --}}
        <section class="p2p-callout" aria-labelledby="p2p-callout-title">
            <div class="site-shell">
                <div class="p2p-callout__box">
                    <h2 id="p2p-callout-title">Procure-to-Pay Process</h2>
                    <p>Outsource your Procure-to-Pay process to benefit from optimized, automated workflows that reduce costs, enhance supplier relationships, and ensure data security, real-time insights, and efficient payments.</p>
                    <a href="#contact-us-section" class="p2p-btn p2p-btn--green">Get Started Now</a>
                </div>
            </div>
        </section>

        {{-- Consultation form --}}
        <section
            class="p2p-section p2p-consult"
            id="contact-us-section"
            aria-labelledby="p2p-consult-title"
        >
            <div class="site-shell p2p-consult__inner">
                <div class="p2p-consult__copy">
                    <h2 id="p2p-consult-title">Take the First Step – Get a Free Consultation!</h2>
                    <p>Fill out the form to discover how IBN Tech can save you time and money while supercharging your procurement process. Let's build a custom P2P solution just for you—starting today!</p>
                    <ul class="p2p-check-list">
                        @foreach ($consultBenefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>

                <aside class="p2p-form" id="contact-section" aria-labelledby="p2p-form-title">
                    <h2 id="p2p-form-title">Get a Free Consultation!</h2>
                    <livewire:forms.contact-form
                        form-name="procure-to-pay"
                        id-prefix="p2p"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your requirements"
                        submit-label="Get a Quote"
                        layout="home"
                        :message-rows="4"
                    />
                </aside>
            </div>
        </section>

        {{-- Value grid --}}
        <section class="p2p-section p2p-value" aria-labelledby="p2p-value-title">
            <div class="site-shell">
                <div class="p2p-heading">
                    <h2 id="p2p-value-title">How Our Procure-to-Pay Outsourcing Drives Value</h2>
                    <p>Discover the strategic advantages that make our P2P solutions the choice of industry leaders.</p>
                </div>

                <div class="p2p-value__grid" role="list">
                    @foreach ($valueItems as $item)
                        <article class="p2p-value__card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="64"
                                height="64"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="p2p-center-cta">
                    <a href="#contact-us-section" class="p2p-btn p2p-btn--navy">Get Started Now</a>
                </div>
            </div>
        </section>

        {{-- AP integration --}}
        <section class="p2p-section p2p-ap" aria-labelledby="p2p-ap-title">
            <div class="site-shell p2p-ap__inner">
                <div class="p2p-ap__copy">
                    <h2 id="p2p-ap-title">Procure to Pay Business Process with Integrated Accounts Payable Solutions</h2>
                    <p>A seamless Procure to Pay process doesn't end with procurement. Dive deeper into how IBN Tech's Accounts Payable Services can further streamline your financial workflows, ensuring optimal cash flow management.</p>
                    <a href="#contact-us-section" class="p2p-btn p2p-btn--navy">Get Started Now</a>
                </div>

                <div class="p2p-ap__card" x-data="{ active: 0 }">
                    <h3>Accounts Payable Solutions</h3>
                    <div class="p2p-tabs" role="tablist" aria-label="Accounts payable solutions">
                        @foreach ($apTabs as $i => $tab)
                            <button
                                type="button"
                                class="p2p-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="p2p-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="p2p-panel-{{ $i }}"
                                @click="active = {{ $i }}"
                            >
                                {{ $tab['title'] }}
                            </button>
                        @endforeach
                    </div>

                    @foreach ($apTabs as $i => $tab)
                        <div
                            class="p2p-tabs__panel"
                            id="p2p-panel-{{ $i }}"
                            role="tabpanel"
                            aria-labelledby="p2p-tab-{{ $i }}"
                            @if ($i !== 0) hidden @endif
                            :hidden="active !== {{ $i }}"
                        >
                            <ul class="p2p-check-list">
                                @foreach ($tab['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                    <a href="#contact-section" class="p2p-btn p2p-btn--green p2p-btn--block">
                        Learn More About AP Solutions
                    </a>
                </div>
            </div>
        </section>

        {{-- Final CTA --}}
        <section class="p2p-final" aria-labelledby="p2p-final-title">
            <div class="site-shell p2p-final__inner">
                <h2 id="p2p-final-title">Take the First Step – Get a Free Consultation!</h2>
                <p>Fill out the form below to discover how IBN Tech can save you time and money while supercharging your procurement process. Let's build a custom P2P solution just for you—starting today!</p>
                <a href="#contact-us-section" class="p2p-btn p2p-btn--green">Get Free Consultation</a>
            </div>
        </section>
    </div>
@endsection
