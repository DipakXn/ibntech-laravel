@if ($paginator->hasPages())
    <nav class="blog-pagination__nav" aria-label="{{ $label ?? 'Pagination' }}">
        <ul class="blog-pagination__list">
            @if ($paginator->onFirstPage())
                <li class="blog-pagination__item is-disabled" aria-disabled="true">
                    <span class="blog-pagination__link" aria-hidden="true">&lsaquo;</span>
                    <span class="visually-hidden">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="blog-pagination__item">
                    <a
                        class="blog-pagination__link"
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        aria-label="@lang('pagination.previous')"
                    >&lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="blog-pagination__item is-disabled" aria-disabled="true">
                        <span class="blog-pagination__link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="blog-pagination__item is-active" aria-current="page">
                                <span class="blog-pagination__link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="blog-pagination__item">
                                <a class="blog-pagination__link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="blog-pagination__item">
                    <a
                        class="blog-pagination__link"
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        aria-label="@lang('pagination.next')"
                    >&rsaquo;</a>
                </li>
            @else
                <li class="blog-pagination__item is-disabled" aria-disabled="true">
                    <span class="blog-pagination__link" aria-hidden="true">&rsaquo;</span>
                    <span class="visually-hidden">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
