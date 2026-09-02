@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-free-trail.css'])
@endpush

@section('content')
    <div class="tytrail-page">
        <section class="tytrail-hero" aria-labelledby="tytrail-title">
            <div class="site-shell">
                <div class="tytrail-card">
                    <span class="tytrail-icon" aria-hidden="true">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </span>
                    <h1 id="tytrail-title">Thank You for Joining Us!</h1>
                    <ul class="tytrail-list">
                        <li>
                            <span class="tytrail-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                            <span>Our expert will contact you shortly to streamline your books with accuracy</span>
                        </li>
                        <li>
                            <span class="tytrail-check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                            <span>Get a custom plan built for your financial goals and growth</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection
