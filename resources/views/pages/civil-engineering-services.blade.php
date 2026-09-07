@php
    $img = fn (string $file): string => asset('images/civil-engineering-services/'.$file);

    $heroStats = [
        ['value' => '70%', 'label' => 'Cost savings compared to local engineers', 'icon' => 'fa-percent'],
        ['value' => '26+', 'label' => 'Years in outsourcing', 'icon' => 'fa-calendar-days'],
        ['value' => '100%', 'label' => 'Dedicated — works only for you', 'icon' => 'fa-user-check'],
    ];

    $challenges = [
        [
            'icon' => 'fa-clock',
            'title' => 'Missed bid deadlines',
            'text' => 'Your estimating team is stretched thin, bids keep stacking up, and valuable opportunities are lost.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'High hiring costs',
            'text' => 'Recruiting, onboarding, and retaining skilled professionals takes too long and costs too much.',
        ],
        [
            'icon' => 'fa-triangle-exclamation',
            'title' => 'Inconsistent quality from project-based outsourcing',
            'text' => 'Each new vendor needs fresh instructions, and output often varies, creating rework and margin loss.',
        ],
        [
            'icon' => 'fa-link-slash',
            'title' => 'No continuity across projects',
            'text' => 'Freelancers and task-based vendors don\'t carry project context forward. You lose institutional knowledge every time.',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Limited multi-software expertise on demand',
            'text' => 'Finding engineers fluent in PlanSwift, Bluebeam, AutoCAD, and Revit is difficult when you need support quickly.',
        ],
    ];

    $solutions = [
        [
            'icon' => 'fa-user-gear',
            'title' => 'Dedicated, Workflow-Aligned Engineers',
            'text' => 'Your engineer adapts to your processes, templates, and quality standards—delivering consistent, reliable output from day one.',
        ],
        [
            'icon' => 'fa-folder-open',
            'title' => 'Seamless Continuity Across Projects',
            'text' => 'No repeated onboarding or handovers. Your dedicated resource retains full project context and momentum across every engagement.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Cost-Efficient, Flexible Scaling',
            'text' => 'Scale up or down as needed - add a single engineer or build a full back-office team without compromising quality or control.',
        ],
        [
            'icon' => 'fa-table-cells-large',
            'title' => 'Tool-Ready, Standards-Driven Talent',
            'text' => 'We match you with engineers already proficient in your tools, platforms, and industry standards - no learning curve required.',
        ],
    ];

    $roles = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'Estimation Support',
            'text' => 'Accurate, bid-ready cost intelligence - delivered by a dedicated estimator who understands your project types, formats, and margin requirements.',
            'items' => [
                'Quantity take-offs from 2D/3D drawings',
                'Detailed cost estimation (labor, material, equipment)',
                'BOQs & bid pricing packages',
                'Model-Based Quantity Take-offs (MBQTO)',
                'CSI-formatted outputs & color-coded markups',
                'Value engineering support',
            ],
        ],
        [
            'icon' => 'fa-table-cells',
            'title' => 'Project Management',
            'text' => 'Support your project with full time remote professionals who integrate seamlessly with your team.',
            'items' => [
                'Document control',
                'Structural calculations',
                'Vendor management',
                'Cost-to-complete analysis',
                'RFI & submittal tracking',
                'Closeout documentation',
            ],
        ],
        [
            'icon' => 'fa-screwdriver-wrench',
            'title' => 'Bid Management Support',
            'text' => 'Outsource bid management services to a full-time remote resource and keep your pipeline moving without overloading your in-house team. Our full-time bid manager owns the process end to end.',
            'items' => [
                'Tender documentation & RFP review',
                'Proposal preparation & scope gap analysis',
                'Bid scheduling & deadline tracking',
                'Subcontractor coordination & procurement',
                'Bid compilation & submission',
                'Post-bid review & reporting',
            ],
        ],
        [
            'icon' => 'fa-pen-ruler',
            'title' => 'Drawing & Drafting Support',
            'text' => 'Outsource drafting services to a full-time remote CAD/BIM professional embedded in your team- delivering construction-ready drawings and documentation aligned to your project standards from day one.',
            'items' => [
                'Civil & structural CAD drawings',
                'Construction documentation & submittals',
                'As-built drawings & record sets',
                'BIM modeling (Architectural / MEP / Structural)',
                'Scan-to-BIM for retrofit projects',
                'Shop drawings & fabrication documentation',
            ],
        ],
    ];

    $compareRows = [
        ['matter' => 'Works exclusively for you', 'typical' => 'Shared across clients', 'ibn' => '100% dedicated to you'],
        ['matter' => 'Follows your processes & tools', 'typical' => 'Their workflow', 'ibn' => 'Adapts to your stack'],
        ['matter' => 'Fixed, predictable cost', 'typical' => 'Per-project billing', 'ibn' => 'Fixed monthly rate'],
        ['matter' => 'Direct communication & reporting', 'typical' => 'Account manager buffer', 'ibn' => 'Reports directly to you'],
    ];

    $onboardSteps = [
        [
            'num' => '01',
            'color' => '#2e2e80',
            'icon' => 'fa-users',
            'title' => 'Requirement Discussion',
            'text' => 'You share the scope, job description, required expertise, and software proficiency. We align on expectations, working hours, and deliverables.',
            'badge' => null,
        ],
        [
            'num' => '02',
            'color' => '#2ca5d4',
            'icon' => 'fa-magnifying-glass',
            'title' => 'Profile Shortlisting',
            'text' => 'We rigorously screen our engineering talent pool and deliver relevant candidate profiles within 2–3 weeks matching to your requirements.',
            'badge' => '2–3 Weeks',
        ],
        [
            'num' => '03',
            'color' => '#4caf50',
            'icon' => 'fa-check',
            'title' => 'Final Selection',
            'text' => 'In the final interview round, you assess skills, experience, and team fit and finalise the resource.',
            'badge' => 'Client Preferred',
        ],
        [
            'num' => '04',
            'color' => '#f97316',
            'icon' => 'fa-bolt',
            'title' => 'Onboarding & Go-Live',
            'text' => 'We onboard the selected engineer and align them to your workflows, tools, templates, and communication standards. Typically 3-5 weeks to full productivity.',
            'badge' => '3–5 Weeks to Full Output',
        ],
    ];

    $whyItems = [
        [
            'icon' => 'fa-hard-hat',
            'title' => 'Civil & Construction Specialization',
            'text' => 'We focus exclusively on civil engineering and construction back office. Our engineers understand US/UK construction standards, CSI formats, NRM, and contractor workflows from Day 1.',
        ],
        [
            'icon' => 'fa-user-check',
            'title' => 'Client-Selected Engineers',
            'text' => 'You interview and approve every resource before they join your team. No vendor assignment. No surprises. You decide who works for you.',
        ],
        [
            'icon' => 'fa-puzzle-piece',
            'title' => 'Real-Time Collaboration',
            'text' => 'Your dedicated engineer works your time zone, attends your standup calls, responds in your channels. It feels like a local hire, at a fraction of the cost.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'Cost Advantage Without Quality Trade-off',
            'text' => 'Save up to 70% compared to hiring locally. Fixed monthly billing — no per-task invoices, no scope creep surprises. Plan your margins with certainty.',
        ],
        [
            'icon' => 'fa-lock',
            'title' => 'ISO-Certified & Secure',
            'text' => 'ISO 9001:2015 | 20000-1:2018 | 27001:2022 certified. Your bid documents, drawings, and project data are protected under robust information security frameworks.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Scales With Your Pipeline',
            'text' => 'Full-time dedicated resources or one estimator. Ramp up for peak bid seasons, scale down in quieter periods. No long-term headcount commitments required.',
        ],
    ];

    $software = [
        ['file' => 'autocad.webp', 'alt' => 'AutoCAD', 'w' => 250, 'h' => 78],
        ['file' => 'procore.webp', 'alt' => 'Procore', 'w' => 221, 'h' => 52],
        ['file' => 'stack.webp', 'alt' => 'Stack', 'w' => 221, 'h' => 52],
        ['file' => 'submittal.webp', 'alt' => 'Submittal Exchange', 'w' => 221, 'h' => 52],
        ['file' => 'trimble.webp', 'alt' => 'Trimble', 'w' => 221, 'h' => 52],
        ['file' => 'bluebeam.webp', 'alt' => 'Bluebeam', 'w' => 221, 'h' => 52],
        ['file' => 'tekla.png', 'alt' => 'Tekla', 'w' => 256, 'h' => 59],
        ['file' => 'bentley.webp', 'alt' => 'Bentley Systems', 'w' => 250, 'h' => 65],
        ['file' => 'costx.webp', 'alt' => 'CostX', 'w' => 221, 'h' => 52],
        ['file' => 'kahua.webp', 'alt' => 'Kahua', 'w' => 221, 'h' => 52],
        ['file' => 'civil-3d.webp', 'alt' => 'Civil 3D', 'w' => 213, 'h' => 78],
        ['file' => 'ms-project.png', 'alt' => 'Microsoft Project', 'w' => 220, 'h' => 90],
        ['file' => 'navisworks.webp', 'alt' => 'Navisworks', 'w' => 227, 'h' => 71],
        ['file' => 'planswift.png', 'alt' => 'PlanSwift', 'w' => 240, 'h' => 48],
        ['file' => 'revit.webp', 'alt' => 'Revit', 'w' => 219, 'h' => 100],
    ];

    $serviceOptions = [
        'Estimation Support',
        'Project Management',
        'Bid Management Support',
        'Drawing & Drafting Support',
        'Other',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/civil-engineering-services.css'])
@endpush

@section('content')
    <div class="ces-page">
        {{-- Hero --}}
        <section class="ces-hero" aria-labelledby="ces-hero-title">
            <div class="site-shell ces-hero__inner">
                <div class="ces-hero__copy">
                    <h1 id="ces-hero-title">Full-Time Remote Construction Engineering Support</h1>
                    <p class="ces-hero__lede">
                        Full-time remote experts providing outsourced construction estimation, drafting, and bid management services - seamlessly integrated into your team with zero hiring overhead.
                    </p>

                    <ul class="ces-hero__stats" aria-label="Key outcomes">
                        @foreach ($heroStats as $stat)
                            <li>
                                <span class="ces-hero__stat-icon" aria-hidden="true">
                                    <i class="fa-solid {{ $stat['icon'] }}"></i>
                                </span>
                                <span>
                                    <strong>{{ $stat['value'] }}</strong>
                                    {{ $stat['label'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="ces-hero__actions">
                        <a href="#contact-us" class="ces-btn ces-btn--green">
                            <svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z"></path>
                            </svg>
                            Onboard Your Dedicated Resource
                        </a>
                        <a href="#ces-roles" class="ces-btn ces-btn--outline">See What We Cover</a>
                    </div>
                </div>

                <aside class="ces-hero__form" id="contact-us" aria-labelledby="ces-hero-form-title">
                    <h2 id="ces-hero-form-title">Get a Quote</h2>
                    <livewire:forms.contact-form
                        form-name="civil-engineering-services"
                        id-prefix="ces"
                        :show-company="false"
                        :show-service="true"
                        service-placeholder="How can we help you?"
                        :service-options="$serviceOptions"
                        message-placeholder="Tell us more about your project"
                        submit-label="SUBMIT YOUR REQUEST"
                        layout="home"
                        thank-you-url="/thank-you-for-construction-services-consultation/"
                    />
                </aside>
            </div>
        </section>

        {{-- Why contractors struggle --}}
        <section class="ces-section" aria-labelledby="ces-challenge-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center">
                    <p class="ces-eyebrow">The Challenge</p>
                    <h2 id="ces-challenge-title">Why Contractors Struggle to Scale</h2>
                    <p>Scaling an engineering back office is not easy. The dedicated full time resource model was built to solve the operational bottlenecks contractors face every day.</p>
                </div>

                <div class="ces-challenge" role="list">
                    @foreach ($challenges as $item)
                        <article class="ces-challenge__card" role="listitem">
                            <div class="ces-challenge__icon" aria-hidden="true">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- How IBN solves this --}}
        <section class="ces-solve" aria-labelledby="ces-solve-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center ces-heading--light">
                    <p class="ces-eyebrow ces-eyebrow--light">How IBN Tech Solves This</p>
                    <h2 id="ces-solve-title">Engineering Talent: Offshore Construction Project Management</h2>
                    <p>Get a dedicated offshore remote resource who works as part of your in-house team- aligned with your goals, workflows, and communication style. They keep projects on track, cut costs, and help you deliver faster without overhead.</p>
                </div>

                <div class="ces-solve__grid" role="list">
                    @foreach ($solutions as $item)
                        <article class="ces-solve__card" role="listitem">
                            <div class="ces-solve__icon" aria-hidden="true">
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

        {{-- Full-time professionals --}}
        <section class="ces-roles" id="ces-roles" aria-labelledby="ces-roles-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center ces-heading--light">
                    <p class="ces-eyebrow ces-eyebrow--light">Virtual Civil Engineering Resource</p>
                    <h2 id="ces-roles-title">Full-Time Civil Engineering Professionals</h2>
                    <p>We provide full-time remote civil and structural engineers who fit your standards. Outsource construction estimation, drafting, and bid management with one reliable resource for ongoing support.</p>
                </div>

                <div class="ces-roles__grid" role="list">
                    @foreach ($roles as $role)
                        <article class="ces-role" role="listitem">
                            <div class="ces-role__icon" aria-hidden="true">
                                <i class="fa-solid {{ $role['icon'] }}"></i>
                            </div>
                            <h3>{{ $role['title'] }}</h3>
                            <p>{{ $role['text'] }}</p>
                            <ul>
                                @foreach ($role['items'] as $item)
                                    <li>
                                        <svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path>
                                        </svg>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Comparison --}}
        <section class="ces-section" aria-labelledby="ces-edge-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center">
                    <p class="ces-eyebrow">The IBN Edge</p>
                    <h2 id="ces-edge-title">Built for Ownership, Not Just Output</h2>
                    <p>Our full-time dedicated resource model is fundamentally different from how most firms outsource engineering work</p>
                </div>

                <div class="ces-compare" role="table" aria-label="Typical outsourcing versus IBN Tech full-time resource">
                    <div class="ces-compare__col ces-compare__col--navy" role="columnheader">
                        <h3>What matters to contractors</h3>
                    </div>
                    <div class="ces-compare__col ces-compare__col--sky" role="columnheader">
                        <h3>Typical Outsourcing</h3>
                    </div>
                    <div class="ces-compare__col ces-compare__col--green" role="columnheader">
                        <h3>★ IBN Tech's Full Time Resource</h3>
                    </div>

                    @foreach ($compareRows as $row)
                        <div class="ces-compare__cell" role="cell">{{ $row['matter'] }}</div>
                        <div class="ces-compare__cell ces-compare__cell--no" role="cell">
                            <span aria-hidden="true">✗</span> {{ $row['typical'] }}
                        </div>
                        <div class="ces-compare__cell ces-compare__cell--yes" role="cell">
                            <span aria-hidden="true">✓</span> {{ $row['ibn'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Onboarding framework --}}
        <section class="ces-section ces-onboard-section" aria-labelledby="ces-onboard-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center">
                    <p class="ces-eyebrow">Structured Onboarding</p>
                    <h2 id="ces-onboard-title">End-to-End Full Time Resource Onboarding Framework</h2>
                    <p>A transparent, step-by-step process built around your requirements – so you always know who's joining your team and why.</p>
                </div>

                <ol class="ces-onboard__timeline" aria-label="Typical onboarding timeline">
                    <li><strong>1 week</strong> Requirement → Profiles</li>
                    <li><strong>2-3 weeks</strong> Interviews → Selection</li>
                    <li><strong>3-5 weeks</strong> Onboarding &amp; Go-Live</li>
                </ol>

                <ol class="ces-onboard">
                    @foreach ($onboardSteps as $index => $step)
                        <li class="ces-onboard__step" style="--ces-step: {{ $step['color'] }}">
                            <div class="ces-onboard__icon" aria-hidden="true">
                                <i class="fa-solid {{ $step['icon'] }}"></i>
                            </div>
                            @if ($index < count($onboardSteps) - 1)
                                <div class="ces-onboard__chevron" aria-hidden="true">
                                    <span>STEP {{ $step['num'] }}</span>
                                </div>
                            @else
                                <div class="ces-onboard__chevron ces-onboard__chevron--last" aria-hidden="true">
                                    <span>STEP {{ $step['num'] }}</span>
                                </div>
                            @endif
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                            @if ($step['badge'])
                                <p class="ces-onboard__badge">{{ $step['badge'] }}</p>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        {{-- Why leading contractors --}}
        <section class="ces-section ces-section--soft" aria-labelledby="ces-why-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center">
                    <p class="ces-eyebrow">Why IBN Tech</p>
                    <h2 id="ces-why-title">Why Leading Contractors Trust Us With Their Back Office</h2>
                    <p>What sets us apart, according to our clients</p>
                </div>

                <div class="ces-why" role="list">
                    @foreach ($whyItems as $item)
                        <article class="ces-why__card" role="listitem">
                            <div class="ces-why__icon" aria-hidden="true">
                                <i class="fa-solid fa-check"></i>
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

        {{-- CTA banner --}}
        <section class="ces-cta" aria-labelledby="ces-cta-title">
            <div class="site-shell ces-cta__inner">
                <p class="ces-eyebrow ces-eyebrow--light">Start Your Journey</p>
                <h2 id="ces-cta-title">Ready to onboard a skilled Construction engineer?</h2>
                <p>Outline your role and we’ll connect you with qualified professionals.</p>
                <a href="#" class="ces-btn ces-btn--green ces-btn--lg" data-contact-modal-trigger>
                    <svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M256 32C114.52 32 0 146.496 0 288v48a32 32 0 0 0 17.689 28.622l14.383 7.191C34.083 431.903 83.421 480 144 480h24c13.255 0 24-10.745 24-24V280c0-13.255-10.745-24-24-24h-24c-31.342 0-59.671 12.879-80 33.627V288c0-105.869 86.131-192 192-192s192 86.131 192 192v1.627C427.671 268.879 399.342 256 368 256h-24c-13.255 0-24 10.745-24 24v176c0 13.255 10.745 24 24 24h24c60.579 0 109.917-48.098 111.928-108.187l14.382-7.191A32 32 0 0 0 512 336v-48c0-141.479-114.496-256-256-256z"></path>
                    </svg>
                    Book a Call
                </a>
            </div>
        </section>

        {{-- Software logos --}}
        <section class="ces-section" aria-labelledby="ces-software-title">
            <div class="site-shell">
                <div class="ces-heading ces-heading--center">
                    <p class="ces-eyebrow">Expertise Across Industry Tools</p>
                    <h2 id="ces-software-title">Engineers Fluent in Your Software Stack</h2>
                    <p>Get engineers experienced in the tools and platforms your projects require - no training curves, no software learning overhead.</p>
                </div>

                <ul class="ces-software">
                    @foreach ($software as $logo)
                        <li>
                            <img
                                src="{{ $img($logo['file']) }}"
                                alt="{{ $logo['alt'] }}"
                                width="{{ $logo['w'] }}"
                                height="{{ $logo['h'] }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
@endsection
