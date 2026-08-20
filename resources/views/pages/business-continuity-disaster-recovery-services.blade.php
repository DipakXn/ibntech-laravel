@php
    $img = fn (string $file): string => asset('images/business-continuity-disaster-recovery-services/'.$file);
    $certImg = fn (string $file): string => asset('images/Certificates/'.$file);
    $clientImg = fn (string $file): string => asset('images/clients-logo/'.$file);

    $heroChecks = [
        'Business-aligned RTO/RPO guarantees',
        'Continuous backup & secure, immutable storage',
        '24/7 monitoring with ransomware protection & recovery drills',
        'Data residency choices: US, UK, India',
    ];

    $heroIcons = [
        ['icon' => 'fa-cloud', 'label' => 'Cloud'],
        ['icon' => 'fa-server', 'label' => 'Servers'],
        ['icon' => 'fa-lock', 'label' => 'Security'],
        ['icon' => 'fa-rotate', 'label' => 'Recovery'],
    ];

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

    $clientLogos = [
        'vsoftcorp.webp', 'askmia.webp', 'orowealth.webp', 'Ephlux.webp', 'abitach.webp',
        'Atlantic-data.webp', 'Azuga.webp', 'Cloud-Rewind.webp', 'Demand-media.webp', 'Digital-Zone.webp',
        'Docully.webp', 'DOD-Technologies.webp', 'EM6-Worldwide.webp', 'instem.webp', 'Lattice.webp',
        'Maximeyes.webp', 'MTX.webp', 'Tradesun.webp', 'Wassha.webp', 'Aurionpro.webp',
        'British-Orient.webp', 'Chemito.webp', 'Contata.webp', 'Isckon.webp', 'Lenden.webp',
        'Mapmyindia.webp', 'Routematic.webp', 'Wint.webp', 'LT.webp', 'bike-bazaar.webp',
    ];

    $draasFeatures = [
        ['icon' => 'fa-server', 'text' => 'Full-server backup with immutable storage'],
        ['icon' => 'fa-clock', 'text' => 'Real-time replication & automated failover'],
        ['icon' => 'fa-award', 'text' => 'Cyber Essentials & ISO-backed compliance'],
    ];

    $whyCards = [
        [
            'icon' => 'fa-shield-virus',
            'title' => 'MSSP DNA: Prevention + Detection + Recovery',
            'text' => 'Unlike traditional DR providers, our security-first approach integrates disaster recovery with threat detection. We connect DR runbooks with SIEM/SOAR alerts, so failover is triggered with context, not chaos. This means faster, more intelligent recovery when security incidents occur.',
        ],
        [
            'icon' => 'fa-cloud-arrow-up',
            'title' => 'Cloud-Native Architectures',
            'text' => 'We leverage Azure Site Recovery, AWS Elastic Disaster Recovery & cross-region backup, plus Acronis for endpoint/server backup and immutable storage. Our cloud-native approach ensures scalability, flexibility, and cost-efficiency for businesses of all sizes.',
        ],
        [
            'icon' => 'fa-scale-balanced',
            'title' => 'Compliance-Mapped Controls',
            'text' => 'Our BCDR solutions map controls ISO 27001, SOC 2, GDPR, HIPAA and RBI/IRDAI expectations. We understand the regulatory landscape across the US, UK, and India, ensuring your disaster recovery strategy meets all compliance requirements.',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'Global but Local',
            'text' => 'Our architectures and support are tuned for US, UK, and India requirements, addressing data residency, latency, and SLA expectations specific to each region. We provide local expertise with global best practices.',
        ],
    ];

    $includedServices = [
        [
            'icon' => 'fa-chart-line',
            'title' => 'Business Impact Analysis (BIA) & Risk',
            'items' => [
                'Identify critical processes, apps, and dependencies',
                'Set RTO/RPO per workload based on business priorities',
                'Prioritize failover tiers (Tier-0 to Tier-3)',
            ],
        ],
        [
            'icon' => 'fa-file-shield',
            'title' => 'Backup & Immutable Storage',
            'items' => [
                'Cloud snapshots + long-term retention policies',
                'Acronis-powered endpoint/server backup with ransomware protection',
                '3-2-1-1 strategy (including air-gapped/immutable copy)',
            ],
        ],
        [
            'icon' => 'fa-right-left',
            'title' => 'DRaaS & Orchestrated Failover',
            'items' => [
                'Azure Site Recovery / AWS Elastic DR runbooks',
                'Cross-region, cross-cloud options for geographic redundancy',
                'Push-button app-level or site-level failover/failback',
            ],
        ],
        [
            'icon' => 'fa-user-shield',
            'title' => 'Security-Integrated Recovery (MSSP)',
            'items' => [
                'SIEM alerts (e.g., mass encryption) auto-open DR runbook tasks',
                'Forensic hold & clean-room recovery options',
                'MDR integration during the incident window',
            ],
        ],
        [
            'icon' => 'fa-clipboard-list',
            'title' => 'Testing, Evidence & Reporting',
            'items' => [
                'Quarterly or semi-annual DR tests',
                'Evidence packs for audits (screens, timelines, test logs)',
                'Post-test improvements & readiness score',
            ],
        ],
    ];

    $architectures = [
        [
            'logo' => 'Microsoft-Azure-1.webp',
            'alt' => 'Microsoft Azure',
            'title' => 'Microsoft Azure',
            'items' => [
                'Azure Site Recovery',
                'Azure Backup',
                'Cross-Zone/Region designs',
            ],
        ],
        [
            'logo' => 'AWS.webp',
            'alt' => 'AWS',
            'title' => 'AWS',
            'items' => [
                'AWS Elastic Disaster Recovery',
                'AWS Backup',
                'S3 Object Lock (immutability)',
            ],
        ],
        [
            'logo' => 'Acronis.webp',
            'alt' => 'Acronis',
            'title' => 'Acronis',
            'items' => [
                'Unified BCDR for servers',
                'Endpoint protection',
                'M365/Google Workspace backup',
                'Anti-ransomware technology',
            ],
        ],
    ];

    $platforms = [
        ['file' => 'Azure-ARC.webp', 'alt' => 'Azure ARC'],
        ['file' => 'spot.webp', 'alt' => 'Spot'],
        ['file' => 'NUTANIX.webp', 'alt' => 'Nutanix'],
    ];

    $slaRows = [
        ['metric' => 'RTO', 'gold' => 'Minutes', 'silver' => '< 1 Hour', 'bronze' => 'Few Hours'],
        ['metric' => 'RPO', 'gold' => 'Near-zero (CDP)', 'silver' => '1–2 Hours', 'bronze' => '4+ Hours'],
        ['metric' => 'Availability', 'gold' => '99.9%+', 'silver' => '99.5%+', 'bronze' => '99%+'],
        ['metric' => 'Testing Cadence', 'gold' => 'Quarterly', 'silver' => 'Semi-annual', 'bronze' => 'Annual'],
    ];

    $faqs = [
        [
            'q' => '1. How do you handle ransomware?',
            'a' => 'We use immutable backups, malware scans during restore, and clean recovery paths with MDR support.',
        ],
        [
            'q' => '2. Can you meet data residency?',
            'a' => 'Yes, we support US, UK, and India regions, tailored to your compliance needs.',
        ],
        [
            'q' => '3. How fast can we recover?',
            'a' => 'Recovery times are set by workload. Critical apps can recover in minutes using CDP and automated runbooks.',
        ],
        [
            'q' => '4. Do you integrate with our SIEM/MDR?',
            'a' => 'Absolutely, our BCDR runbooks can be triggered by events from your SIEM or MDR systems.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/business-continuity-disaster-recovery-services.css'])
