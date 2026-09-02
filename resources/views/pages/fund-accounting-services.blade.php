@php
    $img = fn (string $file): string => asset('images/fund-accounting-services/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/fund-accounting-services.css'])
@endpush

@section('content')
    <div class="facs-page">
        {{-- Hero --}}
        <section class="facs-hero" aria-labelledby="facs-hero-title">
            <div class="site-shell facs-hero__inner">
                <div class="facs-hero__copy">
                    <h1 id="facs-hero-title">Fund Accounting Services</h1>
                    <a href="{{ $contactUrl }}" class="facs-btn facs-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="facs-hero__media">
                    <img
                        src="{{ $img('fund-accounting-banner.webp') }}"
                        alt="Fund accounting"
                        width="560"
                        height="500"
                        decoding="async"
                        fetchpriority="high"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="facs-intro" aria-labelledby="facs-intro-title">
            <div class="site-shell facs-intro__inner">
                <div class="facs-intro__media">
                    <img
                        src="{{ $img('fund-accounting-services.webp') }}"
                        alt="Professional reviewing fund accounting records"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="facs-intro__copy">
                    <h2 id="facs-intro-title">Fund Accounting Services</h2>
                    <p>
                        At the end of each accounting period IBN gathers Financial Data from Brokers, and other sources and reconciles internal records with the gathered data.
                    </p>
                    <p>
                        Enters all Financial and Investor transactions into Advent Axys Software and calculates management fees, loss carry forwards, and incentive allocations in accordance with Fund Offering documents and US GAAP. It covered the following
                    </p>
                    <a href="{{ $contactUrl }}" class="facs-btn facs-btn--navy" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Solutions panel --}}
        <section class="facs-panel" aria-label="Fund accounting solutions">
            <div class="site-shell facs-panel__inner">
                <div class="facs-panel__copy">
                    <ul>
                        <li>IBN Technologies offers a complete fund accounting solution, servicing a wide array of investment vehicles and fund structures with customized, full-service back-office support.</li>
                        <li>In todays challenging environment, clients trust IBN Technologies robust operating models to minimize risk and guarantee seamless execution.</li>
                        <li>IBN can ensure that fully reconciled Net Asset Value calculations are reported in a timely and accurate manner for Hedge funds. Our technology allows Investment accounting &amp; reporting tasks completion faster, easier and more accurate. It covers instruments such as Equities / ETF, Derivatives, Fixed income, Automatic calculation of accrued interest, accretion and amortization. Funds: Mutual Funds, Private Equity, Master-Feeder structures and Multy currency. The Inventory methods can be used as FIFO, LIFO, specific tax lot, Maximum/Minimum gain, average cost accounting.</li>
                    </ul>
                    <a href="{{ $contactUrl }}" class="facs-btn facs-btn--cream" data-contact-modal-trigger>
                        Get a Free Consultation Today
                    </a>
                </div>
                <div class="facs-panel__media">
                    <img
                        src="{{ $img('fund-accounting-3rd-image.webp') }}"
                        alt="Fund accounting reporting, NAV calculation, and financial analysis"
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
