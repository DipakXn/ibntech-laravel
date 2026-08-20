@php
    $img = fn (string $file): string => asset('images/robotics-process-automation/'.$file);

    $docCards = [
        [
            'file' => 'efficient-document-handling.webp',
            'alt' => 'efficient document handling',
            'title' => 'Efficient Document Handling',
            'text' => 'Quickly process paper and digital documents from any channel or format.',
            'url' => route('case-studies.index'),
            'tone' => 'yellow',
        ],
        [
            'file' => 'adaptive-learning.webp',
            'alt' => 'adaptive learning',
            'title' => 'Adaptive Learning',
            'text' => 'Improve performance and minimize exceptions with continuous RPA robot learning.',
            'url' => route('ebooks.index'),
            'tone' => 'blue',
        ],
        [
            'file' => 'automated-data-extraction.webp',
            'alt' => 'automated data extraction',
            'title' => 'Automated Data Extraction',
            'text' => 'Extract and validate business-critical data with precision using robotic process automation.',
            'url' => null,
            'tone' => 'green',
        ],
        [
            'file' => 'press-release.webp',
            'alt' => 'Press Release',
            'title' => 'Eliminate Bottlenecks',
            'text' => 'Identify and resolve workflow issues with real-time monitoring and reports.',
            'url' => null,
            'tone' => 'yellow',
        ],
        [
            'file' => 'actionable-insights.webp',
            'alt' => 'Actionable insights IPA',
            'title' => 'Actionable Insights',
            'text' => 'Track key performance metrics for better decision-making.',
            'url' => null,
            'tone' => 'blue',
        ],
        [
            'file' => 'complex-workflow-automation.webp',
            'alt' => 'complex workflow automation',
            'title' => 'Complex Workflow Automation',
            'text' => 'Simplify even the most intricate document processes.',
            'url' => route('page.show', ['slug' => 'testimonials']),
            'tone' => 'green',
        ],
    ];
    $docPages = array_chunk($docCards, 3);

    $whyItems = [
        ['file' => 'quick-high-roi.webp', 'alt' => 'quick, high roi', 'title' => 'Quick, high ROI'],
        ['file' => 'low-upfront-costs.webp', 'alt' => 'low upfront costs', 'title' => 'Low upfront costs'],
        ['file' => 'no-system-disruption.webp', 'alt' => 'no system disruption', 'title' => 'No system disruption'],
        ['file' => 'low-code-development.webp', 'alt' => 'low-code development', 'title' => 'Low-code development'],
        ['file' => 'scalable-and-ready-for-enterprises.webp', 'alt' => 'scalable and ready for enterprises', 'title' => 'Scalable and ready for enterprises'],
        ['file' => 'seamless-integrate-across-tools.webp', 'alt' => 'seamless integrate across tools', 'title' => 'Seamless integrate across tools'],
    ];

    $benefitColumns = [
        [
            'Automate tasks',
            'Cut expenses',
            'Handle workload peaks',
            'Eliminate errors',
            'Free employees for strategic work',
            'Seamlessly integrate across tools',
            'Fast deployment & 24/7 operations',
        ],
        [
            'Reduced duplication of effort',
            'Drastic increase in turn-around time',
            'Significant increase in ROI',
            'Industry scenarios automated',
            'Built-in OCR for 100% accuracy',
            'Man hours saved & faster report processing',
        ],
    ];

    $industries = [
        [
            'title' => 'Healthcare',
            'image' => 'healthcare.webp',
            'alt' => 'Healthcare',
            'items' => [
                ['label' => 'Patient Scheduling', 'text' => 'Automate bookings and appointment reminders.'],
                ['label' => 'Claims Processing', 'text' => 'Speed up claim’s submissions and reimbursement cycles.'],
                ['label' => 'Patient Data Management', 'text' => 'Automatically update and validate Electronic Health Records (EHRs).'],
                ['label' => 'Regulatory Reporting', 'text' => 'Ensure compliance with healthcare regulations by automating reporting processes.'],
            ],
        ],
        [
            'title' => 'Financial Services',
            'image' => 'financial-business.webp',
            'alt' => 'Financial Business',
            'items' => [
                ['label' => 'Customer Onboarding', 'text' => 'Automate information verification and KYC (Know Your Customer) processes.'],
                ['label' => 'Loan Processing', 'text' => 'Automate data entry, document validation, and credit assessments.'],
                ['label' => 'Compliance and Reporting', 'text' => 'Streamline regulatory compliance tasks with automated reporting.'],
                ['label' => 'Fraud Detection', 'text' => 'Identify irregularities and streamline fraud prevention measures.'],
            ],
        ],
        [
            'title' => 'Manufacturing',
            'image' => 'manufacturing.webp',
            'alt' => 'Manufacturing',
            'items' => [
                ['label' => 'Inventory Management', 'text' => 'Automate stock level monitoring, reorders, and inventory reconciliation.'],
                ['label' => 'Order Processing', 'text' => 'Automate purchase orders and improve fulfillment times.'],
                ['label' => 'Quality Control', 'text' => 'Automate inspection data collection and ensure product quality.'],
                ['label' => 'Supply Chain Optimization', 'text' => 'Automate and track supply chain processes for better efficiency.'],
            ],
        ],
        [
            'title' => 'Transportation/Logistics',
            'image' => 'transportation-logistics.webp',
            'alt' => 'Transportation and logistics',
            'items' => [
                ['label' => 'Shipment Tracking', 'text' => 'Automate tracking updates and notifications.'],
                ['label' => 'Route Optimization', 'text' => 'Automate route planning and optimization for better fuel efficiency.'],
                ['label' => 'Inventory Management', 'text' => 'Automate stock tracking and restocking requests.'],
                ['label' => 'Billing and Invoicing', 'text' => 'Streamline billing, invoicing, and payment processing.'],
            ],
        ],
        [
            'title' => 'Retail',
            'image' => 'retail.webp',
            'alt' => 'Retail',
            'items' => [
                ['label' => 'Order Processing', 'text' => 'Automate order fulfillment, invoicing, and tracking.'],
                ['label' => 'Inventory Management', 'text' => 'Automate stock monitoring and restocking processes.'],
                ['label' => 'Customer Service', 'text' => 'Use RPA for managing customer queries and feedback.'],
                ['label' => 'Marketing Automation', 'text' => 'Automate promotional campaigns and customer engagement.'],
            ],
        ],
        [
            'title' => 'Banking',
            'image' => 'banking.webp',
            'alt' => 'Banking',
            'items' => [
                ['label' => 'Account Opening', 'text' => 'Automate data entry and verification for new accounts.'],
                ['label' => 'Loan Processing', 'text' => 'Speed up document checks and credit assessments.'],
                ['label' => 'Fraud Detection', 'text' => 'Use RPA to identify suspicious activity and mitigate risks.'],
                ['label' => 'Compliance Reporting', 'text' => 'Automate regulatory reporting and ensure compliance with industry standards.'],
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/robotics-process-automation.css'])
@endpush

@section('content')
    <div class="rpa-page">
        {{-- Hero --}}
        <section class="rpa-hero" aria-labelledby="rpa-hero-title">
            <div class="rpa-hero__media" aria-hidden="true">
                <img
                    src="{{ $img('rpa-banner.webp') }}"
                    alt=""
                    width="1920"
                    height="700"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
            <div class="site-shell rpa-hero__inner">
                <h1 id="rpa-hero-title">Unlock Greater Efficiency with Robotic Process Automation</h1>
                <p class="rpa-hero__lede">
                    Break Free from the Cycle of Repetitive and Manual Processes and Embrace Digital Transformation with RPA
                </p>
                <a href="#form-banner" class="rpa-btn rpa-btn--navy">Get A Quote</a>
            </div>
        </section>

        {{-- Intro --}}
        <section class="rpa-section rpa-intro" aria-labelledby="rpa-intro-title">
            <div class="site-shell">
                <div class="rpa-heading">
                    <h2 id="rpa-intro-title">Maximize Your Business Potential with RPA</h2>
                    <p>
                        Eliminate manual tasks and repetitive processes with Robotic Process Automation (RPA). Automate everything from data entry to extracting data from documents, web pages, emails, spreadsheets, and more. Seamlessly integrating with ERP, ECM, CRM, and other systems, RPA ensures smooth automation across all your workflows. It uses intelligent text recognition to deliver end-to-end RPA process automation at scale.
                    </p>
                    <p>
                        Empowering enterprises with agility and efficiency, RPA accelerates processes, boosts productivity, and <strong>significantly reduces operational costs</strong>.
                    </p>
                </div>
            </div>
        </section>

        {{-- Document management cards --}}
        <section class="rpa-section rpa-docs-section" aria-labelledby="rpa-docs-title">
            <div class="site-shell">
                <div class="rpa-heading">
                    <h2 id="rpa-docs-title">Changing Document Management with Intelligent Systems</h2>
                    <p>
                        Our systems streamline and optimize document-based workflows with ease using
                        <strong>robotic process</strong> automation:
                    </p>
                </div>

                <div
                    class="rpa-docs"
                    x-data="{ slide: 0, total: {{ count($docPages) }} }"
                >
                    <div class="rpa-docs__viewport">
                        <div
                            class="rpa-docs__track"
                            :style="'transform: translateX(-' + (slide * 100) + '%)'"
                        >
                            @foreach ($docPages as $pageIndex => $pageCards)
                                <div
                                    class="rpa-docs__page"
                                    role="list"
                                >
                                    @foreach ($pageCards as $card)
                                        <article class="rpa-doc-card rpa-doc-card--{{ $card['tone'] }}" role="listitem">
                                            <figure>
                                                @if ($card['url'])
                                                    <a href="{{ $card['url'] }}" tabindex="-1">
                                                        <img
                                                            src="{{ $img($card['file']) }}"
                                                            alt="{{ $card['alt'] }}"
                                                            width="65"
                                                            height="65"
                                                            loading="lazy"
                                                            decoding="async"
                                                        >
                                                    </a>
                                                @else
                                                    <img
                                                        src="{{ $img($card['file']) }}"
                                                        alt="{{ $card['alt'] }}"
                                                        width="65"
                                                        height="65"
                                                        loading="lazy"
                                                        decoding="async"
                                                    >
                                                @endif
                                            </figure>
                                            <h3>
                                                @if ($card['url'])
                                                    <a href="{{ $card['url'] }}">{{ $card['title'] }}</a>
                                                @else
                                                    {{ $card['title'] }}
                                                @endif
                                            </h3>
                                            <p>{{ $card['text'] }}</p>
                                        </article>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="rpa-docs__dots" role="tablist" aria-label="Document management slides">
                        @foreach ($docPages as $pageIndex => $pageCards)
                            <button
                                type="button"
                                class="rpa-docs__dot"
                                :class="{ 'is-active': slide === {{ $pageIndex }} }"
                                :aria-selected="slide === {{ $pageIndex }} ? 'true' : 'false'"
                                @click="slide = {{ $pageIndex }}"
                                aria-label="Show document management slide {{ $pageIndex + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Why RPA --}}
        <section class="rpa-section rpa-why" aria-labelledby="rpa-why-title">
            <div class="site-shell">
                <div class="rpa-heading">
                    <h2 id="rpa-why-title">Why is RPA the fastest-growing enterprise software?</h2>
                </div>
                <div class="rpa-why-grid" role="list">
                    @foreach ($whyItems as $item)
                        <article class="rpa-why-card" role="listitem">
                            <img
                                src="{{ $img($item['file']) }}"
                                alt="{{ $item['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Business benefits --}}
        <section class="rpa-benefits" aria-labelledby="rpa-benefits-title">
            <div class="site-shell rpa-benefits__inner">
                <div class="rpa-benefits__copy">
                    <h2 id="rpa-benefits-title">Business Benefits of RPA</h2>
                    <div class="rpa-benefits__lists">
                        @foreach ($benefitColumns as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="rpa-check" aria-hidden="true">
                                            <i class="fa-solid fa-square-check"></i>
                                        </span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <p>
                        Drive measurable ROI with <strong>RPA process</strong> automation. Streamline routine workflows, large and small, at speed and scale across your business. Bridge the automation gap securely with extensive integrations and governance at every step. Start automating today!
                    </p>
                    <a href="#form-banner" class="rpa-btn rpa-btn--green">GET STARTED NOW</a>
                </div>
                <div class="rpa-benefits__media">
                    <img
                        src="{{ $img('rpa-benefits.webp') }}"
                        alt="Business benefits of robotic process automation"
                        width="650"
                        height="650"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Industry applications --}}
        <section class="rpa-section rpa-industries" aria-labelledby="rpa-industries-title">
            <div class="site-shell">
                <div class="rpa-heading">
                    <h2 id="rpa-industries-title">Industry-Specific RPA Applications</h2>
                </div>

                <div
                    class="rpa-tabs"
                    x-data="{ active: 0 }"
                >
                    <div class="rpa-tabs__nav" role="tablist" aria-label="Industry-specific RPA applications" aria-orientation="vertical">
                        @foreach ($industries as $i => $industry)
                            <button
                                type="button"
                                class="rpa-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                id="rpa-tab-{{ $i }}"
                                role="tab"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="rpa-panel-{{ $i }}"
                                @click="active = {{ $i }}"
                                @keydown.arrow-down.prevent="active = {{ ($i + 1) % count($industries) }}"
                                @keydown.arrow-up.prevent="active = {{ ($i - 1 + count($industries)) % count($industries) }}"
                            >
                                <span>{{ $industry['title'] }}</span>
                                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>

                    <div class="rpa-tabs__panels">
                        @foreach ($industries as $i => $industry)
                            <div
                                class="rpa-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                                id="rpa-panel-{{ $i }}"
                                role="tabpanel"
                                aria-labelledby="rpa-tab-{{ $i }}"
                                :class="{ 'is-active': active === {{ $i }} }"
                                x-show="active === {{ $i }}"
                                x-cloak
                            >
                                <div class="rpa-tabs__media">
                                    <img
                                        src="{{ $img($industry['image']) }}"
                                        alt="{{ $industry['alt'] }}"
                                        width="520"
                                        height="347"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                                <div class="rpa-tabs__content">
                                    <h3>{{ $industry['title'] }}</h3>
                                    <ul>
                                        @foreach ($industry['items'] as $item)
                                            <li>
                                                <strong>{{ $item['label'] }}</strong>: {{ $item['text'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact / lead form --}}
        <section class="rpa-consult" id="form-banner" aria-labelledby="rpa-consult-title">
            <div class="site-shell rpa-consult__inner">
                <div class="rpa-consult__copy">
                    <h2 id="rpa-consult-title">Ready to Transform Your Business with RPA?</h2>
                    <p>
                        Unlock the full potential of Robotic Process Automation across your organization. Whether you're optimizing workflows in finance, healthcare, manufacturing, or any other industry, RPA helps you streamline processes, reduce costs, and drive efficiency at scale.
                    </p>
                    <p>
                        <strong>Get Started Today</strong> – Book your <strong>Free Consultation Call</strong> and discover how RPA can accelerate your digital transformation!
                    </p>
                    
                </div>

                <aside class="rpa-consult__card" aria-labelledby="rpa-form-title">
                    <h2 id="rpa-form-title" class="sr-only">Request an RPA quote</h2>
                    <livewire:forms.contact-form
                        form-name="robotics-process-automation"
                        id-prefix="rpa"
                        :show-company="true"
                        :show-service="false"
                        message-placeholder="Project Description"
                        submit-label="Submit"
                        layout="default"
                        :message-rows="2"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
