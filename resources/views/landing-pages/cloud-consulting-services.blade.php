@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);

    $heroItems = [
        'Over 26+ years of experience in delivering cloud consulting services, multi-cloud solutions, Azure cloud consulting services, cloud infrastructure management services, and hybrid cloud solutions.',
        'Processes and Safety Certified by ISO 9001:2015, ISO 27001-2013, ISO 20000 & CMMI Level 5.',
        'Trusted Azure managed service provider with a global recognition as a partner of Azure, AWS, Acronis, HPE Greenlake, and Jio Cloud.',
        'Shared and Dedicated Experts | Certified Team',
        'Extensive expertise in Windows, Linux, Azure, AWS, DevOps, Security, and more.',
        'Successfully served over 650+ clients across the USA, APAC, Middle East, Europe, India, and beyond.',
        'Provide flexible pricing options to suit specific needs, whether it\'s shared or dedicated resources and established as a trusted cloud service provider.',
    ];

    $partnerLogos = [
        ['file' => 'awsl.webp', 'alt' => 'Amazon Web Services', 'width' => 220, 'height' => 90],
        ['file' => 'azure-new-logo1.webp', 'alt' => 'Microsoft Azure', 'width' => 300, 'height' => 183],
        ['file' => 'CIO-Cloud-resized.webp', 'alt' => 'CIO Review 10 Most Promising Cloud Consulting Services Companies', 'width' => 150, 'height' => 100],
        ['file' => 'HPE-Green-Lake.webp', 'alt' => 'HPE GreenLake', 'width' => 150, 'height' => 100],
        ['file' => 'jio.webp', 'alt' => 'Jio Cloud', 'width' => 150, 'height' => 100],
        ['file' => 'Modern-new-logo1.webp', 'alt' => 'Microsoft Solutions Partner', 'width' => 300, 'height' => 183],
        ['file' => 'silicon-india-resized.webp', 'alt' => 'SiliconIndia 25 Most Promising Cloud Computing Companies', 'width' => 150, 'height' => 100],
    ];

    $keyServices = [
        'Gain complete control over your cloud expenses and optimize costs with our innovative cloud cost management solutions.',
        'Safeguard your critical data and streamline its management with our robust cloud data management solutions.',
        'Experience reliable and high-performance cloud hosting with our managed Cloud Services Provider in India.',
        'Harness the power of hybrid cloud environments with our comprehensive hybrid cloud management solutions.',
        'Simplify your cloud operations and enhance efficiency with our cloud service management solutions.',
        'Protect your cloud assets from potential threats and vulnerabilities with our reliable cloud security managed services.',
    ];

    $platformCards = [
        [
            'title' => 'Assessment & Adoption Services',
            'items' => [
                'Azure | AWS Well-Architected Framework Review.',
                'Cloud Infrastructure Architecture & Modernization Consulting.',
                'Application and Database Migration to Azure | AWS | Private | Hybrid Cloud.',
            ],
        ],
        [
            'title' => '24/7 Managed Services',
            'items' => [
                'Set up of Cloud – Public | Private | Hybrid.',
                'Infrastructure and PaaS Service Management.',
                'Backups & Disaster Recovery.',
                'Azure DevOps.',
                'Azure Identity Management.',
                'Cost & Performance Optimization.',
                'Dedicated or Shared Support Team.',
            ],
        ],
        [
            'title' => 'Managed Security Services & Compliances',
            'items' => [
                'Firewall and Security Implementation / Management as per compliance and requirements.',
                'Networking Traffic Protection Implementation (Encryption, Identity, Integrity).',
                'Application and Database Migration to Azure | AWS | Private | Hybrid Cloud.',
            ],
        ],
    ];

    $howItWorks = [
        [
            'title' => 'CONSULTING',
            'text' => 'Our Azure cloud managed services help you keep upfront and achieve your business objectives.',
        ],
        [
            'title' => 'SOLUTIONING',
            'text' => 'We assist you in selecting the perfect and optimized cloud solution from public, private, and hybrid solutions, based on your specific needs.',
        ],
        [
            'title' => 'MIGRATION',
            'text' => 'Our expert team performs cloud migration with detailed reviews and close observations of your IT infrastructure, ensuring a seamless transition to the cloud.',
        ],
    ];

    $whyChoose = [
        [
            'icon' => 'local.webp',
            'title' => 'Expertise and Experience',
            'text' => 'Our cloud consulting services ensure you to keep upfront and help you to accomplish your business objectives!',
        ],
        [
            'icon' => 'remote.webp',
            'title' => 'Trusted Partnerships',
            'text' => 'We help you to choose perfect and optimized cloud from Public, Private and Hybrid as per your need.',
        ],
        [
            'icon' => 'online.webp',
            'title' => 'Expertise and Experience',
            'text' => 'Our cloud consulting services ensure you to keep upfront and help you to accomplish your business objectives!',
        ],
        [
            'icon' => 'local.webp',
            'title' => 'Expertise and Experience',
            'text' => 'Our cloud consulting services ensure you to keep upfront and help you to accomplish your business objectives!',
        ],
    ];
@endphp

