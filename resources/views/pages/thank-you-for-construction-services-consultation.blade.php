@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thank-you-for-construction-services-consultation.css'])
@endpush

@section('content')
    <div class="tycons-page">
        <section class="tycons-hero" aria-labelledby="tycons-title">
            <div class="site-shell">
                <div class="tycons-card">
                    <span class="tycons-icon" aria-hidden="true">
                        <i class="fa-solid fa-helmet-safety"></i>
                    </span>
                    <h1 id="tycons-title">Thank You for Choosing IBN Technologies!</h1>
                    <p>
                        We appreciate your interest in our Outsourced Civil Engineering Services. we are committed to empowering your projects with precision, efficiency, and expert insight.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
