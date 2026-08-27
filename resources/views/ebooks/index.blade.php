@extends('layouts.app')

@section('content')
    <section class="inner-hero">
        <div class="site-shell inner-hero__inner">
            <p class="inner-hero__eyebrow">eBooks</p>
            <h1>Downloadable guides built for migration and delivery teams.</h1>
            <p class="inner-hero__lede">
                Practical playbooks, checklists, and planning resources that support technical evaluation, delivery planning, and lead capture.
            </p>
        </div>
    </section>

    <section class="section-block">
        <div class="site-shell">
            <div class="listing-grid">
                @forelse($ebooks as $ebook)
                    <article class="card-panel case-study-card">
                        @if($ebook->featuredImageUrl())
                            <a href="{{ route('ebooks.show', $ebook->slug) }}" class="case-study-card__image">
                                <img src="{{ $ebook->featuredImageUrl() }}" alt="{{ $ebook->title }}">
                            </a>
                        @endif
                        <p class="meta-chip">eBook</p>
                        <h3><a href="{{ route('ebooks.show', $ebook->slug) }}">{{ $ebook->title }}</a></h3>
                        <p style="margin-top: 0.8rem;">{{ $ebook->excerpt ?: \App\Support\BlockContent::summary($ebook->content) }}</p>
                    </article>
                @empty
                    <p class="card-panel" style="grid-column: 1 / -1;">No published eBooks found.</p>
                @endforelse
            </div>

            <div class="blog-pagination">
                {{ $ebooks->onEachSide(1)->links('blog.partials.pagination', ['label' => 'eBooks pagination']) }}
            </div>
        </div>
    </section>
@endsection
