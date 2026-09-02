@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thank-you-download.css'])
@endpush

@section('content')
    <div class="tydl-page">
        <section class="tydl-hero" aria-labelledby="tydl-title">
            <div class="site-shell">
                <div class="tydl-card">
                    <span class="tydl-icon" aria-hidden="true">
                        <i class="fa-solid fa-file-arrow-down"></i>
                    </span>
                    <h1 id="tydl-title">Thank You !</h1>
                    <p>
                        Your file download link has been sent to your email.Please check your inbox (and spam/junk folder just in case) to access the file.
                    </p>
                    <p>If you have any questions or face issues, feel free to reach out to us.</p>
                    <p class="tydl-closing">Enjoy exploring our content!</p>
                </div>
            </div>
        </section>
    </div>
@endsection
