@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-industry', 'value' => '500+', 'label' => 'Real Estate & Construction Companies'],
        ['icon' => 'fa-award', 'value' => '26+', 'label' => 'Years of Proven Expertise'],
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
            'title' => 'Cybersecurity Solutions for Chemical & Energy Industries',
            'intro' => 'Cyberattacks can halt operations, risk safety, and cost per hour. Strict regulations and rising ransomware threats make continuous OT security and rapid response essential.',
            'solutions' => [
                '24/7 Security Operations Center (SOC) with SIEM (Microsoft Sentinel/Splunk)',
                'Segment and strengthen OT/IT networks to isolate essential systems.',
                'Ransomware prevention and incident response playbooks',
                'Vulnerability assessments & penetration testing (VAPT) quarterly',
                'ISO 27001 & regulatory compliance management automation',
                'Threat intelligence specific to energy and chemical sectors',
                'Employee security awareness training & phishing simulations',
                'Endpoint detection & response (EDR) on all devices',
            ],
            'impact' => '87% faster threat detection • 12-min incident response • Zero breaches',
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Modernizing Chemical & Energy with Cloud Efficiency',
            'intro' => 'Chemical and energy plants run 24/7 and need real-time monitoring. Legacy systems can’t keep up, while cloud infrastructure delivers scalable, reliable analytics and remote access for faster decisions.',
            'solutions' => [
                'Migrate legacy ERP systems to cloud (SAP, Oracle, Infor) with zero downtime',
                'Real-time production monitoring dashboards with IoT sensor integration',
                'Automatic disaster recovery & business continuity (99.99% uptime)',
                'Reduced infrastructure costs by 35-50% through cloud optimization',
                'Global data access and collaboration from any location',
                'Seamless integration with existing systems',
                'Automatic scaling based on production demand',
                'Advanced analytics & predictive maintenance capabilities',
            ],
            'impact' => '22% productivity increase • 35-50% cost reduction • 99.99% uptime',
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-money-bill-wave',
            'title' => 'Finance Automation for Operational Excellence',
            'intro' => 'Automated accounting systems provide instant visibility into costs, margins, and cash positions, critical for managing commodity price swings and capital-intensive operations.',
            'solutions' => [
                'Cloud-based accounting platforms (NetSuite, Sage Intacct) replacing spreadsheets',
                'Automated invoice processing cuts manual entry by 80%',
                'Real-time dashboards: P&L, cash flow, and variance.',
                'Multi-currency & multi-entity consolidation with audit trail',
                'Commodity price tracking using variance analysis and forecasting models',
                'Automated GL posting for routine transactions (AP, AR, Payroll)',
                'SOX 404 compliance reporting automation',
                'Cash flow forecasting with predictive analytics',
            ],
            'impact' => '30–40% cost savings • 2x faster decision-making • High-accuracy financial operations',
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-calculator',
            'title' => 'Error-Free Bookkeeping for Audit-Ready Financials',
            'intro' => 'Accurate bookkeeping ensures reliable financial reporting for chemical and energy firms, preventing reconciliation errors and supporting compliance, multi-site operations, and audit readiness across complex cost centers.',
            'solutions' => [
                'Auto bank reconciliation (Xero & QuickBooks)',
                'AI/ML-powered expense categorization learning your coding patterns',
                'Automatic posting eliminates GL manual data entry.',
                'Vendor master data management with duplicate prevention',
                'Monthly bookkeeping review & certification by experienced accountants',
                'Tax provision calculations and accrual tracking',
                'Real-time expense reporting by cost center and project',
                'Audit-ready documentation with complete transaction trail',
            ],
            'impact' => 'Zero reconciliation errors • 100% audit readiness • 50% faster reporting',
        ],
        [
            'theme' => 'mid',
            'icon' => 'fa-book-open',
            'title' => 'Payroll Outsourcing for Error-Free Global Operations',
            'intro' => 'Outsourcing payroll helps chemical and energy firms avoid errors, ensure global compliance, and reduce disputes while allowing HR to focus on talent management in competitive markets.',
            'solutions' => [
                'Multi-country payroll processing (US, UK, India, EU) with tax compliance',
                'Automated time & attendance integration from biometric systems',
                'Tax & regulatory compliance management with quarterly updates',
                'Benefits administration (health, 401k, pension, FSA, HSA)',
                'Wage garnishment & deduction management',
                'Year-end reporting (W2, 1099, T4, RTI, P60)',
                'Direct deposit processing to employee accounts',
                'Payroll analytics & headcount reporting by department',
            ],
            'impact' => '35% cost reduction • Zero compliance violations • 100% on-time processing',
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-robot',
            'title' => 'RPA for Operational Accuracy, Speed & Cost Reduction',
            'intro' => 'RPA streamlines massive invoice volumes and complex workflows in chemical and energy firms, cutting delays and errors while freeing teams for high-value procurement and supplier strategy.',
            'solutions' => [
                'Automate complete order-to-cash processes',
                'Automated invoice processing & matching with 99.8% accuracy',
                'Supplier master data management with automated validation',
                'Production report generation & analysis automation',
                'Inventory reconciliation & cycle count automation',
                'Compliance report automation for regulatory submissions',
                'Travel & expense report processing automation',
                'Customer data synchronization across systems',
            ],
            'impact' => '10,000 invoices/month • 99.8% accuracy • 15,000 hours/year automated',
        ],
        [
            'theme' => 'teal',
            'icon' => 'fa-building',
            'title' => 'Adaptable Middle and Back-Office Help for Businesses',
            'intro' => 'Chemical and energy firms face volatile workloads. BPO enables instant scaling, reduces excess staffing costs, ensures consistent quality, and lets companies pay only for work performed.',
            'solutions' => [
                'Data entry & document processing with quality control',
                'Fund accounting & NAV/shadow NAV calculation',
                'Trade, position & cash reconciliations',
                'Daily P&L, trade settlement & corporate actions',
                'Investor onboarding, AML/KYC & reporting',
                'Document imaging, digitization & data processing',
                'Compliance, audit coordination & regulatory support',
                'SLA-driven delivery with ISO-certified processes',
            ],
            'impact' => 'Faster reconciliations & reporting • 40–50% cost savings • 99%+ delivery accuracy',
        ],
    ];

    $complianceItems = [
        ['icon' => 'fa-bell', 'title' => 'Automated compliance monitoring & alerts'],
        ['icon' => 'fa-file-lines', 'title' => 'Regulatory update tracking'],
        ['icon' => 'fa-file-invoice', 'title' => 'Audit-ready documentation'],
        ['icon' => 'fa-triangle-exclamation', 'title' => 'Risk assessment frameworks'],
        ['icon' => 'fa-id-card', 'title' => 'Staff training & certification'],
        ['icon' => 'fa-chart-line', 'title' => 'Annual compliance reporting'],
    ];

    $assessmentItems = [
        'Strengthen OT/IT cybersecurity',
        'Modernize with cloud & real-time monitoring',
        'Automate finance operations',
        'Ensure audit-ready bookkeeping',
        'Scale middle/back-office with BPO',
        'Deploy RPA for accuracy & speed',
        'Guarantee global payroll compliance',
        'Cut operational costs across facilities',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/chemical-and-energy.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="cae-page">
        <span class="sr-only">{{ $industry->title }}</span>

        {{-- Hero --}}
        <section
            class="cae-hero"
            aria-labelledby="cae-hero-title"
            style="--cae-hero-pattern: url('{{ $img('Chemical-and-Energy-hero-bg.webp') }}')"
        >
            <div class="site-shell cae-hero__inner">
                <div class="cae-hero__copy">
                    <h1 id="cae-hero-title">Integrated Cybersecurity, Cloud, and Finance Services for Chemical &amp; Energy Enterprises</h1>
                    <p class="cae-hero__lede">
                        We fix your operations, security, and finances all at once. Integrated solutions that eliminate vendor fragmentation.
                    </p>
                    <a href="#cae-assessment" class="cae-btn cae-btn--green">
                        Schedule Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="cae-hero__media">
                    <img
                        src="{{ $img('chemical-and-energy-hero-image.webp') }}"
                        alt="chemical-and-energy-hero-image"
                        width="1024"
                        height="788"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="cae-stats" aria-label="Chemical and energy delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="cae-stats__icon" aria-hidden="true">
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
        <section class="cae-section cae-section--soft" aria-labelledby="cae-certs-title">
            <div class="site-shell">
                <div class="cae-heading">
                    <h2 id="cae-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="cae-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="cae-cert" role="listitem">
                            <div class="cae-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="cae-cert__check">
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
        <section class="cae-section" aria-labelledby="cae-services-title">
            <div class="site-shell">
                <div class="cae-heading">
                    <h2 id="cae-services-title">IBN Technologies Solution</h2>
                    <p>Providing high-accuracy, performance-driven solutions to optimize production</p>
                </div>
                <div class="cae-services">
                    @foreach ($services as $service)
                        <article class="cae-service cae-service--{{ $service['theme'] }}">
                            <header class="cae-service__head">
                                <span class="cae-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </header>
                            <p class="cae-service__intro">{{ $service['intro'] }}</p>

                            <h4>Solutions:</h4>
                            <ul class="cae-checks">
                                @foreach ($service['solutions'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <p class="cae-service__benefit">
                                <strong>Expected Impact</strong>
                                {{ $service['impact'] }}
                            </p>

                            <a href="#cae-assessment" class="cae-btn cae-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="cae-cta" aria-labelledby="cae-cta-title">
            <div class="site-shell cae-cta__inner">
                <h2 id="cae-cta-title">Ready to Transform Your Operations?</h2>
                <p>Get a free 30-minute audit to identify your biggest efficiency gaps and potential savings.</p>
                <a href="#cae-assessment" class="cae-btn cae-btn--white">Schedule Now</a>
            </div>
        </section>

        {{-- Compliance Advantage --}}
        <section class="cae-section cae-section--cream" aria-labelledby="cae-comply-title">
            <div class="site-shell">
                <div class="cae-heading">
                    <h2 id="cae-comply-title">IBN <span>Compliance Advantage</span></h2>
                    <p>Stay ahead of regulatory requirements with our comprehensive compliance framework</p>
                </div>
                <div class="cae-comply" role="list">
                    @foreach ($complianceItems as $item)
                        <article class="cae-comply__item" role="listitem">
                            <span class="cae-comply__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="cae-section cae-section--soft" id="cae-assessment" aria-labelledby="cae-assess-title">
            <div class="site-shell cae-assess">
                <div class="cae-assess__copy">
                    <h2 id="cae-assess-title">Schedule a Complimentary Chemical &amp; Energy Operations Assessment</h2>
                    <ul class="cae-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-chevron-right" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="cae-assess__card" aria-labelledby="cae-form-title">
                    <h3 id="cae-form-title">Optimize Chemical &amp; Energy Operations</h3>
                    <p>Achieve safer, smarter, and more efficient performance with integrated cybersecurity, cloud modernization, automation, and managed back-office support.</p>
                    <livewire:forms.contact-form
                        form-name="chemical-and-energy"
                        id-prefix="cae"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your chemical and energy requirements"
                        :message-rows="4"
                        submit-label="BOOK A CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
