@extends('layouts.landing')

@php
    $lpImg = fn (string $file): string => asset('images/landing-pages/'.$file);

    $inr = function (int $amount): string {
        $value = (string) abs($amount);
        $last3 = substr($value, -3);
        $rest = substr($value, 0, -3);

        if ($rest === '') {
            return '$'.$last3;
        }

        return '$'.strrev(implode(',', str_split(strrev($rest), 2))).','.$last3;
    };

    $heroBadges = [
        'Microsoft Solutions Partner',
        'ISO 27001 Certified',
        'SOC 2 Type II',
        'GDPR Compliant',
        '24×7 Threat Monitoring',
    ];

    $benefits = [
        [
            'icon' => 'fa-shield-halved',
            'title' => 'Unmatched Protection',
            'text' => 'Sleep easy knowing your business is guarded 24/7 by a team of certified SOC analysts and state-of-the-art technology.',
        ],
        [
            'icon' => 'fa-bolt',
            'title' => 'Faster Response Times',
            'text' => 'Minimize damage with our rapid incident response, reducing downtime and protecting your bottom line.',
        ],
        [
            'icon' => 'fa-chart-line',
            'title' => 'Scalability Made Simple',
            'text' => 'Whether you’re a small business or a global enterprise, our SOC services flex to meet your needs as you grow.',
        ],
        [
            'icon' => 'fa-dollar-sign',
            'title' => 'Cost Efficiency',
            'text' => 'Avoid the high costs of building an in-house SOC—our subscription-based model delivers enterprise-grade security at a fraction of the price.',
        ],
        [
            'icon' => 'fa-eye',
            'title' => 'Enhanced Visibility',
            'text' => 'Gain real-time insights into your security posture with detailed dashboards and reports—empowering informed decision-making.',
        ],
        [
            'icon' => 'fa-peace',
            'title' => 'Peace of Mind',
            'text' => 'Focus on your core operations while we handle the complexities of cybersecurity—your success is our priority.',
        ],
    ];

    $reasons = [
        [
            'title' => '24x7 Threat Monitoring & Response',
            'text' => 'Real-time alerting, correlation, and incident response across your environment.',
        ],
        [
            'title' => 'Built for Compliance',
            'text' => 'HIPAA, PCI-DSS, ISO 27001, SOC 2 Type II, NIST CSF aligned.',
        ],
        [
            'title' => 'Certified Cybersecurity Experts',
            'text' => 'Microsoft Security, CEH, CISSP, and Azure Security certified professionals.',
        ],
        [
            'title' => 'Compliance & Reporting Support',
            'text' => 'Simplify regulatory compliance with continuous monitoring, audit-ready reports, and expert guidance.',
        ],
        [
            'title' => 'Delivery Center in India, U.S. Clients Across Healthcare, Fintech & Retail',
            'text' => 'Serving U.S. Enterprises from India – Expertise Across Healthcare, Fintech, and Retail.',
        ],
        [
            'title' => 'Save Up to 90% vs In-House SOC',
            'text' => 'Serving U.S. Enterprises from India – Expertise Across Healthcare, Fintech, and Retail.',
        ],
        [
            'title' => 'Technology You Already Use',
            'text' => 'Microsoft Sentinel, Splunk, Seceon, IBM QRadar, Azure Defender.',
        ],
        [
            'title' => 'Scalable to Your Business Needs',
            'text' => 'Flexible deployment models tailored to startups, SMBs, and large enterprises.',
        ],
        [
            'title' => '27+ Years IT Consulting Firm',
            'text' => 'Backed by 27+ Years of Proven Cloud and Cybersecurity Consulting Expertise',
        ],
    ];

    $calculator = [
        100 => ['tools' => 275000, 'fte' => 500000, 'impl' => 60000, 'ibn' => 42000, 'percent' => '95%'],
        200 => ['tools' => 300000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 48000, 'percent' => '95%'],
        300 => ['tools' => 325000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 54000, 'percent' => '94%'],
        400 => ['tools' => 350000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 60000, 'percent' => '94%'],
        500 => ['tools' => 375000, 'fte' => 800000, 'impl' => 60000, 'ibn' => 66000, 'percent' => '94%'],
        600 => ['tools' => 400000, 'fte' => 800000, 'impl' => 90000, 'ibn' => 72000, 'percent' => '94%'],
        700 => ['tools' => 425000, 'fte' => 900000, 'impl' => 90000, 'ibn' => 78000, 'percent' => '94%'],
        800 => ['tools' => 450000, 'fte' => 1000000, 'impl' => 90000, 'ibn' => 84000, 'percent' => '94%'],
        900 => ['tools' => 475000, 'fte' => 1200000, 'impl' => 100000, 'ibn' => 90000, 'percent' => '95%'],
        1000 => ['tools' => 500000, 'fte' => 1400000, 'impl' => 100000, 'ibn' => 96000, 'percent' => '95%'],
    ];

    $base = $calculator[100];
    $baseInHouse = $base['tools'] + $base['fte'] + $base['impl'];
    $baseSaving = $baseInHouse - $base['ibn'];
