@php
    $img = fn (string $file): string => asset('images/record-to-report-cfo/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $whyOutsource = [
        'Timely digitized reporting',
        'Scalable teams',
        'Improved efficiency',
        'Cost savings',
        'Adherence to regulatory norms',
        'Expert support',
    ];

    $keyActivitiesPrimary = [
        'Conducting customer credibility checks prior to new business',
        'Manage and set up accounting Services (Journal Entries, Reconciliations, General Ledger)',
        'Inventory Management and Accounting',
        'Fixed Assets Accounting',
        'Revenue Recognition and Accounting',
        'Cost Accounting and Analysis',
        'Robust Reporting (Internal, External, Regulatory)',
    ];

    $keyActivitiesAnd = [
        'Risk assessment and mitigation',
        'Financial Strategies and Recommendations',
        'Budgets and forecasts Cash flow projections',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/record-to-report-cfo.css'])
@endpush

@section('content')
    <div class="r2rc-page">
        {{-- Hero --}}
        <section class="r2rc-hero" aria-labelledby="r2rc-hero-title">
            <div class="site-shell r2rc-hero__inner">
                <p class="r2rc-hero__eyebrow">Optimized Record to Report Solutions with Expert CFO Services</p>
                <h1 id="r2rc-hero-title">Reimagine Outsourcing</h1>
                <p class="r2rc-hero__lede">IBN Tech’s Innovative R2R Solution Leads the Way</p>
                <a href="{{ $contactUrl }}" class="r2rc-btn r2rc-btn--navy" data-contact-modal-trigger>
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Record-To-Report --}}
        <section class="r2rc-section" aria-labelledby="r2rc-intro-title">
            <div class="site-shell r2rc-split">
                <div class="r2rc-split__media">
                    <img
                        src="{{ $img('record-to-report.webp') }}"
                        alt="record-to-report"
                        width="536"
                        height="252"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
                <div class="r2rc-split__copy">
                    <h2 id="r2rc-intro-title">Record-To-Report</h2>
                    <p>
                        The <strong>R2R process</strong> begins with recording financial transactions in the company's books. It ensures the integrity and reliability of financial data, facilitating effective decision-making by the CFO and other stakeholders. With our record to report solutions, we provide the accuracy and completeness of data entry which are paramount to ensuring the integrity of financial information.
                    </p>
                    <a href="{{ $contactUrl }}" class="r2rc-btn r2rc-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Why Outsource --}}
        <section class="r2rc-section r2rc-section--tight" aria-labelledby="r2rc-why-title">
            <div class="site-shell r2rc-split r2rc-split--reverse">
                <div class="r2rc-split__copy">
                    <h2 id="r2rc-why-title">Why Outsource R2R Services?</h2>
                    <p>
                        New CFOs face a multitude of challenges that require swift adaptation and maximum efficiency. It is a difficult task to effectively navigate your business's path equally toward top-line and bottom-line growth. However, as a CFO, you have the potential to achieve this remarkable goal. With our unwavering support, expert guidance, and objective insights into the best practices adopted by leading CFOs and finance teams, you can unlock your full potential as a visionary. When you outsource to and adopt the record-to-report solutions by IBN Technologies, you benefit in terms of:
                    </p>
                    <ul class="r2rc-checks r2rc-checks--two">
                        @foreach ($whyOutsource as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="r2rc-btn r2rc-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="r2rc-split__media r2rc-split__media--portrait">
                    <img
                        src="{{ $img('why-outsource-r2r-services.webp') }}"
                        alt="Why outsource R2R services"
                        width="550"
                        height="647"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Key Activities --}}
        <section class="r2rc-section r2rc-section--tight" aria-labelledby="r2rc-key-title">
            <div class="site-shell r2rc-split">
                <div class="r2rc-split__media r2rc-split__media--portrait">
                    <img
                        src="{{ $img('key-activities.webp') }}"
                        alt="key activities in the outsourced r2r solutions and process"
                        width="400"
                        height="551"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="r2rc-split__copy">
                    <h2 id="r2rc-key-title">Key Activities in the Outsourced R2R Solutions and Process:</h2>
                    <div class="r2rc-key">
                        <ul class="r2rc-checks">
                            @foreach ($keyActivitiesPrimary as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <div class="r2rc-key__and">
                            <p class="r2rc-key__label">AND…</p>
                            <ul class="r2rc-checks">
                                @foreach ($keyActivitiesAnd as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a href="{{ $contactUrl }}" class="r2rc-btn r2rc-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Navy CTA --}}
        <section class="r2rc-band" aria-labelledby="r2rc-band-title">
            <div class="site-shell r2rc-band__inner">
                <p class="r2rc-band__kicker">We also offer -</p>
                <p class="r2rc-band__lede">
                    Strategic financial guidance, analysis, and decision-making support to drive overall financial performance and growth.
                </p>
                <h2 id="r2rc-band-title">Virtual CFO's Record-to-Report Solutions for Success</h2>
                <p class="r2rc-band__tag">Don't miss out on this game-changing opportunity!</p>
                <a href="{{ $contactUrl }}" class="r2rc-btn r2rc-btn--green" data-contact-modal-trigger>
                    GET STARTED NOW
                </a>
            </div>
        </section>

        {{-- Financial Success --}}
        <section class="r2rc-success" aria-labelledby="r2rc-success-title">
            <div class="site-shell r2rc-split">
                <div class="r2rc-split__media">
                    <img
                        src="{{ $img('financial-success.webp') }}"
                        alt="ibn technologies prioritizes your financial success"
                        width="311"
                        height="320"
                        decoding="async"
                    >
                </div>
                <div class="r2rc-split__copy">
                    <h2 id="r2rc-success-title">IBN Technologies Prioritizes Your Financial Success</h2>
                    <p>
                        Let IBN's remote R2R CFO Service be your strategic partner in achieving greatness. Manage your Virtual CFO journey with us. Unlock the true potential of your record to report process and drive financial excellence. Don't miss out on this exclusive opportunity to streamline your financial processes, trusted by a growing community of CFOs and business owners that avail IBN’s virtual CFO services including record-to-report solutions.
                    </p>
                    <p>
                        <strong>Join us and experience the power of IBN today! book your free consultation now</strong>
                    </p>
                    <a href="{{ $contactUrl }}" class="r2rc-btn r2rc-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
