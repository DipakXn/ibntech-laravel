@php
    $img = fn (string $file): string => asset('images/data-migration-services/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $services = [
        [
            'icon' => 'oracle-to-sql-server-migration.webp',
            'alt' => 'oracle to sql server migration',
            'title' => 'Oracle to SQL Server Migration',
            'text' => 'Facilitate seamless migration from Oracle to SQL Server, ensuring optimal performance, scalability, and cost-efficiency by leveraging our expertise.',
        ],
        [
            'icon' => 'mysql-to-sql-server-migration.webp',
            'alt' => 'mysql to sql server migration',
            'title' => 'MySQL to SQL Server Migration',
            'text' => 'Guarantee a smooth transition from MySQL to SQL Server with minimal data loss and downtime, harnessing our proven methodologies.',
        ],
        [
            'icon' => 'postgresql-to-sql-server-migration.webp',
            'alt' => 'postgresql-to-sql-server-migration',
            'title' => 'PostgreSQL to SQL Server Migration',
            'text' => 'Trust our experienced team to handle your PostgreSQL to SQL Server migration, ensuring data integrity and performance optimization.',
        ],
        [
            'icon' => 'db2-to-sql-server-migration.webp',
            'alt' => 'db2 to sql server migration',
            'title' => 'DB2 to SQL Server Migration',
            'text' => 'Rely on our knowledge and skills to guide you through the process of migrating from DB2 to SQL Server while preserving data accuracy and consistency.',
        ],
        [
            'icon' => 'sybase-to-sql-server-migration.webp',
            'alt' => 'sybase to sql server migration',
            'title' => 'Sybase to SQL Server Migration',
            'text' => 'Navigate the complexities of Sybase to SQL Server migration with our expert guidance, ensuring a secure and efficient transition.',
        ],
        [
            'icon' => 'oracle-to-postgresql-migration.webp',
            'alt' => 'oracle to postgresql migration',
            'title' => 'Oracle to PostgreSQL Migration',
            'text' => 'Benefit from our extensive experience in migrating from Oracle to PostgreSQL, resulting in a smooth and reliable transition.',
        ],
    ];

    $benefits = [
        'Expert-driven data handling with a proven track record of success',
        'Significantly reduced downtime, minimizing disruption to daily operations',
        'State-of-the-art data security throughout the migration process',
        'Post-migration database performance optimization',
        'Ongoing support and maintenance services for continued satisfaction and improvement',
    ];

    $processSteps = [
        [
            'icon' => 'pre-migration-assessment-and-planning.webp',
            'alt' => 'pre-migration assessment and planning',
            'title' => 'Pre-migration assessment and planning',
        ],
        [
            'icon' => 'customize-migration-strategy-development.webp',
            'alt' => 'customize migration strategy development',
            'title' => 'Customized migration strategy development',
        ],
        [
            'icon' => 'data-mapping-and-transformation.webp',
            'alt' => 'data mapping and transformation',
            'title' => 'Data mapping and transformation',
        ],
        [
            'icon' => 'rigorous-testing-for-data-integrity.webp',
            'alt' => 'rigourous testinf for data tntegriety and cinsitency',
            'title' => 'Rigorous testing for data integrity and consistency',
        ],
        [
            'icon' => 'secure-and-efficient-data-transfer.webp',
            'alt' => 'Secure and efficient data transfer',
            'title' => 'Secure and efficient data transfer',
        ],
        [
            'icon' => 'post-migration-performance-tuning.webp',
            'alt' => 'post migration performance training',
            'title' => 'Post-migration performance tuning and optimization',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/data-migration-services.css'])
@endpush

@section('content')
    <div class="dms-page">
        {{-- Hero --}}
        <section class="dms-hero" aria-labelledby="dms-hero-title">
            <div class="site-shell dms-hero__inner">
                <div class="dms-hero__copy">
                    <h1 id="dms-hero-title">Mastering Database Migration Services with IBN Tech</h1>
                    <p class="dms-hero__lede">
                        Empower your business with smooth, secure, and expert-driven database migration
                    </p>
                    <a href="{{ $contactUrl }}" class="dms-btn dms-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="dms-hero__media">
                    <img
                        src="{{ $img('mastering-database-migration-banner.webp') }}"
                        alt="Mastering Database Migration"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="dms-section dms-intro" aria-labelledby="dms-intro-title">
            <div class="site-shell dms-split">
                <div class="dms-split__media">
                    <img
                        src="{{ $img('at-ibn-tech.webp') }}"
                        alt="at ibn tech"
                        width="469"
                        height="418"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dms-split__copy">
                    <h2 id="dms-intro-title" class="sr-only">About IBN Tech database migration</h2>
                    <p>
                        At IBN Tech, we specialize in providing top-notch database migration services to ensure a smooth and secure transition of your data. Our team of skilled professionals has years of experience in handling complex migrations, boasting a 98% success rate in delivering the best possible results for your business.
                    </p>
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="dms-section dms-services" aria-labelledby="dms-services-title">
            <div class="site-shell">
                <div class="dms-heading">
                    <h2 id="dms-services-title">
                        Our Database Migration Services offer a comprehensive solution for businesses looking to transition their data from one system to another. Our services include:
                    </h2>
                </div>

                <div class="dms-service-grid" role="list">
                    @foreach ($services as $service)
                        <article class="dms-service-card" role="listitem">
                            <img
                                src="{{ $img($service['icon']) }}"
                                alt="{{ $service['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="dms-section__cta">
                    <a href="{{ $contactUrl }}" class="dms-btn dms-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Value --}}
        <section class="dms-section dms-value" aria-labelledby="dms-value-title">
            <div class="site-shell dms-split">
                <div class="dms-split__copy">
                    <h2 id="dms-value-title">How We Deliver Value to Our Customers</h2>
                    <p>When you choose IBN Tech for your database migration needs, you can expect the following advantages:</p>
                    <ul class="dms-list">
                        @foreach ($benefits as $benefit)
                            <li>{{ $benefit }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="dms-btn dms-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="dms-split__media dms-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits.webp') }}"
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
        <section class="dms-section dms-process" aria-labelledby="dms-process-title">
            <div class="site-shell">
                <div class="dms-heading">
                    <h2 id="dms-process-title">Migration Process and Crucial Steps Handled by IBN Tech</h2>
                    <p>
                        Our detailed migration process involves the following steps, with a focus on aspects often overlooked by other agencies:
                    </p>
                </div>

                <div class="dms-process-grid" role="list">
                    @foreach ($processSteps as $step)
                        <article class="dms-process-card" role="listitem">
                            <img
                                src="{{ $img($step['icon']) }}"
                                alt="{{ $step['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $step['title'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="dms-section__cta">
                    <a href="{{ $contactUrl }}" class="dms-btn dms-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="dms-cta" aria-labelledby="dms-cta-title">
            <div class="site-shell dms-cta__inner">
                <h2 id="dms-cta-title">
                    By meticulously handling each of these steps, IBN Tech ensures a smooth and successful migration that meets your unique business needs.
                </h2>
                <p>
                    At IBN Tech, we pride ourselves on delivering high-quality, unique, and customized database migration solutions backed by solid data and success metrics. Trust us to ensure a seamless transition of your valuable data and let us help you navigate the complexities of database migration with ease.
                </p>
                <a href="{{ $contactUrl }}" class="dms-btn dms-btn--green" data-contact-modal-trigger>
                    Get Started Now
                </a>
            </div>
        </section>
    </div>
@endsection
