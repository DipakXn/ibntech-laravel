@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-ap-ar-management.css'])
@endpush

@section('content')
    <div class="tyapar-page">
        <section class="tyapar-hero" aria-labelledby="tyapar-title">
            <div class="site-shell">
                <div class="tyapar-card">
                    <span class="tyapar-icon" aria-hidden="true">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </span>
                    <h1 id="tyapar-title">Thank You for Choosing IBN Technologies!</h1>
                    <p>
                        Optimize your cash flow with our expert AP/AR management—ensuring timely payments and accuracy. We’ll reach out soon!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
