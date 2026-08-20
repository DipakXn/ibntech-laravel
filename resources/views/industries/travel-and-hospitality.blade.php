@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-users', 'value' => '100 +', 'label' => 'Travel & Hospitality Clients'],
        ['icon' => 'fa-award', 'value' => '26+', 'label' => 'Industry Expertise'],
        ['icon' => 'fa-bullseye', 'value' => '99.99%', 'label' => 'Accuracy Rate'],
        ['icon' => 'fa-headset', 'value' => '24/7', 'label' => 'Operations Coverage'],
    ];

    $certs = [
        ['icon' => 'fa-medal', 'title' => 'ISO 9001:2015', 'text' => 'Quality'],
        ['icon' => 'fa-lock', 'title' => 'ISO 27001:2022', 'text' => 'Security'],
        ['icon' => 'fa-circle-check', 'title' => 'SOC 2 Type II', 'text' => 'Compliance'],
    ];

    $services = [
        [
            'theme' => 'blue',
            'icon' => 'fa-shield-halved',
            'title' => 'Cybersecurity Services',
            'intro' => 'Travel and hospitality organizations are prime targets for cyberattacks due to high volumes of customer and payment data.',
            'solutions' => [
                'Cloud and application security implementation',
                'Advanced threat detection and vulnerability management',
                'Secure data encryption and access controls',
                'Compliance-driven security architecture',
                'Continuous monitoring and incident response support',
            ],
            'impact' => [
                'Reduced cyber risk',
                'Protection of brand reputation',
                'Regulatory compliance',
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration Services',
            'intro' => 'Travel and hospitality businesses often rely on fragmented and legacy IT systems that limit scalability and real‑time access.',
            'solutions' => [
                'Migration of legacy systems to secure cloud environments',
                'Centralized data access across hotels, offices, and regions',
                'Scalable cloud infrastructure to handle seasonal demand',
                'Improved system performance and uptime',
                'Reduced IT infrastructure and maintenance costs',
            ],
            'impact' => [
                'Faster operations',
                'Improved collaboration',
                'Enhanced scalability and agility',
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Finance & Accounting Services',
            'intro' => 'Complex revenue streams and multi-location operations make financial management challenging.',
            'solutions' => [
                'End-to-end finance and accounting outsourcing',
                'Accounts payable and receivable management',
                'General ledger maintenance and reconciliation',
                'Financial reporting and compliance support',
                'Process standardization and automation',
            ],
            'impact' => [
                'Improved financial visibility',
                'Controlled operational costs',
                'Better decision-making',
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Bookkeeping Services',
            'intro' => 'Daily transaction volumes in travel and hospitality create bookkeeping complexity.',
            'solutions' => [
                'Recording and categorization of daily transactions',
                'Multi-channel revenue tracking',
                'Commission, refunds, and chargeback management',
                'Monthly reconciliations and reporting',
                'Audit-ready financial documentation',
            ],
            'impact' => [
                'Accurate financial records',
                'Reduced errors',
                'Strong financial control',
            ],
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-robot',
            'title' => 'Robotic Process Automation (RPA)',
            'intro' => 'Manual, repetitive tasks like booking confirmations, invoice processing, and data entry slow down operations and increase errors.',
            'solutions' => [
                'Automate reservation and booking workflows',
                'Invoice and payment processing automation',
                'Customer data validation and updates',
                'Integration with existing CRM systems',
            ],
            'impact' => [
                '30% Faster Cash Flow',
                '25% Increase in On-Time Payments',
                '20% Lower Processing Costs',
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-building',
            'title' => 'BPO Outsourcing Services',
            'intro' => 'Back-office inefficiencies can significantly reduce the quality of services offered to customers, leading to dissatisfaction and potential loss of business.',
            'solutions' => [
                'Back-office process outsourcing',
                'Customer data and administration management',
                'Finance and accounting process outsourcing',
                'Reporting and documentation services',
                'Scalable staffing models',
            ],
            'impact' => [
                'Lower operational costs',
                'Improved efficiency',
                'Stronger focus on guest experience',
            ],
        ],
    ];

    $valueItems = [
        'Industry-aligned delivery model',
        'Cloud-first and security-driven approach',
        'Scalable solutions for seasonal business cycles',
        'Compliance-focused operations',
        'Cost optimization without quality compromise',
    ];

    $results = [
        ['value' => '40-70%', 'title' => 'Cost Savings', 'text' => 'Reduction in operational expenses'],
        ['value' => '100%', 'title' => 'Compliance', 'text' => 'Audit-ready financial records'],
        ['value' => '80%', 'title' => 'Time Savings', 'text' => 'Reduction in manual processing'],
        ['value' => '99.99%', 'title' => 'Accuracy', 'text' => 'In all financial transactions'],
    ];

    $assessmentItems = [
        'Enhance guest experiences and ensure compliance',
        'Adopt cloud solutions for seamless booking and collaboration',
        'Streamline financial operations and optimize costs',
        'Automate reservations and service workflows for speed and accuracy',
        'Deliver personalized travel packages and hospitality solutions',
        'Outsource back-office tasks to boost efficiency and focus on guests',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/travel-and-hospitality.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="tah-page">
        {{-- Hero --}}
        <section
            class="tah-hero"
            aria-labelledby="tah-hero-title"
            style="--tah-hero-pattern: url('{{ $img('Travel-and-Hospitality-bg-img.webp') }}')"
        >
            <div class="site-shell tah-hero__inner">
                <div class="tah-hero__copy">
                    <h1 id="tah-hero-title">Travel &amp; Hospitality Digital Transformation Services</h1>
                    <p class="tah-hero__lede">
                        Navigate operational complexity, ensure data security, and drive profitability with integrated cloud migration, cybersecurity, and outsourcing solutions built for travel and hospitality.
                    </p>
                    <a href="#tah-assessment" class="tah-btn tah-btn--green">
                        Schedule Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="tah-hero__media">
                    <img
                        src="{{ $img('Travel-and-Hospitality-Digital-Transformation-Img.webp') }}"
                        alt="Travel-and-Hospitality-Digital-Transformation-Img"
                        width="1024"
                        height="846"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="tah-stats" aria-label="Travel and hospitality delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="tah-stats__icon" aria-hidden="true">
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

        {{-- Certifications --}}
        <section class="tah-section tah-section--soft" aria-labelledby="tah-certs-title">
            <div class="site-shell">
                <div class="tah-heading">
                    <h2 id="tah-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="tah-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="tah-cert" role="listitem">
                            <div class="tah-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="tah-cert__check">
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

        {{-- Challenges we solve --}}
        <section class="tah-section" aria-labelledby="tah-services-title">
            <div class="site-shell">
                <div class="tah-heading">
                    <h2 id="tah-services-title">Travel &amp; Hospitality Challenges We Solve</h2>
                    <p>Solutions designed for your specific industry needs.</p>
                </div>
                <div class="tah-services">
                    @foreach ($services as $service)
                        <article class="tah-service tah-service--{{ $service['theme'] }}">
                            <header class="tah-service__head">
                                <span class="tah-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </header>
                            <p class="tah-service__intro">{{ $service['intro'] }}</p>

                            <h4>Our Solutions:</h4>
                            <ul class="tah-checks">
                                @foreach ($service['solutions'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tah-service__impact">
                                <strong>Business Impact:</strong>
                                <ul>
                                    @foreach ($service['impact'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <a href="#tah-assessment" class="tah-btn tah-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="tah-cta" aria-labelledby="tah-cta-title">
            <div class="site-shell tah-cta__inner">
                <h2 id="tah-cta-title">Ready to Transform Your Operations?</h2>
                <p>Save up to 70% on operational costs while improving compliance, security, and guest satisfaction.</p>
                <a href="#tah-assessment" class="tah-btn tah-btn--white">Schedule a Free Consultation</a>
            </div>
        </section>

        {{-- Value --}}
        <section class="tah-section" aria-labelledby="tah-value-title">
            <div class="site-shell">
                <div class="tah-heading">
                    <h2 id="tah-value-title">How <span>IBN Technology</span> Adds Value Across All Services</h2>
                </div>
                <ul class="tah-values">
                    @foreach ($valueItems as $item)
                        <li>
                            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Results & ROI --}}
        <section class="tah-section" aria-labelledby="tah-results-title">
            <div class="site-shell">
                <div class="tah-results-panel">
                    <div class="tah-heading tah-heading--results">
                        <h2 id="tah-results-title">Quantifiable <span>Results &amp; ROI</span></h2>
                    </div>
                    <div class="tah-results" role="list">
                        @foreach ($results as $result)
                            <article class="tah-result" role="listitem">
                                <strong>{{ $result['value'] }}</strong>
                                <h3>{{ $result['title'] }}</h3>
                                <p>{{ $result['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="tah-section tah-section--soft" id="tah-assessment" aria-labelledby="tah-assess-title">
            <div class="site-shell tah-assess">
                <div class="tah-assess__copy">
                    <h2 id="tah-assess-title">Schedule a Complimentary Travel &amp; Hospitality Assessment</h2>
                    <ul class="tah-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-chevron-right" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="tah-assess__card" aria-labelledby="tah-form-title">
                    <h3 id="tah-form-title">Your Strategic Partner for Travel &amp; Hospitality Excellence</h3>
                    <p>Empowering travel and hospitality businesses with tailored digital and operational solutions.</p>
                    <livewire:forms.contact-form
                        form-name="travel-and-hospitality"
                        id-prefix="tah"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your travel and hospitality requirements"
                        :message-rows="4"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
