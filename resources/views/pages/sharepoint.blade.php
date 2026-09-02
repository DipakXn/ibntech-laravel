@php
    $img = fn (string $file): string => asset('images/sharepoint/'.$file);

    $serviceHighlights = [
        [
            'title' => 'SharePoint Process Automation:',
            'text' => 'Automate your business processes with SharePoint to enhance productivity.',
        ],
        [
            'title' => 'SharePoint Portals:',
            'text' => 'Create effective SharePoint portals for better document management and collaboration.',
        ],
        [
            'title' => 'SharePoint Branding | Fluent UI :',
            'text' => 'Customize your SharePoint interface with Fluent UI for improved user experience.',
        ],
        [
            'title' => 'SharePoint Mobile Apps:',
            'text' => 'Access SharePoint on the go with SharePoint mobile apps.',
        ],
        [
            'title' => 'SharePoint M365:',
            'text' => 'Leverage the integrated power of SharePoint and Microsoft 365 for a comprehensive solution.',
        ],
    ];

    $scopeOfServices = [
        [
            'icon' => 'sharepoint-business.webp',
            'alt' => 'share point business',
            'title' => 'SharePoint Planning and Design Services',
            'text' => 'Get expert assistance with planning and designing your SharePoint solution.',
        ],
        [
            'icon' => 'sharepoint-implementation.webp',
            'alt' => 'share point implementation',
            'title' => 'SharePoint Implementation and Deployment Services',
            'text' => 'Ensure seamless implementation and deployment of your SharePoint solution.',
        ],
        [
            'icon' => 'sharepoint-customization.webp',
            'alt' => 'share point customization',
            'title' => 'SharePoint Customization Services',
            'text' => 'Customize your SharePoint solution to fit your specific business needs.',
        ],
        [
            'icon' => 'sharepoint-governance.webp',
            'alt' => 'share point governance',
            'title' => 'SharePoint Governance and Information Architecture Services',
            'text' => 'Implement effective governance and information architecture for your SharePoint solution.',
        ],
        [
            'icon' => 'sharepoint-migration.webp',
            'alt' => 'share point migration',
            'title' => 'SharePoint Migration Services',
            'text' => 'Transition smoothly to SharePoint with our expert migration services.',
        ],
        [
            'icon' => 'sharepoint-training.webp',
            'alt' => 'sharepoint training',
            'title' => 'SharePoint Training Services',
            'text' => 'Equip your team with the necessary skills to use SharePoint effectively.',
        ],
        [
            'icon' => 'sharepoint-training-1.webp',
            'alt' => 'share point training',
            'title' => 'SharePoint Support Services',
            'text' => 'Get ongoing support for the smooth functioning of your SharePoint solution.',
        ],
        [
            'icon' => 'sharepoint-integration.webp',
            'alt' => 'share point integration',
            'title' => 'SharePoint Integration Services',
            'text' => 'Integrate SharePoint with your existing business applications for seamless operations.',
        ],
        [
            'icon' => 'sharepoint-business-1.webp',
            'alt' => 'share point business',
            'title' => 'SharePoint Business Intelligence Services',
            'text' => 'Gain actionable insights from your data with SharePoint BI.',
        ],
        [
            'icon' => 'sharepoint-compliance.webp',
            'alt' => 'share point compliance',
            'title' => 'SharePoint Compliance and Security Services',
            'text' => 'Ensure the security and compliance of your SharePoint solution.',
        ],
    ];

    $benefits = [
        'Access to a team of experienced SharePoint consultants.',
        'Custom SharePoint solutions tailored to your unique business needs.',
        'Improved collaboration and document management.',
        'Streamlined SharePoint implementation, migration, and integration.',
        'Ongoing support and training for effective SharePoint usage.',
    ];

    $processSteps = [
        'Understanding your specific business needs and SharePoint requirements.',
        'Planning and designing a tailored SharePoint solution.',
        'Implementing and deploying your SharePoint solution.',
        'Providing ongoing support, training, and consultation.',
        'Continually assessing the effectiveness of your SharePoint solution and making necessary improvements.',
    ];

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
    @vite(['resources/css/pages/sharepoint.css'])
@endpush

