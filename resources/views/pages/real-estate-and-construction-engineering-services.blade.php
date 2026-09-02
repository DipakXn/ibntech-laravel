@php
    $img = fn (string $file): string => asset('images/real-estate-and-construction-engineering-services/'.$file);
    $logo = fn (string $file): string => asset('images/civil-engineering-services/'.$file);

    $heroItems = [
        'Reduce cost up to 65%',
        'Accuracy You Can Trust',
        'Efficiency in Every Step',
        'Custom Solutions',
    ];

    $serviceTabs = [
        [
            'id' => 'rfi',
            'title' => 'RFI Management and Closeout Services',
            'intro' => 'Efficient and detailed construction documentation is critical to project success. We offer:',
            'items' => [
                ['lead' => 'RFI (Request for Information) Management', 'text' => 'Timely handling and resolution of RFIs to prevent delays.'],
                ['lead' => 'Shop Drawings', 'text' => 'Precise illustrations for architectural, structural, and MEP elements.'],
                ['lead' => 'As-Built Drawings', 'text' => 'Accurate records of completed construction for future reference.'],
                ['lead' => 'Project Closeout Documentation', 'text' => 'Comprehensive packages, including warranties, manuals, and compliance certifications.'],
            ],
        ],
        [
            'id' => 'takeoff',
            'title' => 'Take-off and Estimation Services',
            'intro' => 'Our outsourced quantity take-off and estimation services deliver accurate and timely cost assessments to ensure project efficiency and budget control.',
            'items' => [
                ['lead' => 'Accurate Quantity Take-offs', 'text' => 'Measure materials and labor to prevent overruns.'],
                ['lead' => 'Cost Estimation', 'text' => 'Prepare detailed budgets based on market trends and materials.'],
                ['lead' => 'Bidding Assistance', 'text' => 'Assistance in preparing competitive bids with accurate cost projections.'],
                ['lead' => 'Value Engineering', 'text' => 'Optimize resources to enhance value without compromising quality.'],
            ],
        ],
        [
            'id' => 'cad',
            'title' => 'CAD Services',
            'intro' => 'Outsourcing CAD services enhances design and drafting efficiency, offering precise, high-quality drawings and faster project turnaround times.',
            'items' => [
                ['lead' => '2D Drafting', 'text' => 'Technical drawings for architectural and engineering projects.'],
                ['lead' => '3D Modelling', 'text' => 'Realistic design visualization for client presentations.'],
                ['lead' => 'Structural Drafting', 'text' => 'Detailed plans for reinforcement and foundations.'],
                ['lead' => 'MEP Drawings', 'text' => 'Coordination for mechanical, electrical, and plumbing systems.'],
            ],
        ],
        [
            'id' => 'bim',
            'title' => 'BIM Services',
            'intro' => 'Building Information Modelling (BIM) transforms construction with enhanced accuracy, improved collaboration, and efficient project management.',
            'items' => [
                ['lead' => '3D BIM Modelling', 'text' => 'Detailed models for architecture, structure, and MEP.'],
                ['lead' => 'Clash Detection and Coordination', 'text' => 'Identifying and resolving conflicts before construction.'],
                ['lead' => '4D and 5D BIM', 'text' => 'Integrating timelines and cost estimates for efficient planning.'],
                ['lead' => 'BIM for Facility Management', 'text' => 'Supporting lifecycle management post-construction.'],
            ],
        ],
        [
            'id' => 'cost',
            'title' => 'Cost Management',
            'intro' => 'Outsourced cost management services ensure financial control by providing accurate budgeting, cost tracking, and timely reporting throughout the project lifecycle.',
            'items' => [
                ['lead' => 'Budget & Cost Management', 'text' => 'Monitor project budgets, track expenditures, and ensure financial alignment.'],
                ['lead' => 'Cash Flow Analysis', 'text' => 'Analyze and manage project cash flow for financial stability.'],
                ['lead' => 'Cost Reporting', 'text' => 'Provide regular cost reports to ensure expenditures stay within budget.'],
                ['lead' => 'Change Order Management', 'text' => 'Prepare and negotiate change orders with clients and subcontractors.'],
                ['lead' => 'Project Monitoring', 'text' => 'Monitor milestone progress and manage variation reports.'],
                ['lead' => 'Billing Support', 'text' => 'Assist with billing processes for customers and subcontractors.'],
            ],
        ],
    ];

    $software = [
        ['src' => $img('b-autodesk-360.webp'), 'alt' => 'Autodesk BIM 360', 'w' => 220, 'h' => 70],
        ['src' => $logo('costx.webp'), 'alt' => 'CostX', 'w' => 221, 'h' => 52],
        ['src' => $logo('kahua.webp'), 'alt' => 'Kahua', 'w' => 221, 'h' => 52],
        ['src' => $logo('procore.webp'), 'alt' => 'Procore', 'w' => 221, 'h' => 52],
        ['src' => $logo('revit.webp'), 'alt' => 'Autodesk Revit', 'w' => 221, 'h' => 52],
        ['src' => $logo('submittal.webp'), 'alt' => 'Submittal Exchange', 'w' => 221, 'h' => 52],
        ['src' => $logo('stack.webp'), 'alt' => 'STACK', 'w' => 221, 'h' => 52],
        ['src' => $img('rib.webp'), 'alt' => 'RIB CostX', 'w' => 220, 'h' => 70],
    ];

    $advantages = [
        [
            'num' => '01',
            'color' => '#ff9900',
            'title' => 'ISO-Certified Quality',
            'text' => 'ISO 9001:2015 / 27001 : 2022 certification reflects our commitment to excellence',
        ],
        [
            'num' => '02',
            'color' => '#ff3333',
            'title' => 'Cost Efficiency',
            'text' => 'Achieve significant savings on overhead without compromising quality',
        ],
        [
            'num' => '03',
            'color' => '#009999',
            'title' => 'Scalability',
            'text' => 'Easily adjust resources to meet your project\'s evolving demands',
        ],
        [
            'num' => '04',
            'color' => '#1cbf36',
            'title' => 'Time Efficiency',
            'text' => 'Meet tight deadlines with dedicated support teams',
        ],
        [
            'num' => '05',
            'color' => '#b117df',
            'title' => 'Data Security',
            'text' => 'We prioritize the protection of your information with secure data handling practices',
        ],
        [
            'num' => '06',
            'color' => '#f10ab8',
            'title' => 'Access to Expertise',
            'text' => 'Work with skilled professionals across multiple domains',
        ],
    ];

