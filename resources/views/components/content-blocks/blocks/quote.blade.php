@if (filled($data['quote'] ?? null))
    <blockquote class="content-block content-block--quote">
        <p>{{ $data['quote'] }}</p>

        @if (filled($data['author'] ?? null))
            <footer>
                <strong>{{ $data['author'] }}</strong>

                @if (filled($data['role'] ?? null))
                    <span>{{ $data['role'] }}</span>
                @endif
            </footer>
        @endif
    </blockquote>
@endif

