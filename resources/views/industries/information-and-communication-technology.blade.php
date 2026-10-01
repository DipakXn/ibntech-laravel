@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-cloud', 'value' => '500 +', 'label' => 'E-commerce & Retail Companies'],
        ['icon' => 'fa-award', 'value' => '27 +', 'label' => 'Years of Proven Expertise'],
        ['icon' => 'fa-server', 'value' => '99.9 %', 'label' => 'System Uptime'],
        ['icon' => 'fa-globe', 'value' => '40 %', 'label' => 'Average Cost Reduction'],
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
            'title' => 'Cybersecurity & Compliance',
            'intro' => 'Comprehensive security solutions with threat detection, compliance management, and 24/7 monitoring',
            'do' => [
                'Threat detection and incident response',
                'Vulnerability assessments and penetration testing',
                'Compliance management (SOC 2, HIPAA, GDPR, ISO 27001)',
                'Security awareness training',
                'Backup and disaster recovery planning',
                'Regular security audits and monitoring',
            ],
            'why' => [
                'Protect client data and maintain customer trust',
                'Meet compliance requirements for regulated industries',
                'Detect threats before they become breaches',
                'Reduce security incident response time from hours to minutes',
            ],
            'benefit' => 'Focus on building products, not managing security crises',
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration & Infrastructure',
            'intro' => 'Secure assessment and planning of legacy system migrations with zero-downtime deployment strategies',
            'do' => [
                'Secure assessment and planning of legacy system migrations',
                'Zero-downtime cloud deployment strategies',
                'Multi-cloud management and optimization',
                'Data security protocols throughout the migration process',
                'Post-migration monitoring and optimization',
            ],
            'why' => [
                'Minimize operational disruption during migration',
                'Ensure data security and compliance throughout the process',
                'Reduce cloud infrastructure costs by optimizing resource allocation',
                'Seamless integration with your existing IT operations',
            ],
            'benefit' => 'Migrate confidently knowing your financial data, customer information, and operational systems are secure and compliant',
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Finance & Accounting',
            'intro' => 'Complete accounting and financial management customized for IT businesses, SaaS models, and project-based revenue',
            'do' => [
                'Multi-client billing and revenue reconciliation',
                'SaaS/subscription revenue accounting (ASC 606 compliance)',
                'Project-based cost allocation and profitability analysis',
                'Financial forecasting and scenario planning',
                'Bank reconciliation and cash management',
                'Real-time financial dashboards',
            ],
            'why' => [
                'Understand true profitability by client, project, or service line',
                'Accurate revenue recognition for SaaS models',
                'Identify cost optimization opportunities',
                'Make data-driven business decisions',
            ],
            'benefit' => 'Know your financial health in real-time, not 30 days after month-end close',
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Bookkeeping Services',
            'intro' => 'Accurate, audit-ready bookkeeping with automated processes and real-time financial visibility',
            'do' => [
                'Accounts Payable (vendor management, expense tracking, payment processing)',
                'Accounts Receivable (invoicing automation, payment collection, aging analysis)',
                'Bank and credit card reconciliation',
                'Expense categorization and analysis',
                'Electronic document management and audit trails',
                'Integration with accounting software (QuickBooks, Xero, NetSuite, etc.)',
            ],
            'why' => [
                'Reduce manual data entry by 80%',
                'Maintain clean, audit-ready financial records',
                'Improve cash flow with faster collections',
                'Leverage data for business intelligence',
            ],
            'benefit' => 'Accurate financial records that provide real business insights',
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-money-check-dollar',
            'title' => 'Payroll Processing',
            'intro' => 'Automated payroll management for distributed teams with full tax compliance across multiple states.',
            'do' => [
                'Bi-weekly and monthly payroll processing',
                'Multi-state tax compliance and withholding management',
                '1099 and W-2 processing and distribution',
                'Contractor payment management and tracking',
                'Employee onboarding and documentation',
                'Benefits administration support',
                'Payroll reporting and analytics',
            ],
            'why' => [
                'Eliminate payroll errors and tax penalties',
                'Simplify contractor and employee management',
                'Automate tax compliance across multiple states',
                'Reduce HR administrative burden',
            ],
            'benefit' => 'Payroll that never misses a beat, even as you scale',
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-building',
            'title' => 'Business Process Outsourcing',
            'intro' => 'Comprehensive back-office operations that free your team to focus on high-value strategic work.',
            'do' => [
                'Customer invoicing and billing operations',
                'Data entry and document processing',
                'Report generation and data analysis',
                'Administrative task management',
                'Process optimization consulting',
            ],
            'why' => [
                'Free up 200-400 hours monthly of your team\'s time',
                'Reduce operational cost by 50-70%',
                'Improve process consistency and accuracy',
                'Scale operations without hiring',
                'Focus your team on high-value work',
            ],
            'benefit' => 'Scale your operations without scaling your overhead',
        ],
    ];

    $excellence = [
        ['icon' => 'fa-table-columns', 'title' => 'Unified Processes', 'text' => 'Cloud, payroll, billing, and finance work in sync—not as separate services.'],
        ['icon' => 'fa-clock', 'title' => '24/7 Global Support', 'text' => 'US-based account managers with round-the-clock execution from India.'],
        ['icon' => 'fa-link', 'title' => 'Flexible & Scalable', 'text' => 'Add or scale back services as your business evolves.'],
        ['icon' => 'fa-lock', 'title' => 'Low Effort for You', 'text' => 'We handle operations end-to-end with minimal input from your team.'],
        ['icon' => 'fa-arrow-up', 'title' => 'Faster Implementation', 'text' => 'Go live in 2-3 weeks—far quicker than hiring and training internally.'],
    ];

    $discover = [
        'Hidden cost efficiencies in your operations',
        'Automation opportunities to free up your team',
        'Security vulnerabilities in your current system',
        'Exact cost saving potential for your business',
    ];

    $partners = [
        [
            'icon' => 'fa-laptop-code',
            'title' => 'Built for IT & Tech Firms',
            'text' => 'Deep understanding of project‑based work, subscription models, distributed teams, and contractor-driven operations.',
        ],
        [
            'icon' => 'fa-sitemap',
            'title' => 'Connected Technology Ecosystem',
            'text' => 'Expertise across QuickBooks, Xero, NetSuite, Salesforce, HubSpot, and modern cloud environments.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security You Can Trust',
            'text' => 'SOC 2 Type II certified with bank‑grade data protection and end‑to‑end compliance.',
        ],
    ];

    $assessmentItems = [
        'Protect systems and data with advanced cybersecurity solutions',
        'Migrate infrastructure and applications securely to the cloud',
        'Modernize IT environments for performance and scalability',
        'Streamline finance, accounting, and bookkeeping operations',
        'Automate reporting, compliance, and financial workflows',
        'Leverage BPO services to reduce operational costs and improve efficiency',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/information-and-communication-technology.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="ict-page">
        {{-- Hero --}}
        <section
            class="ict-hero"
            aria-labelledby="ict-hero-title"
            style="--ict-hero-pattern: url('{{ $img('information-and-communication-technology-hero-bg.webp') }}')"
        >
            <div class="site-shell ict-hero__inner">
                <div class="ict-hero__copy">
                    <h1 id="ict-hero-title">Upgrade, Protect &amp; Streamline: Complete ICT Solutions Built for Growing Businesses</h1>
                    <p class="ict-hero__lede">
                        Managing cloud infrastructure, cybersecurity, financial compliance, and operational efficiency simultaneously
                    </p>
                    <a href="#ict-assessment" class="ict-btn ict-btn--green">
                        Schedule a Free Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="ict-hero__media">
                    <img
                        src="{{ $img('information-and-communication-technology-hero-img.webp') }}"
                        alt="information-and-communication-technology-hero-img"
                        width="800"
                        height="683"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="ict-stats" aria-label="ICT delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="ict-stats__icon" aria-hidden="true">
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
        <section class="ict-section ict-section--soft" aria-labelledby="ict-certs-title">
            <div class="site-shell">
                <div class="ict-heading">
                    <h2 id="ict-certs-title">Certifications &amp; Compliance</h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="ict-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="ict-cert" role="listitem">
                            <div class="ict-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="ict-cert__check">
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

        {{-- Integrated services --}}
        <section class="ict-section" aria-labelledby="ict-services-title">
            <div class="site-shell">
                <div class="ict-heading">
                    <h2 id="ict-services-title">Our Integrated Services</h2>
                    <p>One partner, complete coverage. Every service strengthens the others for unified IT business success.</p>
                </div>
                <div class="ict-services">
                    @foreach ($services as $service)
                        <article class="ict-service ict-service--{{ $service['theme'] }}">
                            <header class="ict-service__head">
                                <span class="ict-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </header>
                            <p class="ict-service__intro">{{ $service['intro'] }}</p>

                            <h4>What We Do</h4>
                            <ul class="ict-checks">
                                @foreach ($service['do'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <h4>Why IT Businesses Choose Us</h4>
                            <ul class="ict-checks">
                                @foreach ($service['why'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <p class="ict-service__benefit">
                                <strong>Key Benefit</strong>
                                {{ $service['benefit'] }}
                            </p>

                            <a href="#ict-assessment" class="ict-btn ict-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="ict-cta" aria-labelledby="ict-cta-title">
            <div class="site-shell ict-cta__inner">
                <h2 id="ict-cta-title">Ready to Transform Your IT Operations?</h2>
                <p>Discover where you're losing time and money. Our experts will analyze your current processes and show you exactly how much you could save.</p>
                <a href="#ict-assessment" class="ict-btn ict-btn--white">Schedule a Free Consultation</a>
            </div>
        </section>

        {{-- Operational excellence --}}
        <section class="ict-section ict-section--mist" aria-labelledby="ict-ops-title">
            <div class="site-shell ict-ops">
                <article class="ict-ops__excellence" aria-labelledby="ict-ops-title">
                    <h2 id="ict-ops-title">Operational Excellence, Delivered</h2>
                    <ul>
                        @foreach ($excellence as $item)
                            <li>
                                <span class="ict-ops__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <span>
                                    <strong>{{ $item['title'] }}</strong>: {{ $item['text'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </article>

                <article class="ict-ops__discover" aria-labelledby="ict-discover-title">
                    <h2 id="ict-discover-title">What you will discover</h2>
                    <ol>
                        @foreach ($discover as $index => $item)
                            <li>
                                <span class="ict-ops__step" aria-hidden="true">{{ $index + 1 }}</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ol>
                </article>
            </div>
        </section>

        {{-- Partner --}}
        <section class="ict-section ict-section--cream" aria-labelledby="ict-partner-title">
            <div class="site-shell">
                <div class="ict-heading">
                    <h2 id="ict-partner-title">The ICT Partner That Powers Your Entire IT Business</h2>
                    <p>IBN Technology brings everything your IT company needs operations, finance, cloud, and compliance together in one seamlessly integrated solution.</p>
                </div>
                <div class="ict-partners" role="list">
                    @foreach ($partners as $partner)
                        <article class="ict-partner" role="listitem">
                            <div class="ict-partner__head">
                                <span class="ict-partner__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $partner['icon'] }}"></i>
                                </span>
                                <h3>{{ $partner['title'] }}</h3>
                            </div>
                            <p>{{ $partner['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="ict-section ict-section--soft" id="ict-assessment" aria-labelledby="ict-assess-title">
            <div class="site-shell ict-assess">
                <div class="ict-assess__copy">
                    <h2 id="ict-assess-title">Schedule a Complimentary ICT &amp; Digital Transformation Assessment</h2>
                    <ul class="ict-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-chevron-right" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="ict-assess__card" aria-labelledby="ict-form-title">
                    <h3 id="ict-form-title">Scale Smarter with ICT Solutions</h3>
                    <p>We help organizations strengthen security, move to the cloud, and optimize IT, finance, and back-office operations through scalable and cost-efficient solutions.</p>
                    <livewire:forms.contact-form
                        form-name="information-and-communication-technology"
                        id-prefix="ict"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your ICT requirements"
                        :message-rows="4"
                        submit-label="SCHEDULE YOUR ASSESSMENT"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