@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/real-estate-and-construction-engineering-services.css'])
@endpush

@section('content')
    <div class="rces-page">
        <section class="rces-hero" aria-labelledby="rces-hero-title">
            <div class="site-shell rces-hero__inner">
                <div class="rces-hero__copy">
                    <h1 id="rces-hero-title">Outsource Real Estate and Civil/Construction Engineering Services</h1>
                    <p>Empowering Real estate and Civil/Construction Projects with Precision and Expertise</p>
                    <ul class="rces-hero__items">
                        @foreach ($heroItems as $item)
                            <li>
                                <span class="rces-hero__check" aria-hidden="true">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm141.4 199.3L234.8 365.8c-4.7 4.7-12.3 4.7-17 0l-92.5-92.5c-4.7-4.7-4.7-12.3 0-17l19.8-19.8c4.7-4.7 12.3-4.7 17 0l64.2 64.2 133.1-133.1c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.8 4.6 4.8 12.2.2 16.9z"></path>
                                    </svg>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="rces-hero__form" id="hero-form-section" aria-labelledby="rces-hero-form-title">
                    <h2 id="rces-hero-form-title">Get Started with a 1-1 Video Call with IBN Specialists</h2>
                    <p>Fill out the form below to connect with our specialists</p>
                    <livewire:forms.contact-form
                        form-name="real-estate-and-construction-engineering-services"
                        id-prefix="rces"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your project"
                        submit-label="Get Started Now"
                        :message-rows="2"
                        layout="home"
                    />
                </aside>
            </div>
        </section>

        <section class="rces-intro" aria-labelledby="rces-intro-title">
            <div class="site-shell rces-intro__inner">
                <div class="rces-intro__copy">
                    <h2 id="rces-intro-title">Your One-Stop Solution for Accurate Construction and Real Estate Estimates</h2>
                    <p>At IBN Technologies, we provide specialized outsourcing solutions across various engineering disciplines, ensuring your projects are executed with accuracy and efficiency.</p>
                    <a href="#hero-form-section" class="rces-btn rces-btn--navy">Talk to Our Specialists for Informed Solutions</a>
                </div>
                <div class="rces-intro__media">
                    <img
                        src="{{ $img('your-one-stop-solution-for-accurate-construction-and-real-estate-estimates.webp') }}"
                        alt="Your One-Stop Solution for Accurate Construction and Real Estate Estimates"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="rces-services" aria-labelledby="rces-services-title" x-data="{ tab: 0 }">
            <div class="site-shell">
                <div class="rces-heading">
                    <h2 id="rces-services-title">Our Digital Construction and Real estate Services</h2>
                </div>

                <div class="rces-tabs">
                    <div class="rces-tabs__nav" role="tablist" aria-label="Digital construction and real estate services">
                        @foreach ($serviceTabs as $index => $serviceTab)
                            <button
                                type="button"
                                class="rces-tabs__btn"
                                id="rces-tab-{{ $serviceTab['id'] }}"
                                role="tab"
                                :class="{ 'is-active': tab === {{ $index }} }"
                                :aria-selected="tab === {{ $index }}"
                                :tabindex="tab === {{ $index }} ? 0 : -1"
                                aria-controls="rces-panel-{{ $serviceTab['id'] }}"
                                @click="tab = {{ $index }}"
                            >
                                <span>{{ $serviceTab['title'] }}</span>
                                <svg class="rces-tabs__chevron" aria-hidden="true" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                                </svg>
                            </button>
                        @endforeach
                    </div>

                    <div class="rces-tabs__panels">
                        @foreach ($serviceTabs as $index => $serviceTab)
                            <div
                                class="rces-tabs__panel"
                                id="rces-panel-{{ $serviceTab['id'] }}"
                                role="tabpanel"
                                aria-labelledby="rces-tab-{{ $serviceTab['id'] }}"
                                x-show="tab === {{ $index }}"
                                x-cloak
                            >
                                <p>{{ $serviceTab['intro'] }}</p>
                                <ul>
                                    @foreach ($serviceTab['items'] as $item)
                                        <li><strong>{{ $item['lead'] }}</strong>: {{ $item['text'] }}</li>
                                    @endforeach
                                </ul>
                                <a href="#hero-form-section" class="rces-btn rces-btn--navy">Get Started Now</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="rces-software" aria-labelledby="rces-software-title">
            <div class="site-shell rces-software__inner">
                <h2 id="rces-software-title">IBN Technologies Outsource Construction Engineering Services: Leveraging BIM &amp; Advanced Software</h2>
                <div
                    class="rces-software__carousel"
                    x-data="{ page: 0, pages: 2 }"
                    aria-roledescription="carousel"
                    aria-label="Software expertise"
                >
                    <div class="rces-software__viewport">
                        <ul
                            class="rces-software__track"
                            :style="'transform: translateX(-' + (page * 100) + '%)'"
                        >
                            @foreach ($software as $tool)
                                <li>
                                    <img
                                        src="{{ $tool['src'] }}"
                                        alt="{{ $tool['alt'] }}"
                                        width="{{ $tool['w'] }}"
                                        height="{{ $tool['h'] }}"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rces-software__dots" role="tablist" aria-label="Software logo pages">
                        <template x-for="n in pages" :key="n">
                            <button
                                type="button"
                                :class="{ 'is-active': page === n - 1 }"
                                :aria-selected="page === n - 1"
                                :aria-label="'Show software logos page ' + n"
                                @click="page = n - 1"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <section class="rces-apart" aria-labelledby="rces-apart-title">
            <div class="site-shell">
                <div class="rces-heading">
                    <h2 id="rces-apart-title">What Sets Us Apart as the Top Engineering Services Provider?</h2>
                    <p>We provide exceptional services that add value, ensuring stability and driving continuous innovation. Here are key advantages of our engineering design services:</p>
                </div>

                <div class="rces-apart__grid" role="list">
                    @foreach ($advantages as $item)
                        <article class="rces-apart__card" role="listitem">
                            <span class="rces-apart__num" style="--rces-num: {{ $item['color'] }}" aria-hidden="true">{{ $item['num'] }}</span>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="rces-onboard" aria-labelledby="rces-onboard-title">
            <div class="site-shell">
                <div class="rces-heading">
                    <h2 id="rces-onboard-title">Onboard Top Construction Engineers Today!</h2>
                </div>

                <img
                    class="rces-onboard__graphic"
                    src="{{ $img('onboard-top-construction-engineers-now.webp') }}"
                    alt="Onboard process: Book a call, fill out the form, connect with domain engineers, define work scope, and get professional assistance"
                    width="1536"
                    height="733"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>
    </div>
@endsection
