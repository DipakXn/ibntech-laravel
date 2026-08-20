@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $certs = [
        ['icon' => 'fa-medal', 'title' => 'ISO 9001:2015', 'text' => 'Quality'],
        ['icon' => 'fa-lock', 'title' => 'ISO 27001:2022', 'text' => 'Security'],
        ['icon' => 'fa-circle-check', 'title' => 'SOC 2 Type II', 'text' => 'Compliance'],
    ];

    $services = [
        [
            'theme' => 'blue',
            'icon' => 'fa-shield-halved',
            'title' => 'Cybersecurity',
            'tagline' => '24/7 Monitoring - Threat Detection - Compliance Ready',
            'logistics' => [
                'intro' => 'WMS outages, GDPR‑level data exposure, and vulnerable supplier integrations make modern operations highly vulnerable to cyberattacks.',
                'items' => [
                    '24/7 SOC monitoring with immutable backups for recovery',
                    'End‑to‑end encryption with advanced data‑loss prevention controls',
                    'Automated GDPR reporting with complete audit documentation',
                    'Secure API authentication and authorization across all integrations',
                ],
            ],
            'transportation' => [
                'intro' => 'Unsecured dispatch systems, driver data breaches, and telematics hacks are exposing transportation companies to growing cyber threats.',
                'items' => [
                    'Zero Trust architecture with multi‑factor authentication enforcement',
                    'Immutable offline backups ensuring rapid ransomware recovery',
                    'PII masking with strict SSN and banking controls',
                    'End‑to‑end encryption securing all telematics communications',
                ],
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration',
            'tagline' => 'Zero Downtime - Data Security - Legacy Support',
            'logistics' => [
                'intro' => 'Legacy, siloed systems cause inventory issues, duplicate orders, and peak‑time failures - resulting in costly revenue impact.',
                'items' => [
                    'Unified cloud WMS with real-time inventory across all locations',
                    'Centralized command center with automated inventory balancing',
                    'Auto-scaling infrastructure with 99.99% uptime guarantee',
                ],
            ],
            'transportation' => [
                'intro' => 'Fleet operations are fragmented across disconnected systems, leading to compliance risks and inefficient routing.',
                'items' => [
                    'Unified telematics platform integrating maintenance, GPS, and fuel data',
                    'FMCSA‑compliant ELD with real‑time hours monitoring',
                    'Backhaul matching reducing empty miles and boosting utilization',
                ],
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Finance and Accounting',
            'tagline' => 'Cost Reduction - Accuracy - Real-time Insights',
            'logistics' => [
                'intro' => 'Manual billing, disjointed inventory processes, and inconsistent accounting across centers cause revenue leakage, shrinkage, and unclear profitability.',
                'items' => [
                    'Calculating all fees with 100% accuracy',
                    'Perpetual inventory management reducing shrinkage via tracking',
                    'Consolidated P&L reporting across all distribution centers',
                    'Profitability comparison using standardized costs and eliminations',
                ],
            ],
            'transportation' => [
                'intro' => 'Volatile fuel prices, frequent driver pay disputes, and lack of customer and lane-level profitability insight make margins unpredictable and growth decisions unreliable.',
                'items' => [
                    'Transparent solutions with real-time visibility',
                    'Automated, dispute-reducing driver pay calculations',
                    'Customer and lane profitability analysis',
                    'Scenario modeling to support data-driven expansion decisions',
                ],
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book-open',
            'title' => 'Bookkeeping',
            'tagline' => 'Centralized Records - Error-Free Reconciliation - Financial Accuracy',
            'logistics' => [
                'intro' => 'Disorganized fleet maintenance data and manual reconciliations cause missed warranty claims, forgotten renewals, and significant financial leakage.',
                'items' => [
                    'Centralized equipment database with automated warranty claim processing',
                    'Error‑free account reconciliation using automated tools',
                    'Automated bookkeeping workflows delivering timely and accurate reporting',
                    'Integrated AP/AR processing for streamlined cash‑flow visibility',
                ],
            ],
            'transportation' => [
                'intro' => 'Slow reimbursements, scattered maintenance records, and hidden fuel card fraud lead to unhappy drivers, missed warranty claims, and preventable financial losses.',
                'items' => [
                    'Mobile expense reporting integrated directly into weekly payroll',
                    'Automated maintenance scheduling with warranty and claim tracking',
                    'Fuel card fraud detection using MPG and anomaly analysis',
                ],
            ],
        ],
        [
            'theme' => 'teal',
            'icon' => 'fa-file-invoice-dollar',
            'title' => 'Payroll',
            'tagline' => 'Union Rule Enforcement - Contractor Classification - Dispute Reduction',
            'logistics' => [
                'intro' => 'Manual workforce tracking in warehouses causes high shift-differential pay errors and creates compliance risks during seasonal layoffs and recalls.',
                'items' => [
                    'Automated timekeeping with precise shift tracking',
                    'Built-in state-specific overtime and labor rule enforcement',
                    'Automated layoff and recall workflows',
                    'Wage continuity and unemployment insurance compliance tracking',
                ],
            ],
            'transportation' => [
                'intro' => 'A multi‑state workforce with contractors and union drivers often leads to withholding mistakes, misclassification issues, and wage disputes that escalate into penalties and grievances.',
                'items' => [
                    'Multi‑state payroll withholding automated by residency rules',
                    'Union rules engine applying negotiated wage scales automatically',
                    'Automated seniority‑based pay progression minimizing errors and grievances',
                ],
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-robot',
            'title' => 'RPA',
            'tagline' => 'Faster Invoicing - Compliance Automation - 24/7 Workflow Execution',
            'logistics' => [
                'intro' => 'High-volume shipment processing relies on manual data entry and delayed proof-of-delivery handling, causing excessive labor hours, high error rates, and slow invoicing.',
                'items' => [
                    'OCR‑based data extraction with automated address validation',
                    'Automated collections workflows reducing DSO to ~22 days',
                    'Real‑time AR visibility with customer risk prioritization',
                    'Optimized AP scheduling capturing early‑payment discounts',
                    'Automated invoice intake, approval, and payment timing',
                ],
            ],
            'transportation' => [
                'intro' => 'Manual review of driver logbooks and load booking processes consume excessive staff time while increasing FMCSA compliance risk and operational delays.',
                'items' => [
                    'Automated HOS logging with real‑time FMCSA compliance',
                    'Proactive violation alerts to prevent compliance breaches',
                    'Automated load creation via email and SMS parsing',
                    'Intelligent driver assignment reducing manual scheduling work',
                ],
            ],
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-building',
            'title' => 'BPO',
            'tagline' => 'Scalable - Expert Team - Cost Effective',
            'logistics' => [
                'intro' => 'Manual, fragmented back-office operations lead to processing delays, data inaccuracies, higher operating costs, and limited visibility, impacting efficiency and business performance.',
                'items' => [
                    'Standardized automated workflows improving turnaround time and accuracy',
                    'Real‑time operational visibility with performance and exception tracking',
                    'Centralized document processing reducing errors and rework effort',
                    'Streamlined finance, admin, and reporting for stronger control',
                ],
            ],
            'transportation' => [
                'intro' => 'Limited customer support capacity and fragmented back-office administration cause long wait times, low first-contact resolution, and significant compliance and audit risks.',
                'items' => [
                    'Data Processing – routing, scheduling, documentation',
                    'Compliance Support – customs & regulatory accuracy',
                    'Finance & Billing – freight rates, and billing',
                    'Record Management – fleet, contracts, inventory',
                ],
            ],
        ],
    ];

    $reasons = [
        [
            'icon' => 'fa-money-bill-wave',
            'title' => '40-60% Cost Reduction',
            'text' => 'Proven back-office cost savings through automation and process optimization',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Real-time Insights',
            'text' => '99.8% billing accuracy with consolidated reporting across all locations',
        ],
        [
            'icon' => 'fa-headset',
            'title' => '24/7 Expert Support',
            'text' => 'Dedicated Security Operations Center and customer service specialists',
        ],
        [
            'icon' => 'fa-server',
            'title' => '99.99% Uptime SLA',
            'text' => 'Enterprise-grade reliability with auto-scaling infrastructure and backups',
        ],
    ];

    $assessmentItems = [
        'Strengthen cybersecurity across dispatch, telematics, and ops systems',
        'Migrate legacy platforms to secure, scalable cloud',
        'Streamline bookkeeping, payroll, and compliance workflows',
        'Automate high‑volume billing, routing, and reconciliation',
        'Outsource back‑office tasks to cut costs and boost efficiency',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/logistics-and-transportation.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="lat-page">
        <span class="sr-only">{{ $industry->title }}</span>

        {{-- Hero --}}
        <section
            class="lat-hero"
            aria-labelledby="lat-hero-title"
            style="--lat-hero-pattern: url('{{ $img('Logistics-and-Transportation-bg-img.webp') }}')"
        >
            <div class="site-shell lat-hero__inner">
                <div class="lat-hero__copy">
                    <h1 id="lat-hero-title">Logistics &amp; Transportation: Run Lean, Stay Secure, Scale Fast</h1>
                    <p class="lat-hero__lede">
                        Integrated cloud migration, cybersecurity, finance automation, and BPO services. Proven to reduce operational costs by 40-60% while improving operational efficiency.
                    </p>
                    <a href="#lat-assessment" class="lat-btn lat-btn--green">
                        Schedule Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="lat-hero__media">
                    <img
                        src="{{ $img('Logistics-and-Transportation-hero-img.webp') }}"
                        alt="Logistics and Transportation hero"
                        width="743"
                        height="465"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="lat-section lat-section--soft" aria-labelledby="lat-certs-title">
            <div class="site-shell">
                <div class="lat-heading">
                    <h2 id="lat-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="lat-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="lat-cert" role="listitem">
                            <div class="lat-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="lat-cert__check">
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

        {{-- Integrated Services Suite --}}
        <section class="lat-section" aria-labelledby="lat-services-title">
            <div class="site-shell">
                <div class="lat-heading">
                    <h2 id="lat-services-title">Integrated Services Suite</h2>
                    <p>Customized solutions for both logistics and transportation industries</p>
                </div>
                <div class="lat-services">
                    @foreach ($services as $service)
                        <article class="lat-service lat-service--{{ $service['theme'] }}">
                            <header class="lat-service__head">
                                <span class="lat-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <div>
                                    <h3>{{ $service['title'] }}</h3>
                                    <p class="lat-service__tagline">{{ $service['tagline'] }}</p>
                                </div>
                            </header>

                            <div class="lat-service__cols">
                                <div class="lat-service__col">
                                    <h4>Logistics</h4>
                                    <p>{{ $service['logistics']['intro'] }}</p>
                                    <h5>Solutions:</h5>
                                    <ul class="lat-checks">
                                        @foreach ($service['logistics']['items'] as $item)
                                            <li>
                                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="lat-service__col">
                                    <h4>Transportation</h4>
                                    <p>{{ $service['transportation']['intro'] }}</p>
                                    <h5>Solutions:</h5>
                                    <ul class="lat-checks">
                                        @foreach ($service['transportation']['items'] as $item)
                                            <li>
                                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <a href="#lat-assessment" class="lat-btn lat-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="lat-cta" aria-labelledby="lat-cta-title">
            <div class="site-shell lat-cta__inner">
                <h2 id="lat-cta-title">Ready to Transform Your Operations?</h2>
                <p>Schedule a free consultation with our logistics experts. We'll assess your specific challenges and design a custom solution tailored to your business.</p>
                <a href="#lat-assessment" class="lat-btn lat-btn--white">Schedule a Free Consultation</a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="lat-section lat-section--cream" aria-labelledby="lat-why-title">
            <div class="site-shell">
                <div class="lat-heading">
                    <h2 id="lat-why-title">Why to Choose <span>IBN Technology</span></h2>
                    <p>Choose IBN Technologies for cost-efficient, reliable, and expert-driven business operations.</p>
                </div>
                <div class="lat-why" role="list">
                    @foreach ($reasons as $reason)
                        <article class="lat-why__item" role="listitem">
                            <span class="lat-why__icon" aria-hidden="true">
                                <i class="fa-solid {{ $reason['icon'] }}"></i>
                            </span>
                            <div>
                                <h3>{{ $reason['title'] }}</h3>
                                <p>{{ $reason['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="lat-section lat-section--soft" id="lat-assessment" aria-labelledby="lat-assess-title">
            <div class="site-shell lat-assess">
                <div class="lat-assess__copy">
                    <h2 id="lat-assess-title">Accelerate Your Logistics &amp; Transportation Modernization Journey</h2>
                    <ul class="lat-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="lat-assess__card" aria-labelledby="lat-form-title">
                    <h3 id="lat-form-title">Driving Smarter Transportation Operations</h3>
                    <p>Helping transportation companies streamline customer support, strengthen compliance, and scale operations with confidence</p>
                    <livewire:forms.contact-form
                        form-name="logistics-and-transportation"
                        id-prefix="lat"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your logistics and transportation requirements"
                        :message-rows="4"
                        submit-label="SUBMIT REQUEST"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
