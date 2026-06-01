@php
    $headers = collect($data['headers'] ?? [])->filter();
    $rows = collect($data['rows'] ?? []);
@endphp

@if ($headers->isNotEmpty() || $rows->isNotEmpty())
    <section class="content-block content-block--table">
        <div class="content-table-wrap">
            <table class="content-table">
                @if ($headers->isNotEmpty())
                    <thead>
                        <tr>
                            @foreach ($headers as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                @endif

                <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            @foreach (($row['columns'] ?? []) as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if (filled($data['caption'] ?? null))
            <p class="content-table__caption">{{ $data['caption'] }}</p>
        @endif
    </section>
@endif

