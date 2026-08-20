@php
    $img = fn (string $file): string => asset('images/cloud-managed-services/'.$file);
    $certImg = fn (string $file): string => asset('images/Certificates/'.$file);
    $clientImg = fn (string $file): string => asset('images/clients-logo/'.$file);

    $heroCards = [
        [
            'icon' => 'fa-check',
            'title' => 'Vendor-Neutral, Certified',
            'text' => 'Azure & AWS Solution Partner, multi-cloud',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'MSSP-Backed Security',
            'text' => 'Security by design, 24/7 oversight',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => '24/7 Monitoring',
            'text' => 'NOC/SOC-style incident response',
        ],
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

    $needCards = [
        [
            'icon' => 'fa-lightbulb',
            'title' => 'Expertise',
            'text' => 'Cloud specialists maximize your infrastructure and strategies.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Scalable Solutions',
            'text' => 'Flexible services expand with your business, from startups to large enterprises.',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Performance',
            'text' => 'Drive efficiency and cost savings with optimized cloud environments.',
        ],
        [
            'icon' => 'fa-database',
            'title' => 'Seamless Migration',
            'text' => 'Smooth, disruption-free cloud integration and migration.',
        ],
        [
            'icon' => 'fa-hotel',
            'title' => 'Automation',
            'text' => 'Stay updated with automated system updates and upgrades.',
        ],
        [
            'icon' => 'fa-file-lines',
            'title' => 'Compliance',
            'text' => 'Navigate regulations confidently with specialized security and risk management.',
        ],
    ];

    $operateCards = [
        [
            'icon' => 'fa-cloud',
            'title' => 'Platform-Agnostic Cloud Management',
            'text' => 'Full lifecycle support across Azure, AWS, GCP, Jio Cloud, and private deployments.',
        ],
        [
            'icon' => 'fa-up-down-left-right',
            'title' => 'Infrastructure Provisioning & Optimization',
            'text' => 'Full lifecycle support across Azure, AWS, GCP, Jio Cloud, and private deployments.',
        ],
        [
            'icon' => 'fa-clock',
            'title' => '24/7 Monitoring & Incident Response',
            'text' => 'Continuous oversight with rapid issue resolution.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security & Compliance Enforcement',
            'text' => 'Built-in policies for GDPR, HIPAA, ISO standards, and regional regulations.',
        ],
        [
            'icon' => 'fa-database',
            'title' => 'Disaster Recovery & Backup Management',
            'text' => 'Robust DR planning and execution strategies.',
        ],
        [
            'icon' => 'fa-font',
            'title' => 'DevOps & Automation Services',
            'text' => 'CI/CD pipelines, Infrastructure-as-Code, and onboarding efficiency.',
        ],
    ];

    $chooseCards = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Security at the Core',
            'text' => 'Our approach embeds security into every layer- tools, processes, and infrastructure - for 24/7 protection.',
        ],
        [
            'icon' => 'fa-certificate',
            'title' => 'Certified Across Platforms',
            'text' => 'We are partners with Azure and AWS and experts in GCP, Jio Cloud, and private cloud environments.',
        ],
        [
            'icon' => 'fa-globe',
            'title' => 'SMB-Focused, Globally Ready',
            'text' => 'Solutions built for small and mid-sized businesses, aligned with compliance needs in India, the US, and the UK.',
        ],
        [
            'icon' => 'fa-cloud',
            'title' => 'Hybrid & Multi-Cloud Expertise',
            'text' => 'Seamless management across public and private clouds with built-in governance and flexibility.',
        ],
    ];

    $platforms = [
        ['file' => 'Google-cloud.webp', 'alt' => 'Google Cloud'],
        ['file' => 'Microsoft-Azure.webp', 'alt' => 'Microsoft Azure'],
        ['file' => 'Amazon-Web-Services.webp', 'alt' => 'Amazon Web Services'],
        ['file' => 'Jio-Cloud.webp', 'alt' => 'Jio Cloud'],
        ['file' => 'Private-Cloud.webp', 'alt' => 'Private Cloud'],
        ['file' => 'Microsoft-Defender-1.webp', 'alt' => 'Microsoft Defender'],
        ['file' => 'Fortinet-1.webp', 'alt' => 'Fortinet'],
        ['file' => 'SOPHOS.webp', 'alt' => 'Sophos'],
        ['file' => 'crowdstrike.webp', 'alt' => 'CrowdStrike'],
        ['file' => 'paloalto.webp', 'alt' => 'Palo Alto'],
    ];

    $sectors = [
        [
            'icon' => 'fa-cloud',
            'title' => 'SMBs',
            'text' => 'Cost optimization with manged cloud solutions',
        ],
        [
            'icon' => 'fa-hospital',
            'title' => 'Healthcare',
            'text' => 'Compliance with managed cloud security services',
        ],
        [
            'icon' => 'fa-cart-shopping',
            'title' => 'E-commerce',
            'text' => 'Scaling on cloud managed hosting',
        ],
        [
            'icon' => 'fa-magnifying-glass-dollar',
            'title' => 'Finance sector',
            'text' => 'Resiliency using managed cloud hosting services',
        ],
        [
            'icon' => 'fa-aws',
            'brand' => true,
            'title' => 'Enterprise DevOps',
            'text' => 'Pipelines with managed cloud servers',
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Government',
            'text' => 'Workloads secured with managed private cloud hosting',
        ],
    ];

    $faqs = [
        [
            'q' => '1. How do we ensure a smooth and secure migration for your business?',
            'a' => 'We start with a thorough analysis of your current infrastructure and business goals. Our experts then design a customized migration roadmap, ensuring minimal downtime, data integrity, and compliance with industry standards throughout the process.',
        ],
        [
            'q' => '2. What types of businesses benefit most from cloud migration?',
            'a' => 'Whether you\'re a startup, SME, or enterprise, cloud migration delivers scalable solutions personalized to your growth. Businesses looking to reduce IT costs, increase agility, improve security, or enable remote work benefit significantly from moving to the cloud.',
        ],
        [
            'q' => '3. What support do we offer after the migration is complete?',
            'a' => 'Our service doesn’t end with migration. We provide ongoing support, performance monitoring, cost optimization, and security upgrades to guarantee that your cloud environment continues to produce value and stays aligned with your evolving business needs.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/cloud-managed-services.css'])
