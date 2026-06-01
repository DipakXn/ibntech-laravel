<x-filament-widgets::widget>
    <div class="ibn-widget-card">
        <div class="ibn-widget-card__header">
            <div>
                <p class="ibn-widget-card__eyebrow">Recent activity</p>
                <h3>Latest publishing updates</h3>
            </div>
        </div>

        <div class="ibn-activity-list">
            @forelse ($items as $item)
                <a href="{{ $item['url'] }}" class="ibn-activity-item">
                    <div>
                        <p>{{ $item['type'] }}</p>
                        <strong>{{ $item['title'] }}</strong>
                    </div>
                    <div class="ibn-activity-item__meta">
                        <span class="ibn-status-pill ibn-status-pill--{{ $item['status'] === 'published' ? 'published' : 'draft' }}">
                            {{ str($item['status'])->title() }}
                        </span>
                        <small>{{ optional($item['date'])->diffForHumans() }}</small>
                    </div>
                </a>
            @empty
                <div class="ibn-empty-inline">
                    Recent updates will appear here once content starts moving through the dashboard.
                </div>
            @endforelse
        </div>
    </div>
</x-filament-widgets::widget>
