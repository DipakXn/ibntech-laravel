@extends('layouts.app')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">White Papers</p>
            <h1>Research-driven white papers, reports, and strategic resources.</h1>
            <p class="inner-hero__lede">
                Explore long-form perspectives, practical frameworks, and advisory content published by the team.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($whitePapers as $whitePaper)
                    <article class="card-panel case-study-card">
                        @if($whitePaper->featuredImageUrl())
                            <a href="{{ route('white-papers.show', $whitePaper->slug) }}" class="case-study-card__image">
                                <img src="{{ $whitePaper->featuredImageUrl() }}" alt="{{ $whitePaper->title }}">
                            </a>
                        @endif
                        <p class="meta-chip">White Paper</p>
                        <h3><a href="{{ route('white-papers.show', $whitePaper->slug) }}">{{ $whitePaper->title }}</a></h3>
                        <p style="margin-top: 0.8rem;">{{ $whitePaper->excerpt ?: \App\Support\BlockContent::summary($whitePaper->content) }}</p>
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published white papers found.</p>
                @endforelse
            </div>

            <div class="blog-pagination">
                {{ $whitePapers->onEachSide(1)->links('blog.partials.pagination', ['label' => 'White papers pagination']) }}
            </div>
        </div>
    </section>
@endsection
