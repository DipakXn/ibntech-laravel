@extends('layouts.app')

@push('preload')
    @php
        $homeHeroSrcset = implode(', ', [
            asset('images/Futuristic-Cybersecurity-Shield-Network-768.webp').' 768w',
            asset('images/Futuristic-Cybersecurity-Shield-Network-1280.webp').' 1280w',
            asset('images/Futuristic-Cybersecurity-Shield-Network-1600.webp').' 1600w',
            asset('images/Futuristic-Cybersecurity-Shield-Network.webp').' 1983w',
        ]);
    @endphp
    <link
        rel="preload"
        as="image"
        href="{{ asset('images/Futuristic-Cybersecurity-Shield-Network-768.webp') }}"
        imagesrcset="{{ $homeHeroSrcset }}"
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
