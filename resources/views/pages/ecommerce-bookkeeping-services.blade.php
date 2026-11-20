@php
    $img = fn (string $file): string => asset('images/ecommerce-bookkeeping-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Accounting Services',
        'Payroll Processing',
        'Accounts Payable and Receivable',
        'Tax Preparation Support',
        'Financial Reporting',
        'Controller Services',
    ];

    $serviceColumns = [
        [
            'Sales Tracking Across Multiple Platforms',
            'Payment Gateway Reconciliation',
            'Inventory Management Integration',
            'Expense Management',
            'Monthly and Year-End Close',
        ],
        [
            'Accounts Payable and Receivable',
            'Bank and Credit Card Reconciliation',
            'Tax-Ready Financial Statements',
            'Sales Tax Compliance',
            'Financial Reporting and Insights',
        ],
    ];

    $challenges = [
        [
            'icon' => 'sales-tax-compliance.webp',
            'alt' => 'Sales Tax Compliance',
            'title' => 'Sales Tax Compliance',
            'text' => 'Avoid penalties with accurate tax handling and compliance',
        ],
        [
            'icon' => 'high-volume-transactions.webp',
            'alt' => 'High-Volume Transactions',
            'title' => 'High-Volume Transactions',
            'text' => 'Efficiently manage large transaction volumes',
        ],
        [
            'icon' => 'currency-and-global-sales.webp',
            'alt' => 'Currency and Global Sales',
            'title' => 'Currency and Global Sales',
            'text' => 'Handle currency conversions and international rules',
        ],
        [
            'icon' => 'inventory-management.webp',
            'alt' => 'Inventory Management',
            'title' => 'Inventory Management',
            'text' => 'Track stock levels and avoid over/understocking',
        ],
        [
            'icon' => 'multiple-payment-channels.webp',
            'alt' => 'Multiple Payment Channels',
            'title' => 'Multiple Payment Channels',
            'text' => 'Integrate and Reconcile transactions across multiple platforms',
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'e-commerce-expertise.webp',
            'alt' => 'E-Commerce Expertise',
            'title' => 'E-Commerce Expertise',
            'text' => '20+ years of experience handling high transaction volumes, multi-channel sales, and inventory fluctuations for platforms like Amazon, Shopify, eBay, Etsy, and Walmart',
        ],
        [
            'icon' => 'simple-process-driven-and-reliable.webp',
            'alt' => 'Simple, Process-Driven, and Reliable',
            'title' => 'Simple, Process-Driven, and Reliable',
            'text' => 'We use proven, streamlined systems that simplify bookkeeping and grow with your business',
        ],
        [
            'icon' => '24-7-fast-and-proactive-support.webp',
            'alt' => '24-7 Fast and Proactive Support',
            'title' => '24/7 Fast and Proactive Support',
            'text' => 'Our team offers around-the-clock assistance, delivering quick communication and proactive financial insights',
        ],
        [
            'icon' => 'monthly-financial-analysis.webp',
            'alt' => 'Monthly Financial Analysis',
            'title' => 'Monthly Financial Analysis',
            'text' => 'Receive monthly financial analysis to gain deeper insights into your business performance and make smarter decisions',
        ],
        [
            'icon' => 'tech-integration.webp',
            'alt' => 'Tech Integration',
            'title' => 'Tech Integration',
            'text' => 'Seamless integration with QuickBooks, Xero, and your sales tools for real-time data tracking and enhanced accuracy',
        ],
    ];

    $benefitColumns = [
        [
            'Gain clarity on your finances',
            'Build a stable, sustainable, and profitable business',
            'Better manage cash flow, even in tough times',
            'Forecast cash flow and inventory needs accurately',
        ],
        [
            'Avoid tax penalties and fines',
            'Make data-driven business decisions',
            'Spot trends and address issues early',
            'Use data to boost customer lifetime value',
        ],
    ];

    $testimonials = \App\Support\Testimonials\Testimonials::cites('ecommerce-bookkeeping-services');

    $checkSvg = '<svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>';
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/ecommerce-bookkeeping-services.css'])
@endpush