@section('content')
<div class="lccs-page">
    <section class="lccs-callbar" aria-label="Call now">
        <div class="lccs-shell lccs-callbar__inner">
            <p>Your Needs. Our Expertise. Call Now to Connect.</p>
            <a href="tel:020-711-79584">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                020-711-79584
            </a>
        </div>
    </section>

    <section class="lccs-hero" aria-labelledby="lccs-hero-title">
        <img
            class="lccs-hero__bg"
            src="{{ $lpImg('cloudlp-Website-banner.webp') }}"
            alt=""
            aria-hidden="true"
            width="1920"
            height="900"
            fetchpriority="high"
            decoding="async"
        >
        <div class="lccs-shell lccs-hero__inner">
            <div class="lccs-hero__copy">
                <h1 id="lccs-hero-title">Welcome to IBN Tech!</h1>
                <p>
                    With 26+ years of industry expertise, we excel in delivering comprehensive Cloud Consulting, Multi Cloud solutions, and Private Cloud solutions. Our services encompass Cloud Management Services, Azure Consulting Services, and Azure Expert Managed Services Provider capabilities, making us a trusted partner for Cloud Infrastructure management, Hybrid Cloud Solutions, and top-tier Cloud Security solutions.
                </p>
                <ul class="lccs-hero__items">
                    @foreach ($heroItems as $item)
                        <li>
                            <span class="lccs-hero__check" aria-hidden="true">
                                <i class="fa-solid fa-square-check"></i>
                            </span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lccs-hero__form" id="lccs-consult">
                <h2>Schedule Free Consultation!</h2>
                <livewire:forms.landing-inquiry-form
                    :landing-page-slug="$landingPage->slug"
                    :landing-page-title="$landingPage->title"
                    id-prefix="lp-cloud-consulting-services-hero"
                    phone-country="in"
                    thank-you-url="/lp/cloud-consulting-services-thank-you/"
                    wire:key="landing-inquiry-cloud-consulting-services-hero"
                />
            </div>
        </div>

        <div class="lccs-shell lccs-hero__logos" aria-label="Partners and awards">
            @foreach ($partnerLogos as $logo)
                <figure>
                    <img
                        src="{{ $lpImg($logo['file']) }}"
                        alt="{{ $logo['alt'] }}"
                        width="{{ $logo['width'] }}"
                        height="{{ $logo['height'] }}"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            @endforeach
        </div>
    </section>

    <section class="lccs-keys" aria-labelledby="lccs-keys-title">
        <div class="lccs-shell">
            <h2 id="lccs-keys-title">Our Key Services include</h2>
            <p class="lccs-keys__lead">
                As an authorized partner of Acronis, HPE Greenlake, and Jio Cloud, and a trusted Azure and AWS manage service provider, IBN Tech brings you the best-in-class technologies and managed services you need to succeed.
            </p>
            <div class="lccs-keys__inner">
                <ul class="lccs-keys__list">
                    @foreach ($keyServices as $service)
                        <li>
                            <span class="lccs-keys__icon" aria-hidden="true">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                            <span>{{ $service }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="lccs-keys__media">
                    <img
                        src="{{ $lpImg('consulting-service-img.webp') }}"
                        alt="Cloud consulting and managed IT services"
                        width="480"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="lccs-platforms" aria-labelledby="lccs-platforms-title">
        <div class="lccs-shell">
            <h2 id="lccs-platforms-title">AZURE | AWS | PRIVATE | HYBRID CLOUD SERVICES</h2>
            <div class="lccs-platforms__grid">
                @foreach ($platformCards as $card)
                    <article>
                        <h3>{{ $card['title'] }}</h3>
                        <ul>
                            @foreach ($card['items'] as $item)
                                <li>
                                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lccs-works" aria-labelledby="lccs-works-title">
        <div class="lccs-shell">
            <h2 id="lccs-works-title">HOW IT WORKS?</h2>
            <div class="lccs-works__grid">
                @foreach ($howItWorks as $step)
                    <article>
                        <img
                            src="{{ $lpImg('cloud-lp-page-Website-Image-1.webp') }}"
                            alt=""
                            width="350"
                            height="251"
                            loading="lazy"
                            decoding="async"
                        >
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lccs-why" aria-labelledby="lccs-why-title">
        <div class="lccs-shell">
            <h2 id="lccs-why-title">WHY YOU SHOULD CHOOSE US?</h2>
            <div class="lccs-why__grid">
                @foreach ($whyChoose as $reason)
                    <article>
                        <img
                            src="{{ $lpImg($reason['icon']) }}"
                            alt=""
                            width="105"
                            height="105"
                            loading="lazy"
                            decoding="async"
                        >
                        <h3>{{ $reason['title'] }}</h3>
                        <p>{{ $reason['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lccs-office" aria-labelledby="lccs-office-title">
        <div class="lccs-shell">
            <h2 id="lccs-office-title">PUNE - GLOBAL DELIVERY CENTER</h2>
            <p class="lccs-office__name">IBN TECHNOLOGIES LIMITED,</p>
            <p>
                2nd floor, Kohinoor House,<br>
                Next to Kothari Wheels, Vasant Baug, Bibwewadi,<br>
                Pune, Maharatshtra, 411037
            </p>
        </div>
    </section>
</div>
@endsection
