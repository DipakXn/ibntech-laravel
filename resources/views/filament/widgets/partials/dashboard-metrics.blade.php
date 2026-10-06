<div class="ibn-metric-grid ibn-dashboard-kpis">
    @foreach ($cards as $card)
        <article class="ibn-metric-card">
            <span>{{ $card['label'] }}</span>
            <strong>{{ number_format($card['value']) }}</strong>
            <p>{{ $card['hint'] }}</p>
        </article>
    @endforeach
</div>
