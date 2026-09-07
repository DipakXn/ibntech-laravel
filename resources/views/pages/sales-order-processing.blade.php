@php
    $img = fn (string $file): string => asset('images/sales-order-processing/'.$file);

    $manualChallenges = [
        'High AP costs from manual PO handling',
        'Data entry errors risk order accuracy',
        'Inefficient inventory management',
        'Lengthy Order-to-Cash cycle',
        'Errors impact financial statement accuracy',
        'Processing delays increase Days Sales Outstanding',
    ];

    $automationBenefits = [
        'Archives transactions efficiently with each order',
        'Reduces errors and boosts process efficiency',
        'Streamlines order processing by removing repetitive tasks',
        'Seamlessly integrates with ERP for smooth operations',
    ];

    $benefitsCards = [
        [
            'icon' => 'gain-full-visibility-and-control.webp',
            'title' => 'Gain Full Visibility and Control',
        ],
        [
            'icon' => 'reduce-day-sales-outstanding.webp',
            'title' => 'Reduce Day Sales Outstanding',
        ],
        [
            'icon' => 'supply-chain-optimization.webp',
            'title' => 'Supply Chain Optimization',
        ],
        [
            'icon' => 'seamless-erp-system-integration.webp',
            'title' => 'Seamless ERP System Integration',
        ],
        [
            'icon' => 'maintain-clear-audit-trails.webp',
            'title' => 'Maintain Clear Audit Trails',
        ],
        [
            'icon' => 'data-security-and-privacy.webp',
            'title' => 'Data Security and Privacy',
        ],
        [
            'icon' => 'increase-efficiency-reduce-errors.webp',
            'title' => 'Increase Efficiency & Reduce Errors',
        ],
        [
            'icon' => 'cut-transaction-costs-.webp',
            'title' => 'Cut Transaction Costs',
        ],
    ];

    $capabilities = [
        'Acquires POs from multiple sources',
        'Accepts all file types, including digital',
        'Uses AI and OCR engines to transform data',
        'Classifies and sorts orders by customer and PO date',
        'Extracts and validates PO data',
        'Verifies PO information with AP databases',
        'Notifies and routes orders for approval',
        'Enters data and PO images into Acumatica and other ECM platforms',
    ];

    $caseStudies = $caseStudies ?? app(\App\Repositories\CaseStudyRepository::class)->getPublishedByCategorySlug(
        limit: 3
    );
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/sales-order-processing.css'])
@endpush

