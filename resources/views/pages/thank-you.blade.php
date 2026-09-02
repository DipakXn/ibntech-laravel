@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thank-you.css'])
@endpush

@section('content')
    <div class="ty-page">
        <section class="ty-hero" aria-labelledby="ty-title">
            <div class="site-shell">
                <div class="ty-card">
                    <span class="ty-icon" aria-hidden="true">
                        <i class="fa-solid fa-calendar-check"></i>
                    </span>
                    <h1 id="ty-title">Thank You!</h1>
                    <p class="ty-lead">Last Step! There’s one Last Thing You Need to Do Right Now!!</p>
                    <p>
                        Click the button below &amp; Schedule your Call with IBN’s expert team now for personalized Bookkeeping and tax Support. Secure your slot today for a stress-free tax experience!
                    </p>
                    <a
                        class="ty-cta"
                        href="https://outlook.office365.com/book/IBNBookkeepingServices@cloudibn.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                    >Schedule your Call</a>
                </div>
            </div>
        </section>
    </div>
@endsection
