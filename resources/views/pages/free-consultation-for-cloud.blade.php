@php
    $expertise = [
        [
            'icon' => 'fa-solid fa-cloud',
            'title' => 'Managed Cloud & Security',
            'text' => '24/7 cloud monitoring, threat detection, and performance optimization.',
            'slug' => 'cloud-managed-services',
        ],
        [
            'icon' => 'fa-solid fa-server',
            'title' => 'Business Continuity & DR',
            'text' => 'Robust strategies to protect data and ensure uptime.',
            'slug' => 'business-continuity-disaster-recovery-services',
        ],
        [
            'icon' => 'fa-solid fa-code-branch',
            'title' => 'DevSecOps',
            'text' => 'Secure your CI/CD pipeline with integrated security and faster delivery.',
            'slug' => 'devsecops-services',
        ],
        [
            'icon' => 'fa-brands fa-microsoft',
            'title' => 'Microsoft 365 | Office 365 Migration & Support',
            'text' => 'Hassle-free migration and expert support for productivity.',
            'slug' => 'microsoft-office-365-migration-support-services',
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'fa-solid fa-award',
            'title' => 'Proven Experience',
            'text' => 'Decades of cloud transformation success across industries',
        ],
        [
            'icon' => 'fa-solid fa-certificate',
            'title' => 'Certified Experts',
            'text' => 'AWS, Azure, GCP, Microsoft 365 specialists',
        ],
        [
            'icon' => 'fa-solid fa-shield-halved',
            'title' => 'Security-First Approach',
            'text' => 'Built-in compliance and threat mitigation',
        ],
        [
            'icon' => 'fa-solid fa-book',
            'title' => 'Authoritative Frameworks',
            'text' => 'Industry-aligned methodologies and best practices',
        ],
        [
            'icon' => 'fa-solid fa-headset',
            'title' => 'Transparent Support',
            'text' => '24/7 monitoring, reporting, and SLA-backed services',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/free-consultation-for-cloud.css'])
@endpush

@section('content')
    <div class="fccloud-page">
        <section class="fccloud-hero" aria-labelledby="fccloud-hero-title">
            <div class="site-shell fccloud-hero__inner">
                <div class="fccloud-hero__copy">
                    <h1 id="fccloud-hero-title">
                        <span class="fccloud-hero__icon" aria-hidden="true">
                            <i class="fa-solid fa-cloud"></i>
                        </span>
                        Accelerate Your Cloud Transformation with IBN Technologies
                    </h1>
                    <p class="fccloud-hero__tagline">Transform Faster. Operate Smarter. Stay Secure.</p>
                    <p class="fccloud-hero__highlight">
                        Unlock agility, security, and resilience with IBN Technologies expert-led cloud services. From migration to disaster recovery, we help you build a future-ready cloud strategy fast, secure, and scalable.
                    </p>

                    <h2>Our Cloud Expertise Covers Every Layer</h2>
                    <div class="fccloud-expertise">
                        @foreach ($expertise as $item)
                            <article>
                                <a href="{{ route('page.show', ['slug' => $item['slug']]) }}">
                                    <span class="fccloud-expertise__icon" aria-hidden="true">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </span>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['text'] }}</p>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>

                <aside class="fccloud-hero__form" id="contact-us" aria-labelledby="fccloud-form-title">
                    <h2 id="fccloud-form-title">Start Your Cloud Transformation Today</h2>
                    <p>Connect with specialists who understand your cloud challenges and goals.</p>
                    <livewire:forms.contact-form
                        form-name="free-consultation-for-cloud"
                        id-prefix="fccloud"
                        :show-company="false"
                        :show-service="false"
                        message-placeholder="Where can we help in your cloud journey?"
                        submit-label="Get Free Assessment"
                        :message-rows="3"
                    />
                </aside>
            </div>
        </section>

        <section class="fccloud-why" aria-labelledby="fccloud-why-title">
            <div class="site-shell">
                <h2 id="fccloud-why-title">Why Choose IBN Tech?</h2>
                <div class="fccloud-why__grid">
                    @foreach ($whyChoose as $item)
                        <article>
                            <span class="fccloud-why__icon" aria-hidden="true">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