@endpush

@section('content')
    <div class="bcdr-page">
        {{-- Hero --}}
        <section class="bcdr-hero" aria-labelledby="bcdr-hero-title">
            <div class="site-shell bcdr-hero__inner">
                <div class="bcdr-hero__copy">
                    <h1 id="bcdr-hero-title">
                        Business Continuity and <span class="bcdr-accent">Disaster Recovery Services</span>
                    </h1>
                    <p class="bcdr-hero__lede">
                        Disaster Recovery Consulting services help you recover critical apps, servers, and data with expert-led DRaaS solutions. We identify risks that could impact operations, reputation, or finances. Our strategies ensure faster recovery and stronger business continuity.
                    </p>

                    <ul class="bcdr-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <span class="bcdr-hero__check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="bcdr-hero__actions">
                        <a href="#bcdr-consult" class="bcdr-btn bcdr-btn--white">
                            Get a Free BCDR Assessment
                        </a>
                    </div>
                </div>

                <div class="bcdr-hero__media" aria-hidden="true">
                    <div class="bcdr-hero__icons">
                        @foreach ($heroIcons as $item)
                            <div class="bcdr-hero__icon-tile">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                                <span class="sr-only">{{ $item['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Certified Excellence --}}
        <section class="bcdr-section bcdr-section--tight" aria-labelledby="bcdr-certs-title">
            <div class="site-shell">
                <div class="bcdr-divider-label">
                    <span id="bcdr-certs-title">Certified Excellence</span>
                </div>

                <div class="bcdr-certs" role="list">
                    @foreach ($certificates as $certificate)
                        <div class="bcdr-certs__item" role="listitem">
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
        </section>

        {{-- Our Clients --}}
        <section class="bcdr-clients" aria-label="Our clients">
            <div class="site-shell">
                <div class="bcdr-divider-label bcdr-divider-label--green">
                    <span>Our Clients</span>
                </div>
            </div>
            <div class="bcdr-marquee" data-bcdr-marquee>
                <div class="bcdr-marquee__track">
                    @foreach ([...$clientLogos, ...$clientLogos] as $logo)
                        <div class="bcdr-logo-chip">
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

        {{-- DRaaS --}}
        <section class="bcdr-section bcdr-section--cream" aria-labelledby="bcdr-draas-title">
            <div class="site-shell bcdr-split">
                <div class="bcdr-split__copy">
                    <h2 id="bcdr-draas-title">Disaster Recovery as a Service (DRaaS)</h2>
                    <p>Protect your critical systems with fast, cloud-based recovery from cyberattacks, hardware failures, or natural disasters.</p>
                    <p>We back up entire servers not just files with real-time replication, automated failover, and secure storage. Fully managed and customized to your risk profile, backed by Cyber Essentials and ISO certifications for trusted compliance.</p>

                    <ul class="bcdr-feature-bars">
                        @foreach ($draasFeatures as $feature)
                            <li>
                                <span class="bcdr-feature-bars__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $feature['icon'] }}"></i>
                                </span>
                                <span>{{ $feature['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#bcdr-consult" class="bcdr-btn bcdr-btn--green">
                        Schedule Your Free Consultation
                    </a>
                </div>

                <figure class="bcdr-split__media">
                    <img
                        src="{{ $img('Data-recovery.png') }}"
                        alt="Cloud-based data recovery and backup"
                        width="452"
                        height="302"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Why IBN Tech --}}
        <section class="bcdr-section bcdr-section--soft" aria-labelledby="bcdr-why-title">
            <div class="site-shell">
                <div class="bcdr-heading">
                    <h2 id="bcdr-why-title">
                        Why IBN Tech for <span class="bcdr-accent">BCDR Excellence?</span>
                    </h2>
                    <p>
                        IBN Tech combines expert business continuity consulting with robust disaster recovery solutions to keep your operations secure, resilient, and always available.
                    </p>
                </div>

                <div class="bcdr-why-grid">
                    @foreach ($whyCards as $card)
                        <article class="bcdr-why-card">
                            <div class="bcdr-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="bcdr-proof-banner" role="note">
                    <span class="bcdr-proof-banner__icon" aria-hidden="true">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                    <p>
                        <strong>Proof, not Promises</strong>
                        — We don't just claim our BCDR solutions work, we prove it through scheduled recovery tests, detailed after-action reports, and auditable evidence that satisfies both technical teams and compliance auditors.
                    </p>
                </div>
            </div>
        </section>

        {{-- What's Included --}}
        <section class="bcdr-section bcdr-section--sage" aria-labelledby="bcdr-included-title">
            <div class="site-shell">
                <div class="bcdr-heading">
                    <h2 id="bcdr-included-title">What's Included in Our BCDR Services</h2>
                </div>

                <div class="bcdr-included-grid">
                    @foreach ($includedServices as $service)
                        <article class="bcdr-included-card">
                            <div class="bcdr-included-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $service['icon'] }}"></i>
                            </div>
                            <h3>{{ $service['title'] }}</h3>
                            <ul>
                                @foreach ($service['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="bcdr-cta-strip" aria-labelledby="bcdr-cta-title">
            <div class="site-shell bcdr-cta-strip__inner">
                <div class="bcdr-cta-strip__copy">
                    <h2 id="bcdr-cta-title">Protect your data with world-class cloud-based disaster recovery solutions</h2>
                    <p>Speak with our business continuity experts to discuss your organization's specific needs and how our services can help protect your critical operations.</p>
                </div>
                <a href="#bcdr-consult" class="bcdr-btn bcdr-btn--green">
                    Schedule Your Free Consultation
                </a>
            </div>
        </section>

        {{-- BCDR Architecture --}}
        <section class="bcdr-arch" aria-labelledby="bcdr-arch-title">
            <div class="site-shell">
                <div class="bcdr-heading bcdr-heading--light">
                    <h2 id="bcdr-arch-title">BCDR Architectures We Deliver</h2>
                </div>

                <div class="bcdr-arch-grid">
                    @foreach ($architectures as $arch)
                        <article class="bcdr-arch-card">
                            <div class="bcdr-arch-card__logo">
                                <img
                                    src="{{ $img($arch['logo']) }}"
                                    alt="{{ $arch['alt'] }}"
                                    width="150"
                                    height="62"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $arch['title'] }}</h3>
                            <ul>
                                @foreach ($arch['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>

                <div class="bcdr-arch-note" role="note">
                    <span class="bcdr-arch-note__icon" aria-hidden="true">
                        <i class="fa-solid fa-circle-info"></i>
                    </span>
                    <p>
                        We also design and implement hybrid BCDR solutions that span on-premises → cloud, cloud → cloud, and multi-cloud environments to meet your specific business requirements and compliance needs.
                    </p>
                </div>
            </div>
        </section>

        {{-- Cloud Platform Proficiency --}}
        <section class="bcdr-section" aria-labelledby="bcdr-platform-title">
            <div class="site-shell">
                <div class="bcdr-heading">
                    <h2 id="bcdr-platform-title">Cloud Platform Proficiency</h2>
                </div>

                <div class="bcdr-platform-grid">
                    @foreach ($platforms as $platform)
                        <article class="bcdr-platform-card">
                            <img
                                src="{{ $img($platform['file']) }}"
                                alt="{{ $platform['alt'] }}"
                                width="211"
                                height="141"
                                loading="lazy"
                                decoding="async"
                            >
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- SLAs & Outcomes --}}
        <section class="bcdr-section bcdr-section--soft" aria-labelledby="bcdr-sla-title">
            <div class="site-shell">
                <div class="bcdr-heading">
                    <h2 id="bcdr-sla-title">SLAs &amp; Outcomes</h2>
                </div>

                <div class="bcdr-table-wrap">
                    <table class="bcdr-table">
                        <thead>
                            <tr>
                                <th scope="col">Metric</th>
                                <th scope="col">Gold</th>
                                <th scope="col">Silver</th>
                                <th scope="col">Bronze</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slaRows as $row)
                                <tr>
                                    <th scope="row">{{ $row['metric'] }}</th>
                                    <td>{{ $row['gold'] }}</td>
                                    <td>{{ $row['silver'] }}</td>
                                    <td>{{ $row['bronze'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bcdr-sla-note">
                    <span class="bcdr-sla-note__icon" aria-hidden="true">
                        <i class="fa-solid fa-gears"></i>
                    </span>
                    <div>
                        <h3>Custom SLAs Available</h3>
                        <p>
                            We understand that different workloads have different recovery requirements. Our team works with you to establish appropriate RTO and RPO targets for each application based on business impact analysis and compliance requirements.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ + Contact --}}
        <section class="bcdr-section bcdr-section--soft" id="bcdr-consult" aria-labelledby="bcdr-faq-title">
            <div class="site-shell bcdr-consult">
                <div class="bcdr-consult__faq">
                    <h2 id="bcdr-faq-title">Frequently Asked Questions</h2>

                    <div class="bcdr-faq" data-bcdr-faq>
                        @foreach ($faqs as $index => $faq)
                            <details class="bcdr-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="bcdr-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="bcdr-consult__card" id="bcdr-consult-form" aria-labelledby="bcdr-consult-form-title">
                    <h3 id="bcdr-consult-form-title">Protect Your Operations with Trusted BCDR Experts</h3>
                    <p class="bcdr-consult__lede">
                        Secure your business with proven BCDR strategies. Maintain uptime and recover fast from any disruption.
                    </p>

                    <livewire:forms.contact-form
                        form-name="business-continuity-disaster-recovery-services"
                        id-prefix="bcdr"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your BCDR requirements"
                        submit-label="Send Your Message"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
