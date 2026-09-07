@php
    $img = fn (string $file): string => asset('images/microsoft-security-services/'.$file);
    $certImg = fn (string $file): string => asset('images/Certificates/'.$file);
    $partnerImg = fn (string $file): string => asset('images/certified-security-experts/'.$file);
    $clientImg = fn (string $file): string => asset('images/clients-logo/'.$file);

    $certificates = [
        'ms-azure-solutions-architech.webp',
        'ms-cybersecurity-architech.webp',
        'ms-enterprise-administrator.webp',
        'ms-identity-and-access-administrator.webp',
        'ms-azure-security-engineer.webp',
        'ms-security-operations-analyst.webp',
        'ms-azure-virtual-desktop.webp',
        'ms-azure-database-administrator.webp',
        'ms-azure-data-scientist.webp',
        'ms-azure-administrator.webp',
    ];

    $partnerBadges = [
        'ms-data-and-ai-azure.webp',
        'ms-digital-and-app-innovation-azure.webp',
        'ms-infrastructure-azure.webp',
        'ms-security.webp',
        'ms-modern-work.webp',
    ];

    $clientLogos = [
        'Ephlux.webp', 'abitach.webp', 'Atlantic-data.webp', 'Azuga.webp', 'Cloud-Rewind.webp',
        'Demand-media.webp', 'Digital-Zone.webp', 'Docully.webp', 'DOD-Technologies.webp', 'EM6-Worldwide.webp',
        'instem.webp', 'Lattice.webp', 'Maximeyes.webp', 'MTX.webp', 'Tradesun.webp',
        'Wassha.webp', 'Aurionpro.webp', 'British-Orient.webp', 'Chemito.webp', 'Contata.webp',
        'Isckon.webp', 'Lenden.webp', 'Mapmyindia.webp', 'Routematic.webp', 'Wint.webp',
        'LT.webp', 'bike-bazaar.webp', 'askmia.webp', 'vsoftcorp.webp', 'orowealth.webp',
    ];

    $riskCards = [
        [
            'icon' => 'fa-triangle-exclamation',
            'title' => 'Misconfigured Security',
            'text' => '95% of cloud breaches stem from misconfigurations',
        ],
        [
            'icon' => 'fa-eye-slash',
            'title' => 'Blind Spots',
            'text' => 'Lack of 24/7 monitoring leaves threats undetected',
        ],
        [
            'icon' => 'fa-file-lines',
            'title' => 'Compliance Gaps',
            'text' => 'Regulatory violations can result in hefty fines',
        ],
    ];

    $hardTruth = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Default Settings Aren\'t Enough',
            'text' => 'Out-of-the-box Microsoft security requires expert configuration',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Threats Evolve Daily',
            'text' => 'Your security posture needs continuous monitoring and updates',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Human Error is Inevitable',
            'text' => 'Without proper training and controls, mistakes happen',
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-award',
            'title' => 'Microsoft Security Partner Across Key Domains',
            'text' => 'Recognized as a Microsoft Solution Partner for Security, Azure, Modern Workplace, Digital Innovation, and Data & AI, we deliver customized proficiency to each collaboration.',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'Global Delivery with Local Expertise',
            'text' => 'Headquartered in India, our 24/7 security operations span across US and UK time zones, ensuring continuous protection and support wherever your business operates.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Reduced Risk & Enhanced Resilience',
            'text' => 'Our services are designed to minimize operational risk, mitigate insider threats, and reduce the impact of ransomware and advanced attacks.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Maximized ROI from Microsoft Investments',
            'text' => 'We help you optimize licensing, reduce tool sprawl, and fully leverage your Microsoft 365 and Azure security stack for better performance and cost-efficiency.',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Enable IT Teams to Focus on Innovation',
            'text' => 'By outsourcing security operations to IBN Tech, your internal teams can shift focus from reactive tasks to strategic business initiatives.',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Scalable Support for Enterprises of All Sizes',
            'text' => 'Whether you\'re a multinational or a mid-sized enterprise, our services are tailored to meet local, regional, and global security requirements.',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Flexible Engagement Models',
            'text' => 'Choose between full-stack MSSP services or Microsoft-specific security outsourcing, depending on your needs and maturity level.',
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Integrated Security Ecosystem',
            'text' => 'Our offerings seamlessly integrate with vCISO, MDR, VAPT, and GRC services, providing a unified approach to cybersecurity and compliance.',
        ],
        [
            'icon' => 'fa-circle-check',
            'title' => 'Certified Security Experts',
            'text' => 'Our team includes engineers certified in SC-200, SC-300, AZ-500, and MS-500, ensuring your environment is managed by professionals with proven Microsoft security expertise.',
        ],
    ];

    $management = [
        [
            'icon' => 'fa-shield-halved',
            'title' => '24/7 Threat Detection & Response',
            'text' => 'Centralized monitoring via Microsoft Sentinel SIEM and Defender XDR, managed by certified security analysts',
            'items' => ['Real-time threat hunting', 'Automated incident response', 'Custom KQL queries'],
        ],
        [
            'icon' => 'fa-id-card',
            'title' => 'Identity & Access Management',
            'text' => 'Implement and manage Entra ID, Multi-factor authentication, least privilege, and automated identity governance',
            'items' => ['Conditional Access policies', 'Identity lifecycle management', 'Privileged access management'],
        ],
        [
            'icon' => 'fa-cloud',
            'title' => 'Cloud & Data Protection',
            'text' => 'Secure Microsoft 365, Azure, SharePoint, OneDrive, and Teams with Microsoft Purview for data identification, classification, and DLP',
            'items' => ['Data classification', 'Insider risk management', 'eDiscovery & compliance'],
        ],
        [
            'icon' => 'fa-brain',
            'title' => 'AI-Driven Threat Intelligence',
            'text' => 'Advanced analytics for known and unknown cyber threats with automated response capabilities',
            'items' => ['Behavioral analytics', 'Zero-day protection', 'Threat intelligence feeds'],
        ],
        [
            'icon' => 'fa-file-shield',
            'title' => 'Compliance-First Posture',
            'text' => 'Pre-built reporting and controls for PCI DSS, HIPAA, SOX, GDPR, ISO 27001, CERT-In, RBI, SEBI',
            'items' => ['Automated compliance reporting', 'Audit-ready documentation', 'Risk assessment tools'],
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Security Score Optimization',
            'text' => 'Continuous improvement of Microsoft 365 security posture with monthly reports and advisory',
            'items' => ['Secure Score monitoring', 'Security baseline implementation', 'Continuous optimization'],
        ],
    ];

    $specialized = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Microsoft Defender XDR Services',
            'text' => 'Secure your endpoints, identities, emails, and cloud apps with Microsoft Defender\'s extended detection and response capabilities:',
            'items' => [
                'Defender for Endpoint, Identity, Office 365, Cloud Apps, and Business',
                'Automated threat response, endpoint isolation, and device compliance enforcement',
            ],
        ],
        [
            'icon' => 'fa-magnifying-glass',
            'title' => 'Microsoft Sentinel SIEM + SOAR Management',
            'text' => 'Advance centralized visibility and automated incident response with our managed SIEM and SOAR services:',
            'items' => [
                'Sentinel deployment, alert tuning, and rule configuration',
                'Threat hunting using KQL queries',
                'Custom playbooks and automation',
                '24/7 SOC monitoring powered by IBN MDR',
            ],
        ],
        [
            'icon' => 'fa-file-shield',
            'title' => 'Microsoft Purview Data Protection & Compliance',
            'text' => 'Maintain data governance and regulatory compliance with Microsoft Purview:',
            'items' => [
                'Data Loss Prevention (DLP), eDiscovery, and Information Protection',
                'Insider risk management and data classification',
                'Compliance Manager setup for HIPAA, GDPR, ISO 27001, and more',
            ],
        ],
        [
            'icon' => 'fa-key',
            'title' => 'Microsoft Entra (Identity & Access Management)',
            'text' => 'Secure identity lifecycle and access controls across your organization:',
            'items' => [
                'Azure AD / Entra ID hardening',
                'Conditional Access and Multi-Factor Authentication (MFA)',
                'Identity governance and automated provisioning',
            ],
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Microsoft Secure Score Optimization',
            'text' => 'Continuously improve your Microsoft 365 security posture:',
            'items' => [
                'Monthly Secure Score reviews and advisory',
                'Actionable insights to reduce risk and enhance compliance',
            ],
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Security Baseline Implementation',
            'text' => 'Establish foundational security controls across your Microsoft environment:',
            'items' => [
                'Azure Security Center and Microsoft Security Center configuration',
                'Baseline policies for Exchange, Teams, and SharePoint',
            ],
        ],
        [
            'icon' => 'fa-graduation-cap',
            'title' => 'Security Awareness & Adoption',
            'text' => 'Empower your workforce to be the first line of defense:',
            'items' => [
                'Phishing simulations using Microsoft tools',
                'End-user training for secure collaboration and data handling',
            ],
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Microsoft 365 Security Hardening',
            'text' => 'Strengthen your Microsoft 365 environment against advanced threats:',
            'items' => [
                'Defender for Office 365 configuration',
                'Threat policies, encrypted communications, and anti-phishing/malware defenses',
            ],
        ],
    ];

    $faqs = [
        [
            'q' => '1. What Microsoft security products do you manage (Defender, Sentinel, Entra, Purview, Intune)?',
            'a' => 'We manage a complete suite of Microsoft security products, including Microsoft Defender XDR, Sentinel, Entra, Purview, and Intune. Our incorporated approach confirms seamless protection across endpoints, identities, data, and cloud workloads.',
        ],
        [
            'q' => '2. Can you help us migrate to cloud-native Microsoft security?',
            'a' => 'Yes. Our professionals specialize in transitioning businesses to cloud-native Microsoft security solutions. We ensure a smooth migration process with optimal configuration, helping you enhance visibility, reduce risk, and improve your overall security posture.',
        ],
        [
            'q' => '3. How do you support compliance with GDPR, HIPAA, or RBI?',
            'a' => 'Absolutely. Using Microsoft Purview, we establish data governance policies and create compliance reports that are ready for audits. Our services are designed to meet a wide range of regulations whether global like GDPR and HIPAA or regional such as RBI and SEBI and more.',
        ],
        [
            'q' => '4. Will your service work with our existing IT/security tools?',
            'a' => 'Yes. Our cybersecurity managed services are considered for compatibility and integration. We work alongside your existing IT and security infrastructure to create a solid, effective, and non-disruptive security environment.',
        ],
        [
            'q' => '5. How quickly can you respond to ransomware or business email compromise?',
            'a' => 'Our Security Operations Center (SOC) and incident response team are on call 24/7 to tackle serious threats like ransomware and business email compromise. We focus on quick containment and recovery to keep any disruption to your business as minimal as possible.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/microsoft-security-services.css'])
