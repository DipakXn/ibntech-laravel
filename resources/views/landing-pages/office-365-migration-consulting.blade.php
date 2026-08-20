@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);

    $services = [
        ['icon' => 'office-365.png', 'title' => 'Office 365 Implementation'],
        ['icon' => 'dedicated-skype-rooms.png', 'title' => 'Hybrid Exchange Migration'],
        ['icon' => 'dedicated-team.png', 'title' => 'ADFS for Office 365'],
        ['icon' => 'emergency-chat-support.png', 'title' => 'Remote Training Handholding'],
        ['icon' => 'data-migration.png', 'title' => 'Office 365 Migration'],
        ['icon' => 'white-label.png', 'title' => 'Office 365 Licensing'],
    ];

    $competenciesLeft = [
        'Email, File Storage, SharePoint Online, Skype.',
        'Migration to Office 365.',
        'Identity Management .',
        'Active Directory Integration.',
        'Third-party product/app integration.',
    ];

    $competenciesRight = [
        'Web /Intranet Portals.',
        'Single Sign-on Implementation.',
        'Assessment to implementation, Migration & Support for Cloud .',
        'Power BI.',
        'Cost effective & Comprehensive remote monitoring, maintenance.',
    ];

    $migrationPaths = [
        'Migration from other legacy platforms to Office 365',
        'Microsoft Exchange to Office 365',
        'Lotus Notes to Office 365',
        'IMAP/Google/Exchange Online /Office365',
        'Gmail, G-Drive, File Share to OneDrive for business',
        'Tenant to Tenant',
    ];
@endphp

@section('content')
<div class="lomc-page">
    <section class="lomc-callbar" aria-label="Call now">
        <div class="lomc-shell lomc-callbar__inner">
            <p>Your Needs. Our Expertise. Call Now to Connect.</p>
            <a href="tel:020-711-79587">
                <span class="lomc-callbar__icon" aria-hidden="true">
                    <i class="fa-solid fa-phone"></i>
                </span>
                020 – 711 – 79587
            </a>
        </div>
    </section>

    <section class="lomc-hero" aria-labelledby="lomc-hero-title">
        <video
            class="lomc-hero__bg"
            autoplay
            muted
            loop
            playsinline
            preload="auto"
            aria-hidden="true"
        >
            <source src="{{ $lpImg('Office-365-Video-Banner-2.mp4') }}" type="video/mp4">
        </video>
        <div class="lomc-shell lomc-hero__inner">
            <div class="lomc-hero__copy">
                <h1 id="lomc-hero-title">Office 365<br>Migration Consulting</h1>
                <p>
                    Transform your business with leading<br>
                    Office 365 migration consultants. Move to the<br>
                    cloud seamlessly with no data loss during the migration.
                </p>
            </div>

            <div class="lomc-hero__form" id="contact-sec">
                <h2>Schedule A Consultation!</h2>
                <livewire:forms.landing-inquiry-form
                    :landing-page-slug="$landingPage->slug"
                    :landing-page-title="$landingPage->title"
                    id-prefix="lp-office-365-migration-consulting-hero"
                    phone-country="in"
                    wire:key="landing-inquiry-office-365-migration-consulting-hero"
                />
            </div>
        </div>
    </section>

    <section class="lomc-services" aria-labelledby="lomc-services-title">
        <div class="lomc-shell">
            <h2 id="lomc-services-title">IBN Tech Office 365 Services</h2>
            <div class="lomc-services__grid">
                @foreach ($services as $service)
                    <article>
                        <span class="lomc-services__icon">
                            <img
                                src="{{ $lpImg($service['icon']) }}"
                                alt=""
                                width="70"
                                height="70"
                                loading="lazy"
                                decoding="async"
                            >
                        </span>
                        <h3>{{ $service['title'] }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lomc-competencies" aria-labelledby="lomc-competencies-title">
        <div class="lomc-shell">
            <h3 id="lomc-competencies-title">IBN Tech Office 365 Competencies</h3>
            <div class="lomc-competencies__lists">
                <ul>
                    @foreach ($competenciesLeft as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
                <ul>
                    @foreach ($competenciesRight as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="lomc-consulting" aria-labelledby="lomc-consulting-title">
        <div class="lomc-shell">
            <h2 id="lomc-consulting-title">
                Office 365 Migration
                <span>Consulting Services</span>
            </h2>
            <p>
                IBN Tech is right partner to deliver Office 365 services with its core proficiency in working on several Office 365 implementations and providing support services. IBN Tech provides comprehensive range of services if you are considering migrating to Office 365 from a traditional in-house collaborative platform or move away or upgrade from SharePoint or in would like of a right partner for Office 365. Every customer's business is different and throughout the time we tend to in business, we have evolved to satisfy our customer's dynamic and challenging requirements.
            </p>
            <p>
                IBN Tech provides complete range of customer-centric Office 365 consulting services focused on their exceptional business essentials. Our proficient Office 365 consultants work for you to leverage the wide-ranging potential of Office 365 on various engagement models.
            </p>
            <p>
                If you are planning to evaluate whether Office 365 is right asset for your organization or even if you have Office 365 in place as an enterprise collaboration platform, IBN Tech can assist you with complete assessment &amp; analysis of your business needs and develop strategy and an action plan to meet your requirements and enrich user experience.
            </p>
            <p>
                Our Office 365 assessment and planning services include evaluating the existing content, collaboration &amp; document management system, collecting and verifying requirements, building references and providing an optimal strategy for implementing Office 365.
            </p>
            <ul class="lomc-consulting__list">
                @foreach ($migrationPaths as $path)
                    <li>{{ $path }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="lomc-cta" aria-labelledby="lomc-cta-title">
        <div class="lomc-shell lomc-cta__inner">
            <h2 id="lomc-cta-title">To get your Office 365 Migration Consulting today..</h2>
            <a href="#contact-sec">Let's Talk</a>
        </div>
    </section>

    <section class="lomc-office" aria-labelledby="lomc-office-title">
        <div class="lomc-shell">
            <h2 id="lomc-office-title">INDIA - GLOBAL DELIVERY CENTER</h2>
            <p class="lomc-office__name">IBN TECHNOLOGIES LIMITED,</p>
            <p>
                Kohinoor House,691/A/1B, Plot no. 7, Bibwewadi Road,<br>
                Near TATA Motors showroom, IDBI Bank, Pune-4110037,Maharashtra, India.
            </p>
            <p class="lomc-office__copy">Copyright @ 2023 IBN TECHNOLOGIES LTD. All Rights Reserved.</p>
        </div>
    </section>
</div>
@endsection
