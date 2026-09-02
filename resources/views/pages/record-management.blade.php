@php
    $img = fn (string $file): string => asset('images/record-management/'.$file);
    $pageUrl = fn (string $slug): string => route('page.show', ['slug' => $slug]);

    $checkSvg = '<svg class="rm-check" aria-hidden="true" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="currentColor"/><path d="M7.2 12.35 10.35 15.5 16.8 8.7" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

    $services = [
        [
            'file' => 'data-backup.webp',
            'alt' => 'data backup',
            'title' => 'Data Backup',
            'text' => 'Back up the data regularly in case of a system crash or other data loss event. Store the backup in a secure & centralized location.',
        ],
        [
            'file' => 'document-imaging.webp',
            'alt' => 'document imaging and digitization',
            'title' => 'Process for Document Imaging and Digitization',
            'text' => 'Convert physical records into digital format through scanning and imaging. This reduces storage space, enhances accessibility, and improves document security.',
        ],
        [
            'file' => 'document-management.webp',
            'alt' => 'document management',
            'title' => 'Document Management',
            'text' => 'Efficiently organize, store, and maintain documents in a digital format, following a systematic approach. This ensures streamlined document management, facilitating easy retrieval and enhancing data integrity.',
        ],
    ];

    $helpItems = [
        'Consistent format for all records',
        'Document indexing and labelling',
        'Storing records in a centralized location',
        'Regular cleaning of old records',
    ];

    $industries = [
        ['label' => 'E-Commerce', 'slug' => 'ecommerce-bookkeeping-services'],
        ['label' => 'Insurance', 'slug' => null],
        ['label' => 'Logistics & Transportation', 'slug' => 'transport-and-logistics'],
        ['label' => 'Recruitment & Staffing', 'slug' => 'recruitment-firms'],
        ['label' => 'Travel', 'slug' => 'travel-bookkeeping-service'],
        ['label' => 'Finance & Banking', 'slug' => 'finance-and-accounting-services'],
        ['label' => 'Healthcare', 'slug' => 'healthcare-bookkeeping-services'],
        ['label' => 'Hospitality', 'slug' => 'hospitality'],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/record-management.css'])
@endpush

@section('content')
    <div class="rm-page">
        {{-- Hero --}}
        <section class="rm-hero" aria-labelledby="rm-hero-title">
            <div class="site-shell rm-hero__inner">
                <div class="rm-hero__copy">
                    <p class="rm-kicker">Stop Collecting Data Manually!</p>
                    <h1 id="rm-hero-title">Work With IBN’s Data Entry Experts</h1>
                    <p class="rm-hero__lede">
                        Unlock the Power of Efficiency and Accuracy in Data / Document Record Management
                    </p>
                    <div class="rm-hero__actions">
                        <a href="{{ $pageUrl('contact-us') }}" class="rm-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="rm-hero__media">
                    <img
                        src="{{ $img('record-management.webp') }}"
                        alt="record management"
                        width="780"
                        height="778"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Intro --}}
        <section class="rm-intro" aria-label="Record management overview">
            <div class="site-shell">
                <p>
                    Are you struggling to manage and store your data entry records and documents? IBN's record management experts are here to take control of your information and supercharge your productivity. We understand efficient back-office record management is the backbone of any business. It encompasses the essential tasks of collecting, organizing, and verifying data from diverse sources. While data entry demands accuracy, consistency, and security, managing this data and records can pose challenges. Trust IBN to handle your data entry challenges and ensure your valuable records' efficiency, accuracy, and safety.
                </p>
            </div>
        </section>

        {{-- Data Entry Record Management --}}
        <section class="rm-manage" aria-labelledby="rm-manage-title">
            <div class="site-shell rm-manage__inner">
                <div class="rm-manage__copy">
                    <h2 id="rm-manage-title">Data Entry Record Management</h2>
                    <p>Record management in data entry refers to the systematic process of organizing, storing, and maintaining records in a digital format. It ensures accurate data capture, secure storage, and easy retrieval. Data integrity, compliance with regulations, and efficient decision-making are improved with effective record management.</p>
                    <p>Is your business able to manage and store data entry records and documents effectively? Let us take care of your information and increase your productivity.</p>
                </div>
                <div class="rm-manage__media">
                    <img
                        src="{{ $img('record-management-1.webp') }}"
                        alt="record management"
                        width="778"
                        height="618"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Services --}}
        <section class="rm-services" aria-labelledby="rm-services-title">
            <div class="site-shell">
                <h2 id="rm-services-title" class="rm-section-title">Services we provide for record management</h2>
                <div class="rm-services__grid" role="list">
                    @foreach ($services as $service)
                        <article class="rm-service" role="listitem">
                            <div class="rm-service__icon">
                                <img
                                    src="{{ $img($service['file']) }}"
                                    alt="{{ $service['alt'] }}"
                                    width="65"
                                    height="65"
                                    decoding="async"
                                >
                            </div>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Help + Industries --}}
        <section class="rm-split" aria-label="Capabilities and industries">
            <div class="rm-split__help">
                <div class="rm-split__inner">
                    <div class="rm-split__heading">
                        <img
                            src="{{ $img('back-office-icon.webp') }}"
                            alt=""
                            width="90"
                            height="90"
                            decoding="async"
                        >
                        <h2>We also help with:</h2>
                    </div>
                    <ul class="rm-list">
                        @foreach ($helpItems as $item)
                            <li>
                                {!! $checkSvg !!}
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="rm-split__industries">
                <div class="rm-split__inner">
                    <div class="rm-split__heading">
                        <img
                            src="{{ $img('industries-icon.webp') }}"
                            alt=""
                            width="47"
                            height="47"
                            decoding="async"
                        >
                        <h2>Industries We Serve With Our Record Management Services</h2>
                    </div>
                    <ul class="rm-list rm-list--columns">
                        @foreach ($industries as $industry)
                            <li>
                                @if ($industry['slug'])
                                    <a href="{{ $pageUrl($industry['slug']) }}">
                                        {!! $checkSvg !!}
                                        <span>{{ $industry['label'] }}</span>
                                    </a>
                                @else
                                    {!! $checkSvg !!}
                                    <span>{{ $industry['label'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Community CTA --}}
        <section class="rm-cta" aria-labelledby="rm-cta-title">
            <div class="site-shell rm-cta__inner">
                <div class="rm-cta__media">
                    <img
                        src="{{ $img('join-the-growing.webp') }}"
                        alt="join the growing"
                        width="263"
                        height="393"
                        decoding="async"
                    >
                </div>
                <div class="rm-cta__copy">
                    <h2 id="rm-cta-title">
                        Join the growing community of satisfied customers who have already experienced the benefits of IBN's outsourcing solutions. Don't wait!
                    </h2>
                    <p class="rm-cta__accent">Transform Your Record Management Today!</p>
                    <h3>Experience the Power of Document Imaging and Digitization with IBN</h3>
                    <p>Contact us to learn more about IBN's data entry and record management services today!</p>
                </div>
            </div>
        </section>
    </div>
@endsection
