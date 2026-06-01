@if (filled($data['code'] ?? null))
    <section class="content-block content-block--code">
        @if (filled($data['filename'] ?? null) || filled($data['language'] ?? null))
            <div class="content-code__meta">
                @if (filled($data['filename'] ?? null))
                    <span>{{ $data['filename'] }}</span>
                @endif

                @if (filled($data['language'] ?? null))
                    <span>{{ strtoupper($data['language']) }}</span>
                @endif
            </div>
        @endif

        <pre><code>{{ $data['code'] }}</code></pre>
    </section>
@endif

