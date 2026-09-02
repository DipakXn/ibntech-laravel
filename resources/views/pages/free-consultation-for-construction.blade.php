@php
    $reasons = [
        [
            'title' => 'Cost Savings',
            'text' => 'Reduce project expenses with efficient remote engineering support.',
        ],
        [
            'title' => 'Clear Reporting',
            'text' => 'Stay informed with accurate, timely progress updates.',
        ],
        [
            'title' => 'Drafting & Drawing',
            'text' => 'Get precise construction drawings that meet project standards.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/pages/free-consultation-for-construction.css',
    ])
@endpush

@section('content')
    <div class="fccons-page">
        <section class="fccons-hero" aria-labelledby="fccons-hero-title">
            <div class="site-shell fccons-hero__inner">
                <div class="fccons-hero__copy">
                    <h1 id="fccons-hero-title">
                        Skilled Full-Time Remote Engineers for <span>Construction Support</span>
                    </h1>
                    <p class="fccons-hero__lede">
                        IBN Technology supplies skilled engineering resources to handle estimation, RFIs, and documentation efficiently.
                    </p>

                    <h2>Reasons Businesses Work With Us</h2>
                    <ul class="fccons-hero__list">
                        @foreach ($reasons as $item)
                            <li>
                                <span class="fccons-check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <div>
                                    <strong>{{ $item['title'] }}</strong>
                                    <span>{{ $item['text'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="fccons-hero__form" id="contact-us" aria-labelledby="fccons-form-title">
                    <h2 id="fccons-form-title">Schedule a Free Consultation</h2>
                    <livewire:forms.construction-consultation-form
                        form-name="free-consultation-for-construction"
                        id-prefix="fccons"
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
