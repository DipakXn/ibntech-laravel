<x-mail::message>
# New Submission Received

- Form: {{ $lead->form_label }}
- Name: {{ $lead->name }}
- Email: {{ $lead->email }}
- Phone: {{ $lead->phone ?: 'N/A' }}
- Company: {{ $lead->company ?: 'N/A' }}
- Page URL: {{ $lead->page_url ?: 'N/A' }}
- IP Address: {{ $lead->ip_address ?: 'N/A' }}
- User Agent: {{ $lead->user_agent ?: 'N/A' }}

Message:
{{ $lead->message ?: 'N/A' }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
