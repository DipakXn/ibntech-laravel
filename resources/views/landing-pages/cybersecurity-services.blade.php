@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);

    $services = [
        [
            'icon' => 'report.webp',
            'title' => 'Dedicated Ciso / Red team services',
            'text' => 'Defend your business with our Red Team/CISO services – tackling threats before they strike. Elevate your security game, stay ahead of risks, and ensure uninterrupted success with our real time threat hunting and mitigation.',
        ],
        [
            'icon' => 'web.webp',
            'title' => 'Vulnerability Assessment & Penetration Testing (VAPT)',
            'text' => 'Secure your digital realm with our VAPT consulting. Defend against cyber threats across Web, Mobile, Network, Cloud, and Source Code review. Trust us for proactive problem-solving and robust protection.',
        ],
        [
            'icon' => 'net.webp',
            'title' => 'End-to-End SIEM & SOAR services',
            'text' => 'Resolve cybersecurity challenges effortlessly with our End-to-End SIEM and SOAR services. Our seamless integration and automated threat response guarantee swift problem-solving, elevating your defense strategy to new heights.',
        ],
        [
            'icon' => 'mo.webp',
            'title' => 'Compliance and Reporting',
            'text' => 'We ensure seamless compliance and reporting solutions, relieving our clients from the burden of regulatory complexities. By integrating cutting-edge technology, we empower businesses to focus on growth while we take care of compliance headaches.',
        ],
        [
            'icon' => 'mo.webp',
            'title' => 'Managed Security Operations Centre (m-SOC)',
            'text' => 'Our Managed Security Operations Centre (SOC) is your proactive shield against cyber threats. We resolve potential security issues to safeguard your digital assets, so you can focus on what matters most – your success!',
        ],
        [
            'icon' => 'web.webp',
            'title' => 'SSO MFA IAM XDR',
            'text' => 'Consulting on Single-Sign-On (SSO), Multifactor Authentications (MFA), Identity and Access Management (IAM), Extended Detection and Response (XDR)',
        ],
    ];

    $reasonsLeft = [
        '26+ years of experience in Cyber Security, Hosting and Cloud Consulting Services.',
        'Certified team of lead auditors.',
        '1200+ satisfied clients in 10 + countries',
        'ISO 9001:2015 & 27001:2022 Certified Company',
        'CIO 10 most promising cloud solutions provider',
    ];

    $reasonsRight = [
        'SiliconIndia 25 most promising cloud computing companies',
        'Authorized partners of AWS, Azure, Acronis, HPE Greenlake, Jio Cloud.',
        'Partnerships with Sophos, Crowdstrike, Fortinet, Sumo Logic and more.',
        'Microsoft Azure , AWS certified experts',
        '24 x 7, 365 days Dedicated NOC support service',
    ];

    $offices = [
        [
            'title' => 'UK',
            'lines' => [
                'IBN Tech Limited',
                '30 Orange Street,',
                'London United Kingdom',
                'WC2H 7HF.',
            ],
            'links' => [
                ['href' => 'tel:+442037699111', 'label' => 'Phone : +44 203-769-9111'],
                ['href' => 'mailto:sales@ibntech.com', 'label' => 'Mail Us : sales@ibntech.com'],
            ],
        ],
        [
            'title' => 'USA',
            'lines' => [
                'IBN Technologies LLC',
                '66 West Flagler Street',
                'Miami, FL 33130 USA',
            ],
            'links' => [
                ['href' => 'tel:+12815440740', 'label' => 'Phone : +1 281-544-0740'],
                ['href' => 'mailto:sales@ibntech.com', 'label' => 'Mail Us : sales@ibntech.com'],
            ],
        ],
        [
            'title' => 'INDIA',
            'lines' => [
                'PUNE - GLOBAL DELIVERY CENTER',
                '2nd floor, Kohinoor House Break Hotel Lane,',
                'next to kothari Wheels, Vasant Baug, Vasant Baug society,',
                'Bibwewadi, pune, Maharatshtra, 411037',
            ],
            'links' => [],
        ],
    ];
@endphp

