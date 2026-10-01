@php
    $img = fn (string $file): string => asset('images/data-conversion/'.$file);
    $industryIcon = fn (string $file): string => asset('images/bpo-services/'.$file);
    $pageUrl = fn (string $slug): string => route('page.show', ['slug' => $slug]);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $checkIcon = '<svg class="dc-check" aria-hidden="true" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M7.2 12.4 10.3 15.4 16.8 8.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';

    $serviceCards = [
        [
            'title' => 'Data Cleansing and Formatting',
            'items' => [
                'Maintaining coherence and consistency',
                'Eliminating duplicate entries',
                'Establishing standardized formats',
                'Rectifying any mistakes',
            ],
        ],
        [
            'title' => 'Document Conversion',
            'items' => [
                'Transform documents from one format to another (Retaining the content and layout intact).',
                'Convert physical documents into digital formats (exp.- PDF, Word, or HTML)',
            ],
        ],
        [
            'title' => 'File Format Conversion',
            'items' => [
                'Convert a Microsoft Word document to a PDF file',
                'Converting a CSV file to an Excel spreadsheet',
            ],
        ],
    ];

    $expertItems = [
        [
            'image' => 'custom-assessment.webp',
            'alt' => 'custom assessment',
            'title' => 'Custom Assessment',
            'text' => 'We begin by conducting an in-depth analysis of your data needs and identifying the specific challenges and opportunities you face.',
        ],
        [
            'image' => 'individualized-strategies.webp',
            'alt' => 'individualized strategies',
            'title' => 'Individualized Strategies',
            'text' => 'Each data conversion project is assigned a dedicated team of experts who develop a personalized strategy tailored to your unique requirements.',
        ],
        [
            'image' => 'efficiency.webp',
            'alt' => 'efficiency',
            'title' => 'Efficiency and Cost-Effectiveness',
            'text' => 'We leverage cutting-edge technologies and methodologies to streamline the conversion process, ensuring both efficiency and cost-effectiveness.',
        ],
        [
            'image' => 'clean-and-streamlined-data.webp',
            'alt' => 'clean and streamlined data',
            'title' => 'Clean and Streamlined Databases',
            'text' => 'Our data conversion process meticulously transforms your raw data into a refined, accessible database, empowering your organization to make informed decisions',
        ],
    ];

    $industries = [
        ['label' => 'Real Estate', 'slug' => 'real-estate-construction-bookkeeping-services', 'icon' => 'real-estate.webp', 'alt' => 'real estate'],
        ['label' => 'Hospitality', 'slug' => 'hospitality-bookkeeping-and-accounting-services', 'icon' => 'hospitality.webp', 'alt' => 'hospitality'],
        ['label' => 'Retail', 'slug' => 'bookkeeping-services-for-retail-stores', 'icon' => 'retail.webp', 'alt' => 'retail'],
        ['label' => 'E-com', 'slug' => 'ecommerce-bookkeeping-services', 'icon' => 'ecommerce.webp', 'alt' => 'Ecommerce'],
        ['label' => 'Health Care', 'slug' => 'healthcare-bookkeeping-services', 'icon' => 'healthcare.webp', 'alt' => 'healthcare'],
        ['label' => 'CPA Firm', 'slug' => 'cpa-outsourcing', 'icon' => 'cpa.webp', 'alt' => 'CPA'],
        ['label' => 'Travel', 'slug' => 'travel-bookkeeping-service', 'icon' => 'travel.webp', 'alt' => 'Travel'],
        ['label' => 'Legal', 'slug' => 'legal-bookkeeping-services', 'icon' => 'legal.webp', 'alt' => 'Legal'],
        ['label' => 'Manufacturing', 'slug' => 'manufacturing-accounting-and-bookkeeping-services', 'icon' => 'manufacturing.webp', 'alt' => 'Manufacturing'],
        ['label' => 'Financial Business', 'slug' => 'finance-businesses-bookkeeping-service', 'icon' => 'financial-services.webp', 'alt' => 'Financial'],
        ['label' => 'Marketing', 'slug' => 'marketing-and-advertising-bookkeeping-services', 'icon' => 'marketing-advertising.webp', 'alt' => 'Marketing'],
        ['label' => 'IT Business', 'slug' => 'it-business-bookkeeping-service', 'icon' => 'it-business.webp', 'alt' => 'IT-Business'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/data-conversion.css'])
@endpush

@section('content')
    <div class="dc-page">
        {{-- Hero --}}
        <section class="dc-hero" aria-labelledby="dc-hero-title">
            <div class="site-shell dc-hero__inner">
                <div class="dc-hero__copy">
                    <p class="dc-kicker">Discover Streamlined and Cost-Effective Data Processing Services with IBN Tech's</p>
                    <h1 id="dc-hero-title">Outsource Data Conversion Services</h1>
                    <p class="dc-hero__lede">Elevate Your Data Accuracy and Efficiency</p>
                    <div class="dc-hero__actions">
                        <a href="#request-form-demo" class="dc-btn dc-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="dc-hero__media">
                    <img
                        src="{{ $img('outsource-data-conversion-services.webp') }}"
                        alt="outsource data conversion services"
                        width="560"
                        height="559"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- About --}}
        <section class="dc-section dc-about" aria-labelledby="dc-about-title">
            <div class="site-shell dc-about__inner">
                <div class="dc-about__media">
                    <img
                        src="{{ $img('top-data-conversion-outsourcing-services.webp') }}"
                        alt="top data conversion outsourcing services"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dc-about__copy">
                    <h2 id="dc-about-title">Top Data Conversion Outsourcing Services</h2>
                    <p class="dc-about__years"><strong>(27+ Years of Expertise)</strong></p>
                    <p>Are you struggling with managing diverse data formats?</p>
                    <p>IBN Tech, a leader in business process outsourcing, offers specialized outsource data conversion services to streamline your data management. With over two decades of experience, we bring a rich blend of expertise and technology to convert your data into useful, efficient formats. Our commitment lies in providing tailored solutions that align with your business objectives, ensuring data integrity and precision.</p>
                </div>
            </div>
        </section>

        {{-- Service cards --}}
        <section class="dc-section dc-services" aria-labelledby="dc-services-title">
            <div class="site-shell">
                <div class="dc-section-head">
                    <h2 id="dc-services-title">Unlock Data-Driven Success with Database Conversion Services</h2>
                    <p>Data conversion is more than a mere task it's vital to modern business operations. At IBN Tech, we understand the significance of accurate data conversion in enhancing business processes and decision-making. Our services include:</p>
                </div>

                <div class="dc-service-grid">
                    @foreach ($serviceCards as $card)
                        <article class="dc-service-card">
                            <h3>{{ $card['title'] }}</h3>
                            <ul>
                                @foreach ($card['items'] as $item)
                                    <li>
                                        {!! $checkIcon !!}
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <div class="dc-section-cta">
                    <a href="#request-form-demo" class="dc-btn dc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Expert services --}}
        <section class="dc-section dc-experts" aria-labelledby="dc-experts-title">
            <div class="site-shell">
                <div class="dc-section-head">
                    <h2 id="dc-experts-title">Expert outsource data conversion services</h2>
                    <p class="dc-section-head__sub">Tailored Solutions for Optimal Data Utility</p>
                </div>

                <div class="dc-expert-grid">
                    @foreach ($expertItems as $item)
                        <article class="dc-expert-card">
                            <img
                                src="{{ $img($item['image']) }}"
                                alt="{{ $item['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="dc-section-cta">
                    <a href="#request-form-demo" class="dc-btn dc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Mid-page CTA --}}
        <section class="dc-band" aria-labelledby="dc-band-title">
            <div class="site-shell dc-band__inner">
                <h2 id="dc-band-title">Transform Your Data Conversion Practices with IBN Tech</h2>
                <p>Discuss how our specialized data conversion solutions can drive significant improvements in your business.</p>
                <a href="#request-form-demo" class="dc-btn dc-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Industries --}}
        <section class="dc-section dc-industries" aria-labelledby="dc-industries-title">
            <div class="site-shell dc-industries__inner">
                <div class="dc-industries__copy">
                    <h2 id="dc-industries-title">Data Conversion Services</h2>
                    <h3>Industries We Serve</h3>
                    <p>Each industry is Unique and their requirements Our industry-Specific Solutions are tailored to your needs to help you operate efficiently</p>
                    <a href="{{ $pageUrl('contact-us') }}" id="book-button" class="dc-btn dc-btn--green">
                        Explore More About Industry
                    </a>
                </div>

                <div class="dc-industry-grid">
                    @foreach ($industries as $industry)
                        <a
                            href="{{ $pageUrl($industry['slug']) }}"
                            class="dc-industry-card"
                        >
                            <img
                                src="{{ $industryIcon($industry['icon']) }}"
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
            class="dc-section dc-consult"
            id="request-form-demo"
            aria-labelledby="dc-consult-title"
        >
            <div class="site-shell dc-consult__inner">
                <aside class="dc-consult__card" aria-labelledby="dc-consult-title">
                    <div class="dc-consult__header">
                        <h2 id="dc-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="dc-consult__body">
                        <livewire:forms.contact-form
                            form-name="data-conversion"
                            id-prefix="dc"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Briefly Describe Your Needs"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="dc-consult__media">
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
