@php
    $img = fn (string $file): string => asset('images/us-uk-tax-preparation-services/'.$file);

    $usaServices = [
        'Income tax- preparation and submission of online Tax returns of Individuals, Corporations and most tax filing entities',
        'Providing expert advice in areas of Capital Gains Tax, Capital Acquisitions Tax, Gift Tax, Inheritance Tax and tax planning.',
    ];

    $entities = [
        'Individuals – Form 1040, Form 1040A, Form 1040EZ, Form 1040NR, etc.',
        'Partnerships – Form 1065',
        'Corporations Form 1120, Form 1120s etc.',
        'Estates and trusts- Form 1041 etc.',
        'Non-profits – Form 990',
        'Gift Tax Form 706/709',
    ];

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/us-uk-tax-preparation-services.css'])
@endpush

@section('content')
    <div class="usuktax-page">
        {{-- Hero --}}
        <section class="usuktax-hero" aria-labelledby="usuktax-hero-title">
            <div class="site-shell usuktax-hero__inner">
                <div class="usuktax-hero__copy">
                    <h1 id="usuktax-hero-title">USA &amp; UK Tax Preparation Services</h1>
                    <p class="usuktax-hero__lede">
                        IBN handles tax preparation services for all size of businesses in USA and UK
                    </p>
                    <div class="usuktax-hero__actions">
                        <a href="#usuktax-consult" class="usuktax-btn usuktax-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="usuktax-hero__media">
                    <img
                        src="{{ $img('hero.webp') }}"
                        alt="USA and UK tax preparation services illustration"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- US Taxation Expertise --}}
        <section class="usuktax-section" aria-labelledby="usuktax-expertise-title">
            <div class="site-shell usuktax-intro">
                <div class="usuktax-intro__media">
                    <img
                        src="{{ $img('us-taxation-expertise.webp') }}"
                        alt="US taxation expertise"
                        width="550"
                        height="550"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="usuktax-intro__copy">
                    <h2 id="usuktax-expertise-title">US Taxation Expertise</h2>
                    <p>
                        IBN handles <strong><a href="{{ route('blog.show', ['slug' => 'outsourcing-tax-preparation-services']) }}">tax preparation services</a></strong> for all size of businesses in the USA. Our team of experts uses the best practices and processes for rendering tax preparation services in the USA. This provides better space to current clientele for generating better returns and lesser tax liabilities.
                    </p>
                    <p>
                        IBN’s team of Chartered Accountants and Certified Public Accountants &amp; Tax professionals with more than <strong>20 years</strong> of experience in liaising with our clients based in USA and provide an optimum delivery model for tax preparation services in USA. By availing <a href="{{ route('home') }}">IBN</a> planning and advisory services, within a secure framework of compliance to minimize operating cost and maximize efficiency and achieve competitive advantage.
                    </p>
                    <a href="#usuktax-consult" class="usuktax-btn usuktax-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- USA services --}}
        <section class="usuktax-section usuktax-section--tight" aria-labelledby="usuktax-services-title">
            <div class="site-shell">
                <div class="usuktax-panel">
                    <div class="usuktax-panel__copy">
                        <h2 id="usuktax-services-title">Our tax preparation services in USA include:</h2>
                        <ul class="usuktax-list">
                            @foreach ($usaServices as $item)
                                <li>
                                    <span class="usuktax-list__icon" aria-hidden="true">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#usuktax-consult" class="usuktax-btn usuktax-btn--cream">
                            Get a Free Consultation Today
                        </a>
                    </div>
                    <div class="usuktax-panel__media">
                        <img
                            src="{{ $img('usa-services.webp') }}"
                            alt="USA tax preparation services"
                            width="560"
                            height="500"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </div>
        </section>

        {{-- Entities --}}
        <section class="usuktax-entities" aria-labelledby="usuktax-entities-title">
            <div class="site-shell usuktax-entities__inner">
                <div class="usuktax-entities__media">
                    <img
                        src="{{ $img('tax-entities.webp') }}"
                        alt="Tax entities and filing forms"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="usuktax-entities__copy">
                    <h2 id="usuktax-entities-title">IBN’s team of Tax accountants is proficient in providing following entities:</h2>
                    <ul class="usuktax-list usuktax-list--dark">
                        @foreach ($entities as $item)
                            <li>
                                <span class="usuktax-list__icon" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#usuktax-consult" class="usuktax-btn usuktax-btn--cream">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>


        {{-- Contact form --}}
        <section
            class="usuktax-section usuktax-consult"
            id="usuktax-consult"
            aria-labelledby="usuktax-consult-title"
        >
            <div class="site-shell usuktax-consult__inner">
                <aside class="usuktax-consult__card" aria-labelledby="usuktax-consult-title">
                    <div class="usuktax-consult__header">
                        <h2 id="usuktax-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="usuktax-consult__body">
                        <livewire:forms.contact-form
                            form-name="us-uk-tax-preparation-services"
                            id-prefix="usuktax"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="Tell us how we can help"
                            submit-label="Submit"
                            layout="home"
                            :message-rows="4"
                            wire:key="us-uk-tax-preparation-services-consult"
                        />
                    </div>
                </aside>

                <div class="usuktax-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="Tax expert available to schedule a call"
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
