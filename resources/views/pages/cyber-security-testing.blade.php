@php
    $img = fn (string $file): string => asset('images/cyber-security-testing/'.$file);

    $offerings = [
        [
            'icon' => 'finance-accounting-icon-01.png',
            'alt' => 'Finance & Accounting Icon-01',
            'title' => 'Penetration Testing',
            'text' => 'Our team simulates real-world attack scenarios to identify potential vulnerabilities in your systems and networks.',
        ],
        [
            'icon' => 'reliability-testing.webp',
            'alt' => 'reliability testing',
            'title' => 'Vulnerability Assessment',
            'text' => 'We systematically evaluate your security posture to uncover weaknesses that could be exploited by malicious actors.',
        ],
        [
            'icon' => 'load-testing.webp',
            'alt' => 'load testing',
            'title' => 'Web Application Testing',
            'text' => 'We assess the security of your web applications to detect potential risks and vulnerabilities.',
        ],
        [
            'icon' => 'negative-testing.webp',
            'alt' => 'negative testing',
            'title' => 'Network Security Testing',
            'text' => 'We evaluate the security of your network infrastructure to prevent unauthorized access and data breaches.',
        ],
        [
            'icon' => 'it-services.webp',
            'alt' => 'it-services',
            'title' => 'Social Engineering Testing',
            'text' => 'We conduct tests to identify potential threats arising from human interactions and provide solutions to mitigate them.',
        ],
        [
            'icon' => 'dba-services.webp',
            'alt' => 'dba-services',
            'title' => 'Mobile Application Testing',
            'text' => 'We conduct exhaustive security tests on your mobile applications to detect and fix vulnerabilities.',
        ],
    ];

    $scopeItems = [
        [
            'title' => 'Penetration Testing',
            'href' => 'vapt-services',
            'text' => 'Simulate real-world attacks to identify and remediate potential security vulnerabilities.',
        ],
        [
            'title' => 'Vulnerability Assessment',
            'href' => null,
            'text' => 'Conduct systematic evaluations of your digital assets to identify potential weaknesses.',
        ],
        [
            'title' => 'Web Application Testing',
            'href' => null,
            'text' => 'Assess the security of your web applications to prevent security breaches.',
        ],
        [
            'title' => 'Network Security Testing',
            'href' => null,
            'text' => 'Evaluate the security measures of your network infrastructure to prevent unauthorized access.',
        ],
        [
            'title' => 'Social Engineering Testing',
            'href' => null,
            'text' => 'Identify potential threats arising from human interactions and recommend solutions to mitigate them.',
        ],
        [
            'title' => 'Mobile Application Testing',
            'href' => null,
            'text' => 'Conduct rigorous security tests on mobile applications to uncover and address vulnerabilities.',
        ],
    ];

    $benefits = [
        'Access to a team of certified cyber security professionals with extensive experience in the field.',
        'Comprehensive security assessments to identify and mitigate potential threats.',
        'Proactive security measures are designed to prevent breaches and protect your digital assets.',
        'Customized security solutions that align with your specific business requirements and objectives.',
    ];

    $processSteps = [
        'Understanding your business objectives and security needs',
        'Conducting comprehensive security assessments to identify vulnerabilities.',
        'Providing detailed reports with actionable recommendations.',
        'Assisting in the implementation of recommended security measures.',
        'Offering continuous support and consultation to ensure ongoing security.',
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
    @vite(['resources/css/pages/cyber-security-testing.css'])
@endpush

@section('content')
    <div class="cstest-page">
        {{-- Hero --}}
        <section class="cstest-hero" aria-labelledby="cstest-hero-title">
            <div class="site-shell cstest-hero__inner">
                <div class="cstest-hero__copy">
                    <p class="cstest-hero__eyebrow">
                        Did you know that nearly 70% of businesses experienced a cyber-attack in 2022? (Cybersecurity Ventures). Secure your digital assets from such threats with IBN Tech's comprehensive Cyber Security Testing Services.
                    </p>
                    <h1 id="cstest-hero-title">Cyber Security Testing</h1>
                    <p class="cstest-hero__lede">
                        In today's hyper-connected world, where cyber threats are escalating, fortify your digital defenses with our expert Cyber Security Testing.
                    </p>
                    <div class="cstest-hero__actions">
                        <a href="#contact-us" class="cstest-btn cstest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="cstest-hero__media">
                    <img
                        src="{{ $img('banner.webp') }}"
                        alt="cyber security"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="cstest-section" aria-labelledby="cstest-intro-title">
            <div class="site-shell cstest-split">
                <div class="cstest-split__media cstest-split__media--photo">
                    <img
                        src="{{ $img('2nd-image.webp') }}"
                        alt="IBN Tech cyber security testing services"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="cstest-split__copy">
                    <h2 id="cstest-intro-title" class="sr-only">About IBN Tech Cyber Security Testing</h2>
                    <p>
                        IBN Tech's Cyber Security Testing services are designed to help your business identify and mitigate potential vulnerabilities, ensuring the security and resilience of your digital infrastructure. Our expert team employs rigorous testing methodologies to verify the performance, security, and reliability of your systems, contributing to the protection of your software, networks, and applications.
                    </p>
                    <a href="#contact-us" class="cstest-btn cstest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Core Offerings --}}
        <section class="cstest-section" aria-labelledby="cstest-offerings-title">
            <div class="site-shell">
                <div class="cstest-heading">
                    <h2 id="cstest-offerings-title">Core Offerings</h2>
                    <p>Our Cyber Security Testing services encompass a range of critical security testing methods, including:</p>
                </div>

                <div class="cstest-offer-grid" role="list">
                    @foreach ($offerings as $item)
                        <article class="cstest-offer-card" role="listitem">
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

                <div class="cstest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="cstest-btn cstest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Service Scope --}}
        <section class="cstest-section cstest-section--soft" aria-labelledby="cstest-scope-title">
            <div class="site-shell cstest-split">
                <div class="cstest-split__copy">
                    <p class="cstest-kicker">Service Scope</p>
                    <h2 id="cstest-scope-title">
                        Our Cyber Security Testing services provide a comprehensive approach to secure your digital environment:
                    </h2>
                    <div class="cstest-scope">
                        @foreach ($scopeItems as $item)
                            <p>
                                <strong>
                                    @if ($item['href'])
                                        <a href="{{ route('page.show', ['slug' => $item['href']]) }}">{{ $item['title'] }}</a>:
                                    @else
                                        {{ $item['title'] }}:
                                    @endif
                                </strong>
                                {{ $item['text'] }}
                            </p>
                        @endforeach
                    </div>
                    <a href="#contact-us" class="cstest-btn cstest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="cstest-split__media cstest-split__media--photo">
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
        <section class="cstest-section" aria-labelledby="cstest-benefits-title">
            <div class="site-shell cstest-split">
                <div class="cstest-split__media cstest-split__media--photo">
                    <img
                        src="{{ $img('our-unique-approach-to-customer-benefits-3.webp') }}"
                        alt="our unique approach to customer benefits"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="cstest-split__copy">
                    <p class="cstest-kicker">Our Unique Approach to Customer Benefits</p>
                    <h2 id="cstest-benefits-title">
                        When you choose IBN Tech's Cyber Security Testing services, you gain:
                    </h2>
                    <ul class="cstest-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="cstest-btn cstest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Process --}}
        <section class="cstest-section cstest-section--soft" aria-labelledby="cstest-process-title">
            <div class="site-shell cstest-split">
                <div class="cstest-split__copy">
                    <p class="cstest-kicker">Cyber Security Testing Process at IBN Tech</p>
                    <h2 id="cstest-process-title">Our systematic approach to Cyber Security Testing includes:</h2>
                    <ul class="cstest-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="cstest-btn cstest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="cstest-split__media cstest-split__media--photo">
                    <img
                        src="{{ $img('cyber-security-testing-last-img.webp') }}"
                        alt="cyber security testing last img"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Closing CTA --}}
        <section class="cstest-closing" aria-labelledby="cstest-closing-title">
            <div class="site-shell cstest-closing__inner">
                <h2 id="cstest-closing-title" class="sr-only">Partner with IBN Tech</h2>
                <p>
                    At IBN Tech, we understand the escalating threats in today's digital world. Trust us to fortify your digital defenses with our comprehensive Cyber Security Testing services. We are committed to securing your digital assets and helping you maintain the trust of your stakeholders.
                </p>
                <a href="#contact-us" class="cstest-btn cstest-btn--green">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="cstest-section cstest-consult" id="contact-us" aria-labelledby="cstest-consult-title">
            <div class="site-shell cstest-consult__inner">
                <aside class="cstest-consult__card" aria-labelledby="cstest-consult-title">
                    <div class="cstest-consult__header">
                        <h2 id="cstest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="cstest-consult__body">
                        <livewire:forms.contact-form
                            form-name="cyber-security-testing"
                            id-prefix="cstest"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Message"
                            submit-label="SUBMIT"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="cstest-consult__media">
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
