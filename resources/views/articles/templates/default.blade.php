@extends('layouts.app')

@section('content')
    @php($tocItems = \App\Support\BlockContent::tableOfContents($article->content, ['h2', 'h3']))
    <article class="article-shell">
        <div class="site-shell">
            <div class="article-frame article-detail">
                <section class="article-detail__intro">
                    <div class="article-detail__intro-copy">
                        <a href="{{ route('articles.index') }}" class="article-back">&larr; Back to Articles</a>
                        <p class="meta-chip" style="margin-top: 1rem;">Article</p>
                        <h1 class="article-title">{{ $article->title }}</h1>
                        @if($article->excerpt)
                            <p class="article-excerpt">{{ $article->excerpt }}</p>
                        @endif
                    </div>
                    @if($article->featuredImageUrl())
                        <div class="article-detail__hero d-none">
                            <img src="{{ $article->featuredImageUrl() }}" alt="{{ $article->title }}">
                        </div>
                    @endif
                </section>

                @php($hasSidebarContent = filled($article->summary) || $tocItems !== [])
                <section @class(['article-detail__body', 'article-detail__body--full' => ! $hasSidebarContent])>
                    @if($hasSidebarContent)
                        <aside class="article-detail__sidebar">
                            @if($tocItems !== [])
                                <section class="article-detail__panel article-detail__panel--toc" data-article-toc-root>
                                    <h2>Table of Contents</h2>
                                    @php($h2Index = 0)
                                    @php($h3Index = 0)
                                    <ol class="article-detail__toc" data-article-toc-list>
                                        @foreach($tocItems as $item)
                                            @php($isSubheading = $item['level'] === 'h3')
                                            @php($number = $isSubheading ? (($h2Index > 0 ? $h2Index : 0).'.'.($h3Index + 1)) : (string) ($h2Index + 1))
                                            @php($h2Index = $isSubheading ? $h2Index : $h2Index + 1)
                                            @php($h3Index = $isSubheading ? $h3Index + 1 : 0)
                                            <li>
                                                <a
                                                    href="#{{ $item['id'] }}"
                                                    class="article-detail__toc-link"
                                                    data-toc-link
                                                    data-target-id="{{ $item['id'] }}"
                                                    data-level="{{ $item['level'] }}"
                                                >
                                                    <span class="article-detail__toc-number">{{ $number }}</span>
                                                    {{ $item['text'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ol>
                                </section>
                            @endif

                            @if($article->summary)
                                <section class="article-detail__panel">
                                    <h2>Summary</h2>
                                    <div class="article-detail__summary">
                                        {!! nl2br(e($article->summary)) !!}
                                    </div>
                                </section>
                            @endif
                        </aside>
                    @endif

                    <div class="article-detail__content" data-article-content>
                        <div class="blog-share">
                            <span>Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" aria-label="Share on X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                            <a href="mailto:?subject={{ rawurlencode($article->title) }}&body={{ rawurlencode(request()->fullUrl()) }}" aria-label="Share by email"><i class="fa-regular fa-envelope" aria-hidden="true"></i></a>
                        </div>

                        <x-content-blocks :blocks="$article->content" :model="$article" class="article-body" />
                    </div>
                </section>
            </div>
        </div>
    </article>
@endsection
