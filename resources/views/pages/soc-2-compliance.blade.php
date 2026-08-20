@php
    $img = fn (string $file): string => asset('images/soc-2-compliance/'.$file);

    $heroStats = [
        ['icon' => 'fa-clock', 'value' => '24 hours', 'label' => 'Compliance assessment'],
        ['icon' => 'fa-calendar-days', 'value' => '6-12 month', 'label' => 'Audit engagement'],
        ['icon' => 'fa-user-tie', 'value' => 'Expert-led', 'label' => 'Implementation support'],
    ];

    $whyItems = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Win Enterprise Deals',
            'text' => 'Enterprise buyers require SOC 2 certification. Unlock $100K+ contract opportunities.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Build Customer Trust',
            'text' => 'Demonstrate security maturity and prove your organization controls meet industry standards.',
        ],
        [
            'icon' => 'fa-building',
            'title' => 'Regulatory Compliance',
            'text' => 'Meet customer contract requirements and industry-specific regulations with a validated SOC 2 report.',
        ],
        [
            'icon' => 'fa-star',
            'title' => 'Competitive Advantage',
            'text' => 'Stand out in the market and differentiate from competitors without SOC 2 certification.',
        ],
    ];

    $offerings = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'SOC 2 Type I Audit',
            'text' => 'Complete SOC 2 Type I audit evaluating design of controls over financial reporting and data processing.',
            'items' => [
                'Design effectiveness testing',
                'Control documentation',
                'Point-in-time assessment',
                'Management letter',
            ],
            'sub' => [
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
        [
            'icon' => 'fa-lock',
            'title' => 'SOC 2 Type II Audit',
            'text' => 'Complete 6–12-month control assessment and validation with detailed SOC 2 report from independent certified auditors.',
            'items' => [
                'Full control testing',
                'Period assessment',
                'Final audit report',
                'Auditor coordination',
            ],
        ],
        [
            'icon' => 'fa-clipboard-check',
            'title' => 'SOC 2 Type II Compliance Consulting',
            'text' => 'Expert guidance on security policies, procedures, and control implementation tailored to your organization.',
            'items' => [
                'Policy development',
                'Control design',
                'Implementation support',
                'Best practices',
            ],
        ],
        [
            'icon' => 'fa-magnifying-glass',
            'title' => 'Readiness Assessment',
            'text' => '1-2 Weeks initial assessment identifying compliance gaps and creating your SOC 2 roadmap.',
            'items' => [
                'Gap analysis',
                '3-6 month roadmap',
                'Risk prioritization',
                'Cost estimation',
            ],
        ],
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
            'text' => 'Help addressing audit findings and implementing corrective actions for identified control gaps.',
            'items' => [
                'Finding analysis',
                'Action planning',
                'Implementation support',
                'Testing verification',
            ],
        ],
    ];

    $framework = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security',
            'text' => 'Protection of data from unauthorized access and disclosure',
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
            'text' => 'Systems are available and operational for intended use',
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
            'text' => 'Data processing is accurate, complete, and on a timely basis',
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
            'text' => 'Restricted information remains private and confidential',
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
            'text' => 'Personal information is managed according to privacy principles',
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
            'text' => 'General controls applicable across all criteria',
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
            'title' => 'Assessment & Planning',
            'time' => 'Weeks 1–2',
            'text' => 'Initial compliance assessment, gap analysis, and SOC 2 roadmap creation',
            'items' => [
                'Current control evaluation',
                'Compliance gap identification',
                'Implementation roadmap',
                'Timeline and resource planning',
                'Cost estimation',
            ],
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Control Design & Implementation',
            'time' => 'Weeks 3–8',
            'text' => 'Design and implement security controls aligned with SOC 2 Trust Service Criteria',
            'items' => [
                'Security policy development',
                'Control procedures documentation',
                'Access management systems',
                'Incident response procedures',
                'Data protection policies',
                'Staff training programs',
            ],
        ],
        [
            'icon' => 'fa-phone',
            'title' => 'Audit Engagement Begins',
            'time' => 'Week 9',
            'text' => 'Kickoff audit with independent CPA firm and begin control testing',
            'items' => [
                'Auditor selection and engagement',
                'Audit scope agreement',
                'Testing plan development',
                'Control documentation review',
                'Preliminary testing initiation',
            ],
        ],
        [
            'icon' => 'fa-puzzle-piece',
            'title' => 'Testing & Remediation',
            'time' => 'Weeks 9–40',
            'text' => 'Ongoing control testing, monitoring, and remediation of any identified gaps',
            'items' => [
                'Continuous control testing',
                'Evidence collection',
                'Findings remediation',
                'Control effectiveness monitoring',
                'Monthly compliance reviews',
            ],
        ],
        [
            'icon' => 'fa-certificate',
            'title' => 'SOC 2 Type 2 Report & Certification',
            'time' => 'Week 40+',
            'text' => 'Final audit report delivery and SOC 2 Type II certification',
            'items' => [
                'Final control testing',
                'Auditor report compilation',
                'Report review and approval',
                'SOC 2 Type II certification',
                'Client communication',
            ],
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-users',
            'title' => 'Dedicated Team',
            'text' => 'You get a dedicated team of compliance specialists assigned to your audit throughout the entire engagement.',
        ],
        [
            'icon' => 'fa-star',
            'title' => 'Proven Methodology',
            'text' => 'Our battle-tested approach has successfully certified 10+ companies across all industries and company stages.',
        ],
        [
            'icon' => 'fa-thumbs-up',
            'title' => 'Comprehensive Support',
            'text' => 'From initial readiness assessment through final report delivery, we support every step of your journey.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security-First Approach',
            'text' => 'We strengthen your actual controls, not just prepare for the audit. Better security, better results.',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Accelerated Timeline',
            'text' => 'Get from assessment to certification 30% faster than industry average with our streamlined processes.',
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
        {{-- Hero --}}
        <section
            class="s2c-hero"
            aria-labelledby="s2c-hero-title"
            style="--s2c-hero-bg: url('{{ $img('soc2-compliance-hero-bg.webp') }}')"
        >
            <div class="site-shell s2c-hero__inner">
                <div class="s2c-hero__copy">
                    <h1 id="s2c-hero-title">SOC 2 Compliance – Simplified for Modern Growing Companies</h1>
                    <p class="s2c-hero__lede">
                        Achieve SOC 2 compliance and build enterprise trust. Our SOC 2 audit services help SaaS and tech companies meet security requirements and win customer confidence.
                    </p>
                    <ul class="s2c-hero__stats">
                        @foreach ($heroStats as $stat)
                            <li>
                                <span class="s2c-hero__stat-icon" aria-hidden="true">
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

        {{-- Why SOC 2 --}}
        <section class="s2c-section s2c-section--soft" aria-labelledby="s2c-why-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">Why it matters</p>
                    <h2 id="s2c-why-title">Why <span class="s2c-accent">SOC 2</span> Report is Essential</h2>
                    <p>SOC 2 compliance is the gold standard for SaaS and cloud companies. It demonstrates your commitment to security, availability, and data protection.</p>
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

        {{-- Service offerings --}}
        <section class="s2c-offerings" aria-labelledby="s2c-offer-title">
            <div class="site-shell">
                <div class="s2c-heading s2c-heading--light">
                    <p class="s2c-kicker s2c-kicker--light">What we offer</p>
                    <h2 id="s2c-offer-title">Comprehensive <span class="s2c-accent">SOC 2</span> Service Offerings</h2>
                    <p>From initial assessment to final audit report, we provide end-to-end SOC 2 Type I and Type II compliance services</p>
                </div>

                <div class="s2c-offer-grid">
                    @foreach ($offerings as $item)
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
                            @if (! empty($item['sub']))
                                <div class="s2c-offer-card__sub">
                                    <h4>{{ $item['sub']['title'] }}</h4>
                                    <p>{{ $item['sub']['text'] }}</p>
                                    <ul>
                                        @foreach ($item['sub']['items'] as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Framework --}}
        <section class="s2c-section s2c-section--mist" aria-labelledby="s2c-framework-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">Framework</p>
                    <h2 id="s2c-framework-title">Understanding <span class="s2c-accent">SOC 2 Compliance Services</span> Framework</h2>
                    <p>SOC 2 Type II evaluates your organization across five critical Trust Service Criteria</p>
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

        {{-- Implementation process --}}
        <section class="s2c-section s2c-section--mint" aria-labelledby="s2c-process-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">How it works</p>
                    <h2 id="s2c-process-title">Our <span class="s2c-accent">SOC 2 Implementation</span> Process</h2>
                    <p>A proven, methodical approach to getting you SOC 2 Type II certified efficiently</p>
                </div>

                <ol class="s2c-process">
                    @foreach ($process as $index => $step)
                        <li class="s2c-process__item">
                            <span class="s2c-process__icon" aria-hidden="true">
                                <i class="fa-solid {{ $step['icon'] }}"></i>
                            </span>
                            <article class="s2c-process__card">
                                <div class="s2c-process__top">
                                    <div>
                                        <h3>Stage {{ $index + 1 }}: {{ $step['title'] }}</h3>
                                        <p class="s2c-process__sub">{{ $step['text'] }}</p>
                                    </div>
                                    <span class="s2c-process__chip">{{ $step['time'] }}</span>
                                </div>
                                <ul>
                                    @foreach ($step['items'] as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            </article>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="s2c-section" aria-labelledby="s2c-choose-title">
            <div class="site-shell">
                <div class="s2c-heading">
                    <p class="s2c-kicker">Why choose us</p>
                    <h2 id="s2c-choose-title">Why Choose Our <span class="s2c-accent">SOC 2 Services</span></h2>
                    <p>IBN Technologies is a trusted provider of the best SOC 2 compliance services in India, offering expert SOC 2 consulting, and SOC 2 audit services for businesses across industries.</p>
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

        {{-- Industry expertise --}}
        <section class="s2c-industry" aria-labelledby="s2c-industry-title">
            <div class="site-shell">
                <div class="s2c-industry__panel">
                    <h2 id="s2c-industry-title">Industry Expertise</h2>
                    <p>We specialize in SOC 2 compliance services, delivering expert SOC 2 consulting, SOC 2 audit services, and guidance from experienced SOC 2 consultants to help businesses achieve and maintain compliance.</p>
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

        {{-- CTA --}}
        <section class="s2c-cta" aria-labelledby="s2c-cta-title">
            <div class="site-shell s2c-cta__inner">
                <h2 id="s2c-cta-title">Schedule a Complimentary SOC 2 Compliance Assessment</h2>
                <p>We help SaaS and tech companies achieve SOC 2, boost security, and close enterprise deals with expert audit services.</p>
                <a href="#contact-us" class="s2c-cta__btn">Schedule a Consultation</a>
            </div>
        </section>
    </div>
@endsection
