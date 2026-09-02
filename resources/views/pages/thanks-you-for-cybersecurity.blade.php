@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-cybersecurity.css'])
@endpush

@section('content')
    <div class="tycyber-page">
        <section class="tycyber-hero" aria-labelledby="tycyber-title">
            <div class="site-shell">
                <div class="tycyber-card">
                    <span class="tycyber-icon" aria-hidden="true">
                        <i class="fa-solid fa-shield-halved"></i>
                    </span>
                    <h1 id="tycyber-title">Thank You for Trusting IBN Technologies with Your Cybersecurity Needs!</h1>
                    <p>
                        Secure your business with trusted cybersecurity solutions for resilience and peace of mind. We’ll connect shortly!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
