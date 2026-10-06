@php
    $topbarName = trim((string) auth()->user()?->name);
@endphp

<div class="ibn-topbar-chip">
    <span class="ibn-topbar-chip__dot"></span>
    @if ($topbarName !== '')
        <span>{{ $topbarName }}</span>
    @endif
</div>
