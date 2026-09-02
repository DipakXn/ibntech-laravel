@php
    $img = fn (string $file): string => asset('images/empowering-business-processes/'.$file);
    $formAnchor = 'hero-form-section';
    $formServiceOptions = [
        'F&A',
        'Bookkeeping',
        'AP/AR',
        'AP Automation',
        'Payroll',
        'Tax Preparation Support',
        'Year-end Accounting',
        'Catch-up Bookkeeping',
    ];

    $solutions = [
        [
            'file' => 'invoice-action.webp',
            'alt' => 'Invoice Action',
            'title' => 'Invoice Action',
            'text' => 'Automate invoice processing and streamline accounts payable (AP) workflows, ensuring faster approvals, improved accuracy, and reduced costs.',
        ],
        [
            'file' => 'order-action.webp',
            'alt' => 'Order Action',
            'title' => 'Order Action',
            'text' => 'Optimize sales and purchase order processing with advanced automation to enhance accuracy, streamline workflows, and increase customer satisfaction.',
        ],
        [
            'file' => 'claim-action.webp',
            'alt' => 'Claim Action',
            'title' => 'Claim Action',
            'text' => 'Simplify medical claims processing with our automation solution, ensuring compliance, accuracy, and quicker reimbursements.',
        ],
        [
            'file' => 'artsy-lpay.webp',
            'alt' => 'Artsy lPay',
            'title' => 'Artsyl Pay',
            'text' => 'Streamline payment processing with efficient, integrated solutions that save time and money while enabling rebate opportunities.',
        ],
        [
            'file' => 'remittance-action.webp',
            'alt' => 'Remittance Action',
            'title' => 'Remittance Action',
            'text' => 'Reduce manual effort and errors in check processing and remittance handling through AI-powered automation and OCR technology.',
        ],
        [
            'file' => 'expense-action.webp',
            'alt' => 'Expense Action',
            'title' => 'Expense Action',
            'text' => 'Automate expense tracking and reimbursement processes with intuitive tools that simplify management and enhance transparency.',
        ],
    ];

    $benefitColumns = [
        [
            'Boost Employee Productivity',
            'Seamless Document Processing',
            'Enhanced Operational Efficiency',
            'Cost Savings Through Optimization',
            'Faster Reporting and Insights',
            'Optimized Resource Allocation',
        ],
        [
            'Improved Data Accuracy',
            'Reduced Manual Intervention',
            'Enhanced Compliance and Security',
            'Scalable Automation Solutions',
            'Real-Time Performance Insights',
            'Accelerated Business Decision-Making',
        ],
    ];

    $trustTabs = [
        [
            'title' => 'Seamless ERP and DMS Integration',
            'text' => 'Streamline operations with tight integration into your accounting and document management systems, ensuring smooth data flow and accuracy.',
        ],
        [
            'title' => 'Enhanced Visibility and Control',
            'text' => 'Gain real-time insights and analytics to monitor, optimize, and control document workflows for improved ROI and operational performance.',
        ],
        [
            'title' => 'Proven ROI and Cost Savings',
            'text' => 'Achieve significant cost and time savings with optimized document workflows, delivering measurable ROI and transformative business results.',
        ],
        [
            'title' => 'Flexible Deployment Options',
            'text' => 'Experience unmatched flexibility with SaaS Cloud and On-Prem models. Whether you prefer cloud-based accessibility or on-premise control, our low-code IDP platform adapts to your needs.',
        ],
        [
            'title' => 'Intelligent Data Extraction',
            'text' => 'Automate data capture and validation with intelligent technology, minimizing manual intervention and reducing errors.',
        ],
        [
            'title' => 'Advanced Technology',
            'text' => 'Leverage cutting-edge AI, machine learning, and RPA to automate workflows, enhance efficiency, and ensure accuracy across your document processes.',
        ],
        [
            'title' => 'Workflow Optimization',
            'text' => 'Tailor workflows to your unique business needs with customizable automation rules, delivering efficiency and process streamlining.',
        ],
        [
            'title' => 'Continuous Innovation',
            'text' => 'Stay ahead with regular updates and the latest advancements in document automation technology to keep your processes cutting-edge.',
        ],
        [
            'title' => 'Pre-Built Solutions',
            'text' => 'Reduce implementation time and costs with pre-built solutions tailored for documents like invoices, orders, receipts, checks, and medical claims.',
        ],
        [
            'title' => 'Robust Security',
            'text' => 'Protect sensitive data with advanced security measures, ensuring compliance with industry regulations and standards.',
        ],
        [
            'title' => 'Scalability',
            'text' => 'Easily scale your document processing to meet growing business demands and handle increased document volumes effortlessly.',
        ],
    ];

    $erpLogos = [
        ['src' => asset('images/ap-ar-automation/sap.webp'), 'alt' => 'sap'],
        ['src' => asset('images/real-estate-construction-bookkeeping-services/sage50.webp'), 'alt' => 'sage'],
        ['src' => asset('images/real-estate-construction-bookkeeping-services/quickbooks.webp'), 'alt' => 'Quickbooks'],
        ['src' => asset('images/real-estate-construction-bookkeeping-services/netsuite.webp'), 'alt' => 'netsuite'],
        ['src' => asset('images/real-estate-construction-bookkeeping-services/microsoft-dynamics-gp.webp'), 'alt' => 'microsoft-dynamic'],
        ['src' => asset('images/ap-ar-automation/acumatica.webp'), 'alt' => 'logo-acumatica-MC-D'],
    ];

    $industries = [
        [
            'title' => 'Construction and Real Estate',
            'file' => 'Real-Estate-4.webp',
            'alt' => 'real estate',
            'reason' => 'These industries involve complex billing structures, multiple stakeholders, and numerous subcontractors, leading to a high volume of invoices and varying payment schedules.',
            'benefit' => 'AP automation provides better visibility into outstanding payments, supports document management for compliance purposes, and enables smooth workflows even across decentralized projects.',
        ],
        [
            'title' => 'Logistics and Transportation',
            'file' => 'logistics.webp',
            'alt' => 'Logistics',
            'reason' => 'Transportation companies often deal with a large volume of recurring invoices, complex billing arrangements, and time-sensitive payments, all of which make AP processes cumbersome.',
            'benefit' => 'Automation can help reduce delays, avoid duplicate payments, and improve tracking of expenses, which is critical for a sector with tight margins and a high dependency on operational efficiency.',
        ],
        [
            'title' => 'Retail and E-commerce',
            'file' => 'Retail.webp',
            'alt' => 'retail',
            'reason' => 'Retailers often handle a high volume of invoices across multiple locations and suppliers, which can be challenging to manage manually.',
            'benefit' => 'Automating AP allows for better cash flow management, faster invoice processing, and improved vendor management. Retailers can also capture early payment discounts, reducing costs in the long term.',
        ],
        [
            'title' => 'Nonprofits and Education',
            'file' => 'education.webp',
            'alt' => 'Education',
            'reason' => 'Nonprofits and educational institutions often have tight budgets, require transparency in spending, and rely on accurate reporting for funding and compliance.',
            'benefit' => 'AP automation can help manage expenses efficiently, provide clear audit trails for regulatory compliance, and reduce administrative overhead, enabling more funds to go toward their missions.',
        ],
        [
            'title' => 'Healthcare and Pharmaceuticals',
            'file' => 'healthcare.webp',
            'alt' => 'healthcare',
            'reason' => 'These industries deal with a large number of suppliers, regulatory requirements, and complex approval processes. They also face high risks of compliance issues, making accuracy and auditability crucial.',
            'benefit' => 'AP automation helps healthcare and pharma companies manage vendor relationships, ensure regulatory compliance, and maintain clear audit trails, which is vital for meeting industry standards.',
        ],
        [
            'title' => 'Energy and Utilities',
            'file' => 'energy-utilities.webp',
            'alt' => 'Energy & Utilities',
            'reason' => 'These companies manage complex vendor networks and process numerous invoices for infrastructure maintenance, fuel, and equipment.',
            'benefit' => 'AP automation helps track costs, streamline workflows, and maintain compliance, essential for effective budgeting and reporting in a highly regulated industry.',
        ],
        [
            'title' => 'Financial Services',
            'file' => 'costly-mistakes.webp',
            'alt' => 'costly mistakes',
            'reason' => 'Financial institutions process high volumes of vendor invoices and must comply with strict regulatory requirements, making accurate AP tracking and auditing crucial.',
            'benefit' => 'Automating AP helps improve data accuracy, reduces the time spent on invoice processing, and enhances audit readiness, all of which are vital for financial compliance and transparency.',
        ],
        [
            'title' => 'Hospitality',
            'file' => 'Hospitality.webp',
            'alt' => 'hospitality',
            'reason' => 'The hospitality sector processes numerous invoices for suppliers, maintenance, food, and other services, especially for hotels and chains with multiple properties.',
            'benefit' => 'AP automation helps reduce operational costs, streamline approvals, and ensure timely payments, which is essential for maintaining strong vendor relationships and smooth operations.',
        ],
        [
            'title' => 'Manufacturing',
            'file' => 'Manufacturing.webp',
            'alt' => 'Manufacturing',
            'reason' => 'Manufacturing companies often have high-volume transactions with numerous suppliers for raw materials, parts, and services. AP automation can help streamline invoice processing, reduce errors, and improve supplier relationships.',
            'benefit' => 'Faster invoice approvals, real-time expense tracking, and more accurate financial reporting can significantly improve cash flow and operational efficiency.',
        ],
    ];

    $logoCount = count($erpLogos);
    $tabCount = count($trustTabs);
    $industryCount = count($industries);
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation.css'])
@endpush

