@php
    $img = fn (string $file): string => asset('images/reporting-analysis-planning/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $keyActivities = [
        'Budgeting and forecasting',
        'Revenues, profits, margins, and costs analyzed financially',
        'Report rationalization and consolidation',
        'Process documentation and scalability',
        'Live industrial data analysis with ratio analysis',
        'Setting up accounting system',
        'Accounting Health Check',
        'Timely Month-end closing',
        'Business Strategies Development',
    ];

    $offerItems = [
        'Maximize organization\'s liquidity by implementing AP/AR management.',
        'Optimize cash flow through effective invoice processing, timely collections, and proactive debtor management strategies.',
        'Streamline your financial operations by leveraging technology and automation to improve accuracy, reduce errors, and enhance efficiency.',
    ];

    $helpItems = [
        'Increase ~40% improvement in efficiency',
        'Accelerate reporting timelines',
        'Focus on improvement of company’s financial health',
        'Gain Superior stakeholder experience',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/reporting-analysis-planning.css'])
@endpush

@section('content')
    <div class="rap-page">
        {{-- Hero --}}
        <section class="rap-hero" aria-labelledby="rap-hero-title">
            <div class="site-shell rap-hero__inner">
                <div class="rap-hero__copy">
                    <h1 id="rap-hero-title">Looking to enhance your financial decision-making capabilities?</h1>
                    <p class="rap-hero__lede"><strong>Strategic Reporting, Analysis and Planning for Long-term Success</strong></p>
                    <p class="rap-hero__sub">Read and Analyze Data to Make Correct Decisions</p>
                    <a href="{{ $contactUrl }}" class="rap-btn">Get a Free Consultation Today</a>
                </div>

                <div class="rap-hero__media">
                    <img
                        src="{{ $img('report-analysis-planning.webp') }}"
                        alt="report analysis planning"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Introduction card --}}
        <section class="rap-intro" aria-label="Reporting analysis planning overview">
            <div class="site-shell">
                <div class="rap-intro__card">
                    <p>
                        Are you tired of inconsistent reporting, lengthy planning cycles, and a focus on historical information? Is your strategic plan supported well by your organization? Considering the importance of making informed decisions in a constantly evolving market, IBN Technologies offers secure and on-demand access to financial reporting and ‘what-if’ analysis across plans, budgets, forecasts, and actuals. By leveraging our services of financial reporting, analysis and planning, you can streamline report creation, enabling a greater focus on empowering your organization with connected data, analysis and plans.
                    </p>
                </div>
            </div>
        </section>

        {{-- How We Support CFOs --}}
        <section class="rap-section rap-cfo" aria-labelledby="rap-cfo-title">
            <div class="site-shell rap-split">
                <div class="rap-split__media">
                    <img
                        src="{{ $img('facility-with-state-of-the-art-infrastructure.webp') }}"
                        alt="facility with state of the art infrastructure"
                        width="526"
                        height="309"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rap-split__copy">
                    <h2 id="rap-cfo-title">How We Support CFOs in Strategic Planning?</h2>
                    <p>A CFO plays a multifaceted role, providing immense value to a business. Among their many priorities, strategic planning takes the lead. Nowadays, CEOs and boards want a CFO to be a trusted partner who not just ensures precision in numbers but also helps in developing the business strategy.</p>
                    <h3>Let’s start with Our Strategic Solutions..</h3>
                    <p>Experience visibility into operational data with IBN Tech’s collaborative approach to strategic planning and how we empower you to help your organization make informed decisions based on up-to-date information.</p>
                </div>
            </div>
        </section>

        {{-- KEY Activities --}}
        <section class="rap-section rap-section--soft" aria-labelledby="rap-key-title">
            <div class="site-shell rap-split rap-split--reverse">
                <div class="rap-split__copy">
                    <h2 id="rap-key-title">KEY Activities</h2>
                    <ul class="rap-bullets">
                        @foreach ($keyActivities as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="rap-split__media rap-split__media--cover">
                    <img
                        src="{{ $img('key-activities-1.webp') }}"
                        alt="professionals collaborating on reporting and planning"
                        width="640"
                        height="420"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Dual offer boxes --}}
        <section class="rap-offers" aria-label="Additional reporting analysis planning services">
            <div class="rap-offers__navy">
                <div class="rap-offers__inner">
                    <h2>What Do We Offer in Addition to the Above?</h2>
                    <ol class="rap-numbered">
                        @foreach ($offerItems as $index => $item)
                            <li>
                                <span class="rap-numbered__icon" aria-hidden="true">{{ $index + 1 }}</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="rap-offers__green">
                <div class="rap-offers__inner">
                    <h2>Additionally, our reporting, analysis and planning services help you</h2>
                    <ul class="rap-checks">
                        @foreach ($helpItems as $item)
                            <li>
                                <span class="rap-checks__icon" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Bottom CTA --}}
        <section class="rap-cta" aria-labelledby="rap-cta-title">
            <div class="site-shell rap-cta__inner">
                <div class="rap-cta__media">
                    <img
                        src="{{ $img('dont-miss-out.webp') }}"
                        alt="dont miss out"
                        width="263"
                        height="317"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="rap-cta__copy">
                    <h2 id="rap-cta-title">Don't Miss Out! Add Expert Support to your Financial Journey and Take Your Organization to the Next Level</h2>
                    <p class="rap-cta__lede"><strong>Take Your Organization to the Next Level</strong></p>
                    <p>Enroll now to secure your spot and join our community of forward-thinking finance professionals. Get started with IBN Tech and transform your financial decision-making today!</p>
                    <a href="{{ $contactUrl }}" class="rap-btn">Get a Free Consultation Today</a>
                </div>
            </div>
        </section>
    </div>
@endsection
