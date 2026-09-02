@php
    $img = fn (string $file): string => asset('images/outsourced-bookkeeping-services-usa/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $heroBullets = [
        '50+ Certified Bookkeepers on US Accounting available On Demand.',
        'Price $10/H Basis. More than 3 Seats ask for Enterprise Pricing.',
        'ISO Certified | Cert Certified for Data Security | Cloud Environment',
    ];

    $processSteps = [
        [
            'icon' => 'consultation.webp',
            'alt' => 'consultation',
            'title' => 'Step 1: Consultation',
            'text' => 'Understand your business needs.',
        ],
        [
            'icon' => 'onboarding.webp',
            'alt' => 'onboarding',
            'title' => 'Step 2 : Onboarding',
            'text' => 'Seamlessly integrate with your existing systems.',
        ],
        [
            'icon' => 'execution.webp',
            'alt' => 'execution',
            'title' => 'Step 3: Execution',
            'text' => 'Expert team members handle your bookkeeping tasks.',
        ],
        [
            'icon' => 'review.webp',
            'alt' => 'review',
            'title' => 'Step 4 : Review',
            'text' => 'Regular check-ins and reports ensure transparency.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/outsourced-bookkeeping-services-usa.css'])
@endpush

@section('content')
    <div class="obkusa-page">
        <section class="obkusa-hero" aria-labelledby="obkusa-hero-title">
            <div class="site-shell obkusa-hero__inner">
                <div class="obkusa-hero__copy">
                    <h1 id="obkusa-hero-title">Outsourced Bookkeeping Services Usa</h1>
                    <p class="obkusa-hero__subhead">Pay As You Go, 40% + Cost Reduction.</p>
                    <ul class="obkusa-hero__list">
                        @foreach ($heroBullets as $bullet)
                            <li>{{ $bullet }}</li>
                        @endforeach
                    </ul>
                    <p class="obkusa-hero__note">Scalable With Short Notice</p>
                    <div class="obkusa-hero__actions">
                        <a href="{{ $contactUrl }}" class="obkusa-btn">Get a Free Consultation Today</a>
                    </div>
                </div>
                <div class="obkusa-hero__media">
                    <img
                        src="{{ $img('signs-you-need-offshore-bookkeeping.webp') }}"
                        alt="Signs You Need Offshore Bookkeeping"
                        width="468"
                        height="550"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="obkusa-section" aria-labelledby="obkusa-virtual-title">
            <div class="site-shell obkusa-center">
                <h2 id="obkusa-virtual-title">Delivering Virtual Book Keeping Services</h2>
                <p>
                    We become your reliable partner for end of end accounting services includes Bookkeeping, financial reporting, payroll, tax and other regulatory compliances. Our Capability deck showcase our experience working with Small &amp; Medium Business, CPA's &amp; Financial institutes for Bookkeeping ( F&amp;A ) &amp; Back office needs.
                </p>
                <p>
                    Our Experts in Transition based in US &amp; our Global delivery centre in India helps smooth transition &amp; create an environment wherein we become extended team to the client following clients operating procedures.
                </p>
                <div class="obkusa-section__cta">
                    <a href="{{ $contactUrl }}" class="obkusa-btn">Get a Free Consultation Today</a>
                </div>
            </div>
        </section>

        <section class="obkusa-section" aria-labelledby="obkusa-process-title">
            <div class="site-shell">
                <div class="obkusa-center">
                    <h2 id="obkusa-process-title">How We Work</h2>
                    <p>IBN Tech's streamlined outsourcing process ensures swift and efficient operations:</p>
                </div>

                <div class="obkusa-process" role="list">
                    @foreach ($processSteps as $step)
                        <article class="obkusa-process__card" role="listitem">
                            <img
                                src="{{ $img($step['icon']) }}"
                                alt="{{ $step['alt'] }}"
                                width="65"
                                height="65"
                                loading="lazy"
                                decoding="async"
                            >
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="obkusa-section__cta">
                    <a href="{{ $contactUrl }}" class="obkusa-btn">Get a Free Consultation Today</a>
                </div>
            </div>
        </section>
    </div>
@endsection
