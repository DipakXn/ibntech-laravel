@php
    $img = fn (string $file): string => asset('images/mobile-app-testing/'.$file);

    $overview = [
        [
            'icon' => 'mobile-app-user-experience-testing.webp',
            'alt' => 'mobile app user experience testing',
            'title' => 'Mobile App User Experience Testing',
            'text' => 'Ensure your mobile app delivers a seamless, intuitive, and enjoyable user experience.',
        ],
        [
            'icon' => 'mobile-test-automation.webp',
            'alt' => 'mobile test automation',
            'title' => 'Mobile Test Automation',
            'text' => 'Leverage our automated testing solutions to enhance testing speed and efficiency.',
        ],
        [
            'icon' => 'mobile-localization-testing.webp',
            'alt' => 'mobile localization testing',
            'title' => 'Mobile Localization Testing',
            'text' => 'Identify potential weaknesses in your APIs by testing them beyond their normal operational capacity.',
        ],
    ];

    $range = [
        [
            'icon' => 'functional-testing-1.webp',
            'alt' => 'functional testing',
            'title' => 'Functional Testing',
            'text' => 'Validate the functionality of your mobile app across different use cases.',
        ],
        [
            'icon' => 'usability-testing-1.webp',
            'alt' => 'usability testing',
            'title' => 'Usability Testing',
            'text' => 'Assess the user-friendliness and intuitiveness of your mobile app.',
        ],
        [
            'icon' => 'performance-testing-1.webp',
            'alt' => 'performance testing',
            'title' => 'Performance Testing',
            'text' => 'Evaluate your mobile app\'s performance under different network conditions and loads.',
        ],
        [
            'icon' => 'compatibility-testing.webp',
            'alt' => 'compatibility testing',
            'title' => 'Compatibility Testing',
            'text' => 'Confirm your mobile app\'s compatibility with different devices, operating systems, and browsers.',
        ],
        [
            'icon' => 'security-testing-1.webp',
            'alt' => 'security testing',
            'title' => 'Security Testing',
            'text' => 'Ensure your mobile app is secure from potential threats and vulnerabilities.',
        ],
        [
            'icon' => 'usability-testing-2.webp',
            'alt' => 'usability testing',
            'title' => 'Usability Testing',
            'text' => 'Test your mobile app\'s functionality and user experience in different locales.',
        ],
        [
            'icon' => 'integration-testing-1.webp',
            'alt' => 'integration testing',
            'title' => 'Integration Testing',
            'text' => 'Verify your mobile app\'s interoperability with other system components.',
        ],
        [
            'icon' => 'reggression-testing.webp',
            'alt' => 'regression testing',
            'title' => 'Regression Testing',
            'text' => 'Ensure your mobile app\'s functionality remains intact after modifications.',
        ],
        [
            'icon' => 'compatibility-testing-1.webp',
            'alt' => 'compatibility testing',
            'title' => 'Compliance Testing',
            'text' => 'Validate your mobile app\'s compliance with relevant regulations and standards.',
        ],
    ];

    $processSteps = [
        'Understanding your mobile app\'s specifications and testing requirements.',
        'Designing and implementing a tailored mobile app testing strategy.',
        'Conducting rigorous testing to validate functionality, performance, and security.',
        'Providing detailed test reports with actionable insights.',
        'Offering ongoing support and consultation to ensure the flawless performance of your mobile app.',
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
    @vite(['resources/css/pages/mobile-app-testing.css'])
@endpush

@section('content')
    <div class="matest-page">
        {{-- Hero --}}
        <section class="matest-hero" aria-labelledby="matest-hero-title">
            <div class="site-shell matest-hero__inner">
                <div class="matest-hero__copy">
                    <p class="matest-hero__eyebrow">
                        Deliver high-quality mobile experiences that keep users coming back with IBN Tech's expert Mobile App Testing.
                    </p>
                    <h1 id="matest-hero-title">Mobile App Testing</h1>
                    <p class="matest-hero__lede">
                        In a world where mobile apps are expected to generate over $935 billion in revenue by 2023 (Statista), ensuring the flawless performance of your mobile applications is paramount. Unlock superior user experiences with IBN Tech's comprehensive Mobile App Testing Services.
                    </p>
                    <div class="matest-hero__actions">
                        <a href="#contact-us" class="matest-btn matest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="matest-hero__media">
                    <img
                        src="{{ $img('mobile-testing-banner.webp') }}"
                        alt="mobile-testing-banner"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Service Overview --}}
        <section class="matest-section" aria-labelledby="matest-overview-title">
            <div class="site-shell">
                <div class="matest-heading">
                    <h2 id="matest-overview-title">Service Overview</h2>
                    <p>Our Mobile App Testing services emphasize on:</p>
                </div>

                <div class="matest-overview-grid" role="list">
                    @foreach ($overview as $item)
                        <article class="matest-overview-card" role="listitem">
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

                <div class="matest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="matest-btn matest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Range of Services --}}
        <section class="matest-section" aria-labelledby="matest-range-title">
            <div class="site-shell">
                <div class="matest-heading">
                    <h2 id="matest-range-title">Range of Services</h2>
                    <p>Our Mobile App Testing services emphasize on:</p>
                </div>

                <div class="matest-range-grid" role="list">
                    @foreach ($range as $item)
                        <article class="matest-range-card" role="listitem">
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

                <div class="matest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="matest-btn matest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Customer Benefits --}}
        <section class="matest-section matest-section--mint" aria-labelledby="matest-benefits-title">
            <div class="site-shell matest-split matest-split--benefits">
                <div class="matest-split__copy">
                    <h2 id="matest-benefits-title">Our Unique Approach to Customer Benefits</h2>
                    <p class="matest-lead">
                        <strong>By choosing IBN Tech's Mobile App Testing services, you gain:</strong>
                    </p>
                    <ul class="matest-list">
                        <li>Access to a team of experienced testers with expertise in mobile app testing methodologies.</li>
                        <li>Comprehensive testing solutions tailored to your specific needs.</li>
                        <li>
                            Enhanced mobile app quality,
                            <a href="{{ route('page.show', ['slug' => 'performance-testing']) }}">performance</a>,
                            and security.
                        </li>
                        <li>Accelerated time to market due to efficient testing processes.</li>
                    </ul>
                    <a href="#contact-us" class="matest-btn matest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="matest-split__media matest-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-1.webp') }}"
                        alt="our unique approach"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Testing Process --}}
        <section class="matest-section" aria-labelledby="matest-process-title">
            <div class="site-shell matest-split">
                <div class="matest-split__media">
                    <img
                        src="{{ $img('mobile-app-testing-process.webp') }}"
                        alt="mobile app testing process"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="matest-split__copy">
                    <h2 id="matest-process-title">Mobile App Testing Process at IBN Tech</h2>
                    <p class="matest-lead">
                        <strong>Our systematic approach to Mobile App Testing includes:</strong>
                    </p>
                    <ul class="matest-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="matest-btn matest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="matest-closing" aria-labelledby="matest-closing-title">
            <div class="site-shell matest-closing__inner">
                <h2 id="matest-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we pride ourselves on delivering high-quality, comprehensive Mobile App Testing services. Let us help you deliver a mobile app that not only meets but exceeds user expectations. Trust us to ensure the flawless performance of your mobile applications.
                </p>
                <a href="#contact-us" class="matest-btn matest-btn--green">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="matest-section matest-consult" id="contact-us" aria-labelledby="matest-consult-title">
            <div class="site-shell matest-consult__inner">
                <aside class="matest-consult__card" aria-labelledby="matest-consult-title">
                    <div class="matest-consult__header">
                        <h2 id="matest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="matest-consult__body">
                        <livewire:forms.contact-form
                            form-name="mobile-app-testing"
                            id-prefix="matest"
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

                <div class="matest-consult__media">
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
