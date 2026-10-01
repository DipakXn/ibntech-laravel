@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-cart-shopping', 'value' => '100 +', 'label' => 'E-commerce & Retail Companies'],
        ['icon' => 'fa-award', 'value' => '27+', 'label' => 'Years of Proven Expertise'],
        ['icon' => 'fa-server', 'value' => '99.9%', 'label' => 'System Uptime'],
        ['icon' => 'fa-percent', 'value' => '40%', 'label' => 'Average Cost Reduction'],
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
            'title' => 'Cybersecurity Solutions',
            'intro' => 'Protect customer data and payment systems with enterprise-grade security',
            'challenges' => [
                'Risk of data breaches exposing customer payment information',
                'PCI-DSS compliance burden and regulatory fines for non-compliance',
                'Lack of threat monitoring and incident response capabilities',
                'Vulnerability to ransomware and advanced cyber attacks',
            ],
            'solutions' => [
                'PCI-DSS compliant infrastructure with encrypted payment processing',
                '24/7 threat detection and real-time incident response',
                'Regular penetration testing and vulnerability assessments',
                'Employee security training and access control management',
            ],
            'outcome' => '100% compliance | Zero breaches | Complete customer data protection',
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration',
            'intro' => 'Move your infrastructure to the cloud with zero downtime and minimal disruption',
            'challenges' => [
                'Legacy systems causing slow website performance and customer frustration',
                'High infrastructure maintenance costs and limited scalability',
                'Inability to handle traffic spikes during peak sales seasons',
                'Manual server management consuming IT resources',
            ],
            'solutions' => [
                'Seamless migration to AWS, Azure, or Google Cloud with zero-downtime transition',
                'Automated scaling infrastructure that handles fluctuating e-commerce traffic',
                'Reduced operational costs through cloud-native architecture',
                '24/7 monitoring and proactive performance optimization',
            ],
            'outcome' => '99.9% uptime | 40% infrastructure cost reduction | Instant scalability',
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Accounting & Bookkeeping',
            'intro' => 'Manage complex multi-channel transactions and maintain accurate financial records',
            'challenges' => [
                'Manual reconciliation of transactions across multiple sales channels (Amazon, Shopify, direct, etc.)',
                'Errors in accounting leading to incorrect financial reports and tax issues',
                'No real-time visibility into accounts payable and receivable',
                'Difficulty tracking expenses across multiple payment methods and currencies',
                'Time-consuming month-end and year-end closing processes',
            ],
            'solutions' => [
                'Automated transaction reconciliation across all sales channels and payment gateways',
                'Real-time general ledger with full audit trails',
                'Multi-currency and multi-entity accounting support',
                'Automated bank reconciliation and expense categorization',
                'Monthly financial statements and reconciliation reports',
            ],
            'outcome' => 'Save Up to 70% operational cost | Improved decision-making',
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Payroll Management',
            'intro' => 'Outsource payroll processing with full tax compliance and statutory reporting',
            'challenges' => [
                'Complex multi-state payroll processing with varying tax regulations',
                'Risk of payroll errors leading to employee dissatisfaction and penalties',
                'Time-consuming manual calculation of taxes, deductions, and benefits',
                'Keeping up with changing federal and state labor laws',
                'Employee onboarding and termination paperwork complexity',
            ],
            'solutions' => [
                'Full-service payroll processing across all 50 states and territories',
                'Automatic tax calculation, withholding, and filing',
                'Compliance with FLSA, ACA, and all state labor regulations',
                'Direct deposit, check printing, and tax form generation (W-2, 1099)',
            ],
            'outcome' => 'Zero compliance risk | 100% accuracy',
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-gears',
            'title' => 'Intelligent Process Automation',
            'intro' => 'Automate routine operations using AI and RPA to improve efficiency and scalability',
            'challenges' => [
                'Manual, repetitive tasks slowing down operations',
                'High error rates in order processing, invoicing, and reporting',
                'Disconnected systems across e-commerce, finance, and CRM',
                'Rising operational costs as transaction volumes grow',
            ],
            'solutions' => [
                'RPA for order processing, invoicing, and data entry',
                'AI-driven workflows for exception handling',
                'Integration across e-commerce platforms, ERP, and accounting systems',
                'Automated reports and real-time dashboards',
            ],
            'outcome' => '60–80% automation | Reduced errors | Faster processing | Scalable operations',
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-building',
            'title' => 'Business Process Outsourcing (BPO)',
            'intro' => 'Offload time-consuming operations to expert teams at lower costs',
            'challenges' => [
                'Order processing and fulfillment eating into internal resources',
                'Customer support tickets overwhelming your small team',
                'Data entry and administrative tasks reducing focus on strategic work',
                'High employee turnover in back-office roles increasing training costs',
            ],
            'solutions' => [
                'End-to-end order processing and fulfillment management',
                '24/7 multilingual customer support and helpdesk services',
                'Data entry, document processing, and record management',
                'Quality assurance and continuous process improvement',
            ],
            'outcome' => '70% cost reduction | Improved SLA compliance | Team focus on growth',
        ],
    ];

    $together = [
        [
            'icon' => 'fa-database',
            'title' => 'Unified Data Architecture',
            'text' => 'All services operate on the same data platform, eliminating silos and ensuring consistency across your operations.',
        ],
        [
            'icon' => 'fa-link',
            'title' => 'Seamless Integration',
            'text' => 'Cloud infrastructure supports your financial systems, security protects your data, and BPO optimizes operations.',
        ],
        [
            'icon' => 'fa-user',
            'title' => 'Single Point of Contact',
            'text' => 'One partner for all your operational needs means faster issue resolution and better strategic alignment.',
        ],
    ];

    $chooseBenefits = [
        'Deep expertise in e-commerce and retail operations',
        'Integrated platform approach—no disconnected vendors',
        'Industry-standard compliance and certifications',
        'Dedicated support team familiar with your business',
        'Proactive monitoring and continuous optimization',
        'Scalable solutions that grow with your business',
    ];

    $assessmentItems = [
        'Secure customer and payment data',
        'Scale e-commerce platforms with cloud solutions',
        'Streamline accounting and financial operations',
        'Automate orders, reconciliation, and reporting',
        'Outsource back-office tasks to reduce costs',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/ecommerce-and-retail.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="ecr-page">
        <span class="sr-only">{{ $industry->title }}</span>

        {{-- Hero --}}
        <section
            class="ecr-hero"
            aria-labelledby="ecr-hero-title"
            style="--ecr-hero-pattern: url('{{ $img('E-Commerce-and-Retail-hero-bg.png') }}')"
        >
            <div class="site-shell ecr-hero__inner">
                <div class="ecr-hero__copy">
                    <h1 id="ecr-hero-title">Complete Business Operations for E-Commerce &amp; Retail</h1>
                    <p class="ecr-hero__lede">
                        Your growth is our mission. We provide secure cloud, data protection, and financial solutions to help retail and e-commerce businesses thrive.
                    </p>
                    <a href="#ecr-assessment" class="ecr-btn ecr-btn--green">
                        Schedule Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="ecr-hero__media">
                    <img
                        src="{{ $img('E-Commerce-And-Retail-Industry.webp') }}"
                        alt="E-Commerce and Retail Industry"
                        width="1024"
                        height="781"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="ecr-stats" aria-label="E-commerce and retail delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="ecr-stats__icon" aria-hidden="true">
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
        <section class="ecr-section ecr-section--soft" aria-labelledby="ecr-certs-title">
            <div class="site-shell">
                <div class="ecr-heading">
                    <h2 id="ecr-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="ecr-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="ecr-cert" role="listitem">
                            <div class="ecr-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="ecr-cert__check">
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

        {{-- Solutions --}}
        <section class="ecr-section" aria-labelledby="ecr-services-title">
            <div class="site-shell">
                <div class="ecr-heading">
                    <h2 id="ecr-services-title">Solutions Built for Your Specific Challenges</h2>
                    <p>Each service addresses solutions that e-commerce and retail businesses face. See how IBN Technology solves them.</p>
                </div>
                <div class="ecr-services">
                    @foreach ($services as $service)
                        <article class="ecr-service ecr-service--{{ $service['theme'] }}">
                            <header class="ecr-service__head">
                                <span class="ecr-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </header>
                            <p class="ecr-service__intro">{{ $service['intro'] }}</p>

                            <h4>Challenges:</h4>
                            <ul class="ecr-checks">
                                @foreach ($service['challenges'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <h4>Our Solutions:</h4>
                            <ul class="ecr-checks">
                                @foreach ($service['solutions'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <p class="ecr-service__benefit">
                                <strong>Expected Outcome</strong>
                                {{ $service['outcome'] }}
                            </p>

                            <a href="#ecr-assessment" class="ecr-btn ecr-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why services work together --}}
        <section class="ecr-section ecr-section--mist" aria-labelledby="ecr-together-title">
            <div class="site-shell">
                <div class="ecr-heading">
                    <h2 id="ecr-together-title">Why These Services Work Better Together</h2>
                </div>
                <div class="ecr-together" role="list">
                    @foreach ($together as $item)
                        <article class="ecr-together__item" role="listitem">
                            <span class="ecr-together__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="ecr-cta" aria-labelledby="ecr-cta-title">
            <div class="site-shell ecr-cta__inner">
                <h2 id="ecr-cta-title">Ready to Transform Your E-Commerce Operations?</h2>
                <p>Schedule a consultation with our team to see how IBN Technology can solve your specific challenges and accelerate growth.</p>
                <a href="#ecr-assessment" class="ecr-btn ecr-btn--white">Schedule Now</a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="ecr-section" aria-labelledby="ecr-choose-title">
            <div class="site-shell">
                <div class="ecr-heading">
                    <h2 id="ecr-choose-title">Why Choose <span>IBN Technology</span></h2>
                </div>
                <article class="ecr-choose">
                    <div class="ecr-choose__copy">
                        <h3>The Unified Solution Advantage</h3>
                        <p>Most businesses juggle multiple vendors—cloud providers, accounting firms, payroll companies, and IT consultants. This fragmentation creates data silos, higher costs, and coordination headaches.</p>
                        <p>IBN Technology brings it all together. One partner. One integrated platform. One team is accountable for your success. We eliminate complexity and deliver results.</p>
                    </div>
                    <ul class="ecr-choose__list">
                        @foreach ($chooseBenefits as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="ecr-section ecr-section--soft" id="ecr-assessment" aria-labelledby="ecr-assess-title">
            <div class="site-shell ecr-assess">
                <div class="ecr-assess__copy">
                    <h2 id="ecr-assess-title">Schedule a Complimentary E-commerce &amp; Retail Assessment</h2>
                    <ul class="ecr-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="ecr-assess__card" aria-labelledby="ecr-form-title">
                    <h3 id="ecr-form-title">Scale Smarter in E-commerce &amp; Retail</h3>
                    <p>We help brands scale faster with secure, automated, and cost-efficient operations.</p>
                    <livewire:forms.contact-form
                        form-name="ecommerce-and-retail"
                        id-prefix="ecr"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your e-commerce and retail requirements"
                        :message-rows="4"
                        submit-label="GET STARTED TODAY"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