@endpush

@section('content')
    <div class="mssec-page">
        {{-- Hero --}}
        <section class="mssec-hero" aria-labelledby="mssec-hero-title">
            <div class="site-shell mssec-hero__inner">
                <div class="mssec-hero__copy">
                    <h1 id="mssec-hero-title">
                        IBN Technologies Managed <span class="mssec-accent">Microsoft Security Services</span>
                    </h1>
                    <p class="mssec-hero__kicker">Protect Your Microsoft Cloud &amp; Hybrid Environments 24/7</p>
                    <p class="mssec-hero__lede">
                        From configuration to compliance, our solutions ensure your Microsoft 365 environment is secure, efficient, and future-ready.
                    </p>
                    <a href="#mssec-consult" class="mssec-btn mssec-btn--light">Request Free Consultation</a>
                </div>
                <figure class="mssec-hero__media">
                    <img
                        src="{{ $img('Managed-Microsoft-Security-Services.png') }}"
                        alt="Managed Microsoft Security Services"
                        width="272"
                        height="147"
                        fetchpriority="high"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Certified Excellence --}}
        <section class="mssec-section mssec-section--tight" aria-labelledby="mssec-certs-title">
            <div class="site-shell">
                <div class="mssec-heading">
                    <h2 id="mssec-certs-title">Certified Excellence: Microsoft Security Credentials That Power Trust</h2>
                </div>

                <div
                    class="mssec-certs"
                    x-data="{
                        index: 0,
                        perPage: 5,
                        total: {{ count($certificates) }},
                        get pages() { return Math.max(1, Math.ceil(this.total / this.perPage)); },
                        prev() { this.index = (this.index - 1 + this.pages) % this.pages; },
                        next() { this.index = (this.index + 1) % this.pages; },
                        setPage() {
                            this.perPage = window.innerWidth <= 640 ? 2 : (window.innerWidth <= 900 ? 3 : 5);
                            this.index = Math.min(this.index, this.pages - 1);
                        }
                    }"
                    x-init="setPage(); window.addEventListener('resize', () => setPage())"
                >
                    <button type="button" class="mssec-certs__nav" @click="prev()" aria-label="Previous certifications">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="mssec-certs__viewport">
                        <div
                            class="mssec-certs__track"
                            role="list"
                            :style="`--mssec-per-page: ${perPage}; transform: translateX(-${index * 100}%)`"
                        >
                            @foreach ($certificates as $certificate)
                                <div class="mssec-certs__item" role="listitem">
                                    <img
                                        src="{{ $certImg($certificate) }}"
                                        alt="{{ pathinfo($certificate, PATHINFO_FILENAME) }} certification"
                                        width="110"
                                        height="110"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="mssec-certs__nav" @click="next()" aria-label="Next certifications">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="mssec-certs__dots" role="tablist" aria-label="Certification slides">
                        <template x-for="page in pages" :key="page">
                            <button
                                type="button"
                                class="mssec-certs__dot"
                                :class="{ 'is-active': index === page - 1 }"
                                :aria-current="index === page - 1 ? 'true' : 'false'"
                                :aria-label="'Show certifications page ' + page"
                                @click="index = page - 1"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- Certified Security Experts --}}
        <section class="mssec-section mssec-section--tight mssec-partners" aria-labelledby="mssec-partners-title">
            <div class="site-shell">
                <div class="mssec-divider-label">
                    <span id="mssec-partners-title">Certified Security Experts</span>
                </div>
                <div class="mssec-partner-grid" role="list">
                    @foreach ($partnerBadges as $badge)
                        <article class="mssec-partner-card" role="listitem">
                            <img
                                src="{{ $partnerImg($badge) }}"
                                alt="{{ pathinfo($badge, PATHINFO_FILENAME) }} Microsoft Solutions Partner badge"
                                width="180"
                                height="110"
                                loading="lazy"
                                decoding="async"
                            >
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Our Clients --}}
        <section class="mssec-clients" aria-label="Our clients">
            <div class="site-shell">
                <div class="mssec-divider-label mssec-divider-label--green">
                    <span>Our Clients</span>
                </div>
            </div>
            <div class="mssec-marquee">
                <div class="mssec-marquee__track">
                    @foreach ([...$clientLogos, ...$clientLogos] as $logo)
                        <div class="mssec-logo-chip">
                            <img
                                src="{{ $clientImg($logo) }}"
                                alt="{{ pathinfo($logo, PATHINFO_FILENAME) }} client logo"
                                width="140"
                                height="62"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Power Millions / Risk --}}
        <section class="mssec-section mssec-section--lavender" aria-labelledby="mssec-risk-title">
            <div class="site-shell">
                <div class="mssec-heading">
                    <h2 id="mssec-risk-title">
                        Microsoft 365 and Azure Power Millions-<br>
                        <span class="mssec-accent">But Are you Truly Protected?</span>
                    </h2>
                    <p>
                        Without proper configuration and continuous monitoring, your Microsoft environment remains vulnerable to breaches, compliance violations, and operational interruptions that can cost millions.
                    </p>
                </div>

                <div class="mssec-risk-grid" role="list">
                    @foreach ($riskCards as $card)
                        <article class="mssec-risk-card" role="listitem">
                            <div class="mssec-icon mssec-icon--navy" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="mssec-overview">
                    <div class="mssec-overview__copy">
                        <h3>Overview</h3>
                        <p>
                            Organizations need an end-to-end, data-driven security strategy, given the rapid emergence of advanced technology and increasingly aggressive cyber threats. A modern security program provides deep visibility into incidents, contextual insights, as well as the ability to make rapid, informed decisions.
                        </p>
                        <p>
                            IBN Tech and Microsoft have developed a strong strategic partnership to deliver capabilities that are complementary in nature to serve clients with tailored capabilities, industry solutions, and scalable services to help them maintain secure and compliant organizations. Our offering spans advisory, managed cybersecurity solutions, and technologies. This includes Vulnerability Management, Managed Data Security, and Endpoint Protection using the entire Microsoft portfolio to help clients develop resilient, compliant and future-ready environments.
                        </p>
                    </div>
                    <div class="mssec-overview__aside">
                        <h3>The Hard Truth About Microsoft Security</h3>
                        <ul>
                            @foreach ($hardTruth as $item)
                                <li>
                                    <span class="mssec-icon mssec-icon--green" aria-hidden="true">
                                        <i class="fa-solid {{ $item['icon'] }}"></i>
                                    </span>
                                    <div>
                                        <strong>{{ $item['title'] }}</strong>
                                        <p>{{ $item['text'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Green CTA --}}
        <section class="mssec-cta mssec-cta--green" aria-labelledby="mssec-cta1-title">
            <div class="site-shell mssec-cta__inner">
                <h2 id="mssec-cta1-title">Ready to strengthen your Microsoft security posture?</h2>
                <p>Our team of certified experts is ready to help you maximize the security of your Microsoft environment.</p>
                <a href="#mssec-consult" class="mssec-btn mssec-btn--navy">Schedule Your Security Assessment</a>
            </div>
        </section>

        {{-- Why Choose --}}
        <section class="mssec-why" aria-labelledby="mssec-why-title">
            <div class="site-shell">
                <div class="mssec-heading mssec-heading--light">
                    <h2 id="mssec-why-title">Why Choose IBN Tech for Managed <span class="mssec-accent">Cybersecurity Services</span></h2>
                    <p>
                        At IBN Tech, we combine deep technical expertise with global delivery capabilities to help organizations secure their Microsoft environments with confidence and efficiency.
                    </p>
                </div>
                <div class="mssec-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="mssec-why-card" role="listitem">
                            <div class="mssec-icon mssec-icon--green" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Comprehensive Management --}}
        <section class="mssec-section mssec-section--yellow" aria-labelledby="mssec-manage-title">
            <div class="site-shell">
                <div class="mssec-heading">
                    <h2 id="mssec-manage-title">Comprehensive Microsoft Security Management</h2>
                    <p>End to end protection using Microsoft Defender, Sentinel, Entra, Purview, and the complete Microsoft Security suite</p>
                </div>
                <div class="mssec-manage-grid" role="list">
                    @foreach ($management as $card)
                        <article class="mssec-manage-card" role="listitem">
                            <div class="mssec-icon mssec-icon--navy" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                            <ul>
                                @foreach ($card['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Navy CTA --}}
        <section class="mssec-cta mssec-cta--navy" aria-labelledby="mssec-cta2-title">
            <div class="site-shell mssec-cta__inner">
                <h2 id="mssec-cta2-title">Get Started with Your Microsoft Cloud Security Environment</h2>
                <p>Speak with our skilled consultants to learn how we can help secure your Microsoft cloud environment.</p>
                <a href="#mssec-consult" class="mssec-btn mssec-btn--green">Schedule a Free Consultation</a>
            </div>
        </section>

        {{-- Specialized Services --}}
        <section class="mssec-section" aria-labelledby="mssec-special-title">
            <div class="site-shell">
                <div class="mssec-heading">
                    <h2 id="mssec-special-title">Specialized Microsoft Security Services We Offer</h2>
                    <p>
                        At IBN Tech, we deliver personalized Microsoft security services that align with your business needs, compliance requirements, and cloud maturity. Our sub-services span across the Microsoft Security ecosystem, ensuring full-stack protection and operational flexibility.
                    </p>
                </div>
                <div class="mssec-special-grid" role="list">
                    @foreach ($specialized as $card)
                        <article class="mssec-special-card" role="listitem">
                            <div class="mssec-special-card__head">
                                <div class="mssec-icon mssec-icon--green" aria-hidden="true">
                                    <i class="fa-solid {{ $card['icon'] }}"></i>
                                </div>
                                <h3>{{ $card['title'] }}</h3>
                            </div>
                            <p>{{ $card['text'] }}</p>
                            <ul>
                                @foreach ($card['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + Contact --}}
        <section class="mssec-section mssec-section--soft" id="mssec-consult" aria-labelledby="mssec-faq-title">
            <div class="site-shell mssec-consult">
                <div class="mssec-consult__faq">
                    <h2 id="mssec-faq-title">Frequently Asked Questions</h2>
                    <div class="mssec-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="mssec-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="mssec-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="mssec-consult__card" id="mssec-consult-form" aria-labelledby="mssec-consult-form-title">
                    <div class="mssec-consult__card-head">
                        <h3 id="mssec-consult-form-title">Microsoft Security Services – Protect Your Cloud &amp; Data</h3>
                        <p>Safeguard Microsoft 365, Azure, and your data with expert security solutions tailored to your business.</p>
                    </div>
                    <div class="mssec-consult__card-body">
                        <livewire:forms.contact-form
                            form-name="microsoft-security-services"
                            id-prefix="mssec"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="Message"
                            submit-label="Book a Consultation"
                            layout="default"
                            thank-you-url="/thanks-you-for-cybersecurity/"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
