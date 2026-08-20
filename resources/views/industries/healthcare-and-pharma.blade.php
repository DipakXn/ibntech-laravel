@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $certs = [
        ['icon' => 'fa-medal', 'theme' => 'teal', 'title' => 'ISO 9001:2015', 'text' => 'Quality'],
        ['icon' => 'fa-lock', 'theme' => 'green', 'title' => 'ISO 27001:2022', 'text' => 'Security'],
        ['icon' => 'fa-circle-check', 'theme' => 'blue', 'title' => 'SOC 2 Type II', 'text' => 'Compliance'],
        ['icon' => 'fa-user-doctor', 'theme' => 'red', 'title' => 'HIPAA', 'text' => 'Healthcare'],
    ];

    $challenges = [
        [
            'theme' => 'purple',
            'icon' => 'fa-shield-halved',
            'title' => 'Cybersecurity & Compliance Challenges',
            'intro' => 'Data breach risks targeting PHI, HIPAA compliance complexity, ransomware threats, and legacy system vulnerabilities put patient trust at stake.',
            'items' => [
                '24/7 SOC & SIEM Monitoring with 80% faster response time',
                'HIPAA-Compliant VAPT Services for comprehensive assessments',
                'vCISO Services for strategic security leadership',
                'MDR Services with machine learning-driven detection',
                '60% reduction in vulnerabilities through continuous patching',
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration & Infrastructure Modernization',
            'intro' => 'Scaling challenges, downtime impact, multi-location coordination, EHR integration complexity, and budget constraints limit growth.',
            'items' => [
                '99.9% Migration Success Rate with near-zero downtime',
                'Multi-Cloud Strategy for AWS, Azure, and Jio platforms',
                'Business Continuity & Disaster Recovery with 99.9% uptime SLA',
                '30-50% Cost Optimization through FinOps',
                'Cloud-based EHR accessibility across all locations',
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Finance & Accounting Operational Burden',
            'intro' => 'Complex revenue cycle management, regulatory reporting, talent recruitment challenges, month-end close delays, and audit preparation stress.',
            'items' => [
                'Specialized Healthcare Accounting with medical coding expertise',
                '100% Accuracy Rate with AI-powered verification',
                'Monthly Close in 5 Days through streamlined processes',
                '50M+ Transactions Processed with proven expertise',
                'Medical billing and insurance claims reconciliation',
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Bookkeeping & Payroll Complexity',
            'intro' => 'Multi-entity accounting, complex provider payment structures, credentialing tracking, high staff turnover, and time-sensitive payroll demands.',
            'items' => [
                'Cloud-Based Bookkeeping with real-time access',
                'Automated Payroll Processing with 99.99% accuracy',
                'Multi-Location Consolidation for unified financial view',
                'QuickBooks Online Expertise for seamless integration',
                '1099 preparation for contract providers',
            ],
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-gears',
            'title' => 'Business Process Automation & Efficiency',
            'intro' => 'Manual data entry, invoice processing delays, duplicate work across systems, human error, and lack of real-time visibility prevent efficiency.',
            'items' => [
                'RPA Implementation for intelligent automation',
                '75% Reduced Invoice Cycle Time from receipt to payment',
                'AP/AR Automation with workflow approvals',
                '95% Increase in Workflow Efficiency',
                'Patient registration and insurance verification automation',
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-building',
            'title' => 'BPO Services for Healthcare Support Functions',
            'intro' => 'Administrative overhead, scalability issues during growth, quality inconsistency, and cost pressures impact patient care focus.',
            'items' => [
                'Middle & Back Office Support for administrative services',
                '99% Client Retention Rate through consistent quality',
                'Scalable Resources that flex with demand',
                'ISO-certified processes for quality assurance',
                'Medical transcription and provider credentialing support',
            ],
        ],
    ];

    $reasons = [
        [
            'theme' => 'green',
            'icon' => 'fa-stethoscope',
            'title' => 'Healthcare Industry Expertise',
            'intro' => 'Over 26 years serving healthcare providers, understanding unique regulatory, operational, and financial challenges.',
            'items' => [
                'Deep understanding of HIPAA, HITECH, and healthcare compliance',
                'Experience with EHR systems and practice management platforms',
                'Specialized knowledge of medical billing and revenue cycles',
                'Proven track record with hospitals, clinics, and healthcare providers',
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-circle-check',
            'title' => 'Compliance-First Approach',
            'intro' => 'All services designed with healthcare privacy and security requirements at the core.',
            'items' => [
                'HIPAA Compliant infrastructure and processes',
                'SOC 2 Type II Certified operations',
                'ISO 27001:2022 security management',
                'GDPR, PCI-DSS, and multi-framework compliance ready',
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-trophy',
            'title' => 'Proven Results',
            'intro' => 'Track record of delivering measurable improvements across security, operations, and financial performance.',
            'items' => [
                '80% Faster Threat Detection and response',
                '99% Migration Success Rate to cloud platforms',
                '100% Improvement in Forecast Accuracy',
                '30-50% Cost Reduction in IT operations',
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-rotate',
            'title' => '24/7 Support & Integration',
            'intro' => 'Round-the-clock monitoring and seamless integration with existing healthcare technology.',
            'items' => [
                '24/7/365 security monitoring and support',
                'Seamless EHR and practice management integration',
                'Real-time threat detection and response',
                'Dedicated healthcare technology specialists',
            ],
        ],
    ];

    $partners = [
        ['theme' => 'green', 'icon' => 'fa-shield-halved', 'title' => 'Security Foundation'],
        ['theme' => 'blue', 'icon' => 'fa-cloud', 'title' => 'Cloud Infrastructure'],
        ['theme' => 'green', 'icon' => 'fa-file-invoice-dollar', 'title' => 'Financial Operations'],
        ['theme' => 'blue', 'icon' => 'fa-gears', 'title' => 'Process Automation'],
        ['theme' => 'green', 'icon' => 'fa-headset', 'title' => 'BPO Support'],
    ];

    $assessmentItems = [
        'Identify security vulnerabilities and compliance gaps',
        'Discover cloud migration opportunities',
        'Analyze financial process inefficiencies',
        'Evaluate automation potential',
        'Review BPO service possibilities',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/healthcare-and-pharma.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="hcp-page">
        <span class="sr-only">{{ $industry->title }}</span>

        {{-- Hero --}}
        <section
            class="hcp-hero"
            aria-labelledby="hcp-hero-title"
            style="--hcp-hero-pattern: url('{{ $img('Healthcare-Pharma.webp') }}')"
        >
            <div class="site-shell hcp-hero__inner">
                <div class="hcp-hero__copy">
                    <h1 id="hcp-hero-title">Healthcare Solutions for Modern Organizations- Finance, Security and Compliance Under One Roof</h1>
                    <p class="hcp-hero__lede">
                        Serving hospitals, clinics, healthtech, and healthcare investors globally with ISO-certified processes and 24/7 support
                    </p>
                    <a href="#hcp-assessment" class="hcp-btn hcp-btn--green">
                        Schedule A Free Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="hcp-hero__media">
                    <img
                        src="{{ $img('healthcare-industry-hero.webp') }}"
                        alt="healthcare-industry-hero"
                        width="800"
                        height="561"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="hcp-section" aria-labelledby="hcp-certs-title">
            <div class="site-shell">
                <div class="hcp-heading">
                    <h2 id="hcp-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="hcp-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="hcp-cert hcp-cert--{{ $cert['theme'] }}" role="listitem">
                            <div class="hcp-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="hcp-cert__check">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <h3>{{ $cert['title'] }}</h3>
                            <p>{{ $cert['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Challenges --}}
        <section class="hcp-section hcp-section--soft" aria-labelledby="hcp-challenges-title">
            <div class="site-shell">
                <div class="hcp-heading">
                    <h2 id="hcp-challenges-title">Transforming Healthcare Challenges into Solutions</h2>
                    <p>Healthcare organizations face unprecedented challenges. IBN Technology delivers specialized solutions that address your unique operational, security, and financial pain points.</p>
                </div>
                <div class="hcp-challenges">
                    @foreach ($challenges as $challenge)
                        <article class="hcp-challenge hcp-challenge--{{ $challenge['theme'] }}">
                            <header class="hcp-challenge__head">
                                <span class="hcp-challenge__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $challenge['icon'] }}"></i>
                                </span>
                                <h3>{{ $challenge['title'] }}</h3>
                            </header>
                            <p class="hcp-challenge__intro">{{ $challenge['intro'] }}</p>
                            <h4>Our Solution:</h4>
                            <ul class="hcp-checks">
                                @foreach ($challenge['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="#hcp-assessment" class="hcp-btn hcp-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="hcp-section hcp-section--cream" aria-labelledby="hcp-why-title">
            <div class="site-shell">
                <div class="hcp-heading">
                    <h2 id="hcp-why-title">Why Healthcare Organizations Choose <span>IBN Technology</span></h2>
                    <p>A comprehensive technology partner who understands the complexity of healthcare operations, the sensitivity of patient data, and the importance of every interaction.</p>
                </div>
                <div class="hcp-reasons">
                    @foreach ($reasons as $reason)
                        <article class="hcp-reason hcp-reason--{{ $reason['theme'] }}">
                            <header class="hcp-reason__head">
                                <span class="hcp-reason__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $reason['icon'] }}"></i>
                                </span>
                                <h3>{{ $reason['title'] }}</h3>
                            </header>
                            <div class="hcp-reason__body">
                                <p>{{ $reason['intro'] }}</p>
                                <ul>
                                    @foreach ($reason['items'] as $item)
                                        <li>
                                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="hcp-cta" aria-labelledby="hcp-cta-title">
            <div class="site-shell hcp-cta__inner">
                <h2 id="hcp-cta-title">Ready to Transform Your Healthcare Operations?</h2>
                <p>Healthcare organizations deserve a technology partner who understands the complexity of your operations, the sensitivity of your data, and the importance of every patient interaction.</p>
                <a href="#hcp-assessment" class="hcp-btn hcp-btn--white">Schedule Consultation</a>
            </div>
        </section>

        {{-- Partner --}}
        <section class="hcp-section" aria-labelledby="hcp-partner-title">
            <div class="site-shell">
                <div class="hcp-heading">
                    <h2 id="hcp-partner-title">Your Integrated <span>Healthcare Technology</span> Partner</h2>
                    <p>Unlike traditional service providers who offer point solutions, IBN Technology delivers a comprehensive ecosystem of services that work together seamlessly:</p>
                </div>
                <div class="hcp-partners" role="list">
                    @foreach ($partners as $partner)
                        <article class="hcp-partner hcp-partner--{{ $partner['theme'] }}" role="listitem">
                            <span class="hcp-partner__icon" aria-hidden="true">
                                <i class="fa-solid {{ $partner['icon'] }}"></i>
                            </span>
                            <h3>{{ $partner['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="hcp-section hcp-section--soft" id="hcp-assessment" aria-labelledby="hcp-assess-title">
            <div class="site-shell hcp-assess">
                <div class="hcp-assess__copy">
                    <h2 id="hcp-assess-title">Schedule a Complimentary Healthcare Operations Assessment</h2>
                    <ul class="hcp-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-chevron-right" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="hcp-assess__card" aria-labelledby="hcp-form-title">
                    <h3 id="hcp-form-title">Secure, Compliant, and Scalable Healthcare Solutions</h3>
                    <p>From digital transformation to financial operations, we simplify complexity across healthcare and pharma.</p>
                    <livewire:forms.contact-form
                        form-name="healthcare-and-pharma"
                        id-prefix="hcp"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your healthcare and pharma requirements"
                        :message-rows="4"
                        submit-label="GET STARTED ON YOUR JOURNEY"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
