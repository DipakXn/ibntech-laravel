@php
    $img = fn (string $file): string => asset('images/human-resources-management-hrm/'.$file);
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/human-resources-management-hrm.css'])
@endpush

@section('content')
    <div class="hrm-page">
        <section class="hrm-hero" aria-labelledby="hrm-hero-title">
            <img
                class="hrm-hero__bg"
                src="{{ $img('hrm-banner.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell hrm-hero__inner">
                <div class="hrm-hero__copy">
                    <h1 id="hrm-hero-title">Human Resources Management (HRM)</h1>
                    <div class="hrm-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="hrm-btn hrm-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="hrm-section" aria-labelledby="hrm-content-title">
            <div class="site-shell hrm-content">
                <h2 id="hrm-content-title">Basic Human Resources</h2>
                <h3>Human Resources Management (HRM) :</h3>
                <p>
                    Human Resources Management (HRM) Efficiently manage your companys human resources. (link Learn more) Basic Human Resources Efficiently manage your company’s human resources. Group and track relevant employee information and organize employee data according to different types of information, such as experience, skills, education, training, and union membership. Store personal information, track job openings in your organization, and extract a list of candidates for these positions. Keep track of benefits and company items such as keys, credit cards, computers, and cars. Easily record all types of absences in units of measure that you define, and attach alternative addresses and relatives’ names to employees.
                </p>
            </div>
        </section>
    </div>
@endsection
