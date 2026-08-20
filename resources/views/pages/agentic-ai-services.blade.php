@php
    $img = fn (string $file): string => asset('images/agentic-ai-services/'.$file);

    $heroChecks = [
        'Enterprise‑secure agentic AI with built‑in governance and compliance',
        'Plug‑and‑play integration with existing IT ecosystems',
        'Scalable autonomous systems driving faster transformation',
    ];

    $supportItems = [
        ['icon' => 'fa-brain', 'tone' => 'violet', 'title' => 'AI Strategy'],
        ['icon' => 'fa-microchip', 'tone' => 'green', 'title' => 'Agentic AI'],
        ['icon' => 'fa-wand-magic-sparkles', 'tone' => 'sky', 'title' => 'Generative AI'],
        ['icon' => 'fa-bullseye', 'tone' => 'teal', 'title' => 'ML Engineering'],
        ['icon' => 'fa-shield-halved', 'tone' => 'navy', 'title' => 'AI Governance'],
        ['icon' => 'fa-server', 'tone' => 'slate', 'title' => 'AI Infrastructure'],
    ];

    $capabilities = [
        ['icon' => 'fa-sitemap', 'tone' => 'violet', 'title' => 'Autonomous reasoning and task planning'],
        ['icon' => 'fa-grip', 'tone' => 'green', 'title' => 'Intelligent tool usage and orchestration'],
        ['icon' => 'fa-diagram-project', 'tone' => 'sky', 'title' => 'Multi-agent collaboration frameworks'],
        ['icon' => 'fa-chart-line', 'tone' => 'teal', 'title' => 'Continuous learning and improvement'],
        ['icon' => 'fa-shield', 'tone' => 'navy', 'title' => 'Human-in-the-loop governance and control'],
    ];

    $collaboration = [
        [
            'icon' => 'fa-comments',
            'title' => 'Agent Communication',
            'text' => 'Seamless information exchange between agents',
        ],
        [
            'icon' => 'fa-share-nodes',
            'title' => 'Task Delegation',
            'text' => 'Intelligent distribution of workload',
        ],
        [
            'icon' => 'fa-database',
            'title' => 'Shared Context',
            'text' => 'Unified knowledge base access',
        ],
        [
            'icon' => 'fa-lightbulb',
            'title' => 'Collaborative Problem Solving',
            'text' => 'Combined intelligence for complex challenges',
        ],
    ];

    $useCases = [
        [
            'icon' => 'fa-cart-shopping',
            'tone' => 'green',
            'title' => 'Intelligent Procurement Agents',
            'text' => 'Autonomous vendor management, contract negotiation, and purchase optimization',
        ],
        [
            'icon' => 'fa-chart-line',
            'tone' => 'sky',
            'title' => 'AI Financial Analyst Agents',
            'text' => 'Advanced data analysis, market insights, and financial forecasting',
        ],
        [
            'icon' => 'fa-file-lines',
            'tone' => 'navy',
            'title' => 'Contract Review & Analysis',
            'text' => 'Automated contract processing, risk identification, and compliance checks',
        ],
        [
            'icon' => 'fa-headset',
            'tone' => 'teal',
            'title' => 'Autonomous Support Agents',
            'text' => 'Autonomous customer issue resolution with seamless escalation',
        ],
        [
            'icon' => 'fa-magnifying-glass',
            'tone' => 'violet',
            'title' => 'Research & Intelligence Assistants',
            'text' => 'Ongoing market research, competitor analysis, and trend spotting',
        ],
        [
            'icon' => 'fa-copy',
            'tone' => 'slate',
            'title' => 'Document Processing Agents',
            'text' => 'Intelligent document classification, extraction, and workflow automation',
        ],
    ];

    $industries = [
        [
            'icon' => 'fa-building-columns',
            'tone' => 'sky',
            'title' => 'Financial Services & Banking',
            'points' => [
                'AI Fraud detection systems',
                'Credit and risk modeling',
                'Trading intelligence and analysis',
                'Regulatory compliance automation',
            ],
        ],
        [
            'icon' => 'fa-heart-pulse',
            'tone' => 'rose',
            'title' => 'Healthcare & Life Sciences',
            'points' => [
                'AI clinical decision support',
                'Patient risk and prediction',
                'Diagnostic assistance',
                'Treatment optimization',
            ],
        ],
        [
            'icon' => 'fa-industry',
            'tone' => 'slate',
            'title' => 'Manufacturing & Industrial',
            'points' => [
                'Predictive equipment maintenance',
                'Quality assurance and prediction',
                'Supply chain optimization',
                'Process automation',
            ],
        ],
        [
            'icon' => 'fa-bag-shopping',
            'tone' => 'green',
            'title' => 'Retail & E-Commerce',
            'points' => [
                'AI Demand forecasting',
                'Customer behavior personalization',
                'Inventory management',
                'Dynamic Pricing intelligence',
            ],
        ],
    ];

    $closingBenefits = [
        ['icon' => 'fa-lock', 'text' => 'Transform workflows with autonomous AI agents'],
        ['icon' => 'fa-chart-area', 'text' => 'Reduce manual effort through intelligent process automation'],
        ['icon' => 'fa-gauge-high', 'text' => 'Improve decision accuracy with enterprise‑grade AI intelligence'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/agentic-ai-services.css'])
@endpush

@section('content')
    <div class="aais-page">
        {{-- Hero --}}
        <section
            class="aais-hero"
            aria-labelledby="aais-hero-title"
            style="--aais-hero-image: url('{{ $img('Agenitc-AI-Hero-IMG.webp') }}')"
        >
            <div class="site-shell aais-hero__inner">
                <div class="aais-hero__copy">
                    <span class="aais-badge aais-badge--on-dark">
                        <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
                        AI Transformation for the Modern Enterprise
                    </span>

                    <h1 id="aais-hero-title">
                        Next‑Generation <span class="aais-accent">Agentic AI</span> Technology for Enterprise Success
                    </h1>

                    <p class="aais-hero__lede">
                        We help organizations transform operations, decision-making, and customer experiences through enterprise-grade artificial intelligence solutions
                    </p>

                    <ul class="aais-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="aais-hero__actions">
                        <a href="#aais-consult" class="aais-btn aais-btn--light">
                            Start Your AI Journey
                            <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- How we support --}}
        <section class="aais-section" aria-labelledby="aais-support-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <h2 id="aais-support-title">
                        How We Support Your <span class="aais-accent">Business</span>
                    </h2>
                </div>

                <div class="aais-support-grid" role="list">
                    @foreach ($supportItems as $item)
                        <article class="aais-support-card" role="listitem">
                            <span class="aais-icon aais-icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Autonomous agents + architecture --}}
        <section class="aais-section aais-section--soft" aria-labelledby="aais-agents-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <span class="aais-badge">Agentic AI &amp; Autonomous Agents</span>
                    <h2 id="aais-agents-title">
                        Intelligent Autonomous AI Agents That <span class="aais-accent">Perform Complex Work</span>
                    </h2>
                    <p>We develop agentic AI that simplifies operations and accelerates productivity.</p>
                </div>

                <div class="aais-panel">
                    <h3>System Architecture</h3>
                    <p>
                        Our agentic AI connects users with intelligent agents powered by LLMs and enterprise data for continuous optimization
                    </p>
                    <img
                        src="{{ $img('agentic-ai.webp') }}"
                        alt="Agentic AI system architecture"
                        width="1024"
                        height="576"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Capabilities --}}
        <section class="aais-section" aria-labelledby="aais-capabilities-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <h2 id="aais-capabilities-title">Capabilities</h2>
                </div>

                <div class="aais-cap-grid" role="list">
                    @foreach ($capabilities as $item)
                        <article class="aais-cap-card" role="listitem">
                            <span class="aais-icon aais-icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Reference architecture --}}
        <section class="aais-section aais-section--tight" aria-label="AI agent reference architecture">
            <div class="site-shell">
                <div class="aais-figure">
                    <img
                        src="{{ $img('ai-agent-reference-architecture.webp') }}"
                        alt="AI Agent Reference Architecture"
                        width="1536"
                        height="864"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Agent evolution --}}
        <section class="aais-section" aria-labelledby="aais-evolution-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <h2 id="aais-evolution-title">
                        Agent Evolution: <span class="aais-accent">From 1.0 to 2.0</span>
                    </h2>
                    <p>
                        Our agents evolve from simple task-specific implementations to fully autonomous, multi-agent systems capable of managing entire business functions independently.
                    </p>
                </div>

                <div class="aais-figure">
                    <img
                        src="{{ $img('the-evolution-of-al-agents.webp') }}"
                        alt="The evolution of AI agents from 1.0 to 2.0"
                        width="1536"
                        height="864"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Multi-agent collaboration --}}
        <section class="aais-section aais-section--cream" aria-labelledby="aais-collab-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <h2 id="aais-collab-title">
                        Multi-Agent <span class="aais-accent">Collaboration</span>
                    </h2>
                    <p>
                        Multiple specialized agents work together in coordinated systems, each handling specific domains while maintaining communication and resource optimization.
                    </p>
                </div>

                <div class="aais-collab" role="list">
                    @foreach ($collaboration as $item)
                        <article class="aais-collab__item" role="listitem">
                            <span class="aais-collab__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="aais-cta-banner" aria-labelledby="aais-cta-deploy-title">
            <div class="site-shell aais-cta-banner__inner">
                <h2 id="aais-cta-deploy-title">Ready to Deploy Autonomous Agents?</h2>
                <p>Start your AI transformation with enterprise-grade agentic AI solutions</p>
                <a href="#" class="aais-btn aais-btn--light" data-contact-modal-trigger>
                    Schedule a Consultation
                    <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Enterprise use cases --}}
        <section class="aais-section" aria-labelledby="aais-usecases-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <h2 id="aais-usecases-title">
                        Enterprise <span class="aais-accent">Use Cases</span>
                    </h2>
                </div>

                <div class="aais-usecase-grid" role="list">
                    @foreach ($useCases as $item)
                        <article class="aais-usecase-card" role="listitem">
                            <span class="aais-icon aais-icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Example workflow --}}
        <section class="aais-section aais-section--soft" aria-labelledby="aais-workflow-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <h2 id="aais-workflow-title">
                        Example Workflow: <span class="aais-accent">Contract Review Agent</span>
                    </h2>
                </div>

                <div class="aais-figure">
                    <img
                        src="{{ $img('example-workflow-contract-review-agent.webp') }}"
                        alt="Example workflow for a contract review agent"
                        width="1536"
                        height="640"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="aais-section" aria-labelledby="aais-industries-title">
            <div class="site-shell">
                <div class="aais-heading">
                    <span class="aais-badge">Industry-Specific AI Solutions</span>
                    <h2 id="aais-industries-title">
                        AI Solutions for <span class="aais-accent">Key Industries</span>
                    </h2>
                    <p>
                        Specialized, industry-specific artificial intelligence solutions designed for your sector's unique competitive challenges, regulatory requirements, and business opportunities.
                    </p>
                </div>

                <div class="aais-industry-grid" role="list">
                    @foreach ($industries as $item)
                        <article class="aais-industry-card" role="listitem">
                            <header class="aais-industry-card__head">
                                <span class="aais-icon aais-icon--round aais-icon--{{ $item['tone'] }}" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <h3>{{ $item['title'] }}</h3>
                            </header>
                            <ul>
                                @foreach ($item['points'] as $point)
                                    <li>
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Closing CTA + form --}}
        <section class="aais-section aais-section--soft" id="aais-consult" aria-labelledby="aais-closing-title">
            <div class="site-shell aais-consult">
                <div class="aais-consult__copy">
                    <h2 id="aais-closing-title">
                        Take the First Step Toward Autonomous, AI‑Driven Performance
                    </h2>

                    <ul class="aais-benefit-list">
                        @foreach ($closingBenefits as $item)
                            <li>
                                <span class="aais-benefit-list__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <span>{{ $item['text'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="aais-highlight">
                        <h3>Design AI That Works Like a Digital Workforce</h3>
                        <p>Empower your organization with autonomous intelligence built for scale, security, and speed.</p>
                        <a href="#aais-consult-form">Get started now</a>
                    </div>
                </div>

                <aside class="aais-consult__card" id="aais-consult-form" aria-labelledby="aais-consult-form-title">
                    <h3 id="aais-consult-form-title">Talk to Our AI Experts</h3>

                    <livewire:forms.contact-form
                        form-name="agentic-ai-services"
                        id-prefix="aais"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Let’s discuss your service"
                        submit-label="BOOK CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
