@extends('layouts.app')

@section('content')
    <article class="article-shell">
        <div class="site-shell">
            <div class="article-frame white-paper-detail">
                <section class="white-paper-detail__intro">
                    <div class="white-paper-detail__intro-copy">
                        <a href="{{ route('white-papers.index') }}" class="article-back">&larr; Back to White Papers</a>
                        <p class="meta-chip" style="margin-top: 1rem;">White Paper</p>
                        <h1 class="article-title">{{ $whitePaper->title }}</h1>
                        @if($whitePaper->excerpt)
                            <p class="article-excerpt">{{ $whitePaper->excerpt }}</p>
                        @endif
                    </div>
                    @if($whitePaper->featuredImageUrl())
                        <div class="white-paper-detail__hero">
                            <img src="{{ $whitePaper->featuredImageUrl() }}" alt="{{ $whitePaper->title }}">
                        </div>
                    @endif
                </section>

                <section class="white-paper-detail__body">
                    <div class="white-paper-detail__content">
                        <div class="blog-share">
                            <span>Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($whitePaper->title) }}" aria-label="Share on X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="mailto:?subject={{ rawurlencode($whitePaper->title) }}&body={{ rawurlencode(request()->fullUrl()) }}" aria-label="Share by email"><i class="fa-regular fa-envelope" aria-hidden="true"></i></a>
                        </div>

                        <x-content-blocks :blocks="$whitePaper->content" :model="$whitePaper" class="article-body" />
                    </div>
                </section>
            </div>
        </div>
    </article>
@endsection
