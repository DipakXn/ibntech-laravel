@php
    $img = fn (string $file): string => asset('images/it-services/'.$file);
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

    $introPoints = [
        'Designing and developing new applications',
        'Enhancing existing applications',
        'Integrating existing and/or newly built applications',
        'Software Consulting',
        'Application maintenance & Support Services',
    ];

    $introNested = [
        'label' => 'Products & Solutions for Travel / Hospitality Industry',
        'items' => [
            'XML Feed Integrator – Product to Connect two different Databases',
            'PMRS Online Portfolio Management System',
        ],
    ];

    $expertiseItems = [
        'Microsoft .Net Development',
        'Open Source software Development',
        'Design, Development & Optimization',
        'Business Intelligence & Analytics, Reports Development, and Customization',
        'Mobile application software development for iOS, Android and Windows Mobile platform',
    ];

    $technicalPoints = [
        '.Net/Microsoft, C#/ASP.Net, VB.Net, Visual Studio.Net 2005/2008/2010/2012, .NET Framework. Dotnet NUKE, WCF,ADO.net',
        'MVC Framework',
        'PHP/Open Source Development, MySQL, JOOMLA, Word Press',
        'Web Services, SOAP, AJAX',
        'Business Intelligence and Reporting: Business Objects/Crystal Reports, SQL Server Reporting',
        'Database: SQL Server, MySQL, MS Access',
        'HTML 4 and 5 , DHTML, XHTML, XML,XSL, XSLT, Web 2.0',
    ];

    $qualityItems = [
        [
            'icon' => 'adopting-a-custom-software-development.webp',
            'alt' => 'adopting a custom software development',
            'text' => 'Adopting a custom software development lifecycle methodology based on the unique characteristics of the customer and its needs',
        ],
        [
            'icon' => 'making-early-emphasis-on-defining-the-architecture.webp',
            'alt' => 'making early emphasis on defining the architecture',
            'text' => 'Making early emphasis on defining the architecture (“architecture-centric” approach)',
        ],
        [
            'icon' => 'design-and-development-using-proven-and-latest.webp',
            'alt' => 'design and development using proven and latest',
            'text' => 'Design and development using proven and latest technologies, methodologies, frameworks, and processes',
        ],
        [
            'icon' => 'managing-requirements-meeting-timelines-and-budget.webp',
            'alt' => 'managing requirements, meeting timelines and budget',
            'text' => 'Managing requirements, meeting timelines and budget',
        ],
        [
            'icon' => 'subjecting-all-projects-to-quality-assurance-and-quality-control.webp',
            'alt' => 'subjecting all projects to quality assurance and quality control',
            'text' => 'Subjecting all projects to quality assurance and quality control',
        ],
        [
            'icon' => 'providing-tangible-deliverables-per-each-phase.webp',
            'alt' => 'providing tangible deliverables per each phase',
            'text' => 'Providing tangible deliverables per each phase',
        ],
        [
            'icon' => 'maintaining-an-effective-collaborative-environment-for-teams.webp',
            'alt' => 'maintaining an effective collaborative environment for teams',
            'text' => 'Maintaining an effective collaborative environment for teams',
        ],
        [
            'icon' => 'continuously-perfecting-the-development-processes-and-procedures.webp',
            'alt' => 'continuously perfecting the development processes and procedures',
            'text' => 'Continuously perfecting the development processes and procedures.',
        ],
        [
            'icon' => 'implementation-of-agile-and-lean-methodology.webp',
            'alt' => 'implementation of agile and lean methodology',
            'text' => 'Implementation of Agile and Lean Methodology.',
        ],
    ];

    $valuePoints = [
        'Free-up customer Project Manager band-width up to 20% to focus on Core Business activities',
        'Recommend best fit solution using Technology Centers of Excellence',
        'Use of our own Knowledge Management process to reduce the key person dependencies that gives service continuity',
        '10% increase in Productivity by using Reusable components library',
        '5% YoY cost savings on development by leveraging our expertise in Development processes',
        'Reduced quality assurance costs using our efficient design reviews, automated code reviews and unit testing methodologies',
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
        ['label' => 'Financial', 'slug' => 'finance-businesses-bookkeeping-service', 'icon' => 'financial-services.webp', 'alt' => 'Financial'],
        ['label' => 'Marketing', 'slug' => 'marketing-and-advertising-bookkeeping-services', 'icon' => 'marketing-advertising.webp', 'alt' => 'Marketing'],
        ['label' => 'IT Business', 'slug' => 'it-business-bookkeeping-service', 'icon' => 'it-business.webp', 'alt' => 'IT-Business'],
    ];

    $solutions = [
        ['icon' => 'travel-booking-engine.webp', 'alt' => 'travel booking engine', 'title' => 'B2B and B2C Travel Booking Engine'],
        ['icon' => 'finance-accounting.webp', 'alt' => 'Finance & Accounting', 'title' => 'Finance & Accounting'],
        ['icon' => 'collaboration.webp', 'alt' => 'collaboration', 'title' => 'Collaboration'],
        ['icon' => 'document-management.webp', 'alt' => 'document management', 'title' => 'BPM:-Work Flow and Document Management'],
        ['icon' => 'portfolio-management.webp', 'alt' => 'portfolio management', 'title' => 'Portfolio Management'],
        ['icon' => 'customer-relationship-management-crm.webp', 'alt' => 'customer relationship management (crm)', 'title' => 'Customer Relationship Management (CRM)'],
        ['icon' => 'enterprise-ecommerce-cms-portals.webp', 'alt' => 'enterprise ecommerce & cms portals', 'title' => 'Enterprise eCommerce & CMS Portals'],
        ['icon' => 'portfolio-management-1.webp', 'alt' => 'portfolio management', 'title' => 'Portfolio Management'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/it-services.css'])
@endpush

@section('content')
    <div class="its-page">
        {{-- Hero --}}
        <section class="its-hero" aria-labelledby="its-hero-title">
            <div class="site-shell its-hero__inner">
                <div class="its-hero__copy">
                    <h1 id="its-hero-title">IT Services</h1>
                    <div class="its-hero__actions">
                        <a href="#contact-us" class="its-btn its-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="its-hero__media">
                    <img
                        src="{{ $img('it-service-banner.webp') }}"
                        alt="it-service"
                        width="522"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="its-section" aria-labelledby="its-intro-title">
            <div class="site-shell its-split">
                <div class="its-split__copy">
                    <h2 id="its-intro-title">IT Services</h2>
                    <p>
                        IBN provides Application Development, end-to-end consulting in information technology products and services through flexible and cost efficient off-shore resource based delivery models. The Broad framework of IT services includes
                    </p>
                    <ul class="its-list">
                        @foreach ($introPoints as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                        <li>
                            {{ $introNested['label'] }}
                            <ul>
                                @foreach ($introNested['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <a href="#contact-us" class="its-btn its-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="its-split__media">
                    <img
                        src="{{ $img('it-services.webp') }}"
                        alt="it services"
                        width="778"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Development Expertise --}}
        <section class="its-banner" aria-labelledby="its-expertise-title">
            <div class="site-shell its-banner__inner">
                <h2 id="its-expertise-title">Development Expertise</h2>
                <div class="its-banner__items">
                    @foreach ($expertiseItems as $item)
                        <p>{{ $item }}</p>
                    @endforeach
                </div>
                <a href="#contact-us" class="its-btn its-btn--green">
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Technical expertise --}}
        <section class="its-section" aria-labelledby="its-technical-title">
            <div class="site-shell its-split its-split--reverse">
                <div class="its-split__media">
                    <img
                        src="{{ $img('technical-expertise.webp') }}"
                        alt="technical expertise"
                        width="778"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="its-split__copy">
                    <h2 id="its-technical-title">Technical expertise</h2>
                    <ul class="its-list">
                        @foreach ($technicalPoints as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="its-btn its-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Process and Quality --}}
        <section class="its-section its-section--soft" aria-labelledby="its-quality-title">
            <div class="site-shell">
                <div class="its-section-head">
                    <h2 id="its-quality-title">Process and Quality</h2>
                </div>
                <div class="its-quality-grid">
                    @foreach ($qualityItems as $item)
                        <article class="its-quality-card">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="64"
                                height="64"
                                loading="lazy"
                                decoding="async"
                            >
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
                <div class="its-section-cta">
                    <a href="#contact-us" class="its-btn its-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Value Proposition --}}
        <section class="its-section" aria-labelledby="its-value-title">
            <div class="site-shell its-split">
                <div class="its-split__media">
                    <img
                        src="{{ $img('value-proposition.webp') }}"
                        alt="value proposition"
                        width="778"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="its-split__copy">
                    <h2 id="its-value-title">Value Proposition</h2>
                    <ul class="its-list">
                        @foreach ($valuePoints as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="its-btn its-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Vertical Expertise --}}
        <section class="its-section its-section--soft" aria-labelledby="its-vertical-title">
            <div class="site-shell its-industries">
                <div class="its-industries__copy">
                    <h2 id="its-vertical-title">Vertical Expertise</h2>
                    <h3>Industries We Serve</h3>
                    <p>Each industry is Unique and their requirements Our industry-Specific Solutions are tailored to your needs to help you operate efficiently</p>
                    <a href="{{ $pageUrl('contact-us') }}" class="its-btn its-btn--green">
                        Explore More About Industry
                    </a>
                </div>
                <div class="its-industry-grid">
                    @foreach ($industries as $industry)
                        <a href="{{ $pageUrl($industry['slug']) }}" class="its-industry-card">
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

        {{-- Solutions --}}
        <section class="its-section" aria-labelledby="its-solutions-title">
            <div class="site-shell">
                <div class="its-section-head">
                    <h2 id="its-solutions-title">Solutions</h2>
                </div>
                <div class="its-solution-grid">
                    @foreach ($solutions as $item)
                        <article class="its-solution-card">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="56"
                                height="56"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
                <div class="its-section-cta">
                    <a href="#contact-us" class="its-btn its-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="its-section its-consult"
            id="contact-us"
            aria-labelledby="its-consult-title"
        >
            <div class="site-shell its-consult__inner">
                <aside class="its-consult__card" aria-labelledby="its-consult-title">
                    <div class="its-consult__header">
                        <h2 id="its-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="its-consult__body">
                        <livewire:forms.contact-form
                            form-name="it-services"
                            id-prefix="its"
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
                <div class="its-consult__media">
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
