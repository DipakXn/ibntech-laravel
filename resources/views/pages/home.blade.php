@extends('layouts.app')

@push('preload')
    <link
        rel="preload"
        as="image"
        href="{{ asset('images/cyber-security-hero-banner.webp') }}"
        imagesrcset="{{ asset('images/cyber-security-hero-banner-800.webp') }} 800w, {{ asset('images/cyber-security-hero-banner.webp') }} 1400w"
        imagesizes="100vw"
        fetchpriority="high"
    >
@endpush

@push('styles')
    @vite(['resources/css/pages/home.css'])
@endpush

@section('content')
    <div class="home-page">
        <x-home.hero-slider />
        <x-home.core-strengths />
        <x-home.leadership />
        <x-home.client-logos />
        <x-home.impact-metrics />
        <x-home.testimonials />
        <x-home.partners />
        <x-home.certifications />
        <x-home.accreditations />
        <x-home.cybersecurity />
        <x-home.cloud-services />
        <x-home.finance-accounting />
        <x-home.ai-automation />
        <x-home.bpo-services />
        <x-home.knowledge-hub />
        <x-home.contact-cta />
    </div>
@endsection
