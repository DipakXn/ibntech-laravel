@php
    $img = fn (string $file): string => asset('images/performance-testing/'.$file);

    $features = [
        [
            'icon' => 'load-testing-1.webp',
            'alt' => 'load testing',
            'title' => 'Load Testing',
            'text' => 'Gauge your software\'s performance under expected user loads.',
        ],
        [
            'icon' => 'stress-testing.webp',
            'alt' => 'stress testing',
            'title' => 'Stress Testing',
            'text' => 'Determine your software\'s robustness and reliability under extreme conditions.',
        ],
        [
            'icon' => 'endurance-testing.webp',
            'alt' => 'endurance testing',
            'title' => 'Endurance Testing',
            'text' => 'Assess your software\'s ability to handle sustained use over a long period.',
        ],
        [
            'icon' => 'spike-testing.webp',
            'alt' => 'spike testing',
            'title' => 'Spike Testing',
            'text' => 'Evaluate your software\'s performance under sudden, unexpected increases in load.',
        ],
    ];

    $coverage = [
        [
            'title' => 'Performance Testing Strategy and Planning:',
            'text' => ' We begin by understanding your performance requirements and developing a comprehensive testing strategy.',
        ],
        [
            'title' => 'Test Case Development:',
            'text' => ' Our experts design precise test cases to ensure thorough testing of all performance parameters.',
        ],
        [
            'title' => 'Performance Test Execution:',
            'text' => ' We meticulously execute the test cases, measuring your software\'s responsiveness, stability, speed, and scalability.',
        ],
        [
            'title' => 'Performance Analysis and Reporting:',
            'text' => ' We provide detailed performance reports, identifying bottlenecks and areas for improvement.',
        ],
    ];

    $benefits = [
        [
            'title' => 'Improved Software Performance:',
            'text' => ' By identifying and rectifying performance issues early, we help enhance your software\'s speed, responsiveness, and stability.',
        ],
        [
            'title' => 'Enhanced User Experience:',
            'text' => ' A high-performing software provides a smooth and satisfying user experience, leading to increased user satisfaction and loyalty.',
        ],
        [
            'title' => 'Reduced Costs:',
            'text' => ' Early identification and resolution of performance issues help in avoiding costly repairs and downtime in the future.',
        ],
    ];

    $processSteps = [
        [
            'title' => 'Performance Testing Strategy and Planning:',
            'text' => ' We understand your performance requirements and develop a comprehensive testing strategy.',
        ],
        [
            'title' => 'Test Case Development:',
            'text' => ' We design precise test cases to ensure thorough testing of all performance parameters.',
        ],
        [
            'title' => 'Performance Test Execution:',
            'text' => ' We meticulously execute the test cases, measuring your software\'s performance under various conditions.',
        ],
        [
            'title' => 'Performance Analysis and Reporting:',
            'text' => ' We provide detailed performance reports, identifying bottlenecks and suggesting areas for improvement.',
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
    @vite(['resources/css/pages/performance-testing.css'])
@endpush

@section('content')
    <div class="ptest-page">
        {{-- Hero --}}
        <section class="ptest-hero" aria-labelledby="ptest-hero-title">
            <div class="site-shell ptest-hero__inner">
                <div class="ptest-hero__copy">
                    <p class="ptest-hero__eyebrow">
                        Ensure High-Performing Software Products with IBN Tech's Comprehensive Performance Testing Services
                    </p>
                    <h1 id="ptest-hero-title">Performance Testing Services</h1>
                    <p class="ptest-hero__lede">
                        Unlock unparalleled software performance with our expert performance testing solutions
                    </p>
                    <div class="ptest-hero__actions">
                        <a href="#contact-us" class="ptest-btn ptest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="ptest-hero__media">
                    <img
                        src="{{ $img('performance-testing-services.webp') }}"
                        alt="performance testing services"
                        width="700"
                        height="700"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="ptest-section ptest-intro" aria-labelledby="ptest-intro-title">
            <div class="site-shell ptest-split">
                <div class="ptest-split__media ptest-split__media--photo">
                    <img
                        src="{{ $img('at-ibn-techh-we-understand-that-performance-is-a-critical-aspect.webp') }}"
                        alt="at ibn techh we understand that performance is a critical aspect"
                        width="560"
                        height="604"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="ptest-split__copy">
                    <h2 id="ptest-intro-title" class="sr-only">About IBN Tech Performance Testing</h2>
                    <p>
                        At IBN Tech, we understand that performance is a critical aspect of a successful software product. Our Performance Testing Services are designed to ensure that your software can handle the expected load and perform optimally under various conditions.
                    </p>
                    <a href="#contact-us" class="ptest-btn ptest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Key Service Features --}}
        <section class="ptest-section ptest-features" aria-labelledby="ptest-features-title">
            <div class="site-shell">
                <div class="ptest-heading">
                    <h2 id="ptest-features-title">Key Service Features</h2>
                    <p>Our Performance Testing Services are tailored to address a broad spectrum of requirements, including:</p>
                </div>

                <div class="ptest-features-grid" role="list">
                    @foreach ($features as $item)
                        <article class="ptest-feature-card" role="listitem">
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

                <div class="ptest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="ptest-btn ptest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Coverage --}}
        <section class="ptest-section ptest-section--soft" aria-labelledby="ptest-coverage-title">
            <div class="site-shell ptest-split">
                <div class="ptest-split__copy">
                    <h2 id="ptest-coverage-title">Our Service Coverage</h2>
                    <p>Our range of performance testing services include:</p>
                    <div class="ptest-scope">
                        @foreach ($coverage as $item)
                            <p>
                                <strong>{{ $item['title'] }}</strong>{{ $item['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="ptest-btn ptest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="ptest-split__media ptest-split__media--photo">
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

        {{-- Unique approach --}}
        <section class="ptest-section" aria-labelledby="ptest-benefits-title">
            <div class="site-shell ptest-split">
                <div class="ptest-split__media ptest-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits-6.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="560"
                        height="604"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="ptest-split__copy">
                    <h2 id="ptest-benefits-title">Our Unique Approach to Customer Benefits</h2>
                    <p>By choosing IBN Tech's Mobile App Testing services, you gain:</p>
                    <div class="ptest-scope">
                        @foreach ($benefits as $item)
                            <p>
                                <strong>{{ $item['title'] }}</strong>{{ $item['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="ptest-btn ptest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="ptest-section ptest-section--mint" aria-labelledby="ptest-process-title">
            <div class="site-shell ptest-split">
                <div class="ptest-split__copy">
                    <h2 id="ptest-process-title">Performance Testing Process at IBN Tech</h2>
                    <p>Our performance testing process is meticulous and systematic, incorporating the following steps:</p>
                    <div class="ptest-scope">
                        @foreach ($processSteps as $step)
                            <p>
                                <strong>{{ $step['title'] }}</strong>{{ $step['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="ptest-btn ptest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="ptest-split__media ptest-split__media--photo">
                    <img
                        src="{{ $img('performance-testing-process-at-ibn-tech-1.webp') }}"
                        alt="performance testing process at ibn tech"
                        width="700"
                        height="700"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="ptest-closing" aria-labelledby="ptest-closing-title">
            <div class="site-shell ptest-closing__inner">
                <h2 id="ptest-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we take pride in delivering high-quality, unique, and tailored performance testing services that cater to your specific needs. Trust us to ensure your software systems deliver top-notch performance under all conditions, leading to a satisfying user experience and improved business outcomes.
                </p>
                <a href="#contact-us" class="ptest-btn ptest-btn--green">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="ptest-section ptest-consult ptest-section--soft" id="contact-us" aria-labelledby="ptest-consult-title">
            <div class="site-shell ptest-consult__inner">
                <aside class="ptest-consult__card" aria-labelledby="ptest-consult-title">
                    <div class="ptest-consult__header">
                        <h2 id="ptest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="ptest-consult__body">
                        <livewire:forms.contact-form
                            form-name="performance-testing"
                            id-prefix="ptest"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Message"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="ptest-consult__media">
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
