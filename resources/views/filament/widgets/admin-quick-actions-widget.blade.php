<x-filament-widgets::widget>
    <div class="ibn-widget-card">
        <div class="ibn-widget-card__header">
            <div>
                <p class="ibn-widget-card__eyebrow">Quick actions</p>
                <h3>Move key admin tasks forward</h3>
            </div>
        </div>

        <div class="ibn-quick-actions-grid">
            @foreach ($actions as $action)
                <a href="{{ $action['url'] }}" class="ibn-quick-action">
                    <strong>{{ $action['label'] }}</strong>
                    <span>{{ $action['description'] }}</span>
                </a>
            @endforeach
        </div>

        <div class="ibn-metric-grid">
            @foreach ($metrics as $metric)
                <article class="ibn-metric-card">
                    <span>{{ $metric['label'] }}</span>
                    <strong>{{ $metric['value'] }}</strong>
                    <p>{{ $metric['hint'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
