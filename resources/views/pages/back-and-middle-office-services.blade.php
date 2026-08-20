@php
    $img = fn (string $file): string => asset('images/back-and-middle-office-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $backOfficeServices = [
        'Fund/Indices Performance Tracking',
        'Fund Exposure Tracking Service',
        'Trade Position Processing',
        'Document Management service',
        'NAV Calculation',
        'Shadow NAV Calculation',
        'Data Reconciliation Services',
        'Fund P&L allocation',
        'Financial Statements Preparation',
        'Manager & Incentive Fees Calculation',
        'Audit Support',
        'Contact Data Research',
    ];

    $middleOfficeServices = [
        'Daily P&L Calculation',
        'P&L Trade Reconciliation',
        'Subscription, Redemption & Transfer',
        'Cash Reconciliations',
        'Correspondence Processing',
        'Trade Settlement & Reconciliation',
        'Client Contact Management',
        'Corporate Action',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/back-and-middle-office-services.css'])
@endpush

@section('content')
    <div class="bmo-page">
        {{-- Hero --}}
        <section class="bmo-hero" aria-labelledby="bmo-hero-title">
            <div class="site-shell bmo-hero__inner">
                <div class="bmo-hero__copy">
                    <h1 id="bmo-hero-title">
                        Back &amp; Middle<br>
                        Office Services
                    </h1>
                    <p class="bmo-hero__lede">
                        IBN is one of the pioneer in providing Fund Middle &amp; Back Office Services to Hedge Funds &amp; Fund of Hedge Funds, Fund Administrators with over period of 12 years of experience.
                    </p>
                    <div class="bmo-hero__actions">
                        <a href="#request-form-demo" class="bmo-btn bmo-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="bmo-hero__media">
                    <img
                        src="{{ $img('banner-1.webp') }}"
                        alt="Back and middle office services"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="bmo-section" aria-labelledby="bmo-intro-title">
            <div class="site-shell">
                <div class="bmo-intro">
                    <h2 id="bmo-intro-title">IBN Back &amp; Middle Office Services</h2>
                    <p>
                        IBN is one of the pioneer in providing Fund Middle &amp; Back Office Services to Hedge Funds &amp; Fund of Hedge Funds, Fund Administrators with over period of 12 years of experience. We have been persistently deriving the desired results for our impressive list of clientele which includes MAN (FRM) Group (UK), Protégé (USA) by way of our successful business model encapsulated with our strategic and tactical foresight, called the threefold path of-innovation, value-creation, optimization with committed expertise.
                    </p>
                    <p>
                        IBN offers wide range of middle &amp; back office fund services to alternative investment domain from its global delivery center based in Pune, India. Our global presence indicates our values to provide full support to our clients located globally and ensure that clients requirements are met efficiently and effectively in timely manner.
                    </p>
                </div>

                <div class="bmo-photos">
                    <figure class="bmo-photos__item">
                        <img
                            src="{{ $img('Back-Middle-Office-Services-1-1.webp') }}"
                            alt="IBN fund back and middle office professional"
                            width="550"
                            height="550"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                    <figure class="bmo-photos__item">
                        <img
                            src="{{ $img('Back-Middle-Office-Services-2.webp') }}"
                            alt="Fund operations and trading monitors"
                            width="550"
                            height="550"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                </div>
            </div>
        </section>

        {{-- Statement --}}
        <section class="bmo-section bmo-statement" aria-labelledby="bmo-statement-title">
            <div class="site-shell">
                <h2 id="bmo-statement-title">
                    IBN have been consistently providing its Mid &amp; Back-office fund services to their clients and through continuous affords we ensure that our fund services satisfy the requirements of our clients globally.
                </h2>
            </div>
        </section>

        {{-- Service lists --}}
        <section class="bmo-section bmo-services" aria-labelledby="bmo-services-title">
            <div class="site-shell">
                <h2 id="bmo-services-title" class="sr-only">Fund Back and Middle Office Services</h2>

                <div class="bmo-service-cols">
                    <article class="bmo-service-card bmo-service-card--navy" aria-labelledby="bmo-back-title">
                        <header class="bmo-service-card__header">
                            <img
                                src="{{ $img('back-office-icon.webp') }}"
                                alt="back-office-icon"
                                width="90"
                                height="90"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3 id="bmo-back-title">IBN Fund Back Office Services includes:</h3>
                        </header>
                        <ul class="bmo-service-list">
                            @foreach ($backOfficeServices as $item)
                                <li>
                                    <i class="fa-solid fa-circle-right" aria-hidden="true"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="bmo-service-card bmo-service-card--mint" aria-labelledby="bmo-middle-title">
                        <header class="bmo-service-card__header">
                            <img
                                src="{{ $img('ibn-fund-middle-office-services-includes-icons.webp') }}"
                                alt="IBN Fund Middle Office Services includes:"
                                width="47"
                                height="47"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3 id="bmo-middle-title">IBN Fund Middle Office Services includes:</h3>
                        </header>
                        <ul class="bmo-service-list">
                            @foreach ($middleOfficeServices as $item)
                                <li>
                                    <i class="fa-solid fa-circle-right" aria-hidden="true"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="bmo-section bmo-consult"
            id="request-form-demo"
            aria-labelledby="bmo-consult-title"
        >
            <div class="site-shell bmo-consult__inner">
                <aside class="bmo-consult__card" aria-labelledby="bmo-consult-title">
                    <div class="bmo-consult__header">
                        <h2 id="bmo-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="bmo-consult__body">
                        <livewire:forms.contact-form
                            form-name="back-and-middle-office-services"
                            id-prefix="bmo"
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

                <div class="bmo-consult__media">
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
