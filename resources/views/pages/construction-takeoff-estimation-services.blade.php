@php
    $img = fn (string $file): string => asset('images/construction-takeoff-estimation-services/'.$file);
    $logo = fn (string $file): string => asset('images/construction-engineering-software-logos/'.$file);

    $heroChecks = [
        ['lead' => '99% Accurate Estimates', 'rest' => 'Zero Guesswork'],
        ['lead' => '100% Trusted Quality', 'rest' => 'Proven Expertise'],
        ['lead' => 'Quick Delivery', 'rest' => 'On Your Timeline'],
    ];

    $services = [
        [
            'file' => 'material-takeoff-services.webp',
            'alt' => 'Estimator reviewing construction drawings for a material takeoff',
            'title' => 'Material Takeoff Services',
            'text' => 'We deliver precise quantity measurements directly from your construction drawings. This helps optimize budgeting, reduce material waste, and streamline procurement.',
        ],
        [
            'file' => 'cost-estimation-services.webp',
            'alt' => 'Hands holding blueprints and a calculator for cost estimation',
            'title' => 'Cost Estimation Services',
            'text' => 'From preliminary budgets to detailed cost breakdowns, our estimates cover labor, materials, and equipment—guiding your project from concept to completion with confidence.',
        ],
        [
            'file' => 'model-based-quantity-takeoff-mbqto.webp',
            'alt' => 'Laptop showing architectural software for model-based quantity takeoff',
            'title' => 'Model-Based Quantity Takeoff (MBQTO)',
            'text' => 'Using BIM tools, we provide dynamic, real-time takeoffs that evolve with your design changes—enhancing accuracy and reducing costly errors.',
        ],
        [
            'file' => 'project-specific-estimations.webp',
            'alt' => 'Construction professional reviewing a project-specific estimate on site',
            'title' => 'Project-Specific Estimations',
            'text' => 'Whether it’s a residential home, commercial complex, or industrial facility, our customized estimation services adapt to your project’s unique scope and scale.',
        ],
    ];

    $whyItems = [
        [
            'file' => '25-years-of-expertise.webp',
            'alt' => '26+ years of industry experience',
            'title' => '26+ Years of Industry Experience',
            'text' => 'Trusted by global clients, we understand local building codes and international standards, ensuring compliance and reliability.',
        ],
        [
            'file' => 'bim-integrated-workflows.webp',
            'alt' => 'BIM-integrated workflows',
            'title' => 'BIM-Integrated Workflows',
            'text' => 'Our BIM-enabled processes allow seamless cost adjustments as designs evolve, improving coordination and reducing rework.',
        ],
        [
            'file' => 'scalable-cost-effective-solutions.webp',
            'alt' => 'Scalable and cost-effective solutions',
            'title' => 'Scalable & Cost-Effective Solutions',
            'text' => 'From small residential builds to large commercial developments, our services scale to meet your needs—without compromising quality.',
        ],
        [
            'file' => '247-support.webp',
            'alt' => '24/7 support',
            'title' => '24/7 Support',
            'text' => 'We’re committed to your success. Our team offers round-the-clock support to ensure your estimates are always up to date.',
        ],
        [
            'file' => 'advanced-tools-and-technology.webp',
            'alt' => 'Advanced tools and technology',
            'title' => 'Advanced Tools & Technology',
            'text' => 'We utilize industry-leading software like Procore ERP, Bluebeam, CostX, Trimble Estimation and STACK to deliver fast, accurate, and scalable estimates.',
        ],
    ];

    $software = [
        ['src' => $logo('Trimble.webp'), 'alt' => 'Trimble', 'w' => 220, 'h' => 52],
        ['src' => $logo('Procore.webp'), 'alt' => 'Procore', 'w' => 220, 'h' => 52],
        ['src' => $img('rib-costx.webp'), 'alt' => 'RIB CostX', 'w' => 220, 'h' => 52],
        ['src' => $logo('Stack.webp'), 'alt' => 'STACK', 'w' => 220, 'h' => 52],
        ['src' => $logo('Bluebeam.webp'), 'alt' => 'Bluebeam', 'w' => 220, 'h' => 52],
    ];

    $audiences = [
        [
            'file' => 'home-green-icon.png',
            'alt' => 'Residential construction',
            'title' => 'Residential Construction',
            'text' => 'Single-family, multi-unit, and custom homes',
        ],
        [
            'file' => 'building-green-icon.png',
            'alt' => 'Commercial construction',
            'title' => 'Commercial',
            'text' => 'Retail, office buildings, hotels, mixed-use',
        ],
        [
            'file' => 'factory-green-icon.png',
            'alt' => 'Industrial and infrastructure construction',
            'title' => 'Industrial & Infrastructure',
            'text' => 'Factories, bridges, roads',
        ],
        [
            'file' => 'hospital-green-icon.png',
            'alt' => 'Healthcare and education construction',
            'title' => 'Healthcare & Education',
            'text' => 'Hospitals, clinics, schools, research facilities',
        ],
    ];

    $steps = [
        ['title' => 'Plan Submission', 'text' => 'Upload drawings (PDF, CAD, BIM) via our secure portal.'],
        ['title' => 'Scope Review', 'text' => 'We clarify project requirements and define deliverables.'],
        ['title' => 'Takeoff & Estimation', 'text' => 'Our certified estimators quantify materials and costs.'],
        ['title' => 'Delivery & Revision', 'text' => 'Receive data within days; request tweaks as needed.'],
        ['title' => 'Finalization', 'text' => 'Use deliverables for bidding, procurement, budgeting, and construction planning.'],
    ];

    $faqs = [
        [
            'q' => 'What is construction take-off?',
            'a' => 'Construction take-off determines the overall quantities of materials, labor, and equipment for a project. This entails looking at the blueprints or plans to find every item for the project and figuring out the quantities to get a precise cost estimate.',
        ],
        [
            'q' => 'How accurate are your estimates?',
            'a' => 'Yes, we give you highly accurate estimates when we leverage the latest software and industry best practices. We use complete and thorough construction documents and accurate take-offs. Therefore, your estimates will be as close as possible to reflect the actual costs for your project. All the while, you will receive ongoing updates (to reflect any project changes) which will keep your budget intact.',
        ],
        [
            'q' => 'What software do you use for estimating and take-offs?',
            'a' => 'We use multiple industry leading software such as Procore ERP, Bluebeam, and Kahua for accurate take-offs and estimates. Each software guarantees accuracy, speed, and efficiency in each estimate.',
        ],
        [
            'q' => 'How do I get started with your estimation and take-off services?',
            'a' => 'It’s easy. Send us your project drawings, specifications, and requirements and we will review them. After assessing the scope of the work, we will send you a proposal that details our pricing and turnaround time. Once we have received approval, our team will begin working on your estimation and take off!',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/construction-takeoff-estimation-services.css'])
@endpush

@section('content')
    <div class="ctes-page">
        {{-- Hero --}}
        <section class="ctes-hero" aria-labelledby="ctes-hero-title">
            <div class="site-shell ctes-hero__inner">
                <div class="ctes-hero__copy">
                    <h1 id="ctes-hero-title">
                        Construction Takeoff and
                        <span class="ctes-accent">Estimation Services</span>
                    </h1>

                    <ul class="ctes-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <span class="ctes-hero__check" aria-hidden="true">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                                    </svg>
                                </span>
                                <span>
                                    <strong>{{ $check['lead'] }}</strong> – {{ $check['rest'] }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="ctes-hero__form" id="contact-us" aria-labelledby="ctes-hero-form-title">
                    <h2 id="ctes-hero-form-title">Schedule A Free Consultation!</h2>
                    <livewire:forms.contact-form
                        form-name="construction-takeoff-estimation-services"
                        id-prefix="ctes"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your takeoff or estimation project"
                        submit-label="Submit"
                        layout="home"
                        thank-you-url="/thank-you-for-construction-services-consultation/"
                    />
                </aside>
            </div>
        </section>

        {{-- Expert services --}}
        <section class="ctes-section" aria-labelledby="ctes-services-title">
            <div class="site-shell">
                <div class="ctes-heading ctes-heading--center">
                    <h2 id="ctes-services-title">
                        Our Expert <span class="ctes-accent">Takeoff and Cost Estimating</span> Services
                    </h2>
                </div>

                <div class="ctes-services" role="list">
                    @foreach ($services as $service)
                        <article class="ctes-service" role="listitem">
                            <img
                                src="{{ $img($service['file']) }}"
                                alt="{{ $service['alt'] }}"
                                width="412"
                                height="274"
                                loading="lazy"
                                decoding="async"
                            >
                            <div class="ctes-service__body">
                                <h3>{{ $service['title'] }}</h3>
                                <p>{{ $service['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA 1 --}}
        <section class="ctes-cta" aria-labelledby="ctes-cta-title">
            <div class="site-shell ctes-cta__inner">
                <h2 id="ctes-cta-title">Ready to Improve Your Estimation Accuracy?</h2>
                <p>Professional construction estimating services can help you win more bids and increase project profitability through precise material takeoffs and cost projections.</p>
                <a href="#contact-us" class="ctes-btn ctes-btn--green">
                    <svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"></path>
                    </svg>
                    Request a Consultation
                </a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="ctes-section ctes-section--cream" aria-labelledby="ctes-why-title">
            <div class="site-shell">
                <div class="ctes-heading ctes-heading--center">
                    <h2 id="ctes-why-title">
                        Why Choose <span class="ctes-accent">IBN Technologies?</span>
                    </h2>
                </div>

                <div class="ctes-why" role="list">
                    @foreach ($whyItems as $item)
                        <article class="ctes-why__item" role="listitem">
                            <img
                                src="{{ $img($item['file']) }}"
                                alt=""
                                width="75"
                                height="75"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Software expertise --}}
        <section class="ctes-section" aria-labelledby="ctes-software-title">
            <div class="site-shell">
                <div class="ctes-heading ctes-heading--center">
                    <h2 id="ctes-software-title">
                        Software <span class="ctes-accent">Expertise</span>
                    </h2>
                </div>

                <ul class="ctes-software">
                    @foreach ($software as $logoItem)
                        <li>
                            <img
                                src="{{ $logoItem['src'] }}"
                                alt="{{ $logoItem['alt'] }}"
                                width="{{ $logoItem['w'] }}"
                                height="{{ $logoItem['h'] }}"
                                loading="lazy"
                                decoding="async"
                            >
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Who we serve --}}
        <section class="ctes-section ctes-section--mist" aria-labelledby="ctes-serve-title">
            <div class="site-shell">
                <div class="ctes-heading ctes-heading--center">
                    <h2 id="ctes-serve-title">
                        Who <span class="ctes-accent">We Serve</span>
                    </h2>
                    <p>Our construction documentation expertise spans across diverse industries, delivering tailored solutions for every sector</p>
                </div>

                <div class="ctes-serve" role="list">
                    @foreach ($audiences as $item)
                        <article class="ctes-serve__card" role="listitem">
                            <span class="ctes-serve__icon" aria-hidden="true">
                                <img
                                    src="{{ $img($item['file']) }}"
                                    alt=""
                                    width="104"
                                    height="69"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </span>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA 2 --}}
        <section class="ctes-transform" aria-labelledby="ctes-transform-title">
            <div class="site-shell ctes-transform__inner">
                <div class="ctes-transform__copy">
                    <h2 id="ctes-transform-title">Ready to Transform Your Construction Estimation Process?</h2>
                    <p>Take the first step toward more accurate bids, reduced costs, and improved project outcomes with professional construction estimation and takeoff services.</p>
                    <a href="#contact-us" class="ctes-btn ctes-btn--green">
                        <svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"></path>
                        </svg>
                        Request Your Consultation Today
                    </a>
                </div>
                <div class="ctes-transform__media">
                    <img
                        src="{{ $img('ready-to-transform-your-construction-estimation-process.webp') }}"
                        alt="3D illustration of construction estimation with buildings, blueprints, calculator, and coins"
                        width="300"
                        height="300"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- How it works --}}
        <section class="ctes-section ctes-section--cream" aria-labelledby="ctes-works-title">
            <div class="site-shell ctes-works">
                <div class="ctes-works__copy">
                    <h2 id="ctes-works-title">How It Works</h2>
                    <ol>
                        @foreach ($steps as $step)
                            <li>
                                <b>{{ $step['title'] }}:</b> {{ $step['text'] }}
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div class="ctes-works__media">
                    <img
                        src="{{ $img('how-it-works.webp') }}"
                        alt="Construction professionals collaborating over blueprints, a calculator, and a building model"
                        width="463"
                        height="308"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="ctes-section" aria-labelledby="ctes-faq-title">
            <div class="site-shell ctes-faq-wrap">
                <div class="ctes-heading ctes-heading--center">
                    <h2 id="ctes-faq-title">Frequently Asked Questions</h2>
                </div>

                <div class="ctes-faq">
                    @foreach ($faqs as $index => $faq)
                        <details @if ($index === 0) open @endif>
                            <summary>
                                <span>{{ $faq['q'] }}</span>
                            </summary>
                            <div>
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
