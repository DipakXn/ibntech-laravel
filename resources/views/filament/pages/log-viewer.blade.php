<x-filament-panels::page>
    <div class="grid gap-6 lg:grid-cols-[20rem,1fr]">
        <aside class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Local files</p>
                    <h3>storage/logs</h3>
                </div>
            </div>

            <div class="ibn-activity-list">
                @forelse ($files as $file)
                    <button
                        type="button"
                        wire:click="selectFile('{{ $file['name'] }}')"
                        class="ibn-quick-action w-full text-left {{ $selectedFileDetails && $selectedFileDetails['name'] === $file['name'] ? 'ring-2 ring-[color:var(--ibn-primary)]' : '' }}"
                    >
                        <strong>{{ $file['name'] }}</strong>
                        <span>{{ $file['size'] }} · updated {{ $file['modified_at'] }}</span>
                    </button>
                @empty
                    <p class="ibn-empty-inline">No `.log` files were found in `storage/logs`.</p>
                @endforelse
            </div>
        </aside>

        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Preview</p>
                    <h3>{{ $selectedFileDetails['name'] ?? 'No log selected' }}</h3>
                </div>
            </div>

            @if ($selectedFileDetails)
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    Showing the last {{ number_format($lineLimit) }} lines from {{ $selectedFileDetails['name'] }}.
                </p>

                <pre class="mt-4 overflow-x-auto rounded-2xl border border-gray-200/80 bg-slate-950 p-4 text-xs leading-6 text-slate-100 dark:border-gray-700/80">{{ $logPreview }}</pre>
            @else
                <p class="ibn-empty-inline mt-4">A log preview will appear here once a file is available.</p>
            @endif
        </section>
    </div>
</x-filament-panels::page>
