@extends('layouts.app')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">Articles</p>
            <h1>Editorial articles, explainers, and insight-led perspectives.</h1>
            <p class="inner-hero__lede">
                Explore practical analysis, strategic thinking, and published viewpoints from the team.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($articles as $article)
                    <article class="card-panel case-study-card">
                        @if($article->featuredImageUrl())
                            <a href="{{ route('articles.show', $article->slug) }}" class="case-study-card__image">
                                <img src="{{ $article->featuredImageUrl() }}" alt="{{ $article->title }}">
                            </a>
                        @endif
                        <p class="meta-chip">Article</p>
                        <h3><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></h3>
                        <!-- <p style="margin-top: 0.8rem;">
                            {{ $article->excerpt ?: \App\Support\BlockContent::summary($article->content) }}
                        </p> -->
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published articles found.</p>
                @endforelse
            </div>

            <div class="blog-pagination">
                {{ $articles->onEachSide(1)->links('blog.partials.pagination', ['label' => 'Articles pagination']) }}
            </div>
        </div>
    </section>
@endsection