@section('content')
    <div class="ebpa-page">
        <section class="ebpa-hero" aria-labelledby="ebpa-hero-title">
            <div class="site-shell ebpa-hero__inner">
                <div class="ebpa-hero__copy">
                    <a class="ebpa-hero__call" href="tel:+18446448440" aria-label="Call IBN Technologies at +1 844 644 8440">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    </a>
                    <h1 id="ebpa-hero-title">Empowering Business Processes with AI, ML, and RPA-Driven Cloud Automation</h1>
                    <p class="ebpa-hero__lede">
                        Streamline workflows, automate document processes, and boost efficiency across multiple document types and industries with our Intelligent Automation Solutions.
                    </p>
                </div>

                <aside class="ebpa-hero__form" id="{{ $formAnchor }}" aria-labelledby="ebpa-form-title">
                    <h2 id="ebpa-form-title">More Than Just Accounting &amp; Bookkeeping</h2>
                    <p class="ebpa-hero__form-sub">For Business Owners &amp; Founders</p>
                    <livewire:forms.contact-form
                        form-name="empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation"
                        id-prefix="ebpa"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="Tell us how we can help"
                        submit-label="BOOK YOUR FREE DEMO NOW"
                        layout="home"
                        :message-rows="3"
                    />
                </aside>
            </div>
        </section>

        <section class="ebpa-intro" aria-labelledby="ebpa-intro-title">
            <div class="site-shell">
                <div class="ebpa-intro__card">
                    <h2 id="ebpa-intro-title" class="sr-only">Intelligent automation with docAlpha</h2>
                    <p>
                        IBN Technologies specializes in transforming business operations through advanced AI, machine learning (ML), and robotic process automation (RPA). Our flagship platform, docAlpha, streamlines document processing for invoices, purchase orders, medical claims, reports, and more.
                    </p>
                    <p>
                        By seamlessly integrating with ERP and DMS systems, <strong>docAlpha</strong> captures, classifies, and validates structured and unstructured data, delivering unmatched accuracy, efficiency, and cost savings.
                    </p>
                </div>
            </div>
        </section>

        <section class="ebpa-section" aria-labelledby="ebpa-solutions-title">
            <div class="site-shell">
                <div class="ebpa-heading">
                    <h2 id="ebpa-solutions-title">Automation Solutions to Simplify and Streamline Your Business Processes</h2>
                </div>
                <div class="ebpa-solutions">
                    @foreach ($solutions as $item)
                        <article class="ebpa-solution">
                            <img
                                src="{{ $img($item['file']) }}"
                                alt="{{ $item['alt'] }}"
                                width="122"
                                height="88"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="ebpa-benefits" aria-labelledby="ebpa-benefits-title">
            <div class="site-shell ebpa-benefits__inner">
                <div class="ebpa-benefits__copy">
                    <h2 id="ebpa-benefits-title">Proven Benefits of Our Intelligent Automation Solutions</h2>
                    <div class="ebpa-benefits__lists">
                        @foreach ($benefitColumns as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="ebpa-check" aria-hidden="true">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="ebpa-benefits__media">
                    <img
                        src="{{ $img('proven-benefits-of-our-intelligent-automation-solutions.webp') }}"
                        alt="Proven Benefits of Our Intelligent Automation Solutions"
                        width="540"
                        height="540"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="ebpa-cta-cream" aria-labelledby="ebpa-cta-cream-title">
            <div class="site-shell ebpa-cta-cream__inner">
                <h2 id="ebpa-cta-cream-title">Simple Document Processing Starts Here</h2>
                <p>Discover how our intelligent automation tools can save you time, reduce errors, and boost efficiency. Schedule a demo today and experience the power of AI-driven automation with the docAlpha IPA platform.</p>
                <a class="ebpa-btn ebpa-btn--navy" href="#{{ $formAnchor }}">BOOK YOUR FREE DEMO NOW</a>
            </div>
        </section>

        <section class="ebpa-section ebpa-workflow" aria-labelledby="ebpa-workflow-title">
            <div class="site-shell">
                <div class="ebpa-heading">
                    <h2 id="ebpa-workflow-title">Transforming Manual Tasks into Seamless Automated Workflows</h2>
                </div>
                <img
                    class="ebpa-workflow__image"
                    src="{{ $img('web-gif-0001-1.gif') }}"
                    alt="Transforming Manual Tasks into Seamless Automated Workflows"
                    width="1920"
                    height="1080"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>

        <section class="ebpa-section ebpa-trust" aria-labelledby="ebpa-trust-title">
            <div class="site-shell">
                <div class="ebpa-heading">
                    <h2 id="ebpa-trust-title">Why Businesses Trust Us for Document-Centric Process Automation</h2>
                </div>

                <div class="ebpa-tabs" x-data="{ active: 0 }">
                    <div class="ebpa-tabs__nav" role="tablist" aria-label="Why businesses trust IBN for document automation">
                        @foreach ($trustTabs as $i => $tab)
                            <button
                                type="button"
                                class="ebpa-tabs__tab{{ $i === 0 ? ' is-active' : '' }}"
                                id="ebpa-tab-{{ $i }}"
                                role="tab"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="ebpa-panel-{{ $i }}"
                                @click="active = {{ $i }}"
                                @keydown.arrow-right.prevent="active = {{ ($i + 1) % $tabCount }}"
                                @keydown.arrow-left.prevent="active = {{ ($i - 1 + $tabCount) % $tabCount }}"
                            >
                                <span>{{ $tab['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    @foreach ($trustTabs as $i => $tab)
                        <div
                            class="ebpa-tabs__panel{{ $i === 0 ? ' is-active' : '' }}"
                            id="ebpa-panel-{{ $i }}"
                            role="tabpanel"
                            aria-labelledby="ebpa-tab-{{ $i }}"
                            :class="{ 'is-active': active === {{ $i }} }"
                            x-show="active === {{ $i }}"
                            x-cloak
                        >
                            <h3>{{ $tab['title'] }}</h3>
                            <p>{{ $tab['text'] }}</p>
                            <a class="ebpa-btn ebpa-btn--navy" href="#{{ $formAnchor }}">BOOK YOUR FREE DEMO NOW</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="ebpa-cta-green" aria-labelledby="ebpa-cta-green-title">
            <div class="site-shell ebpa-cta-green__inner">
                <h2 id="ebpa-cta-green-title">Seamless ERP and DMS Integration</h2>
                <p>Streamline operations with tight integration into your accounting and document management systems, ensuring smooth data flow and accuracy.</p>
                <a class="ebpa-btn ebpa-btn--navy" href="#{{ $formAnchor }}">BOOK YOUR FREE DEMO NOW</a>
            </div>
        </section>

        <section
            class="ebpa-section ebpa-logos"
            aria-labelledby="ebpa-logos-title"
            x-data="{
                index: 0,
                perView: 5,
                total: {{ $logoCount }},
                resize() {
                    this.perView = window.innerWidth < 640 ? 2 : (window.innerWidth < 900 ? 3 : 5);
                    this.index = Math.min(this.index, Math.max(0, this.total - this.perView));
                },
                prev() { this.index = Math.max(0, this.index - 1); },
                next() { this.index = Math.min(this.total - this.perView, this.index + 1); },
            }"
            x-init="resize(); window.addEventListener('resize', () => resize())"
        >
            <div class="site-shell">
                <div class="ebpa-heading">
                    <h2 id="ebpa-logos-title">Effortless Workflow Integration with Leading ERP and DMS Systems</h2>
                    <p>Streamline workflows with intelligent automation and real-time integration into leading ERP and DMS systems</p>
                </div>

                <div class="ebpa-logos__slider">
                    <button type="button" class="ebpa-logos__arrow" @click="prev()" :disabled="index === 0" aria-label="Previous logos">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>
                    <div class="ebpa-logos__viewport">
                        <ul
                            class="ebpa-logos__track"
                            :style="`transform: translateX(-${index * (100 / perView)}%)`"
                        >
                            @foreach ($erpLogos as $logo)
                                <li :style="`flex: 0 0 calc(100% / ${perView})`">
                                    <img src="{{ $logo['src'] }}" alt="{{ $logo['alt'] }}" width="180" height="80" loading="lazy" decoding="async">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="ebpa-logos__arrow" @click="next()" :disabled="index >= total - perView" aria-label="Next logos">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="ebpa-logos__dots" role="tablist" aria-label="Logo slides">
                    @foreach ($erpLogos as $i => $logo)
                        <button
                            type="button"
                            :class="{ 'is-active': index === {{ $i }} }"
                            :aria-current="index === {{ $i }} ? 'true' : 'false'"
                            @click="index = Math.min({{ $i }}, Math.max(0, total - perView))"
                            aria-label="Show logo {{ $i + 1 }}"
                        ></button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="ebpa-cta-navy" aria-labelledby="ebpa-cta-navy-title">
            <div class="site-shell ebpa-cta-navy__inner">
                <div>
                    <h2 id="ebpa-cta-navy-title">Get Started with a Free, No-Obligation Demo</h2>
                    <p>Discover how our intelligent automation solutions can optimize workflows and drive productivity across your organization.</p>
                </div>
                <a class="ebpa-btn ebpa-btn--green" href="#{{ $formAnchor }}">BOOK YOUR FREE DEMO NOW</a>
            </div>
        </section>

        <section
            class="ebpa-industries"
            aria-labelledby="ebpa-industries-title"
            x-data="{ active: 0 }"
        >
            <div class="site-shell">
                <div class="ebpa-heading">
                    <h2 id="ebpa-industries-title">Tailored Solutions for Every Industry</h2>
                    <p>We help organizations across various industries streamline document processing and ensure compliance. AP automation is especially impactful for sectors with high-volume, complex accounts payable operations, driving efficiency and better outcomes.</p>
                </div>

                <div class="ebpa-industries__layout">
                    <div class="ebpa-industries__grid" role="tablist" aria-label="Industries">
                        @foreach ($industries as $i => $industry)
                            <button
                                type="button"
                                class="ebpa-industry{{ $i === 0 ? ' is-active' : '' }}"
                                id="ebpa-industry-tab-{{ $i }}"
                                role="tab"
                                :class="{ 'is-active': active === {{ $i }} }"
                                :aria-selected="active === {{ $i }} ? 'true' : 'false'"
                                :tabindex="active === {{ $i }} ? 0 : -1"
                                aria-controls="ebpa-industry-panel"
                                @click="active = {{ $i }}"
                                @keydown.arrow-right.prevent="active = {{ ($i + 1) % $industryCount }}"
                                @keydown.arrow-left.prevent="active = {{ ($i - 1 + $industryCount) % $industryCount }}"
                            >
                                <img
                                    src="{{ $img($industry['file']) }}"
                                    alt=""
                                    width="75"
                                    height="75"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <span>{{ $industry['title'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div
                        class="ebpa-industries__panel"
                        id="ebpa-industry-panel"
                        role="tabpanel"
                        :aria-labelledby="'ebpa-industry-tab-' + active"
                    >
                        @foreach ($industries as $i => $industry)
                            <div x-show="active === {{ $i }}" x-cloak>
                                <h3>{{ $industry['title'] }}</h3>
                                <ul>
                                    <li>
                                        <p><strong>Reason: </strong>{{ $industry['reason'] }}</p>
                                    </li>
                                    <li>
                                        <p><strong>Benefit: </strong>{{ $industry['benefit'] }}</p>
                                    </li>
                                </ul>
                                <a class="ebpa-btn ebpa-btn--navy" href="#{{ $formAnchor }}">BOOK YOUR FREE DEMO NOW</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
