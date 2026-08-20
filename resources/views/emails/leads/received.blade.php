@php
    $appName = config('app.name', 'IBN Technologies');
    $rows = [
        ['label' => 'Form', 'value' => $lead->form_label],
        ['label' => 'Name', 'value' => $lead->name],
        ['label' => 'Email', 'value' => $lead->email, 'href' => $lead->email ? 'mailto:'.$lead->email : null],
        ['label' => 'Phone', 'value' => $lead->phone],
        ['label' => 'Company', 'value' => $lead->company],
        ['label' => 'Service', 'value' => $lead->service],
        ['label' => 'Page URL', 'value' => $lead->page_url, 'href' => $lead->page_url],
    ];
@endphp

<x-emails.layout
    badge="Admin Notification"
    title="New Submission Received"
    :subtitle="'Someone submitted the '.$lead->form_label.' on '.$appName.'.'"
    :preheader="'New '.$lead->form_label.' submission from '.($lead->name ?: 'a visitor')"
>
    <x-slot:intro>
        Hi, you have a new form enquiry. Here are the submitted details:
    </x-slot:intro>

    <table role="presentation" class="detail-table" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; border:1px solid #e5e7eb; border-radius:10px; overflow:hidden;">
        @foreach ($rows as $index => $row)
            <x-emails.detail-row
                :label="$row['label']"
                :value="$row['value'] ?? null"
                :href="$row['href'] ?? null"
                :last="$index === array_key_last($rows)"
            />
        @endforeach
    </table>

    <div style="height:16px; line-height:16px; font-size:16px;">&nbsp;</div>

    <div class="message-box" style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:18px 20px;">
        <p class="message-label" style="color:#6b7280; font-size:11px; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; margin:0 0 8px 0;">
            Message
        </p>
        <p class="message-body" style="color:#1f2937; font-size:14px; line-height:1.6; margin:0; white-space:pre-wrap; word-break:break-word;">{{ $lead->message ?: 'N/A' }}</p>
    </div>

    <x-slot:meta>
        <div style="color:#6b7280; font-size:12px; line-height:1.7;">
            <strong style="color:#4b5563;">Submitted:</strong>
            {{ optional($lead->created_at)->timezone(config('app.timezone'))->format('M j, Y g:i A T') ?: 'N/A' }}
            <br />
            <strong style="color:#4b5563;">IP Address:</strong>
            {{ $lead->ip_address ?: 'N/A' }}
            <br />
            <strong style="color:#4b5563;">Lead ID:</strong>
            #{{ $lead->id }}
            <br />
            <strong style="color:#4b5563;">User Agent:</strong>
            {{ $lead->user_agent ?: 'N/A' }}
        </div>
    </x-slot:meta>
</x-emails.layout>
