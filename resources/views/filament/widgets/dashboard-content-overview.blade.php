<x-filament-widgets::widget class="ibn-dashboard-panel">
    <section class="ibn-widget-card ibn-widget-card--compact">
        <div class="ibn-widget-card__header">
            <div>
                <p class="ibn-widget-card__eyebrow">Content</p>
                <h3>Content overview</h3>
            </div>
        </div>

        <div class="ibn-content-overview">
            @foreach ($items as $item)
                @if ($item['url'])
                    <a href="{{ $item['url'] }}" class="ibn-content-overview__item">
                        <span>{{ $item['label'] }}</span>
                        <strong>{{ number_format($item['total']) }}</strong>
                    </a>
                @else
                    <div class="ibn-content-overview__item">
                        <span>{{ $item['label'] }}</span>
                        <strong>{{ number_format($item['total']) }}</strong>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
</x-filament-widgets::widget>
