@extends('layouts.app')

@section('content')
    <x-content-additional-assets :model="$pressRelease" />
    <article class="article-shell">
        <div class="site-shell">
            <div class="article-frame press-release-detail">
                <section class="press-release-detail__intro">
                    <div class="press-release-detail__intro-copy">
                        <a href="{{ route('pressrelease.index') }}" class="article-back">&larr; Back to Press Releases</a>
                        <p class="meta-chip" style="margin-top: 1rem;">Press Release</p>
                        <h1 class="article-title">{{ $pressRelease->title }}</h1>
                        @if($pressRelease->excerpt)
                            <p class="article-excerpt">{{ $pressRelease->excerpt }}</p>
                        @endif
                    </div>
                    @if($pressRelease->featuredImageUrl())
                        <div class="press-release-detail__hero">
                            <img src="{{ $pressRelease->featuredImageUrl() }}" alt="{{ $pressRelease->title }}">
                        </div>
                    @endif
                </section>

                <section class="press-release-detail__body">
                    <div class="press-release-detail__content">
                        <div class="blog-share">
                            <span>Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($pressRelease->title) }}" aria-label="Share on X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="mailto:?subject={{ rawurlencode($pressRelease->title) }}&body={{ rawurlencode(request()->fullUrl()) }}" aria-label="Share by email"><i class="fa-regular fa-envelope" aria-hidden="true"></i></a>
                        </div>

                        <x-content-blocks :blocks="$pressRelease->content" :model="$pressRelease" class="article-body" />
                    </div>
                </section>
            </div>
        </div>
    </article>
@endsection
