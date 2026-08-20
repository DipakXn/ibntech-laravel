@php
    $img = fn (string $file): string => asset('images/aws-cloud-services/'.$file);

    $heroStats = [
        ['icon' => 'fa-chart-line', 'value' => '99.9%', 'label' => 'Uptime SLA'],
        ['icon' => 'fa-dollar-sign', 'value' => '25-40%', 'label' => 'Cost Reduction'],
        ['icon' => 'fa-medal', 'value' => '10+', 'label' => 'AWS certifications'],
        ['icon' => 'fa-clock', 'value' => '24x7', 'label' => 'NOC/SOC Monitoring'],
    ];

    $serviceCards = [
        [
            'icon' => 'fa-cloud-arrow-up',
            'title' => 'AWS Cloud Migration Services',
            'text' => 'Accelerate your journey to the cloud with expert-led migration strategies that ensure business continuity and operational efficiency.',
            'points' => [
                'Transition workloads, applications, and databases to AWS with zero downtime.',
                'Advantages from intelligent automation and safe frameworks for a simplified migration experience.',
            ],
            'footer' => null,
            'keyBenefits' => null,
        ],
        [
            'icon' => 'fa-gears',
            'title' => '24×7 Managed AWS Services',
            'text' => null,
            'points' => [
                'Confirm uninterrupted cloud operations with proactive support and intelligent automation from IBN Tech\'s dedicated NOC/SOC teams.',
                'Round-the-clock monitoring, maintenance, and incident resolution to stay your environment stable.',
                'Automated optimization execution, patch management, and backup practices for peak efficiency.',
                'Embedded security and compliance control across all managed workloads.',
            ],
            'footer' => null,
            'keyBenefits' => null,
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'AWS Cost Optimization & FinOps',
            'text' => 'Expand full visibility and control over your AWS spending with strategic financial operations and intelligent tools.',
            'points' => [
                'Monitor and manage cloud costs using dynamic dashboards and rightsizing techniques.',
                'Apply FinOps methodologies to drive transparency, accountability, and cost-efficiency across teams.',
            ],
            'footer' => null,
            'keyBenefits' => null,
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security & Compliance Management',
            'text' => 'Safeguard your AWS environment with complete security solutions aligned to global and industry-specific standards.',
            'points' => [
                'End-to-end protection is meant to meet GDPR, HIPAA, ISO 27001, and RBI/SEBI compliance requirements.',
                '24×7 SOC operations bring real-time threat detection, monitoring, and rapid incident response.',
            ],
            'footer' => null,
            'keyBenefits' => null,
        ],
        [
            'icon' => 'fa-code-branch',
            'title' => 'DevOps & Automation',
            'text' => 'Streamline development and operations with AWS-native tools and intelligent automation to boost agility and reliability.',
            'points' => [
                'Accelerate delivery pipelines using CI/CD, Infrastructure as Code (IaC), and self-healing systems.',
                'Improve uptime and reduce manual tasks through automated deployment and monitoring.',
            ],
            'footer' => null,
            'keyBenefits' => null,
        ],
        [
            'icon' => 'fa-database',
            'title' => 'AWS RDS (Relational Database Service)',
            'text' => 'At IBN Technologies, Pune, we leverage Amazon RDS to deliver secure, scalable, and highly available database solutions tailored to your business needs. With support for popular engines like MySQL, PostgreSQL, SQL Server, AWS RDS helps us manage database operations with minimal overhead—freeing your team to focus on innovation.',
            'points' => [],
            'keyBenefits' => [
                'Automated Backups & Patch Management',
                'High Availability with Multi-AZ Deployment',
                'Performance Monitoring & Scalability',
                'Encryption at Rest and in Transit',
                'Seamless Integration with AWS Ecosystem',
            ],
            'footer' => 'Whether you\'re migrating from on-premises or building cloud-native applications, IBN Tech\'s AWS-certified experts ensure smooth deployment and ongoing management of your RDS instances for maximum efficiency and reliability.',
        ],
    ];

    $whyCards = [
        [
            'icon' => 'fa-clock',
            'title' => '24×7 AWS Management',
            'text' => 'Our committed support guarantees constant uptime and prompt problem solving, maintaining the stability and responsiveness of your cloud environment at all times.',
        ],
        [
            'icon' => 'fa-sun',
            'title' => 'AWS-Certified Engineers',
            'text' => 'Every solution is created and executed by experts who are 100% AWS certified, ensuring that best practices are followed and excellent results are produced.',
        ],
        [
            'icon' => 'fa-right-left',
            'title' => 'Migration Expertise',
            'text' => 'We are experts at ensuring a seamless move to AWS without interfering with company operations through safe, disruption-free migration across a variety of workloads.',
        ],
        [
            'icon' => 'fa-eye',
            'title' => 'Integrated SOC & NOC',
            'text' => 'By offering integrated security and performance monitoring and administration, our combined Security Operations Center (SOC) and Network Operations Center (NOC) provide visibility and control.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'Cost Optimization Framework',
            'text' => 'Through intelligent cost management strategies and FinOps practices, we help enterprises significantly reduce their AWS operational expenses while maintaining performance.',
        ],
    ];

    $apartPoints = [
        'End-to-end AWS expertise: strategy, migration, management, security, and optimization',
        '26+ years of IT and cloud experience',
        'High-availability cloud environments',
        'Real-time monitoring for proactive issue detection',
        'Expert remediation for seamless AWS performance',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/aws-cloud-services.css'])
@endpush

@section('content')
    <div class="awscs-page">
        {{-- Hero --}}
        <section class="awscs-hero" aria-labelledby="awscs-hero-title">
            <div class="site-shell awscs-hero__inner">
                <div class="awscs-hero__copy">
                    <h1 id="awscs-hero-title">
                        AWS Cloud Services by <span class="awscs-accent">IBN Technologies</span>
                    </h1>
                    <p class="awscs-hero__lede">
                        Transform your business with end-to-end AWS cloud services. Maximize performance, minimize costs, and ensure zero downtime with our comprehensive AWS solutions.
                    </p>

                    <div class="awscs-hero__stats" role="list">
                        @foreach ($heroStats as $stat)
                            <div class="awscs-hero__stat" role="listitem">
                                <span class="awscs-hero__stat-icon fa-solid {{ $stat['icon'] }}" aria-hidden="true"></span>
                                <div>
                                    <strong>{{ $stat['value'] }}</strong>
                                    <span>{{ $stat['label'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="awscs-hero__actions">
                        <a href="#awscs-consult" class="awscs-btn awscs-btn--green">
                            Talk to an AWS Cloud Expert
                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="awscs-hero__media">
                    <img
                        src="{{ $img('AWS-Cloud-Service.webp') }}"
                        alt="AWS Cloud Service"
                        width="380"
                        height="380"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Strategic AWS Partnership --}}
        <section class="awscs-section" aria-labelledby="awscs-partnership-title">
            <div class="site-shell">
                <div class="awscs-partner-badge">
                    <img
                        src="{{ $img('AWS-Partner-logo.webp') }}"
                        alt="AWS Partner Advanced Tier Services"
                        width="160"
                        height="180"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="awscs-heading">
                    <h2 id="awscs-partnership-title">
                        Strategic <span class="awscs-accent">AWS</span> Partnership
                    </h2>
                </div>

                <div class="awscs-split">
                    <div class="awscs-split__copy">
                        <p>
                            IBN Technologies invites strategic partners to work together in providing businesses in a variety of sectors with top-notch AWS Cloud services. IBN Tech, an AWS Advanced Consulting Partner, provides a wide range of cloud solutions supported by operational frameworks that have been shown to function, certified knowledge, and round-the-clock support.
                        </p>
                        <p>
                            The goal of this collaboration is to combine your market reach, customer base, and subject matter expertise with IBN Tech's technical skills and specialized knowledge.
                        </p>
                        <p>
                            IBN Technologies delivers trusted AWS Cloud services across industries. With certified expertise, we provide scalable, secure, and innovative cloud solutions backed by 24/7 support.
                        </p>
                    </div>
                    <div class="awscs-split__media">
                        <img
                            src="{{ $img('Strategic-AWS-Partnership.webp') }}"
                            alt="Strategic AWS Partnership"
                            width="400"
                            height="400"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Consulting Services --}}
        <section class="awscs-section awscs-section--soft" aria-labelledby="awscs-services-title">
            <div class="site-shell">
                <div class="awscs-heading">
                    <h2 id="awscs-services-title">
                        Our <span class="awscs-accent">AWS Consulting Services</span> and Industry Practices
                    </h2>
                    <p>Continuous Cloud Management. Zero Downtime. Maximum Performance.</p>
                </div>

                <div class="awscs-service-grid" role="list">
                    @foreach ($serviceCards as $card)
                        <article class="awscs-service-card" role="listitem">
                            <header class="awscs-service-card__head">
                                <span class="awscs-service-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $card['icon'] }}"></i>
                                </span>
                                <h3>{{ $card['title'] }}</h3>
                            </header>

                            @if ($card['text'])
                                <p>{{ $card['text'] }}</p>
                            @endif

                            @if (! empty($card['points']))
                                <ul>
                                    @foreach ($card['points'] as $point)
                                        <li>
                                            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                            <span>{{ $point }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            @if (! empty($card['keyBenefits']))
                                <p class="awscs-service-card__label">Key Benefits:</p>
                                <ul>
                                    @foreach ($card['keyBenefits'] as $benefit)
                                        <li>
                                            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                            <span>{{ $benefit }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            @if ($card['footer'])
                                <p class="awscs-service-card__footer">{{ $card['footer'] }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="awscs-cta-banner" aria-labelledby="awscs-cta-title">
            <div class="site-shell awscs-cta-banner__inner">
                <h2 id="awscs-cta-title">Ready to Optimize Your AWS Cloud Journey?</h2>
                <p>
                    Schedule a free consultation with our AWS certified experts to discuss your specific needs and develop a customized strategy for your organization.
                </p>
                <a href="#" class="awscs-btn awscs-btn--green" data-contact-modal-trigger>
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    Schedule a Free Consultation
                </a>
            </div>
        </section>

        {{-- Why Enterprises Choose --}}
        <section class="awscs-section" aria-labelledby="awscs-why-title">
            <div class="site-shell">
                <div class="awscs-heading">
                    <h2 id="awscs-why-title">
                        Why Enterprises Choose <span class="awscs-accent">IBN Tech for AWS</span>
                    </h2>
                    <p>
                        IBN stands out as a trusted AWS partner by combining technical excellence with a deep understanding of enterprise needs. Here's how we deliver measurable value:
                    </p>
                </div>

                <div class="awscs-why-grid" role="list">
                    @foreach ($whyCards as $card)
                        <article class="awscs-why-card" role="listitem">
                            <span class="awscs-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </span>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Operations Framework --}}
        <section class="awscs-section awscs-section--tight" aria-labelledby="awscs-framework-title">
            <div class="site-shell">
                <div class="awscs-heading">
                    <h2 id="awscs-framework-title">
                        From Visibility to Value: <span class="awscs-accent">The AWS Operations Framework</span>
                    </h2>
                </div>
                <figure class="awscs-figure">
                    <img
                        src="{{ $img('The-AWS-Operations-Framework.webp') }}"
                        alt="The AWS Operations Framework: Monitor, Manage, Secure, Optimize"
                        width="944"
                        height="372"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Partner intro + What Sets Apart + Form --}}
        <section class="awscs-section awscs-section--soft" id="awscs-consult" aria-labelledby="awscs-partner-intro-title">
            <div class="site-shell">
                <div class="awscs-intro-panel">
                    <h2 id="awscs-partner-intro-title">IBN Technologies — Your 24×7 AWS Management Partner</h2>
                    <p>
                        IBN Technologies is an <strong>AWS Advanced Partner</strong> delivering <strong>end-to-end AWS Cloud and Cyber Security Services.</strong>
                    </p>
                    <p>
                        With <strong>26+ years of expertise</strong> in IT Infrastructure and <strong>a certified AWS team</strong>, we help enterprises build, migrate, and manage secure and scalable cloud environments with guaranteed uptime.
                    </p>
                </div>
            </div>

            <div class="site-shell awscs-consult">
                <div class="awscs-consult__copy">
                    <h2 id="awscs-apart-title">What Sets IBN Apart in AWS Cloud Services</h2>
                    <ul class="awscs-check-list">
                        @foreach ($apartPoints as $point)
                            <li>
                                <i class="fa-solid fa-square-check" aria-hidden="true"></i>
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="awscs-consult__card" id="awscs-consult-form" aria-labelledby="awscs-consult-form-title">
                    <h3 id="awscs-consult-form-title">Get in Touch with Our AWS Experts</h3>
                    <p class="awscs-consult__lede">
                        Get started with enterprise-grade AWS cloud services. Our AWS-certified experts are ready to optimize your cloud infrastructure.
                    </p>

                    <livewire:forms.contact-form
                        form-name="aws-cloud-services"
                        id-prefix="awscs"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your AWS requirement"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