@section('content')
    <div class="ecbk-page">
        {{-- Hero --}}
        <section class="ecbk-hero" aria-labelledby="ecbk-hero-title">
            <div class="site-shell ecbk-hero__inner">
                <div class="ecbk-hero__copy">
                    <h1 id="ecbk-hero-title">Ecommerce Bookkeeping Services</h1>
                    <p class="ecbk-hero__lede">
                        Efficiently manage your eBay, Amazon, Shopify bookkeeping, or any other e-commerce platform with our specialized services, offering precise sales tracking, expense management, and seamless tax compliance.
                    </p>
                    <a href="#" class="ecbk-btn ecbk-btn--green" data-contact-modal-trigger>
                        GET STARTED
                    </a>
                </div>

                <aside class="ecbk-hero__form" id="contact-us" aria-labelledby="ecbk-hero-form-title">
                    <p class="ecbk-hero__form-title" id="ecbk-hero-form-title">Want to Improve Your Accounting ?</p>
                    <p class="ecbk-hero__form-sub">Submit the Form to Get Started!</p>

                    <livewire:forms.contact-form
                        form-name="ecommerce-bookkeeping-services"
                        id-prefix="ecbk"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        {{-- Intro card --}}
        <section class="ecbk-intro" aria-labelledby="ecbk-intro-title">
            <div class="site-shell">
                <div class="ecbk-intro__card">
                    <h2 id="ecbk-intro-title">
                        Expert Bookkeeping Services for E-Commerce with Seamless Platform Integration
                    </h2>
                    <p>
                        With over 26 years of experience in the USA and UK, we specialize in providing tailored bookkeeping services for the e-commerce industry. Our solutions seamlessly integrate with your e-commerce platforms, payment gateways, and inventory systems, ensuring accurate, up-to-date financial records. We help streamline your financial operations, giving you the insights you need to make informed decisions and grow your business efficiently
                    </p>
                </div>
            </div>
        </section>

        {{-- Comprehensive services --}}
        <section class="ecbk-section" aria-labelledby="ecbk-services-title">
            <div class="site-shell ecbk-services">
                <div class="ecbk-services__copy">
                    <h2 id="ecbk-services-title">
                        Our Comprehensive Outsourced Ecommerce Bookkeeping Services
                    </h2>
                    <div class="ecbk-services__lists">
                        @foreach ($serviceColumns as $column)
                            <ul>
                                @foreach ($column as $item)
                                    <li>
                                        <span class="ecbk-check" aria-hidden="true">{!! $checkSvg !!}</span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="ecbk-services__media">
                    <img
                        src="{{ $img('our-comprehensive-outsourced-ecommerce-bookkeeping-services.webp') }}"
                        alt="Our Comprehensive Outsourced Ecommerce Bookkeeping Services"
                        width="1000"
                        height="1000"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Platforms --}}
        <section class="ecbk-section ecbk-platforms-wrap" aria-labelledby="ecbk-platforms-title">
            <div class="site-shell ecbk-platforms">
                <div class="ecbk-platforms__media">
                    <img
                        src="{{ $img('we-support-all-e-commerce-platforms.png') }}"
                        alt="We Support All E-Commerce Platforms"
                        width="1080"
                        height="704"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="ecbk-platforms__copy">
                    <h2 id="ecbk-platforms-title">We Support All E-Commerce Platforms</h2>
                    <p>Seamlessly Integrate Your Sales Channels with QuickBooks Online or Xero</p>
                    <a href="#" class="ecbk-btn ecbk-btn--green" data-contact-modal-trigger>
                        GET STARTED
                    </a>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="ecbk-cta-banner" aria-labelledby="ecbk-cta-title">
            <div class="site-shell ecbk-cta-banner__inner">
                <h2 id="ecbk-cta-title">
                    Don’t miss a chance to streamline your finances—bookkeeping made easy for ecommerce!
                </h2>
                <a href="#" class="ecbk-btn ecbk-btn--green" data-contact-modal-trigger>
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Challenges --}}
        <section class="ecbk-section ecbk-challenges-wrap" aria-labelledby="ecbk-challenges-title">
            <div class="site-shell">
                <div class="ecbk-heading ecbk-heading--center">
                    <h2 id="ecbk-challenges-title">
                        How Outsourcing Solves E-Commerce Bookkeeping Challenges:
                    </h2>
                </div>

                <div class="ecbk-challenges" role="list">
                    @foreach ($challenges as $item)
                        <article class="ecbk-challenge" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="173"
                                height="167"
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

        {{-- Software Expertise --}}
        <section class="ecbk-section ecbk-software" aria-labelledby="ecbk-software-title">
            <div class="site-shell">
                <h2 id="ecbk-software-title" class="ecbk-software__title">
                    <span>Software</span>
                    <span class="ecbk-software__accent">Expertise</span>
                </h2>
                <div class="ecbk-software__media">
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

        {{-- Why Choose --}}
        <section class="ecbk-section ecbk-why" aria-labelledby="ecbk-why-title">
            <div class="site-shell">
                <div class="ecbk-heading ecbk-heading--center">
                    <h2 id="ecbk-why-title">
                        Why Choose Our E-Commerce Bookkeeping Services?
                    </h2>
                </div>

                <div class="ecbk-why__grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="ecbk-why__card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="173"
                                height="167"
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

        {{-- Benefits + pricing CTA --}}
        <section class="ecbk-benefits" aria-labelledby="ecbk-benefits-title">
            <div class="site-shell">
                <div class="ecbk-benefits__top">
                    <div class="ecbk-benefits__copy">
                        <h2 id="ecbk-benefits-title">Benefits of Bookkeeping for E-Commerce</h2>
                        <div class="ecbk-benefits__lists">
                            @foreach ($benefitColumns as $column)
                                <ul>
                                    @foreach ($column as $item)
                                        <li>
                                            <span class="ecbk-benefits__check" aria-hidden="true">{!! $checkSvg !!}</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <div class="ecbk-benefits__media">
                        <img
                            src="{{ $img('benefits-of-bookkeeping-for-e-commerce.webp') }}"
                            alt="Benefits of Bookkeeping for E-Commerce"
                            width="1080"
                            height="1080"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>

                <div class="ecbk-pricing">
                    <div class="ecbk-pricing__copy">
                        <h3>Started at just $10/Hour!</h3>
                        <p>
                            Experience efficient bookkeeping with automation, seamless e-commerce integration, and top-tier data security, compliant with GDPR, CCPA, and other data protection laws
                        </p>
                    </div>
                    <a href="#" class="ecbk-btn ecbk-btn--green" data-contact-modal-trigger>
                        GET STARTED NOW
                    </a>
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section class="ecbk-testimonials" aria-labelledby="ecbk-testimonials-title">
            <div class="site-shell">
                <div class="ecbk-heading ecbk-heading--center">
                    <p class="ecbk-testimonials__eyebrow">Our Clients Believe In Us</p>
                    <h2 id="ecbk-testimonials-title">HERE IS WHAT THEY ARE SAYING</h2>
                </div>

                <div
                    class="ecbk-testimonials__carousel"
                    x-data="{
                        index: 0,
                        total: {{ count($testimonials) }},
                        prev() { this.index = (this.total > 0 ? (this.index - 1 + this.total) % this.total : 0); },
                        next() { this.index = (this.total > 0 ? (this.index + 1) % this.total : 0); }
                    }"
                >
                    <button
                        type="button"
                        class="ecbk-testimonials__nav ecbk-testimonials__nav--prev"
                        @click="prev()"
                        aria-label="Previous testimonial"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="ecbk-testimonials__viewport">
                        @foreach ($testimonials as $i => $item)
                            <blockquote
                                class="ecbk-testimonial{{ $i === 0 ? ' is-active' : '' }}"
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
                        class="ecbk-testimonials__nav ecbk-testimonials__nav--next"
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
