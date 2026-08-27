@extends('layouts.app')

@section('content')
    <x-content-additional-assets :model="$blog" />
    <article class="blog-detail">
        <div class="site-shell blog-detail__layout">
            <div class="blog-detail__main">
                @php($displayCategory = $blog->category?->root())
                @include('blog.partials.breadcrumb', [
                    'items' => array_values(array_filter([
                        ['label' => 'Home', 'url' => route('home')],
                        ['label' => 'Blog', 'url' => route('blog.index')],
                        $displayCategory
                            ? ['label' => $displayCategory->name, 'url' => route('blog.category', $displayCategory->slug)]
                            : null,
                        ['label' => $blog->title, 'url' => route('blog.show', $blog->slug)],
                    ])),
                ])

                <h1>{{ $blog->title }}</h1>

                <div class="blog-detail__meta">
                    <span><i class="fa-solid fa-tag" aria-hidden="true"></i> {{ $displayCategory?->name ?? 'General' }}</span>
                    <span><i class="fa-regular fa-user" aria-hidden="true"></i> By IBN Technologies</span>
                    <span><i class="fa-solid fa-calendar" aria-hidden="true"></i> {{ $blog->publishedAt()?->format('F d, Y') }}</span>
                    <span><i class="fa-regular fa-clock" aria-hidden="true"></i> {{ $blog->estimatedReadTime() }} min read</span>
                </div>

                <div class="blog-detail__hero-image">
                    @include('blog.partials.image', ['post' => $blog])
                </div>

                <div class="blog-share">
                    <span>Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}" aria-label="Share on X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                    <a href="mailto:?subject={{ rawurlencode($blog->title) }}&body={{ rawurlencode(request()->fullUrl()) }}" aria-label="Share by email"><i class="fa-regular fa-envelope" aria-hidden="true"></i></a>
                </div>

                <x-content-blocks :blocks="$blog->content" :model="$blog" class="blog-detail__content" />
            </div>

            <aside class="blog-detail-sidebar">
                <section class="blog-inquiry">
                    <h2>26+ Years of Expertise. 2500+ Happy Clients. Get Your Strategy Call!</h2>
                    <livewire:forms.contact-form
                        :show-company="false"
                        :message-rows="2"
                    />
                </section>

                <section class="blog-sidebar-panel blog-sidebar-panel--compact">
                    <h2>Latest Blog Posts</h2>
                    <div class="blog-detail-latest">
                        @forelse($latestPosts->take(5) as $post)
                            <a href="{{ route('blog.show', $post->slug) }}">
                                @include('blog.partials.image', ['post' => $post])
                                <span>{{ $post->title }}</span>
                            </a>
                        @empty
                            <p class="blog-sidebar-empty">No blog posts available.</p>
                        @endforelse
                    </div>
                </section>

                <section class="blog-company-card">
                    <h2>Trusted Solution Worldwide</h2>
                    <p>26+ Years | ISO Certified | 500+ Tech Clients</p>
                    <p>Cloud &amp; Security | Accounting &amp; Compliance</p>
                    <div>
                        <span>ISO 9001:2015</span>
                        <span>ISO 27001:2022</span>
                        <span>ISO 20000-1</span>
                        <span>Since 1999</span>
                    </div>
                    <a href="{{ route('case-studies.index') }}">View client success stories <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                </section>
            </aside>
        </div>
    </article>
@endsection
