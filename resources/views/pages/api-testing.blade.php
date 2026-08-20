@php
    $img = fn (string $file): string => asset('images/api-testing/'.$file);

    $serviceEdge = [
        [
            'icon' => 'api-testing-icon.webp',
            'alt' => 'api testing icon',
            'title' => 'Automated API Testing',
            'text' => 'Enhance the speed and efficiency of your testing processes with our automated API testing solutions.',
        ],
        [
            'icon' => 'reliability-testing.webp',
            'alt' => 'reliability testing',
            'title' => 'Reliability Testing',
            'text' => 'Validate the stability and reliability of your APIs under different conditions.',
        ],
        [
            'icon' => 'load-testing.webp',
            'alt' => 'load testing',
            'title' => 'Load Testing',
            'text' => 'Assess the performance of your APIs under heavy loads to ensure optimal functionality.',
        ],
        [
            'icon' => 'negative-testing.webp',
            'alt' => 'negative testing',
            'title' => 'Negative Testing',
            'text' => 'Identify potential weaknesses in your APIs by testing them beyond their normal operational capacity.',
        ],
    ];

    $capabilities = [
        [
            'icon' => 'functional-testing.webp',
            'alt' => 'functional testing',
            'title' => 'Functional Testing',
            'text' => 'Validate the functionality of your APIs to ensure they perform as expected.',
        ],
        [
            'icon' => 'security-testing.webp',
            'alt' => 'security testing',
            'title' => 'Security Testing',
            'text' => 'Verify the security of your APIs to protect against potential threats',
        ],
        [
            'icon' => 'performance-testing.webp',
            'alt' => 'performance testing',
            'title' => 'Performance Testing',
            'text' => 'Assess the performance of your APIs under different loads and conditions.',
        ],
        [
            'icon' => 'integration-testing.webp',
            'alt' => 'integration testing',
            'title' => 'Integration Testing',
            'text' => 'Test the interoperability of your APIs with other system components.',
        ],
        [
            'icon' => 'regression-testing.webp',
            'alt' => 'regression testing',
            'title' => 'Regression Testing',
            'text' => 'Confirm the functionality of your APIs after modifications.',
        ],
        [
            'icon' => 'usability-testing.webp',
            'alt' => 'usability testing',
            'title' => 'Usability Testing',
            'text' => 'Evaluate the user-friendliness of your APIs.',
        ],
        [
            'icon' => 'documentation-testing.webp',
            'alt' => 'documentation testing',
            'title' => 'Documentation Testing',
            'text' => 'Ensure your API documentation is accurate and comprehensive.',
        ],
        [
            'icon' => 'compliance-testing.webp',
            'alt' => 'compliance testing',
            'title' => 'Compliance Testing',
            'text' => 'Verify your APIs comply with relevant regulations and standards.',
        ],
        [
            'icon' => 'localization-testing.webp',
            'alt' => 'localization testing',
            'title' => 'Localization Testing',
            'text' => 'Validate the functionality of your APIs in different locales.',
        ],
    ];

    $benefits = [
        'A team of experienced testers with deep expertise in API testing methodologies.',
        'Comprehensive API testing solutions tailored to your specific needs.',
        'Enhanced software reliability, performance, and security.',
        'Faster time to market due to efficient and effective testing processes.',
    ];

    $processSteps = [
        'Understanding your API specifications and testing needs.',
        'Designing and implementing a comprehensive API testing plan.',
        'Conducting rigorous API tests to validate functionality, performance, and security. Providing detailed test reports with actionable insights.',
        'Offering ongoing support and consultation to ensure the smooth operation of your APIs.',
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
    @vite(['resources/css/pages/api-testing.css'])
@endpush

@section('content')
    <div class="apitest-page">
        {{-- Hero --}}
        <section class="apitest-hero" aria-labelledby="apitest-hero-title">
            <div class="site-shell apitest-hero__inner">
                <div class="apitest-hero__copy">
                    <p class="apitest-hero__eyebrow">
                        "Boost the reliability of your software's integrations and interactions with our expert API Testing."
                    </p>
                    <h1 id="apitest-hero-title">API Testing</h1>
                    <p class="apitest-hero__lede">
                        APIs are the backbone of modern digital experiences, with 83% of web traffic being API traffic (Akamai, 2022). Ensure seamless interoperability with IBN Tech's comprehensive API Testing Services.
                    </p>
                    <div class="apitest-hero__actions">
                        <a href="#contact-us" class="apitest-btn apitest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="apitest-hero__media">
                    <img
                        src="{{ $img('api-testing.webp') }}"
                        alt="api-testing"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="apitest-section" aria-labelledby="apitest-intro-title">
            <div class="site-shell apitest-split">
                <div class="apitest-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="apitest-split__copy">
                    <h2 id="apitest-intro-title" class="sr-only">About IBN Tech API Testing</h2>
                    <p>
                        IBN Tech's API Testing services are designed to ensure the seamless functionality and interoperability of your application programming interfaces (APIs). Our expert team employs rigorous testing methodologies to verify the performance, security, and reliability of your APIs, contributing to the smooth operation of your software systems and applications.
                    </p>
                    <a href="#contact-us" class="apitest-btn apitest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Our Service Edge --}}
        <section class="apitest-section" aria-labelledby="apitest-edge-title">
            <div class="site-shell">
                <div class="apitest-heading">
                    <h2 id="apitest-edge-title">Our Service Edge</h2>
                    <p>
                        Our
                        <a href="{{ route('page.show', ['slug' => 'vapt-services']) }}">API Testing services</a>
                        encompass a variety of key testing methodologies, including:
                    </p>
                </div>

                <div class="apitest-edge-grid" role="list">
                    @foreach ($serviceEdge as $item)
                        <article class="apitest-edge-card" role="listitem">
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

                <div class="apitest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="apitest-btn apitest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Capabilities --}}
        <section class="apitest-section" aria-labelledby="apitest-capabilities-title">
            <div class="site-shell">
                <div class="apitest-heading">
                    <h2 id="apitest-capabilities-title">Service Capabilities</h2>
                    <p>Our API Testing services provide a comprehensive approach to validating your APIs:</p>
                </div>

                <div class="apitest-cap-grid" role="list">
                    @foreach ($capabilities as $item)
                        <article class="apitest-cap-card" role="listitem">
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

                <div class="apitest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="apitest-btn apitest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Benefits --}}
        <section class="apitest-section apitest-section--mint" aria-labelledby="apitest-benefits-title">
            <div class="site-shell apitest-split apitest-split--benefits">
                <div class="apitest-split__copy">
                    <p class="apitest-kicker">Our Unique Approach to Customer Benefits</p>
                    <h2 id="apitest-benefits-title">
                        When you choose IBN Tech's API Testing services, you benefit from:
                    </h2>
                    <ul class="apitest-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="apitest-btn apitest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="apitest-split__media apitest-split__media--photo">
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

        {{-- Process --}}
        <section class="apitest-section" aria-labelledby="apitest-process-title">
            <div class="site-shell apitest-split">
                <div class="apitest-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="apitest-split__copy">
                    <p class="apitest-kicker">API Testing Process at IBN Tech</p>
                    <h2 id="apitest-process-title">Our systematic approach to API Testing includes:</h2>
                    <ul class="apitest-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="apitest-btn apitest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="apitest-section apitest-closing" aria-labelledby="apitest-closing-title">
            <div class="site-shell apitest-closing__inner">
                <h2 id="apitest-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we understand the critical role APIs play in modern software systems. Trust us to ensure the seamless functionality and interoperability of your APIs with our comprehensive API Testing services. Let us help you deliver high-quality, reliable software experiences.
                </p>
                <a href="#contact-us" class="apitest-btn apitest-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="apitest-section apitest-consult" id="contact-us" aria-labelledby="apitest-consult-title">
            <div class="site-shell apitest-consult__inner">
                <aside class="apitest-consult__card" aria-labelledby="apitest-consult-title">
                    <div class="apitest-consult__header">
                        <h2 id="apitest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="apitest-consult__body">
                        <livewire:forms.contact-form
                            form-name="api-testing"
                            id-prefix="apitest"
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

                <div class="apitest-consult__media">
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
