@php
    $img = fn (string $file): string => asset('images/managed-detection-response-services/'.$file);
    $certImg = fn (string $file): string => asset('images/vapt-certs/'.$file);

    $heroStats = [
        ['icon' => 'fa-clock', 'line1' => '24/7/365', 'line2' => 'Monitoring'],
        ['icon' => 'fa-globe', 'line1' => 'Global', 'line2' => 'Security Partner'],
        ['icon' => 'fa-shield-halved', 'line1' => 'Enterprise', 'line2' => 'Grade Security'],
    ];

    $certs = [
        ['file' => 'iso-certified.webp', 'alt' => 'ISO Certified'],
        ['file' => 'seceon-professional.png', 'alt' => 'Seceon Professional'],
        ['file' => 'ceh-ethical-hacker.webp', 'alt' => 'Certified Ethical Hacker'],
        ['file' => 'fortinet-certified-network-security-professional.webp', 'alt' => 'Fortinet Certified Network Security Professional'],
        ['file' => 'certified-payment.webp', 'alt' => 'Certified Payment Security Compliance Manager'],
        ['file' => 'cisa-certification-logo.webp', 'alt' => 'CISA Certification'],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-globe',
            'title' => 'Local Expertise, Global Reach',
            'text' => 'Combines local expertise (India) with deep knowledge across US and UK regulations',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Advanced Technology Stack',
            'text' => '24/7 SOC powered by Microsoft Sentinel & Seceon aiSIEM. We also provide Managed Azure Sentinel and Sentinel MDR',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Cost-Effective Scaling',
            'text' => 'Enterprise-grade protection at SMB pricing for mid-market and enterprise environments',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Human-Led Approach',
            'text' => 'End-to-end human expertise backed by world-class technology',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Flexible Integration',
            'text' => 'Customizable SLAs, quick deployment, and ability to work with existing tools',
        ],
    ];

    $tools = [
        ['file' => 'Microsoft-Defender.png', 'alt' => 'Microsoft Defender'],
        ['file' => 'Crowstrike.png', 'alt' => 'CrowdStrike'],
        ['file' => 'Sentinelone.png', 'alt' => 'SentinelOne'],
        ['file' => 'Seceon-aiSIEM.png', 'alt' => 'Seceon aiSIEM'],
        ['file' => 'Fortinet.png', 'alt' => 'Fortinet'],
        ['file' => 'Microsoft-Sentine.png', 'alt' => 'Microsoft Sentinel'],
        ['file' => 'Azure-security-Center.png', 'alt' => 'Azure Security Center'],
        ['file' => 'aws-security-hub.png', 'alt' => 'AWS Security Hub'],
    ];

    $solutions = [
        [
            'icon' => 'fa-desktop',
            'theme' => 'navy',
            'title' => 'MDR for Endpoints',
            'items' => [
                ['label' => 'Managed Microsoft Defender', 'text' => 'Streamlined threat response with Microsoft Defender for Endpoint, covering Microsoft EDR and Azure EDR.'],
                ['label' => 'SentinelOne MDR, CrowdStrike MDR', 'text' => 'AI-driven managed threat detection and response through advanced EDR integration.'],
                ['label' => 'Ransomware and Fileless Attack Detection', 'text' => 'MDR as a Service for proactive defense against stealthy, evasive endpoint threats.'],
            ],
        ],
        [
            'icon' => 'fa-cloud',
            'theme' => 'green',
            'title' => 'MDR for Cloud',
            'items' => [
                ['label' => 'Azure, AWS, GCP Activity Monitoring', 'text' => 'Continuous visibility into specialized AWS cloud security, Azure cybersecurity and MDR cloud security services.'],
                ['label' => 'Cloud Workload Protection', 'text' => 'Secure VMs, containers, and serverless functions across multi-cloud environments.'],
                ['label' => 'CASB Integration', 'text' => 'Enforce cloud access policies and detect shadow IT with Cloud Access Security Broker tools.'],
            ],
        ],
        [
            'icon' => 'fa-building',
            'theme' => 'navy',
            'title' => 'MDR for Microsoft 365 & SaaS',
            'items' => [
                ['label' => 'Office 365 Threat Detection', 'text' => 'Monitor and respond to suspicious activity across Exchange, OneDrive, and more.'],
                ['label' => 'SharePoint & Teams Monitoring', 'text' => 'Detect insider threats and data leaks in collaboration platforms.'],
                ['label' => 'Business Email Compromise (BEC) Detection', 'text' => 'Identify and stop phishing, spoofing, and account takeover attempts.'],
            ],
        ],
        [
            'icon' => 'fa-server',
            'theme' => 'green',
            'title' => 'MDR for Hybrid Environments',
            'items' => [
                ['label' => 'SIEM + EDR + NDR-Based Detection', 'text' => 'Unified analytics across network, endpoint, and log data.'],
                ['label' => 'Support for Remote Workforce and BYOD', 'text' => 'Secure users and devices regardless of location or ownership.'],
                ['label' => 'Integration with VPNs, Managed Firewall services, and On-Prem AD', 'text' => 'Extended MDR coverage to legacy and hybrid infrastructure.'],
            ],
        ],
        [
            'icon' => 'fa-shield-halved',
            'theme' => 'navy',
            'title' => 'MDR + SOC as a Service',
            'wide' => true,
            'items' => [
                ['label' => '24/7 SOC Team + Custom Response Rules', 'text' => 'Always-on security operations with tailored incident handling.'],
                ['label' => 'Tiered Escalation Workflow', 'text' => 'Structured response paths for faster resolution and reduced alert fatigue.'],
                ['label' => 'Client Portal with Dashboards', 'text' => 'Real-time visibility into threats, alerts, and compliance metrics.'],
            ],
        ],
    ];

    $features = [
        [
            'icon' => 'fa-eye',
            'title' => 'Real-Time Threat Monitoring',
            'text' => '24x7x365 monitoring of endpoints, cloud, and networks',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Proactive Threat Detection',
            'text' => 'AI-driven behavior analytics, anomaly detection, and proactive threat hunting',
        ],
        [
            'icon' => 'fa-rotate',
            'title' => 'Incident Response (IR)',
            'text' => 'Fast triage, containment, and recovery by SOC expert',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'Threat Intelligence Integration',
            'text' => 'Global threat data from MITRE ATT&CK, IOC feeds, OSINT sources',
        ],
        [
            'icon' => 'fa-desktop',
            'title' => 'Endpoint Detection & Response (EDR)',
            'text' => 'Works with Defender, SentinelOne, and CrowdStrike, etc.',
        ],
        [
            'icon' => 'fa-magnifying-glass',
            'title' => 'Forensics & Root Cause Analysis',
            'text' => 'Evidence based analysis of security incidents',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Playbook-Driven Automation',
            'text' => 'SOAR driven workflows for frequent threat actions.',
        ],
        [
            'icon' => 'fa-file-lines',
            'title' => 'Compliance Reporting',
            'text' => 'Support for HIPAA, GDPR, PCI-DSS, ISO 27001, RBI and more',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Security Analysts On-Demand',
            'text' => 'Access to certified L1–L3 security professionals',
        ],
    ];

    $deliverables = [
        [
            'icon' => 'fa-triangle-exclamation',
            'tone' => 'red',
            'title' => '24/7 Alerting',
            'text' => 'Real-time incident response updates and continuous monitoring alerts',
        ],
        [
            'icon' => 'fa-file-lines',
            'tone' => 'navy',
            'title' => 'Detailed Reports',
            'text' => 'Monthly/quarterly threat and compliance reports with executive summaries',
        ],
        [
            'icon' => 'fa-magnifying-glass',
            'tone' => 'green',
            'title' => 'Forensic Analysis',
            'text' => 'Retrospective forensics after major incidents with technical deep-dives',
        ],
        [
            'icon' => 'fa-chart-line',
            'tone' => 'orange',
            'title' => 'Security Roadmap',
            'text' => 'Clear roadmap for ongoing security maturity and improvement',
        ],
    ];

    $faqs = [
        [
            'q' => '1. What threats does IBN Tech’s SIEM detect? What Microsoft security services do you manage (Defender, Sentinel, Entra, Purview, Intune)?',
            'a' => 'We monitor cloud environments (Azure, AWS or GCP), in hybrid and on-premise environments. Our MDR service ensures you have a protected surface area on endpoints, SaaS applications and cloud workloads for all leading platforms.',
        ],
        [
            'q' => '2. Can you help us with a compromise assessment service or migrate to cloud-native Microsoft security?',
            'a' => 'Our SOC team will respond to critical incidents within 15 minutes and 60 minutes for high priority threats. We keep all our 24/7/365 monitoring, detection and response as well as escalation workflows in multiple tiers.',
        ],
        [
            'q' => '3. How do you support compliance with GDPR, HIPAA, or RBI?',
            'a' => 'We are aligned with data residency requirements and regulations of the US, UK, and India—including HIPAA, GDPR, PCI-DSS, and ISO 27001. In a hybrid environment, we can build out our SOC in many different ways to cover compliance.',
        ],
        [
            'q' => '4. Will your service work with our existing IT/security tools?',
            'a' => 'Yes, we integrate with security tools more than 200 such as – Microsoft Defender, CrowdStrike, SentinelOne, Fortinet, and many more. We also support custom integrations and APIs within our platform.',
        ],
        [
            'q' => '5. How quickly can you respond to ransomware or business email compromise?',
            'a' => 'Our unique attributes include locally led expertise in US, UK, and India, human-led approach, and reasonable or competitive fee structure. We provide enterprise-grade protection at SMB pricing with customizable SLAs.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    {{-- Home component styles are required for the reused client-logos marquee. --}}
    @vite(['resources/css/pages/home.css', 'resources/css/pages/managed-detection-response-services.css'])
@endpush

@section('content')
    <div class="mdr-page">
        {{-- Hero --}}
        <section class="mdr-hero" aria-labelledby="mdr-hero-title">
            <div class="site-shell mdr-hero__inner">
                <div class="mdr-hero__copy">
                    <p class="mdr-hero__badge">Proactive Cyber Defense</p>
                    <h1 id="mdr-hero-title">
                        Managed Detection and Response <span class="mdr-accent">(MDR)</span> Services
                    </h1>
                    <p class="mdr-hero__subtitle">
                        Real-Time Threat Detection, Human-Led Response - Securing US, UK, and Indian Organizations
                    </p>
                    <p class="mdr-hero__lede">
                        IBN Tech is your Always-Secure Global Security Partner, delivering 24/7 Managed Detection and Response (MDR) through next-generation SIEM, advanced Endpoint Detection &amp; Response (EDR) and real-time Threat Intelligence—all backed by our dedicated global Security Operations Center (SOC).
                    </p>
                    <ul class="mdr-hero__stats">
                        @foreach ($heroStats as $stat)
                            <li>
                                <span class="mdr-hero__stat-icon" aria-hidden="true">
                                    <i class="fa-solid {{ $stat['icon'] }}"></i>
                                </span>
                                <span>
                                    {{ $stat['line1'] }}<br>
                                    {{ $stat['line2'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#mdr-enquire" class="button-primary mdr-hero__cta">Request Free Consultation</a>
                </div>
                <figure class="mdr-hero__media">
                    <img
                        src="{{ $img('managed-detection-and-response-banner.png') }}"
                        alt="Managed Detection and Response services — 24/7 security operations monitoring"
                        width="438"
                        height="292"
                        fetchpriority="high"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="mdr-certs-section" aria-labelledby="mdr-certs-title">
            <div class="site-shell">
                <div class="mdr-certs-panel">
                    <h2 id="mdr-certs-title">Industry Certifications &amp; Strategic Partnerships</h2>
                    <p>Professional skills validated by top industry certifications and technological alliances</p>
                    <div class="mdr-certs">
                        @foreach ($certs as $cert)
                            <img
                                src="{{ $certImg($cert['file']) }}"
                                alt="{{ $cert['alt'] }}"
                                width="140"
                                height="80"
                                loading="lazy"
                                decoding="async"
                            >
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <x-home.client-logos />

        {{-- Navy CTA --}}
        <section class="mdr-cta mdr-cta--navy" aria-labelledby="mdr-cta1-title">
            <div class="site-shell mdr-cta__inner">
                <h2 id="mdr-cta1-title">Don't Wait Until It's Too Late</h2>
                <p>The average dwell time for threats is 277 days. Our MDR services can reduce this to minutes, dramatically limiting the impact of security incidents.</p>
                <a href="#mdr-enquire" class="button-primary">Book a 30 Min Free Demo</a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="mdr-section" aria-labelledby="mdr-why-title">
            <div class="site-shell">
                <div class="mdr-heading">
                    <h2 id="mdr-why-title">Why Choose IBN Tech for Managed Detection and Response?</h2>
                    <p>
                        IBN Tech's Managed Detection and Response services offer proactive cybersecurity that combines advanced threat detection technology and human-led response. Our MDR security is intended to defend your digital infrastructure whether on-premises, cloud, or hybrid from growing cyber threats.
                    </p>
                </div>
                <div class="mdr-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="mdr-why-card" role="listitem">
                            <span class="mdr-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Integrated tools --}}
        <section class="mdr-section mdr-section--cream" aria-labelledby="mdr-tools-title">
            <div class="site-shell">
                <div class="mdr-heading">
                    <h2 id="mdr-tools-title">Integrated Security Tools</h2>
                </div>
                <div class="mdr-tools-grid" role="list">
                    @foreach ($tools as $tool)
                        <article class="mdr-tools-card" role="listitem">
                            <img
                                src="{{ $img($tool['file']) }}"
                                alt="{{ $tool['alt'] }}"
                                width="258"
                                height="92"
                                loading="lazy"
                                decoding="async"
                            >
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Comprehensive solutions --}}
        <section class="mdr-section mdr-section--soft" aria-labelledby="mdr-solutions-title">
            <div class="site-shell">
                <div class="mdr-heading">
                    <h2 id="mdr-solutions-title">Comprehensive MDR Solutions</h2>
                </div>
                <div class="mdr-solutions" role="list">
                    @foreach ($solutions as $solution)
                        <article class="mdr-solution mdr-solution--{{ $solution['theme'] }}{{ !empty($solution['wide']) ? ' mdr-solution--wide' : '' }}" role="listitem">
                            <div class="mdr-solution__head">
                                <span class="mdr-solution__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $solution['icon'] }}"></i>
                                </span>
                                <h3>{{ $solution['title'] }}</h3>
                            </div>
                            <div class="mdr-solution__body">
                                @foreach ($solution['items'] as $item)
                                    <div class="mdr-solution__item">
                                        <p class="mdr-solution__label">{{ $item['label'] }}</p>
                                        <p>{{ $item['text'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Core features --}}
        <section class="mdr-features" aria-labelledby="mdr-features-title">
            <div class="site-shell">
                <div class="mdr-heading mdr-heading--light">
                    <h2 id="mdr-features-title">Core Features of IBN Tech's MDR Services</h2>
                    <p>Comprehensive MDR security capabilities powered by advanced technology and human expertise.</p>
                </div>
                <div class="mdr-features-grid" role="list">
                    @foreach ($features as $feature)
                        <article class="mdr-feature" role="listitem">
                            <span class="mdr-feature__icon" aria-hidden="true">
                                <i class="fa-solid {{ $feature['icon'] }}"></i>
                            </span>
                            <h3>{{ $feature['title'] }}</h3>
                            <p>{{ $feature['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Yellow CTA --}}
        <section class="mdr-cta mdr-cta--cream" aria-labelledby="mdr-cta2-title">
            <div class="site-shell mdr-cta__inner">
                <h2 id="mdr-cta2-title">Strengthen Your Security Posture Today</h2>
                <p>Discover how our MDR services can help protect your organization from evolving cyber threats with 24/7 expert monitoring and response.</p>
                <a href="#mdr-enquire" class="button-primary">Schedule a Free Consultation</a>
            </div>
        </section>

        {{-- Deliverables --}}
        <section class="mdr-section" aria-labelledby="mdr-deliver-title">
            <div class="site-shell">
                <div class="mdr-heading">
                    <h2 id="mdr-deliver-title">Deliverables &amp; Client Benefits</h2>
                </div>
                <div class="mdr-deliver-grid" role="list">
                    @foreach ($deliverables as $item)
                        <article class="mdr-deliver-card" role="listitem">
                            <span class="mdr-deliver-card__icon mdr-deliver-card__icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + form --}}
        <section class="mdr-section mdr-section--faq" aria-labelledby="mdr-faq-title">
            <div class="site-shell mdr-faq-layout">
                <div>
                    <h2 id="mdr-faq-title">Frequently Asked Questions</h2>
                    <div class="mdr-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="mdr-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <span class="mdr-faq__toggle" aria-hidden="true">
                                        <i class="fa-solid fa-plus"></i>
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                </summary>
                                <div class="mdr-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="mdr-form" id="mdr-enquire" aria-labelledby="mdr-form-title">
                    <div class="mdr-form__head">
                        <h2 id="mdr-form-title">24/7 Threat Protection – Expert Help at the Ready</h2>
                        <p>Detect, investigate, and stop cyber threats before they disrupt your business- customized to your needs.</p>
                    </div>
                    <div class="mdr-form__body">
                        <livewire:forms.contact-form
                            form-name="managed-detection-response-services"
                            id-prefix="mdr"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="Message"
                            submit-label="SEND YOUR MESSAGE"
                            layout="modal"
                            :message-rows="3"
                            thank-you-url="/thanks-you-for-cybersecurity/"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