@section('content')
    <div class="sop-page">
        {{-- Section 1: Hero --}}
        <section class="sop-hero" aria-labelledby="sop-hero-title">
            <div class="site-shell sop-hero__inner">
                <div class="sop-hero__media">
                    <img
                        src="{{ $img('banner-2.webp') }}"
                        alt="Accelerate Your Supply Chain and Transform Your Sales Order Process"
                        width="1000"
                        height="1000"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="sop-hero__copy">
                    <h1 id="sop-hero-title">Accelerate Your Supply Chain and Transform Your Sales Order Process</h1>
                    <p class="sop-hero__lede">You've Secured the Order! Now it’s Time to Take Action</p>
                    <a href="#" class="sop-btn" data-contact-modal-trigger>Schedule a Free Demo</a>
                </div>
            </div>
        </section>

        {{-- Section 2: Transform Orders --}}
        <section class="sop-section sop-transform" aria-labelledby="sop-transform-title">
            <div class="site-shell sop-transform__inner">
                <div class="sop-transform__copy">
                    <h2 id="sop-transform-title">Transform Orders into On-Time Deliveries with Intelligent Automation</h2>
                    <p class="sop-transform__intro">
                        Winning a customer order is significant, but the true victory lies in delivering the order accurately and on time. Here’s how our intelligent automation solution can help you achieve this:
                    </p>

                    <div class="sop-transform__lists">
                        <div class="sop-transform__col">
                            <h3>Challenges with Manual Processing:</h3>
                            <ul class="sop-check-list" role="list">
                                @foreach ($manualChallenges as $item)
                                    <li>
                                        <svg class="sop-check-icon" aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                        </svg>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sop-transform__col">
                            <h3>Benefits of Intelligent Automation:</h3>
                            <ul class="sop-check-list" role="list">
                                @foreach ($automationBenefits as $item)
                                    <li>
                                        <svg class="sop-check-icon" aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                        </svg>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sop-transform__media">
                    <img
                        src="{{ $img('transform-orders-into-on-time-deliveries-with-intelligent-automation.webp') }}"
                        alt="Transform Orders into On-Time Deliveries with Intelligent Automation"
                        width="1000"
                        height="1000"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 3: Mid-page CTA Band --}}
        <section class="sop-cta-band" aria-labelledby="sop-cta-title">
            <div class="site-shell sop-cta-band__inner">
                <h2 id="sop-cta-title">With Our Sales Order Processing Solution</h2>
                <p>Achieve Streamlined Order Cycles and Minimized Manual Effort</p>
                <a href="#" class="sop-btn" data-contact-modal-trigger>Book Your Free Demo</a>
            </div>
        </section>

        {{-- Section 4: Streamline Your Sales Order Processing --}}
        <section class="sop-section sop-process" aria-labelledby="sop-process-title">
            <div class="site-shell sop-process__inner">
                <div class="sop-heading">
                    <h2 id="sop-process-title">Streamline Your Sales Order Processing</h2>
                    <p>Transitioning from Manual to Automated Sales Order Processing</p>
                </div>

                <div class="sop-process__media">
                    <img
                        src="{{ $img('streamline-your-sales-order-processing.webp') }}"
                        alt="Streamline Your Sales Order Processing"
                        width="1950"
                        height="676"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="sop-process__cta">
                    <a href="#" class="sop-btn" data-contact-modal-trigger>Get Started</a>
                </div>
            </div>
        </section>

        {{-- Section 5: Benefits of Our Sales Order Processing --}}
        <section class="sop-section sop-benefits" aria-labelledby="sop-benefits-title">
            <div class="site-shell sop-benefits__inner">
                <div class="sop-benefits__left">
                    <h2 id="sop-benefits-title">Benefits of Our Sales Order Processing</h2>
                    <div class="sop-benefits__media">
                        <img
                            src="{{ $img('benefits-of-our-sales-order-processing.webp') }}"
                            alt="Benefits of Our Sales Order Processing"
                            width="1000"
                            height="1000"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="sop-benefits__cta">
                        <a href="#" class="sop-btn" data-contact-modal-trigger>Get Started Now</a>
                    </div>
                </div>

                <div class="sop-benefits__right">
                    <div class="sop-cards-grid" role="list">
                        @foreach ($benefitsCards as $card)
                            <div class="sop-card" role="listitem">
                                <div class="sop-card__icon">
                                    <img
                                        src="{{ $img($card['icon']) }}"
                                        alt="{{ $card['title'] }}"
                                        width="75"
                                        height="75"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                </div>
                                <h3 class="sop-card__title">{{ $card['title'] }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 6: Order Processing Capabilities --}}
        <section class="sop-section sop-capabilities" aria-labelledby="sop-caps-title">
            <div class="site-shell sop-capabilities__inner">
                <div class="sop-capabilities__media">
                    <img
                        src="{{ $img('order-processing-capabilities.webp') }}"
                        alt="Order Processing Capabilities"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="sop-capabilities__copy">
                    <h2 id="sop-caps-title">Order Processing Capabilities</h2>
                    <ul class="sop-check-list sop-check-list--caps" role="list">
                        @foreach ($capabilities as $item)
                            <li>
                                <svg class="sop-check-icon" aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path>
                                </svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="sop-capabilities__cta">
                        <a href="#" class="sop-btn" data-contact-modal-trigger>Get Started</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 7: Unlock Rapid ROI --}}
        <section class="sop-section sop-roi" aria-labelledby="sop-roi-title">
            <div class="site-shell sop-roi__inner">
                <div class="sop-roi__copy">
                    <h2 id="sop-roi-title">
                        Unlock Rapid ROI with Our AI-Driven
                        <span class="sop-highlight">Automation</span>
                        Solution
                    </h2>
                    <p>
                        Our AI-powered sales order automation ensures rapid deployment and minimal IT support, overcoming custom coding and complex integrations. Designed for fast order fulfillment, our solution promises ROI within 180 days to a year, allowing you to streamline similar processes across your business.
                    </p>
                    <a href="#" class="sop-btn" data-contact-modal-trigger>Request a Free Demo</a>
                </div>

                <div class="sop-roi__media">
                    <img
                        src="{{ $img('unlock-rapid-roi-with-our-ai-driven-automation-solution.webp') }}"
                        alt="Unlock Rapid ROI with Our AI-Driven Automation Solution"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 8: Case Studies / Real Results --}}
        @if ($caseStudies->isNotEmpty())
            <section class="sop-section sop-cases" aria-labelledby="sop-cases-title">
                <div class="site-shell sop-cases__inner">
                    <div class="sop-heading sop-heading--wide">
                        <h2 id="sop-cases-title">
                            Real Results<br>
                            Success Stories of AP Automation in Action
                        </h2>
                    </div>

                    <div class="sop-case-grid" role="list">
                        @foreach ($caseStudies as $case)
                            <article class="sop-case-card" role="listitem">
                                <a
                                    href="{{ route('case-studies.show', $case->slug) }}"
                                    class="sop-case-card__link-wrap"
                                >
                                    @php
                                        $caseImageUrl = $case->featuredImageUrl();
                                        if (! $caseImageUrl && $case->featured_image) {
                                            if (file_exists(public_path('images/sales-order-processing/' . $case->featured_image))) {
                                                $caseImageUrl = asset('images/sales-order-processing/' . $case->featured_image);
                                            } elseif (file_exists(public_path('images/aws-partner/' . $case->featured_image))) {
                                                $caseImageUrl = asset('images/aws-partner/' . $case->featured_image);
                                            } elseif (file_exists(public_path('images/cloud-consulting-and-migration-services/' . $case->featured_image))) {
                                                $caseImageUrl = asset('images/cloud-consulting-and-migration-services/' . $case->featured_image);
                                            } elseif (file_exists(public_path($case->featured_image))) {
                                                $caseImageUrl = asset($case->featured_image);
                                            }
                                        }
                                    @endphp
                                    @if ($caseImageUrl)
                                        <div class="sop-case-card__media">
                                            <img
                                                src="{{ $caseImageUrl }}"
                                                alt="{{ $case->title }}"
                                                width="640"
                                                height="400"
                                                loading="lazy"
                                                decoding="async"
                                            >
                                        </div>
                                    @endif
                                    <div class="sop-case-card__body">
                                        <h3>{{ $case->title }}</h3>
                                        <span class="sop-case-card__cta">Read More &raquo;</span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <div class="sop-cases__cta">
                        <a href="{{ route('case-studies.index') }}" class="sop-btn">Learn More</a>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
