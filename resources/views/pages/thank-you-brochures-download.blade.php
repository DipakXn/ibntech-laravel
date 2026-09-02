@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thank-you-brochures-download.css'])
@endpush

@section('content')
    <div class="tybd-page">
        <section class="tybd-hero" aria-labelledby="tybd-title">
            <div class="site-shell">
                <div class="tybd-card">
                    <span class="tybd-icon" aria-hidden="true">
                        <i class="fa-solid fa-book-open"></i>
                    </span>
                    <h1 id="tybd-title">Thank You.</h1>
                    <p>
                        Thank you for choosing to download our brochures. Please check your email for the brochure you requested. If you don’t see it in your inbox, please ensure to check your spam or junk folder. If you need any further assistance or have any questions, please don’t hesitate to reach out to our team @
                        <a href="mailto:sales@ibntech.com">sales@ibntech.com</a>.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
