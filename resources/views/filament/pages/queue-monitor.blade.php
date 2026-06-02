<x-filament-panels::page>
    <div class="ibn-metric-grid">
        <article class="ibn-metric-card">
            <span>Total queued jobs</span>
            <strong>{{ number_format($totalQueuedJobs) }}</strong>
            <p>Across all rows currently in the database queue table.</p>
        </article>

        <article class="ibn-metric-card">
            <span>Pending jobs</span>
            <strong>{{ number_format($totalPendingJobs) }}</strong>
            <p>Jobs waiting to be reserved by a worker.</p>
        </article>

        <article class="ibn-metric-card">
            <span>Reserved jobs</span>
            <strong>{{ number_format($totalReservedJobs) }}</strong>
            <p>Jobs currently reserved by active workers.</p>
        </article>

        <article class="ibn-metric-card">
            <span>Failed jobs</span>
            <strong>{{ number_format($failedJobsCount) }}</strong>
            <p>{{ number_format($failedJobsLastDay) }} failed in the last 24 hours.</p>
        </article>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1.3fr,0.7fr]">
        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Database queues</p>
                    <h3>Backlog by queue</h3>
                </div>
            </div>

            <div class="mt-4 overflow-x-auto">
                @if (! $jobsTableExists)
                    <p class="ibn-empty-inline">The `jobs` table is not available yet. Run the queue migrations before using database-backed queues.</p>
                @elseif ($queues->isEmpty())
                    <p class="ibn-empty-inline">No queued jobs are waiting in the database right now.</p>
                @else
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Queue</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Pending</th>
                                <th class="px-4 py-3">Reserved</th>
                                <th class="px-4 py-3">Oldest job</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queues as $queue)
                                <tr class="border-t border-gray-200/70 dark:border-gray-700/70">
                                    <td class="px-4 py-3 font-semibold">{{ $queue['name'] }}</td>
                                    <td class="px-4 py-3">{{ number_format($queue['total_jobs']) }}</td>
                                    <td class="px-4 py-3">{{ number_format($queue['pending_jobs']) }}</td>
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

            <div class="ibn-metric-grid">
                <article class="ibn-metric-card">
                    <span>Connection</span>
                    <strong>{{ $monitorConnection }}</strong>
                    <p>The queue connection watched by the scheduler.</p>
                </article>

                <article class="ibn-metric-card">
                    <span>Queue name</span>
                    <strong>{{ $monitorQueue }}</strong>
                    <p>The queue segment monitored every minute.</p>
                </article>

                <article class="ibn-metric-card">
                    <span>Busy threshold</span>
                    <strong>{{ number_format($monitorThreshold) }}</strong>
                    <p>A warning is logged when queued jobs reach or exceed this count.</p>
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
            @if (! $failedJobsTableExists)
                <p class="ibn-empty-inline">The `failed_jobs` table is not available yet. Run the queue migrations before relying on failed job persistence.</p>
            @elseif ($failedJobs->isEmpty())
                <p class="ibn-empty-inline">No failed jobs have been recorded.</p>
            @else
                <table class="min-w-full text-sm">
                    <thead class="text-left text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Queue</th>
                            <th class="px-4 py-3">Connection</th>
                            <th class="px-4 py-3">Exception</th>
                            <th class="px-4 py-3">Failed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($failedJobs as $job)
                            <tr class="border-t border-gray-200/70 align-top dark:border-gray-700/70">
                                <td class="px-4 py-3 font-semibold">{{ $job['queue'] }}</td>
                                <td class="px-4 py-3">{{ $job['connection'] }}</td>
                                <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($job['exception'], 140) }}</td>
                                <td class="px-4 py-3">{{ $job['failed_at'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
</x-filament-panels::page>
