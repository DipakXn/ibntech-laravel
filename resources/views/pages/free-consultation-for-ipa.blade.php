@php
    $gains = [
        'Reduce AP & AR processing time by up to 80%',
        'Reduce order processing speed by a 50%',
        'Three-way matching (Invoice, PO, and Goods Receipt) for 100% accuracy',
        'Cut Processing Time by Half a Second',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/pages/home.css',
        'resources/css/pages/free-consultation-lead.css',
    ])
@endpush

@section('content')
    <div class="fclead-page">
        <section class="fclead-hero" aria-labelledby="fcipa-hero-title">
            <div class="site-shell fclead-hero__inner">
                <div class="fclead-hero__copy">
                    <h1 id="fcipa-hero-title">Experience the Future of Workflow Automation</h1>
                    <p class="fclead-hero__lede">
                        Take advantage of Robotic Process Automation and automation tools to transform your business processes. Streamline tasks like invoice processing, order management, and financial workflows with our easy-to-use platform.
                    </p>

                    <h2>What You’ll Gain:</h2>
                    <ul class="fclead-hero__list">
                        @foreach ($gains as $item)
                            <li>
                                <span class="fclead-check" aria-hidden="true">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="fclead-hero__form" id="contact-us" aria-labelledby="fcipa-form-title">
                    <h2 id="fcipa-form-title">Automate AP/AR with IPA—Transform Now!</h2>
                    <livewire:forms.contact-form
                        form-name="free-consultation-for-ipa"
                        id-prefix="fcipa"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="How can we best support your AP AR Management needs?"
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
