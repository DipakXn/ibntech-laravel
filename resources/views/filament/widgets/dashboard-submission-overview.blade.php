<x-filament-widgets::widget class="ibn-dashboard-panel">
    <section class="ibn-widget-card ibn-widget-card--compact">
        <div class="ibn-widget-card__header ibn-dashboard-panel__header">
            <div>
                <p class="ibn-widget-card__eyebrow">Submissions</p>
                <h3>Submission overview</h3>
            </div>
            <a href="{{ $submissionsUrl }}" class="ibn-dashboard-link">View submissions</a>
        </div>

        @include('filament.widgets.partials.dashboard-metrics', ['cards' => $cards])

        <div class="ibn-dashboard-split">
            <div class="ibn-dashboard-split__chart">
                @livewire(\App\Filament\Widgets\DashboardSubmissionTrendChart::class)
            </div>

            <div>
                <p class="ibn-dashboard-split__label">Top forms</p>

                @if ($forms === [])
                    <div class="ibn-empty-inline">No form submissions yet.</div>
                @else
                    <ol class="ibn-top-forms">
                        @foreach ($forms as $form)
                            <li class="ibn-top-forms__row">
                                <span>{{ $form['label'] }}</span>
                                <strong>{{ number_format($form['submissions']) }}</strong>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>
    </section>
</x-filament-widgets::widget>
