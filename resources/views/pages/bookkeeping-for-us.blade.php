@php
    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-for-us.css'])
@endpush

@section('content')
    <div class="bkus-page">
        <section class="bkus-hero" aria-labelledby="bkus-hero-title">
            <div class="site-shell bkus-hero__inner">
                <div class="bkus-hero__copy">
                    <h1 id="bkus-hero-title">
                        Bookkeeping<br>
                        For US
                    </h1>
                </div>

                <aside class="bkus-hero__form" id="contact-us" aria-label="Contact form">
                    <livewire:forms.contact-form
                        form-name="bookkeeping-for-us"
                        id-prefix="bkus"
                        :show-company="false"
                        :show-service="true"
                        :service-options="$formServiceOptions"
                        service-placeholder="Please Select Services"
                        message-placeholder="What kind of accounting solution are you looking for?"
                        submit-label="Submit"
                        layout="home"
                        thank-you-url="/thanks-you-for-bookkeeping/"
                    />
                </aside>
            </div>
        </section>
    </div>
@endsection
