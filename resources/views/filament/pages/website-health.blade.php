<x-filament-panels::page>
    <div class="ibn-health-monitor">
        <section class="ibn-widget-card ibn-health-monitor__status">
            <div class="ibn-widget-card__header ibn-health-monitor__status-header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Overall</p>
                    <h3>{{ $latest ? 'Latest snapshot' : 'No snapshot yet' }}</h3>
                </div>

                <div class="ibn-health-monitor__status-meta">
                    @if ($latest)
                        <span class="ibn-status-pill ibn-status-pill--{{ str_replace('_', '-', $latest->overall) }}">
                            {{ \App\Filament\Pages\WebsiteHealth::statusLabel($latest->overall) }}
                        </span>
                        @if ($checkedAtLabel)
                            <p>Last checked {{ $checkedAtLabel }}</p>
                        @endif
                    @else
                        <span class="ibn-status-pill ibn-status-pill--unknown">Not checked</span>
                    @endif
                </div>
            </div>

            @if (! $latest)
                <p class="ibn-empty-inline">Not checked yet. Run a check to record the first snapshot.</p>
            @elseif ($stale)
                <p class="ibn-health-monitor__notice ibn-health-monitor__notice--warning">This result is more than 15 minutes old.</p>
            @endif
        </section>

        @if ($latest)
            <div class="ibn-health-monitor__checks">
                @foreach ($latest->checks as $check)
                    <article class="ibn-widget-card ibn-health-monitor__check ibn-health-monitor__check--{{ str_replace('_', '-', $check['status'] ?? 'unknown') }}" wire:key="health-check-{{ $check['name'] ?? $loop->index }}">
                        <div class="ibn-health-monitor__check-header">
                            <h3>{{ $check['label'] ?? 'Check' }}</h3>
                            <span class="ibn-status-pill ibn-status-pill--{{ str_replace('_', '-', $check['status'] ?? 'unknown') }}">
                                {{ \App\Filament\Pages\WebsiteHealth::statusLabel((string) ($check['status'] ?? 'unknown')) }}
                            </span>
                        </div>
                        <p>{{ $check['summary'] ?? '' }}</p>
                        @if (isset($check['response_time_ms']))
                            <p class="ibn-health-monitor__meta">Response time {{ number_format((int) $check['response_time_ms']) }} ms</p>
                        @endif
                        @if (! empty($check['recent']) && is_array($check['recent']))
                            <ul class="ibn-health-monitor__errors">
                                @foreach ($check['recent'] as $error)
                                    <li>{{ $error['level'] ?? 'ERROR' }} · {{ $error['time'] ?? '' }} · {{ $error['message'] ?? '' }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if (isset($links[$check['name'] ?? '']))
                            <a class="ibn-health-monitor__link" href="{{ $links[$check['name']] }}">{{ $linkLabels[$check['name']] }}</a>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif

        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">History</p>
                    <h3>Previous checks</h3>
                </div>
            </div>

            <div class="mt-4 overflow-x-auto">
                @if ($history->isEmpty())
                    <p class="ibn-empty-inline">No health checks have been recorded.</p>
                @else
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Checked</th>
                                <th class="px-4 py-3">Trigger</th>
                                <th class="px-4 py-3">Overall</th>
                                <th class="px-4 py-3">Warnings and failures</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $run)
                                <tr class="border-t border-gray-200/70 dark:border-gray-700/70" wire:key="health-run-{{ $run->id }}">
                                    <td class="px-4 py-3">{{ $run->checked_at?->timezone((string) config('app.timezone'))->format('M j, Y g:i A') }}</td>
                                    <td class="px-4 py-3">{{ $run->trigger === 'manual' ? 'Manual' : 'Scheduled' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="ibn-status-pill ibn-status-pill--{{ str_replace('_', '-', $run->overall) }}">
                                            {{ \App\Filament\Pages\WebsiteHealth::statusLabel($run->overall) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">{{ \App\Filament\Pages\WebsiteHealth::attentionSummary($run->checks ?? []) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>
    </div>
</x-filament-panels::page>
