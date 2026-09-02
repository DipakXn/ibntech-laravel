@php
    $services = [
        [
            'icon' => 'fa-solid fa-bug',
            'title' => 'VAPT Testing',
            'text' => 'Expose and fix hidden risks',
            'slug' => 'vapt-services',
        ],
        [
            'icon' => 'fa-solid fa-eye',
            'title' => 'Managed SIEM & SOC',
            'text' => '24/7 monitoring with real-time response',
            'slug' => 'managed-siem-soc-services',
        ],
        [
            'icon' => 'fa-solid fa-user-tie',
            'title' => 'vCISO Services',
            'text' => 'Expert leadership for your security strategy',
            'slug' => 'vciso-services',
        ],
        [
            'icon' => 'fa-solid fa-bolt',
            'title' => 'Managed Detection & Response',
            'text' => 'Detect & remediate faster',
            'slug' => 'managed-detection-response-services',
        ],
        [
            'icon' => 'fa-brands fa-microsoft',
            'title' => 'Microsoft Security',
            'text' => 'Secure every layer with Microsoft',
            'slug' => 'microsoft-security-services',
        ],
        [
            'icon' => 'fa-solid fa-clipboard-check',
            'title' => 'Compliance Audits',
            'text' => 'Meet regulatory standards with confidence',
            'slug' => 'cybersecurity-audit-compliance-services',
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-solid fa-bullseye',
            'title' => '26+ Years of IT & Security Expertise',
        ],
        [
            'icon' => 'fa-solid fa-globe',
            'title' => 'Global Services across USA, UK & Global Markets',
        ],
        [
            'icon' => 'fa-solid fa-shield-halved',
            'title' => 'ISO-Certified with 24×7 Security Operations',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/free-consultation-for-cybersecurity.css'])
@endpush

@section('content')
    <div class="fccyber-page">
        <section class="fccyber-hero" aria-labelledby="fccyber-hero-title">
            <div class="site-shell fccyber-hero__inner">
                <div class="fccyber-hero__copy">
                    <h1 id="fccyber-hero-title">Secure Your Business with IBN Tech Cybersecurity Services</h1>
                    <p class="fccyber-hero__tagline">Cyber threats are evolving — is your business prepared?</p>
                    <p class="fccyber-hero__highlight">
                        IBNTech delivers enterprise-grade cybersecurity solutions designed to protect your systems, data, and reputation. From proactive threat detection to compliance management, we ensure your organization stays resilient against every attack.
                    </p>

                    <h2>Our Core Services:</h2>
                    <div class="fccyber-services">
                        @foreach ($services as $item)
                            <article>
                                <a href="{{ route('page.show', ['slug' => $item['slug']]) }}">
                                    <span class="fccyber-services__icon" aria-hidden="true">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </span>
                                    <div>
                                        <h3>{{ $item['title'] }}</h3>
                                        <p>{{ $item['text'] }}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>

                <aside class="fccyber-hero__form" id="contact-us" aria-labelledby="fccyber-form-title">
                    <h2 id="fccyber-form-title">Get Your Free Security Assessment</h2>
                    <p>Discover your security gaps and get expert recommendations</p>
                    <livewire:forms.contact-form
                        form-name="free-consultation-for-cybersecurity"
                        id-prefix="fccyber"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Cybersecurity experts are ready - tell us what you need!"
                        submit-label="Get Free Assessment"
                        :message-rows="3"
                    />
                </aside>
            </div>
        </section>

        <section class="fccyber-why" aria-labelledby="fccyber-why-title">
            <div class="site-shell">
                <h2 id="fccyber-why-title">Why Choose IBN Tech?</h2>
                <div class="fccyber-why__grid">
                    @foreach ($whyChoose as $item)
                        <article>
                            <span class="fccyber-why__icon" aria-hidden="true">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
