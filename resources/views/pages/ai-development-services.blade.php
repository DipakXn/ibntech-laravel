@php
    $img = fn (string $file): string => asset('images/ai-development-services/'.$file);

    $heroChecks = [
        'End‑to‑end enterprise AI strategy and execution',
        'Accelerated adoption with clear build‑vs‑buy guidance',
        'Measurable ROI and real business impact',
    ];

    $foundations = [
        ['icon' => 'fa-brain', 'tone' => 'purple', 'title' => 'AI Strategy'],
        ['icon' => 'fa-microchip', 'tone' => 'green', 'title' => 'Agentic AI'],
        ['icon' => 'fa-wand-magic-sparkles', 'tone' => 'purple', 'title' => 'Generative AI'],
        ['icon' => 'fa-gears', 'tone' => 'green', 'title' => 'ML Engineering'],
        ['icon' => 'fa-shield-halved', 'tone' => 'purple', 'title' => 'AI Governance'],
        ['icon' => 'fa-server', 'tone' => 'green', 'title' => 'AI Infrastructure'],
    ];

    $serviceCards = [
        ['icon' => 'fa-lightbulb', 'tone' => 'navy', 'title' => 'Cognitive Intelligence'],
        ['icon' => 'fa-gears', 'tone' => 'green', 'title' => 'Intelligent Architecture'],
        ['icon' => 'fa-cloud', 'tone' => 'navy', 'title' => 'Cloud & On‑Prem AI Platforms'],
    ];

    $enterpriseApps = [
        ['icon' => 'fa-comments', 'text' => 'Intelligent enterprise knowledge assistants'],
        ['icon' => 'fa-file-lines', 'text' => 'AI-powered document intelligence systems'],
        ['icon' => 'fa-magnifying-glass', 'text' => 'Smart contract analysis and extraction'],
        ['icon' => 'fa-database', 'text' => 'Intelligent research and analysis assistants'],
        ['icon' => 'fa-user-check', 'text' => 'AI customer support and success copilots'],
    ];

    $coreTechnologies = [
        'Advanced Large Language Models (LLMs)',
        'Retrieval Augmented Generation (RAG) Systems',
        'Vector Databases and Embeddings',
        'Knowledge Graphs and Semantic Networks',
        'Fine-tuned Prompt Engineering',
    ];

    $dataSources = [
        'ERP Systems',
        'CRM Systems',
        'IoT Sensors',
        'Financial Systems',
        'Customer Interactions',
        'Documents & Contracts',
    ];

    $architectureLayers = [
        [
            'icon' => 'fa-database',
            'title' => 'Data Layer',
            'capabilities' => ['Data Lakehouse', 'Streaming pipelines', 'Real-time ingestion', 'Data governance'],
            'technologies' => 'Snowflake, Databricks, Kafka, Delta Lake',
        ],
        [
            'icon' => 'fa-share-nodes',
            'title' => 'Knowledge Layer',
            'capabilities' => ['Vector databases', 'Graph databases', 'Semantic search', 'Knowledge structuring'],
            'technologies' => 'Pinecone, Weaviate, Neo4j',
        ],
        [
            'icon' => 'fa-brain',
            'title' => 'AI Model Layer',
            'capabilities' => ['Machine learning', 'Deep learning', 'Large language models', 'Computer vision'],
            'technologies' => 'PyTorch, TensorFlow, XGBoost, Transformers',
        ],
        [
            'icon' => 'fa-diagram-project',
            'title' => 'Agent Orchestration',
            'capabilities' => ['Tool usage', 'Memory systems', 'Task planning', 'Multi-agent collaboration'],
            'technologies' => 'LangChain, AutoGen, CrewAI, Semantic Kernel',
        ],
        [
            'icon' => 'fa-chart-column',
            'title' => 'Application Layer',
            'capabilities' => ['AI copilots', 'Decision intelligence', 'Analytics dashboards', 'Autonomous operations'],
            'technologies' => 'Custom enterprise applications',
        ],
    ];

    $devCapabilities = [
        ['icon' => 'fa-brain', 'title' => 'Model Training'],
        ['icon' => 'fa-sliders', 'title' => 'Fine-tuning'],
        ['icon' => 'fa-code', 'title' => 'AI App Development'],
        ['icon' => 'fa-plug', 'title' => 'API Integration'],
        ['icon' => 'fa-clock', 'title' => 'Model Monitoring'],
    ];

    $mlopsStages = [
        ['num' => '1', 'tone' => 'blue', 'icon' => 'fa-database', 'title' => 'Data Ingestion & Validation'],
        ['num' => '2', 'tone' => 'green', 'icon' => 'fa-wrench', 'title' => 'Feature Engineering'],
        ['num' => '3', 'tone' => 'navy', 'icon' => 'fa-brain', 'title' => 'Model Training & Selection'],
        ['num' => '4', 'tone' => 'teal', 'icon' => 'fa-circle-check', 'title' => 'Model Evaluation & Testing'],
        ['num' => '5', 'tone' => 'orange', 'icon' => 'fa-rocket', 'title' => 'Model Deployment & Serving'],
        ['num' => '6', 'tone' => 'purple', 'icon' => 'fa-arrow-trend-up', 'title' => 'Monitoring & Improvement'],
    ];

    $infraCards = [
        [
            'tone' => 'green',
            'title' => 'AI/ML Infrastructure Design Principles',
            'text' => 'MLOps integration, cost optimization, availability, high performance, data management, and regulatory compliance built into every deployment.',
            'tags' => [],
            'footer' => null,
        ],
        [
            'tone' => 'blue',
            'title' => 'Cloud GPU & Compute Infrastructure',
            'text' => 'High-performance GPU clusters and cloud compute enabling large-scale model training, fine-tuning, and real-time inference.',
            'tags' => ['AWS', 'Azure', 'Google Cloud', 'GPU Clusters'],
            'footer' => null,
        ],
        [
            'tone' => 'navy',
            'title' => 'Enterprise AI Platform Stack',
            'text' => 'Full-stack enterprise AI infrastructure — from GPU networking and virtualization drivers through cluster management, AI SDKs, and production application software.',
            'tags' => [],
            'footer' => ['label' => 'AWS MLOps Pipeline:', 'text' => 'SageMaker, Feature Store, Lambda'],
        ],
    ];

    $infraComponents = [
        'GPU clusters & distributed training',
        'Model serving infrastructure',
        'High-performance storage systems',
    ];

    $designPrinciples = [
        'MLOps integration by default',
        'Hardware acceleration & optimization',
        'Regulatory compliance & data protection',
    ];

    $platforms = [
        ['file' => 'Amazon-Web-Services.webp', 'alt' => 'Amazon Web Services'],
        ['file' => 'Microsoft-Azure.webp', 'alt' => 'Microsoft Azure'],
        ['file' => 'Google-cloud.webp', 'alt' => 'Google Cloud'],
        ['file' => 'nvidia-logo-vert-blk_thmb.webp', 'alt' => 'NVIDIA'],
    ];

    $industries = [
        [
            'icon' => 'fa-building-columns',
            'title' => 'Financial Services & Banking',
            'items' => ['AI Fraud detection', 'Credit and Risk modeling', 'Trading intelligence', 'Regulatory compliance'],
        ],
        [
            'icon' => 'fa-heart-pulse',
            'title' => 'Healthcare & Life Sciences',
            'items' => ['Clinical Decision Support', 'Patient Risk Prediction', 'Diagnostic Assistance', 'Treatment Optimization'],
        ],
        [
            'icon' => 'fa-industry',
            'title' => 'Manufacturing & Industrial',
            'items' => ['Predictive Maintenance', 'Quality Assurance AI', 'Supply Chain Optimization', 'Process Automation'],
        ],
        [
            'icon' => 'fa-cart-shopping',
            'title' => 'Retail & E-Commerce',
            'items' => ['AI Demand Forecasting', 'Customer Personalization', 'Inventory Intelligence', 'Dynamic Pricing'],
        ],
    ];

    $roadmapChecks = [
        'Define a scalable, enterprise‑ready AI roadmap',
        'Identify high‑impact AI use cases with clear ROI',
        'Gain build‑vs‑buy clarity across GenAI, Agentic AI, and ML',
        'Reduce risk with production‑ready architecture and governance',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/ai-development-services.css'])
@endpush

@section('content')
    <div class="aidev-page">
        {{-- Hero --}}
        <section
            class="aidev-hero"
            aria-labelledby="aidev-hero-title"
            style="--aidev-hero-image: url('{{ $img('ai-development-bg-img.webp') }}')"
        >
            <div class="site-shell aidev-hero__inner">
                <div class="aidev-hero__copy">
                    <span class="aidev-badge aidev-badge--hero">
                        <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                        Enterprise AI Transformation
                    </span>

                    <h1 id="aidev-hero-title">
                        <span class="aidev-accent">AI Development</span> Solutions for Scalable Business Transformation
                    </h1>

                    <p class="aidev-hero__lede">
                        We help organizations transform operations, decision-making, and customer experiences through enterprise-grade artificial intelligence solutions
                    </p>

                    <ul class="aidev-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="aidev-hero__actions">
                        <a href="#aidev-consult" class="aidev-btn aidev-btn--light">
                            Start Your AI Journey
                            <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Foundations --}}
        <section class="aidev-section" aria-labelledby="aidev-foundations-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <h2 id="aidev-foundations-title">
                        The Foundations of Your <span class="aidev-accent">AI Success</span>
                    </h2>
                </div>

                <div class="aidev-foundations" role="list">
                    @foreach ($foundations as $item)
                        <article class="aidev-foundation-card" role="listitem">
                            <span class="aidev-foundation-card__icon aidev-foundation-card__icon--{{ $item['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- AI Development Services --}}
        <section class="aidev-section aidev-section--soft" aria-labelledby="aidev-services-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <h2 id="aidev-services-title">
                        <span class="aidev-accent">AI Development</span> Services
                    </h2>
                    <p>We help your company from start to finish. First, we plan. Then we build. We train your team and keep everything working great.</p>
                </div>

                <div class="aidev-service-grid" role="list">
                    @foreach ($serviceCards as $card)
                        <article class="aidev-service-card" role="listitem">
                            <span class="aidev-service-card__icon aidev-service-card__icon--{{ $card['tone'] }}" aria-hidden="true">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </span>
                            <h3>{{ $card['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Generative AI & LLMs --}}
        <section class="aidev-section" aria-labelledby="aidev-genai-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <span class="aidev-badge">Generative AI &amp; LLMs</span>
                    <h2 id="aidev-genai-title">
                        Production-Grade <span class="aidev-accent">Generative AI Applications</span>
                    </h2>
                    <p>
                        We architect and build production-grade generative AI applications, leveraging advanced large language models, retrieval-augmented generation (RAG), vector databases, and knowledge graphs to deliver intelligent enterprise solutions.
                    </p>
                    <p>
                        Our generative AI applications integrate seamlessly with your existing enterprise systems while maintaining security, data privacy, compliance, and unlimited scalability for mission-critical deployments.
                    </p>
                </div>

                <div class="aidev-genai-panel">
                    <div class="aidev-genai-col">
                        <h3>Enterprise Applications</h3>
                        <ul class="aidev-icon-list">
                            @foreach ($enterpriseApps as $app)
                                <li>
                                    <span class="aidev-icon-list__icon" aria-hidden="true">
                                        <i class="fa-solid {{ $app['icon'] }}"></i>
                                    </span>
                                    <span>{{ $app['text'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="aidev-genai-col">
                        <h3>Core Technologies</h3>
                        <ul class="aidev-dot-list">
                            @foreach ($coreTechnologies as $tech)
                                <li>{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- RAG Workflow --}}
        <section class="aidev-section aidev-section--soft" aria-labelledby="aidev-rag-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <h2 id="aidev-rag-title">Retrieval-Augmented Generation (RAG) Workflow</h2>
                </div>
                <figure class="aidev-figure">
                    <img
                        src="{{ $img('RAG-img.webp') }}"
                        alt="Retrieval-Augmented Generation (RAG) Workflow"
                        width="1342"
                        height="811"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="aidev-cta-band" aria-labelledby="aidev-cta-title">
            <div class="site-shell aidev-cta-band__inner">
                <p class="aidev-cta-band__eyebrow">Ready to build?</p>
                <h2 id="aidev-cta-title">Let’s design your enterprise AI Platform</h2>
                <p>
                    Talk to our AI architects and get a customized plan Customized to your data, your workflow, and your scale from strategy to production.
                </p>
                <a href="#aidev-consult" class="aidev-link-cta">
                    Talk to Us
                    <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </section>

        {{-- Reference Platform / Architecture --}}
        <section class="aidev-section" aria-labelledby="aidev-arch-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <span class="aidev-badge">Reference Platform</span>
                    <h2 id="aidev-arch-title">
                        Modern Enterprise <span class="aidev-accent">AI Architecture</span>
                    </h2>
                    <p>
                        A layered, scalable platform integrating your existing enterprise data sources through autonomous AI applications, each layer independently scalable and production ready.
                    </p>
                </div>

                <div class="aidev-sources">
                    <h3>Enterprise Data Sources</h3>
                    <div class="aidev-sources__grid" role="list">
                        @foreach ($dataSources as $source)
                            <div class="aidev-sources__item" role="listitem">{{ $source }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="aidev-layers">
                    @foreach ($architectureLayers as $layer)
                        <article class="aidev-layer-card">
                            <div class="aidev-layer-card__head">
                                <span class="aidev-layer-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $layer['icon'] }}"></i>
                                </span>
                                <h3>{{ $layer['title'] }}</h3>
                            </div>
                            <div class="aidev-layer-card__body">
                                <div>
                                    <h4>Capabilities</h4>
                                    <ul class="aidev-dot-list">
                                        @foreach ($layer['capabilities'] as $capability)
                                            <li>{{ $capability }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h4>Technologies</h4>
                                    <p class="aidev-tech-chip">{{ $layer['technologies'] }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Architecture diagram --}}
        <section class="aidev-section aidev-section--soft" aria-labelledby="aidev-arch-diagram-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <h2 id="aidev-arch-diagram-title">Modern Enterprise AI System Architecture</h2>
                </div>
                <figure class="aidev-figure">
                    <img
                        src="{{ $img('Enterprise-Ai-Architecture.webp') }}"
                        alt="Modern Enterprise AI System Architecture"
                        width="1660"
                        height="1031"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- AI Engineering --}}
        <section class="aidev-section" aria-labelledby="aidev-eng-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <span class="aidev-badge">AI Engineering &amp; Development</span>
                    <h2 id="aidev-eng-title">
                        Production-Grade <span class="aidev-accent">Generative AI Systems</span> Built for Scale
                    </h2>
                    <p>
                        We design scalable AI systems using modern MLOps and LLMOps frameworks from initial model training through continuous production monitoring and optimization.
                    </p>
                </div>

                <div class="aidev-dev-panel">
                    <h3>Development Capabilities</h3>
                    <div class="aidev-dev-grid" role="list">
                        @foreach ($devCapabilities as $item)
                            <article class="aidev-dev-card" role="listitem">
                                <span class="aidev-dev-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <h4>{{ $item['title'] }}</h4>
                            </article>
                        @endforeach
                    </div>
                </div>

                <figure class="aidev-figure aidev-figure--spaced">
                    <img
                        src="{{ $img('AI-Engineering-and-Development.webp') }}"
                        alt="Machine Learning Engineering"
                        width="1536"
                        height="1024"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>

                <div class="aidev-heading aidev-heading--tight">
                    <h3>MLOps Pipeline Stages</h3>
                </div>
                <div class="aidev-mlops-grid" role="list">
                    @foreach ($mlopsStages as $stage)
                        <article class="aidev-mlops-card" role="listitem">
                            <div class="aidev-mlops-card__top">
                                <span class="aidev-mlops-card__num aidev-mlops-card__num--{{ $stage['tone'] }}">{{ $stage['num'] }}</span>
                                <h4>{{ $stage['title'] }}</h4>
                            </div>
                            <span class="aidev-mlops-card__icon" aria-hidden="true">
                                <i class="fa-solid {{ $stage['icon'] }}"></i>
                            </span>
                        </article>
                    @endforeach
                </div>

                <figure class="aidev-figure aidev-figure--spaced">
                    <img
                        src="{{ $img('Enterprise-AI-Technology-Stack.webp') }}"
                        alt="Enterprise AI Technology Stack"
                        width="1650"
                        height="952"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- Infrastructure --}}
        <section class="aidev-section aidev-section--soft" aria-labelledby="aidev-infra-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <span class="aidev-badge">AI Infrastructure &amp; Platforms</span>
                    <h2 id="aidev-infra-title">
                        Scalable <span class="aidev-accent">AI Infrastructure</span>
                    </h2>
                    <p>
                        We design and deploy infrastructure for large-scale AI workloads from GPU clusters and distributed training to model serving and high-performance storage across all major cloud platforms.
                    </p>
                </div>

                <div class="aidev-infra-grid">
                    @foreach ($infraCards as $card)
                        <article class="aidev-infra-card aidev-infra-card--{{ $card['tone'] }}">
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                            @if ($card['tags'] !== [])
                                <div class="aidev-infra-card__tags">
                                    @foreach ($card['tags'] as $tag)
                                        <span>{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if ($card['footer'])
                                <p class="aidev-infra-card__footer">
                                    <strong>{{ $card['footer']['label'] }}</strong> {{ $card['footer']['text'] }}
                                </p>
                            @endif
                        </article>
                    @endforeach
                </div>

                <figure class="aidev-figure aidev-figure--spaced">
                    <img
                        src="{{ $img('AI-ML-Infrastructure-Design-Principles.webp') }}"
                        alt="AI ML Infrastructure Design Principles"
                        width="1729"
                        height="1080"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </div>
        </section>

        {{-- AWS MLOps --}}
        <section class="aidev-section" aria-labelledby="aidev-aws-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <span class="aidev-badge">AWS MLOps Pipeline</span>
                    <h2 id="aidev-aws-title">
                        Cloud MLOps Pipeline <span class="aidev-accent">(AWS)</span>
                    </h2>
                    <p>
                        We design and deploy infrastructure for large-scale AI workloads from GPU clusters and distributed training to model serving and high-performance storage across all major cloud platforms.
                    </p>
                </div>

                <figure class="aidev-figure">
                    <img
                        src="{{ $img('AWS-automated-feature-store-workflow-diagram.webp') }}"
                        alt="AWS automated feature store workflow diagram"
                        width="1560"
                        height="1024"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>

                <div class="aidev-split-panel">
                    <div>
                        <h3>Infrastructure Components</h3>
                        <ul class="aidev-plus-list">
                            @foreach ($infraComponents as $item)
                                <li>
                                    <span aria-hidden="true">+</span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3>Design Principles</h3>
                        <ul class="aidev-plus-list">
                            @foreach ($designPrinciples as $item)
                                <li>
                                    <span aria-hidden="true">+</span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="aidev-platforms">
                    <h3>Supported Platforms</h3>
                    <div class="aidev-platforms__grid" role="list">
                        @foreach ($platforms as $platform)
                            <div class="aidev-platforms__item" role="listitem">
                                <img
                                    src="{{ $img($platform['file']) }}"
                                    alt="{{ $platform['alt'] }}"
                                    width="180"
                                    height="120"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="aidev-section aidev-section--soft" aria-labelledby="aidev-industry-title">
            <div class="site-shell">
                <div class="aidev-heading">
                    <span class="aidev-badge">Industry-Specific AI Solutions</span>
                    <h2 id="aidev-industry-title">
                        AI Built for <span class="aidev-accent">Your Sector</span>
                    </h2>
                    <p>Specialized solutions designed for each sector's unique challenges, regulations, and competitive opportunities.</p>
                </div>

                <div class="aidev-industry-grid" role="list">
                    @foreach ($industries as $industry)
                        <article class="aidev-industry-card" role="listitem">
                            <div class="aidev-industry-card__head">
                                <span class="aidev-industry-card__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $industry['icon'] }}"></i>
                                </span>
                                <h3>{{ $industry['title'] }}</h3>
                            </div>
                            <ul class="aidev-dot-list">
                                @foreach ($industry['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Roadmap + form --}}
        <section class="aidev-section aidev-section--soft" id="aidev-consult" aria-labelledby="aidev-roadmap-title">
            <div class="site-shell aidev-consult">
                <div class="aidev-consult__copy">
                    <h2 id="aidev-roadmap-title">Get Your Enterprise AI Roadmap</h2>
                    <p class="aidev-consult__lede">Expert‑led guidance to turn AI into real business value</p>

                    <ul class="aidev-roadmap-list">
                        @foreach ($roadmapChecks as $item)
                            <li>
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="aidev-consult__note">
                        <h3>Take the First Step Toward Smarter, AI-Driven Performance</h3>
                        <p>Partner with an AI consultant for efficient, secure, and measurable results, from concept to launch.</p>
                    </div>
                </div>

                <aside class="aidev-consult__card" aria-labelledby="aidev-form-title">
                    <h3 id="aidev-form-title">Talk to Our AI Experts</h3>

                    <livewire:forms.contact-form
                        form-name="ai-development-services"
                        id-prefix="aidev"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Let's discuss your AI goals and transformation priorities."
                        submit-label="BOOK CONSULTATION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
