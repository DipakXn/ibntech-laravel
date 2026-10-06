@php
    $img = fn (string $file): string => asset('images/data-processing/'.$file);
    $industryImg = fn (string $file): string => asset('images/bpo-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $growthItems = [
        [
            'file' => 'streamlined-data-management.webp',
            'alt' => 'streamlined data management',
            'title' => 'Streamlined Data Management',
            'text' => 'Efficiently organize your data to boost productivity and minimize errors, paving the way for smoother business operations.',
        ],
        [
            'file' => 'cost-effective-solutions.webp',
            'alt' => 'cost-effective solutions',
            'title' => 'Cost-Effective Solutions',
            'text' => 'Reduce operational costs with our affordable data processing, enhancing your return on investment.',
        ],
        [
            'file' => 'rapid-processing-and-delivery.webp',
            'alt' => 'rapid processing and delivery',
            'title' => 'Rapid Processing and Delivery',
            'text' => 'Accelerate business decisions and market responsiveness with our swift data processing and delivery.',
        ],
        [
            'file' => 'expert-team-and-advanced-technology.webp',
            'alt' => 'expert team and advanced technology',
            'title' => 'Expert Team and Advanced Technology',
            'text' => 'Benefit from our expert data handling and cutting-edge technology for superior business outcomes.',
        ],
        [
            'file' => 'data-driven-strategic-decisions.webp',
            'alt' => 'data-driven strategic decisions',
            'title' => 'Data-Driven Strategic Decisions',
            'text' => 'Empower your strategic planning with actionable insights derived from our accurate data processing.',
        ],
        [
            'file' => 'continuity-in-business-operations.webp',
            'alt' => 'continuity in business operations',
            'title' => 'Continuity in Business Operations',
            'text' => 'Enjoy uninterrupted growth and stability with our round-the-clock data processing support.',
        ],
    ];

    $efficiencyItems = [
        [
            'title' => 'Document Integration and Handling:',
            'text' => 'We ensure a smooth transition of your documents, accepting them via various methods, and meticulously reviewing, verifying, and arranging them for optimal coherence.',
        ],
        [
            'title' => 'Data Entry and Cleansing:',
            'text' => 'Our data entry services are complemented by thorough data cleansing, ensuring accuracy, consistency, and elimination of redundancies.',
        ],
        [
            'title' => 'Data Transformation and Mining:',
            'text' => 'We transform your data for seamless system integration and employ advanced data mining techniques to uncover valuable insights and patterns.',
        ],
        [
            'title' => 'Proofreading and Quality Assurance:',
            'text' => 'Each dataset is rigorously proofread and undergoes a stringent quality check to ensure the highest level of accuracy and completeness.',
        ],
        [
            'title' => 'Secure and Timely Delivery:',
            'text' => 'We guarantee the secure and prompt delivery of your data, in your preferred format, ready for immediate use.',
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
    @vite(['resources/css/pages/data-processing.css'])
@endpush

@section('content')
    <div class="dp-page">
        {{-- Hero --}}
        <section class="dp-hero" aria-labelledby="dp-hero-title">
            <div class="site-shell dp-hero__inner">
                <div class="dp-hero__copy">
                    <p class="dp-eyebrow">Maximize Your Efficiency and Data Precision</p>
                    <h1 id="dp-hero-title">Outsource Data Processing Services</h1>
                    <p class="dp-hero__lede">
                        Empower Your Business with IBN Tech’s Expert Data Management Solutions
                    </p>
                    <div class="dp-hero__actions">
                        <a href="#contact-section" class="dp-btn dp-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="dp-hero__media">
                    <img
                        src="{{ $img('banner.webp') }}"
                        alt="Data Processing"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="dp-section" aria-labelledby="dp-intro-title">
            <div class="site-shell dp-intro">
                <div class="dp-intro__media">
                    <img
                        src="{{ $img('data-management-and-processing.webp') }}"
                        alt="data management and processing"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dp-intro__copy">
                    <h2 id="dp-intro-title">Data Management and Processing Services</h2>
                    <p>
                        <strong>27+ Year's of Excellence</strong>
                        In today's data-driven world, extracting valuable insights from raw data is crucial for business growth. IBN Technologies, a trusted partner with over two decades of experience, offers comprehensive data processing solutions tailored to your specific needs. Our team of experts leverages advanced techniques to transform your data into actionable intelligence, empowering you to make informed decisions and achieve your strategic goals.
                    </p>
                </div>
            </div>
        </section>

        {{-- Efficiency --}}
        <section class="dp-section dp-section--tight" aria-labelledby="dp-efficiency-title">
            <div class="site-shell">
                <div class="dp-heading">
                    <h2 id="dp-efficiency-title">Enhance Your Operational Efficiency with IBN Tech’s</h2>
                    <p class="dp-subtitle">Data Processing Outsourcing Services</p>
                    <p>Our data processing solutions encompass a wide range of services, including:</p>
                </div>

                <div class="dp-efficiency">
                    <div class="dp-efficiency__copy">
                        @foreach ($efficiencyItems as $item)
                            <p>
                                <strong>{{ $item['title'] }}</strong>
                                {{ $item['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <div class="dp-efficiency__media">
                        <img
                            src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                            alt="at ibn tech, we understand that marketing and"
                            width="532"
                            height="362"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>

                <div class="dp-heading__cta">
                    <a href="#contact-section" class="dp-btn dp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Growth cards --}}
        <section class="dp-section dp-section--soft" aria-labelledby="dp-growth-title">
            <div class="site-shell">
                <div class="dp-heading">
                    <h2 id="dp-growth-title">Experience Business Growth with IBN Tech's</h2>
                    <p class="dp-subtitle">Strategic Data Processing Solutions</p>
                </div>

                <div class="dp-cards" role="list">
                    @foreach ($growthItems as $item)
                        <article class="dp-card" role="listitem">
                            <div class="dp-card__icon">
                                <img
                                    src="{{ $img($item['file']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="dp-heading__cta">
                    <a href="#contact-section" class="dp-btn dp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="dp-banner" aria-labelledby="dp-banner-title">
            <div class="site-shell dp-banner__inner">
                <h2 id="dp-banner-title">Ready to Elevate Your Data Processing?</h2>
                <p>Let's explore how our custom data processing solutions can significantly benefit your business.</p>
                <a href="#contact-section" class="dp-btn dp-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Industries --}}
        <section class="dp-section" aria-labelledby="dp-industries-title">
            <div class="site-shell dp-industries">
                <div class="dp-industries__copy">
                    <h2 id="dp-industries-title">Specialized Data Processing Services</h2>
                    <h3>Across Industries</h3>
                    <p>
                        Each industry is Unique and their requirements Our industry-Specific Solutions are tailored to your needs to help you operate efficiently
                    </p>
                    <a href="#contact-section" class="dp-btn dp-btn--green">
                        Explore More About Industry
                    </a>
                </div>

                <div class="dp-industries__grid" role="list">
                    @foreach ($industries as $industry)
                        <a
                            href="{{ route('page.show', ['slug' => $industry['slug']]) }}"
                            class="dp-industry"
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
            class="dp-section dp-consult"
            id="contact-section"
            aria-labelledby="dp-consult-title"
        >
            <div class="site-shell dp-consult__inner">
                <aside class="dp-consult__card" aria-labelledby="dp-consult-title">
                    <div class="dp-consult__header">
                        <h2 id="dp-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="dp-consult__body">
                        <livewire:forms.contact-form
                            form-name="data-processing"
                            id-prefix="dp"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Briefly Describe Your Needs"
                            submit-label="Submit"
                            layout="home"
                            :message-rows="4"
                            wire:key="data-processing-consult"
                        />
                    </div>
                </aside>

                <div class="dp-consult__media">
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
