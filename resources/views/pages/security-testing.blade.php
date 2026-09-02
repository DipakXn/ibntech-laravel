@php
    $img = fn (string $file): string => asset('images/security-testing/'.$file);

    $highlights = [
        [
            'title' => 'Penetration Testing:',
            'text' => 'Identify vulnerabilities in your systems before attackers do, minimizing the risk of exploitation.',
        ],
        [
            'title' => 'Vulnerability Scanning:',
            'text' => 'Regularly scan your system for known vulnerabilities, ensuring you\'re always one step ahead of potential threats.',
        ],
        [
            'title' => 'Security Code Review:',
            'text' => 'Detect security flaws at the source code level, making your software robust from the ground up.',
        ],
        [
            'title' => 'Compliance Testing:',
            'text' => 'Ensure your systems comply with industry-specific security regulations, avoiding potential legal repercussions.',
        ],
        [
            'title' => 'Risk Assessment:',
            'text' => 'Understand your current security posture and potential risks, helping you make informed decisions on resource allocation and remediation priorities.',
        ],
    ];

    $whatWeCover = [
        [
            'icon' => 'functional-testing.webp',
            'alt' => 'Cloud Security Audit',
            'title' => 'Cloud Security Audit',
            'text' => 'Assess the security of your cloud infrastructure and ensure compliance with best practices and regulations.',
        ],
        [
            'icon' => 'security-testing.webp',
            'alt' => 'Social Engineering Test',
            'title' => 'Social Engineering Test',
            'text' => 'Simulate real-world social engineering attacks to identify human vulnerabilities and improve your organization\'s security awareness',
        ],
        [
            'icon' => 'performance-testing.webp',
            'alt' => 'Security Consulting',
            'title' => 'Security Consulting',
            'text' => 'Leverage our expertise to build a robust security strategy, tailored to your unique business context and objectives.',
        ],
    ];

    $benefits = [
        'A dedicated team of cybersecurity experts with diverse experience and cutting-edge knowledge.',
        'Holistic security testing that goes beyond ticking boxes, ensuring not just compliance but actual security.',
        'Customized solutions, because we understand that each business is unique, and so are its security requirements.',
        'Ongoing support, because security is not a one-time activity but a continuous process.',
    ];

    $processSteps = [
        'Thorough understanding of your software architecture and business context.',
        'Tailored security testing strategy development.',
        'Execution of various security tests, including penetration testing, vulnerability scanning, security code review, and compliance testing.',
        'Analysis of testing results and detailed reporting.',
        'Recommendations for remediation and improvements.',
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
    @vite(['resources/css/pages/security-testing.css'])
@endpush

@section('content')
    <div class="sectest-page">
        {{-- Hero --}}
        <section class="sectest-hero" aria-labelledby="sectest-hero-title">
            <div class="site-shell sectest-hero__inner">
                <div class="sectest-hero__copy">
                    <p class="sectest-hero__eyebrow">
                        Don't Become a Statistic - Let IBN Tech Secure Your Digital Assets
                    </p>
                    <h1 id="sectest-hero-title">Security Testing Services</h1>
                    <p class="sectest-hero__lede">
                        Every 39 seconds, there's a cyberattack. Are you prepared?
                    </p>
                    <div class="sectest-hero__actions">
                        <a href="#contact-us" class="sectest-btn sectest-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="sectest-hero__media">
                    <img
                        src="{{ $img('api-testing.webp') }}"
                        alt="Security Testing Services"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro Section --}}
        <section class="sectest-section" aria-labelledby="sectest-intro-title">
            <div class="site-shell sectest-split">
                <div class="sectest-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="sectest-split__copy">
                    <h2 id="sectest-intro-title" class="sr-only">About IBN Tech Security Testing Services</h2>
                    <p>
                        In the face of increasing cyber threats, the security of software systems has become a non-negotiable necessity. No company is immune, with a stunning 68% of business leaders feeling their cybersecurity risks are increasing. IBN Tech is here to turn the tide with our comprehensive <a href="{{ route('page.show', ['slug' => 'vapt-services']) }}">Security Testing Services</a>, designed to safeguard your critical data and maintain the integrity of your software systems.
                    </p>
                    <a href="#contact-us" class="sectest-btn sectest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Highlights of Our Services --}}
        <section class="sectest-section" aria-labelledby="sectest-highlights-title">
            <div class="site-shell">
                <div class="sectest-heading">
                    <h2 id="sectest-highlights-title">Highlights of Our Services</h2>
                    <p>Our Security Testing Services are built to address a wide array of security needs, such as:</p>
                </div>

                <div class="sectest-highlights__body">
                    <ul class="sectest-highlights__list">
                        @foreach ($highlights as $item)
                            <li>
                                <strong>{{ $item['title'] }}</strong> {{ $item['text'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="sectest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="sectest-btn sectest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What We Cover --}}
        <section class="sectest-section" aria-labelledby="sectest-cover-title">
            <div class="site-shell">
                <div class="sectest-heading">
                    <h2 id="sectest-cover-title">What We Cover</h2>
                    <p>Our Security Testing Services encompass a wide range of activities:</p>
                </div>

                <div class="sectest-cover-grid" role="list">
                    @foreach ($whatWeCover as $item)
                        <article class="sectest-cover-card" role="listitem">
                            <figure class="sectest-cover-card__icon">
                                <img
                                    src="{{ $img($item['icon']) }}"
                                    alt="{{ $item['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="sectest-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="sectest-btn sectest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Our Unique Approach to Customer Benefits --}}
        <section class="sectest-section sectest-section--mint" aria-labelledby="sectest-benefits-title">
            <div class="site-shell sectest-split sectest-split--benefits">
                <div class="sectest-split__copy">
                    <h2 id="sectest-benefits-title">Our Unique Approach to Customer Benefits</h2>
                    <p class="sectest-subhead">Choosing IBN Tech for your Security Testing needs brings:</p>
                    <ul class="sectest-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="sectest-btn sectest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="sectest-split__media sectest-split__media--photo">
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

        {{-- Security Testing Process --}}
        <section class="sectest-section" aria-labelledby="sectest-process-title">
            <div class="site-shell sectest-split">
                <div class="sectest-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="sectest-split__copy">
                    <h2 id="sectest-process-title">Security Testing Process and Crucial Steps Handled by IBN Tech</h2>
                    <p class="sectest-subhead">Our process for Security Testing Services involves a well-defined, systematic approach:</p>
                    <ul class="sectest-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <p class="sectest-followup">
                        Regular follow-ups and updates to ensure ongoing security.
                    </p>
                    <a href="#contact-us" class="sectest-btn sectest-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Proactive Security Callout Banner --}}
        <section class="sectest-banner" aria-labelledby="sectest-banner-title">
            <div class="site-shell sectest-banner__inner">
                <h2 id="sectest-banner-title" class="sr-only">Proactive Security with IBN Tech</h2>
                <p>
                    At IBN Tech, we believe in proactive security. Trust us to secure your digital assets and let us help you focus on what you do best - growing your business. Because in a world where cyber threats are ever-evolving, security cannot be an afterthought, but a priority.
                </p>
                <div class="sectest-banner__cta">
                    <a href="#contact-us" class="sectest-btn sectest-btn--green">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Schedule A Call with Our Experts --}}
        <section class="sectest-section sectest-consult" id="contact-us" aria-labelledby="sectest-consult-title">
            <div class="site-shell sectest-consult__inner">
                <aside class="sectest-consult__card" aria-labelledby="sectest-consult-title">
                    <div class="sectest-consult__header">
                        <h2 id="sectest-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="sectest-consult__body">
                        <livewire:forms.contact-form
                            form-name="security-testing"
                            id-prefix="sectest"
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

                <div class="sectest-consult__media">
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
