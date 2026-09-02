@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-ipa.css'])
@endpush

@section('content')
    <div class="tyipa-page">
        <section class="tyipa-hero" aria-labelledby="tyipa-title">
            <div class="site-shell">
                <div class="tyipa-card">
                    <span class="tyipa-icon" aria-hidden="true">
                        <i class="fa-solid fa-gears"></i>
                    </span>
                    <h1 id="tyipa-title">Thank You for Choosing IBN Technologies!</h1>
                    <p>
                        Transform your AP/AR with our IPA-driven automation—streamlining payments and boosting efficiency. We’ll reach out soon!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
