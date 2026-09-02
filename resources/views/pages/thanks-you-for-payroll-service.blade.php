@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/thanks-you-for-payroll-service.css'])
@endpush

@section('content')
    <div class="typay-page">
        <section class="typay-hero" aria-labelledby="typay-title">
            <div class="site-shell">
                <div class="typay-card">
                    <span class="typay-icon" aria-hidden="true">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <h1 id="typay-title">Thank You for Choosing IBN Technologies!</h1>
                    <p>
                        Your payroll processing is in expert hands—our team ensures compliance and efficiency, saving you time and costs. We’ll contact you soon!
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
