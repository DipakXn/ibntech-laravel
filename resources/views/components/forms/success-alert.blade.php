@props([
    'title' => 'Success',
])

<div
    {{ $attributes->class(['form-success', 'contact-form__success'])->merge([
        'data-form-success' => true,
        'tabindex' => '-1',
    ]) }}
    role="status"
    aria-live="polite"
    x-data
    x-init="$nextTick(() => window.revealFormSuccess?.($el))"
>
    <span class="form-success__icon" aria-hidden="true">
        <i class="fa-solid fa-circle-check"></i>
    </span>
    <div class="form-success__body">
        <p class="form-success__title">{{ $title }}</p>
        @if ($slot->isNotEmpty())
            <div class="form-success__message">{{ $slot }}</div>
        @endif
        @isset($actions)
            <div class="form-success__actions">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
