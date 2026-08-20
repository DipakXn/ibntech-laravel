@php
    $img = fn (string $file): string => asset('images/sap-services/'.$file);
    $platformImg = fn (string $file): string => asset('images/cloud-managed-services/'.$file);

    $platforms = [
        ['file' => 'Google-cloud.webp', 'alt' => 'Google Cloud'],
        ['file' => 'Microsoft-Azure.webp', 'alt' => 'Microsoft Azure'],
        ['file' => 'Amazon-Web-Services.webp', 'alt' => 'Amazon Web Services'],
        ['file' => 'Jio-Cloud.webp', 'alt' => 'Jio Cloud'],
        ['file' => 'Private-Cloud.webp', 'alt' => 'Private Cloud'],
    ];

    $capabilities = [
        ['icon' => 'fa-sitemap', 'title' => 'SAP Strategy & Roadmapping'],
        ['icon' => 'fa-right-left', 'title' => 'S/4HANA Migration & Conversion'],
        ['icon' => 'fa-cloud', 'title' => 'Cloud ERP Delivery (RISE & GROW)'],
        ['icon' => 'fa-code-branch', 'title' => 'Embedded AI & Intelligent Automation'],
        ['icon' => 'fa-chart-column', 'title' => 'Analytics & Real-Time Insights'],
        ['icon' => 'fa-shield-halved', 'title' => 'Security, Risk & Governance'],
    ];

    $heroChecks = [
        'Complete SAP modernization from assessment to cloud adoption',
        'Faster transformation through automation and proprietary accelerators',
        'Business outcomes driven by data‑led, AI‑supported execution',
    ];

    $deliverItems = [
        'SAP S/4HANA readiness assessment',
        'ERP modernization strategy',
        'Greenfield / Brownfield transformation planning',
        'Business case and ROI modeling',
        'IT landscape simplification',
        'SAP roadmap and architecture design',
    ];

    $aiValueItems = [
        'Automated discovery of process inefficiencies',
        'Pattern‑based custom code analysis',
        'Predictive estimation of transformation effort',
        'Data‑driven prioritization of change initiatives',
    ];

    $arcs = [
        [
            'n' => '01',
            'title' => 'Strategy & Vision',
            'text' => 'Align the organization on transformation direction before committing technology investment',
        ],
        [
            'n' => '02',
            'title' => 'Build the Case for Transformation',
            'text' => 'Quantify value, define business model changes and secure executive sponsorship',
        ],
        [
            'n' => '03',
            'title' => 'Transform the Business',
            'text' => 'Execute SAP implementation and process change in coordinated agile sprints',
        ],
        [
            'n' => '04',
            'title' => 'Unlock Value and Identify Innovations',
            'text' => 'Measure outcomes against KPIs, reinvent the business model, and fuel the next innovation cycle.',
        ],
    ];

    $deliveryScope = [
        'ECC to S/4HANA migration',
        'Migrating to Cloud Platforms: AWS, Azure, and Google Cloud',
        'SAP Business Technology Platform integration',
        'SAP system landscape transformation',
        'Enterprise integration architecture',
    ];

    $intelligentFeatures = [
        'Automated test execution and validation',
        'AI‑assisted configuration recommendations',
        'Migration quality checks using rule‑based intelligence',
        'Risk detection across transports and releases',
    ];

    $modules = [
        'Finance',
        'Procurement',
        'Manufacturing',
        'Supply Chain',
        'Asset Mgmt',
        'Projects',
        'Sales & Distribution',
    ];

    $stackPills = [
        'SAP BTP',
        'Data Lakehouse',
        'Streaming Pipelines',
        'Enterprise Knowledge Graphs',
    ];

    $appPills = [
        'Forecasting (Financial/Revenue)',
        'Working Capital',
        'Supply Risk',
        'Contract Risk',
        'Disruption Prediction',
    ];

    $opsSlides = [
        [
            'file' => 'Autonomous-SAP-Operations-and-AlOps-Dashboard-Img.webp',
            'alt' => 'Autonomous SAP Operations and AIOps dashboard',
        ],
        [
            'file' => 'Ready-to-Use-Innovation-Assets.webp',
            'alt' => 'Ready-to-use SAP innovation assets',
        ],
        [
            'file' => 'The-Partner-Built-for-Complex-Transformations.webp',
            'alt' => 'Partner built for complex SAP transformations',
        ],
    ];

    $industries = [
        [
            'icon' => 'fa-building',
            'title' => 'Project-Centric ERP',
            'sector' => 'Construction & Infrastructure',
            'items' => [
                'AI-driven project risk prediction',
                'Contract obligation intelligence',
                'Procurement optimisation',
                'Equipment predictive maintenance',
            ],
        ],
        [
            'icon' => 'fa-heart-pulse',
            'title' => 'Revenue Cycle Intelligence',
            'sector' => 'Healthcare',
            'items' => [
                'Revenue cycle optimization',
                'Intelligent claims automation',
                'HIPAA-aligned SAP configuration',
            ],
        ],
        [
            'icon' => 'fa-industry',
            'title' => 'Smart Factory Operations',
            'sector' => 'Manufacturing',
            'items' => [
                'Quality trend analysis',
                'Production optimization',
                'Supply continuity planning',
            ],
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Commodity Risk Analytics',
            'sector' => 'Energy',
            'items' => [
                'Commodity price forecasting',
                'Energy trading risk analytics',
                'Asset lifecycle optimisation',
                'AVEVA IoT–SAP PM integration',
            ],
        ],
    ];

    $copilots = [
        [
            'title' => 'PrimeERP Copilot',
            'text' => 'Natural‑language interface for SAP',
        ],
        [
            'title' => 'Contract Intelligence Engine',
            'text' => 'Automated contract risk extraction',
        ],
        [
            'title' => 'AI Finance Controller',
            'text' => 'Continuous transaction monitoring',
        ],
        [
            'title' => 'Supply Chain Risk Engine',
            'text' => 'Predictive disruption analysis',
        ],
    ];

    $models = [
        ['model' => 'Advisory', 'description' => 'SAP strategy and transformation roadmap'],
        ['model' => 'Implementation', 'description' => 'Full SAP S/4HANA transformation delivery'],
        ['model' => 'AI Augmentation', 'description' => 'AI and GenAI solutions layered on your SAP landscape'],
        ['model' => 'Managed Services', 'description' => 'Continuous AI-driven SAP operations'],
        ['model' => 'Co-Innovation', 'description' => 'Build custom AI enterprise platforms together'],
    ];

    $whyChoose = [
        ['icon' => 'fa-gears', 'title' => 'Deep SAP S/4HANA Technical Expertise'],
        ['icon' => 'fa-lightbulb', 'title' => 'Advanced AI & Generative AI Capabilities'],
        ['icon' => 'fa-industry', 'title' => 'Industry-Specific SAP Solutions'],
        ['icon' => 'fa-rocket', 'title' => 'Accelerators That Reduce Implementation Timelines by 30–40%'],
        ['icon' => 'fa-circle-check', 'title' => 'Proven Enterprise Track Record'],
        ['icon' => 'fa-globe', 'title' => 'Global Delivery Model'],
    ];

    $roadmapChecks = [
        'Prioritize the right SAP initiatives',
        'Quantify transformation benefits',
        'Reduce delivery risk',
        'Accelerate value realization',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    <link rel="preload" as="image" href="{{ $img('SAP-Services-Hero-Img.webp') }}">
    @vite(['resources/css/pages/sap-services.css'])
@endpush

@section('content')
    <div class="sap-page">
        {{-- Hero --}}
        <section
            class="sap-hero"
            aria-labelledby="sap-hero-title"
            style="--sap-hero-bg: url('{{ $img('SAP-Services-Hero-Img.webp') }}')"
        >
            <div class="site-shell sap-hero__inner">
                <div class="sap-hero__copy">
                    <p class="sap-badge">
                        <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                        SAP S/4HANA &amp; Transformation Services
                    </p>
                    <h1 id="sap-hero-title">
                        Transform Your Enterprise with Real-Time AI-Powered <span class="sap-accent">SAP S/4HANA</span>
                    </h1>
                    <p class="sap-hero__lede">
                        Modernize your digital core with SAP S/4HANA, RISE with SAP, and GROW with SAP, powered by AI, automation, and advanced analytics.
                    </p>
                    <ul class="sap-hero__checks">
                        @foreach ($heroChecks as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#sap-consult" class="sap-btn sap-btn--green">
                        Talk to an Expert
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </section>

        {{-- Cloud platforms --}}
        <section class="sap-section sap-section--tight" aria-labelledby="sap-platform-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-platform-title">Cloud Platform Proficiency</h2>
                </div>
                <div class="sap-platform-grid">
                    @foreach ($platforms as $platform)
                        <article class="sap-platform-card">
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

        {{-- Core capabilities --}}
        <section class="sap-section sap-section--soft" aria-labelledby="sap-cap-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <p class="sap-kicker">Core Capabilities</p>
                    <h2 id="sap-cap-title">What Powers Your SAP Success</h2>
                </div>
                <div class="sap-cap-grid" role="list">
                    @foreach ($capabilities as $item)
                        <article class="sap-cap-card" role="listitem">
                            <span class="sap-cap-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Transformation services --}}
        <section class="sap-section" aria-labelledby="sap-transform-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <p class="sap-kicker">From Legacy SAP to Intelligent ERP</p>
                    <h2 id="sap-transform-title">SAP Transformation Services</h2>
                    <p>
                        We help enterprises reimagine processes, modernize technology, and enable intelligence, ensuring SAP becomes a platform for continuous innovation rather than a system of record.
                    </p>
                </div>

                <div class="sap-split">
                    <div class="sap-split__media">
                        <h3>SAP Transformation Advisory</h3>
                        <div class="sap-split__images">
                            <img
                                src="{{ $img('Enterprise-Scale-Cloud-Migration.webp') }}"
                                alt="Enterprise-scale cloud migration"
                                width="960"
                                height="540"
                                loading="lazy"
                                decoding="async"
                            >
                            <img
                                src="{{ $img('SAP-Transformation-Services.webp') }}"
                                alt="SAP transformation services"
                                width="960"
                                height="540"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="sap-split__copy">
                        <h3>Designing the Right SAP Future</h3>
                        <p>Structured advisory and transformation planning are employed to align business objectives, SAP capabilities, and long-term scalability.</p>

                        <div class="sap-split__lists">
                            <div>
                                <h4>What We Deliver</h4>
                                <ul class="sap-list sap-list--arrow">
                                    @foreach ($deliverItems as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="sap-ai-box">
                                <h4>Where AI Adds Value</h4>
                                <p>We use AI to accelerate transformation:</p>
                                <ul class="sap-list sap-list--spark">
                                    @foreach ($aiValueItems as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- RISE with SAP --}}
        <section class="sap-section sap-section--soft" aria-labelledby="sap-rise-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-rise-title">RISE with SAP Implementation</h2>
                </div>
                <figure class="sap-figure">
                    <img
                        src="{{ $img('AI-Powered-Operations-and-Data-Platform.webp') }}"
                        alt="AI-powered operations and data platform for RISE with SAP"
                        width="1639"
                        height="1044"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="sap-cta-banner" aria-labelledby="sap-cta-title">
            <div class="site-shell sap-cta-banner__inner">
                <h2 id="sap-cta-title">Take the First Step Toward Smarter SAP Performance</h2>
                <p>Partner with a trusted SAP consulting team to drive secure, efficient, and measurable outcomes from strategy and migration to optimization and scale.</p>
                <a href="#sap-consult" class="sap-btn sap-btn--white">
                    Turn SAP Into Value
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Transformation framework --}}
        <section class="sap-section" aria-labelledby="sap-framework-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-framework-title">Business Transformation Framework</h2>
                    <p>IBNTech uses a structured process to make sure technology investments bring real, lasting business benefits, not just system updates.</p>
                </div>

                <h3 class="sap-subhead">The Four Transformation Arcs</h3>
                <div class="sap-arc-grid" role="list">
                    @foreach ($arcs as $arc)
                        <article class="sap-arc-card" role="listitem">
                            <span class="sap-arc-card__n" aria-hidden="true">{{ $arc['n'] }}</span>
                            <div>
                                <h3>
                                    <i class="fa-solid fa-star" aria-hidden="true"></i>
                                    {{ $arc['title'] }}
                                </h3>
                                <p>{{ $arc['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <figure class="sap-figure sap-figure--spaced">
                    <img
                        src="{{ $img('Customized-SAP-Outcomes-by-Sector.webp') }}"
                        alt="Customized SAP outcomes by sector"
                        width="1920"
                        height="1080"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Enterprise-scale cloud migration --}}
        <section class="sap-section sap-section--soft" aria-labelledby="sap-migrate-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-migrate-title">Enterprise‑Scale Cloud Migration</h2>
                    <p>We use RISE with SAP for big SAP changes, combining tech skills, industry know-how, and automation.</p>
                </div>

                <div class="sap-two-col">
                    <article class="sap-panel">
                        <h3>Delivery Scope</h3>
                        <ul class="sap-list sap-list--dot">
                            @foreach ($deliveryScope as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                    <article class="sap-panel sap-panel--navy">
                        <h3>Intelligent Delivery Features</h3>
                        <ul class="sap-list sap-list--hex">
                            @foreach ($intelligentFeatures as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>

                <h3 class="sap-subhead">Process &amp; Module Coverage</h3>
                <ul class="sap-pills" role="list">
                    @foreach ($modules as $module)
                        <li class="sap-pill" role="listitem">{{ $module }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- AIOps + data platform --}}
        <section class="sap-section" aria-labelledby="sap-ops-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-ops-title">Autonomous SAP Operations &amp; AIOps</h2>
                    <p>Proactive incident detection, automated root cause analysis, self-healing operations, and optimization for performance and cost.</p>
                </div>

                <div class="sap-ops">
                    <div class="sap-ops__copy">
                        <h3>SAP Data &amp; AI Platform</h3>

                        <h4>
                            <i class="fa-solid fa-bolt" aria-hidden="true"></i>
                            Stack
                        </h4>
                        <ul class="sap-pills sap-pills--wrap" role="list">
                            @foreach ($stackPills as $pill)
                                <li class="sap-pill sap-pill--navy" role="listitem">{{ $pill }}</li>
                            @endforeach
                        </ul>

                        <h4>
                            <i class="fa-solid fa-puzzle-piece" aria-hidden="true"></i>
                            Apps
                        </h4>
                        <ul class="sap-pills sap-pills--wrap" role="list">
                            @foreach ($appPills as $pill)
                                <li class="sap-pill sap-pill--green" role="listitem">{{ $pill }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div
                        class="sap-slider"
                        x-data="{ index: 0, total: {{ count($opsSlides) }} }"
                    >
                        <div class="sap-slider__viewport">
                            @foreach ($opsSlides as $i => $slide)
                                <figure
                                    class="sap-slider__slide"
                                    x-show="index === {{ $i }}"
                                    @if ($i !== 0) x-cloak @endif
                                >
                                    <img
                                        src="{{ $img($slide['file']) }}"
                                        alt="{{ $slide['alt'] }}"
                                        width="960"
                                        height="640"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </figure>
                            @endforeach
                        </div>
                        <div class="sap-slider__nav">
                            <button type="button" class="sap-slider__btn" @click="index = (index - 1 + total) % total" aria-label="Previous slide">
                                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="sap-slider__btn" @click="index = (index + 1) % total" aria-label="Next slide">
                                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Industry solutions --}}
        <section class="sap-section sap-section--soft" aria-labelledby="sap-industry-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <p class="sap-kicker">Industry Solutions</p>
                    <h2 id="sap-industry-title">Industry‑focused SAP Solutions</h2>
                    <p>Customized SAP Outcomes by Sector</p>
                </div>
                <div class="sap-industry-grid" role="list">
                    @foreach ($industries as $industry)
                        <article class="sap-industry-card" role="listitem">
                            <span class="sap-industry-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $industry['icon'] }}"></i>
                            </span>
                            <h3>{{ $industry['title'] }}</h3>
                            <p>{{ $industry['sector'] }}</p>
                            <ul class="sap-list sap-list--dot">
                                @foreach ($industry['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- AI copilots --}}
        <section class="sap-section" aria-labelledby="sap-ai-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-ai-title">AI Copilots &amp; Enterprise AI Value</h2>
                    <p>Ready‑to‑Use Innovation Assets</p>
                </div>
                <div class="sap-copilot-grid" role="list">
                    @foreach ($copilots as $item)
                        <article class="sap-copilot-card" role="listitem">
                            <span class="sap-copilot-card__icon" aria-hidden="true">
                                <i class="fa-solid fa-star"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Engagement models --}}
        <section class="sap-section sap-section--soft" aria-labelledby="sap-models-title">
            <div class="site-shell">
                <div class="sap-heading">
                    <h2 id="sap-models-title">Flexible Models for Every Enterprise</h2>
                    <p>We tailor our engagement to your needs — from focused advisory to long-term AI-driven managed services partnership.</p>
                </div>
                <div class="sap-table-wrap">
                    <table class="sap-table">
                        <caption class="sr-only">SAP engagement models</caption>
                        <thead>
                            <tr>
                                <th scope="col">Model</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $row)
                                <tr>
                                    <th scope="row">{{ $row['model'] }}</th>
                                    <td>{{ $row['description'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="sap-why" aria-labelledby="sap-why-title">
            <div class="site-shell">
                <div class="sap-heading sap-heading--light">
                    <p class="sap-kicker sap-kicker--light">Why Choose IBNTECH</p>
                    <h2 id="sap-why-title">The Partner Built for Complex Transformations</h2>
                    <p>We don't just implement SAP. We re-engineer business processes with AI at the center, delivering measurable outcomes, not just go-lives.</p>
                </div>
                <div class="sap-why-grid" role="list">
                    @foreach ($whyChoose as $item)
                        <article class="sap-why-card" role="listitem">
                            <span class="sap-why-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Roadmap + form --}}
        <section class="sap-section sap-section--soft" id="sap-consult" aria-labelledby="sap-roadmap-title">
            <div class="site-shell sap-consult">
                <div class="sap-consult__copy">
                    <h2 id="sap-roadmap-title">Request Your SAP Roadmap</h2>
                    <p>
                        Ready to build your Intelligent Enterprise? Work with SAP transformation specialists to define your modernization roadmap, migration plan, and AI adoption strategy.
                    </p>
                    <ul class="sap-hero__checks sap-consult__checks">
                        @foreach ($roadmapChecks as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="sap-consult__card" aria-labelledby="sap-form-title">
                    <h3 id="sap-form-title">Talk to Our SAP Experts</h3>
                    <p class="sap-consult__lede">Connect directly with our SAP transformation team</p>
                    <livewire:forms.contact-form
                        form-name="sap-services"
                        id-prefix="sap"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Share your requirements"
                        :message-rows="3"
                        submit-label="BOOK CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
