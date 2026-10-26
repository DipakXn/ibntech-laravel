@extends('layouts.landing')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Landing Pages</p>
            <h1>Published campaign landing pages for cybersecurity, cloud, and managed services.</h1>
            <p class="inner-hero__lede">
                Browse active landing pages in a card-based view. Thank-you confirmation pages are not listed here.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($landingPages as $landingPage)
                    <article class="card-panel case-study-card">
                        @if($landingPage->featuredImageUrl())
                            <a href="{{ $landingPage->publicUrl() }}" class="case-study-card__image">
                                <x-featured-image :model="$landingPage" />
                            </a>
                        @endif
                        <p class="meta-chip">Landing Page</p>
                        <h3>
                            <a href="{{ $landingPage->publicUrl() }}">{{ $landingPage->title }}</a>
                        </h3>
                        <p style="margin-top: 0.8rem;">
                            {{ $landingPage->seoMeta?->meta_description ?: 'Placeholder summary copy for this landing page card. Update the SEO description to control this listing snippet.' }}
                        </p>
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published landing pages found.</p>
                @endforelse
            </div>

            <div style="margin-top: 2rem;">
                {{ $landingPages->links() }}
            </div>
        </div>
    </section>
@endsection
