@php
    $img = fn (string $file): string => asset('images/business-partner/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $timeBenefits = [
        'Allows to plan round the clock operations.',
        'Data Processed & critical reports prepared overnight.',
        'Allows you to focus on business rather than on back office functions.',
        'Streamlining priorities to avoid loss of business',
    ];

    $staffBenefits = [
        'Highly Skilled Staff & already have experience working in US Processes which minimizes the cultural gap.',
        'Wide Range of Industry experience from Finance & Accounting.',
        'Right Level staff for different requirements',
        'Reduce key employee risk as staff redundancy for each process is inbuilt in IBN’s outsourcing approach.',
    ];

    $businessBenefits = [
        'Cost Advantage',
        'Save on Infrastructure and Technology for outsourced staff.',
        'Access to Skilled Resources for expansion at short notice.',
        'Time Zone Advantage.',
    ];

    $costBenefits = [
        'Lower cost of operations by 40%.',
        'No Training & Hiring Cost.',
        'No Overhead Cost. No Employee Benefit Costs',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/business-partner.css'])
@endpush

@section('content')
    <div class="bp-page">
        {{-- Hero --}}
        <section class="bp-hero" aria-labelledby="bp-hero-title">
            <div class="site-shell bp-hero__inner">
                <div class="bp-hero__copy">
                    <p class="bp-hero__eyebrow">Your business partner in the Accounting world</p>
                    <h1 id="bp-hero-title">Partner with IBN Tech – Scalable Outsourcing for Business Growth</h1>
                    <a href="{{ $contactUrl }}" class="bp-btn bp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="bp-hero__media">
                    <img
                        src="{{ $img('bookkeeping-for-marketing-and-advertising-companies.webp') }}"
                        alt="bookkeeping for marketing and advertising companies"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Introduction --}}
        <section class="bp-split" aria-label="IBN Partner program">
            <div class="site-shell bp-split__inner">
                <div class="bp-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="bp-split__copy">
                    <p>Our power of choice is untrammeled and when nothing prevents being able to do what we like best every pleasure.</p>
                    <p>IBN Partner program is exclusively developed to grow your business &amp; build sustainable relationship with your clients by providing timely and accurate service from IBN.</p>
                    <p>Partnership program will help you to focus on new services, new customers and other core business issues.</p>
                    <a href="{{ $contactUrl }}" class="bp-btn bp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Time Benefits --}}
        <section class="bp-split bp-split--reverse" aria-labelledby="bp-profile-title">
            <div class="site-shell bp-split__inner">
                <div class="bp-split__copy">
                    <h2 id="bp-profile-title">Download Our Comprehensive Profile and Services.</h2>
                    <h3>Time Benefits</h3>
                    <ul class="bp-list">
                        @foreach ($timeBenefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="bp-btn bp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="bp-split__media">
                    <img
                        src="{{ $img('customized-bookkeeping-solutions.webp') }}"
                        alt="customized bookkeeping solutions"
                        width="502"
                        height="448"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Staff Benefits --}}
        <section class="bp-split" aria-labelledby="bp-staff-title">
            <div class="site-shell bp-split__inner">
                <div class="bp-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="bp-split__copy">
                    <h2 id="bp-staff-title">Staff Benefits</h2>
                    <ul class="bp-list">
                        @foreach ($staffBenefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="bp-btn bp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Business Benefits --}}
        <section class="bp-split bp-split--reverse" aria-labelledby="bp-business-title">
            <div class="site-shell bp-split__inner">
                <div class="bp-split__copy">
                    <h2 id="bp-business-title">Business Benefits</h2>
                    <ul class="bp-list">
                        @foreach ($businessBenefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="bp-btn bp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="bp-split__media">
                    <img
                        src="{{ $img('customized-bookkeeping-solutions.webp') }}"
                        alt="customized bookkeeping solutions"
                        width="502"
                        height="448"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Cost Benefits --}}
        <section class="bp-split" aria-labelledby="bp-cost-title">
            <div class="site-shell bp-split__inner">
                <div class="bp-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="bp-split__copy">
                    <h2 id="bp-cost-title">Cost Benefits</h2>
                    <ul class="bp-list">
                        @foreach ($costBenefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $contactUrl }}" class="bp-btn bp-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
