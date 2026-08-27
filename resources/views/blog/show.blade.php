@extends('layouts.app')

@section('content')
    <article class="py-16">
        <div class="mx-auto max-w-4xl px-4">
            <a href="{{ route('blog.index') }}" class="text-sm font-medium text-amber-700">&larr; Back to Blog</a>
            <h1 class="mt-4 text-4xl font-bold">{{ $blog->title }}</h1>
            <p class="mt-3 text-sm text-slate-500">
                {{ $blog->category?->name ?? 'General' }} | {{ $blog->publishedAt()?->format('M d, Y') }}
            </p>
            <div class="prose prose-slate mt-8 max-w-none rounded-xl bg-white p-8">
                <x-content-blocks :blocks="$blog->content" :model="$blog" class="article-body" />
            </div>
        </div>
    </article>
@endsection
