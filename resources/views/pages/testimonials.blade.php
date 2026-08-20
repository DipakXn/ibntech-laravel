@php
    $img = fn (string $file): string => asset('images/testimonials/'.$file);
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/testimonials.css'])
@endpush

@section('content')
    <div class="tm-page">
        <section class="tm-hero" aria-labelledby="tm-hero-title">
            <div class="tm-hero__media" aria-hidden="true">
                <img
                    src="{{ $img('banner-3.webp') }}"
                    alt=""
                    width="1400"
                    height="700"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
            <div class="site-shell tm-hero__inner">
                <h1 id="tm-hero-title">Testimonials</h1>
                <p class="tm-hero__lede">Leave your wishes, comments and thoughts on this page!</p>
                <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="tm-hero__cta">
                    Get a Free Consultation Today
                </a>
            </div>
        </section>

        <x-home.testimonials />
    </div>
@endsection
