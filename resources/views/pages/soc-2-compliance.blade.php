@php
    $img = fn (string $file): string => asset('images/soc-2-compliance/'.$file);
    $flag = fn (string $file): string => asset('images/icons/'.$file);

    $heroStats = [
        ['icon' => 'fa-clock', 'value' => '24 hours', 'label' => 'Compliance assessment'],
        ['icon' => 'fa-calendar-days', 'value' => '6-12 month', 'label' => 'Audit engagement'],
        ['icon' => 'fa-route', 'value' => 'Zero Delays', 'label' => 'Audit-ready roadmap'],
    ];

    $trustCriteria = [
        'Security',
        'Availability',
        'Processing Integrity',
        'Confidentiality',
        'Privacy',
    ];

    $whyItems = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Win Enterprise Deals',
            'text' => 'Enterprise procurement teams increasingly won’t sign without a SOC 2 audit. A validated report unlocks $100K+ contract opportunities and removes the single biggest blocker in security review.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Build Customer Trust',
            'text' => 'A report from top SOC 2 audit firms is third-party proof, not a self-attestation – that your organization’s controls meet an internationally recognized standard.',
        ],
        [
            'icon' => 'fa-building',
            'title' => 'Regulatory Compliance',
            'text' => 'Satisfy customer contract clauses, cyber-insurance requirements, and industry-specific regulatory expectations with an auditor-issued report.',
        ],
        [
            'icon' => 'fa-star',
            'title' => 'Competitive Advantage',
            'text' => 'Stand out against competitors who can’t produce a SOC 2 report when RFPs come down to the wire.',
        ],
    ];

    $offerRows = [
        [
            'layout' => 'wide-2',
            'icon' => 'fa-file-lines',
            'columns' => [
                [
                    'title' => 'SOC 2 Type I Audit',
                    'text' => 'Point-in-time assessment of your control design across the applicable Trust Services Criteria.',
                    'items' => [
                        'Design effectiveness testing',
                        'Control documentation',
                        'Point-in-time assessment',
                        'Management letter',
                    ],
                ],
                [
                    'title' => 'SOC 2 Type I Readiness Assessment',
                    'text' => 'Quick assessment, identifying gaps in financial controls and creating your SOC 2 roadmap.',
                    'items' => [
                        'Gap analysis',
                        'Remediation roadmap',
                        'Implementation guidance',
                        'Timeline estimation',
                    ],
                ],
            ],
        ],
        [
            'layout' => 'wide-3',
            'columns' => [
                [
                    'icon' => 'fa-lock',
                    'title' => 'SOC 2 Type II Audit',
                    'text' => 'Complete 6–12-month control assessment and validation with detailed audit report from independent certified auditors.',
                    'items' => [
                        'Full control testing',
                        'Period assessment',
                        'Final SOC 2 audit report',
                        'Auditor coordination',
                    ],
                ],
                [
                    'icon' => 'fa-clock',
                    'title' => 'SOC 2 Type II Compliance Consulting',
                    'text' => 'Expert SOC 2 consulting on security policies, procedures, and control implementation tailored to your organization.',
                    'items' => [
                        'Policy development',
                        'Control design',
                        'Implementation support',
                        'Best practices',
                    ],
                ],
                [
                    'icon' => 'fa-square-check',
                    'title' => 'Readiness Assessment',
                    'text' => '1–2 Weeks initial assessment identifying compliance gaps and creating your SOC 2 audit services roadmap',
                    'items' => [
                        'Gap analysis',
                        '3–6 month roadmap',
                        'Risk prioritization',
                        'Cost estimation',
                    ],
                ],
            ],
        ],
        [
            'layout' => 'triple',
            'columns' => [
                [
                    'icon' => 'fa-file-invoice',
                    'title' => 'Documentation Advice',
                    'text' => 'Advice for Professional documentation of your security controls, policies, and procedures required for audit.',
                    'items' => [
                        'Policy writing',
                        'Control documentation',
                        'Evidence gathering',
                        'Quality review',
                    ],
                ],
                [
                    'icon' => 'fa-arrows-rotate',
                    'title' => 'Ongoing Compliance',
                    'text' => 'Maintain SOC 2 compliance with continuous monitoring and annual renewal support.',
                    'items' => [
                        'Control monitoring',
                        'Annual renewal',
                        'Updated procedures',
                        'Audit preparation',
                    ],
                ],
                [
                    'icon' => 'fa-headset',
                    'title' => 'Remediation Support',
                    'text' => 'Address specific audit findings with a scoped action plan, implementation support, and re-testing before report finalization.',
                    'items' => [
                        'Finding analysis',
                        'Action planning',
                        'Implementation support',
                        'Testing verification',
                    ],
                ],
            ],
        ],
    ];

    $framework = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security',
            'text' => 'Protection of system resources against unauthorized access, use, or modification.',
            'items' => [
                'Access management and authentication',
                'Encryption of sensitive data',
                'Network security and firewalls',
                'Intrusion detection systems',
                'Regular security assessments',
                'Vulnerability management',
            ],
        ],
        [
            'icon' => 'fa-desktop',
            'title' => 'Availability',
            'text' => 'Accessibility of the system as committed or agreed, including infrastructure and data.',
            'items' => [
                'Infrastructure redundancy',
                'Disaster recovery plans',
                'Business continuity procedures',
                'Uptime monitoring and alerting',
                'Backup and restoration procedures',
                'Load balancing and failover systems',
            ],
        ],
        [
            'icon' => 'fa-microchip',
            'title' => 'Processing Integrity',
            'text' => 'System processing is complete, accurate, timely, and authorized to meet its objectives.',
            'items' => [
                'Data validation procedures',
                'Error checking and correction',
                'Audit trails and logging',
                'Transaction monitoring',
                'Data accuracy verification',
                'Exception management',
            ],
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Confidentiality',
            'text' => 'Information designated as confidential is protected to meet its objectives.',
            'items' => [
                'Confidentiality agreements',
                'Data classification policies',
                'Access restrictions and need-to-know',
                'Secure data disposal',
                'Confidentiality training',
                'Third-party vendor management',
            ],
        ],
        [
            'icon' => 'fa-user-shield',
            'title' => 'Privacy',
            'text' => 'Personal information is collected, used, retained, and disclosed in conformity with commitments.',
            'items' => [
                'Privacy policies and notices',
                'Data retention policies',
                'Individual rights fulfillment',
                'Privacy impact assessments',
                'Cookie and tracking policies',
            ],
        ],
        [
            'icon' => 'fa-cubes',
            'title' => 'Common Criteria',
            'text' => 'Foundational controls applicable across all categories – governance, risk management, and monitoring.',
            'items' => [
                'Change management procedures',
                'Risk assessment processes',
                'Management oversight',
                'Segregation of duties',
                'Physical security controls',
                'Policy and procedure documentation',
            ],
        ],
    ];

    $process = [
        [
            'icon' => 'fa-magnifying-glass',
            'phase' => 'PHASE 01',
            'time' => 'Weeks 1–2',
            'title' => 'Assessment & Planning',
            'text' => 'We benchmark your current controls against the AICPA Trust Services Criteria, identify gaps, and build a risk-prioritized remediation roadmap.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'phase' => 'PHASE 02',
            'time' => 'Weeks 3–8',
            'title' => 'Control Design & Implementation',
            'text' => 'Policies, procedures, and technical controls are designed, documented, and implemented across your tech stack – AWS, Azure, GCP, and Microsoft 365.',
        ],
        [
            'icon' => 'fa-phone',
            'phase' => 'PHASE 03',
            'time' => 'Week 9',
            'title' => 'Audit Engagement Begins',
            'text' => 'We coordinate with an independent, AICPA-licensed CPA firm to kick off the formal audit, handling scheduling, scoping, and auditor liaison.',
        ],
        [
            'icon' => 'fa-puzzle-piece',
            'phase' => 'PHASE 04',
            'time' => 'Weeks 9-40',
            'title' => 'Testing & Remediation',
            'text' => 'The CPA firm tests your controls. We support evidence requests, address findings, and remediate any gaps before the report is finalized.',
        ],
        [
            'icon' => 'fa-certificate',
            'phase' => 'PHASE 05',
            'time' => 'Week 40+',
            'title' => 'Report & Certification',
            'text' => 'You receive your SOC 2 report, a System Description, control matrix, and auditor attestation ready to share with enterprise buyers.',
        ],
    ];

    $global = [
        [
            'flag' => 'india-flag-icon.webp',
            'alt' => 'India flag',
            'title' => 'India Tech Hubs (Pune, Bangalore, Mumbai, Hyderabad)',
            'text' => 'Cost-effective, high-touch support for Indian tech companies and SaaS startups expanding into global markets.',
        ],
        [
            'flag' => 'united-states-flag-icon.webp',
            'alt' => 'United States flag',
            'title' => 'USA',
            'text' => 'Tailored compliance support meeting rigorous US corporate governance and enterprise.',
        ],
        [
            'flag' => 'united-kingdom-flag-icon.webp',
            'alt' => 'United Kingdom flag',
            'title' => 'UK, Europe & Middle East (UAE)',
            'text' => 'Cross-border compliance solutions harmonizing SOC 2 with ISO 27001.',
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-users',
            'title' => 'Dedicated Team',
            'text' => 'A dedicated team of compliance specialists is assigned to your engagement from readiness assessment through final report.',
        ],
        [
            'icon' => 'fa-layer-group',
            'title' => 'Multi-Framework Expertise',
            'text' => 'SOC 2 alongside ISO 27001, HIPAA, and other frameworks - we harmonize overlapping controls to reduce duplicate work if you need more than one certification.',
        ],
        [
            'icon' => 'fa-thumbs-up',
            'title' => 'Comprehensive Support',
            'text' => 'From initial readiness assessment through final report delivery, we support every step of your journey.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security-First, Not Audit-Only',
            'text' => 'We strengthen your actual controls, not just prepare paperwork for an auditor. Better security, better audit outcomes.',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Accelerated Timeline',
            'text' => 'Structured, repeatable methodology gets clients from assessment to certification 30% faster than a from-scratch engagement.',
        ],
    ];

    $industries = [
        ['icon' => 'fa-file-lines', 'title' => 'Expert SOC 2 Consulting', 'text' => 'Specialized guidance'],
        ['icon' => 'fa-handshake', 'title' => 'Established Auditor Relationships', 'text' => 'Trusted partnerships'],
        ['icon' => 'fa-lock', 'title' => 'Proven Control Designs', 'text' => 'Tested frameworks'],
        ['icon' => 'fa-industry', 'title' => 'Industry-Specific Solutions', 'text' => 'Tailored approaches'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/soc-2-compliance.css'])
@endpush

@section('content')
    <div class="s2c-page">
        <section
            class="s2c-hero"
            aria-labelledby="s2c-hero-title"
            style="--s2c-hero-bg: url('{{ $img('soc2-compliance-hero-bg.webp') }}')"
        >
            <div class="site-shell s2c-hero__inner">
                <div class="s2c-hero__copy">
                    <h1 id="s2c-hero-title">SOC 2 Audit &amp; Compliance Services: Built for Growing SaaS and Tech Companies</h1>
                    <p class="s2c-hero__lede">
                        Achieve SOC 2 compliance with IBN Technologies. As an ISO 27001:2022, ISO 9001:2015, and ISO/IEC 20000-1:2018 certified partner, we help SaaS, cloud, and tech companies build strong security controls, pass CPA audits, and close enterprise deals.
                    </p>
                    <ul class="s2c-hero__stats">
                        @foreach ($heroStats as $stat)
                            <li>
                                <span class="s2c-hero__stat-icon" aria-hidden="true">
                                    <i class="fa-solid {{ $stat['icon'] }}"></i>
                                </span>
                                <span>
                                    {{ $stat['value'] }}
                                    {{ $stat['label'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="s2c-hero__form" id="contact-us" aria-labelledby="s2c-form-title">
                    <h2 id="s2c-form-title">Scale Securely with SOC 2 Compliance</h2>
                    <livewire:forms.contact-form
                        form-name="soc-2-compliance"
                        id-prefix="s2c"
                        :show-company="true"
                        :show-service="false"
                        message-placeholder="Let's get started"
                        :message-rows="2"
                        submit-label="BOOK A CONSULTATION"
                        layout="vapt"
                    />
                </aside>
            </div>
        </section>

        <section class="s2c-section" aria-labelledby="s2c-about-title">
            <div class="site-shell s2c-about">
                <div class="s2c-about__copy">
                    <h2 id="s2c-about-title">What is SOC 2?</h2>
                    <p>SOC 2 (System and Organization Controls 2) is an attestation report issued by an independent, AICPA-licensed CPA firm. It evaluates how well your organization’s controls are designed and operated against the AICPA Trust Services Criteria (TSC).</p>
                    <p>For SaaS and technology vendors selling into the US, UK, and enterprise Indian markets, a current SOC 2 report has become a standard procurement requirement, without one, deals stall in security review or get disqualified outright.</p>
                    <h3>Trust Services Criteria</h3>
                    <ol class="s2c-tsc">
                        @foreach ($trustCriteria as $index => $criterion)
                            <li>
                                <span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                {{ $criterion }}
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="s2c-about__aside">
                    <h2>SOC 2 Type I Vs. SOC 2 Type II</h2>
                    <article class="s2c-type-card">
                        <h3>SOC 2 Type I</h3>
                        <p>Point-in-time assessment of control design; ideal for first-time compliance and quick security validation.</p>
                    </article>
                    <article class="s2c-type-card">
                        <h3>SOC 2 Type II</h3>
                        <p>Evaluates control design and effectiveness over 3 to 12 months; delivers stronger assurance and greater buyer confidence.</p>
                    </article>
                    <p class="s2c-recommend">
                        <strong>Our recommendation:</strong> Most enterprise buyers, particularly in the US and UK, require SOC 2 Type 2 Compliance services. Many companies start with Type I to demonstrate early commitment, then progress to Type II within two to three quarters.
                    </p>
                </div>
            </div>
        </section>

        <section class="s2c-section s2c-section--soft" aria-labelledby="s2c-why-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">THE BUSINESS CASE</p>
                    <h2 id="s2c-why-title">Why Businesses Invest in <span class="s2c-accent">SOC 2</span> Compliance Services</h2>
                    <p>Compliance is more than a certificate- it’s a revenue enabler that opens doors and closes deals.</p>
                </div>

                <div class="s2c-why-grid" role="list">
                    @foreach ($whyItems as $item)
                        <article class="s2c-why-card" role="listitem">
                            <span class="s2c-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="s2c-offerings" aria-labelledby="s2c-offer-title">
            <div class="site-shell">
                <div class="s2c-heading s2c-heading--light">
                    <p class="s2c-kicker s2c-kicker--light">WHAT WE DELIVER</p>
                    <h2 id="s2c-offer-title">Our <span class="s2c-accent">SOC 2</span> compliance services</h2>
                    <p>From initial gap assessment to ongoing monitoring, we cover every phase of your SOC 2 journey.</p>
                </div>

                <div class="s2c-offer-stack">
                    @foreach ($offerRows as $row)
                        @if ($row['layout'] === 'triple')
                            <div class="s2c-offer-triple">
                                @foreach ($row['columns'] as $item)
                                    <article class="s2c-offer-card">
                                        <span class="s2c-offer-card__icon" aria-hidden="true">
                                            <i class="fa-solid {{ $item['icon'] }}"></i>
                                        </span>
                                        <h3>{{ $item['title'] }}</h3>
                                        <p>{{ $item['text'] }}</p>
                                        <ul>
                                            @foreach ($item['items'] as $point)
                                                <li>{{ $point }}</li>
                                            @endforeach
                                        </ul>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <article class="s2c-offer-card s2c-offer-card--wide s2c-offer-card--{{ $row['layout'] }}">
                                @if (! empty($row['icon']))
                                    <span class="s2c-offer-card__icon" aria-hidden="true">
                                        <i class="fa-solid {{ $row['icon'] }}"></i>
                                    </span>
                                @endif
                                <div class="s2c-offer-card__cols">
                                    @foreach ($row['columns'] as $item)
                                        <div class="s2c-offer-block">
                                            @if (! empty($item['icon']))
                                                <span class="s2c-offer-card__icon" aria-hidden="true">
                                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                                </span>
                                            @endif
                                            <h3>{{ $item['title'] }}</h3>
                                            <p>{{ $item['text'] }}</p>
                                            <ul>
                                                @foreach ($item['items'] as $point)
                                                    <li>{{ $point }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <section class="s2c-band" aria-labelledby="s2c-band-title">
            <div class="site-shell s2c-band__inner">
                <div>
                    <h2 id="s2c-band-title">Ready to start SOC 2 Type 2 audit in Pune?</h2>
                    <p>Get a Free SOC 2 Readiness Assessment from One of the Best SOC 2 Compliance Services in Pune.</p>
                </div>
                <a href="#contact-us" class="s2c-band__btn">Book a Consultation</a>
            </div>
        </section>

        <section class="s2c-section s2c-section--mist" aria-labelledby="s2c-framework-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">AICPA TRUST SERVICES CRITERIA</p>
                    <h2 id="s2c-framework-title">What <span class="s2c-accent">SOC 2</span> Actually Evaluates</h2>
                    <p>SOC 2 assesses your organization against five Trust Services Criteria plus the foundational Common Criteria that underpin them all.</p>
                </div>

                <div class="s2c-framework-grid">
                    @foreach ($framework as $item)
                        <article class="s2c-framework-card">
                            <header class="s2c-framework-card__head">
                                <span aria-hidden="true"><i class="fa-solid {{ $item['icon'] }}"></i></span>
                                <h3>{{ $item['title'] }}</h3>
                            </header>
                            <div class="s2c-framework-card__body">
                                <p>{{ $item['text'] }}</p>
                                <p class="s2c-framework-card__label">Required Controls</p>
                                <ul>
                                    @foreach ($item['items'] as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="s2c-section s2c-section--mint" aria-labelledby="s2c-process-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">METHODOLOGY</p>
                    <h2 id="s2c-process-title">Our <span class="s2c-accent">SOC 2 Implementation</span> Process</h2>
                    <p>A proven, AICPA-aligned methodology used across SaaS, fintech, and IT services engagements.</p>
                </div>

                <ol class="s2c-process">
                    @foreach ($process as $step)
                        <li class="s2c-process__item">
                            <span class="s2c-process__icon" aria-hidden="true">
                                <i class="fa-solid {{ $step['icon'] }}"></i>
                            </span>
                            <article class="s2c-process__card">
                                <div class="s2c-process__top">
                                    <div>
                                        <p class="s2c-process__phase">{{ $step['phase'] }}</p>
                                        <h3>{{ $step['title'] }}</h3>
                                        <p class="s2c-process__sub">{{ $step['text'] }}</p>
                                    </div>
                                    <span class="s2c-process__chip">{{ $step['time'] }}</span>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section class="s2c-section" aria-labelledby="s2c-global-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">GLOBAL PRESENCE</p>
                    <h2 id="s2c-global-title">SOC 2 services: Global Reach, On-Ground Expertise - India, USA, UK &amp; Beyond</h2>
                    <p>IBN Technologies delivers seamlessly managed SOC 2 audit readiness across key tech centers worldwide:</p>
                </div>

                <div class="s2c-global" role="list">
                    @foreach ($global as $item)
                        <article class="s2c-global__card" role="listitem">
                            <img src="{{ $flag($item['flag']) }}" alt="{{ $item['alt'] }}" width="48" height="32">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="s2c-section s2c-section--soft" aria-labelledby="s2c-choose-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">WHY IBN TECHNOLOGIES</p>
                    <h2 id="s2c-choose-title">Why Choose us for <span class="s2c-accent">SOC 2</span> Compliance Services</h2>
                    <p>Partner with ISO 27001:2022, ISO 9001:2015, and ISO/IEC 20000-1:2018 certified. We apply the same security discipline internally that we implement for clients.</p>
                </div>

                <div class="s2c-choose-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="s2c-choose-card" role="listitem">
                            <span class="s2c-choose-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="s2c-industry" aria-labelledby="s2c-industry-title">
            <div class="site-shell">
                <div class="s2c-industry__panel">
                    <h2 id="s2c-industry-title">Industry Expertise</h2>
                    <p>We specialize exclusively in SOC 2 compliance. Our team stays current with the latest AICPA guidance, industry best practices, and auditor expectations.</p>
                    <div class="s2c-industry__grid" role="list">
                        @foreach ($industries as $item)
                            <article class="s2c-industry__card" role="listitem">
                                <span aria-hidden="true"><i class="fa-solid {{ $item['icon'] }}"></i></span>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="s2c-cta" aria-labelledby="s2c-cta-title">
            <div class="site-shell s2c-cta__inner">
                <h2 id="s2c-cta-title">Ready to Get SOC 2 Certified?</h2>
                <p>Simplify your journey to SOC 2 certification with expert guidance.</p>
                <a href="#contact-us" class="s2c-cta__btn">Schedule a Consultation</a>
            </div>
        </section>
    </div>
@endsection
