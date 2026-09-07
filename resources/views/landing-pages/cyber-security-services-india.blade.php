@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);

    $services = [
        [
            'icon' => 'report.webp',
            'title' => '24/7 Managed Security Operations Centre (m-SOC)',
            'text' => 'Our Managed Security Operations Centre (SOC) is your proactive shield against cyber threats. We resolve potential security issues to safeguard your digital assets, so you can focus on what matters most – your success!',
        ],
        [
            'icon' => 'web.webp',
            'title' => 'Vulnerability Assessment & Penetration Testing',
            'text' => 'Secure your digital realm with our VAPT consulting. Defend against cyber threats across Web, Mobile, Network, Cloud, and Source Code review. Trust us for proactive problem-solving and robust protection.',
        ],
        [
            'icon' => 'soc-2-type-2.webp',
            'title' => 'SOC 2 Type II Audit Compliance',
            'text' => 'Prove your security posture with SOC 2 Type II compliance. Our experts help you achieve audit readiness, validate controls over time, and build lasting trust with customers, investors, and enterprise partners.',
        ],
        [
            'icon' => 'mo.webp',
            'title' => 'CISO Services',
            'text' => 'Elevate your security posture with our Chief Information Security Officer (CISO) services. Our experienced professionals provide strategic guidance to align your security initiatives with business goals.',
        ],
        [
            'icon' => 'report.webp',
            'title' => 'End-to-End SIEM & SOAR services',
            'text' => 'Resolve cybersecurity challenges effortlessly with our End-to-End SIEM and SOAR services. Our seamless integration and automated threat response guarantee swift problem-solving, elevating your defense strategy to new heights.',
        ],
        [
            'icon' => 'web.webp',
            'title' => 'Compliance and Reporting',
            'text' => 'We ensure seamless compliance and reporting solutions, relieving our clients from the burden of regulatory complexities. By integrating cutting-edge technology, we empower businesses to focus on growth while we take care of compliance headaches.',
        ],
    ];

    $reasonsLeft = [
        '26+ years of experience in Cyber Security, Hosting and Cloud Consulting Services.',
        'Certified team of lead auditors.',
        '1200+ satisfied clients in 10 + countries.',
        'ISO 9001:2015 & 27001:2022 Certified Company',
        'Dedicated Red Team & Ciso Services Provider.',
    ];

    $reasonsRight = [
        'CIO 10 most promising cloud solutions provider',
        'SiliconIndia 25 most promising cloud computing companies',
        'Partnerships with Sophos, Crowdstrike, Fortinet, Sumo Logic and more.',
        '24 x 7, 365 days Dedicated support services',
        'Authorized solutions partners of AWS, Azure, Acronis, HPE Greenlake, Jio Cloud.',
    ];
@endphp

