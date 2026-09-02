New Submission Received

Someone submitted the {{ $lead->form_label }} on {{ config('app.name', 'IBN Technologies') }}.

Form: {{ $lead->form_label }}
Name: {{ $lead->name }}
Email: {{ $lead->email }}
Phone: {{ $lead->phone ?: 'N/A' }}
Company: {{ $lead->company ?: 'N/A' }}
Service: {{ $lead->service ?: 'N/A' }}
@foreach ($lead->extraAnswers() as $extraRow)
{{ $extraRow['label'] }}: {{ $extraRow['value'] }}
@endforeach
Page URL: {{ $lead->page_url ?: 'N/A' }}

Message:
{{ $lead->message ?: 'N/A' }}

Submitted: {{ optional($lead->created_at)->timezone(config('app.timezone'))->format('M j, Y g:i A T') ?: 'N/A' }}
IP Address: {{ $lead->ip_address ?: 'N/A' }}
Lead ID: #{{ $lead->id }}
User Agent: {{ $lead->user_agent ?: 'N/A' }}

This is an automated notification from {{ config('app.name', 'IBN Technologies') }}. Do not reply directly to this email.
