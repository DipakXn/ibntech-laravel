@php
    $img = fn (string $file): string => asset('images/microsoft-office-365-migration-support-services/'.$file);
    $certImg = fn (string $file): string => asset('images/Certificates/'.$file);
    $clientImg = fn (string $file): string => asset('images/clients-logo/'.$file);

    $heroPoints = [
        ['lead' => 'Zero-downtime migration', 'text' => ' for mailboxes, files, Teams & SharePoint'],
        ['lead' => 'Supports', 'text' => ' cross-tenant, hybrid, and on-prem to cloud setups'],
        ['lead' => 'MSSP-grade security', 'text' => ' with threat detection during cutover'],
        ['lead' => 'Post-migration support', 'text' => ' with 24/7 help and user onboarding'],
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

    $trustCards = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'MSSP-Infused Security',
            'text' => 'Live threat monitoring, rollback safety',
        ],
        [
            'icon' => 'fa-cloud',
            'title' => 'Cloud Partnerships',
            'text' => 'Azure & AWS hybrid & DR expertise',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'Global with Local Support',
            'text' => 'US, UK, India tailored deployment',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Full Lifecycle Support',
            'text' => 'End-to-end service delivery',
        ],
    ];

    $offerings = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'Assessment & Roadmap',
            'subtitle' => 'Tenant discovery, planning, compliance checks',
            'items' => [
                'Complete infrastructure assessment',
                'Migration roadmap development',
                'Compliance and security review',
                'Risk analysis and mitigation planning',
            ],
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Migration Execution',
            'subtitle' => 'Mailboxes, SharePoint, Teams, cross-tenant, hybrid setups',
            'items' => [
                'Zero-downtime mailbox migration',
                'SharePoint and OneDrive migration',
                'Teams workspace migration',
                'Hybrid and cross-tenant support',
            ],
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'Security & Resilience',
            'subtitle' => 'Threat scans, access policies, immutable backups',
            'items' => [
                'MSSP-grade threat monitoring',
                'Advanced access policies',
                'Immutable backup solutions',
                'Disaster recovery planning',
            ],
        ],
        [
            'icon' => 'fa-user',
            'title' => 'User Enablement & Adoption',
            'subtitle' => 'Co-existence, training, support resources',
            'items' => [
                'Comprehensive user training',
                'Co-existence support',
                'Adoption resources and guides',
                'Change management support',
            ],
        ],
    ];

    $highlights = [
        [
            'icon' => 'fa-chart-line',
            'title' => '99%+ Uptime',
            'text' => 'Guaranteed uptime with minimal disruption',
            'items' => [
                'Zero-downtime migration process',
                'Continuous service availability',
                'Proactive monitoring and alerts',
            ],
        ],
        [
            'icon' => 'fa-database',
            'title' => 'Zero Data Loss',
            'text' => 'Complete data integrity throughout migration',
            'items' => [
                'Immutable backup systems',
                'Data validation and verification',
                'Rollback capabilities',
            ],
        ],
        [
            'icon' => 'fa-bullseye',
            'title' => 'Smooth Adaptation',
            'text' => 'User-friendly transition with comprehensive training',
            'items' => [
                'Comprehensive user training',
                '24/7 support during transition',
                'Change management expertise',
            ],
        ],
    ];

    $partners = [
        ['file' => 'Azure-Devops.webp', 'alt' => 'Azure DevOps', 'title' => 'Azure Devops'],
        ['file' => 'AWS-1.webp', 'alt' => 'AWS', 'title' => 'AWS'],
        ['file' => 'Microsoft-Certified-Partner.webp', 'alt' => 'Microsoft Certified Partner', 'title' => 'Microsoft Certified Partner'],
    ];

    $stackItems = [
        ['icon' => 'fa-shield-halved', 'title' => 'Secure Migration Tools'],
        ['icon' => 'fa-gears', 'title' => 'Automated Processes'],
        ['icon' => 'fa-cloud', 'title' => 'Hybrid Cloud Expertise'],
    ];

    $faqs = [
        [
            'q' => "1. What's included in support?",
            'a' => 'Our support includes 24/7 migration monitoring, user training, and SLA-guaranteed assistance.',
        ],
        [
            'q' => '2. Can you migrate Teams?',
            'a' => 'Yes, we securely migrate Teams files, memberships, and chats (where supported by the platform).',
        ],
        [
            'q' => '3. What about compliance (GDPR, HIPAA)?',
            'a' => 'We ensure full compliance with GDPR, HIPAA, and other regulations through specialized planning and data handling.',
        ],
        [
            'q' => '4. How long does it take?',
            'a' => 'Mailbox-only migrations: 2-3 days. Full SMB rollouts: 1-2 weeks, depending on scope.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/microsoft-office-365-migration-support-services.css'])
