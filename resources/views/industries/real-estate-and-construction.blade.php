@php
    $img = fn (string $file): string => asset('images/industries/'.$file);

    $heroStats = [
        ['icon' => 'fa-award', 'value' => '27+', 'label' => 'Years of Proven Expertise'],
        ['icon' => 'fa-percent', 'value' => '70%', 'label' => 'Cost Savings'],
        ['icon' => 'fa-diagram-project', 'value' => '95%+', 'label' => 'Client Retention Rate'],
    ];

    $certs = [
        ['icon' => 'fa-medal', 'title' => 'ISO 9001:2015', 'text' => 'Quality'],
        ['icon' => 'fa-lock', 'title' => 'ISO 27001:2022', 'text' => 'Security'],
        ['icon' => 'fa-circle-check', 'title' => 'SOC 2 Type II', 'text' => 'Compliance'],
    ];

    $serviceTabs = [
        [
            'id' => 'estimation',
            'icon' => 'fa-dollar-sign',
            'title' => 'Estimation & Cost',
            'desc' => 'Bid-ready cost intelligence',
            'heading' => 'Estimation & Cost Engineering Support',
            'subtitle' => 'Bid-ready cost intelligence from a dedicated estimator.',
            'items' => [
                ['icon' => 'fa-chart-column', 'title' => 'Cost Estimation', 'text' => 'Labor, material, and equipment metrics computed accurately.'],
                ['icon' => 'fa-file-lines', 'title' => 'BOQs & Pricing', 'text' => 'Bill of Quantities pricing packages ready for local contractors.'],
                ['icon' => 'fa-table-cells', 'title' => 'CSI Format', 'text' => 'Strictly CSI-formatted deliverables for estimation reviews.'],
            ],
        ],
        [
            'id' => 'engineering',
            'icon' => 'fa-screwdriver-wrench',
            'title' => 'Project Engineering',
            'desc' => 'Dedicated workflow integration',
            'heading' => 'Project Engineering & Management Support',
            'subtitle' => 'Dedicated remote engineers integrated with your team.',
            'items' => [
                ['icon' => 'fa-building', 'title' => 'Structural Calc', 'text' => 'Comprehensive loading, beam design, and deflection calculations.'],
                ['icon' => 'fa-wave-square', 'title' => 'RFI & Submittals', 'text' => 'Organized submission logging and structural tracking dashboards.'],
                ['icon' => 'fa-clock', 'title' => 'Cost-To-Complete', 'text' => 'Vendor coordination and monthly forecast validation support.'],
            ],
        ],
        [
            'id' => 'bid',
            'icon' => 'fa-circle-check',
            'title' => 'Bid Management',
            'desc' => 'End-to-end pipeline management',
            'heading' => 'Bid Management Support',
            'subtitle' => 'A dedicated bid manager owns your pipeline end to end.',
            'items' => [
                ['icon' => 'fa-circle-exclamation', 'title' => 'RFP & Proposals', 'text' => 'Thorough assessment of RFP criteria and standard technical responses.'],
                ['icon' => 'fa-calendar-days', 'title' => 'Scheduling', 'text' => 'Contractor scheduling checks and milestones coordination flow.'],
                ['icon' => 'fa-clipboard-check', 'title' => 'Post-Bid Reviews', 'text' => 'Bid packaging compiling, QA loops, and compliance audits.'],
            ],
        ],
        [
            'id' => 'drafting',
            'icon' => 'fa-cube',
            'title' => 'CAD / BIM Support',
            'desc' => 'Construction-ready drafts',
            'heading' => 'Drawing & Drafting (CAD/BIM) Support',
            'subtitle' => 'Construction-ready drawings from dedicated CAD/BIM pros.',
            'items' => [
                ['icon' => 'fa-object-ungroup', 'title' => 'CAD Drawings', 'text' => 'Detailed civil, structural as-built, and layout documents.'],
                ['icon' => 'fa-layer-group', 'title' => 'BIM Modeling', 'text' => 'Multi-disciplinary 3D modeling covering architectural, structural, and MEP fields.'],
                ['icon' => 'fa-file-lines', 'title' => 'Shop Drawings', 'text' => 'Fabrication-ready layouts, components detailing, and assemblies.'],
            ],
        ],
    ];

    $legacyPoints = [
        'Shared across clients',
        '100% full-cost overhead',
        'Time zone gap delays',
        'Varying compliance',
    ];

    $dedicatedPoints = [
        '100% Exclusively yours',
        'Save up to 70% locally',
        'Your time-zone overlap',
        'US/UK Standard ready',
    ];

    $perks = [
        [
            'icon' => 'fa-users',
            'title' => '100% Dedicated Staff',
            'text' => 'Your allocated remote engineer works exclusively for you—not shared across multiple clients, maintaining absolute project cohesion.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'Save Up to 70% vs. Local hires',
            'text' => 'Optimize your budgeting structure by outsourcing key planning tasks without experiencing quality drop-offs.',
        ],
        [
            'icon' => 'fa-clock',
            'title' => 'Real-Time Collaboration',
            'text' => 'Engineers align schedules with your local working hours, attending morning alignment checks and standup calls via secure channels.',
        ],
        [
            'icon' => 'fa-rotate',
            'title' => 'Built for US/UK Construction Standards',
            'text' => 'Full integration with regional guidelines, including CSI formats, NRM, RERA, and regulatory requirements from day one.',
        ],
    ];

    $solutions = [
        [
            'theme' => 'blue',
            'icon' => 'fa-chart-line',
            'title' => 'Finance & Accounting',
            'intro' => 'Specialized accounting for real estate and construction contracts and project budgets.',
            'items' => [
                'GAAP-compliant practices',
                'Project cost tracking',
                'Budget vs. actual metrics',
                'Financial reporting systems',
                'Tax & compliance planning',
            ],
        ],
        [
            'theme' => 'green',
            'icon' => 'fa-book',
            'title' => 'Bookkeeping & Payroll',
            'intro' => 'Outsourced bookkeeping and comprehensive payroll solutions.',
            'items' => [
                'Multi-entity payroll management',
                'Contractor payment & 1099 handling',
                'Payroll audit trails',
                'Compliance documentation checks',
            ],
        ],
        [
            'theme' => 'navy',
            'icon' => 'fa-shield-halved',
            'title' => 'Cybersecurity & Data',
            'intro' => 'Advanced threat detection and enterprise-level protection solutions.',
            'items' => [
                '24/7 SOC threat monitoring',
                'Vulnerability assessments',
                'Multi-factor authentication systems',
                'Incident response management',
            ],
        ],
        [
            'theme' => 'sky',
            'icon' => 'fa-cloud',
            'title' => 'Cloud Migration',
            'intro' => 'Secure cloud migration with enterprise-grade system reliability.',
            'items' => [
                '99.9% uptime SLA commitments',
                'Minimal downtime migration plans',
                'Data encryption (AES-256)',
                'Multi-region server redundancy',
            ],
        ],
        [
            'theme' => 'gold',
            'icon' => 'fa-user-check',
            'title' => 'BPO Outsourcing',
            'intro' => 'Complete back-office operations and process workflow optimization.',
            'items' => [
                'Fund Accounting & NAV Calculation',
                'Corporate Investor Reporting',
                'Secure Document Management systems',
                'Performance Reporting audits',
            ],
        ],
    ];

    $assessmentItems = [
        [
            'title' => 'Accelerate Turnaround',
            'text' => 'Optimize estimation schedules with experienced offshore estimators.',
        ],
        [
            'title' => 'Zero Hiring Overhead',
            'text' => 'Scale engineering team volumes dynamically as project queues change.',
        ],
        [
            'title' => 'Accurate BIM & CAD outputs',
            'text' => 'Utilize modern layout verification tools under compliance filters.',
        ],
        [
            'title' => 'Seamless Workflows Integration',
            'text' => 'Incorporate remote professionals into existing local standard standups.',
        ],
        [
            'title' => 'Reduce Labor Costs by 50-70%',
            'text' => 'Recapture operating margin to successfully support more aggressive bids.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/industries/real-estate-and-construction.css'])
