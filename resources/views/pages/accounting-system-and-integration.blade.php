@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/accounting-system-and-integration.css'])
@endpush

@section('content')
    <div class="asi-page">
        {{-- Hero --}}
        <section class="asi-hero" aria-labelledby="asi-hero-title">
            <img
                class="asi-hero__bg"
                src="{{ asset('images/accounting-system-and-integration/accounting-system-and-integration.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell asi-hero__inner">
                <div class="asi-hero__copy">
                    <h1 id="asi-hero-title">Accounting System and Integration</h1>
                    <div class="asi-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="asi-btn asi-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="asi-section" aria-labelledby="asi-intro-title">
            <div class="site-shell asi-intro">
                <h2 id="asi-intro-title">Accounting System and Integration</h2>
                <p>
                    An integrated framework to improve processes and ensure financial stability giving the holistic view of different functional areas of your business such as point of sale, stores, back office and front office. The adoption of an integrated financial system enhances your speed, accuracy and efficiency of processing financial information.
                </p>
                <p>
                    Leveraging finance and accounting services outsourcing as a strategy to change operating models, IBNS hold’s 15 years+ expertise in delivering timely and accurate continuous results for its 250 esteemed clients across the globe.
                </p>
            </div>
        </section>
    </div>
@endsection
