@php
    $img = fn (string $file): string => asset('images/database-monitoring-and-support/'.$file);
    $vaptUrl = route('page.show', ['slug' => 'vapt-services']);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $apartItems = [
        [
            'icon' => 'relational-database-monitoring.png',
            'alt' => 'relational database monitoring',
            'title' => 'Relational Database Monitoring',
            'text' => 'Proactively monitor and manage the performance of your relational database systems, ensuring optimal efficiency and stability.',
        ],
        [
            'icon' => 'monitor-database-performance-in-real-time.png',
            'alt' => 'monitor database performance in real time',
            'title' => 'Monitor Database Performance in Real Time',
            'text' => 'Gain real-time insights into your database performance, enabling swift identification and resolution of potential issues.',
        ],
        [
            'icon' => 'open-source-database-monitoring-agent.png',
            'alt' => 'open-source database monitoring agent',
            'title' => 'Open-Source Database Monitoring Agent',
            'text' => 'Leverage our open-source database monitoring agent for cost-effective and flexible monitoring solutions.',
        ],
    ];

    $benefits = [
        'A dedicated team of professionals with diverse database expertise',
        'Comprehensive, round-the-clock monitoring and support',
        'Enhanced database performance, security, and reliability',
        'Customized solutions tailored to your unique business requirements.',
        'Flexibility to scale services according to your evolving needs.',
    ];

    $processSteps = [
        'Comprehensive assessment of your current database systems and requirements',
        'Implementation of tailored monitoring and management solutions',
        'Real-time performance tracking and proactive issue resolution',
        'Regular security assessments and threat mitigation.',
        'Strategic backup and disaster recovery planning and execution',
        'Timely patch management and system upgrades',
        'Ongoing communication and collaboration with your team',
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/database-monitoring-and-support.css'])
@endpush

@section('content')
    <div class="dbmon-page">
        {{-- Hero --}}
        <section class="dbmon-hero" aria-labelledby="dbmon-hero-title">
            <div class="site-shell dbmon-hero__inner">
                <div class="dbmon-hero__copy">
                    <p class="dbmon-hero__eyebrow">
                        Optimize Your Database Operations with IBN Tech's Comprehensive Managed Services
                    </p>
                    <h1 id="dbmon-hero-title">Database Monitoring and Managed Services</h1>
                    <p class="dbmon-hero__lede">Database Monitoring and Managed Services</p>
                    <div class="dbmon-hero__actions">
                        <a href="#contact-us" class="dbmon-btn dbmon-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="dbmon-hero__media">
                    <img
                        src="{{ $img('database-monitoring-banner.webp') }}"
                        alt="Database Monitoring"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="dbmon-section" aria-labelledby="dbmon-intro-title">
            <div class="site-shell dbmon-split">
                <div class="dbmon-split__media">
                    <img
                        src="{{ $img('ibn-tech-offers-top-tier-database-monitoring-1.webp') }}"
                        alt="ibn tech offers top-tier database monitoring (1)"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dbmon-split__copy">
                    <h2 id="dbmon-intro-title">Database Monitoring And Managed Services</h2>
                    <p>
                        IBN Tech offers top-tier database monitoring and managed services to ensure your database systems run efficiently, securely, and reliably. Our team of seasoned professionals is dedicated to providing round-the-clock support, freeing you to focus on your core business operations.
                    </p>
                    <a href="#contact-us" class="dbmon-btn dbmon-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What Sets Us Apart --}}
        <section class="dbmon-section" aria-labelledby="dbmon-apart-title">
            <div class="site-shell">
                <div class="dbmon-heading">
                    <h2 id="dbmon-apart-title">What Sets Us Apart</h2>
                    <p>Our Database Monitoring and Managed Services are designed to cater to a wide range of needs, including:</p>
                </div>

                <div class="dbmon-card-grid" role="list">
                    @foreach ($apartItems as $item)
                        <article class="dbmon-card" role="listitem">
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

                <div class="dbmon-section__cta">
                    <a href="{{ $contactUrl }}" class="dbmon-btn dbmon-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Scope --}}
        <section class="dbmon-section" aria-labelledby="dbmon-scope-title">
            <div class="site-shell dbmon-split">
                <div class="dbmon-split__copy">
                    <h2 id="dbmon-scope-title">Service Scope</h2>
                    <div class="dbmon-scope">
                        <p>
                            <strong>24/7 Database Monitoring : </strong>
                            Ensure your database systems are consistently operating at peak performance with our round-the-clock monitoring services.
                        </p>
                        <p>
                            <strong>Performance Tuning and Optimization :</strong>
                            Identify and resolve performance bottlenecks to maintain optimal database efficiency.
                        </p>
                        <p>
                            <strong>Security Management :</strong>
                            Protect your valuable data with robust security measures, including
                            <a href="{{ $vaptUrl }}">vulnerability assessments</a>
                            and threat mitigation.
                        </p>
                        <p>
                            <strong>Backup and Disaster Recovery :</strong>
                            Safeguard your data with strategic backup and disaster recovery planning and execution.
                        </p>
                        <p>
                            <strong>Patch Management and Upgrades :</strong>
                            Keep your database systems up-to-date and secure with regular patch management and upgrades.
                        </p>
                    </div>
                    <a href="#contact-us" class="dbmon-btn dbmon-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="dbmon-split__media dbmon-split__media--photo">
                    <img
                        src="{{ $img('service-scope.png') }}"
                        alt="service scope"
                        width="530"
                        height="630"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Distinctive Approach --}}
        <section class="dbmon-section dbmon-section--mint" aria-labelledby="dbmon-benefits-title">
            <div class="site-shell dbmon-split">
                <div class="dbmon-split__media dbmon-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits-2.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="515"
                        height="555"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dbmon-split__copy">
                    <h2 id="dbmon-benefits-title">Our Distinctive Approach to Customer Benefits</h2>
                    <p>When you choose IBN Tech for your database monitoring and managed service’s needs, you can expect:</p>
                    <ul class="dbmon-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="dbmon-btn dbmon-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="dbmon-section" aria-labelledby="dbmon-process-title">
            <div class="site-shell dbmon-split">
                <div class="dbmon-split__copy">
                    <h2 id="dbmon-process-title">Database Monitoring and Managed Services Process at IBN Tech</h2>
                    <p>
                        Our process for database monitoring and managed services incorporates the following steps, emphasizing our commitment to delivering exceptional service:
                    </p>
                    <ul class="dbmon-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="dbmon-btn dbmon-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="dbmon-split__media dbmon-split__media--photo">
                    <img
                        src="{{ $img('database-monitoring-and-managed-services-process-at-ibn-tech.png') }}"
                        alt="database monitoring and managed services process at ibn tech"
                        width="535"
                        height="683"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="dbmon-section dbmon-closing" aria-labelledby="dbmon-closing-title">
            <div class="site-shell dbmon-closing__inner">
                <h2 id="dbmon-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we pride ourselves on providing high-quality, unique, and customized database monitoring and managed services that cater to your specific needs. Trust us to keep your database systems operating at their best and let us help you achieve the operational efficiency and security your business deserves.
                </p>
                <a href="#contact-us" class="dbmon-btn dbmon-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="dbmon-section dbmon-consult" id="contact-us" aria-labelledby="dbmon-consult-title">
            <div class="site-shell dbmon-consult__inner">
                <aside class="dbmon-consult__card" aria-labelledby="dbmon-consult-title">
                    <div class="dbmon-consult__header">
                        <h2 id="dbmon-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="dbmon-consult__body">
                        <livewire:forms.contact-form
                            form-name="database-monitoring-and-support"
                            id-prefix="dbmon"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="dbmon-consult__media">
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