@endpush

@section('title', $industry->title)

@section('content')
    <div class="rec-page">
        <span class="sr-only">{{ $industry->title }}</span>

        {{-- Hero --}}
        <section
            class="rec-hero"
            aria-labelledby="rec-hero-title"
            style="--rec-hero-pattern: url('{{ $img('Real-Estate-and-Construction.webp') }}')"
        >
            <div class="site-shell rec-hero__inner">
                <div class="rec-hero__copy">
                    <h1 id="rec-hero-title">Remote Staffing, Business Outsourcing Solutions for Civil &amp; Construction Industry</h1>
                    <p class="rec-hero__lede">
                        Access a team of experienced remote civil engineers for project estimation, BIM modeling, bid support, site documentation, and project management.
                    </p>
                    <a href="#rec-assessment" class="rec-btn rec-btn--green">
                        Schedule a Consultation
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="rec-hero__media">
                    <img
                        src="{{ $img('Real-Estate-and-Construction-Industry.webp') }}"
                        alt="Estate-and-Construction-Industry"
                        width="942"
                        height="742"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="site-shell">
                <ul class="rec-stats" aria-label="Real estate and construction delivery metrics">
                    @foreach ($heroStats as $stat)
                        <li>
                            <span class="rec-stats__icon" aria-hidden="true">
                                <i class="fa-solid {{ $stat['icon'] }}"></i>
                            </span>
                            <span>
                                <strong>{{ $stat['value'] }}</strong>
                                {{ $stat['label'] }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Certifications --}}
        <section class="rec-section rec-section--soft" aria-labelledby="rec-certs-title">
            <div class="site-shell">
                <div class="rec-heading">
                    <h2 id="rec-certs-title">Certifications &amp; <span>Compliance</span></h2>
                    <p>Industry-leading certifications ensuring your trust and data security</p>
                </div>
                <div class="rec-certs" role="list">
                    @foreach ($certs as $cert)
                        <article class="rec-cert" role="listitem">
                            <div class="rec-cert__icon" aria-hidden="true">
                                <i class="fa-solid {{ $cert['icon'] }}"></i>
                                <span class="rec-cert__check">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <h3>{{ $cert['title'] }}</h3>
                            <p>{{ $cert['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Civil engineering services --}}
        <section class="rec-section" id="services" aria-labelledby="rec-services-title">
            <div class="site-shell">
                <div class="rec-heading">
                    <p class="rec-heading__eyebrow">Our Core Specialization</p>
                    <h2 id="rec-services-title">Civil Engineering Services</h2>
                    <p>Complete offshore construction project management solutions, from bid strategy to project execution, with dedicated remote civil and structural engineers selected to match your standards and workflows.</p>
                </div>

                <div class="rec-services" x-data="{ active: 'estimation' }">
                    <div class="rec-services__nav" role="tablist" aria-label="Civil engineering services">
                        @foreach ($serviceTabs as $index => $tab)
                            <button
                                type="button"
                                class="rec-services__tab{{ $index === 0 ? ' is-active' : '' }}"
                                role="tab"
                                id="rec-tab-{{ $tab['id'] }}"
                                :class="{ 'is-active': active === '{{ $tab['id'] }}' }"
                                :aria-selected="active === '{{ $tab['id'] }}' ? 'true' : 'false'"
                                :tabindex="active === '{{ $tab['id'] }}' ? 0 : -1"
                                aria-controls="rec-panel-{{ $tab['id'] }}"
                                @click="active = '{{ $tab['id'] }}'"
                            >
                                <span class="rec-services__tab-icon" aria-hidden="true">
                                    <i class="fa-solid {{ $tab['icon'] }}"></i>
                                </span>
                                <span class="rec-services__tab-text">
                                    <strong>{{ $tab['title'] }}</strong>
                                    <span>{{ $tab['desc'] }}</span>
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <div class="rec-services__display">
                        @foreach ($serviceTabs as $index => $tab)
                            <div
                                class="rec-services__panel{{ $index === 0 ? ' is-active' : '' }}"
                                id="rec-panel-{{ $tab['id'] }}"
                                role="tabpanel"
                                aria-labelledby="rec-tab-{{ $tab['id'] }}"
                                @if ($index !== 0) hidden @endif
                                :class="{ 'is-active': active === '{{ $tab['id'] }}' }"
                                :hidden="active !== '{{ $tab['id'] }}'"
                            >
                                <h3>{{ $tab['heading'] }}</h3>
                                <p>{{ $tab['subtitle'] }}</p>
                                <div class="rec-matrix">
                                    @foreach ($tab['items'] as $item)
                                        <article>
                                            <span class="rec-matrix__icon" aria-hidden="true">
                                                <i class="fa-solid {{ $item['icon'] }}"></i>
                                            </span>
                                            <strong>{{ $item['title'] }}</strong>
                                            <span>{{ $item['text'] }}</span>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Why the model works --}}
        <section class="rec-section rec-section--mist" aria-labelledby="rec-model-title">
            <div class="site-shell">
                <div class="rec-heading">
                    <h2 id="rec-model-title">Why Our <span>Remote Construction Engineering Support</span> Model Works</h2>
                </div>

                <div class="rec-model">
                    <article class="rec-model__compare" aria-labelledby="rec-compare-title">
                        <h3 id="rec-compare-title">Operational Model Analysis</h3>
                        <p>Traditional Hiring vs. Remote Dedicated System</p>
                        <div class="rec-model__cols">
                            <div>
                                <h4>Local / Agency</h4>
                                <ul>
                                    @foreach ($legacyPoints as $point)
                                        <li>
                                            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                            <span>{{ $point }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="rec-model__ours">
                                <h4>Our Dedicated Model</h4>
                                <ul>
                                    @foreach ($dedicatedPoints as $point)
                                        <li>
                                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                                            <span>{{ $point }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>

                    <div class="rec-perks">
                        @foreach ($perks as $perk)
                            <article class="rec-perk">
                                <h3>
                                    <span class="rec-perk__icon" aria-hidden="true">
                                        <i class="fa-solid {{ $perk['icon'] }}"></i>
                                    </span>
                                    {{ $perk['title'] }}
                                </h3>
                                <p>{{ $perk['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Mid CTA --}}
        <section class="rec-cta" aria-labelledby="rec-cta-title">
            <div class="site-shell rec-cta__inner">
                <h2 id="rec-cta-title">Ready to Scale Your Engineering Capacity?</h2>
                <p>Schedule a free consultation with our civil engineers to discuss your project needs, current challenges, and how we can deliver remote engineering support tailored to your workflow.</p>
                <a href="#rec-assessment" class="rec-btn rec-btn--white">Schedule Engineering Consultation</a>
            </div>
        </section>

        {{-- Integrated solutions --}}
        <section class="rec-section" aria-labelledby="rec-solutions-title">
            <div class="site-shell">
                <div class="rec-heading">
                    <h2 id="rec-solutions-title">Integrated Solutions Supporting Your <span>Engineering &amp; Operations</span></h2>
                    <p>Beyond engineering support, we help construction and real estate businesses streamline finance, operations, technology, and business processes.</p>
                </div>

                <div class="rec-solutions">
                    @foreach ($solutions as $solution)
                        <article class="rec-solution rec-solution--{{ $solution['theme'] }}">
                            <span class="rec-solution__icon" aria-hidden="true">
                                <i class="fa-solid {{ $solution['icon'] }}"></i>
                            </span>
                            <h3>{{ $solution['title'] }}</h3>
                            <p>{{ $solution['intro'] }}</p>
                            <h4>Our Solutions:</h4>
                            <ul>
                                @foreach ($solution['items'] as $item)
                                    <li>
                                        <i class="fa-solid fa-circle" aria-hidden="true"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="#rec-assessment" class="rec-solution__link">
                                Request a Consultation
                                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </article>
                    @endforeach

                    <aside class="rec-solution rec-solution--cta">
                        <span class="rec-solution__icon" aria-hidden="true">
                            <i class="fa-solid fa-comments"></i>
                        </span>
                        <p>Let's discuss how our integrated solutions can drive efficiency and value for your business.</p>
                        <a href="#rec-assessment" class="rec-btn rec-btn--white">
                            Request a Consultation
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </aside>
                </div>
            </div>
        </section>

        {{-- Assessment form --}}
        <section class="rec-section rec-section--soft" id="rec-assessment" aria-labelledby="rec-assess-title">
            <div class="site-shell rec-assess">
                <div class="rec-assess__copy">
                    <h2 id="rec-assess-title">Schedule a Complimentary Assessment</h2>
                    <p>Our analysis maps your estimating pipelines, structural drawings criteria, and cost points to custom-selected engineering options.</p>
                    <ul class="rec-assess__list">
                        @foreach ($assessmentItems as $item)
                            <li>
                                <i class="fa-solid fa-circle-chevron-right" aria-hidden="true"></i>
                                <span>
                                    <strong>{{ $item['title'] }}</strong>
                                    {{ $item['text'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="rec-assess__card" aria-labelledby="rec-form-title">
                    <h3 id="rec-form-title">Your Strategic Partner for Real Estate &amp; Construction Excellence</h3>
                    <livewire:forms.contact-form
                        form-name="real-estate-and-construction"
                        id-prefix="rec"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your real estate and construction requirements"
                        :message-rows="4"
                        submit-label="SCHEDULE YOUR SESSION"
                        layout="home"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
