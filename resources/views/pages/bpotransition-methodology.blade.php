@php
    $img = fn (string $file): string => asset('images/bpotransition-methodology/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $facilityItems = [
        'IBN’s Global Delivery Centre, Located at Pune, India',
        '24X7 Tech Support for All Processes | ISO 9001 : 2015 & ISO 27001: 2022 Certified',
        'Internet Lease Line’s from Multiple ISPs for Redundancy |100% Power Back up | CCTV Enabled 24×7 Security',
        'Secured & Rule Based Bio Metric Access | Comprehensive Business Contingency Plan in Place',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bpotransition-methodology.css'])
@endpush

@section('content')
    <div class="btm-page">
        {{-- Hero --}}
        <section class="btm-hero" aria-labelledby="btm-hero-title">
            <div class="site-shell btm-hero__inner">
                <div class="btm-hero__copy">
                    <h1 id="btm-hero-title">Transition Methodology</h1>
                    <a href="{{ $contactUrl }}" class="btm-btn btm-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="btm-hero__visual">
                    <img
                        src="{{ $img('bookkeeping-it-businesses.png') }}"
                        alt=""
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Transition management / quality commitment --}}
        <section class="btm-split" aria-label="Transition management">
            <div class="site-shell btm-split__inner">
                <div class="btm-split__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="outsourced bookkeeping services"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="btm-split__copy">
                    <p>
                        IBNis ISO 9001 : 2015 certified company so we follow strict quality measures. We make sure that all risks should be minimized for clients wishing to move business processes offshore. Whether the risks involve security, quality, or timeliness of delivery, we are fully committed to 100% client satisfaction. From the beginning of a project, we assign onshore and offshore engagement managers to ensure success. We also ensure that each delivery center in India has made the requisite investments in infrastructure to ensure it can produce best-in-class services. Furthermore, we ensure delivery processes give emphasis risk management. The objective of risk management is to identify risk conditions and track them during the entire lifecycle of the project. In a world where excellence in execution is the key to success, IBN has proven track record of world-class delivery.
                    </p>
                    <a href="{{ $contactUrl }}" class="btm-btn btm-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Facility / infrastructure --}}
        <section class="btm-split btm-split--reverse" aria-labelledby="btm-facility-title">
            <div class="site-shell btm-split__inner">
                <div class="btm-split__copy">
                    <h2 id="btm-facility-title">Facility with State of the Art Infrastructure</h2>
                    <ul class="btm-list">
                        @foreach ($facilityItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="btm-btn btm-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="btm-split__media">
                    <img
                        src="{{ $img('outsourced-bookkeeping-services.webp') }}"
                        alt="outsourced bookkeeping services"
                        width="526"
                        height="469"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Methodology infographic --}}
        <section class="btm-infographic" aria-label="Transition methodology phases">
            <div class="site-shell btm-infographic__inner">
                <img
                    src="{{ $img('transition-methodology-infographic.jpg') }}"
                    alt="Transition Methodology-Infographic"
                    width="611"
                    height="768"
                    loading="lazy"
                    decoding="async"
                >
            </div>
        </section>
    </div>
@endsection