@section('content')
    <div class="sharepoint-page">
        {{-- Hero Section --}}
        <section class="sharepoint-hero" aria-labelledby="sharepoint-hero-title">
            <div class="site-shell sharepoint-hero__inner">
                <div class="sharepoint-hero__copy">
                    <p class="sharepoint-hero__eyebrow">
                        Unleash the power of collaboration with IBN Tech's expert SharePoint Consulting Services.
                    </p>
                    <h1 id="sharepoint-hero-title">SharePoint Consulting Services</h1>
                    <p class="sharepoint-hero__lede">
                        With 200 million active users as of 2020, SharePoint remains a leading collaborative platform (Microsoft). Empower your team with IBN Tech's SharePoint Consulting Services.
                    </p>
                    <div class="sharepoint-hero__actions">
                        <a href="#contact-us" class="sharepoint-btn sharepoint-btn--green">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="sharepoint-hero__media">
                    <img
                        src="{{ $img('sharepoint-consulting.webp') }}"
                        alt="share point consulting"
                        width="560"
                        height="500"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 2: Intro / Premier Provider --}}
        <section class="sharepoint-section" aria-labelledby="sharepoint-intro-title">
            <div class="site-shell sharepoint-split">
                <div class="sharepoint-split__media sharepoint-split__media--photo">
                    <img
                        src="{{ $img('2nd-image-1.webp') }}"
                        alt="2nd image"
                        width="778"
                        height="618"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="sharepoint-split__copy">
                    <h2 id="sharepoint-intro-title" class="sr-only">Premier SharePoint Consulting Services</h2>
                    <p>
                        IBN Tech is a premier provider of SharePoint Consulting Services, helping businesses unlock the full potential of this robust collaboration platform. Our team of experienced SharePoint consultants assists in transforming your business operations through effective document management, streamlined workflows, and enhanced collaboration.
                    </p>
                    <a href="#contact-us" class="sharepoint-btn sharepoint-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 3: Service Highlights --}}
        <section class="sharepoint-section sharepoint-section--mint" aria-labelledby="sharepoint-highlights-title">
            <div class="site-shell sharepoint-split sharepoint-split--highlights">
                <div class="sharepoint-split__copy">
                    <h2 id="sharepoint-highlights-title">Service Highlights</h2>
                    <p class="sharepoint-subhead">Our SharePoint Consulting Services are tailored to cater to diverse needs, including:</p>
                    <ul class="sharepoint-highlights__list">
                        @foreach ($serviceHighlights as $item)
                            <li>
                                <strong>{{ $item['title'] }}</strong> {{ $item['text'] }}
                            </li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="sharepoint-btn sharepoint-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="sharepoint-split__media">
                    <img
                        src="{{ $img('service-highlights-2.webp') }}"
                        alt="service highlights"
                        width="560"
                        height="500"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 4: Scope of Services --}}
        <section class="sharepoint-section" aria-labelledby="sharepoint-scope-title">
            <div class="site-shell">
                <div class="sharepoint-heading">
                    <h2 id="sharepoint-scope-title">Scope of Services</h2>
                    <p>Our SharePoint Consulting Services include:</p>
                </div>

                <div class="sharepoint-scope-grid" role="list">
                    @foreach ($scopeOfServices as $card)
                        <article class="sharepoint-scope-card" role="listitem">
                            <figure class="sharepoint-scope-card__icon">
                                <img
                                    src="{{ $img($card['icon']) }}"
                                    alt="{{ $card['alt'] }}"
                                    width="65"
                                    height="65"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </figure>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="sharepoint-section__cta">
                    <a href="{{ route('page.show', ['slug' => 'contact-us']) }}" class="sharepoint-btn sharepoint-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 5: Our Distinctive Approach to Customer Benefits --}}
        <section class="sharepoint-section sharepoint-section--mint" aria-labelledby="sharepoint-benefits-title">
            <div class="site-shell sharepoint-split sharepoint-split--benefits">
                <div class="sharepoint-split__copy">
                    <h2 id="sharepoint-benefits-title">Our Distinctive Approach to Customer Benefits</h2>
                    <p class="sharepoint-subhead">When you choose IBN Tech for your SharePoint consulting needs, you can expect:</p>
                    <ul class="sharepoint-list">
                        @foreach ($benefits as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="sharepoint-btn sharepoint-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="sharepoint-split__media sharepoint-split__media--photo">
                    <img
                        src="{{ $img('service-basic-scope.webp') }}"
                        alt="service basic scope"
                        width="515"
                        height="569"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Section 6: SharePoint Consulting Process at IBN Tech --}}
        <section class="sharepoint-section" aria-labelledby="sharepoint-process-title">
            <div class="site-shell sharepoint-split">
                <div class="sharepoint-split__media">
                    <img
                        src="{{ $img('ibn-tech-database-consulting-service-provide.webp') }}"
                        alt="ibn tech database consulting service provide"
                        width="400"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="sharepoint-split__copy">
                    <h2 id="sharepoint-process-title">SharePoint Consulting Process at IBN Tech</h2>
                    <p class="sharepoint-subhead">Our SharePoint Consulting process includes the following steps:</p>
                    <ul class="sharepoint-list">
                        @foreach ($processSteps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ul>
                    <a href="#contact-us" class="sharepoint-btn sharepoint-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 7: Blue Callout Banner --}}
        <section class="sharepoint-banner" aria-labelledby="sharepoint-banner-title">
            <div class="site-shell sharepoint-banner__inner">
                <h2 id="sharepoint-banner-title" class="sr-only">IBN Tech SharePoint Consulting</h2>
                <p>
                    At IBN Tech, we pride ourselves on providing high-quality, customized SharePoint Consulting Services that cater to your specific needs. Trust us to help you leverage SharePoint to enhance your business collaboration and productivity.
                </p>
                <div class="sharepoint-banner__cta">
                    <a href="#contact-us" class="sharepoint-btn sharepoint-btn--green">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 8: Schedule A Call with Our Experts --}}
        <section class="sharepoint-section sharepoint-consult" id="contact-us" aria-labelledby="sharepoint-consult-title">
            <div class="site-shell sharepoint-consult__inner">
                <aside class="sharepoint-consult__card" aria-labelledby="sharepoint-consult-title">
                    <div class="sharepoint-consult__header">
                        <h2 id="sharepoint-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="sharepoint-consult__body">
                        <livewire:forms.contact-form
                            form-name="sharepoint"
                            id-prefix="sharepoint"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="sharepoint-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="form Image"
                        width="540"
                        height="364"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
