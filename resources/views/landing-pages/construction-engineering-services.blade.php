@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);
    $bookCallUrl = 'https://bookings.cloud.microsoft/book/IBNConstructionandEngineeringBackOfficeService@ibntech.com/?ismsaljsauthenabled=true';

    $heroItems = [
        'Drawing, Drafting, Estimation & Bid Management',
        'AutoCAD, Civil 3D, Revit & Bluebeam Experts',
        'Up to 70% Lower Than In-House Hiring',
    ];

    $advantages = [
        [
            'title' => '100% Commitment',
            'text' => 'Engineer is exclusively assigned to your project',
        ],
        [
            'title' => 'Up to 70% Cost Savings',
            'text' => 'vs local employment, no compromising on quality',
        ],
        [
            'title' => '24/7 Support',
            'text' => 'The engineer works according to your time zone and attends your standup meetings',
        ],
        [
            'title' => 'Built for US/UK Building Regulations',
            'text' => 'CSI documents, NRM, RERA, and compliance right off the bat',
        ],
    ];

    $services = [
        [
            'icon' => 'pen-svg.svg',
            'title' => 'Structural Drawing',
            'text' => 'Construction documents, as-builts, redlines and site plans, delivered to your standards and file structure.',
        ],
        [
            'icon' => 'grid-icon.svg',
            'title' => 'CAD Drafting',
            'text' => 'CAD production support across civil sheets, grading, utilities, layout in AutoCAD or Civil 3D.',
        ],
        [
            'icon' => 'calculator-svg.svg',
            'title' => 'Estimation & Takeoffs',
            'text' => 'Quantity takeoffs, material schedules, and cost estimates that hold up when the bid gets scrutinized.',
        ],
        [
            'icon' => 'folder-check-svg.svg',
            'title' => 'Bid Management',
            'text' => 'Bid packages, RFP responses and subcontractor coordination, run on your timeline, not around it.',
        ],
    ];

    $processSteps = [
        [
            'icon' => 'fa-phone',
            'title' => '15-minute fit call',
            'text' => 'We map the exact skills, tools and weekly hours your workload needs.',
        ],
        [
            'icon' => 'fa-user-check',
            'title' => 'Meet your engineer',
            'text' => 'Vetted candidate profile within 3–5 business days, matched to your scope.',
        ],
        [
            'icon' => 'fa-calendar-check',
            'title' => 'Project Onboarding',
            'text' => 'Your dedicated engineer integrates with your team, tools, and processes to ensure a smooth and efficient project start.',
        ],
        [
            'icon' => 'fa-user-plus',
            'title' => 'Extend or add resources',
            'text' => 'No lengthy recruitment cycles. No unnecessary complexity.',
        ],
    ];

    $resourceTypeOptions = [
        'Full-Time Dedicated Support',
        'Part-Time / Hourly Based',
        'Not Sure',
    ];

    $serviceOptions = [
        'Drawing & Drafting',
        'Estimation & Takeoffs',
        'Bid Management',
        'Not Sure yet – Need Guidance',
    ];
@endphp

