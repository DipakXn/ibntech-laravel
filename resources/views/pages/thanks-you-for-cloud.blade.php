@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-cloud.css'])
@endpush

@section('content')
    <div class="tycloud-page">
        <section class="tycloud-hero" aria-labelledby="tycloud-title">
            <div class="site-shell">
                <div class="tycloud-card">
                    <span class="tycloud-icon" aria-hidden="true">
                        <i class="fa-solid fa-cloud"></i>
                    </span>
                    <h1 id="tycloud-title">Thank You for Choosing IBN Technologies for Your Cloud Transformation!</h1>
                    <p>
                        Empower your business with flexible, cost-effective cloud solutions for seamless growth. We’ll connect shortly!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
