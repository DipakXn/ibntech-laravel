@php
    $gains = [
        'Improve Cash Flow by 20-30%',
        'Increase On-Time Payments by 25%',
        'Save 15+ Hours Per Week',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/pages/free-consultation-for-ap-ar-management.css',
    ])
@endpush

@section('content')
    <div class="fcapar-page">
        <section class="fcapar-hero" aria-labelledby="fcapar-hero-title">
            <div class="site-shell fcapar-hero__inner">
                <div class="fcapar-hero__copy">
                    <h1 id="fcapar-hero-title">AP AR Management</h1>
                    <p class="fcapar-hero__lede">
                        Take control of your cash flow with expert management of payables and receivables. We ensure timely payments, smooth collections, and accurate financial tracking — so you can focus on growing your business.
                    </p>

                    <h2>What You’ll Gain with Our Services:</h2>
                    <ul class="fcapar-hero__list">
                        @foreach ($gains as $item)
                            <li>
                                <span class="fcapar-check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="fcapar-hero__form" id="contact-us" aria-labelledby="fcapar-form-title">
                    <h2 id="fcapar-form-title">Boost Cash Flow with Expert AP/AR—Act Today!</h2>
                    <livewire:forms.contact-form
                        form-name="free-consultation-for-ap-ar-management"
                        id-prefix="fcapar"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we best support your AP/AR needs?"
                        submit-label="BOOK A FREE CONSULTATION"
                        :message-rows="3"
                    />
                </aside>
            </div>
        </section>

        <x-home.testimonials
            title="Client Testimonial"
            subtitle="We redefine possibilities, helping you gain fresh perspectives, uncover new opportunities, and achieve remarkable results that transform aspirations into reality."
        />
    </div>
@endsection
