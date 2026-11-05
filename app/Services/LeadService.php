<?php

namespace App\Services;

use App\Jobs\SendLeadSubmissionNotification;
use App\Models\Lead;
use App\Repositories\LeadRepository;
use App\Support\FormSubmissionPageUrl;
use App\Support\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LeadService
{
    public function __construct(
        protected LeadRepository $leads,
        protected Request $request,
    ) {}

    /**
     * @param  bool  $recordOrganicLeadSource  When true, stores Organic / SEO in payload. Only LandingInquiryForm should pass false.
     */
    public function createLead(
        array $payload,
        string $formName = 'general',
        bool $recordOrganicLeadSource = true,
    ): Lead {
        $payload = $this->normalizePayload($payload);
        $payload = $this->applyLeadSourceToPayload($payload, $recordOrganicLeadSource);

        $lead = $this->leads->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'phone' => $payload['phone'] ?? null,
            'company' => $payload['company'] ?? null,
            'message' => $payload['message'] ?? null,
            'form_name' => $payload['form_name'] ?? $formName,
            'page_url' => FormSubmissionPageUrl::resolve(
                is_string($payload['page_url'] ?? null) ? $payload['page_url'] : null
            ),
            'user_agent' => $this->request->userAgent(),
            'ip_address' => $this->request->ip(),
            'payload' => $payload,
        ]);

        SendLeadSubmissionNotification::dispatch($lead->getKey())->afterCommit();

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

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    protected function applyLeadSourceToPayload(array $payload, bool $recordOrganicLeadSource): array
    {
        if ($recordOrganicLeadSource) {
            $payload['lead_source'] = LeadSource::ORGANIC_SEO;

            return $payload;
        }

        unset($payload['lead_source']);

        return $payload;
    }
}
