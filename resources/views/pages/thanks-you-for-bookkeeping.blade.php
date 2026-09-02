@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-bookkeeping.css'])
@endpush

@section('content')
    <div class="tybk-page">
        <section class="tybk-hero" aria-labelledby="tybk-title">
            <div class="site-shell">
                <div class="tybk-card">
                    <span class="tybk-icon" aria-hidden="true">
                        <i class="fa-solid fa-calculator"></i>
                    </span>
                    <h1 id="tybk-title">Thank You for Choosing IBN Technologies!</h1>
                    <p>
                        Your journey to streamlined bookkeeping starts now—our experts will ensure accuracy and Saving up to 70% Operational Cost. We’ll be in touch soon!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
