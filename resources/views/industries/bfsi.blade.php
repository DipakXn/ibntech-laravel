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
            'intro' => 'Financial institutions face growing fraud risks, heavier compliance demands, limited security expertise, and slow threat detection.',
            'items' => [
                'Threat Detection & SIEM Monitoring',
                'Automated Compliance Tools for BFSI frameworks',
                'Rapid Response to Cybersecurity Events',
                'Periodic Security Audits & Pen Tests',
                'Data Loss Prevention (DLP) & Access Governance',
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration',
            'intro' => 'Legacy banking systems, downtime risks, strict data‑compliance needs, and fragmented applications make cloud modernization slow and challenging.',
            'items' => [
                'Secure, Zero‑Downtime Migration with staged transitions',
                'Cloud Architecture Planning tailored for BFSI workloads',
                'End-to-End Encryption and Compliance: SOC2, ISO 27001, and GDPR',
                'Legacy System Integration ensuring app continuity',
                '24/7 Cloud Operations Support',
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Finance & Accounting',
            'intro' => 'Finance teams struggle with high‑volume transactions, complex multi‑entity GL work, tight tax deadlines, and limited CFO‑level strategic oversight.',
            'items' => [
                'Automated GL & Reconciliation Services',
                'End-to-End Tax Preparation and Filing',
                'Virtual CFO Services for financial strategy',
                'Treasury & Cash Flow Management',
                'High‑Capacity Transaction Management',
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Bookkeeping Services',
            'intro' => 'Bookkeeping errors rise with multi‑entity demands, time‑consuming invoice processing, and limited system expertise.',
            'items' => [
                '100% Accurate Bookkeeping for Multi-Entity Setups',
                'Bank Reconciliation & Ledger Clean-Up',
                'Invoice Processing with Error-Free Reporting',
                'AP/AR Reporting with Real-Time Accuracy',
                'Certified QuickBooks Online Specialists',
            ],
        ],
        [
            'theme' => 'teal',
            'icon' => 'fa-file-invoice-dollar',
            'title' => 'Payroll Management',
            'intro' => 'Managing payroll becomes difficult with diverse tax laws, manual cycles, and the threat of costly mistakes.',
            'items' => [
                'Automated Payroll Processing',
                'Multi-State/Country Tax Compliance',
                'Payroll Reporting & Audits',
                'Secure Employee Data Management',
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-robot',
            'title' => 'Robotic Process Automation',
            'intro' => 'AP/AR operations are slowed by manual tasks, frequent entry mistakes, delayed compliance reporting, and limited process transparency.',
            'items' => [
                'AP/AR Automation (75% Cycle Reduction)',
                'Workflow Automation Across Departments',
                'API Integrations with Core Finance Systems',
                'AI-Driven Cognitive Automation (95% Efficiency Gains)',
            ],
        ],
        [
            'theme' => 'lavender',
            'icon' => 'fa-building-columns',
            'title' => 'Business Process Outsourcing',
            'wide' => true,
            'intro' => 'High back‑office costs, talent gaps, 24/7 workload demands, and complex fund administration processes.',
            'items' => [
                'Back-Office & Middle-Office Outsourcing',
                'Fund Administration & Family Office Support',
                'Round-the-clock operations',
                '99.99% Accuracy Through QA Frameworks',
                'Scalable Teams Across Time Zones',
            ],
        ],
    ];

    $reasons = [
        [
            'icon' => 'fa-user-shield',
            'title' => 'Domain Expertise',
            'text' => 'Deep BFSI knowledge with certified professionals',
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Security First',
            'text' => 'ISO 27001, SOC2, GDPR compliant operations',
        ],
        [
            'icon' => 'fa-trophy',
            'title' => 'Proven Track Record',
            'text' => '500+ successful implementations across geographies',
        ],
        [
            'icon' => 'fa-puzzle-piece',
            'title' => 'Integrated Solutions',
            'text' => 'Seamless integration of all BFSI services',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Cost Optimization',
            'text' => '30-40% reduction in operational expenses',
        ],
        [
            'icon' => 'fa-headset',
            'title' => 'Global Support',
            'text' => '24/7 multilingual support team',
        ],
    ];

    $processSteps = [
        [
            'num' => '1',
            'theme' => 'green',
            'icon' => 'fa-magnifying-glass-chart',
            'title' => 'Assessment',
            'text' => 'Evaluate current infrastructure, challenges, and goals',
        ],
        [
            'num' => '2',
            'theme' => 'navy',
            'icon' => 'fa-clipboard-check',
            'title' => 'Strategy',
            'text' => 'Design customized roadmap aligned with business objectives',
        ],
        [
            'num' => '3',
            'theme' => 'green',
            'icon' => 'fa-cloud-arrow-up',
            'title' => 'Implementation',
            'text' => 'Deploy solutions with minimal business disruption',
        ],
        [
            'num' => '4',
            'theme' => 'navy',
            'icon' => 'fa-chart-line',
            'title' => 'Optimization',
            'text' => 'Monitor, optimize, and continuously improve performance',
        ],
    ];

    $assessmentItems = [
        'Strengthen security and safeguard financial data',
        'Migrate to the cloud with zero downtime',
        'Streamline financial operations and reduce costs',
        'Automate workflows for faster, compliant processes',
        'Improve accuracy across bookkeeping, F&A, and payroll',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/bfsi.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="bfsi-page">
        {{-- Hero --}}
        <section
            class="bfsi-hero"
            aria-labelledby="bfsi-hero-title"
            style="--bfsi-hero-pattern: url('{{ $img('BFSI-bg-image.webp') }}')"
        >
            <div class="site-shell bfsi-hero__inner">
                <div class="bfsi-hero__copy">
                    <h1 id="bfsi-hero-title">Transform Your BFSI Excellence Through Cloud, Cybersecurity, Financial Expertise, and BPO Support</h1>
                    <p class="bfsi-hero__lede">
                        Secure cloud migration, robust cybersecurity, and intelligent automation tailored for banking and financial services.
                    </p>
                    <a href="#bfsi-assessment" class="bfsi-btn bfsi-btn--green">
                        Schedule Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="bfsi-hero__media">
                    <img
                        src="{{ $img('BFSI-hero-img.webp') }}"
                        alt="BFSI-hero-img"
                        width="1318"
                        height="914"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="bfsi-section bfsi-section--soft" aria-labelledby="bfsi-certs-title">
            <div class="site-shell">
                <div class="bfsi-heading">
                    <h2 id="bfsi-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="bfsi-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="bfsi-cert" role="listitem">
                            <div class="bfsi-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="bfsi-cert__check">
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

        {{-- Comprehensive solutions --}}
        <section class="bfsi-section" aria-labelledby="bfsi-services-title">
            <div class="site-shell">
                <div class="bfsi-heading bfsi-heading--wide">
                    <h2 id="bfsi-services-title">IBN Technologies Comprehensive BFSI Solutions</h2>
                    <p>Integrated services addressing every aspect of digital transformation</p>
                </div>
                <div class="bfsi-services">
                    @foreach ($services as $service)
                        <article class="bfsi-service bfsi-service--{{ $service['theme'] }}{{ ! empty($service['wide']) ? ' bfsi-service--wide' : '' }}">
                            <header class="bfsi-service__head">
                                <span class="bfsi-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </header>
                            <p class="bfsi-service__intro">{{ $service['intro'] }}</p>

                            <h4>Our Solutions:</h4>
                            <ul class="bfsi-checks{{ ! empty($service['wide']) ? ' bfsi-checks--split' : '' }}">
                                @foreach ($service['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="#bfsi-assessment" class="bfsi-btn bfsi-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="bfsi-cta" aria-labelledby="bfsi-cta-title">
            <div class="site-shell bfsi-cta__inner">
                <h2 id="bfsi-cta-title">Ready to Transform Your BFSI Operations?</h2>
                <p>Get a free assessment of your current infrastructure and discover how IBN Technology can drive digital transformation.</p>
                <a href="#bfsi-assessment" class="bfsi-btn bfsi-btn--white">Schedule Free Consultation</a>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="bfsi-section bfsi-section--cream" aria-labelledby="bfsi-why-title">
            <div class="site-shell">
                <div class="bfsi-heading">
                    <h2 id="bfsi-why-title">Why Choose <span>IBN Technology</span></h2>
                    <p>Optimize manufacturing, reduce costs, and improve efficiency with our expert solutions.</p>
                    <h3 class="bfsi-heading__sub">Proven Track Record</h3>
                </div>
                <div class="bfsi-reasons">
                    @foreach ($reasons as $reason)
                        <article class="bfsi-reason">
                            <span class="bfsi-reason__icon" aria-hidden="true">
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

        {{-- Implementation process --}}
        <section class="bfsi-section" aria-labelledby="bfsi-process-title">
            <div class="site-shell">
                <div class="bfsi-heading">
                    <h2 id="bfsi-process-title">Our Implementation Process</h2>
                    <p>Structured approach ensuring smooth digital transformation</p>
                </div>
                <ol class="bfsi-process">
                    @foreach ($processSteps as $step)
                        <li class="bfsi-process__step bfsi-process__step--{{ $step['theme'] }}">
                            <span class="bfsi-process__num" aria-hidden="true">{{ $step['num'] }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                            <span class="bfsi-process__icon" aria-hidden="true">
                                <i class="fa-solid {{ $step['icon'] }}"></i>
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="bfsi-section bfsi-section--soft" id="bfsi-assessment" aria-labelledby="bfsi-assess-title">
            <div class="site-shell bfsi-assess">
                <div class="bfsi-assess__copy">
                    <h2 id="bfsi-assess-title">Schedule a Complimentary BFSI Digital Transformation Assessment</h2>
                    <ul class="bfsi-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="bfsi-assess__card" aria-labelledby="bfsi-form-title">
                    <h3 id="bfsi-form-title">Take the First Step Toward Smarter BFSI Performance</h3>
                    <p>Reliable BFSI solutions that improve speed, security, and service excellence.</p>
                    <livewire:forms.contact-form
                        form-name="bfsi"
                        id-prefix="bfsi"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your BFSI requirements"
                        :message-rows="4"
                        submit-label="GET YOUR FREE CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
