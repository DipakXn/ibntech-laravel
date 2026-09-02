@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thank-you-free-trial.css'])
@endpush

@section('content')
    <div class="tyft-page">
        <section class="tyft-hero" aria-labelledby="tyft-title">
            <div class="site-shell">
                <div class="tyft-card">
                    <span class="tyft-icon" aria-hidden="true">
                        <i class="fa-solid fa-hourglass-start"></i>
                    </span>
                    <h1 id="tyft-title">Thank You!</h1>
                    <p>
                        Thank you for signing up! Enjoy the free trial of our outsourcing service. One of our team members will get in touch with you soon, to guide you through the next steps. If you have any questions in the meantime, please don’t hesitate to reach out to us at @
                        <a href="mailto:sales@ibntech.com">sales@ibntech.com</a>.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
