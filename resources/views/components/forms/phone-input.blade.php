@props([
    'id' => 'phone-input',
    'model' => null,
    'name' => 'phone',
    'value' => '',
    'placeholder' => 'Contact Number',
])

@php
    $hiddenId = $id.'-value';
@endphp

<div class="phone-input-field">
    <input
        id="{{ $id }}"
        type="tel"
        class="phone-input-field__control"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        autocomplete="tel"
        data-phone-input
        data-phone-hidden="#{{ $hiddenId }}"
    >
    <input
        id="{{ $hiddenId }}"
        type="hidden"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($model) wire:model="{{ $model }}" @endif
    >
</div>
