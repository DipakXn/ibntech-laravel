@php
    $img = fn (string $file): string => asset('images/cfo-services/'.$file);

    $formServiceOptions = [
        'CFO Services',
        'Virtual CFO Services',
        'Bookkeeping Services',
        'Payroll Processing',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/cfo-services.css'])
@endpush

@section('content')
    <div class="cfosvc-page">
        {{-- Hero --}}
        <section class="cfosvc-hero" aria-labelledby="cfosvc-hero-title">
            <div class="site-shell cfosvc-hero__inner">
                <div class="cfosvc-hero__copy">
                    <h1 id="cfosvc-hero-title">CFO Services</h1>
                    <p class="cfosvc-hero__lede">
                        In USA | For Small Business | Outsourced | Fractional | Part Time | Virtual
                    </p>
                    <div class="cfosvc-hero__actions">
                        <a href="#accounting-enquire" class="cfosvc-btn cfosvc-btn--cream">
                            Free Consultation
                        </a>
                    </div>
                </div>

                <div class="cfosvc-hero__media">
                    <img
                        src="{{ $img('banner.webp') }}"
                        alt="CFO Services"
                        width="550"
                        height="398"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Virtual CFO Services --}}
        <section class="cfosvc-section" aria-labelledby="cfosvc-intro-title">
            <div class="site-shell cfosvc-intro">
                <div class="cfosvc-intro__media">
                    <img
                        src="{{ $img('virtual-cfo-services.webp') }}"
                        alt="virtual cfo services"
                        width="550"
                        height="550"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="cfosvc-intro__copy">
                    <h2 id="cfosvc-intro-title">Virtual CFO Services</h2>
                    <p>
                        CFO services are essential for any organization looking to achieve long-term financial success. IBN Tech’s virtual CFO services provide valuable financial guidance and analysis to help organizations make informed decisions.
                    </p>
                    <p>
                        Our CFO services in USA cover financial planning and analysis, budgeting and forecasting, cash flow management, financial reporting, and risk management. With an objective to help you, our clients, stay compliant with financial regulations, IBN Tech’s team develops strategies to improve financial performance, and assist with financial reporting and forecasting.
                    </p>
                    <p>
                        By leveraging the expertise of a virtual, part time or fractional CFO, small businesses and organizations can make forward-thinking financial decisions maximize their financial resources and improve their financial health. And with an offshore team of IBN Tech working as your extended finance and accounting arm, these CFO services come at a fraction of a cost when compared to CFO services in USA.
                    </p>
                    <a href="#accounting-enquire" class="cfosvc-btn cfosvc-btn--navy">
                        Free Consultation
                    </a>
                </div>
            </div>
        </section>

        {{-- Are you a CFO? --}}
        <section class="cfosvc-banner" aria-labelledby="cfosvc-banner-title">
            <div class="site-shell cfosvc-banner__inner">
                <h2 id="cfosvc-banner-title">Are you a CFO?</h2>
                <p>
                    We have something for you too! Checkout our service offerings for CFOs- CTAs for PDF of
                    <a href="{{ route('page.show', ['slug' => 'assistant-to-cfo-services']) }}">Assistance to CFO Services</a>.
                </p>
                <a href="#accounting-enquire" class="cfosvc-btn cfosvc-btn--green">
                    Free Consultation
                </a>
            </div>
        </section>

        {{-- CFO Expertise --}}
        <section class="cfosvc-expertise" aria-labelledby="cfosvc-expertise-title">
            <div class="site-shell cfosvc-expertise__inner">
                <h2 id="cfosvc-expertise-title">CFO Expertise</h2>
                <p>
                    IBN Tech offers CFO services for small businesses in USA as well as for growing organizations across the globe and that gives us an edge to be proactive with regards to the needs of your business’ financial processes. With a seasoned team offering over a decade of experience in outsourced finance and accounting services, IBN Tech’s CFO services are meant for organizations looking for a cost-effective, yet professional, accurate and an ‘always available’ option. With our experience, we help you set realistic and achievable financial goals, identify cost saving opportunities, and help develop strategies to improve the financial performance of your business.
                </p>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="cfosvc-section cfosvc-consult"
            id="accounting-enquire"
            aria-labelledby="cfosvc-consult-title"
        >
            <div class="site-shell cfosvc-consult__inner">
                <aside class="cfosvc-consult__card" aria-labelledby="cfosvc-consult-title">
                    <div class="cfosvc-consult__header">
                        <h2 id="cfosvc-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="cfosvc-consult__body">
                        <livewire:forms.contact-form
                            form-name="cfo-services"
                            id-prefix="cfosvc"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What services are you interested in?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="cfosvc-consult__media">
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
