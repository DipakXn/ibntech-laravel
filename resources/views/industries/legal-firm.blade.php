@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-scale-balanced', 'value' => '100+', 'label' => 'Travel & Hospitality Clients'],
        ['icon' => 'fa-award', 'value' => '26+', 'label' => 'Years of Experience'],
        ['icon' => 'fa-shield-halved', 'value' => '99.99%', 'label' => 'Accuracy Rate '],
        ['icon' => 'fa-percent', 'value' => '40%', 'label' => 'Faster Case Turnaround'],
    ];

    $certs = [
        ['icon' => 'fa-medal', 'title' => 'ISO 9001:2015', 'text' => 'Quality'],
        ['icon' => 'fa-lock', 'title' => 'ISO 27001:2022', 'text' => 'Security'],
        ['icon' => 'fa-circle-check', 'title' => 'SOC 2 Type II', 'text' => 'Compliance'],
    ];

    $services = [
        [
            'theme' => 'purple',
            'icon' => 'fa-shield-halved',
            'title' => 'Cybersecurity',
            'challenge' => 'Protect Client Confidentiality:',
            'challenges' => [
                'Sensitive client data exposed due to legacy systems and weak security',
                'Ransomware, phishing, and breach threats costing time and reputation',
                'Non-compliance with GDPR, state data laws, and Bar Council rules',
                'Lack of 24/7 threat monitoring and incident response capability',
            ],
            'solutions' => [
                '24x7 Managed SOC detecting and eliminating 98%+ of cyber threats',
                'Enterprise-grade encryption, endpoint protection, and DLP systems',
                'Meet GDPR, IT Act, and state-specific compliance requirements',
                'Secure client communication and full audit readiness at all times',
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration',
            'challenge' => 'Modernize Your Infrastructure:',
            'challenges' => [
                'On-premise systems can\'t support remote work and scaling',
                'High infrastructure maintenance costs and IT staffing burden',
                'Legacy technology creates data silos and integration issues',
                'Risk of data loss without modern backup and disaster recovery',
            ],
            'solutions' => [
                'Seamless zero-downtime migration to secure cloud infrastructure',
                'Reduce infrastructure costs by 40-60% annually',
                'Enable work-from-anywhere with automatic backup and recovery',
                'Seamless integration with case management and accounting systems',
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-calculator',
            'title' => 'Finance & Accounting',
            'challenge' => 'Specialized Legal Accounting:',
            'challenges' => [
                'Complex trust account compliance requirements not properly managed',
                'Poor cash flow visibility and profitability insights by practice area',
                'Expensive in-house accounting teams with high overhead',
                'Delayed financial reporting preventing timely decision-making',
            ],
            'solutions' => [
                'Compliant trust account management with meticulous reconciliation',
                'Get monthly financial statements within 5 business days',
                'Reduce accounting overhead costs by 50%+',
                'Identify profitability gaps and improve cash flow visibility',
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-book',
            'title' => 'Legal Bookkeeping',
            'challenge' => 'Eliminate Manual Data Entry:',
            'challenges' => [
                'Manual bookkeeping consumes hundreds of hours monthly',
                'Reconciliation errors and accuracy issues affecting compliance',
                'Staff spending time on back-office instead of client work',
                'No real-time financial visibility or automated processes',
            ],
            'solutions' => [
                'Accurate recording and categorization of all legal transactions',
                'Matter-level revenue and account tracking',
                'Retainer, disbursement, and client fund management',
                'Monthly reconciliations and compliance-ready reporting',
                'Audit-ready documentation aligned with legal accounting standards',
            ],
        ],
    ];

    $reasons = [
        [
            'theme' => 'purple',
            'icon' => 'fa-gavel',
            'title' => 'Legal Industry Specialization',
            'text' => 'We have a strong understanding of compliance, matter accounting, and attorney billing, along with expertise in numerous software programs.',
        ],
        [
            'theme' => 'blue',
            'icon' => 'fa-infinity',
            'title' => 'Integrated Solutions',
            'text' => 'One partner for cloud, security, accounting, bookkeeping, payroll, and BPO. No vendor juggling or integration headaches.',
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-shield-halved',
            'title' => 'Security That Protects Reputation',
            'text' => 'ISO 27001 certified with 24/7 Managed SOC, end-to-end encryption, and zero-trust security model protecting client confidentiality.',
        ],
        [
            'theme' => 'deep',
            'icon' => 'fa-file-invoice-dollar',
            'title' => 'Proven Cost Savings',
            'text' => 'Reduce operational overhead by 40-60% compared to in-house teams. ROI within 6 months through efficiency and automation.',
        ],
    ];

    $assessmentItems = [
        'Security & compliance vulnerability scan',
        'Cost reduction opportunity analysis',
        'Operational efficiency recommendations',
        'Custom implementation roadmap',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/legal-firm.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="lf-page">
        {{-- Hero --}}
        <section class="lf-hero" aria-labelledby="lf-hero-title">
            <div class="site-shell lf-hero__inner">
                <div class="lf-hero__copy">
                    <h1 id="lf-hero-title">Secure. Compliant. Efficient. Outsourced Solutions for Modern Law Firms</h1>
                    <p class="lf-hero__lede">
                        Complete managed solutions for law firms - cloud migration, cybersecurity, accounting, bookkeeping, payroll &amp; BPO services in one trusted partnership.
                    </p>
                    <a href="#lf-assessment" class="lf-btn lf-btn--green">
                        Get a Free Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="lf-hero__media">
                    <img
                        src="{{ $img('legal-firm-hero-img.webp') }}"
                        alt="legal-firm-hero-img"
                        width="800"
                        height="532"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="lf-stats" aria-label="Legal firm delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="lf-stats__icon" aria-hidden="true">
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
        <section class="lf-section lf-section--soft" aria-labelledby="lf-certs-title">
            <div class="site-shell">
                <div class="lf-heading">
                    <h2 id="lf-certs-title">Certifications &amp; Compliance</h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="lf-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="lf-cert" role="listitem">
                            <div class="lf-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="lf-cert__check">
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

        {{-- Service-specific solutions --}}
        <section class="lf-section" aria-labelledby="lf-services-title">
            <div class="site-shell">
                <div class="lf-heading">
                    <h2 id="lf-services-title">Service-Specific Solutions for Your Legal Firm</h2>
                    <p>Each service offers efficient, ethical operations with clean audits, accurate books, timely filings, and clear profitability insights.</p>
                </div>
                <div class="lf-services">
                    @foreach ($services as $service)
                        <article class="lf-service lf-service--{{ $service['theme'] }}">
                            <header class="lf-service__head">
                                <span class="lf-service__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $service['icon'] }}"></i>
                                </span>
                                <h3>{{ $service['title'] }}</h3>
                            </header>

                            <h4>{{ $service['challenge'] }}</h4>
                            <ul class="lf-checks">
                                @foreach ($service['challenges'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <h4>Our Solutions:</h4>
                            <ul class="lf-checks">
                                @foreach ($service['solutions'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="#lf-assessment" class="lf-btn lf-btn--card">Request a Consultation</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="lf-cta" aria-labelledby="lf-cta-title">
            <div class="site-shell lf-cta__inner">
                <h2 id="lf-cta-title">Ready to streamline your legal operations?</h2>
                <p>Schedule your free consultation today and discover how we can help you cut costs, ensure compliance, and boost efficiency</p>
                <a href="#lf-assessment" class="lf-btn lf-btn--white">Schedule a Free Consultation</a>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="lf-section lf-section--mist" aria-labelledby="lf-why-title">
            <div class="site-shell">
                <div class="lf-heading">
                    <h2 id="lf-why-title">Why Choose <span>IBN Technology</span></h2>
                </div>
                <div class="lf-reasons">
                    @foreach ($reasons as $reason)
                        <article class="lf-reason lf-reason--{{ $reason['theme'] }}">
                            <header class="lf-reason__head">
                                <span class="lf-reason__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $reason['icon'] }}"></i>
                                </span>
                                <h3>{{ $reason['title'] }}</h3>
                            </header>
                            <p>{{ $reason['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="lf-section lf-section--soft" id="lf-assessment" aria-labelledby="lf-assess-title">
            <div class="site-shell lf-assess">
                <div class="lf-assess__copy">
                    <h2 id="lf-assess-title">Get Your Free Legal Firm Assessment</h2>
                    <p>See exactly where you can cut costs, improve compliance, and free up your team for billable work.</p>
                    <ul class="lf-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="lf-assess__card" aria-labelledby="lf-form-title">
                    <h3 id="lf-form-title">Compliance-Driven Outsourcing for Legal Excellence</h3>
                    <p>Delegate payroll, accounting, and IT security to experts so you can concentrate on winning cases.</p>
                    <livewire:forms.contact-form
                        form-name="legal-firm"
                        id-prefix="lf"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Requirements"
                        :message-rows="4"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