@section('content')
<div class="lcys-page">
    <section class="lcys-hero" aria-labelledby="lcys-hero-title">
        <img
            class="lcys-hero__bg"
            src="{{ $lpImg('Cyber-Security-Banner-01-left.webp') }}"
            alt=""
            aria-hidden="true"
            width="1920"
            height="700"
            fetchpriority="high"
            decoding="async"
        >
        <div class="lcys-shell lcys-hero__inner">
            <div class="lcys-hero__copy">
                <h1 id="lcys-hero-title">Comprehensive Cybersecurity Solutions!</h1>
                <p>
                    Outsource your security and IT operations with our expert services: vCISO, Red Team Testing, mSOC, VAPT Services, ITSM, SIEM Services &amp; more. Benefit from 24/7 threat monitoring, &amp; optimised IT service management to keep your infrastructure safe &amp; efficient.
                </p>
                <p class="lcys-hero__emphasis">Book Your Consultation Now!</p>
                <a class="lcys-hero__cta" href="#contact-sec">Schedule a demo</a>
            </div>
            <div class="lcys-hero__media">
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="auto"
                    aria-label="Cybersecurity protection across digital infrastructure"
                >
                    <source src="{{ $lpImg('Banner-GIF-design-3.mp4') }}#t=1" type="video/mp4">
                </video>
            </div>
        </div>
    </section>

    <section class="lcys-why" aria-labelledby="lcys-why-title">
        <div class="lcys-shell">
            <h2 id="lcys-why-title">Why Opt for Our Cybersecurity Expertise?</h2>
            <p>
                The cost of a cybersecurity breach in 2023: $4.45 million, a 15% surge in three years. Imagine the impact on your business, reputation, time, energy, and money!
            </p>
            <p>
                We Shield your bottom line from the fallout of a breach &amp; Safeguard the trust your customers place in you. So now Don't waste time, energy, and money fixing avoidable breaches.
            </p>
            <img
                class="lcys-why__diagram"
                src="{{ $lpImg('comprehensive-Cybersecurity-management-PNG.webp') }}"
                alt="Comprehensive Cybersecurity management"
                width="1080"
                height="1080"
            >
        </div>
    </section>

    <section class="lcys-services" aria-labelledby="lcys-services-title">
        <div class="lcys-shell">
            <h2 id="lcys-services-title">Comprehensive Cybersecurity Management</h2>
            <div class="lcys-services__grid">
                @foreach ($services as $service)
                    <article>
                        <span class="lcys-services__icon">
                            <img src="{{ $lpImg($service['icon']) }}" alt="" width="70" height="70">
                        </span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lcys-choose" aria-labelledby="lcys-choose-title">
        <div class="lcys-shell">
            <h2 id="lcys-choose-title">Why to choose us</h2>
            <div class="lcys-choose__grid">
                <article>
                    <img
                        src="{{ $lpImg('Cybersecurity-Image-1.webp') }}"
                        alt=""
                        width="391"
                        height="626"
                    >
                    <ul>
                        @foreach ($reasonsLeft as $reason)
                            <li>{{ $reason }}</li>
                        @endforeach
                    </ul>
                </article>
                <article>
                    <img
                        src="{{ $lpImg('Cybersecurity-Image-2.webp') }}"
                        alt=""
                        width="443"
                        height="492"
                    >
                    <ul>
                        @foreach ($reasonsRight as $reason)
                            <li>{{ $reason }}</li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="lcys-article" aria-labelledby="lcys-article-title">
        <div class="lcys-shell">
            <h2 id="lcys-article-title">Why Opt for Our Cybersecurity Expertise?</h2>
            <p>
                As a premier cybersecurity solutions provider and trusted cyber security consultant company, we recognize the paramount importance of safeguarding your business. In the year 2023 alone, the cost of a cybersecurity breach witnessed a 15% surge, reaching $4.45 million, posing a significant threat to your bottom line, reputation, and customer trust.
            </p>
            <p>
                Our dedicated team specializes in VAPT services, offering comprehensive penetration testing solutions to mitigate the risk of breaches. As a certified penetration tester and one of the best penetration testing companies, we prioritize protecting your assets and preventing avoidable cyber threats.
            </p>
            <p>
                Furthermore, our proficiency extends to being a top-tier managed Security Operations Center (SOC) services provider. Leveraging advanced Cloud-based SIEM solutions, we ensure proactive monitoring and threat detection. As one of the best managed SIEM services providers, we go beyond by offering managed firewall services, including cloud-managed firewall solutions.
            </p>
            <p>
                Do not compromise the security of your business with potential breaches. Align with us, a leading VAPT services provider company and managed SIEM services expert, to strengthen your defenses and shield yourself from the costly consequences of cyber attacks.
            </p>
        </div>
    </section>

    <section class="lcys-partners" aria-labelledby="lcys-partners-title">
        <div class="lcys-shell">
            <h2 id="lcys-partners-title">Our Solutions Partner</h2>
            <img
                src="{{ $lpImg('Microsoft-Solutions-Partner.webp') }}"
                alt="Microsoft Solutions Partner"
                width="1400"
                height="150"
            >
        </div>
    </section>

    <section class="lcys-contact" id="contact-sec" aria-labelledby="lcys-contact-title">
        <div class="lcys-shell">
            <h2 id="lcys-contact-title">Why to choose us</h2>
            <div class="lcys-contact__panel">
                <livewire:forms.landing-inquiry-form
                    :landing-page-slug="$landingPage->slug"
                    :landing-page-title="$landingPage->title"
                    id-prefix="lp-cybersecurity-services"
                    phone-country="in"
                    wire:key="landing-inquiry-cybersecurity-services"
                />
            </div>
        </div>
    </section>

    <section class="lcys-offices" aria-label="Office locations">
        <div class="lcys-shell lcys-offices__grid">
            @foreach ($offices as $office)
                <article>
                    <h2>{{ $office['title'] }}</h2>
                    @foreach ($office['lines'] as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                    @if ($office['links'] !== [])
                        <ul>
                            @foreach ($office['links'] as $link)
                                <li>
                                    <a href="{{ $link['href'] }}">{{ $link['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
