@php
    $img = fn (string $file): string => asset('images/ai-consulting-services/'.$file);

    $heroChecks = [
        'End-to-end AI strategy and implementation',
        'Accelerate adoption with clear build‑vs‑buy‑vs‑partner guidance',
        'Measurable ROI and business impact',
    ];

    $serviceCards = [
        ['icon' => 'fa-brain', 'title' => 'AI Strategy', 'tone' => 'violet'],
        ['icon' => 'fa-microchip', 'title' => 'Agentic AI', 'tone' => 'green'],
        ['icon' => 'fa-wand-magic-sparkles', 'title' => 'Generative AI', 'tone' => 'sky'],
        ['icon' => 'fa-gears', 'title' => 'ML Engineering', 'tone' => 'teal'],
        ['icon' => 'fa-shield-halved', 'title' => 'AI Governance', 'tone' => 'blue'],
        ['icon' => 'fa-server', 'title' => 'AI Infrastructure', 'tone' => 'mint'],
    ];

    $keyAreas = [
        'AI maturity assessment',
        'Enterprise AI strategy development',
        'AI operating model design',
        'AI governance and risk framework',
        'AI investment roadmap',
        'AI talent and capability planning',
    ];

    $deliverables = [
        '3-5-year AI Roadmap',
        'AI Governance Model',
        'Center of Excellence Structure',
        'Platform Architecture Blueprint',
    ];

    $approachSteps = [
        [
            'num' => '01',
            'title' => 'Business Capability Mapping',
            'text' => 'Align AI initiatives with core business needs. Map opportunities across Customer & Marketing, Operations & Supply Chain, Product & R&D, IT & Productivity and Risk & Finance.',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7m0 0L9.553 4.553A1 1 0 009 4.118v.004"></path>',
        ],
        [
            'num' => '02',
            'title' => 'AI Opportunity Funnel',
            'text' => 'Move from abstract ideas to impactful solutions through structured filtration: Ideation → Screening → Validation → Scaling.',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>',
        ],
        [
            'num' => '03',
            'title' => 'Hybrid Platform & Use-Case Strategy',
            'text' => 'Combine foundational AI Platform with targeted Use Cases for immediate Quick Wins supported by scalable, long-term technical foundation.',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>',
        ],
        [
            'num' => '04',
            'title' => 'Build vs. Buy vs. Partner',
            'text' => 'Choose the right execution strategy for every project: Custom in-house Build, proven third-party Buy, or strategic Partner alliances.',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>',
        ],
        [
            'num' => '05',
            'title' => 'AI Portfolio Prioritization',
            'text' => 'Balance your portfolio across Quick Wins, Transformative Bets, Long-Term Investments, and Learning initiatives for maximum ROI.',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>',
        ],
    ];

    $discoverySteps = [
        [
            'num' => '01',
            'title' => 'Business Process Analysis',
            'text' => 'We map your existing workflows to identify manual bottlenecks ripe for automation.',
            'icon' => 'fa-gears',
            'tone' => 'navy',
        ],
        [
            'num' => '02',
            'title' => 'Data Availability Assessment',
            'text' => 'We audit your internal data to ensure it is clean and sufficient for training AI models.',
            'icon' => 'fa-database',
            'tone' => 'green',
        ],
        [
            'num' => '03',
            'title' => 'AI Feasibility Evaluation',
            'text' => 'We determine if the current state of technology (LLMs, Computer Vision, etc.) can realistically solve the identified problem.',
            'icon' => 'fa-microchip',
            'tone' => 'navy',
        ],
        [
            'num' => '04',
            'title' => 'Value Potential Modeling',
            'text' => 'We calculate the expected ROI, cost savings, or revenue growth for each specific use case.',
            'icon' => 'fa-chart-column',
            'tone' => 'green',
        ],
        [
            'num' => '05',
            'title' => 'Primary Output',
            'text' => 'A Prioritized Backlog of Build-Ready Use Cases & Business Case Analysis.',
            'icon' => 'fa-clipboard-check',
            'tone' => 'navy',
        ],
    ];

    $governanceItems = [
        ['icon' => 'fa-file-lines', 'text' => 'AI policy and governance frameworks'],
        ['icon' => 'fa-rotate', 'text' => 'Continuous model performance monitoring'],
        ['icon' => 'fa-scale-balanced', 'text' => 'Fairness and bias evaluation'],
        ['icon' => 'fa-shield-halved', 'text' => 'Model transparency and explainability'],
        ['icon' => 'fa-circle-check', 'text' => 'Auditability and traceability'],
        ['icon' => 'fa-shield', 'text' => 'Integrated compliance controls'],
    ];

    $complianceItems = [
        'Data protection and privacy laws',
        'Model risk and lifecycle management',
        'Ethical and Responsible AI standards',
    ];

    $resultAreas = [
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'Financial Services',
            'tone' => 'green',
            'points' => [
                'AI anomaly detection and fraud prevention',
                'Credit risk and lending intelligence',
            ],
        ],
        [
            'icon' => 'fa-cubes',
            'title' => 'Supply Chain & Logistics',
            'tone' => 'navy',
            'points' => [
                'Demand forecasting and planning',
                'Predictive equipment maintenance',
            ],
        ],
        [
            'icon' => 'fa-cart-shopping',
            'title' => 'Procurement & Sourcing',
            'tone' => 'green',
            'points' => [
                'AI contract analysis and intelligence',
                'Supplier risk and performance analytics',
            ],
        ],
        [
            'icon' => 'fa-users',
            'title' => 'Customer Experience',
            'tone' => 'navy',
            'points' => [
                'Customer churn and retention prediction',
                'AI-powered personalization engines',
            ],
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Compliance & Risk Management',
            'tone' => 'green',
            'points' => [
                'Credit and operational risk modeling',
                'Regulatory compliance automation',
            ],
        ],
        [
            'icon' => 'fa-industry',
            'title' => 'Operations & Manufacturing',
            'tone' => 'navy',
            'points' => [
                'Quality prediction and defect detection',
                'AI process optimization and efficiency',
            ],
        ],
    ];

    $engagementModels = [
        ['icon' => 'fa-chess-knight', 'title' => 'AI Advisory', 'text' => 'Strategic guidance, assessments, and AI roadmaps', 'tone' => 'navy'],
        ['icon' => 'fa-screwdriver-wrench', 'title' => 'AI Managed Services', 'text' => 'Ongoing monitoring, optimization, and support', 'tone' => 'navy'],
        ['icon' => 'fa-rocket', 'title' => 'AI Pilot', 'text' => 'Rapid prototyping and proof-of-concept builds', 'tone' => 'green'],
        ['icon' => 'fa-diagram-project', 'title' => 'AI Applications', 'text' => 'Deployment of production-grade AI systems', 'tone' => 'green'],
        ['icon' => 'fa-microchip', 'title' => 'AI Platform', 'text' => 'Development of scalable enterprise AI foundations', 'tone' => 'navy'],
    ];

    $assessmentBenefits = [
        ['icon' => 'fa-lock', 'text' => 'Unlock enterprise AI with expert guidance.'],
        ['icon' => 'fa-layer-group', 'text' => 'Get a scalable AI roadmap for your goals.'],
        ['icon' => 'fa-gauge-high', 'text' => 'Accelerate adoption with build‑vs‑buy clarity.'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/ai-consulting-services.css'])
@endpush

@section('content')
    <div class="aic-page">
        {{-- Hero --}}
        <section class="aic-hero" aria-labelledby="aic-hero-title">
            <div class="site-shell aic-hero__inner">
                <div class="aic-hero__copy">
                    <span class="aic-badge">
                        <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                        AI Consulting Platform
                    </span>
                    <h1 id="aic-hero-title">
                        <span class="aic-accent">AI Consulting Services</span> for Smart Business Transformation
                    </h1>
                    <p class="aic-hero__lede">
                        We deliver secure, custom AI consulting services that transform operations, enhance decision-making, and drive real business ROI.
                    </p>
                    <ul class="aic-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="aic-hero__actions">
                        <a href="#aic-consult" class="aic-btn aic-btn--light" data-contact-modal-trigger>
                            Start Your AI Journey
                            <i class="fa-solid fa-circle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="aic-hero__media" aria-hidden="true">
                    <img
                        src="{{ $img('hero-visual.webp') }}"
                        alt=""
                        width="880"
                        height="480"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Everything we do --}}
        <section class="aic-section" aria-labelledby="aic-services-title">
            <div class="site-shell">
                <div class="aic-heading">
                    <h2 id="aic-services-title">Everything We Do to Help Your <span class="aic-accent">Business</span></h2>
                </div>
                <div class="aic-service-grid" role="list">
                    @foreach ($serviceCards as $card)
                        <article class="aic-service-card aic-service-card--{{ $card['tone'] }}" role="listitem">
                            <span class="aic-service-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </span>
                            <h3>{{ $card['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- End-to-end strategy --}}
        <section class="aic-section aic-section--soft" aria-labelledby="aic-strategy-title">
            <div class="site-shell">
                <div class="aic-heading">
                    <h2 id="aic-strategy-title">
                        End-to- End Artificial Intelligence (AI) and <span class="aic-accent">Business Strategy</span>
                    </h2>
                    <p>We guide you through every stage of your AI journey, helping you make smart decisions and achieve successful organization-wide adoption.</p>
                </div>

                <div class="aic-roadmap">
                    <h3>AI Strategy &amp; Transformation Roadmap</h3>
                    <p class="aic-roadmap__lede">
                        Successful AI transformation begins with a strategic, data-driven approach aligned with business priorities, organizational capabilities and market opportunities.
                    </p>
                    <div class="aic-roadmap__cols">
                        <div>
                            <h4>Key Areas</h4>
                            <ul class="aic-dot-list">
                                @foreach ($keyAreas as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h4>What We Deliver</h4>
                            <ul class="aic-pill-list">
                                @foreach ($deliverables as $item)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="aic-approach">
                    <div class="aic-heading aic-heading--left">
                        <h3>Our Strategic Approach to Enterprise AI</h3>
                        <p>We move your organization from AI Ambition to AI Impact by following a proven, five-step method built to deliver tangible business value.</p>
                    </div>
                    <div class="aic-steps">
                        @foreach ($approachSteps as $step)
                            <article class="aic-step">
                                <div class="aic-step__badge">
                                    <span class="aic-step__num">{{ $step['num'] }}</span>
                                    <svg class="aic-step__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        {!! $step['icon'] !!}
                                    </svg>
                                </div>
                                <div class="aic-step__body">
                                    <h4>{{ $step['title'] }}</h4>
                                    <p>{{ $step['text'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Use case discovery --}}
        <section class="aic-section" aria-labelledby="aic-discovery-title">
            <div class="site-shell">
                <div class="aic-heading">
                    <h2 id="aic-discovery-title">High-Impact AI<span class="aic-accent"> Use Case Discovery</span></h2>
                    <p>Find your billion-dollar AI opportunities through a structured 5-step discovery process.</p>
                </div>

                <figure class="aic-figure">
                    <img
                        src="{{ $img('High-Impact-AI-Use-Case-Discovery.webp') }}"
                        alt="High-Impact AI Use Case Discovery: five-step discovery process from business process analysis through prioritized use-case backlog"
                        width="1640"
                        height="780"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>

                <div class="sr-only">
                    <ol>
                        @foreach ($discoverySteps as $step)
                            <li>
                                <strong>{{ $step['title'] }}</strong>
                                {{ $step['text'] }}
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </section>

        {{-- CTA band --}}
        <section class="aic-cta-band" aria-labelledby="aic-cta-title">
            <div class="site-shell aic-cta-band__inner">
                <h2 id="aic-cta-title">Start your AI journey with the right model</h2>
                <p>Let’s discuss how AI can drive measurable business value for your organization. Our team is ready to help you leverage AI to achieve measurable business value.</p>
                <a href="#aic-consult" class="aic-btn aic-btn--light" data-contact-modal-trigger>
                    Talk to Us
                    <i class="fa-solid fa-circle-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Governance --}}
        <section class="aic-section" aria-labelledby="aic-gov-title">
            <div class="site-shell">
                <div class="aic-heading">
                    <h2 id="aic-gov-title">AI Governance, <span class="aic-accent">Security &amp; Compliance</span></h2>
                    <p>Build trust and accountability into every AI initiative with a strong governance foundation.</p>
                </div>

                <div class="aic-gov-grid">
                    <article class="aic-gov-card aic-gov-card--light">
                        <div class="aic-gov-card__head">
                            <span class="aic-gov-card__icon" aria-hidden="true">
                                <i class="fa-solid fa-shield-halved"></i>
                            </span>
                            <h3>Governance Capabilities</h3>
                        </div>
                        <ul class="aic-icon-list">
                            @foreach ($governanceItems as $item)
                                <li>
                                    <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                                    <span>{{ $item['text'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="aic-gov-card aic-gov-card--dark">
                        <div class="aic-gov-card__head">
                            <span class="aic-gov-card__icon" aria-hidden="true">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <h3>Compliance Focus Areas</h3>
                        </div>
                        <ul class="aic-pill-list aic-pill-list--dark">
                            @foreach ($complianceItems as $item)
                                <li>
                                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        {{-- Proven results --}}
        <section class="aic-section aic-section--soft" aria-labelledby="aic-results-title">
            <div class="site-shell">
                <div class="aic-heading">
                    <h2 id="aic-results-title">Proven Areas of <span class="aic-accent">Real Results</span></h2>
                    <p>The best AI development platform where industry-leading standards meet innovative solutions.</p>
                </div>
                <div class="aic-results-grid" role="list">
                    @foreach ($resultAreas as $area)
                        <article class="aic-result-card" role="listitem">
                            <span class="aic-result-card__icon aic-result-card__icon--{{ $area['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $area['icon'] }}"></i>
                            </span>
                            <h3>{{ $area['title'] }}</h3>
                            <ul class="aic-dot-list">
                                @foreach ($area['points'] as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Engagement models --}}
        <section class="aic-section" aria-labelledby="aic-engage-title">
            <div class="site-shell">
                <div class="aic-heading">
                    <h2 id="aic-engage-title">Engagement <span class="aic-accent">Models</span></h2>
                    <p>Flexible options customized to support your AI initiatives at every stage.</p>
                </div>

                <figure class="aic-figure">
                    <img
                        src="{{ $img('Engagement-Models.webp') }}"
                        alt="Engagement Models: AI Advisory, AI Managed Services, AI Applications, AI Platform, and AI Pilot"
                        width="1560"
                        height="720"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>

                <div class="sr-only">
                    <ul>
                        @foreach ($engagementModels as $model)
                            <li>
                                <strong>{{ $model['title'] }}</strong>
                                {{ $model['text'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Assessment + form --}}
        <section class="aic-section aic-section--soft" id="aic-consult" aria-labelledby="aic-assess-title">
            <div class="site-shell aic-consult">
                <div class="aic-consult__copy">
                    <h2 id="aic-assess-title">Schedule a Complimentary AI Strategy &amp; Transformation Assessment</h2>
                    <ul class="aic-benefit-list">
                        @foreach ($assessmentBenefits as $item)
                            <li>
                                <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                                <span>{{ $item['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="aic-consult__note">
                        <h3>Take the First Step Toward Smarter, AI-Driven Performance</h3>
                        <p>Reliable AI consulting that improves efficiency, intelligence and business outcomes.</p>
                        <a href="#aic-consult-form">Let’s discuss your AI goals</a>
                    </div>
                </div>

                <aside class="aic-consult__card" id="aic-consult-form" aria-labelledby="aic-form-title">
                    <h3 id="aic-form-title">Talk to Our AI Experts</h3>
                    <livewire:forms.contact-form
                        form-name="ai-consulting-services"
                        id-prefix="aic"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Let's discuss your AI goals"
                        submit-label="BOOK CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