@endpush

@section('content')
    <div class="m365-page">
        {{-- Hero --}}
        <section class="m365-hero" aria-labelledby="m365-hero-title">
            <div class="site-shell m365-hero__inner">
                <div class="m365-hero__copy">
                    <h1 id="m365-hero-title">
                        Microsoft 365 | Office 365 Migration Services with <span class="m365-accent">Dedicated Support</span>
                    </h1>
                    <p class="m365-hero__lede">
                        Accelerate secure, zero-downtime migrations for SMBs in the U.S, UK, and India, fully integrated with Azure and AWS and fortified by enterprise-grade security.
                    </p>
                    <ul class="m365-hero__list">
                        @foreach ($heroPoints as $point)
                            <li>
                                <span class="m365-check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span><strong>{{ $point['lead'] }}</strong>{{ $point['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#m365-consult" class="m365-btn m365-btn--green">
                        Get Instant Support
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
                <figure class="m365-hero__media">
                    <img
                        src="{{ $img('MS-Office-365-Migration-Services-with-Dedicated-Support-banner.png') }}"
                        alt="Microsoft Office 365 migration services with dedicated support"
                        width="452"
                        height="452"
                        fetchpriority="high"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Certified Excellence --}}
        <section class="m365-section m365-section--tight" aria-labelledby="m365-certs-title">
            <div class="site-shell">
                <div class="m365-divider-label">
                    <span id="m365-certs-title">Certified Excellence</span>
                </div>

                <div
                    class="m365-certs"
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
                    <button type="button" class="m365-certs__nav" @click="prev()" aria-label="Previous certifications">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="m365-certs__viewport">
                        <div
                            class="m365-certs__track"
                            role="list"
                            :style="`--m365-per-page: ${perPage}; transform: translateX(-${index * 100}%)`"
                        >
                            @foreach ($certificates as $certificate)
                                <div class="m365-certs__item" role="listitem">
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

                    <button type="button" class="m365-certs__nav" @click="next()" aria-label="Next certifications">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="m365-certs__dots" role="tablist" aria-label="Certification slides">
                        <template x-for="page in pages" :key="page">
                            <button
                                type="button"
                                class="m365-certs__dot"
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

        {{-- Our Clients --}}
        <section class="m365-clients" aria-label="Our clients">
            <div class="site-shell">
                <div class="m365-divider-label m365-divider-label--green">
                    <span>Our Clients</span>
                </div>
            </div>
            <div class="m365-marquee">
                <div class="m365-marquee__track">
                    @foreach ([...$clientLogos, ...$clientLogos] as $logo)
                        <div class="m365-logo-chip">
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

        {{-- M365 Migration Services --}}
        <section class="m365-section" aria-labelledby="m365-intro-title">
            <div class="site-shell m365-split">
                <div class="m365-split__copy">
                    <h2 id="m365-intro-title">M365 Migration Services</h2>
                    <p>
                        IBN Tech delivers end-to-end Microsoft 365 migration from legacy systems- on-prem, cloud, or hybrid. Our skilled process confirms minimal disruption, reduced IT costs, and seamless email and collaboration transitions personalized to your business needs.
                    </p>
                    <p>
                        Make your move to Microsoft 365 fast, secure, and stress-free with IBN Tech. Our certified migration experts handle everything, from legacy email systems to full cloud adoption, ensuring zero downtime, full compliance, and a smooth transition on time and within budget. Focus on your business while we manage the migration end-to-end.
                    </p>
                </div>
                <div class="m365-split__visual" aria-hidden="true">
                    <span class="m365-cloud-icon">
                        <i class="fa-solid fa-cloud"></i>
                        <i class="fa-solid fa-arrow-up"></i>
                    </span>
                </div>
            </div>
        </section>

        {{-- Ready to Transform --}}
        <section class="m365-cta m365-cta--navy" aria-labelledby="m365-cta-title">
            <div class="site-shell m365-cta__inner">
                <h2 id="m365-cta-title">Ready to Transform Your Business?</h2>
                <p>Start your Microsoft 365 migration journey with confidence. Our experts are ready to help.</p>
                <a href="#m365-consult" class="m365-btn m365-btn--green">Get Started Today</a>
            </div>
        </section>

        {{-- Why Trust IBN Tech --}}
        <section class="m365-section m365-section--soft" aria-labelledby="m365-trust-title">
            <div class="site-shell">
                <div class="m365-heading">
                    <h2 id="m365-trust-title">Why Trust IBN Tech for Your M365 Journey?</h2>
                    <p>
                        We combine deep Microsoft expertise with MSSP-grade security and global reach to deliver seamless, secure migrations that keep your business running smoothly.
                    </p>
                </div>
                <div class="m365-trust-grid" role="list">
                    @foreach ($trustCards as $card)
                        <article class="m365-trust-card" role="listitem">
                            <div class="m365-trust-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Our Service Offerings --}}
        <section class="m365-section" aria-labelledby="m365-offerings-title">
            <div class="site-shell">
                <div class="m365-heading">
                    <h2 id="m365-offerings-title">Our Service Offerings</h2>
                </div>
                <div class="m365-offer-grid" role="list">
                    @foreach ($offerings as $offering)
                        <article class="m365-offer-card" role="listitem">
                            <div class="m365-offer-card__head">
                                <span class="m365-offer-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $offering['icon'] }}"></i>
                                </span>
                                <div>
                                    <h3>{{ $offering['title'] }}</h3>
                                    <p>{{ $offering['subtitle'] }}</p>
                                </div>
                            </div>
                            <ul>
                                @foreach ($offering['items'] as $item)
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

        {{-- Partner CTA --}}
        <section class="m365-cta m365-cta--yellow" aria-labelledby="m365-partner-title">
            <div class="site-shell m365-cta__inner">
                <h2 id="m365-partner-title">Partner with Microsoft 365 Migration Experts</h2>
                <p>Join hundreds of organizations that have successfully migrated to Microsoft 365 with our expert guidance and support.</p>
                <a href="#m365-consult" class="m365-btn m365-btn--green">
                    Request Your Free Consultation
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Success Highlights --}}
        <section class="m365-highlights" aria-labelledby="m365-highlights-title">
            <div class="site-shell">
                <div class="m365-heading m365-heading--light">
                    <h2 id="m365-highlights-title">Success Highlights</h2>
                    <p>Teams adopting our devsecops solutions consistently report measurable improvements within weeks.</p>
                </div>
                <div class="m365-highlight-grid" role="list">
                    @foreach ($highlights as $highlight)
                        <article class="m365-highlight-card" role="listitem">
                            <div class="m365-highlight-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $highlight['icon'] }}"></i>
                            </div>
                            <h3>{{ $highlight['title'] }}</h3>
                            <p>{{ $highlight['text'] }}</p>
                            <ul>
                                @foreach ($highlight['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Partnerships & Technology Stack --}}
        <section class="m365-section" aria-labelledby="m365-stack-title">
            <div class="site-shell">
                <div class="m365-heading">
                    <h2 id="m365-stack-title">Partnerships &amp; Technology Stack</h2>
                    <p>Leveraging industry-leading partnerships and automated migration tools for hybrid, secure cloud transformations.</p>
                </div>
                <div class="m365-partner-grid" role="list">
                    @foreach ($partners as $partner)
                        <article class="m365-partner-card" role="listitem">
                            <img
                                src="{{ $img($partner['file']) }}"
                                alt="{{ $partner['alt'] }}"
                                width="273"
                                height="93"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $partner['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
                <div class="m365-stack-row" role="list">
                    @foreach ($stackItems as $item)
                        <div class="m365-stack-item" role="listitem">
                            <span class="m365-stack-item__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <span>{{ $item['title'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + Contact --}}
        <section class="m365-section m365-section--soft" id="m365-consult" aria-labelledby="m365-faq-title">
            <div class="site-shell m365-consult">
                <div class="m365-consult__faq">
                    <h2 id="m365-faq-title">Frequently Asked Questions</h2>
                    <div class="m365-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="m365-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="m365-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="m365-consult__card" id="m365-consult-form" aria-labelledby="m365-consult-form-title">
                    <div class="m365-consult__card-head">
                        <h3 id="m365-consult-form-title">Migrate to Microsoft 365 or Office 365 with zero downtime</h3>
                        <p>Upgrade to Office 365 without the hassle. We handle everything from planning to post-migration support.</p>
                    </div>
                    <div class="m365-consult__card-body">
                        <livewire:forms.contact-form
                            form-name="microsoft-office-365-migration-support-services"
                            id-prefix="m365"
                            :show-company="false"
                            :show-service="false"
                            message-placeholder="How can we help you?"
                            submit-label="Submit Now"
                            layout="home"
                            thank-you-url="/thanks-you-for-cloud/"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
