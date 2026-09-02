@php
    $img = fn (string $file): string => asset('images/database-consulting/'.$file);

    $highlights = [
        [
            'file' => 'core-database-assessment.webp',
            'alt' => 'core database assessment',
            'title' => 'Core Database Assessment',
            'text' => 'Evaluate your current database system and identify areas for improvement and optimization.',
        ],
        [
            'file' => 'mysql-to-sql-server-migration.webp',
            'alt' => 'mysql to sql server migration',
            'title' => 'MySQL to SQL Server Migration',
            'text' => 'Guarantee a smooth transition from MySQL to SQL Server with minimal data loss and downtime, harnessing our proven methodologies.',
        ],
        [
            'file' => 'database-performance-assessment.webp',
            'alt' => 'database performance assessment',
            'title' => 'Database Performance Assessment',
            'text' => 'Analyze performance metrics and pinpoint bottlenecks to boost efficiency and reliability.',
        ],
        [
            'file' => 'database_application-performance-assessment.webp',
            'alt' => 'database_application performance assessment',
            'title' => 'Database/Application Performance Assessment',
            'text' => 'Examine the interaction between your database and applications to optimize overall system performance.',
        ],
        [
            'file' => 'database-virtualization-assessment.webp',
            'alt' => 'database virtualization assessment_application performance assessment',
            'title' => 'Database Virtualization Assessment',
            'text' => 'Assess the potential benefits and challenges of database virtualization for your business.',
        ],
        [
            'file' => 'database-upgrade-assessment.webp',
            'alt' => 'database upgrade assessment',
            'title' => 'Database Upgrade Assessment',
            'text' => 'Determine the feasibility and advantages of upgrading your database system.',
        ],
        [
            'file' => 'database-security-assessment.webp',
            'alt' => 'database security assessment',
            'title' => 'Database Security Assessment',
            'text' => 'Evaluate your database\'s security measures and identify potential vulnerabilities.',
        ],
        [
            'file' => 'database-ha-dr-assessment.webp',
            'alt' => 'database ha_dr assessment',
            'title' => 'Database HA/DR Assessment',
            'text' => 'Analyze your database\'s high availability and disaster recovery capabilities and provide recommendations for improvement.',
        ],
        [
            'file' => 'database-migration-assessment.webp',
            'alt' => 'database migration assessment',
            'title' => 'Database Migration Assessment',
            'text' => 'Assess the feasibility and requirements for database migration projects.',
        ],
    ];

    $scopeItems = [
        [
            'title' => 'Database Upgrade Assessment',
            'text' => 'Develop efficient and scalable database systems that align with your business goals.',
        ],
        [
            'title' => 'Performance Tuning and Optimization',
            'text' => 'Identify and resolve performance bottlenecks to ensure optimal database efficiency.',
        ],
        [
            'title' => 'Migration and Upgrade Services',
            'text' => 'Seamlessly transition to new database systems or upgrade existing ones with minimal disruption.',
        ],
        [
            'title' => 'Disaster Recovery and Backup Planning',
            'text' => 'Implement robust disaster recovery and backup strategies to safeguard your valuable data.',
            'linked' => true,
        ],
        [
            'title' => 'Training and Education',
            'text' => 'Equip your team with the skills and knowledge necessary to manage and maintain your database systems effectively.',
        ],
    ];

    $benefits = [
        'Access to a team of skilled professionals with extensive experience in diverse database environments',
        'Customized database solutions that are aligned with your unique business objectives.',
        'Comprehensive guidance throughout the entire consulting process, from assessment to implementation',
        'Proactive identification of potential issues and opportunities for improvement',
        'Continuous support to ensure the long-term success of your database systems.',
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
    @vite(['resources/css/pages/database-consulting.css'])
@endpush

@section('content')
    <div class="dbc-page">
        {{-- Hero --}}
        <section class="dbc-hero" aria-labelledby="dbc-hero-title">
            <div class="site-shell dbc-hero__inner">
                <div class="dbc-hero__copy">
                    <p class="dbc-hero__eyebrow">
                        Empower your business with tailored database solutions from seasoned professionals
                    </p>
                    <h1 id="dbc-hero-title">Database Consulting</h1>
                    <p class="dbc-hero__lede">
                        Drive Success with Expert Database Consulting Services by IBN Tech
                    </p>
                    <div class="dbc-hero__actions">
                        <a href="#contact-us" class="dbc-btn dbc-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="dbc-hero__media">
                    <img
                        src="{{ $img('database-consulting-banner.webp') }}"
                        alt="database consulting banner"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="dbc-section" aria-labelledby="dbc-intro-title">
            <div class="site-shell dbc-split">
                <div class="dbc-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dbc-split__copy">
                    <h2 id="dbc-intro-title" class="sr-only">Expert Database Consulting from IBN Tech</h2>
                    <p>
                        <strong>IBN Tech's</strong> database consulting services provide comprehensive guidance and support for businesses seeking to optimize their database systems. Our experienced consultants possess a deep understanding of diverse database environments and are committed to designing solutions that drive success and operational efficiency.
                    </p>
                    <a href="#contact-us" class="dbc-btn dbc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Highlights --}}
        <section class="dbc-section" aria-labelledby="dbc-highlights-title">
            <div class="site-shell">
                <div class="dbc-heading">
                    <h2 id="dbc-highlights-title">IBN Data base Service Highlights</h2>
                    <p>Our Database Consulting services cover a wide range of essential aspects, including:</p>
                </div>

                <div class="dbc-highlights" role="list">
                    @foreach ($highlights as $item)
                        <article class="dbc-highlight" role="listitem">
                            <img
                                src="{{ $img($item['file']) }}"
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

                <div class="dbc-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="dbc-btn dbc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Basic Scope --}}
        <section class="dbc-section dbc-section--soft" aria-labelledby="dbc-scope-title">
            <div class="site-shell dbc-split">
                <div class="dbc-split__copy">
                    <h2 id="dbc-scope-title">Service Basic Scope</h2>
                    <div class="dbc-scope">
                        @foreach ($scopeItems as $item)
                            <p>
                                <strong>{{ $item['title'] }}:</strong>
                                @if (! empty($item['linked']))
                                    Implement robust
                                    <a href="{{ route('page.show', ['slug' => 'business-continuity-disaster-recovery-services']) }}">disaster recovery</a>
                                    and backup strategies to safeguard your valuable data.
                                @else
                                    {{ $item['text'] }}
                                @endif
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="dbc-btn dbc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="dbc-split__media dbc-split__media--photo">
                    <img
                        src="{{ $img('service-basic-scope.webp') }}"
                        alt="service basic scope"
                        width="515"
                        height="569"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Unique Approach --}}
        <section class="dbc-section" aria-labelledby="dbc-benefits-title">
            <div class="site-shell dbc-split">
                <div class="dbc-split__media dbc-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="515"
                        height="555"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="dbc-split__copy">
                    <h2 id="dbc-benefits-title">Our Unique Approach to Customer Benefits</h2>
                    <p>When you choose IBN Tech for your database consulting needs, you can expect the following advantages:</p>
                    <ul class="dbc-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="dbc-btn dbc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="dbc-section dbc-section--soft" aria-labelledby="dbc-process-title">
            <div class="site-shell dbc-split">
                <div class="dbc-split__copy">
                    <h2 id="dbc-process-title">Database Consulting Process and Crucial Steps Handled by IBN Tech</h2>
                    <p>Our detailed database consulting process involves the following steps, highlighting our unique approach:</p>
                    <div class="dbc-scope">
                        @foreach ($scopeItems as $item)
                            <p>
                                <strong>{{ $item['title'] }}:</strong>
                                {{ $item['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="dbc-btn dbc-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="dbc-split__media dbc-split__media--photo">
                    <img
                        src="{{ $img('database-consulting-process.webp') }}"
                        alt="database consulting process and crucial steps handled by ibn tech"
                        width="536"
                        height="839"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Closing --}}
        <section class="dbc-section dbc-closing" aria-labelledby="dbc-closing-title">
            <div class="site-shell dbc-closing__inner">
                <h2 id="dbc-closing-title">
                    By meticulously handling each of these steps, IBN Tech ensures your database systems are optimized to meet the demands of your business.
                </h2>
                <p>
                    At IBN Tech, we pride ourselves on delivering high-quality, unique, and customized database consulting solutions backed by solid data and success metrics. Trust us to help you navigate the complexities of database management and optimization and let us guide you toward achieving unparalleled performance and efficiency.
                </p>
                <a href="#contact-us" class="dbc-btn dbc-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="dbc-section dbc-consult" id="contact-us" aria-labelledby="dbc-consult-title">
            <div class="site-shell dbc-consult__inner">
                <aside class="dbc-consult__card" aria-labelledby="dbc-consult-title">
                    <div class="dbc-consult__header">
                        <h2 id="dbc-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="dbc-consult__body">
                        <livewire:forms.contact-form
                            form-name="database-consulting"
                            id-prefix="dbc"
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

                <div class="dbc-consult__media">
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
