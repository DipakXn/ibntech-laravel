@php
    $img = fn (string $file): string => asset('images/family-office-services/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $partnershipItems = [
        'Accounts Receivable and Fixed Asset modules',
        'Cheque writing and Accounts Payable',
        'Time & Attendance System maintenance',
        'Customisable chart of accounts',
        'Automated income and expense allocations, handles complex nested Family Office structures',
        'Post-implementation monitoring, fine-tuning, and analysis to guarantee continuous improvement.',
        'Fully integrated with portfolio accounting module',
        'All instruments types supported (derivatives, alternatives, private collectibles)',
        'Full multi-currency with forex evaluation',
        'Built in trade and position reconciliations',
        'Supports automated pricing and price variations reports',
        'Risk management reporting',
    ];

    $investorItems = [
        'Financial Statement Preparation',
        'Statements Available on demand',
        'Click of button report distribution',
    ];

    $middleOfficeItems = [
        'Software and people solutions to support Family Offices',
        'Outsourced trade settlement, reconciliations and reporting allowing Family',
        'Offices to concentrate on investment decisions',
        'Improved internal controls and enhanced reporting capabilities',
        'Personalised service built around the Family offices workflows',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/family-office-services.css'])
@endpush

@section('content')
    <div class="fos-page">
        {{-- Hero --}}
        <section class="fos-hero" aria-labelledby="fos-hero-title">
            <div class="site-shell fos-hero__inner">
                <div class="fos-hero__copy">
                    <h1 id="fos-hero-title">Family Office Services</h1>
                    <p class="fos-hero__lede">
                        IBN can partner with your Family Office to carry out:
                    </p>
                    <div class="fos-hero__actions">
                        <a href="#request-form-demo" class="fos-btn fos-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="fos-hero__media">
                    <img
                        src="{{ $img('family-office-banner.webp') }}"
                        alt="family-office-banner"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Your future-ready family office --}}
        <section class="fos-section" aria-labelledby="fos-intro-title">
            <div class="site-shell fos-intro">
                <div class="fos-intro__media">
                    <img
                        src="{{ $img('family-office.webp') }}"
                        alt="family office"
                        width="550"
                        height="550"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="fos-intro__copy">
                    <h2 id="fos-intro-title">Your future-ready family office</h2>
                    <p>
                        <a href="{{ route('home') }}">IBN Technologies</a> Limited is one of the initial service providers of Hedge Fund (BPO), Fund Accounting, Quantitative Risk Analysis &amp; Reporting services to Hedge Funds, Fund of Hedge Funds, Private Equity and Family Offices across UK and USA with AUM of USD 20 Billion.
                    </p>
                    <p>
                        As your future-ready family office partner, we leverage cutting-edge technology and industry expertise to ensure your wealth management strategies are prepared for tomorrow's challenges.
                    </p>
                    <p>
                        We have been persistently deriving the desired results for our impressive list of clientele which includes leading names from industry and other family offices by delivering bespoke services through its committed expertise. By engaging with IBN our clients have been able to save 30 % 40% costs as compared to US and UK costs.
                    </p>
                </div>
            </div>
        </section>

        {{-- Partnership and Trust Accounting --}}
        <section class="fos-section fos-section--tight" aria-labelledby="fos-partnership-title">
            <div class="site-shell">
                <div class="fos-panel">
                    <div class="fos-panel__copy">
                        <h2 id="fos-partnership-title">Partnership and Trust Accounting with IBN Tech</h2>
                        <ul class="fos-list">
                            @foreach ($partnershipItems as $item)
                                <li>
                                    <span class="fos-list__icon" aria-hidden="true">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#request-form-demo" class="fos-btn fos-btn--white">
                            Get a Free Consultation Today
                        </a>
                    </div>
                    <div class="fos-panel__media">
                        <img
                            src="{{ $img('partnership-and-trust-accounting.webp') }}"
                            alt="partnership and trust accounting"
                            width="560"
                            height="500"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Investor Accounting --}}
        <section class="fos-investor" aria-labelledby="fos-investor-title">
            <div class="site-shell fos-investor__inner">
                <div class="fos-investor__media">
                    <img
                        src="{{ $img('investor-accounting.webp') }}"
                        alt="investor accounting"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="fos-investor__copy">
                    <h2 id="fos-investor-title">Investor Accounting</h2>
                    <ul class="fos-list fos-list--dark">
                        @foreach ($investorItems as $item)
                            <li>
                                <span class="fos-list__icon" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#request-form-demo" class="fos-btn fos-btn--cream">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Middle Office Services --}}
        <section class="fos-section" aria-labelledby="fos-middle-title">
            <div class="site-shell">
                <div class="fos-panel">
                    <div class="fos-panel__copy fos-panel__copy--green">
                        <h2 id="fos-middle-title">Middle Office Services</h2>
                        <ul class="fos-list">
                            @foreach ($middleOfficeItems as $item)
                                <li>
                                    <span class="fos-list__icon fos-list__icon--on-green" aria-hidden="true">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#request-form-demo" class="fos-btn fos-btn--on-green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                    <div class="fos-panel__media">
                        <img
                            src="{{ $img('middle-office-services.webp') }}"
                            alt="middle office services"
                            width="560"
                            height="500"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="fos-section fos-consult"
            id="request-form-demo"
            aria-labelledby="fos-consult-title"
        >
            <div class="site-shell fos-consult__inner">
                <aside class="fos-consult__card" aria-labelledby="fos-consult-title">
                    <div class="fos-consult__header">
                        <h2 id="fos-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="fos-consult__body">
                        <livewire:forms.contact-form
                            form-name="family-office-services"
                            id-prefix="fos"
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

                <div class="fos-consult__media">
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
