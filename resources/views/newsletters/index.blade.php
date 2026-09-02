@extends('layouts.newsletter')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Newsletters</p>
            <h1>Published newsletters, expert takeaways, and security-focused commentary.</h1>
            <p class="inner-hero__lede">
                Browse archived newsletter pages in a card-based view similar to the articles section.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($newsletters as $newsletter)
                    <article class="card-panel case-study-card">
                        @if($newsletter->featuredImageUrl())
                            <a href="{{ $newsletter->publicUrl() }}" class="case-study-card__image">
                                <img src="{{ $newsletter->featuredImageUrl() }}" alt="{{ $newsletter->title }}">
                            </a>
                        @endif
                        <p class="meta-chip">Newsletter</p>
                        <h3>
                            <a href="{{ $newsletter->publicUrl() }}">{{ $newsletter->title }}</a>
                        </h3>
                        <p style="margin-top: 0.8rem;">
                            {{ $newsletter->seoMeta?->meta_description ?: 'Placeholder summary copy for this newsletter card. Update the SEO description to control this listing snippet.' }}
                        </p>
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published newsletters found.</p>
                @endforelse
            </div>

            <div style="margin-top: 2rem;">
                {{ $newsletters->links() }}
            </div>
        </div>
    </section>
@endsection
