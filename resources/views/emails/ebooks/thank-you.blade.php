@php
    $appName = config('app.name', 'IBN Technologies');
    $name = $lead->name ?: 'there';
    $ebookTitle = $lead->asset_title ?: 'this eBook';
@endphp

<x-emails.layout
    badge="Thank You"
    title="eBook unlocked"
    :subtitle="'Thank you for your interest in '.$ebookTitle.'.'"
    :preheader="'Thank you for unlocking '.$ebookTitle"
    :footer="'This is an automated message from '.$appName.'.'"
>
    <x-slot:intro>
        Hi {{ $name }}, thank you for submitting your details. Your eBook is unlocked.
    </x-slot:intro>

    <p style="color:#1f2937; font-size:15px; line-height:1.6; margin:0 0 16px 0;">
        You can download the full eBook PDF from the page you just used.
    </p>

    <p style="color:#1f2937; font-size:15px; line-height:1.6; margin:0;">
        We appreciate your interest in {{ $appName }} and look forward to helping you next.
    </p>
</x-emails.layout>
