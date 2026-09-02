@php
    $img = fn (string $file): string => asset('images/data-entry/'.$file);
    $industryImg = fn (string $file): string => asset('images/bpo-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $services = [
        [
            'file' => 'financial-data-entry.webp',
            'alt' => 'financial data entry',
            'title' => 'Financial Data Entry',
            'text' => 'Elevate your financial accuracy and compliance with expert management of all financial records.',
        ],
        [
            'file' => 'online-data-entry.webp',
            'alt' => 'online data entry',
            'title' => 'Online Data Entry',
            'text' => 'Keep your digital platforms up-to-date and reliable with our efficient online data entry services.',
        ],
        [
            'file' => 'offline-data-entry.webp',
            'alt' => 'offline data entry',
            'title' => 'Offline Data Entry',
            'text' => 'Transform your hard copy documents into organized, digital formats for improved accessibility and efficiency.',
        ],
        [
            'file' => 'e-commerce.webp',
            'alt' => 'e-commerce',
            'title' => 'E-commerce Data Entry',
            'text' => 'Boost your e-commerce success with precise product listing and data management.',
        ],
        [
            'file' => 'data-capture.webp',
            'alt' => 'data capture',
            'title' => 'Data Capture and Data Collection',
            'text' => 'Gain valuable insights with our advanced data capture and collection services for strategic business decisions.',
        ],
        [
            'file' => 'form-data-entry.webp',
            'alt' => 'form data entry',
            'title' => 'Form Data Entry',
            'text' => 'Streamline the processing of surveys, applications, and registrations with our accurate form data entry.',
        ],
    ];

    $benefits = [
        [
            'file' => 'precision-driven-results.webp',
            'alt' => 'precision-driven results',
            'title' => 'Precision-Driven Results',
            'text' => 'Achieve unparalleled accuracy in data management, crucial for data-reliant business strategies',
        ],
        [
            'file' => 'cost-efficiency.webp',
            'alt' => 'cost efficiency',
            'title' => 'Cost Efficiency',
            'text' => 'Reduce overhead costs significantly by eliminating the need for in-house data management infrastructure.',
        ],
        [
            'file' => 'quick-turnaround.webp',
            'alt' => 'quick turnaround',
            'title' => 'Quick Turnaround',
            'text' => 'Swift data processing and delivery to enhance your team\'s productivity and decision-making speed.',
        ],
        [
            'file' => 'expert-team.webp',
            'alt' => 'expert team',
            'title' => 'Expert Team',
            'text' => 'Benefit from a team of experienced data professionals, ensuring high-quality data handling and management.',
        ],
        [
            'file' => 'informed-decision-making.webp',
            'alt' => 'informed decision-making',
            'title' => 'Informed Decision-Making',
            'text' => 'Empower strategic decision-making with accurate and timely data at your fingertips.',
        ],
        [
            'file' => 'uninterrupted-business.webp',
            'alt' => 'uninterrupted business',
            'title' => 'Uninterrupted Business Operations',
            'text' => 'Ensure continuous business productivity with our round-the-clock data entry services.',
        ],
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
            'slug' => 'manufacturing-accounting-and-bookkeeping-services',
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
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/data-entry.css'])
@endpush

@section('content')
    <div class="de-page">
        {{-- Hero --}}
        <section class="de-hero" aria-labelledby="de-hero-title">
            <div class="site-shell de-hero__inner">
                <div class="de-hero__copy">
                    <p class="de-eyebrow">Say Goodbye to Data Management Challenges</p>
                    <h1 id="de-hero-title">Outsource Data Entry Services</h1>
                    <p class="de-hero__lede">
                        Get Reliable, Accurate, and Cost-Effective Data Solutions with IBN Tech
                    </p>
                    <div class="de-hero__actions">
                        <a href="#request-form-demo" class="de-btn de-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="de-hero__media">
                    <img
                        src="{{ $img('outsource-data-entry-services.webp') }}"
                        alt="Outsource Data Entry Services"
                        width="780"
                        height="778"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="de-section" aria-labelledby="de-intro-title">
            <div class="site-shell de-intro">
                <div class="de-intro__media">
                    <img
                        src="{{ $img('online-data-entry-services.webp') }}"
                        alt="online data entry services"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="de-intro__copy">
                    <h2 id="de-intro-title">Remote Data Entry Solutions</h2>
                    <p class="de-subtitle">26+ Years of Secure and Confidential</p>
                    <p>
                        Are you tired of dealing with errors and inconsistencies in your data entry? At IBN Tech, a leading business process outsourcing company, through our data entry services, we are committed to maintaining a delicate equilibrium between fulfilling business requirements and providing our clients with the finest solutions. Our expertise in delivering data entry services to clients worldwide has been refined over numerous years, enabling us to offer an unparalleled combination of skills and capabilities to meet your specific needs.
                    </p>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="de-section de-section--soft" aria-labelledby="de-services-title">
            <div class="site-shell">
                <div class="de-heading">
                    <h2 id="de-services-title">Seamless Operations Await</h2>
                    <p class="de-subtitle">Data Entry Solutions for Your Business Success</p>
                    <p>
                        Explore a new standard of precision and productivity as you entrust your data entry tasks to the expertise of IBN Tech.
                    </p>
                </div>

                <div class="de-services" role="list">
                    @foreach ($services as $service)
                        <article class="de-service" role="listitem">
                            <div class="de-service__icon">
                                <img
                                    src="{{ $img($service['file']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="de-heading__cta">
                    <a href="#request-form-demo" class="de-btn de-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="de-section de-section--gold" aria-labelledby="de-benefits-title">
            <div class="site-shell">
                <div class="de-heading">
                    <h2 id="de-benefits-title">Benefits of Outsourcing Data Entry Process</h2>
                    <p class="de-subtitle">Maximize Efficiency with IBN Tech</p>
                </div>

                <div class="de-benefits" role="list">
                    @foreach ($benefits as $benefit)
                        <article class="de-benefit" role="listitem">
                            <img
                                src="{{ $img($benefit['file']) }}"
                                alt="{{ $benefit['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="de-benefit__copy">
                                <h3>{{ $benefit['title'] }}</h3>
                                <p>{{ $benefit['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="de-heading__cta">
                    <a href="#request-form-demo" class="de-btn de-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="de-banner" aria-labelledby="de-banner-title">
            <div class="site-shell de-banner__inner">
                <h2 id="de-banner-title">Ready to Transform Your Data Handling?</h2>
                <p>Let's discuss how our tailored data entry solutions can deliver measurable results for your business.</p>
                <a href="#request-form-demo" class="de-btn de-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Industries --}}
        <section class="de-section" aria-labelledby="de-industries-title">
            <div class="site-shell de-industries">
                <div class="de-industries__copy">
                    <h2 id="de-industries-title">Data Conversion Services</h2>
                    <h3>Industries We Serve</h3>
                    <p>
                        Each industry is Unique and their requirements Our industry-Specific Solutions are tailored to your needs to help you operate efficiently
                    </p>
                    <a
                        href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                        id="book-button"
                        class="de-btn de-btn--green"
                    >
                        Explore More About Industry
                    </a>
                </div>

                <div class="de-industries__grid" role="list">
                    @foreach ($industries as $industry)
                        <a
                            href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                            class="de-industry"
                            role="listitem"
                        >
                            <img
                                src="{{ $industryImg($industry['file']) }}"
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

        {{-- Contact form --}}
        <section
            class="de-section de-consult"
            id="request-form-demo"
            aria-labelledby="de-consult-title"
        >
            <div class="site-shell de-consult__inner">
                <aside class="de-consult__card" aria-labelledby="de-consult-title">
                    <div class="de-consult__header">
                        <h2 id="de-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="de-consult__body">
                        <livewire:forms.contact-form
                            form-name="data-entry"
                            id-prefix="de"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Briefly Describe Your Needs"
                            submit-label="Submit"
                            layout="home"
                            :message-rows="4"
                            wire:key="data-entry-consult"
                        />
                    </div>
                </aside>

                <div class="de-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="form Image"
                        width="540"
                        height="364"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
