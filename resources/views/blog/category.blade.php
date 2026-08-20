@extends('layouts.app')

@section('content')
    <section class="blog-hero">
        <div class="site-shell blog-hero__inner">
            <h1>{{ $category->name }}</h1>
        </div>
    </section>

    <section class="blog-page blog-page--category">
        <div class="site-shell">
            @include('blog.partials.breadcrumb', [
                'items' => [
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Blog', 'url' => route('blog.index')],
                    ['label' => $category->name, 'url' => route('blog.category', $category->slug)],
                ],
            ])

            <div class="blog-post-grid">
                @forelse($blogs as $blog)
                    @include('blog.partials.post-card', ['post' => $blog])
                @empty
                    <p class="blog-empty">No blog posts are available in this category yet.</p>
                @endforelse
            </div>

            <div class="blog-pagination">
                {{ $blogs->onEachSide(1)->links('blog.partials.pagination') }}
            </div>
        </div>
    </section>
@endsection
