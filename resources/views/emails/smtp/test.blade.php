@php
    $appName = config('app.name', 'IBN Technologies');
@endphp

<x-emails.layout
    badge="SMTP Test"
    title="{{ $testSubject }}"
    subtitle="This message was sent from the IBNTECH Control SMTP test tool."
    :preheader="$testSubject"
    :footer="'This is a test message from '.$appName.'.'"
>
    <x-slot:intro>
        SMTP configuration test
    </x-slot:intro>

    <p style="color:#1f2937; font-size:15px; line-height:1.6; margin:0; white-space:pre-wrap;">{{ $testBody }}</p>
</x-emails.layout>
