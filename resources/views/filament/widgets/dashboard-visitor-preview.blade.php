<x-filament-widgets::widget class="ibn-dashboard-panel">
    <section class="ibn-widget-card ibn-widget-card--compact">
        <div class="ibn-widget-card__header ibn-dashboard-panel__header">
            <div>
                <p class="ibn-widget-card__eyebrow">Audience</p>
                <h3>Visitor analytics</h3>
            </div>
            <a href="{{ $analyticsUrl }}" class="ibn-dashboard-link">View analytics</a>
        </div>

        @include('filament.widgets.partials.dashboard-metrics', ['cards' => $cards])

        <div class="ibn-dashboard-split__chart">
            @livewire(\App\Filament\Widgets\DashboardVisitorTrendChart::class)
        </div>
    </section>
</x-filament-widgets::widget>
