@extends('layouts.app')

@section('content')
    <section class="inner-hero inner-hero--listing">
        <div class="site-shell inner-hero__inner">
            <h1 class="inner-hero__eyebrow">Press Releases</h1>
            <h2>Official company announcements, launches, and updates.</h2>
            <p class="inner-hero__lede">
                Product news, partnership updates, operational milestones, and public statements from the team.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($pressReleases as $pressRelease)
                    <article class="card-panel case-study-card">
                        @if($pressRelease->featuredImageUrl())
                            <a href="{{ route('pressrelease.show', $pressRelease->slug) }}" class="case-study-card__image">
                                <x-featured-image :model="$pressRelease" />
                            </a>
                        @endif
                        <p class="meta-chip">Press Release</p>
                        <h3><a href="{{ route('pressrelease.show', $pressRelease->slug) }}">{{ $pressRelease->title }}</a></h3>
                        <p style="margin-top: 0.8rem;">{{ $pressRelease->excerpt ?: \App\Support\BlockContent::summary($pressRelease->content) }}</p>
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published press releases found.</p>
                @endforelse
            </div>

            <div class="blog-pagination">
                {{ $pressReleases->onEachSide(1)->links('blog.partials.pagination', ['label' => 'Press releases pagination']) }}
            </div>
        </div>
    </section>
@endsection
