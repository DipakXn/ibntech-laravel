<x-filament-panels::page>
    <div class="ibn-log-viewer">
        <aside class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Local files</p>
                    <h3>storage/logs</h3>
                </div>
            </div>

            <div class="ibn-log-viewer__file-filters">
                <label class="ibn-log-viewer__field ibn-log-viewer__field--name">
                    <span>File name</span>
                    <input
                        type="search"
                        wire:model.live.debounce.400ms="fileQuery"
                        placeholder="Filter files"
                        autocomplete="off"
                    >
                </label>
                <label class="ibn-log-viewer__field">
                    <span>From</span>
                    <input type="date" wire:model.live="dateFrom">
                </label>
                <label class="ibn-log-viewer__field">
                    <span>To</span>
                    <input type="date" wire:model.live="dateTo">
                </label>
            </div>

            <div class="ibn-activity-list ibn-log-viewer__file-list">
                @forelse ($files as $file)
                    <button
                        type="button"
                        wire:click="selectFile('{{ $file['name'] }}')"
                        wire:key="log-file-{{ $file['name'] }}"
                        class="ibn-quick-action ibn-log-viewer__file-card w-full text-left {{ $selectedFileDetails && $selectedFileDetails['name'] === $file['name'] ? 'is-selected' : '' }}"
                    >
                        <strong>{{ $file['name'] }}</strong>
                        <span>{{ $file['size'] }} · {{ $file['date'] ?? 'unknown date' }} · updated {{ $file['modified_at'] }}</span>
                    </button>
                @empty
                    <p class="ibn-empty-inline">No `.log` files matched the current file filters.</p>
                @endforelse
            </div>
        </aside>

        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header ibn-log-viewer__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">{{ $viewMode === 'raw' ? 'Raw log' : 'Parsed entries' }}</p>
                    <h3>{{ $selectedFileDetails['name'] ?? 'No log selected' }}</h3>
                </div>

                <div class="ibn-log-viewer__mode-switch" role="group" aria-label="Log view mode">
                    <button
                        type="button"
                        wire:click="setViewMode('parsed')"
                        class="{{ $viewMode === 'parsed' ? 'is-active' : '' }}"
                    >
                        Parsed
                    </button>
                    <button
                        type="button"
                        wire:click="setViewMode('raw')"
                        class="{{ $viewMode === 'raw' ? 'is-active' : '' }}"
                    >
                        Raw log
                    </button>
                </div>
            </div>

            @if ($selectedFileDetails && $stats)
                <div class="ibn-metric-grid ibn-log-viewer__stats">
                    <article class="ibn-metric-card">
                        <span>Total entries</span>
                        <strong>{{ number_format($stats['total_entries']) }}</strong>
                        <p>{{ $selectedFileDetails['size'] }}{{ $stats['truncated'] ? ' · scanned latest '.$stats['scanned_size'] : '' }}</p>
                    </article>
                    <article class="ibn-metric-card">
                        <span>Errors</span>
                        <strong>{{ number_format($stats['level_counts']['ERROR'] + $stats['level_counts']['CRITICAL'] + $stats['level_counts']['ALERT'] + $stats['level_counts']['EMERGENCY']) }}</strong>
                        <p>Emergency, alert, critical, error</p>
                    </article>
                    <article class="ibn-metric-card">
                        <span>Warnings</span>
                        <strong>{{ number_format($stats['level_counts']['WARNING']) }}</strong>
                        <p>{{ number_format($stats['level_counts']['NOTICE'] + $stats['level_counts']['INFO'] + $stats['level_counts']['DEBUG']) }} notice / info / debug</p>
                    </article>
                    <article class="ibn-metric-card">
                        <span>Matching</span>
                        <strong>{{ number_format($stats['matched_count']) }}</strong>
                        <p>
                            @if ($stats['matched_count'] > $stats['kept_count'])
                                Showing the newest {{ number_format($stats['kept_count']) }} matches
                            @else
                                After search and level filters
                            @endif
                        </p>
                    </article>
                </div>

                <div class="ibn-log-viewer__level-counts" aria-label="Counts by log level">
                    @foreach ($levels as $level)
                        <span class="ibn-log-level ibn-log-level--{{ strtolower($level) }}">
                            {{ ucfirst(strtolower($level)) }}
                            <em>{{ number_format($stats['level_counts'][$level] ?? 0) }}</em>
                        </span>
                    @endforeach
                </div>

                @if ($stats['truncated'])
                    <p class="ibn-log-viewer__notice">
                        This file is large, so only the latest {{ $stats['scanned_size'] }} were scanned. The original file on disk was not changed.
                    </p>
                @endif

                <div class="ibn-log-viewer__toolbar">
                    <label class="ibn-log-viewer__field ibn-log-viewer__field--grow">
                        <span>Search this file</span>
                        <input
                            type="search"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Message, exception, URL, class…"
                            autocomplete="off"
                        >
                    </label>

                    <button type="button" class="ibn-log-viewer__clear" wire:click="clearFilters">
                        Clear filters
                    </button>
                </div>

                <div class="ibn-log-viewer__levels" role="group" aria-label="Filter by log level">
                    @foreach ($levels as $level)
                        <button
                            type="button"
                            wire:click="toggleLevel('{{ $level }}')"
                            class="ibn-log-level ibn-log-level--{{ strtolower($level) }} {{ in_array($level, $activeLevels, true) ? 'is-active' : '' }}"
                        >
                            {{ ucfirst(strtolower($level)) }}
                        </button>
                    @endforeach
                </div>

                @if ($viewMode === 'raw')
                    <p class="ibn-log-viewer__raw-note">
                        Showing the last {{ number_format($lineLimit) }} lines from {{ $selectedFileDetails['name'] }}.
                    </p>

                    <pre class="ibn-log-viewer__raw">{{ $rawPreview }}</pre>
                @else
                    <div class="ibn-log-viewer__entries">
                        @forelse ($entries as $index => $entry)
                            <article class="ibn-log-entry ibn-log-entry--{{ strtolower($entry->level) }}" wire:key="log-entry-{{ $page }}-{{ $index }}-{{ $entry->timestamp }}">
                                <header>
                                    <time datetime="{{ $entry->timestamp }}">{{ $entry->timestamp }}</time>
                                    <span class="ibn-log-level ibn-log-level--{{ strtolower($entry->level) }} is-active">
                                        {{ ucfirst(strtolower($entry->level)) }}
                                    </span>
                                    @if ($entry->environment)
                                        <span class="ibn-log-entry__env">{{ $entry->environment }}</span>
                                    @endif
                                </header>
                                <p class="ibn-log-entry__message">{{ $entry->message }}</p>
                                @if ($entry->hasContext())
                                    <details class="ibn-log-entry__trace">
                                        <summary>Stack trace / context</summary>
                                        <pre>{{ $entry->context() }}</pre>
                                    </details>
                                @endif
                            </article>
                        @empty
                            <p class="ibn-empty-inline">No log entries matched the current search and level filters.</p>
                        @endforelse
                    </div>

                    @if ($lastPage > 1)
                        <nav class="ibn-log-viewer__pagination" aria-label="Log entries">
                            <button type="button" wire:click="previousPage" @disabled($page <= 1)>Previous</button>
                            <span>Page {{ number_format($page) }} of {{ number_format($lastPage) }}</span>
                            <button type="button" wire:click="nextPage" @disabled($page >= $lastPage)>Next</button>
                        </nav>
                    @endif
                @endif
            @else
                <p class="ibn-empty-inline">A log preview will appear here once a file is available.</p>
            @endif
        </section>
    </div>
</x-filament-panels::page>
