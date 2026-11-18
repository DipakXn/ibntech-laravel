<?php

namespace App\Services\Leads;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubmissionCsvExporter
{
    /**
     * @return list<string>
     */
    public static function headers(): array
    {
        return [
            'ID',
            'Status',
            'Submitted at',
            'Form name',
            'Form label',
            'Name',
            'Email',
            'Phone',
            'Company',
            'Message',
            'Page URL',
            'Lead source',
            'Service / plan',
            'Job title',
            'Asset',
            'IP address',
            'User agent',
            'Payload (JSON)',
        ];
    }

    public function download(Builder $query, ?Carbon $exportedAt = null): StreamedResponse
    {
        $exportedAt ??= now();
        $filename = 'ibntech-submissions-'.$exportedAt->format('Y-m-d-His').'.csv';

        return response()->streamDownload(function () use ($query): void {
            $output = fopen('php://output', 'w');

            if ($output === false) {
                return;
            }

            fputcsv($output, self::headers());

            (clone $query)
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->chunkById(200, function (Collection $records) use ($output): void {
                    foreach ($records as $record) {
                        if (! $record instanceof Lead) {
                            continue;
                        }

                        fputcsv($output, $this->row($record));
                    }
                });
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * @return list<mixed>
     */
    protected function row(Lead $lead): array
    {
        return [
            $lead->getKey(),
            $lead->statusLabel(),
            optional($lead->created_at)->toDateTimeString(),
            $lead->form_name,
            $lead->form_label,
            $lead->name,
            $lead->email,
            $lead->phone,
            $lead->company,
            $lead->message,
            $lead->page_url,
            $lead->lead_source_label ?? $lead->lead_source,
            $lead->service,
            $lead->job_title,
            $lead->asset_title,
            $lead->ip_address,
            $lead->user_agent,
            $lead->payload === null ? '' : json_encode($lead->payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ];
    }
}