@section('content')
<div class="lces-page">
    <section class="lces-banner" aria-label="Schedule a meeting">
        <div class="lces-shell lces-banner__inner">
            <p>Remote Staffing for Civil Engineering. Save Up to 70% on Hiring</p>
            <a href="{{ $bookCallUrl }}" target="_blank" rel="noopener noreferrer">
                <svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path>
                </svg>
                Schedule Your Meeting
            </a>
        </div>
    </section>

    <section class="lces-hero" aria-labelledby="lces-hero-title">
        <img
            class="lces-hero__bg"
            src="{{ $lpImg('construction-lp-hero.jpg') }}"
            alt=""
            aria-hidden="true"
            width="1024"
            height="1024"
            fetchpriority="high"
            decoding="async"
        >
        <div class="lces-shell lces-hero__inner">
            <div class="lces-hero__copy">
                <p class="lces-kicker lces-kicker--light">Full-Time Remote Civil Engineering Resources for U.S. Firms</p>
                <h1 id="lces-hero-title">Remote Staffing Solutions for Civil Engineering &amp; Construction Business</h1>
                <p>
                    Whether you're managing multiple infrastructure projects, preparing competitive bids, or expanding your design team, IBN Technologies provides experienced engineers who work exclusively for your business, align with your workflows, and collaborate during your preferred business hours.
                </p>
                <ul class="lces-hero__items">
                    @foreach ($heroItems as $item)
                        <li>
                            <span class="lces-hero__check" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M20.94,11A8.26,8.26,0,0,1,21,12a9,9,0,1,1-9-9,8.83,8.83,0,0,1,4,1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                    <polyline points="21 5 12 14 8 10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></polyline>
                                </svg>
                            </span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lces-hero__form" id="lces-consult">
                <h2>Get Your Remote Engineering Staffing Plan</h2>
                <p>15 minutes. No obligation. We'll map your workload to the right resource and a real number.</p>
                <livewire:forms.landing-inquiry-form
                    :landing-page-slug="$landingPage->slug"
                    :landing-page-title="$landingPage->title"
                    :with-recaptcha="true"
                    :show-staffing-fields="true"
                    phone-country="us"
                    :resource-type-options="$resourceTypeOptions"
                    :service-options="$serviceOptions"
                    id-prefix="lp-construction-engineering-services-hero"
                    wire:key="landing-inquiry-construction-engineering-services-hero"
                />
            </div>
        </div>
    </section>

    <section class="lces-adv" aria-labelledby="lces-adv-title">
        <div class="lces-shell lces-adv__inner">
            <div class="lces-adv__copy">
                <p class="lces-kicker">Our Advantage</p>
                <h2 id="lces-adv-title">Why Businesses Choose IBN Tech’s Construction Engineering Support Model</h2>
                <p>
                    We provide structured, highly-compliant remote staffing solutions built around U.S. and UK firm operations, enabling seamless workflow alignment and exceptional resource reliability.
                </p>
                <div class="lces-adv__stat">
                    <p class="lces-adv__stat-value">70<span>%</span></p>
                    <p class="lces-adv__stat-label">Maximum Average Cost Savings</p>
                </div>
            </div>

            <div class="lces-adv__cards">
                @foreach ($advantages as $advantage)
                    <article>
                        <span class="lces-adv__icon" aria-hidden="true">
                            <svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path>
                            </svg>
                        </span>
                        <div>
                            <h3>{{ $advantage['title'] }}</h3>
                            <p>{{ $advantage['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lces-team" aria-labelledby="lces-team-title">
        <div class="lces-shell">
            <div class="lces-team__intro">
                <p class="lces-kicker">Build Your Remote Engineering Team</p>
                <h2 id="lces-team-title">Dedicated Professionals. One Scalable Engineering Solution</h2>
                <p>
                    Whether you need a single specialist or a multidisciplinary team, IBN Technologies provides dedicated remote professionals who integrate with your business, adapt to your workflows, and support every stage of your engineering projects.
                </p>
            </div>
            <div class="lces-team__grid">
                @foreach ($services as $service)
                    <article>
                        <span class="lces-team__icon">
                            <img src="{{ $lpImg($service['icon']) }}" alt="" width="28" height="28">
                        </span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lces-process" aria-labelledby="lces-process-title">
        <div class="lces-shell">
            <div class="lces-process__intro">
                <p class="lces-kicker">How It Starts</p>
                <h2 id="lces-process-title">From First Call To First Deliverable</h2>
                <p>We keep the process simple because most firms need additional capacity quickly.</p>
            </div>
            <ol class="lces-process__steps">
                @foreach ($processSteps as $index => $step)
                    <li>
                        <article>
                            <span class="lces-process__num" aria-hidden="true">{{ $index + 1 }}</span>
                            <span class="lces-process__icon" aria-hidden="true">
                                <i class="fa-solid {{ $step['icon'] }}"></i>
                            </span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </article>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="lces-cta" aria-labelledby="lces-cta-title">
        <div class="lces-shell lces-cta__inner">
            <h2 id="lces-cta-title">Ready to see the number for your workload?</h2>
            <p>One 15-minute call tells you exactly what a dedicated resource would look like and cost.</p>
            <a href="{{ $bookCallUrl }}" target="_blank" rel="noopener noreferrer">Book a Call</a>
        </div>
    </section>
</div>
@endsection
