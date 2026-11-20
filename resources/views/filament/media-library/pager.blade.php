@php
    use Illuminate\Pagination\LengthAwarePaginator;

    $last = $paginator instanceof LengthAwarePaginator ? $paginator->lastPage() : 0;
    $current = $paginator instanceof LengthAwarePaginator ? $paginator->currentPage() : 1;
    $pageName = $paginator instanceof LengthAwarePaginator ? $paginator->getPageName() : 'page';
@endphp

@if ($paginator instanceof LengthAwarePaginator && $paginator->total() > 0)
    <nav class="ibn-media-pager" aria-label="Pagination">
        <p class="ibn-media-pager-count">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </p>

        <label class="ibn-media-pager-per-page">
            <span>Per page</span>
            <select wire:model.live="tableRecordsPerPage">
                @foreach ([10, 25, 50] as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
        </label>

        <div class="ibn-media-pager-pages">
            @if ($current > 1)
                <button type="button" wire:click="gotoPage(1, '{{ $pageName }}')" aria-label="First page">«</button>
                <button type="button" wire:click="previousPage('{{ $pageName }}')" aria-label="Previous page">‹</button>
            @endif

            @for ($page = max(1, $current - 2); $page <= min($last, max($current + 2, 3)); $page++)
                <button
                    type="button"
                    wire:click="gotoPage({{ $page }}, '{{ $pageName }}')"
                    @class(['is-active' => $page === $current])
                    @if ($page === $current) aria-current="page" @endif
                >{{ $page }}</button>
            @endfor

            @if ($current < $last)
                <button type="button" wire:click="nextPage('{{ $pageName }}')" aria-label="Next page">›</button>
                <button type="button" wire:click="gotoPage({{ $last }}, '{{ $pageName }}')" aria-label="Last page">»</button>
            @endif
        </div>
    </nav>
@endif
