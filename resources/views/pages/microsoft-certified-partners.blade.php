@php
    $img = fn (string $file): string => asset('images/microsoft-certified-partners/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);

    $partnerBenefits = [
        'Microsoft Products Technical training and literature',
        'Products, Tools and Other services designed to improve operations and customer satisfaction, and to deliver the best customer experience.',
        'Marketing tools and technical support',
        'Product Licenses',
        'Helpdesk and production support for problem and incident management',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/microsoft-certified-partners.css'])
@endpush

@section('content')
    <div class="mcp-page">
        <section class="mcp-hero" aria-labelledby="mcp-hero-title">
            <div class="site-shell mcp-hero__inner">
                <div class="mcp-hero__copy">
                    <h1 id="mcp-hero-title">Microsoft Certified Partners</h1>
                    <a href="{{ $contactUrl }}" class="mcp-btn mcp-btn--green">
                        Get a Free Consultation Today
                    </a>
                </div>

                <div class="mcp-hero__media">
                    <img
                        src="{{ $img('microsoft-certified-partners.webp') }}"
                        alt="microsoft-certified-partners"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        <section class="mcp-split" aria-labelledby="mcp-gold-title">
            <div class="site-shell mcp-split__inner">
                <div class="mcp-split__media">
                    <img
                        src="{{ $img('gold-certified-partner.webp') }}"
                        alt="gold certified partner"
                        width="472"
                        height="464"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="mcp-split__copy">
                    <h2 id="mcp-gold-title">Gold Certified Partner</h2>
                    <p>
                        <strong>IBN Tech's</strong> Microsoft technology practice has over 40+ multi-skilled resources and over 100 person years of experience. 50% of our professionals are MCP MCAD, MCSD, MCTS and MCPD certified. We have certified competencies and specializations in Software Development, Portals and Collaboration, Web Development, and Mobility. We also have certified competencies in information worker solutions and business intelligence solutions. Our Microsoft Technology Practice allows us to serve a global client base, from industries such as Investment, Retail, Manufacturing, Travel and Hospitality, and Media and Entertainment.
                    </p>
                </div>
            </div>
        </section>

        <section class="mcp-split mcp-split--reverse" aria-labelledby="mcp-ibn-title">
            <div class="site-shell mcp-split__inner">
                <div class="mcp-split__copy">
                    <h2 id="mcp-ibn-title">Gold Certified Partner with IBN</h2>
                    <ul class="mcp-list">
                        @foreach ($partnerBenefits as $item)
                            <li>
                                <span class="mcp-list__icon" aria-hidden="true">
                                    <i class="fa-solid fa-circle-chevron-right"></i>
                                </span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="mcp-split__note">
                        Additionally <strong>IBN</strong> is also Microsoft SPLA Partner for its Web hosting and Networking Services
                    </p>
                </div>

                <div class="mcp-split__media">
                    <img
                        src="{{ $img('ibn-as-a-gold-certified-partner-is-provided-with.webp') }}"
                        alt="ibn as a gold certified partner is provided with"
                        width="500"
                        height="560"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
