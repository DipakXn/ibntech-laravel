@php
    $img = fn (string $file): string => asset('images/hedgefund-administration/'.$file);

    $formServiceOptions = [
        'Fund Administration',
        'Hedge Fund Accounting Services',
        'Tax Services',
        'Investor Services',
        'AML Compliance',
        'Bookkeeping Services',
    ];

    $accountingServices = [
        'Updating trading activity from front-end trading systems or Automatic Updation in system',
        'Trade & Position reconciliation with prime brokers',
        'Independently calculate and record income and expense accruals and reconcile with prime brokers’ activities',
        'Calculate and record management fees in accordance with fund documents',
        'Calculate and record incentive fees per fund documents',
        'Preparation and maintenance of complete set of books, from a comprehensive General Ledger, Trial Balances, security ledgers, realized capital gain /loss statements, Income and Expense statements, to all other necessary supporting schedules',
        'Calculate NAV for each share class in accordance with fund documents',
        'Preparation of Financial Statements for each period end',
    ];

    $investorServices = [
        'Accept investor subscription & redemption documents',
        'Perform AML procedures in accordance with local AML laws and regulations',
        'Maintain investor contact database',
        'Prepare an account statement for each investor',
        'Compute monthly and year-to-date gross and net performance for each investor or share class',
        'Distribute monthly statements, notices, audit reports, and tax forms to investor',
    ];

    $featureCards = [
        [
            'icon' => 'investor-services-icon.webp',
            'icon_alt' => 'investor services',
            'title' => 'Investor Services',
            'text' => 'IBN will work closely with Fund’s auditor and ensure timely and efficient completion of the annual audit. As Fund Administrator IBN prepares and provides schedules, reports, explaining transactions and other general assistance in Audit',
        ],
        [
            'icon' => 'aml-compliance.webp',
            'icon_alt' => 'aml compliance',
            'title' => 'AML Compliance',
            'text' => 'IBN will ensure compliance with Anti-Money Laundering requirements as needed by local regulatory bodies. Applying necessary AML policies and procedures maintain required investor information and records of AML activities and providing information requested by governmental and regulatory bodies',
        ],
        [
            'icon' => 'reconcile-pricing-financial-instruments.webp',
            'icon_alt' => 'reconcile & pricing financial instruments',
            'title' => 'Reconcile & pricing Financial Instruments',
            'text' => 'Compare securities/ financial instrument pricing to independent pricing provided and ensuring that manager priced securities comply with fund pricing policy. IBN also helps in discovering the price of the Financial Instruments which are not readily available by using independent third party service provider.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/hedgefund-administration.css'])
@endpush

@section('content')
    <div class="hfa-page">
        {{-- Hero --}}
        <section class="hfa-hero" aria-labelledby="hfa-hero-title">
            <div class="site-shell hfa-hero__inner">
                <div class="hfa-hero__copy">
                    <h1 id="hfa-hero-title">Fund Administration Services</h1>
                    <p class="hfa-hero__lede">
                        IBN is an independent global service provider who offers a full suite of comprehensive administration outsourcing services to Fund administrators and hedge funds.
                    </p>
                    <div class="hfa-hero__actions">
                        <a href="#request-form-demo" class="hfa-btn hfa-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="hfa-hero__media">
                    <img
                        src="{{ $img('fund-banner.webp') }}"
                        alt="Fund Administration services"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Fund Administration Outsourcing --}}
        <section class="hfa-section" aria-labelledby="hfa-outsource-title">
            <div class="site-shell hfa-intro">
                <div class="hfa-intro__media">
                    <img
                        src="{{ $img('fund-administration-outsourcing.webp') }}"
                        alt="fund administration outsourcing"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="hfa-intro__copy">
                    <h2 id="hfa-outsource-title">Fund Administration Outsourcing</h2>
                    <p>
                        <strong><a href="{{ route('home') }}">IBN</a></strong>
                        is an independent global service provider who offers a full suite of comprehensive administration outsourcing services to Fund administrators and hedge funds. Over 10 years of operations, we have acquired expertise in back office fund administration by working with different fund administrators and other services providers. Value proposition of our Fund Outsourcing services is flexibility, reliability and transparency.
                    </p>
                    <p>
                        Our fund administration services can be customized to best fit our clients’ individual requirements. Key differentiator of our back office service is that we provide our clients with global client relationship manager who has responsibility for service delivery and quality standards.
                    </p>
                </div>
            </div>
        </section>

        {{-- Hedge Fund Accounting Services --}}
        <section class="hfa-section hfa-section--tight" aria-labelledby="hfa-accounting-title">
            <div class="site-shell">
                <div class="hfa-panel">
                    <div class="hfa-panel__copy">
                        <h2 id="hfa-accounting-title">Hedge Fund Accounting Services</h2>
                        <ul class="hfa-list">
                            @foreach ($accountingServices as $item)
                                <li>
                                    <span class="hfa-list__icon" aria-hidden="true">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#request-form-demo" class="hfa-btn hfa-btn--cream">
                            Get a Free Consultation Today
                        </a>
                    </div>
                    <div class="hfa-panel__media">
                        <img
                            src="{{ $img('fund-accounting-services.webp') }}"
                            alt="fund accounting services"
                            width="700"
                            height="700"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Tax Services --}}
        <section class="hfa-tax" aria-labelledby="hfa-tax-title">
            <div class="site-shell hfa-tax__inner">
                <h2 id="hfa-tax-title">Tax Services</h2>
                <p>
                    Preparation of preliminary tax allocation based on tax allocation method selected by fund and report for review of funds auditor; preparation of draft Federal K1 Forms (subject to the review and approval of all allocations and footnotes by the funds auditor and tax advisor)
                </p>
                <a href="#request-form-demo" class="hfa-btn hfa-btn--navy">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        {{-- Investor Services --}}
        <section class="hfa-section" aria-labelledby="hfa-investor-title">
            <div class="site-shell">
                <div class="hfa-panel">
                    <div class="hfa-panel__copy">
                        <h2 id="hfa-investor-title">Investor Services</h2>
                        <ul class="hfa-list">
                            @foreach ($investorServices as $item)
                                <li>
                                    <span class="hfa-list__icon" aria-hidden="true">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#request-form-demo" class="hfa-btn hfa-btn--cream">
                            Get a Free Consultation Today
                        </a>
                    </div>
                    <div class="hfa-panel__media">
                        <img
                            src="{{ $img('Investor-Services.webp') }}"
                            alt="Investor-Services"
                            width="600"
                            height="600"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Feature cards --}}
        <section class="hfa-section hfa-features" aria-labelledby="hfa-features-title">
            <div class="site-shell">
                <h2 id="hfa-features-title" class="sr-only">Fund administration capabilities</h2>
                <div class="hfa-cards">
                    @foreach ($featureCards as $card)
                        <article class="hfa-card">
                            <img
                                src="{{ $img($card['icon']) }}"
                                alt="{{ $card['icon_alt'] }}"
                                width="60"
                                height="60"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="hfa-section hfa-consult"
            id="request-form-demo"
            aria-labelledby="hfa-consult-title"
        >
            <div class="site-shell hfa-consult__inner">
                <aside class="hfa-consult__card" aria-labelledby="hfa-consult-title">
                    <div class="hfa-consult__header">
                        <h2 id="hfa-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="hfa-consult__body">
                        <livewire:forms.contact-form
                            form-name="hedgefund-administration"
                            id-prefix="hfa"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="hfa-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="form Image"
                        width="540"
                        height="364"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
