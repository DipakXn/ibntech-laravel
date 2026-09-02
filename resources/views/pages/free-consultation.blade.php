@php
    $formServiceOptions = [
        'Bookkeeping',
        'Payroll Services',
        'Tax Support',
        'Accounts Receivable & Payable',
        'Strategic Financial Management',
        'AP/AR Automation',
    ];

    $whatYouGet = [
        'Personalized process analysis',
        'Actionable cost-saving strategies',
        'Expert insights from finance professionals',
    ];

    $whyChoose = [
        '26+ Years Experience',
        'ISO Certified Excellence',
        'Global Reach with Local Support',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/pages/free-consultation.css',
    ])
@endpush

@section('content')
    <div class="fcons-page">
        <section class="fcons-hero" aria-labelledby="fcons-hero-title">
            <div class="site-shell fcons-hero__inner">
                <div class="fcons-hero__copy">
                    <h1 id="fcons-hero-title">Streamline Your Business. Save Time and Money.</h1>
                    <p class="fcons-hero__lede">
                        Let IBN Technologies help you cut operational costs and improve efficiency through expert outsourcing solutions tailored to your needs.
                    </p>

                    <div class="fcons-hero__lists">
                        <div>
                            <h2>What You Get</h2>
                            <ul>
                                @foreach ($whatYouGet as $item)
                                    <li>
                                        <span class="fcons-check" aria-hidden="true">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h2>Why Choose IBN Technologies?</h2>
                            <ul>
                                @foreach ($whyChoose as $item)
                                    <li>
                                        <span class="fcons-check" aria-hidden="true">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <aside class="fcons-hero__form" id="contact-us" aria-labelledby="fcons-form-title">
                    <h2 id="fcons-form-title">Book a Free Consultation – Unlock Up to 70% Cost Savings</h2>
                    <livewire:forms.contact-form
                        form-name="free-consultation"
                        id-prefix="fcons"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit and Book Now"
                        :message-rows="3"
                    />
                </aside>
            </div>
        </section>

        <x-home.testimonials />
    </div>
@endsection
