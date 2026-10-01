@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-globe', 'value' => '2,500 +', 'label' => 'Global Clients'],
        ['icon' => 'fa-award', 'value' => '27+', 'label' => 'Years of Expertise'],
        ['icon' => 'fa-server', 'value' => '99.99%', 'label' => 'System Uptime & SLA Guarantee'],
        ['icon' => 'fa-heart', 'value' => '99%', 'label' => 'Client Retention Rate'],
    ];

    $certs = [
        ['icon' => 'fa-medal', 'title' => 'ISO 9001:2015'],
        ['icon' => 'fa-lock', 'title' => 'ISO 27001:2022'],
        ['icon' => 'fa-brands fa-microsoft', 'title' => 'Microsoft Partner'],
        ['icon' => 'fa-cloud', 'title' => 'AWS Partner'],
        ['icon' => 'fa-user-shield', 'title' => 'GDPR'],
        ['icon' => 'fa-heart-pulse', 'title' => 'HIPAA'],
        ['icon' => 'fa-credit-card', 'title' => 'PCI-DSS'],
        ['icon' => 'fa-shield-halved', 'title' => 'SOC 2'],
    ];

    $partners = [
        ['file' => 'MS-Gold-Partner.webp', 'alt' => 'MS-Gold-Partner'],
        ['file' => 'aws-partner-advanced-tier.webp', 'alt' => 'aws-partner-advanced-tier.webp'],
        ['file' => 'Jio-cloud-logo.webp', 'alt' => 'Jio-cloud-logo.webp'],
    ];

    $challenges = [
        [
            'theme' => 'blue',
            'icon' => 'fa-shield-halved',
            'title' => 'Security Vulnerabilities & Compliance',
            'intro' => 'Manufacturing plants are at risk from cyberattacks and IoT flaws, threatening data and compliance with NIST, CMMC, and ISO 27001.',
            'items' => [
                ['label' => '24/7 SOC & SIEM Services', 'text' => 'Real-time threat monitoring with 80% faster detection and 99.8% response rate.'],
                ['label' => 'VAPT Services', 'text' => 'Reduce vulnerabilities by 60% through OT/IT penetration testing.'],
                ['label' => 'vCISO Services', 'text' => 'Strategic cybersecurity leadership tailored to ITAR, CMMC, ISO compliance.'],
                ['label' => 'MDR Services', 'text' => 'Automated threat containment with behavioral analytics.'],
                ['label' => 'Microsoft Security', 'text' => 'Protect Azure and M365 environments with identity and compliance monitoring.'],
                ['label' => 'Risk Assessment Services', 'text' => 'Comprehensive cybersecurity maturity and risk assessments.'],
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Financial Complexity & Cost Pressures',
            'intro' => 'Managing multi-entity accounting, inventory valuation, tax compliance, and tight margins requires specialized expertise.',
            'items' => [
                ['label' => 'CFO Services', 'text' => 'Strategic financial leadership for budgeting, forecasting, and capital allocation'],
                ['label' => 'Tax Preparation Services', 'text' => 'Expert tax compliance and optimization for local and international operations'],
                ['label' => 'Financial Reporting', 'text' => 'Real-time dashboards and audit-ready reports'],
                ['label' => 'Treasury Management Services', 'text' => 'Improve working capital, cash flow, and liquidity management'],
                ['label' => 'Financial Reporting & Analysis', 'text' => 'Data-driven insights to improve demand forecasting accuracy'],
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Legacy Bottlenecks to Cloud Migration',
            'intro' => 'Outdated IT infrastructure, disconnected systems, and manual processes slow production, increase errors, and limit scalability.',
            'items' => [
                ['label' => 'Cloud Migration Services', 'text' => '99% migration success rate with near zero downtime; move legacy systems to AWS, Azure, or Jio.'],
                ['label' => 'Business Continuity & Disaster Recovery', 'text' => '100% backup success rate to prevent production disruptions.'],
                ['label' => 'Cloud FinOps', 'text' => 'Multi-cloud cost optimization, yielding 30–50% cost savings.'],
                ['label' => 'DevSecOps Implementation', 'text' => 'Maintain security compliance while accelerating production cycles with 85% faster CI/CD deployments'],
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Payroll Accuracy & Administrative Burden',
            'intro' => 'Bookkeeping and Payroll complexity, and compliance challenges increase operational burden.',
            'items' => [
                ['label' => 'Bookkeeping Services', 'text' => '100% accuracy in financial records with 50M+ transactions processed'],
                ['label' => 'Payroll Services', 'text' => 'Accurate and timely payroll processing for multi-location industrial enterprises'],
                ['label' => 'Dedicated Resources', 'text' => 'Experienced teams that expand with your organizations, with a 99% customer retention rate'],
            ],
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-gears',
            'title' => 'Automation & Operational Efficiency',
            'intro' => 'Manual processes, duplicate work, and lack of real-time visibility slow production and increase costs.',
            'items' => [
                ['label' => 'RPA & Automation', 'text' => 'Save 75% processing time by automating inventory monitoring, purchase orders, invoicing, and reporting.'],
                ['label' => 'AP/AR Automation', 'text' => 'Reduce invoice cycle time by 75% with automated workflows'],
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-building',
            'title' => 'Back-Office Operational Distraction',
            'intro' => 'Administrative tasks and back-office operations consume time that should focus on core manufacturing activities.',
            'items' => [
                ['label' => 'Fully Managed Outsourcing', 'text' => 'Access expertise in Back and Middle Office Support for Fund Administration and Accounting Services, and Data Management.'],
                ['label' => '24/7 Operations', 'text' => 'Round-the-clock support across time zones ensures uninterrupted business continuity'],
            ],
        ],
    ];

    $trackRecord = [
        '2,500+ Global Clients including Fortune 500 companies',
        '27+ Years of Expertise (Since 1999)',
        '99.99% System Uptime & SLA Guarantee',
        '80% Reduction in Security Breach Impact',
        '99% Compliance Success Rate',
    ];

    $compliance = [
        ['icon' => 'fa-user-shield', 'title' => 'GDPR'],
        ['icon' => 'fa-credit-card', 'title' => 'PCI-DSS'],
        ['icon' => 'fa-lock', 'title' => 'SOC 2'],
        ['icon' => 'fa-atom', 'title' => 'NIST'],
        ['icon' => 'fa-sitemap', 'title' => 'CERT-In'],
    ];

    $expertise = [
        ['color' => '#ff9900', 'title' => 'Cloud Migration for Legacy ERP/MES Systems'],
        ['color' => '#ff3333', 'title' => 'Cybersecurity for OT/IT Networks and IoT Devices'],
        ['color' => '#009999', 'title' => 'Finance & Accounting for Multi-Entity Manufacturing Operations'],
        ['color' => '#1cbf36', 'title' => 'Payroll & Compliance for Multi-Location Industrial Workforce'],
        ['color' => '#b117df', 'title' => 'Intelligent Process Automation for Inventory, AP/AR, and Reporting'],
        ['color' => '#f10ab8', 'title' => 'BPO for Back-Office Support and Administrative Efficiency'],
        ['color' => '#27dd9b', 'title' => 'Business Continuity & Disaster Recovery for Production Environments'],
        ['color' => '#2a5712', 'title' => '24/7 Managed Operations for Global Manufacturing Enterprises'],
    ];

    $assessmentItems = [
        'Cybersecurity risk evaluation',
        'Cloud readiness analysis',
        'Financial process audit',
        'Custom solution roadmap',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/manufacturing.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="mfg-page">
        {{-- Hero --}}
        <section
            class="mfg-hero"
            aria-labelledby="mfg-hero-title"
            style="--mfg-hero-pattern: url('{{ $img('Manufacturing-hero-bg.webp') }}')"
        >
            <div class="site-shell mfg-hero__inner">
                <div class="mfg-hero__copy">
                    <h1 id="mfg-hero-title">Optimize Operations and Secure Your Manufacturing Future</h1>
                    <p class="mfg-hero__lede">
                        Transform your operational challenges into your greatest strengths. We offer expert help in Cloud Migration, Cybersecurity, Finance &amp; Accounting, and BPO services.
                    </p>
                    <a href="#mfg-assessment" class="mfg-btn mfg-btn--green">
                        Schedule Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="mfg-hero__media">
                    <img
                        src="{{ $img('Optimize-Operations-and-Secure-Your-Manufacturing-Future.webp') }}"
                        alt="Optimize-Operations-and-Secure-Your-Manufacturing-Future"
                        width="800"
                        height="624"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="mfg-stats" aria-label="Manufacturing delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="mfg-stats__icon" aria-hidden="true">
                                <i class="fa-solid {{ $stat['icon'] }}"></i>
                            </span>
                            <span>
                                <strong>{{ $stat['value'] }}</strong>
                                {{ $stat['label'] }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Certifications & Partnerships --}}
        <section class="mfg-section mfg-section--soft" aria-labelledby="mfg-certs-title">
            <div class="site-shell">
                <div class="mfg-heading">
                    <h2 id="mfg-certs-title">Industry Certifications &amp; Partnerships</h2>
                    <p>Trusted by Fortune 500 companies with proven expertise and compliance.</p>
                </div>
                <div class="mfg-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="mfg-cert" role="listitem">
                            <span class="mfg-cert__icon" aria-hidden="true">
                                <i class="{{ str_starts_with($cert['icon'], 'fa-brands') ? $cert['icon'] : 'fa-solid '.$cert['icon'] }}"></i>
                            </span>
                            <h3>{{ $cert['title'] }}</h3>
                        </article>
                    @endforeach
                </div>

                <div class="mfg-tech">
                    <h3>Technology Partners</h3>
                    <div class="mfg-tech__logos" role="list">
                        @foreach ($partners as $partner)
                            <article class="mfg-tech__logo" role="listitem">
                                <img
                                    src="{{ $img($partner['file']) }}"
                                    alt="{{ $partner['alt'] }}"
                                    width="345"
                                    height="220"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Challenges --}}
        <section class="mfg-section" aria-labelledby="mfg-challenges-title">
            <div class="site-shell">
                <div class="mfg-heading">
                    <h2 id="mfg-challenges-title">Turning Manufacturing Challenges into Competitive Advantages</h2>
                    <p>We help manufacturers streamline operations, secure systems, and scale smarter turn everyday challenges into lasting competitive advantages.</p>
                </div>
                <div class="mfg-challenges">
                    @foreach ($challenges as $challenge)
                        <article class="mfg-challenge mfg-challenge--{{ $challenge['theme'] }}">
                            <span class="mfg-challenge__icon" aria-hidden="true">
                                <i class="fa-solid {{ $challenge['icon'] }}"></i>
                            </span>
                            <h3>{{ $challenge['title'] }}</h3>
                            <p>{{ $challenge['intro'] }}</p>
                            <h4>Our Solutions:</h4>
                            <ul>
                                @foreach ($challenge['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span><strong>{{ $item['label'] }}</strong>: {{ $item['text'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="#mfg-assessment" class="mfg-btn mfg-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="mfg-cta" aria-labelledby="mfg-cta-title">
            <div class="site-shell mfg-cta__inner">
                <h2 id="mfg-cta-title">Start Your Digital Manufacturing Transformation</h2>
                <p>Modernize systems, reduce costs, and improve operational efficiency—faster.</p>
                <a href="#mfg-assessment" class="mfg-btn mfg-btn--white">Book a Call</a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="mfg-section mfg-section--mist" aria-labelledby="mfg-why-title">
            <div class="site-shell">
                <div class="mfg-heading">
                    <h2 id="mfg-why-title">Why Manufacturing Leaders Choose IBN Technology</h2>
                    <p>Optimize manufacturing, reduce costs, and improve efficiency with our expert solutions.</p>
                </div>

                <h3 class="mfg-subhead">Proven Track Record</h3>
                <ul class="mfg-track">
                    @foreach ($trackRecord as $item)
                        <li>
                            <span class="mfg-track__icon" aria-hidden="true">
                                <i class="fa-solid fa-star"></i>
                            </span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mfg-compliance">
                    <h3>Compliance Standards</h3>
                    <div class="mfg-compliance__grid" role="list">
                        @foreach ($compliance as $item)
                            <article role="listitem">
                                <span class="mfg-compliance__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <h4>{{ $item['title'] }}</h4>
                            </article>
                        @endforeach
                    </div>
                </div>

                <h3 class="mfg-subhead">Manufacturing-Specific Expertise</h3>
                <div class="mfg-expertise" role="list">
                    @foreach ($expertise as $index => $item)
                        <article class="mfg-expertise__item" role="listitem">
                            <span class="mfg-expertise__num" style="--mfg-chip: {{ $item['color'] }}" aria-hidden="true">
                                {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <h4>{{ $item['title'] }}</h4>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="mfg-section mfg-section--soft" id="mfg-assessment" aria-labelledby="mfg-assess-title">
            <div class="site-shell mfg-assess">
                <div class="mfg-assess__copy">
                    <h2 id="mfg-assess-title">Ready to Optimize Your Manufacturing Operations?</h2>
                    <p>Stop letting operational inefficiencies, cybersecurity risks, and administrative burdens limit your manufacturing potential. Get a Comprehensive Assessment:</p>
                    <ul class="mfg-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <h3>Let’s Solve Your Biggest Operational Challenges Now.</h3>
                    <p>Every hour of inefficiency costs you production. Automate, secure, and streamline with our proven solutions before the next cycle begins.</p>
                </div>

                <aside class="mfg-assess__card" aria-labelledby="mfg-form-title">
                    <h3 id="mfg-form-title">Schedule Your Discounted Assessment</h3>
                    <livewire:forms.contact-form
                        form-name="manufacturing"
                        id-prefix="mfg"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your manufacturing requirements"
                        :message-rows="4"
                        submit-label="BOOK YOUR ASSESSMENT NOW"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
