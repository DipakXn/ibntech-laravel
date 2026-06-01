<?php

namespace App\Services;

use App\Jobs\SendLeadSubmissionNotification;
use App\Models\Lead;
use App\Repositories\LeadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LeadService
{
    public function __construct(
        protected LeadRepository $leads,
        protected Request $request,
    ) {
    }

    public function createLead(array $payload, string $formName = 'general'): Lead
    {
        $payload = $this->normalizePayload($payload);

        $lead = $this->leads->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'] ?? null,
            'company' => $payload['company'] ?? null,
            'message' => $payload['message'] ?? null,
            'form_name' => $payload['form_name'] ?? $formName,
            'page_url' => $payload['page_url'] ?? $this->request->headers->get('referer'),
            'user_agent' => $this->request->userAgent(),
            'ip_address' => $this->request->ip(),
            'payload' => $payload,
        ]);

        $recipient = config('mail.lead_notification_to', config('mail.from.address'));

        if ($recipient) {
            SendLeadSubmissionNotification::dispatch($lead->getKey(), $recipient)->afterCommit();
        }

        return $lead;
    }

    protected function normalizePayload(array $payload): array
    {
        return Arr::map($payload, function (mixed $value): mixed {
            if (! is_string($value)) {
                return $value;
            }

            $value = trim($value);

            return $value === '' ? null : $value;
        });
    }
}
