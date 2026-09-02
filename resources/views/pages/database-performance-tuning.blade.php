@php
    $img = fn (string $file): string => asset('images/database-performance-tuning/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
    $monitoringUrl = route('page.show', ['slug' => 'database-monitoring-and-support']);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $scopeItems = [
        [
            'icon' => 'core-database-assessment.webp',
            'alt' => 'core database assessment',
            'title' => 'Monitoring Services',
            'html' => 'Our comprehensive <a href="'.e($monitoringUrl).'">monitoring services</a> provide real-time insights into your database\'s performance, enabling proactive identification and resolution of potential issues.',
        ],
        [
            'icon' => 'mysql-to-sql-server-migration.webp',
            'alt' => 'mysql to sql server migration',
            'title' => 'Performance Tuning Services',
            'html' => 'Our team of experts will analyze your database\'s performance metrics and implement targeted optimizations to improve efficiency, reduce latency, and ensure data consistency.',
        ],
    ];

    $benefits = [
        'Expert-driven solutions tailored to your unique business requirements.',
        'Enhanced database performance and resource utilization',
        'Reduced latency and faster query execution times',
        'Optimized storage and I/O configurations for maximum efficiency',
        'Ongoing support and maintenance services for continued satisfaction and improvement',
        'Performance Tuning Process and Crucial Steps Handled by IBN Tech',
    ];

    $processSteps = [
        'Initial assessment and analysis of current database performance',
        'Identification of performance bottlenecks and optimization opportunities',
        'Customized tuning strategy development',
        'Implementation of targeted optimizations and best practices',
        'Rigorous testing and validation of performance improvements',
        'Post-tuning performance monitoring and analysis',
        'Ongoing support and maintenance for continued optimization',
    ];

    $tuningPoints = [
        [
            'title' => 'Oracle to SQL Server Migration',
            'text' => 'Our Database Performance Tuning services are tailored to cater to various aspects of your database system, including:',
        ],
        [
            'title' => 'Database, Server, and Instance',
            'text' => 'Enhance your overall database performance by identifying and resolving issues at the server and instance level, ensuring stability and peak efficiency.',
        ],
        [
            'title' => 'Storage and I/O',
            'text' => 'Optimize storage and I/O configurations to reduce latency, boost throughput, and maximize resource utilization.',
        ],
        [
            'title' => 'OLTP, DW, and eCommerce',
            'text' => 'Fine-tune your transactional, data warehousing, and eCommerce databases to maintain high performance and seamless user experience.',
        ],
        [
            'title' => 'SQL Statement Tuning',
            'text' => 'Improve query execution times and resource usage with our expert SQL statement tuning, leading to faster data retrieval, and processing.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/database-performance-tuning.css'])
@endpush

@section('content')
    <div class="dpt-page">
        {{-- Hero --}}
        <section class="dpt-hero" aria-labelledby="dpt-hero-title">
            <div class="site-shell dpt-hero__inner">
                <div class="dpt-hero__copy">
                    <h1 id="dpt-hero-title">Enhance Your Database Performance with IBN Tech's Expertise</h1>
                    <p class="dpt-hero__lede">
                        Unlock the full potential of your database with our specialized performance tuning solutions.
                    </p>
                    <a href="#contact-us" class="dpt-btn dpt-btn--green">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="dpt-hero__media">
                    <img
                        src="{{ $img('enhance-your-database.webp') }}"
                        alt="enhance your database"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="dpt-section dpt-intro" aria-labelledby="dpt-intro-title">
            <div class="site-shell dpt-intro__inner">
                <h2 id="dpt-intro-title" class="sr-only">IBN Tech database performance tuning</h2>
                <p>
                    IBN Tech's database performance tuning services are designed to optimize your database's efficiency and reliability. Our team of skilled professionals possesses extensive experience in identifying and resolving performance bottlenecks, ensuring your business can operate at peak efficiency.
                </p>
                <a href="#contact-us" class="dpt-btn dpt-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Tuning capabilities --}}
        <section class="dpt-section dpt-tuning" aria-labelledby="dpt-tuning-title">
            <div class="site-shell dpt-split">
                <div class="dpt-split__media">
                    <img
                        src="{{ $img('img-2.webp') }}"
                        alt="Oracle to SQL"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="dpt-split__copy">
                    <h2 id="dpt-tuning-title" class="sr-only">Database performance tuning capabilities</h2>
                    @foreach ($tuningPoints as $point)
                        <p>
                            <strong>{{ $point['title'] }} :</strong> {{ $point['text'] }}
                        </p>
                    @endforeach
                    <a href="#contact-us" class="dpt-btn dpt-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service scope --}}
        <section class="dpt-section dpt-scope" aria-labelledby="dpt-scope-title">
            <div class="site-shell">
                <div class="dpt-heading">
                    <h2 id="dpt-scope-title">Service Scope</h2>
                </div>

                <div class="dpt-scope-grid" role="list">
                    @foreach ($scopeItems as $item)
                        <article class="dpt-scope-card" role="listitem">
                            <img
                                src="{{ $img($item['icon']) }}"
                                alt="{{ $item['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{!! $item['html'] !!}</p>
                        </article>
                    @endforeach
                </div>

                <div class="dpt-section__cta">
                    <a href="{{ $contactUrl }}" class="dpt-btn dpt-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Unique approach --}}
        <section class="dpt-section dpt-approach" aria-labelledby="dpt-approach-title">
            <div class="site-shell">
                <div class="dpt-heading">
                    <h2 id="dpt-approach-title">Our Unique Approach to Customer Benefits</h2>
                    <p>When you choose IBN Tech for your database performance tuning needs, you can expect the following advantages:</p>
                </div>

                <div class="dpt-split">
                    <div class="dpt-split__media dpt-split__media--photo">
                        <img
                            src="{{ $img('our-unique-approach.webp') }}"
                            alt="our unique approach"
                            width="778"
                            height="618"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="dpt-split__copy">
                        <ul class="dpt-list">
                            @foreach ($benefits as $benefit)
                                <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="dpt-section__cta">
                    <a href="{{ $contactUrl }}" class="dpt-btn dpt-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="dpt-section dpt-process" aria-labelledby="dpt-process-title">
            <div class="site-shell dpt-split">
                <div class="dpt-split__copy">
                    <h2 id="dpt-process-title">
                        Our detailed performance tuning process involves the following steps, with a focus on aspects often overlooked by other agencies:
                    </h2>
                    <ul class="dpt-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="dpt-btn dpt-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="dpt-split__media">
                    <img
                        src="{{ $img('our-detailed-performance.webp') }}"
                        alt="our detailed performance"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="dpt-cta" aria-labelledby="dpt-cta-title">
            <div class="site-shell dpt-cta__inner">
                <h2 id="dpt-cta-title">
                    By meticulously handling each of these steps, IBN Tech ensures your database performance is optimized to meet the demands of your business.
                </h2>
                <a href="#contact-us" class="dpt-btn dpt-btn--green">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="dpt-section dpt-consult"
            id="contact-us"
            aria-labelledby="dpt-consult-title"
        >
            <div class="site-shell dpt-consult__inner">
                <aside class="dpt-consult__card" aria-labelledby="dpt-consult-title">
                    <div class="dpt-consult__header">
                        <h2 id="dpt-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="dpt-consult__body">
                        <livewire:forms.contact-form
                            form-name="database-performance-tuning"
                            id-prefix="dpt"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Message"
                            :message-rows="4"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="dpt-consult__media">
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
