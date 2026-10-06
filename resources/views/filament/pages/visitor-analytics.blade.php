<x-filament-panels::page>
    <div class="ibn-visitor-analytics">
        <section class="ibn-widget-card ibn-visitor-analytics__filters">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Date range</p>
                    <h3>{{ $range->label() }}</h3>
                </div>
            </div>

            <div class="ibn-visitor-analytics__filter-row">
                <label>
                    <span>Range</span>
                    <select wire:model.live="preset">
                        @foreach ($presets as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span>From</span>
                    <input type="date" wire:model.live="dateFrom" max="{{ now()->toDateString() }}">
                </label>
                <label>
                    <span>To</span>
                    <input type="date" wire:model.live="dateTo" max="{{ now()->toDateString() }}">
                </label>
            </div>
        </section>

        <div class="ibn-metric-grid ibn-visitor-analytics__kpis">
            <article class="ibn-metric-card">
                <span>Total Visitors</span>
                <strong>{{ number_format($kpis['total_visitors']) }}</strong>
                <p>Unique visitors, all time</p>
            </article>
            <article class="ibn-metric-card">
                <span>Visitors Today</span>
                <strong>{{ number_format($kpis['visitors_today']) }}</strong>
                <p>Unique visitors</p>
            </article>
            <article class="ibn-metric-card">
                <span>Visitors Yesterday</span>
                <strong>{{ number_format($kpis['visitors_yesterday']) }}</strong>
                <p>Unique visitors</p>
            </article>
            <article class="ibn-metric-card">
                <span>Visitors This Week</span>
                <strong>{{ number_format($kpis['visitors_this_week']) }}</strong>
                <p>Unique visitors</p>
            </article>
            <article class="ibn-metric-card">
                <span>Visitors This Month</span>
                <strong>{{ number_format($kpis['visitors_this_month']) }}</strong>
                <p>Unique visitors</p>
            </article>
            <article class="ibn-metric-card">
                <span>Total Page Views</span>
                <strong>{{ number_format($kpis['total_page_views']) }}</strong>
                <p>All tracked page views</p>
            </article>
            <article class="ibn-metric-card">
                <span>Unique Visitors</span>
                <strong>{{ number_format($kpis['unique_visitors']) }}</strong>
                <p>Selected range</p>
            </article>
            <article class="ibn-metric-card">
                <span>Page Views</span>
                <strong>{{ number_format($kpis['page_views']) }}</strong>
                <p>Selected range</p>
            </article>
        </div>

        @livewire(\App\Filament\Widgets\VisitorTrendChart::class, [
            'preset' => $preset,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ], key('visitor-trend-'.$preset.'-'.$dateFrom.'-'.$dateTo))

        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Selected range</p>
                    <h3>Top content</h3>
                </div>
            </div>

            @if ($topContent === [])
                <p class="ibn-empty-inline">No tracked content in this date range.</p>
            @else
                <div class="ibn-visitor-analytics__table-wrap">
                    <table class="ibn-analytics-table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Content Type</th>
                                <th>Title</th>
                                <th>Page Views</th>
                                <th>Unique Visitors</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topContent as $row)
                                <tr wire:key="top-{{ $row['content_type'] }}-{{ $row['rank'] }}-{{ $row['title'] }}">
                                    <td>{{ $row['rank'] }}</td>
                                    <td>{{ $row['content_label'] }}</td>
                                    <td>{{ $row['title'] }}</td>
                                    <td>{{ number_format($row['page_views']) }}</td>
                                    <td>{{ number_format($row['unique_visitors']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section class="ibn-widget-card">
            <div class="ibn-widget-card__header">
                <div>
                    <p class="ibn-widget-card__eyebrow">Selected range</p>
                    <h3>Content performance</h3>
                </div>
            </div>

            <div class="ibn-visitor-analytics__filter-row">
                <label>
                    <span>Content type</span>
                    <select wire:model.live="contentType">
                        <option value="">All types</option>
                        @foreach ($contentTypes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            @if ($content['total'] === 0)
                <p class="ibn-empty-inline">No tracked content in this date range.</p>
            @else
                <div class="ibn-visitor-analytics__table-wrap">
                    <table class="ibn-analytics-table">
                        <thead>
                            <tr>
                                <th>Content Type</th>
                                <th>Content Title</th>
                                <th>
                                    <button type="button" wire:click="sortContent('page_views')">
                                        Page Views{{ $contentSort === 'page_views' ? ($contentDirection === 'asc' ? ' ↑' : ' ↓') : '' }}
                                    </button>
                                </th>
                                <th>
                                    <button type="button" wire:click="sortContent('unique_visitors')">
                                        Unique Visitors{{ $contentSort === 'unique_visitors' ? ($contentDirection === 'asc' ? ' ↑' : ' ↓') : '' }}
                                    </button>
                                </th>
                                <th>
                                    <button type="button" wire:click="sortContent('last_viewed')">
                                        Last Viewed{{ $contentSort === 'last_viewed' ? ($contentDirection === 'asc' ? ' ↑' : ' ↓') : '' }}
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($content['rows'] as $row)
                                <tr wire:key="content-{{ $row['content_type'] }}-{{ $row['title'] }}-{{ $content['page'] }}">
                                    <td>{{ $row['content_label'] }}</td>
                                    <td>{{ $row['title'] }}</td>
                                    <td>{{ number_format($row['page_views']) }}</td>
                                    <td>{{ number_format($row['unique_visitors']) }}</td>
                                    <td>{{ $row['last_viewed']?->timezone(config('app.timezone'))->format('M j, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="ibn-visitor-analytics__pager">
                    <button type="button" wire:click="setContentPage({{ $content['page'] - 1 }})" @disabled($content['page'] <= 1)>
                        Previous
                    </button>
                    <span>Page {{ $content['page'] }} of {{ $content['last_page'] }}</span>
                    <button type="button" wire:click="setContentPage({{ $content['page'] + 1 }})" @disabled($content['page'] >= $content['last_page'])>
                        Next
                    </button>
                </div>
            @endif
        </section>

        <div class="ibn-visitor-analytics__split">
            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Selected range</p>
                        <h3>Referrers</h3>
                    </div>
                </div>

                @if ($referrers === [])
                    <p class="ibn-empty-inline">No referrer hosts were recorded in this date range.</p>
                @else
                    <div class="ibn-visitor-analytics__table-wrap">
                        <table class="ibn-analytics-table">
                            <thead>
                                <tr>
                                    <th>Referrer Host</th>
                                    <th>Page Views</th>
                                    <th>Unique Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($referrers as $row)
                                    <tr>
                                        <td>{{ $row['referrer_host'] }}</td>
                                        <td>{{ number_format($row['page_views']) }}</td>
                                        <td>{{ number_format($row['unique_visitors']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Selected range</p>
                        <h3>Countries</h3>
                    </div>
                </div>

                @if ($countries === [])
                    <p class="ibn-empty-inline">Country data is not available for this date range. Country is stored only when a trusted edge header is present.</p>
                @else
                    <div class="ibn-visitor-analytics__table-wrap">
                        <table class="ibn-analytics-table">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Page Views</th>
                                    <th>Unique Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $row)
                                    <tr>
                                        <td>{{ $row['label'] === $row['country'] ? $row['country'] : $row['label'].' ('.$row['country'].')' }}</td>
                                        <td>{{ number_format($row['page_views']) }}</td>
                                        <td>{{ number_format($row['unique_visitors']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>

        <div class="ibn-visitor-analytics__thirds">
            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Selected range</p>
                        <h3>Device</h3>
                    </div>
                </div>

                @if ($kpis['page_views'] === 0)
                    <p class="ibn-empty-inline">No device data in this date range.</p>
                @else
                    <div class="ibn-visitor-analytics__table-wrap">
                        <table class="ibn-analytics-table">
                            <thead>
                                <tr>
                                    <th>Device</th>
                                    <th>Page Views</th>
                                    <th>Unique Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $row)
                                    <tr>
                                        <td>{{ $row['label'] }}</td>
                                        <td>{{ number_format($row['page_views']) }}</td>
                                        <td>{{ number_format($row['unique_visitors']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Selected range</p>
                        <h3>Browser</h3>
                    </div>
                </div>

                @if ($browsers === [])
                    <p class="ibn-empty-inline">No browser data in this date range.</p>
                @else
                    <div class="ibn-visitor-analytics__table-wrap">
                        <table class="ibn-analytics-table">
                            <thead>
                                <tr>
                                    <th>Browser</th>
                                    <th>Page Views</th>
                                    <th>Unique Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($browsers as $row)
                                    <tr>
                                        <td>{{ $row['browser'] }}</td>
                                        <td>{{ number_format($row['page_views']) }}</td>
                                        <td>{{ number_format($row['unique_visitors']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <section class="ibn-widget-card">
                <div class="ibn-widget-card__header">
                    <div>
                        <p class="ibn-widget-card__eyebrow">Selected range</p>
                        <h3>Operating system</h3>
                    </div>
                </div>

                @if ($operatingSystems === [])
                    <p class="ibn-empty-inline">No operating system data in this date range.</p>
                @else
                    <div class="ibn-visitor-analytics__table-wrap">
                        <table class="ibn-analytics-table">
                            <thead>
                                <tr>
                                    <th>Operating System</th>
                                    <th>Page Views</th>
                                    <th>Unique Visitors</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operatingSystems as $row)
                                    <tr>
                                        <td>{{ $row['operating_system'] }}</td>
                                        <td>{{ number_format($row['page_views']) }}</td>
                                        <td>{{ number_format($row['unique_visitors']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>
    </div>

    <style>
        .ibn-visitor-analytics {
            display: grid;
            gap: 1rem;
        }

        .ibn-visitor-analytics__kpis {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .ibn-visitor-analytics__split,
        .ibn-visitor-analytics__thirds {
            display: grid;
            gap: 1rem;
        }

        .ibn-visitor-analytics__split {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ibn-visitor-analytics__thirds {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .ibn-visitor-analytics__filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            margin-top: 1rem;
        }

        .ibn-visitor-analytics__filter-row label {
            display: grid;
            gap: 0.35rem;
            min-width: 11rem;
            color: var(--ibn-text-muted);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .ibn-visitor-analytics__filter-row select,
        .ibn-visitor-analytics__filter-row input {
            min-height: 2.5rem;
            border: 1px solid var(--ibn-border-strong);
            border-radius: 0.8rem;
            background: var(--ibn-surface-strong);
            color: var(--ibn-text);
            padding: 0.4rem 0.7rem;
            font-size: 0.95rem;
        }

        .ibn-visitor-analytics__table-wrap {
            overflow-x: auto;
            margin-top: 0.75rem;
        }

        .ibn-analytics-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.92rem;
        }

        .ibn-analytics-table th,
        .ibn-analytics-table td {
            padding: 0.7rem 0.45rem;
            border-bottom: 1px solid var(--ibn-border);
            text-align: left;
            vertical-align: top;
        }

        .ibn-analytics-table th {
            color: var(--ibn-text-muted);
            font-size: 0.75rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .ibn-analytics-table button {
            color: inherit;
            font: inherit;
            letter-spacing: inherit;
            text-transform: inherit;
        }

        .ibn-visitor-analytics__pager {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 0.85rem;
            color: var(--ibn-text-muted);
            font-size: 0.9rem;
        }

        .ibn-visitor-analytics__pager button {
            border: 1px solid var(--ibn-border-strong);
            border-radius: 999px;
            padding: 0.35rem 0.8rem;
            color: var(--ibn-text);
        }

        .ibn-visitor-analytics__pager button:disabled {
            opacity: 0.45;
        }

        .ibn-visitor-analytics .ibn-empty-inline {
            margin-top: 0.9rem;
            color: var(--ibn-text-muted);
        }

        @media (max-width: 1100px) {
            .ibn-visitor-analytics__kpis,
            .ibn-visitor-analytics__thirds {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .ibn-visitor-analytics__kpis,
            .ibn-visitor-analytics__split,
            .ibn-visitor-analytics__thirds {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-filament-panels::page>
