@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-tax-preparation.css'])
@endpush

@section('content')
    <div class="tytax-page">
        <section class="tytax-hero" aria-labelledby="tytax-title">
            <div class="site-shell">
                <div class="tytax-card">
                    <span class="tytax-icon" aria-hidden="true">
                        <i class="fa-solid fa-file-invoice"></i>
                    </span>
                    <h1 id="tytax-title">Thank You for Choosing IBN Technologies!</h1>
                    <p>
                        Simplify tax season with our expert tax return preparation—ensuring compliance and maximizing deductions. We’ll be in touch soon!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
