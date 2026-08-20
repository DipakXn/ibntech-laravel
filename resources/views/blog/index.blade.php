@extends('layouts.app')

@section('content')
    <section class="blog-hero">
        <div class="site-shell blog-hero__inner">
            <h1>Blog</h1>
        </div>
    </section>

    <section class="blog-page">
        <div class="site-shell">
            @include('blog.partials.breadcrumb', [
                'items' => [
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Blog', 'url' => route('blog.index')],
                ],
            ])

            <div class="blog-layout">
                <div class="blog-main">
                    @if($search)
                        <div class="blog-section-heading">
                            <p>Search results for</p>
                            <h2>{{ $search }}</h2>
                        </div>

                        <div class="blog-category-grid blog-category-grid--posts">
                            @forelse($blogs as $blog)
                                @include('blog.partials.post-card', ['post' => $blog])
                            @empty
                                <p class="blog-empty">No blog posts matched your search.</p>
                            @endforelse
                        </div>

                        <div class="blog-pagination">{{ $blogs->links() }}</div>
                    @else
                        <div class="blog-category-grid">
                            @forelse($categories as $blogCategory)
                                @php
                                    $coverPost = $blogCategory->blogs->first() ?? null;
                                @endphp

                                <article class="blog-category-card">
                                    <a class="blog-category-card__image" href="{{ route('blog.category', $blogCategory->slug) }}" aria-label="View {{ $blogCategory->name }} blogs">
                                        @if($coverPost)
                                            @include('blog.partials.image', ['post' => $coverPost])
                                        @else
                                            <div class="blog-image-placeholder" aria-hidden="true"><span>{{ $blogCategory->name }}</span></div>
                                        @endif
                                        <span>{{ $blogCategory->blogs_count }} {{ \Illuminate\Support\Str::plural('Blog', $blogCategory->blogs_count) }}</span>
                                    </a>
                                    <div class="blog-category-card__body">
                                        <h2>{{ $blogCategory->name }}</h2>
                                        <a href="{{ route('blog.category', $blogCategory->slug) }}">View Blogs <i class="fa-solid fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </article>
                            @empty
                                <p class="blog-empty">No blog categories are available yet.</p>
                            @endforelse
                        </div>
                    @endif
                </div>

                @include('blog.partials.sidebar', ['latestPosts' => $latestPosts, 'search' => $search])
            </div>
        </div>
    </section>
@endsection
