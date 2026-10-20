@props(['toolbar'])

<nav id="admin-toolbar" class="admin-toolbar" aria-label="Admin toolbar" data-admin-toolbar>
    <a class="admin-toolbar__mark" href="{{ $toolbar['siteUrl'] }}">IBN</a>

    <div class="admin-toolbar__primary">
        <a class="admin-toolbar__link" href="{{ $toolbar['dashboardUrl'] }}">
            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 4h7v7H4V4zm9 0h7v7h-7V4zM4 13h7v7H4v-7zm9 0h7v7h-7v-7z"/></svg>
            Dashboard
        </a>

        @if ($toolbar['newItems'] !== [])
            <div class="admin-toolbar__menu admin-toolbar__new" data-admin-toolbar-menu>
                <button type="button" class="admin-toolbar__link" aria-expanded="false" aria-controls="admin-toolbar-new">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M11 4h2v7h7v2h-7v7h-2v-7H4v-2h7V4z"/></svg>
                    New
                </button>
                <div id="admin-toolbar-new" class="admin-toolbar__panel" data-admin-toolbar-panel hidden>
                    @foreach ($toolbar['newItems'] as $item)
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($toolbar['context'])
            <a class="admin-toolbar__link admin-toolbar__context" href="{{ $toolbar['context']['url'] }}">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                {{ $toolbar['context']['label'] }}
            </a>
        @endif

        @if ($toolbar['controlItems'] !== [])
            <div class="admin-toolbar__menu admin-toolbar__control" data-admin-toolbar-menu>
                <button type="button" class="admin-toolbar__link" aria-expanded="false" aria-controls="admin-toolbar-control">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 6h10v2H4V6zm12 1a2 2 0 1 0 2-2 2 2 0 0 0-2 2zM4 16h6v2H4v-2zm8 1a2 2 0 1 0 2-2 2 2 0 0 0-2 2zm2-2h6v2h-6v-2zM4 11h6v2H4v-2z"/></svg>
                    Control
                </button>
                <div id="admin-toolbar-control" class="admin-toolbar__panel" data-admin-toolbar-panel hidden>
                    @foreach ($toolbar['controlItems'] as $item)
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($toolbar['clearCacheUrl'])
            <form class="admin-toolbar__clear-cache" method="POST" action="{{ $toolbar['clearCacheUrl'] }}">
                @csrf
                <input type="hidden" name="return" value="{{ url()->current() }}">
                <button type="submit" class="admin-toolbar__link">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M17.65 6.35A7.95 7.95 0 0 0 12 4V1L7 6l5 5V7a5 5 0 1 1-5 5H5a7 7 0 1 0 12.65-5.65z"/></svg>
                    Clear Cache
                </button>
            </form>
        @endif
    </div>

    @if ($toolbar['newItems'] !== [] || $toolbar['context'] || $toolbar['controlItems'] !== [])
        <div class="admin-toolbar__menu admin-toolbar__overflow" data-admin-toolbar-menu>
            <button type="button" class="admin-toolbar__link" aria-expanded="false" aria-controls="admin-toolbar-menu">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/></svg>
                Menu
            </button>
            <div id="admin-toolbar-menu" class="admin-toolbar__panel" data-admin-toolbar-panel hidden>
                @foreach ($toolbar['newItems'] as $item)
                    <a href="{{ $item['url'] }}">New {{ $item['label'] }}</a>
                @endforeach
                @if ($toolbar['context'])
                    <a href="{{ $toolbar['context']['url'] }}">{{ $toolbar['context']['label'] }}</a>
                @endif
                @foreach ($toolbar['controlItems'] as $item)
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="admin-toolbar__end">
        @if (session('adminToolbarNotice'))
            <span class="admin-toolbar__notice" role="status">{{ session('adminToolbarNotice') }}</span>
        @endif
        @if ($toolbar['submissions'])
            <a class="admin-toolbar__link admin-toolbar__submissions" href="{{ $toolbar['submissions']['url'] }}">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M12 3a6 6 0 0 0-6 6v3.2L4.3 15a1 1 0 0 0 .8 1.6h13.8a1 1 0 0 0 .8-1.6L18 12.2V9a6 6 0 0 0-6-6zm0 18a2.5 2.5 0 0 0 2.45-2h-4.9A2.5 2.5 0 0 0 12 21z"/>
                </svg>
                <span class="admin-toolbar__submissions-label">Submissions</span>
                @if ($toolbar['submissions']['count'] > 0)
                    <span class="admin-toolbar__badge">{{ $toolbar['submissions']['count'] }}</span>
                @endif
            </a>
        @endif

        <div class="admin-toolbar__menu admin-toolbar__user" data-admin-toolbar-menu>
            <button type="button" class="admin-toolbar__link" aria-expanded="false" aria-controls="admin-toolbar-user">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-3.33 0-8 1.67-8 5v1h16v-1c0-3.33-4.67-5-8-5z"/></svg>
                {{ $toolbar['userName'] }}
            </button>
            <div id="admin-toolbar-user" class="admin-toolbar__panel admin-toolbar__panel--end" data-admin-toolbar-panel hidden>
                <a href="{{ $toolbar['profileUrl'] }}">Profile</a>
                <form method="POST" action="{{ $toolbar['logoutUrl'] }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
