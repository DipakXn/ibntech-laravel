@props([
    'title' => 'Modern Corporate CMS on Laravel',
    'subtitle' => 'Migration-ready architecture using Blade templates, services, repositories, and admin tooling.',
    'primaryAction' => route('page.show', ['slug' => 'contact']),
    'secondaryAction' => route('blog.index'),
])

<section class="bg-slate-900 py-20 text-white">
    <div class="mx-auto max-w-6xl px-4">
        <h1 class="max-w-3xl text-4xl font-bold leading-tight md:text-5xl">{{ $title }}</h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-300">{{ $subtitle }}</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ $primaryAction }}" class="rounded-md bg-amber-400 px-6 py-3 font-semibold text-slate-900">Talk to Us</a>
            <a href="{{ $secondaryAction }}" class="rounded-md border border-slate-600 px-6 py-3 font-semibold">Read Blog</a>
        </div>
    </div>
</section>
