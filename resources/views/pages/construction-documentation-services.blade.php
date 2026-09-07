@php
    $img = fn (string $file): string => asset('images/construction-documentation-services/'.$file);

    $heroChecks = [
        'End-to-end documentation support',
        'Minimize delays and miscommunication',
        'Ensure compliance and closeout accuracy',
    ];

    $heroStats = [
        ['value' => '500+', 'label' => 'Projects Documented'],
        ['value' => '99.5%', 'label' => 'Client Satisfaction'],
        ['value' => '24/7', 'label' => 'Expert Support'],
        ['value' => '3+', 'label' => 'Years Experience'],
    ];

    $heroCardIcons = [
        ['icon' => 'fa-shield-halved', 'label' => 'Compliance protection'],
        ['icon' => 'fa-building', 'label' => 'Project documentation'],
        ['icon' => 'fa-file-lines', 'label' => 'Accurate records'],
    ];

    $services = [
        [
            'icon' => 'fa-file-lines',
            'title' => 'RFI Management: Clarity from Day One',
            'text' => 'Managing Requests for Information (RFIs) is essential to maintaining project momentum. IBN Technologies offers a structured RFI management system that ensures:',
            'items' => [
                'Seamless RFI submission and tracking',
                'Prompt resolution of design, material, or scope-related queries',
                'Full stakeholder visibility to prevent miscommunication',
            ],
            'footer' => 'Our proactive approach helps eliminate delays and ensures that every question is answered before it becomes a problem.',
        ],
        [
            'icon' => 'fa-gears',
            'title' => 'Change Management: Stay in Control',
            'text' => 'Construction projects often evolve. Our Change Management services provide:',
            'items' => [
                'End-to-end tracking of change orders',
                'Clear documentation of scope, budget, and material changes',
                'Stakeholder alignment to minimize disruption',
            ],
            'footer' => 'We ensure that every change is approved, documented, and integrated smoothly into the project plan.',
        ],
        [
            'icon' => 'fa-clock',
            'title' => 'Submittal Log Creation & Management',
            'text' => 'Efficient submittal handling is key to timely execution. IBN Technologies offers:',
            'items' => [
                'Detailed submittal logs with real-time status updates',
                'Timely approvals to avoid bottlenecks',
                'Transparent access for all project stakeholders',
            ],
            'footer' => 'This ensures that materials, equipment, and systems are reviewed and approved without delay.',
        ],
        [
            'icon' => 'fa-building',
            'title' => 'Drawing Review & Analysis',
            'text' => 'Our experts conduct thorough reviews of architectural, structural, and MEP drawings to ensure:',
            'items' => [
                'Design accuracy and compliance',
                'Early detection of potential issues',
                'Alignment with local building codes',
            ],
            'footer' => 'This minimizes costly errors and ensures smooth execution on-site.',
        ],
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Closeout Documentation: Confident Handover',
            'text' => 'IBN Technologies provides a structured closeout process that includes:',
            'items' => [
                'Verification and procurement of all required documents',
                'Completion of punch list tasks',
                'Warranty and compliance documentation',
                'Final handover with confidence and clarity',
            ],
            'footer' => 'Our closeout services shield you from risks related to scope conflicts, warranty disputes, and compliance issues.',
        ],
    ];

    $reasons = [
        ['icon' => 'fa-bolt', 'title' => 'Up to 30% faster project completion'],
        ['icon' => 'fa-shield-halved', 'title' => 'Reduced risk of errors and miscommunication'],
        ['icon' => 'fa-users', 'title' => 'End-to-end support from RFI to final handover'],
    ];

    $industries = [
        [
            'icon' => 'fa-industry',
            'title' => 'Industrial & Manufacturing',
            'text' => 'Complex industrial facilities, manufacturing plants, and processing centers',
        ],
        [
            'icon' => 'fa-building',
            'title' => 'Commercial & Office',
            'text' => 'Office buildings, retail spaces, mixed-use developments, and commercial complexes',
        ],
        [
            'icon' => 'fa-house',
            'title' => 'Residential',
            'text' => 'Single-family homes, multi-family housing, condominiums, and residential communities',
        ],
        [
            'icon' => 'fa-hospital',
            'title' => 'Healthcare',
            'text' => 'Hospitals, medical centers, clinics, and specialized healthcare facilities',
        ],
        [
            'icon' => 'fa-graduation-cap',
            'title' => 'Educational',
            'text' => 'Schools, universities, research facilities, and educational institutions',
        ],
        [
            'icon' => 'fa-cart-shopping',
            'title' => 'Retail & Hospitality',
            'text' => 'Shopping centers, hotels, restaurants, and entertainment venues',
        ],
        [
            'icon' => 'fa-wrench',
            'title' => 'Infrastructure',
            'text' => 'Transportation, utilities, public works, and civil infrastructure projects',
        ],
        [
            'icon' => 'fa-user-tie',
            'title' => 'Government & Public',
            'text' => 'Government buildings, public facilities, and municipal construction projects',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/construction-documentation-services.css'])
@endpush

@section('content')
    <div class="cds-page">
        {{-- Hero --}}
        <section class="cds-hero" aria-labelledby="cds-hero-title">
            <div class="site-shell cds-hero__inner">
                <div class="cds-hero__copy">
                    <h1 id="cds-hero-title">
                        RFI Management to Project Closeout:
                        <span class="cds-accent">Streamline Construction Project Documentation</span>
                    </h1>

                    <ul class="cds-hero__checks">
                        @foreach ($heroChecks as $check)
                            <li>
                                <span class="cds-check" aria-hidden="true">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                                <span>{{ $check }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="#contact-us" class="cds-btn cds-btn--green cds-btn--lg">
                        Request a Consultation
                    </a>
                </div>

                <aside class="cds-hero__card" aria-label="Trusted by industry leaders">
                    <p class="cds-hero__card-kicker">Trusted by Industry Leaders</p>

                    <div class="cds-hero__stats">
                        @foreach ($heroStats as $stat)
                            <div class="cds-hero__stat">
                                <p class="cds-hero__stat-value">{{ $stat['value'] }}</p>
                                <p class="cds-hero__stat-label">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <ul class="cds-hero__icons" aria-label="Service strengths">
                        @foreach ($heroCardIcons as $item)
                            <li>
                                <span class="cds-hero__icon" aria-hidden="true">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </span>
                                <span class="sr-only">{{ $item['label'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="cds-hero__offer">
                        <p class="cds-hero__offer-label">Limited Time Offer</p>
                        <p class="cds-hero__offer-text">Free Project Assessment for New Clients</p>
                    </div>
                </aside>
            </div>
        </section>

        {{-- Key documentation services --}}
        <section class="cds-section cds-section--cream" aria-labelledby="cds-services-title">
            <div class="site-shell">
                <div class="cds-heading cds-heading--center">
                    <h2 id="cds-services-title">
                        Key Documentation Services <span class="cds-accent">We Offer</span>
                    </h2>
                </div>

                <div class="cds-services">
                    @foreach ($services as $service)
                        <article class="cds-service">
                            <div class="cds-service__icon" aria-hidden="true">
                                <i class="fa-solid {{ $service['icon'] }}"></i>
                            </div>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                            <ul>
                                @foreach ($service['items'] as $item)
                                    <li>
                                        <span class="cds-check" aria-hidden="true">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="cds-service__footer">{{ $service['footer'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Mid-page CTA --}}
        <section class="cds-cta" aria-labelledby="cds-cta-title">
            <div class="site-shell cds-cta__inner">
                <h2 id="cds-cta-title">Transform Your RFI Management Process</h2>
                <p>
                    Streamline your project documentation from RFI initiation through final closeout with our professional RFI management services. Our experienced team will implement proven systems that reduce delays, improve compliance, and simplify your closeout process.
                </p>
                <a href="#contact-us" class="cds-btn cds-btn--white cds-btn--lg">
                    Request a Consultation
                </a>
            </div>
        </section>

        {{-- Why choose --}}
        <section class="cds-section cds-section--soft" aria-labelledby="cds-why-title">
            <div class="site-shell">
                <div class="cds-heading cds-heading--center">
                    <h2 id="cds-why-title">
                        Why Choose <span class="cds-accent">IBN Technologies?</span>
                    </h2>
                </div>

                <div class="cds-why">
                    @foreach ($reasons as $reason)
                        <article class="cds-why__card">
                            <div class="cds-why__icon" aria-hidden="true">
                                <i class="fa-solid {{ $reason['icon'] }}"></i>
                            </div>
                            <h3>{{ $reason['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="cds-section cds-section--mist" aria-labelledby="cds-industries-title">
            <div class="site-shell">
                <div class="cds-heading cds-heading--center">
                    <h2 id="cds-industries-title">
                        <span class="cds-accent">Industries</span> We Serve
                    </h2>
                    <p>Our construction documentation expertise spans across diverse industries, delivering tailored solutions for every sector</p>
                </div>

                <div class="cds-industries">
                    @foreach ($industries as $industry)
                        <article class="cds-industry">
                            <div class="cds-industry__icon" aria-hidden="true">
                                <i class="fa-solid {{ $industry['icon'] }}"></i>
                            </div>
                            <h3>{{ $industry['title'] }}</h3>
                            <p>{{ $industry['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section class="cds-section cds-consult" id="contact-us" aria-labelledby="cds-consult-title">
            <div class="site-shell cds-consult__inner">
                <aside class="cds-consult__card">
                    <h2 id="cds-consult-title">Simplify Project Clarifications</h2>
                    <p>Our RFI management process helps you resolve queries faster, maintain clear communication, and avoid costly delays.</p>

                    <livewire:forms.contact-form
                        form-name="construction-documentation-services"
                        id-prefix="cds"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Tell us about your project documentation needs"
                        submit-label="SUBMIT YOUR QUERY NOW"
                        layout="home"
                        thank-you-url="/thank-you-for-construction-services-consultation/"
                    />
                </aside>

                <div class="cds-consult__media">
                    <img
                        src="{{ $img('contract-form-side-image.webp') }}"
                        alt="Construction documentation specialist available to help with RFI management"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