@endpush

@section('content')
    <div class="cms-page">
        {{-- Hero --}}
        <section class="cms-hero" aria-labelledby="cms-hero-title">
            <div class="site-shell cms-hero__inner">
                <div class="cms-hero__copy">
                    <h1 id="cms-hero-title">
                        Secure, Scalable <span class="cms-accent">Cloud Managed Services</span>
                    </h1>
                    <p class="cms-hero__lede">
                        MSSP-grade solutions for SMBs across India • US • UK. Platform-agnostic management with proactive security, performance, and cost governance.
                    </p>
                    <a href="#cms-consult" class="cms-btn cms-btn--green">
                        Get a security-first assessment
                    </a>
                </div>

                <div class="cms-hero__cards" role="list">
                    @foreach ($heroCards as $card)
                        <article class="cms-hero-card" role="listitem">
                            <span class="cms-hero-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </span>
                            <div>
                                <p class="cms-hero-card__title">{{ $card['title'] }}</p>
                                <p>{{ $card['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Certified Excellence --}}
        <section class="cms-section cms-section--tight" aria-labelledby="cms-certs-title">
            <div class="site-shell">
                <div class="cms-divider-label">
                    <span id="cms-certs-title">Certified Excellence</span>
                </div>

                <div
                    class="cms-certs"
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
                    <button type="button" class="cms-certs__nav" @click="prev()" aria-label="Previous certifications">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="cms-certs__viewport">
                        <div
                            class="cms-certs__track"
                            role="list"
                            :style="`--cms-per-page: ${perPage}; transform: translateX(-${index * 100}%)`"
                        >
                            @foreach ($certificates as $certificate)
                                <div class="cms-certs__item" role="listitem">
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

                    <button type="button" class="cms-certs__nav" @click="next()" aria-label="Next certifications">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>

                    <div class="cms-certs__dots" role="tablist" aria-label="Certification slides">
                        <template x-for="page in pages" :key="page">
                            <button
                                type="button"
                                class="cms-certs__dot"
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
        <section class="cms-clients" aria-label="Our clients">
            <div class="site-shell">
                <div class="cms-divider-label cms-divider-label--green">
                    <span>Our Clients</span>
                </div>
            </div>
            <div class="cms-marquee">
                <div class="cms-marquee__track">
                    @foreach ([...$clientLogos, ...$clientLogos] as $logo)
                        <div class="cms-logo-chip">
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

        {{-- Managed Cloud Hosting --}}
        <section class="cms-section cms-section--cream" aria-labelledby="cms-hosting-title">
            <div class="site-shell cms-split">
                <figure class="cms-split__media">
                    <img
                        src="{{ $img('Managed-cloud-hosting.png') }}"
                        alt="Managed cloud hosting with built-in security and compliance"
                        width="311"
                        height="208"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
                <div class="cms-split__copy">
                    <h2 id="cms-hosting-title">Managed Cloud Hosting With Built-in Security And Compliance</h2>
                    <p>
                        Operate on Azure, AWS, GCP, Jio Cloud, or a private cloud with confidence. Our certified partnerships and deep cloud expertise help you govern costs, optimize performance, and enforce compliance across regions. We handle complicated management of cloud infrastructure so you can work on building your business.
                    </p>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="cms-cta cms-cta--navy" aria-labelledby="cms-cta-title">
            <div class="site-shell cms-cta__inner">
                <h2 id="cms-cta-title">Transform Your Cloud Infrastructure Today</h2>
                <p>Speak with our cloud experts to discover how managed cloud services can optimize your infrastructure while reducing costs.</p>
                <a href="#cms-consult" class="cms-btn cms-btn--green">Schedule Your Free Consultation</a>
            </div>
        </section>

        {{-- Why Your Business Needs --}}
        <section class="cms-section" aria-labelledby="cms-needs-title">
            <div class="site-shell">
                <div class="cms-heading">
                    <h2 id="cms-needs-title">
                        Why Your Business Needs <span class="cms-accent">Managed Cloud Services</span>
                    </h2>
                    <p>
                        Our managed cloud hosting services, from public to private clouds, are customized to your business needs. From secure private clouds to flexible platforms like Azure, AWS, or Google Cloud, we help you stay efficient, agile, and cost-effective.
                    </p>
                </div>

                <div class="cms-need-grid" role="list">
                    @foreach ($needCards as $card)
                        <article class="cms-need-card" role="listitem">
                            <div class="cms-need-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Operate, Optimize, Secure --}}
        <section class="cms-section cms-section--soft" aria-labelledby="cms-operate-title">
            <div class="site-shell">
                <div class="cms-heading">
                    <h2 id="cms-operate-title">Operate, Optimize, and Secure Your Entire Cloud Footprint</h2>
                    <p>From day-2 operations to compliance enforcement, we cover the stack, end-to-end management.</p>
                </div>

                <div class="cms-operate-grid" role="list">
                    @foreach ($operateCards as $card)
                        <article class="cms-operate-card" role="listitem">
                            <div class="cms-operate-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <div>
                                <h3>{{ $card['title'] }}</h3>
                                <p>{{ $card['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why Choose IBN Tech --}}
        <section class="cms-choose" aria-labelledby="cms-choose-title">
            <div class="site-shell">
                <div class="cms-heading cms-heading--light">
                    <h2 id="cms-choose-title">
                        Why Choose IBN Tech As Your <span class="cms-accent">Managed Cloud Security Service?</span>
                    </h2>
                    <p>Built for Security. Certified for Trust. Designed for the Cloud.</p>
                </div>

                <div class="cms-choose-grid" role="list">
                    @foreach ($chooseCards as $card)
                        <article class="cms-choose-card" role="listitem">
                            <div class="cms-choose-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Yellow CTA --}}
        <section class="cms-cta cms-cta--yellow" aria-labelledby="cms-assess-title">
            <div class="site-shell cms-cta__inner">
                <h2 id="cms-assess-title">Ready to modernize with security-first operations?</h2>
                <p>Request a tailored assessment to benchmark cost, performance, and compliance across your cloud footprint.</p>
                <a href="#cms-consult" class="cms-btn cms-btn--green">Request Assessment</a>
            </div>
        </section>

        {{-- How We Work --}}
        <section class="cms-section" aria-labelledby="cms-work-title">
            <div class="site-shell">
                <div class="cms-heading">
                    <h2 id="cms-work-title">How We Work</h2>
                    <p>Simple, Secure, Seamless process</p>
                </div>
                <figure class="cms-work-figure">
                    <img
                        src="{{ $img('How-We-Work.png') }}"
                        alt="How we work: assessment and strategy, migration and implementation, ongoing management and optimization, continuous improvement"
                        width="960"
                        height="540"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Cloud Platform Proficiency --}}
        <section class="cms-section cms-section--tight-bottom" aria-labelledby="cms-platform-title">
            <div class="site-shell">
                <div class="cms-heading">
                    <h2 id="cms-platform-title">Cloud Platform Proficiency</h2>
                </div>
                <div class="cms-platform-grid" role="list">
                    @foreach ($platforms as $platform)
                        <article class="cms-platform-card" role="listitem">
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

        {{-- Industry solutions --}}
        <section class="cms-section cms-section--mist" aria-labelledby="cms-sectors-title">
            <div class="site-shell">
                <div class="cms-heading">
                    <h2 id="cms-sectors-title">Smart Cloud Solutions For Every Sector</h2>
                    <p>
                        Our expert managed cloud providers deliver scalable, compliant setups via managed private cloud hosting and robust cloud infrastructure management services.
                    </p>
                </div>

                <div class="cms-sector-grid" role="list">
                    @foreach ($sectors as $sector)
                        <article class="cms-sector-card" role="listitem">
                            <div class="cms-sector-card__icon" aria-hidden="true">
                                <i class="{{ !empty($sector['brand']) ? 'fa-brands' : 'fa-solid' }} {{ $sector['icon'] }}"></i>
                            </div>
                            <h3>{{ $sector['title'] }}</h3>
                            <p>{{ $sector['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + Contact --}}
        <section class="cms-section cms-section--soft" id="cms-consult" aria-labelledby="cms-faq-title">
            <div class="site-shell cms-consult">
                <div class="cms-consult__faq">
                    <h2 id="cms-faq-title">Frequently Asked Questions</h2>

                    <div class="cms-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="cms-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="cms-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="cms-consult__card" id="cms-consult-form" aria-labelledby="cms-consult-form-title">
                    <h3 id="cms-consult-form-title">Get Expert Cloud Management Now!</h3>
                    <p class="cms-consult__lede">
                        Our certified cloud professionals deliver personalized solutions for performance, security, and cost-efficiency. Fill out the form and let us help you scale smarter.
                    </p>

                    <livewire:forms.contact-form
                        form-name="cloud-managed-services"
                        id-prefix="cms"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we help you?"
                        submit-label="SUBMIT YOUR MESSAGE"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