@section('content')
<div class="lcsi-page">
    <section class="lcsi-callbar" aria-label="Call now">
        <div class="lcsi-shell lcsi-callbar__inner">
            <p>Your Needs. Our Expertise. Call Now to Connect.</p>
            <a href="tel:020-711-79586">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                020-711-79586
            </a>
        </div>
    </section>

    <section class="lcsi-hero" aria-labelledby="lcsi-hero-title">
        <img
            class="lcsi-hero__bg"
            src="{{ $lpImg('cyber-security-services-india-hero-img.webp') }}"
            alt=""
            aria-hidden="true"
            width="1920"
            height="900"
            fetchpriority="high"
            decoding="async"
        >
        <div class="lcsi-shell lcsi-hero__inner">
            <div class="lcsi-hero__copy">
                <h1 id="lcsi-hero-title">
                    Comprehensive <span>Cybersecurity</span> Services for Modern Businesses
                </h1>
                <p>
                    Strengthen your security posture with IBN Technologies' end-to-end cybersecurity services.
                    We help organizations identify vulnerabilities, achieve compliance, and protect critical business
                    assets through Managed SOC (mSOC), 24×7 Threat Monitoring &amp; Response, SIEM Services,
                    vCISO Consulting, SOC 2 Type II Readiness &amp; Audit Support, VAPT (Vulnerability Assessment
                    &amp; Penetration Testing), Red Team Assessment, and Cybersecurity Audits.
                </p>
                <p>
                    Our certified security experts deliver proactive threat detection, continuous monitoring,
                    compliance guidance, and actionable remediation to reduce cyber risks and ensure regulatory
                    compliance. Whether you're a startup, SME, or enterprise, our tailored cybersecurity solutions
                    help safeguard your IT infrastructure, cloud environments, web applications, networks, and
                    endpoints.
                </p>
                <p>
                    Looking for trusted Managed SOC, VAPT, SOC 2 Type II, SIEM, or vCISO services? Contact IBN
                    Technologies today for a security assessment and expert consultation.
                </p>
            </div>

            <div class="lcsi-hero__form" id="lcsi-consult">
                <h2>Schedule A Consultation!</h2>
                <div class="lcsi-hero__form-body">
                    <livewire:forms.landing-inquiry-form
                        :landing-page-slug="$landingPage->slug"
                        :landing-page-title="$landingPage->title"
                        id-prefix="lp-cyber-security-services-india-hero"
                        phone-country="in"
                        thank-you-url="/lp/cyber-security-services-india-thank-you/"
                        wire:key="landing-inquiry-cyber-security-services-india-hero"
                    />
                </div>
            </div>
        </div>
    </section>

    <section class="lcsi-why" aria-labelledby="lcsi-why-title">
        <div class="lcsi-shell">
            <h2 id="lcsi-why-title">Why Entrust Us with Your Cybersecurity?</h2>
            <p class="lcsi-why__lead">
                The cost of a cybersecurity breach in 2023: $4.45 million, a 15% surge in three years. Imagine the
                impact on your business, reputation, time, energy, and money!
            </p>
            <p>
                IBN Tech, has 26+ years of industry expertise in providing Managed SOC solutions and is one of the
                leading Cybersecurity solutions provider companies and best VAPT services providers in India.
            </p>
            <img
                class="lcsi-why__diagram"
                src="{{ $lpImg('comprehensive-Cybersecurity-management-PNG.webp') }}"
                alt="Comprehensive Cybersecurity management"
                width="1080"
                height="1080"
            >
        </div>
    </section>

    <section class="lcsi-services" aria-labelledby="lcsi-services-title">
        <div class="lcsi-shell">
            <h2 id="lcsi-services-title">Our Comprehensive Cybersecurity Management Services!</h2>
            <div class="lcsi-services__grid">
                @foreach ($services as $service)
                    <article>
                        <span class="lcsi-services__icon">
                            <img src="{{ $lpImg($service['icon']) }}" alt="" width="70" height="70">
                        </span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lcsi-choose" aria-labelledby="lcsi-choose-title">
        <div class="lcsi-shell">
            <h2 id="lcsi-choose-title">Why to choose us</h2>
            <div class="lcsi-choose__box">
                <ul class="lcsi-choose__list">
                    @foreach ($reasonsLeft as $reason)
                        <li>{{ $reason }}</li>
                    @endforeach
                </ul>
                <ul class="lcsi-choose__list">
                    @foreach ($reasonsRight as $reason)
                        <li>{{ $reason }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="lcsi-article" aria-label="Cybersecurity expertise">
        <div class="lcsi-shell">
            <p>
                In 2023, the financial repercussions of a cybersecurity breach have skyrocketed to $4.45 million,
                marking a 15% surge over the past three years. The potential ramifications on your business,
                reputation, time, energy, and financial resources are profound! With a rich legacy of 24 years in the
                industry, IBN Tech stands out as a top-tier cybersecurity consultant, offering unparalleled expertise
                in Managed SOC solutions. Recognized as one of the leading cybersecurity firms in Pune and across
                India, IBN Tech is distinguished for its excellence as a cybersecurity solutions provider.
            </p>
            <p>
                Specializing in a comprehensive range of services, including VAPT (penetration testing in
                cybersecurity), our team boasts certified penetration testers proficient in network penetration
                testing, web application penetration testing, and mobile application penetration testing. As one of
                the best penetration testing firms in Pune and a prominent penetration testing company in India, we
                prioritize the security of your digital assets. Our commitment extends to delivering cutting-edge
                cybersecurity services, positioning IBN Tech as a trusted cybersecurity consultant in Pune and
                throughout India. We excel in offering Managed SIEM Services and Solutions, earning our reputation as
                the best SIEM solution provider. Additionally, our proficiency as managed firewall providers and
                pioneers in cloud-managed firewall solutions ensures robust protection for your systems.
            </p>
            <p>
                Emphasizing Security Operations Center (SOC) expertise, IBN Tech is among the premier SOC companies
                in India. Our Managed SOC Solutions are tailored to meet the evolving cybersecurity landscape, and
                our SOC experts are dedicated to safeguarding your digital infrastructure. As leading Managed SOC
                providers, we take pride in delivering effective and reliable cybersecurity services in Pune and
                beyond. Choose IBN Tech for state-of-the-art cybersecurity solutions, including Cloud-based SIEM
                solutions. Safeguard your business against cyber threats and fortify your defenses with the expertise
                of a seasoned cybersecurity consultant in Pune and across India. Your cybersecurity needs are our
                top priority, and we are committed to ensuring the resilience and security of your digital
                environment.
            </p>
        </div>
    </section>

    <section class="lcsi-partners" aria-labelledby="lcsi-partners-title">
        <div class="lcsi-shell">
            <h2 id="lcsi-partners-title">Our Partner</h2>
            <img
                src="{{ $lpImg('Team-Certification-Logo.webp') }}"
                alt="Team certifications including CEH, ISO, and cybersecurity credentials"
                width="1920"
                height="600"
            >
        </div>
    </section>

    <section class="lcsi-offices" aria-label="Global offices">
        <div class="lcsi-shell lcsi-offices__grid">
            <article>
                <h2>UK</h2>
                <p>
                    IBN Tech Limited<br>
                    30 Orange Street,<br>
                    London United Kingdom<br>
                    WC2H 7HF.
                </p>
                <ul>
                    <li>
                        <a href="tel:+442037699111">Phone : +44 203-769-9111</a>
                    </li>
                    <li>
                        <a href="mailto:sales@ibntech.com">Mail Us : sales@ibntech.com</a>
                    </li>
                </ul>
            </article>
            <article>
                <h2>USA</h2>
                <p>
                    IBN Technologies LLC<br>
                    66 West Flagler Street<br>
                    Miami, FL 33130 USA
                </p>
                <ul>
                    <li>
                        <a href="tel:+12815440740">Phone : +1 281-544-0740</a>
                    </li>
                    <li>
                        <a href="mailto:sales@ibntech.com">Mail Us : sales@ibntech.com</a>
                    </li>
                </ul>
            </article>
            <article>
                <h2>INDIA</h2>
                <p class="lcsi-offices__label">PUNE - GLOBAL DELIVERY CENTER</p>
                <p>
                    2nd floor, Kohinoor House Break Hotel Lane,<br>
                    next to kothari Wheels, Vasant Baug, Vasant Baug society,<br>
                    Bibwewadi, pune, Maharatshtra, 411037
                </p>
            </article>
        </div>
    </section>
</div>
@endsection
