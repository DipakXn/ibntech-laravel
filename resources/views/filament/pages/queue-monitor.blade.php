<x-filament-panels::page>
    <div class="ibn-queue-monitor">
        <section class="ibn-widget-card ibn-queue-monitor__status">
            <div class="ibn-widget-card__header ibn-queue-monitor__status-header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Queue health</p>
                    <h3>Scheduled busy check</h3>
                </div>

                <div class="ibn-queue-monitor__status-meta">
                    <span class="ibn-status-pill ibn-status-pill--{{ $health }}">
                        {{ $health === 'busy' ? 'Busy' : ($health === 'unavailable' ? 'Unavailable' : 'Healthy') }}
                    </span>
                    @if ($lastUpdatedLabel)
                        <p>Last updated {{ $lastUpdatedLabel }}</p>
                    @endif
                </div>
            </div>

            <p class="ibn-queue-monitor__status-copy">
                Health matches Laravel’s `queue:monitor` check: total jobs on
                <strong>{{ $connection }}:{{ $monitor_queue }}</strong>
                versus the busy threshold of {{ number_format($threshold) }}.
                Media conversions use a separate <strong>{{ $media_queue }}</strong> lane and are not part of that scheduled check.
            </p>

            @if ($health === 'busy')
                <p class="ibn-queue-monitor__notice ibn-queue-monitor__notice--warning">
                    The monitored <strong>{{ $monitor_queue }}</strong> queue has reached or exceeded the busy threshold.
                </p>
            @elseif ($unmonitored_busy)
                <p class="ibn-queue-monitor__notice ibn-queue-monitor__notice--warning">
                    The scheduler only watches <strong>{{ $monitor_queue }}</strong>. Another queue currently exceeds the busy threshold.
                </p>
            @endif
        </section>

        <div class="ibn-metric-grid">
            <article class="ibn-metric-card {{ $total_queued_jobs >= $threshold ? 'ibn-metric-card--warning' : '' }}">
                <span>Total queued jobs</span>
                <strong>{{ number_format($total_queued_jobs) }}</strong>
                <p>All rows currently in the database queue table.</p>
            </article>

            <article class="ibn-metric-card {{ $pending_over_threshold ? 'ibn-metric-card--warning' : '' }}">
                <span>Pending jobs</span>
                <strong>{{ number_format($total_pending_jobs) }}</strong>
                <p>Jobs ready for a worker. Delayed jobs are counted separately in the backlog table.</p>
            </article>

            <article class="ibn-metric-card">
                <span>Reserved jobs</span>
                <strong>{{ number_format($total_reserved_jobs) }}</strong>
                <p>Jobs currently reserved by active workers.</p>
            </article>

            <article class="ibn-metric-card">
                <span>Failed jobs</span>
                <strong>{{ number_format($failed_jobs_count) }}</strong>
                <p>{{ number_format($failed_jobs_last_day) }} failed in the last 24 hours.</p>
            </article>
        </div>

        <div class="ibn-queue-monitor__layout">
            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Database queues</p>
                        <h3>Backlog by queue</h3>
                    </div>
                </div>

                <div class="mt-4 overflow-x-auto">
                    @if (! $jobs_table_exists)
                        <p class="ibn-empty-inline">The `jobs` table is not available yet. Run the queue migrations before using database-backed queues.</p>
                    @else
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-gray-500">
                                <tr>
                                    <th class="px-4 py-3">Queue</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Pending</th>
                                    <th class="px-4 py-3">Delayed</th>
                                    <th class="px-4 py-3">Reserved</th>
                                    <th class="px-4 py-3">Oldest pending</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($queues as $queue)
                                    <tr class="border-t border-gray-200/70 dark:border-gray-700/70 {{ $queue['over_threshold'] ? 'is-over-threshold' : '' }}">
                                        <td class="px-4 py-3 font-semibold">
                                            {{ $queue['name'] }}
                                            @if ($queue['is_monitored'])
                                                <span class="ibn-status-pill ibn-status-pill--healthy">Monitored</span>
                                            @endif
                                            @if ($queue['is_media'] && ! $queue['is_monitored'])
                                                <span class="ibn-status-pill ibn-status-pill--draft">Media conversions</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">{{ number_format($queue['total_jobs']) }}</td>
                                        <td class="px-4 py-3">{{ number_format($queue['pending_jobs']) }}</td>
                                        <td class="px-4 py-3">{{ number_format($queue['delayed_jobs']) }}</td>
                                        <td class="px-4 py-3">{{ number_format($queue['reserved_jobs']) }}</td>
                                        <td class="px-4 py-3">{{ $queue['oldest_job'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </section>

            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Monitor config</p>
                        <h3>Scheduled queue check</h3>
                    </div>
                </div>

                <div class="ibn-metric-grid ibn-queue-monitor__config">
                    <article class="ibn-metric-card">
                        <span>Connection</span>
                        <strong>{{ $connection }}</strong>
                        <p>Queue connection used by the application and watched by the scheduler when it is `database`.</p>
                    </article>

                    <article class="ibn-metric-card">
                        <span>Monitored queue</span>
                        <strong>{{ $monitor_queue }}</strong>
                        <p>Checked every minute by `queue:monitor`. Mail and notification jobs use this lane.</p>
                    </article>

                    <article class="ibn-metric-card">
                        <span>Media queue</span>
                        <strong>{{ $media_queue }}</strong>
                        <p>Spatie image conversions. Processed by workers (`media` then `default`), not by the scheduled busy check.</p>
                    </article>

                    <article class="ibn-metric-card {{ $health === 'busy' ? 'ibn-metric-card--warning' : '' }}">
                        <span>Busy threshold</span>
                        <strong>{{ number_format($threshold) }}</strong>
                        <p>A warning is logged when the monitored queue’s total jobs reach this count.</p>
                    </article>
                </div>
            </section>
        </div>

        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Failures</p>
                    <h3>Recent failed jobs</h3>
                </div>
            </div>

            <div class="mt-4 overflow-x-auto">
                @if (! $failed_jobs_table_exists)
                    <p class="ibn-empty-inline">The `failed_jobs` table is not available yet. Run the queue migrations before relying on failed job persistence.</p>
                @elseif ($failed_jobs->isEmpty())
                    <p class="ibn-empty-inline">No failed jobs have been recorded.</p>
                @else
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Job</th>
                                <th class="px-4 py-3">Queue</th>
                                <th class="px-4 py-3">Exception</th>
                                <th class="px-4 py-3">Failed</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($failed_jobs as $job)
                                <tr class="border-t border-gray-200/70 align-top dark:border-gray-700/70" wire:key="failed-job-{{ $job['uuid'] }}">
                                    <td class="px-4 py-3 font-semibold">
                                        {{ $job['job_name'] }}
                                        <span class="ibn-queue-monitor__muted">{{ $job['connection'] }}</span>
                                    </td>
                                    <td class="px-4 py-3">{{ $job['queue'] }}</td>
                                    <td class="px-4 py-3">
                                        <p>{{ $job['exception_preview'] }}</p>
                                        <button
                                            type="button"
                                            class="ibn-queue-monitor__text-action"
                                            wire:click="toggleFailedJobException({{ \Illuminate\Support\Js::from($job['uuid']) }})"
                                        >
                                            {{ $expandedFailedJobUuid === $job['uuid'] ? 'Hide exception' : 'Show exception' }}
                                        </button>
                                        @if ($expandedFailedJobUuid === $job['uuid'] && $expandedException)
                                            <pre class="ibn-queue-monitor__exception">{{ $expandedException }}</pre>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $job['failed_at'] }}</td>
                                    <td class="px-4 py-3">
                                        <button
                                            type="button"
                                            class="ibn-queue-monitor__text-action"
                                            wire:click="mountAction('retryFailedJob', { uuid: {{ \Illuminate\Support\Js::from($job['uuid']) }} })"
                                        >
                                            Retry
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>
    </div>
</x-filament-panels::page>
