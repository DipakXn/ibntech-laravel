@props([
    'title' => 'Start Your Migration Project',
    'description' => 'Share your current stack and goals. We will send a practical migration plan.',
])

<section class="bg-amber-400 py-16 text-slate-900">
    <div class="mx-auto max-w-6xl px-4">
        <h2 class="text-3xl font-bold">{{ $title }}</h2>
        <p class="mt-3 max-w-2xl">{{ $description }}</p>
        <div class="mt-8 max-w-lg rounded-xl bg-white p-5 shadow-sm">
            <livewire:forms.lead-form />
        </div>
    </div>
</section>

