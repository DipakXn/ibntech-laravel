@php
    $img = fn (string $file): string => asset('images/virtual-dba-services/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
    $dbPerfUrl = route('page.show', ['slug' => 'database-performance-tuning']);

    $highlightCards = [
        [
            'icon' => 'server-planning-rightsizing.webp',
            'alt' => 'server planning & rightsizing',
            'title' => 'Server Planning & Rightsizing',
            'text' => 'We help strategize and optimize your server resources to align perfectly with your business needs. This includes assessing your current server capacity, future growth projections, and subsequently designing a server strategy that supports your business goals effectively.',
        ],
        [
            'icon' => 'data-migrations.webp',
            'alt' => 'data migrations',
            'title' => 'Data Migrations',
            'text' => 'Data is the lifeblood of any organization. We ensure seamless data migration with minimal disruption to your operations, safeguarding your crucial data during transition and ensuring its integrity post-migration.',
        ],
        [
            'icon' => 'replicationmigrations.webp',
            'alt' => 'replication migrations',
            'title' => 'Replication',
            'text' => 'Our team facilitates data availability and balances load across systems through effective replication strategies. This ensures data redundancy and improves data access speed, contributing to overall system performance.',
        ],
        [
            'icon' => 'upgrades-and-deployments.webp',
            'alt' => 'upgrades and deployments',
            'title' => 'Upgrades and Deployments',
            'text' => 'With the rapid evolution of technology, staying up to date with the latest database versions and features is vital. We handle regular system upgrades and deployments to enhance database performance and security.',
        ],
        [
            'icon' => 'hardware-performance-tuning.webp',
            'alt' => 'hardware performance tuning',
            'title' => 'Hardware Performance Tuning',
            'text' => 'We go beyond just the database software. Our team optimizes hardware configurations for improved database efficiency, considering all aspects from server specs to network configurations.',
        ],
        [
            'icon' => 'data-architecture-planning-and-review.webp',
            'alt' => 'data architecture planning and review',
            'title' => 'Data Architecture Planning and Review',
            'text' => 'Our experts plan and review your data architecture to support scalability and growth, helping you make the most of your data assets.',
        ],
    ];

    $advantages = [
        'Access to a skilled team of DBAs without the cost and hassle of in-house hiring. This allows you to have a top-notch DBA team at your disposal at a fraction of the cost.',
        'Scalable services that adapt to your evolving business needs. As your business grows, our services can scale accordingly to meet increased demand, ensuring consistent database performance.',
        'Enhanced database performance and security. We implement strategic measures to optimize your database operations and secure your valuable data assets.',
        'Quick and efficient resolution of database issues. Our proactive approach and expertise in troubleshooting minimize downtime and ensure smooth operations.',
        'Freedom to focus on core business operations. With our team handling your database administration, your resources can be directed towards strategic growth initiatives.',
    ];

    $processSteps = [
        [
            'title' => 'Detailed Review',
            'text' => 'We begin by conducting a thorough review of your current database setup to understand your specific needs and challenges.',
        ],
        [
            'title' => 'Customized Plan',
            'text' => 'Based on our initial review, we develop a customized management and monitoring plan, tailored to your business requirements.',
        ],
        [
            'title' => 'Proactive Management',
            'text' => 'Our team proactively manages your databases, implementing performance tuning and security measures to ensure optimal operations.',
        ],
        [
            'title' => 'Strategic Procedures',
            'text' => 'We set up strategic backup, recovery, and upgrading procedures to safeguard your data and ensure your systems are up-to-date.',
        ],
        [
            'title' => 'Swift Resolution',
            'text' => 'In case of any issues, our team swiftly handles troubleshooting and resolution, minimizing potential downtime.',
        ],
        [
            'title' => 'Regular Reports',
            'text' => 'We provide regular communication and reports on database health, ensuring you have complete visibility into your database operations.',
        ],
    ];

    $scopeItems = [
        [
            'title' => 'Database Monitoring',
            'html' => 'We provide real-time monitoring services to ensure consistent <a href="'.$dbPerfUrl.'">database performance</a> and to identify potential issues before they escalate.',
        ],
        [
            'title' => 'Performance Tuning',
            'html' => 'Our team works diligently to optimize your database operations for enhanced efficiency and speed, from indexing strategies to query optimization.',
        ],
        [
            'title' => 'Security Management',
            'html' => 'We secure your valuable data with robust security measures, including risk assessments, vulnerability patching, and stringent access controls.',
        ],
        [
            'title' => 'Backup and Recovery',
            'html' => 'We implement strategic plans for data backup and swift recovery, ensuring your data\'s safety and availability even in the event of a disaster.',
        ],
        [
            'title' => 'Upgrades and Patching',
            'html' => 'Our team ensures your systems stay ahead of the curve with regular software upgrades and patches, safeguarding against vulnerabilities and enhancing system performance.',
        ],
        [
            'title' => 'Troubleshooting',
            'html' => 'We quickly resolve database issues with our expert troubleshooting services, minimizing downtime and ensuring smooth operations.',
        ],
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
    @vite(['resources/css/pages/virtual-dba-services.css'])
@endpush

@section('content')
    <div class="vdba-page">
        {{-- Hero --}}
        <section class="vdba-hero" aria-labelledby="vdba-hero-title">
            <div class="site-shell vdba-hero__inner">
                <div class="vdba-hero__copy">
                    <p class="vdba-hero__eyebrow">
                        Elevate Your Business with IBN Tech's Exceptional
                    </p>
                    <h1 id="vdba-hero-title">Virtual DBA Services</h1>
                    <p class="vdba-hero__lede">
                        Maximize success with our expert virtual database administration.
                    </p>
                    <div class="vdba-hero__actions">
                        <a href="#contact-us" class="vdba-btn vdba-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="vdba-hero__media">
                    <img
                        src="{{ $img('virtual-dba-banner.webp') }}"
                        alt="virtual dba"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="vdba-section vdba-intro" aria-labelledby="vdba-intro-title">
            <div class="site-shell vdba-split">
                <div class="vdba-split__media">
                    <img
                        src="{{ $img('in-the-dynamic-world-of-databases.webp') }}"
                        alt="in the dynamic world of databases"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="vdba-split__copy">
                    <h2 id="vdba-intro-title" class="sr-only">In the dynamic world of databases</h2>
                    <p>
                        In the dynamic world of databases, managing them efficiently is crucial for any business's success. At IBN Tech , we offer premier Virtual DBA Services, combining our comprehensive database expertise with the convenience and cost-effectiveness of remote assistance. Our team of seasoned professionals handles the remote dba of your database management, enabling you to direct your focus on strategic business growth.
                    </p>
                    <a href="#contact-us" class="vdba-btn vdba-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Highlights --}}
        <section class="vdba-section vdba-highlights" aria-labelledby="vdba-highlights-title">
            <div class="site-shell">
                <div class="vdba-heading">
                    <h2 id="vdba-highlights-title">IBN tech 'Virtual DBA Services' Highlights</h2>
                    <p>Our Virtual DBA Services encompass a broad range of critical database functions:</p>
                </div>

                <div class="vdba-card-grid" role="list">
                    @foreach ($highlightCards as $item)
                        <article class="vdba-card" role="listitem">
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

                <div class="vdba-section__cta">
                    <a href="{{ $contactUrl }}" class="vdba-btn vdba-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Scope --}}
        <section class="vdba-section vdba-scope" aria-labelledby="vdba-scope-title">
            <div class="site-shell vdba-split">
                <div class="vdba-split__media vdba-split__media--photo">
                    <img
                        src="{{ $img('remote-dba-service-scope.png') }}"
                        alt="remote dba service scope"
                        width="535"
                        height="789"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="vdba-split__copy">
                    <h2 id="vdba-scope-title">Remote DBA Service Scope</h2>
                    <p class="vdba-scope__intro">
                        Our Virtual DBA Services include a comprehensive range of offerings:
                    </p>
                    <div class="vdba-scope__list">
                        @foreach ($scopeItems as $scope)
                            <p>
                                <strong>{{ $scope['title'] }}:</strong> {!! $scope['html'] !!}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="vdba-btn vdba-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Our Unique Customer Advantages --}}
        <section class="vdba-section vdba-advantages" aria-labelledby="vdba-advantages-title">
            <div class="site-shell vdba-split">
                <div class="vdba-split__copy">
                    <h2 id="vdba-advantages-title">Our Unique Customer Advantages</h2>
                    <h3 class="vdba-subhead">When you choose IBN Tech's Virtual DBA Services, you benefit from:</h3>
                    <ul class="vdba-list">
                        @foreach ($advantages as $advantage)
                            <li>{{ $advantage }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="vdba-btn vdba-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="vdba-split__media vdba-split__media--photo">
                    <img
                        src="{{ $img('our-unique-customer-advantages.png') }}"
                        alt="our unique customer advantages"
                        width="535"
                        height="650"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="vdba-section vdba-process" aria-labelledby="vdba-process-title">
            <div class="site-shell vdba-split">
                <div class="vdba-split__media vdba-split__media--photo">
                    <img
                        src="{{ $img('virtual-dba-services-process-at-ibn-tech.png') }}"
                        alt="virtual dba services process at ibn tech"
                        width="535"
                        height="650"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="vdba-split__copy">
                    <h2 id="vdba-process-title">Virtual DBA Services Process at IBN Tech</h2>
                    <h3 class="vdba-subhead">Our comprehensive process ensures you derive maximum value from our services:</h3>
                    <div class="vdba-process__list">
                        @foreach ($processSteps as $step)
                            <p>
                                <strong>{{ $step['title'] }}:</strong> {{ $step['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="vdba-btn vdba-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Closing Banner --}}
        <section class="vdba-section vdba-closing" aria-labelledby="vdba-closing-title">
            <div class="site-shell vdba-closing__inner">
                <h2 id="vdba-closing-title" class="sr-only">Why Partner with IBN Tech for Virtual DBA</h2>
                <p>
                    With IBN Tech as your partner, you gain access to exceptional database administration services that contribute significantly to your business growth. Our Virtual DBA Services offer the expertise, attention, and flexibility your databases need, without the need for on-site staff. Allow us to help you leverage your data more effectively, securely, and economically.
                </p>
                <a href="#contact-us" class="vdba-btn vdba-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="vdba-section vdba-consult"
            id="contact-us"
            aria-labelledby="vdba-consult-title"
        >
            <div class="site-shell vdba-consult__inner">
                <aside class="vdba-consult__card" aria-labelledby="vdba-consult-title">
                    <div class="vdba-consult__header">
                        <h2 id="vdba-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="vdba-consult__body">
                        <livewire:forms.contact-form
                            form-name="virtual-dba-services"
                            id-prefix="vdba"
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

                <div class="vdba-consult__media">
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

