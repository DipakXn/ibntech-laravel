@php
    $img = fn (string $file): string => asset('images/contact-us/'.$file);
    $flag = fn (string $file): string => asset('images/icons/'.$file);

    $offices = [
        [
            'name' => 'IBN Technologies LLC.',
            'flag' => $flag('united-states-flag-icon.webp'),
            'flag_alt' => 'United States flag',
            'address' => '66 West Flagler Street Suite 900 Miami, FL 33130',
            'maps' => 'https://maps.app.goo.gl/4EEkeP5cMpMuqQ7eA',
            'phones' => [
                ['label' => 'For Cybersecurity and Cloud:', 'href' => 'tel:+12815440740', 'number' => '+1-281-544-0740'],
                ['label' => 'For Finance & Accounting and Others:', 'href' => 'tel:+18446448440', 'number' => '+1-844-644-8440'],
            ],
        ],
        [
            'name' => 'IBN Tech Ltd.',
            'flag' => $flag('united-kingdom-flag-icon.webp'),
            'flag_alt' => 'United Kingdom flag',
            'address' => '30 Orange Street, London UK WC2H 7HF',
            'maps' => null,
            'phones' => [
                ['label' => 'For Cybersecurity and Cloud:', 'href' => 'tel:+442037699111', 'number' => '+44-203-769-9111'],
                ['label' => 'For Finance & Accounting and Others:', 'href' => 'tel:+448000418618', 'number' => '+44-800-041-8618'],
            ],
        ],
        [
            'name' => 'IBN Technologies Ltd.',
            'flag' => $flag('india-flag-icon.webp'),
            'flag_alt' => 'India flag',
            'address' => 'Kohinoor House, 2nd floor, 691/A/1B, Plot no. 7, Bibwewadi Road, Pune-411037, Maharashtra, India',
            'maps' => 'https://maps.app.goo.gl/dU7tzoresf64titT9',
            'phones' => [
                ['label' => null, 'href' => 'tel:02067680404', 'number' => '020-6768-0404'],
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/contact-us.css'])
@endpush

@section('content')
    <div class="cu-page">
        <section class="cu-hero" aria-labelledby="cu-hero-title">
            <div class="site-shell cu-hero__inner">
                <div class="cu-hero__copy">
                    <h1 id="cu-hero-title">Reach Our Expert Team</h1>
                    <p>Send a message through given form, If your enquiry is time sensitive please use below contact details.</p>
                </div>
                <div class="cu-hero__art">
                    <img
                        src="{{ $img('contact-us-banner-1.webp') }}"
                        alt="contact us"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="cu-panel" aria-label="Contact details and form">
            <div class="site-shell">
                <div class="cu-panel__card">
                    <div class="cu-offices">
                        @foreach ($offices as $office)
                            <article class="cu-office">
                                <h2>{{ $office['name'] }}</h2>
                                <div class="cu-office__address">
                                    <img
                                        src="{{ $office['flag'] }}"
                                        alt="{{ $office['flag_alt'] }}"
                                        width="40"
                                        height="40"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                    @if ($office['maps'])
                                        <a href="{{ $office['maps'] }}" target="_blank" rel="noopener noreferrer">
                                            {{ $office['address'] }}
                                        </a>
                                    @else
                                        <p>{{ $office['address'] }}</p>
                                    @endif
                                </div>
                                @foreach ($office['phones'] as $phone)
                                    <div class="cu-office__line">
                                        @if (!empty($phone['label']))
                                            <strong>{{ $phone['label'] }}</strong>
                                        @endif
                                        <a href="{{ $phone['href'] }}">
                                            <i class="fa-solid fa-phone" aria-hidden="true"></i>
                                            {{ $phone['number'] }}
                                        </a>
                                    </div>
                                @endforeach
                            </article>
                        @endforeach

                        <a class="cu-email" href="mailto:sales@ibntech.com">
                            <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                            sales@ibntech.com
                        </a>
                    </div>

                    <aside class="cu-form" id="contact-us" aria-label="Contact form">
                        <livewire:forms.contact-form
                            form-name="contact-us"
                            id-prefix="contact-us"
                            :show-company="false"
                            :show-service="false"
                            submit-label="Submit"
                        />
                    </aside>
                </div>
            </div>
        </section>

        <x-home.testimonials
            title="Client Testimonial"
            subtitle="We redefine possibilities, helping you gain fresh perspectives, uncover new opportunities, and achieve remarkable results that transform aspirations into reality."
        />
    </div>
@endsection
