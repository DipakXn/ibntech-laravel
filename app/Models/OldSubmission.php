<?php

namespace App\Models;

use App\Services\OldSubmissions\OldSubmissionFieldMapper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OldSubmission extends Model
{
    protected $table = 'old_submissions';

    protected $fillable = [
        'external_submission_id',
        'form_name',
        'source_file',
        'submitted_at',
        'name',
        'email',
        'phone',
        'company',
        'service',
        'job_title',
        'city',
        'country',
        'message',
        'page_name',
        'page_id',
        'page_url',
        'lead_source',
        'utm_source',
        'ip_address',
        'user_agent',
        'external_user_id',
        'fields',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'fields' => 'array',
        ];
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('submitted_at');
    }

    /**
     * @return array<string, string>
     */
    public static function optionsFor(string $column): array
    {
        if (! in_array($column, ['form_name', 'lead_source', 'service', 'utm_source'], true)) {
            return [];
        }

        return static::query()
            ->whereNotNull($column)
            ->where($column, '!=', '')
            ->distinct()
            ->orderBy($column)
            ->pluck($column, $column)
            ->all();
    }

    /**
     * Original export columns, excluding the technical metadata already shown
     * in the submission summary. Empty values stay in storage and are omitted here.
     *
     * @return list<array{label: string, value: string}>
     */
    public function exportedFieldPairs(): array
    {
        $pairs = [];

        foreach ($this->fields ?? [] as $field) {
            if (! is_array($field)) {
                continue;
            }

            $label = trim((string) ($field['label'] ?? ''));
            $value = (string) ($field['value'] ?? '');

            if (trim($value) === '') {
                continue;
            }

            if (in_array(OldSubmissionFieldMapper::normalizeLabel($label), OldSubmissionFieldMapper::TECHNICAL_LABELS, true)) {
                continue;
            }

            $pairs[] = [
                'label' => $label !== '' ? $label : '(untitled field)',
                'value' => $value,
            ];
        }

        return $pairs;
    }
}
