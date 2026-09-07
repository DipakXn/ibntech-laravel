@php
    $img = fn (string $file): string => asset('images/cloud-consulting-and-migration-services/'.$file);
    $certImg = fn (string $file): string => asset('images/Certificates/'.$file);
    $clientImg = fn (string $file): string => asset('images/clients-logo/'.$file);
    $platformImg = fn (string $file): string => asset('images/cloud-managed-services/'.$file);

    $heroStats = [
        ['value' => '26+', 'label' => 'Years in Business', 'icon' => 'fa-building'],
        ['value' => '10+', 'label' => 'Countries Served', 'icon' => 'fa-globe'],
        ['value' => '500+', 'label' => 'Projects Delivered', 'icon' => 'fa-diagram-project'],
        ['value' => '150+', 'label' => 'Cloud Certifications', 'icon' => 'fa-certificate'],
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

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug(
        'cloud-case-studies',
        limit: 3,
        includeChildren: true
    );

    $whatWeDo = [
        [
            'icon' => 'fa-cloud',
            'title' => 'Multi-Cloud Strategy & Assessment',
            'text' => 'Design a unified architecture leveraging the strengths of Azure, AWS, Google Cloud Platform, JioCloud, and private clouds.',
        ],
        [
            'icon' => 'fa-database',
            'title' => 'Seamless Migration',
            'text' => 'Expert-led migration of legacy, hybrid, or multi-cloud workloads with zero data loss and business continuity.',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Cloud-Native & Secure by Design',
            'text' => 'Embed security, identity, and compliance across every cloud touchpoint (MS Azure Security Center, AWS Security Hub, etc.)',
        ],
        [
            'icon' => 'fa-clock',
            'title' => '24/7 MSSP Support',
            'text' => 'Real-time monitoring, threat detection, and remediation-proactively managed for SMBs and regulated industries.',
        ],
        [
            'icon' => 'fa-cloud-arrow-down',
            'title' => 'Private & Hybrid Cloud Integration',
            'text' => 'Combine public and private clouds for highest control and security.',
        ],
        [
            'icon' => 'fa-users-gear',
            'title' => 'Managed Cloud Hosting',
            'text' => 'We monitor, manage, and resolve issues 24/7 to keep systems secure, available, and optimized.',
        ],
    ];

    $capabilities = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Embedded MSSP Security & Compliance',
            'text' => 'Round-the-clock monitoring, threat detection, incident response, with regulatory compliance (GDPR, CCPA, Indian data norms).',
        ],
        [
            'icon' => 'fa-network-wired',
            'title' => 'Hybrid & Private Cloud Enablement',
            'text' => 'Integrating on-premises, private clouds with public cloud platforms.',
        ],
        [
            'icon' => 'fa-code-branch',
            'title' => 'DevSecOps & Automation',
            'text' => 'Secure CI/CD pipelines and infrastructure-as-code across diverse environments.',
        ],
        [
            'icon' => 'fa-file-invoice-dollar',
            'title' => 'Optimized Cost Management (FinOps)',
            'text' => 'Intelligent resource allocation and spend control across clouds.',
        ],
    ];

    $platforms = [
        ['file' => 'Google-cloud.webp', 'alt' => 'Google Cloud'],
        ['file' => 'Microsoft-Azure.webp', 'alt' => 'Microsoft Azure'],
        ['file' => 'Amazon-Web-Services.webp', 'alt' => 'Amazon Web Services'],
        ['file' => 'Jio-Cloud.webp', 'alt' => 'Jio Cloud'],
        ['file' => 'Private-Cloud.webp', 'alt' => 'Private Cloud'],
    ];

    $whyCards = [
        [
            'icon' => 'fa-globe',
            'title' => 'SMB-Focused with Global Expertise',
            'text' => 'Strategic guidance custom made for SMBs, aligned with compliance standards across India, the U.S., and the UK.',
        ],
        [
            'icon' => 'fa-cloud',
            'title' => 'Cloud-Smart, Platform-Neutral',
            'text' => 'We recommend the best-fit cloud hosting solutions based on your needs—free from vendor bias or restrictive contracts.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Built-In Security Excellence',
            'text' => 'Security is not an afterthought. Our MSSP-grade protection is woven into every phase of your cloud journey.',
        ],
        [
            'icon' => 'fa-handshake',
            'title' => 'Recognized Industry Partnerships',
            'text' => 'Trusted by tech giants, we’re certified partners with Microsoft Azure and AWS, ensuring top-tier service and support.',
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
    @vite(['resources/css/pages/cloud-consulting-and-migration-services.css'])
@endpush

@section('content')
    <div class="ccms-page">
        {{-- Hero --}}
        <section class="ccms-hero" aria-labelledby="ccms-hero-title">
            <div class="site-shell ccms-hero__inner">
                <div class="ccms-hero__copy">
                    <h1 id="ccms-hero-title">
                        Accelerate Your <span class="ccms-accent">Cloud Migration Services</span> with Trusted Experts
                    </h1>
                    <p class="ccms-hero__lede">
                        IBN Tech helps SMBs and enterprises in the US, UK, and India to seamlessly migrate to multi-cloud environments like Azure, AWS, GCP, and JioCloud. Our multi <strong>cloud consulting services</strong>, and managed <strong>cloud hosting solutions</strong> improve operations, enhance security, and drive innovation ensuring agility, compliance, and long-term growth.
                    </p>

                    <ul class="ccms-hero__stats">
                        @foreach ($heroStats as $stat)
                            <li>
                                <span class="ccms-hero__stat-icon" aria-hidden="true">
                                    <i class="fa-solid {{ $stat['icon'] }}"></i>
                                </span>
                                <span class="ccms-hero__stat-text">
                                    <strong>{{ $stat['value'] }}</strong>
                                    <span>{{ $stat['label'] }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="ccms-hero__actions">
                        <a href="#ccms-consult" class="ccms-btn ccms-btn--green">
                            Schedule Your Free Cloud Assessment
                        </a>
                    </div>
                </div>

                <figure class="ccms-hero__media">
                    <img
                        src="{{ $img('Cloud-Migration-Services-Banner.webp') }}"
                        alt="Cloud migration services banner"
                        width="500"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Certified Excellence --}}
        <section class="ccms-section ccms-section--tight" aria-labelledby="ccms-certs-title">
            <div class="site-shell">
                <div class="ccms-divider-label">
                    <span id="ccms-certs-title">Certified Excellence</span>
                </div>

                <div
                    class="ccms-certs"
                    x-data
                >
                    <button
                        type="button"
                        class="ccms-certs__nav ccms-certs__nav--prev"
                        @click="$refs.certTrack.scrollBy({ left: -220, behavior: 'smooth' })"
                        aria-label="Previous certifications"
                    >
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <div class="ccms-certs__viewport" x-ref="certTrack" role="list">
                        @foreach ($certificates as $certificate)
                            <div class="ccms-certs__item" role="listitem">
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

                    <button
                        type="button"
                        class="ccms-certs__nav ccms-certs__nav--next"
                        @click="$refs.certTrack.scrollBy({ left: 220, behavior: 'smooth' })"
                        aria-label="Next certifications"
                    >
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>

        {{-- Our Clients --}}
        <section class="ccms-clients" aria-label="Our clients">
            <div class="site-shell">
                <div class="ccms-divider-label ccms-divider-label--green">
                    <span>Our Clients</span>
                </div>
            </div>
            <div class="ccms-marquee">
                <div class="ccms-marquee__track">
                    @foreach ([...$clientLogos, ...$clientLogos] as $logo)
                        <div class="ccms-logo-chip">
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

        {{-- Case Studies --}}
        @if ($caseStudies->isNotEmpty())
            <section class="ccms-section" aria-labelledby="ccms-cases-title">
                <div class="site-shell">
                    <div class="ccms-heading">
                        <h2 id="ccms-cases-title">Organizations Trust Our Cloud Consulting Services</h2>
                    </div>

                    <div class="ccms-cases" role="list">
                        @foreach ($caseStudies as $case)
                            <article class="ccms-case-card" role="listitem">
                                @php
                                    $caseImageUrl = $case->featuredImageUrl();
                                    if (! $caseImageUrl && $case->featured_image) {
                                        if (file_exists(public_path('images/cloud-consulting-and-migration-services/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/cloud-consulting-and-migration-services/' . $case->featured_image);
                                        } elseif (file_exists(public_path('images/aws-partner/' . $case->featured_image))) {
                                            $caseImageUrl = asset('images/aws-partner/' . $case->featured_image);
                                        } elseif (file_exists(public_path($case->featured_image))) {
                                            $caseImageUrl = asset($case->featured_image);
                                        }
                                    }
                                @endphp
                                @if ($caseImageUrl)
                                    <div class="ccms-case-card__media">
                                        <img
                                            src="{{ $caseImageUrl }}"
                                            alt="{{ $case->title }}"
                                            width="640"
                                            height="400"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                @endif
                                <div class="ccms-case-card__body">
                                    <h3>{{ $case->title }}</h3>
                                    <a href="{{ route('case-studies.show', $case->slug) }}" class="ccms-case-card__link">
                                        View Case Study »
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="ccms-cases__cta">
                        <a href="{{ route('case-studies.index') }}" class="ccms-btn ccms-btn--green">
                            Open More Case Studies →
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Mid CTA 1 --}}
        <section class="ccms-cta-banner" aria-labelledby="ccms-cta-start-title">
            <div class="site-shell ccms-cta-banner__inner">
                <h2 id="ccms-cta-start-title">Ready to Start Your Cloud Journey?</h2>
                <p>Our cloud migration experts can help you develop a customized approach that aligns with your business goals while minimizing risks and maximizing ROI.</p>
                <a href="#ccms-consult" class="ccms-btn ccms-btn--green">
                    Schedule Your Free Cloud Assessment
                </a>
            </div>
        </section>

        {{-- Multi-Cloud Migration --}}
        <section class="ccms-section" aria-labelledby="ccms-multi-title">
            <div class="site-shell">
                <div class="ccms-multi">
                    <figure class="ccms-multi__media">
                        <img
                            src="{{ $img('Multi-Cloud-Migration-Services.webp') }}"
                            alt="IBN Tech multi-cloud migration services"
                            width="359"
                            height="239"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                    <div class="ccms-multi__copy">
                        <h2 id="ccms-multi-title">IBN Tech's Multi-Cloud Migration Services</h2>
                        <p>Traditional IT systems frequently struggle to keep pace with the fast growth of digital workloads, leading businesses to delay cloud transformation. When executed strategically, cloud adoption empowers organizations to reduce overheads, boost agility, and overcome legacy system limitations.</p>
                        <p>IBN Tech, a top cloud consulting firm, provides comprehensive cloud migration services that fit your unique business needs. Our professionals evaluate your present infrastructure and future objectives to design resilient, scalable cloud hosting solutions that drive digital innovation.</p>
                        <p>Partnering with AWS, Azure, and Google Cloud, we help you maximize cloud value, launch modern apps faster, and cut infrastructure costs by up to 50%. Our offerings include dedicated cloud servers for superior performance and security, along with cloud backup services to maintain data integrity and care uninterrupted operations.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- What We Do --}}
        <section class="ccms-section" aria-labelledby="ccms-do-title">
            <div class="site-shell">
                <div class="ccms-heading">
                    <h2 id="ccms-do-title">What We Do</h2>
                    <p>IBN Tech, a top cloud consulting firm, provides comprehensive cloud migration services that fit your unique business needs. Our professionals evaluate your present infrastructure and future objectives to design resilient, scalable cloud hosting solutions that drive digital innovation.</p>
                </div>

                <div class="ccms-do-grid" role="list">
                    @foreach ($whatWeDo as $item)
                        <article class="ccms-do-card" role="listitem">
                            <div class="ccms-do-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Advanced Capabilities --}}
        <section class="ccms-section ccms-section--soft" aria-labelledby="ccms-cap-title">
            <div class="site-shell">
                <div class="ccms-heading">
                    <h2 id="ccms-cap-title">Advanced Capabilities &amp; Continuous Optimization</h2>
                    <p>Security, automation, and cost efficiency are engineered into every layer of your multi‑cloud ecosystem.</p>
                </div>

                <div class="ccms-cap-grid" role="list">
                    @foreach ($capabilities as $item)
                        <article class="ccms-cap-card" role="listitem">
                            <div class="ccms-cap-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA 2 --}}
        <section class="ccms-cta-strip" aria-labelledby="ccms-cta-begin-title">
            <div class="site-shell ccms-cta-strip__inner">
                <h2 id="ccms-cta-begin-title">Ready to Begin Your Cloud Journey?</h2>
                <p>Our cloud migration consulting services will craft a customized strategy that aligns with your business goals while minimizing risks and maximizing ROI.</p>
                <a href="#ccms-consult" class="ccms-btn ccms-btn--green">
                    Schedule Your Free Cloud Assessment
                </a>
            </div>
        </section>

        {{-- Cloud Platform Proficiency --}}
        <section class="ccms-section" aria-labelledby="ccms-platform-title">
            <div class="site-shell">
                <div class="ccms-heading">
                    <h2 id="ccms-platform-title">Cloud Platform Proficiency</h2>
                </div>

                <div class="ccms-platform-grid">
                    @foreach ($platforms as $platform)
                        <article class="ccms-platform-card">
                            <img
                                src="{{ $platformImg($platform['file']) }}"
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

        {{-- Why IBN Tech Stands Out --}}
        <section class="ccms-why" aria-labelledby="ccms-why-title">
            <div class="site-shell">
                <div class="ccms-heading ccms-heading--light">
                    <h2 id="ccms-why-title">
                        Why <span class="ccms-accent">IBN Tech</span> Stands Out
                    </h2>
                    <p>Enterprise discipline with SMB agility—security-first by design and platform-neutral by choice.</p>
                </div>

                <div class="ccms-why-grid" role="list">
                    @foreach ($whyCards as $card)
                        <article class="ccms-why-card" role="listitem">
                            <div class="ccms-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- FAQ + Contact --}}
        <section class="ccms-section ccms-section--soft" id="ccms-consult" aria-labelledby="ccms-faq-title">
            <div class="site-shell ccms-consult">
                <div class="ccms-consult__faq">
                    <h2 id="ccms-faq-title">Frequently Asked Questions</h2>

                    <div class="ccms-faq">
                        @foreach ($faqs as $index => $faq)
                            <details class="ccms-faq__item" @if ($index === 0) open @endif>
                                <summary>
                                    <span>{{ $faq['q'] }}</span>
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </summary>
                                <div class="ccms-faq__body">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>

                <aside class="ccms-consult__card" id="ccms-consult-form" aria-labelledby="ccms-consult-form-title">
                    <h3 id="ccms-consult-form-title">Start Your Cloud Migration Today!</h3>
                    <p class="ccms-consult__lede">
                        Let’s move your business to the cloud—fast, secure, and tailored to your needs. Fill out the form now and take the first step toward your digital transformation.
                    </p>

                    <livewire:forms.contact-form
                        form-name="cloud-consulting-and-migration-services"
                        id-prefix="ccms"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Have specific migration needs?"
                        submit-label="BOOK FREE CONSULTATION"
                        layout="home"
                        thank-you-url="/thanks-you-for-cloud/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