@endphp

@section('content')
<div class="lmss-page">
    <section class="lmss-callbar" aria-label="Call now">
        <div class="lmss-shell lmss-callbar__inner">
            <p>Your Needs. Our Expertise. Call Now to Connect.</p>
            <a href="tel:+12815440740">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                +1 281-544-0740
            </a>
        </div>
    </section>

    <section class="lmss-hero" aria-labelledby="lmss-hero-title">
        <img
            class="lmss-hero__bg"
            src="{{ $lpImg('Microsoft-Security-Services-1.webp') }}"
            alt=""
            aria-hidden="true"
            width="1920"
            height="700"
            fetchpriority="high"
            decoding="async"
        >
        <div class="lmss-shell lmss-hero__inner">
            <div class="lmss-hero__copy">
                <h1 id="lmss-hero-title">24x7 Managed SOC as a Service</h1>
                <p>
                    Reduce cyber risk and save up to 90% with IBN’s SOC-as-a-Service – Delivered by certified experts
                    using Microsoft Sentinel, IBM QRadar, Splunk &amp; Seceon.
                </p>
                <ul class="lmss-hero__badges">
                    @foreach ($heroBadges as $badge)
                        <li>{{ $badge }}</li>
                    @endforeach
                </ul>
                <p class="lmss-hero__prompt">Want to see how much you can save on SOC?</p>
                <a class="lmss-hero__cta" href="#calculator">Get our quick calculator</a>
                <img
                    class="lmss-hero__partner"
                    src="{{ $lpImg('teckUK-partner.webp') }}"
                    alt="techUK Partner"
                    width="150"
                    height="71"
                >
            </div>
        </div>
    </section>

    <section class="lmss-partners" aria-label="Microsoft Solutions Partner">
        <div class="lmss-shell">
            <img
                src="{{ $lpImg('Microsoft-Solutions-Partner.webp') }}"
                alt="Microsoft Solutions Partner badges for Digital &amp; App Innovation, Modern Work, Security, and Azure"
                width="1400"
                height="150"
            >
        </div>
    </section>

    <section class="lmss-certs" aria-labelledby="lmss-certs-title">
        <div class="lmss-shell">
            <h2 id="lmss-certs-title">Team Certifications</h2>
            <img
                src="{{ $lpImg('Team-Certification-Logo.webp') }}"
                alt="Team certifications including CEH and Microsoft security credentials"
                width="1920"
                height="600"
            >
        </div>
    </section>

    <section class="lmss-intro" aria-labelledby="lmss-intro-title">
        <div class="lmss-shell">
            <h2 id="lmss-intro-title">Strengthen Your Security Posture with IBN Tech SOC as a Service</h2>
            <p>
                At IBN Tech, we know that constant threat detection and rapid incident response are vital in today’s
                threat landscape. Our SOC-as-a-Service provides 24×7 monitoring, real-time alerting, and expert-led
                response—powered by leading technologies and certified analysts. Backed by decades of cybersecurity
                expertise, we help you reduce risk, meet compliance, and protect your digital environment—without the
                cost and complexity of managing an in-house SOC.
            </p>
        </div>
    </section>

    <section class="lmss-benefits" aria-labelledby="lmss-benefits-title">
        <div class="lmss-shell">
            <h2 id="lmss-benefits-title">Benefits of Managed SOC Services</h2>
            <div class="lmss-benefits__grid">
                @foreach ($benefits as $benefit)
                    <article>
                        <i class="fa-solid {{ $benefit['icon'] }}" aria-hidden="true"></i>
                        <h3>{{ $benefit['title'] }}</h3>
                        <p>{{ $benefit['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lmss-why" aria-labelledby="lmss-why-title">
        <div class="lmss-shell">
            <h2 id="lmss-why-title">Why Choose IBN's SOC as a Service</h2>
            <div class="lmss-why__grid">
                @foreach ($reasons as $reason)
                    <article class="lmss-why__item">
                        <span class="lmss-why__icon" aria-hidden="true">
                            <i class="fa-regular fa-star"></i>
                        </span>
                        <div>
                            <h3>{{ $reason['title'] }}</h3>
                            <p>{{ $reason['text'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lmss-calculator" aria-labelledby="lmss-calculator-title">
        <div class="lmss-shell">
            <h2 id="lmss-calculator-title">Get Our Quick Calculator</h2>
            <div
                class="lmss-calc"
                id="calculator"
                data-costs='@json($calculator)'
            >
                <label class="lmss-calc__select-label" for="lmss-users">
                    <strong>Select User Count:</strong>
                </label>
                <select id="lmss-users" name="users">
                    @foreach (array_keys($calculator) as $count)
                        <option value="{{ $count }}">{{ $count }} Users</option>
                    @endforeach
                </select>

                <label for="lmss-toolsCost">
                    <strong>IN-HOUSE SOC EXPENSES</strong><br>
                    SIEM Platform, SOAR Platform, Endpoint Detection &amp; Response (EDR) Platforms, etc.
                </label>
                <input id="lmss-toolsCost" type="text" value="{{ $inr($base['tools']) }}" readonly>

                <label for="lmss-employeeCost">
                    <strong>FULL TIME EMPLOYEE COMPENSATION 24x7:</strong><br>
                    Security Analysts, SOC Manager, etc.
                </label>
                <input id="lmss-employeeCost" type="text" value="{{ $inr($base['fte']) }}" readonly>

                <label for="lmss-maintenanceCost">
                    <strong>Product Implementation &amp; Maintenance:</strong>
                </label>
                <input id="lmss-maintenanceCost" type="text" value="{{ $inr($base['impl']) }}" readonly>

                <label for="lmss-inHouseTotal">
                    <strong>Total In-House Cost:</strong>
                </label>
                <input id="lmss-inHouseTotal" type="text" value="{{ $inr($baseInHouse) }}" readonly>

                <label for="lmss-ourCost">
                    <strong>Our Estimated Cost Annually:</strong>
                </label>
                <input id="lmss-ourCost" type="text" value="{{ $inr($base['ibn']) }}" readonly>

                <label for="lmss-saving">
                    <strong>Total Saving:</strong>
                </label>
                <input id="lmss-saving" type="text" value="{{ $inr($baseSaving) }}" readonly>

                <label for="lmss-percentsaving">
                    <strong>Saving:</strong>
                </label>
                <input id="lmss-percentsaving" type="text" value="{{ $base['percent'] }}" readonly>
            </div>
        </div>
    </section>

    <section class="lmss-assess" aria-labelledby="lmss-assess-title" id="lmss-assess">
        <div class="lmss-shell">
            <h2 id="lmss-assess-title">Get Free SOC Assessment</h2>
            <div class="lmss-assess__form">
                <livewire:forms.landing-inquiry-form
                    :landing-page-slug="$landingPage->slug"
                    :landing-page-title="$landingPage->title"
                    id-prefix="lp-managed-soc-services"
                    phone-country="in"
                    thank-you-url="/lp/cybersecurity-thank-you/"
                    wire:key="landing-inquiry-managed-soc-services"
                />
            </div>
        </div>
    </section>
</div>

<script>
    (function () {
        const root = document.getElementById('calculator');
        const select = document.getElementById('lmss-users');

        if (!root || !select) {
            return;
        }

        const costs = JSON.parse(root.getAttribute('data-costs') || '{}');
        const money = (value) => '$' + Number(value).toLocaleString('en-IN');
        const setValue = (id, value) => {
            const field = document.getElementById(id);
            if (field) {
                field.value = value;
            }
        };

        const update = () => {
            const row = costs[select.value];

            if (!row) {
                return;
            }

            const inHouse = row.tools + row.fte + row.impl;
            const saving = inHouse - row.ibn;

            setValue('lmss-toolsCost', money(row.tools));
            setValue('lmss-employeeCost', money(row.fte));
            setValue('lmss-maintenanceCost', money(row.impl));
            setValue('lmss-inHouseTotal', money(inHouse));
            setValue('lmss-ourCost', money(row.ibn));
            setValue('lmss-saving', money(saving));
            setValue('lmss-percentsaving', row.percent);
        };

        select.addEventListener('change', update);
        update();
    })();
</script>
@endsection
