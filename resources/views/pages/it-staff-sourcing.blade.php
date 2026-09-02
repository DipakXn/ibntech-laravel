@php
    $img = fn (string $file): string => asset('images/it-staff-sourcing/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $snapshotItems = [
        [
            'icon' => 'it-staffing.webp',
            'alt' => 'it staffing',
            'title' => 'Outsourced IT Recruitment',
            'text' => 'Experience a seamless recruitment process with our expert IT staffing solutions, specifically designed to meet your unique needs.',
        ],
        [
            'icon' => 'outsourced-it-recruitment.webp',
            'alt' => 'outsourced it recruitment',
            'title' => 'IT Staffing',
            'text' => 'Gain access to a vast talent pool of qualified IT professionals ready to contribute to your business success.',
        ],
    ];

    $serviceAreas = [
        [
            'icon' => 'permanent-staffing-services.webp',
            'alt' => 'permanent staffing services',
            'title' => 'Permanent Staffing Services',
            'text' => 'Source the right full-time IT professionals for your team with our comprehensive recruitment services.',
        ],
        [
            'icon' => 'contract-staffing-services.webp',
            'alt' => 'contract staffing services',
            'title' => 'Contract Staffing Services',
            'text' => 'Benefit from the flexibility of contract IT staff, ideal for project-based work or temporary staffing needs.',
        ],
        [
            'icon' => 'staff-augmentation-services.webp',
            'alt' => 'staff augmentation services',
            'title' => 'Staff Augmentation Services',
            'text' => 'Extend your team\'s capabilities with our staff augmentation services, designed to fill skill gaps and support your business growth.',
        ],
        [
            'icon' => 'recruitment-process-outsourcing-rpo-services.webp',
            'alt' => 'recruitment process outsourcing (rpo) services',
            'title' => 'Recruitment Process Outsourcing (RPO) Services',
            'text' => 'Optimize your recruitment process with our RPO services, freeing up valuable resources and ensuring an efficient, effective hiring process.',
        ],
        [
            'icon' => 'talent-management-services.webp',
            'alt' => 'talent management services',
            'title' => 'Talent Management Services',
            'text' => 'Leverage our expertise in talent management to foster a productive, engaged, and motivated IT workforce.',
        ],
        [
            'icon' => 'executive-search-services.webp',
            'alt' => 'executive search services',
            'title' => 'Executive Search Services',
            'text' => 'Recruit top executive talent for your IT department with our dedicated executive search services.',
        ],
        [
            'icon' => 'vendor-management-services.webp',
            'alt' => 'vendor management services',
            'title' => 'Vendor Management Services',
            'text' => 'Simplify your vendor relationships with our expert vendor management services, designed to optimize costs, drive service excellence, and mitigate risks.',
        ],
        [
            'icon' => 'offshore-staffing-services.webp',
            'alt' => 'offshore staffing services',
            'title' => 'Offshore Staffing Services',
            'text' => 'Tap into global talent with our offshore staffing services, offering cost-effective solutions without compromising on quality.',
        ],
        [
            'icon' => 'onsite-staffing-services.webp',
            'alt' => 'onsite staffing services',
            'title' => 'Onsite Staffing Services',
            'text' => 'Benefit from the convenience and collaboration of onsite IT staff, expertly matched to your business needs.',
        ],
        [
            'icon' => 'staff-retention-services.webp',
            'alt' => 'staff retention services',
            'title' => 'Staff Retention Services',
            'text' => 'Enhance your staff retention rates with our dedicated services, helping you to maintain a stable, skilled, and satisfied IT workforce.',
        ],
    ];

    $benefits = [
        'Access to a broad network of highly qualified IT professionals.',
        'Tailored recruitment solutions designed to align with your business objectives.',
        'Comprehensive range of staffing services, from permanent staffing to vendor management.',
        'Dedicated support from a team of industry-savvy recruitment specialists.',
        'Enhanced workforce stability and satisfaction with our staff retention services.',
    ];

    $processSteps = [
        'Comprehensive understanding of your staffing needs and business objectives.',
        'Tailored recruitment strategy, leveraging our extensive network of IT professionals.',
        'Rigorous candidate screening and selection process.',
        'Support throughout the hiring process, from interviews to onboarding.',
        'Ongoing support and services, including staff retention and vendor management.',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/it-staff-sourcing.css'])
@endpush

@section('content')
    <div class="iss-page">
        {{-- Hero --}}
        <section class="iss-hero" aria-labelledby="iss-hero-title">
            <div class="site-shell iss-hero__inner">
                <div class="iss-hero__copy">
                    <p class="iss-hero__eyebrow">
                        Make Your Vision a Reality with Our Exceptional IT Staff Sourcing Services
                    </p>
                    <h1 id="iss-hero-title">IT Staff Sourcing Services</h1>
                    <p class="iss-hero__lede">
                        Access Top-Tier IT Talent, Streamline Your Operations, and Propel Your Business to New Heights
                    </p>
                    <a href="{{ $contactUrl }}" class="iss-btn iss-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="iss-hero__media">
                    <img
                        src="{{ $img('it-staff-sourcing-abnner.webp') }}"
                        alt="IT Staff Sourcing"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="iss-section iss-intro" aria-labelledby="iss-intro-title">
            <div class="site-shell iss-intro__inner">
                <h2 id="iss-intro-title" class="sr-only">IBN Tech IT staff sourcing</h2>
                <p>
                    <strong>IBN Tech's</strong> IT staff sourcing services are designed to optimize your recruitment efficiency and reliability. Our team of skilled professionals possesses extensive experience in identifying and placing qualified IT talent, ensuring your business can operate at peak efficiency.
                </p>
            </div>
        </section>

        {{-- Service Snapshot --}}
        <section class="iss-section iss-snapshot" aria-labelledby="iss-snapshot-title">
            <div class="site-shell">
                <div class="iss-heading">
                    <h2 id="iss-snapshot-title">Service Snapshot</h2>
                </div>

                <div class="iss-snapshot-grid" role="list">
                    @foreach ($snapshotItems as $item)
                        <article class="iss-snapshot-card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
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
            </div>
        </section>

        {{-- Service Areas --}}
        <section class="iss-section iss-areas" aria-labelledby="iss-areas-title">
            <div class="site-shell">
                <div class="iss-heading">
                    <h2 id="iss-areas-title">Service Areas</h2>
                </div>

                <div class="iss-areas-grid" role="list">
                    @foreach ($serviceAreas as $item)
                        <article class="iss-area-card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
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

                <div class="iss-section__cta">
                    <a href="{{ $contactUrl }}" class="iss-btn iss-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Distinctive approach --}}
        <section class="iss-section iss-approach" aria-labelledby="iss-approach-title">
            <div class="site-shell iss-split">
                <div class="iss-split__copy">
                    <h2 id="iss-approach-title">Our Distinctive Approach to Customer Benefits</h2>
                    <ul class="iss-list">
                        @foreach ($benefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="iss-split__media">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits-1.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="469"
                        height="505"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="iss-section iss-process" aria-labelledby="iss-process-title">
            <div class="site-shell iss-split">
                <div class="iss-split__media">
                    <img
                        src="{{ $img('it-staff-sourcing-process-at-ibn-tech.webp') }}"
                        alt="it staff sourcing process at ibn tech"
                        width="486"
                        height="386"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="iss-split__copy">
                    <h2 id="iss-process-title">IT Staff Sourcing Process at IBN Tech</h2>
                    <ul class="iss-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="iss-cta" aria-labelledby="iss-cta-title">
            <div class="site-shell iss-cta__inner">
                <p id="iss-cta-title">
                    At IBN Tech, we understand that the right IT professionals can be a driving force behind your business success. Our tailored IT staff sourcing services are designed to deliver the talent you need when you need it, helping you to streamline your operations, enhance your workforce, and achieve your business vision.
                </p>
                <a href="{{ $contactUrl }}" class="iss-btn iss-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>
    </div>
@endsection
