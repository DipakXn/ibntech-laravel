<x-filament-widgets::widget class="ibn-record-overview">
    <section class="ibn-record-overview__section" aria-labelledby="record-overview-heading">
        <h2 id="record-overview-heading" class="ibn-record-overview__title">{{ $heading }}</h2>

        <div class="ibn-metric-grid ibn-record-overview__grid">
            @foreach ($cards as $card)
                <article class="ibn-metric-card">
                    <span>{{ $card['label'] }}</span>
                    <strong>{{ number_format($card['value']) }}</strong>
                    <p>{{ $card['hint'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <style>
        .fi-wi-widget.ibn-record-overview,
        .dark .fi-wi-widget.ibn-record-overview {
            background: transparent;
            border: 0;
            box-shadow: none;
            border-radius: 0;
        }

        .ibn-record-overview__title {
            margin: 0;
            color: var(--ibn-text);
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .ibn-record-overview .ibn-record-overview__grid {
            margin-top: 0.55rem;
            gap: 0.65rem;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .ibn-record-overview .ibn-metric-card {
            padding: 0.65rem 0.8rem;
        }

        .ibn-record-overview .ibn-metric-card strong {
            margin-top: 0.1rem;
            font-size: 1.35rem;
            line-height: 1.15;
        }

        .ibn-record-overview .ibn-metric-card p {
            margin-top: 0.15rem;
            font-size: 0.75rem;
        }

        @media (max-width: 1024px) {
            .ibn-record-overview .ibn-record-overview__grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .ibn-record-overview .ibn-record-overview__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-filament-widgets::widget>
