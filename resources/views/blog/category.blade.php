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
                'items' => array_values(array_filter([
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Blog', 'url' => route('blog.index')],
                    ['label' => $category->name, 'url' => route('blog.category', $category->slug)],
                    $blogs->currentPage() > 1
                        ? ['label' => 'Page '.$blogs->currentPage(), 'url' => $blogs->url($blogs->currentPage())]
                        : null,
                ])),
            ])

            <div class="blog-post-grid">
                @forelse($blogs as $blog)
                    @include('blog.partials.post-card', ['post' => $blog])
                @empty
                    <p class="blog-empty">No blog posts are available in this category yet.</p>
                @endforelse
            </div>

            <div class="blog-pagination">
                {{ $blogs->onEachSide(1)->links('blog.partials.pagination', ['label' => 'Blog category pagination']) }}
            </div>
        </div>
    </section>
@endsection
