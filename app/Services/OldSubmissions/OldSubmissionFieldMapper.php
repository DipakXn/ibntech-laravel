<?php

namespace App\Services\OldSubmissions;

use DateTimeImmutable;

class OldSubmissionFieldMapper
{
    /**
     * Labels shared by every Elementor submission export. They are stored as
     * their own columns and omitted from the "exported fields" detail list.
     *
     * @var list<string>
     */
    public const TECHNICAL_LABELS = [
        'form name (id)',
        'submission id',
        'created at',
        'user id',
        'user agent',
        'user ip',
        'referrer',
    ];

    /**
     * Human labels observed across the Elementor CSV exports. Matching is done
     * on the normalized label so "Email :", "Email*", and "email" collapse
     * together. Opaque Elementor ids such as field_f5f1e1b are not mapped.
     *
     * @var array<string, list<string>>
     */
    private const ALIASES = [
        'name' => ['full name', 'name', 'your name', 'full_name'],
        'email' => ['business email', 'business email id', 'email', 'email address', 'please enter your email', 'business_email'],
        'phone' => ['phone', 'phone number', 'contact no', 'mobile'],
        'company' => ['company', 'company name', 'company_name'],
        'service' => ['services', 'sevices', 'field_services', 'pick your service type'],
        'job_title' => ['job title', 'job_title'],
        'city' => ['city'],
        'country' => ['country'],
        'page_name' => ['page name'],
        'page_id' => ['page id'],
        'lead_source' => ['lead source', 'promo_source'],
        'utm_source' => ['utm source', 'utm_source'],
        'page_url' => ['referrer'],
        'form_name' => ['form name (id)'],
        'external_submission_id' => ['submission id'],
        'submitted_at' => ['created at'],
        'external_user_id' => ['user id'],
        'user_agent' => ['user agent'],
        'ip_address' => ['user ip'],
    ];

    /**
     * @param  list<array{label: string, value: string}>  $fields
     * @return array{attributes: array<string, mixed>}|array{error: string}
     */
    public function map(array $fields, string $sourceFile): array
    {
        $submissionId = $this->firstValue($fields, self::ALIASES['external_submission_id']);

        if ($submissionId === null) {
            return ['error' => 'missing submission id'];
        }

        if (mb_strlen($submissionId) > 64) {
            return ['error' => "submission id exceeds 64 characters ({$submissionId})"];
        }

        $submittedAt = $this->firstValue($fields, self::ALIASES['submitted_at']);
        $parsedDate = $this->parseSubmittedAt($submittedAt);

        if ($parsedDate === null) {
            return ['error' => 'invalid submission date '.($submittedAt ?? '(blank)')];
        }

        $pageName = $this->firstValue($fields, self::ALIASES['page_name'])
            ?? $this->firstValue($fields, ['post title']);

        return [
            'attributes' => [
                'external_submission_id' => $submissionId,
                'form_name' => $this->limit($this->firstValue($fields, self::ALIASES['form_name']) ?? '(unknown)', 255),
                'source_file' => $this->limit($sourceFile, 255) ?? $sourceFile,
                'submitted_at' => $parsedDate,
                'name' => $this->limit($this->firstValue($fields, self::ALIASES['name']), 255),
                'email' => $this->limit($this->firstValue($fields, self::ALIASES['email']), 255),
                'phone' => $this->limit($this->firstValue($fields, self::ALIASES['phone']), 100),
                'company' => $this->limit($this->firstValue($fields, self::ALIASES['company']), 255),
                'service' => $this->limit($this->firstValue($fields, self::ALIASES['service']), 255),
                'job_title' => $this->limit($this->firstValue($fields, self::ALIASES['job_title']), 255),
                'city' => $this->limit($this->firstValue($fields, self::ALIASES['city']), 255),
                'country' => $this->limit($this->firstValue($fields, self::ALIASES['country']), 255),
                'message' => $this->message($fields),
                'page_name' => $this->limit($pageName, 255),
                'page_id' => $this->limit($this->firstValue($fields, self::ALIASES['page_id']), 64),
                'page_url' => $this->firstValue($fields, self::ALIASES['page_url']),
                'lead_source' => $this->limit($this->firstValue($fields, self::ALIASES['lead_source']), 255),
                'utm_source' => $this->limit($this->firstValue($fields, self::ALIASES['utm_source']), 255),
                'ip_address' => $this->limit($this->firstValue($fields, self::ALIASES['ip_address']), 64),
                'user_agent' => $this->firstValue($fields, self::ALIASES['user_agent']),
                'external_user_id' => $this->limit($this->firstValue($fields, self::ALIASES['external_user_id']), 64),
                'fields' => $fields,
            ],
        ];
    }

    public static function normalizeLabel(string $label): string
    {
        if (str_starts_with($label, "\xEF\xBB\xBF")) {
            $label = substr($label, 3);
        }
        $label = trim($label);
        $label = trim($label, "\"'");
        $label = trim($label);
        $label = preg_replace('/\s+/u', ' ', $label) ?? $label;
        $label = mb_strtolower($label);

        return trim(rtrim($label, ' :*?'));
    }

    public static function decodeValue(string $value): string
    {
        if (! str_contains($value, '\\')) {
            return $value;
        }

        $decoded = preg_replace_callback(
            '/\\\\(?:r\\\\n|n|r|t|"|\\\\|\\/)/',
            static function (array $match): string {
                return match ($match[0]) {
                    '\\r\\n', '\\n', '\\r' => "\n",
                    '\\t' => "\t",
                    '\\"' => '"',
                    '\\\\' => '\\',
                    '\\/' => '/',
                    default => $match[0],
                };
            },
            $value,
        );

        return is_string($decoded) ? $decoded : $value;
    }

    /**
     * @param  list<array{label: string, value: string}>  $fields
     * @param  list<string>  $aliases
     */
    private function firstValue(array $fields, array $aliases): ?string
    {
        foreach ($fields as $field) {
            $label = self::normalizeLabel($field['label']);

            if (! in_array($label, $aliases, true)) {
                continue;
            }

            $value = trim($field['value']);

            if ($value !== '') {
                return $value;
            }
        }

        return null;
    }

    /**
     * @param  list<array{label: string, value: string}>  $fields
     */
    private function message(array $fields): ?string
    {
        $direct = $this->firstValue($fields, ['message', 'freemessage']);

        if ($direct !== null) {
            return $direct;
        }

        foreach ($fields as $field) {
            $label = self::normalizeLabel($field['label']);

            if (! $this->isNarrativeLabel($label)) {
                continue;
            }

            $value = trim($field['value']);

            if ($value !== '') {
                return $value;
            }
        }

        return null;
    }

    private function isNarrativeLabel(string $label): bool
    {
        foreach ([
            'describe',
            'tell us',
            'share your',
            'how can we',
            'need help',
            'challenge',
            'requirement',
            "let's",
            'let’s',
            'looking for',
        ] as $needle) {
            if (str_contains($label, $needle)) {
                return true;
            }
        }

        return false;
    }

    private function parseSubmittedAt(?string $value): ?string
    {
        if ($value === null || ! preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $value)) {
            return null;
        }

        $parsed = DateTimeImmutable::createFromFormat('!Y-m-d H:i:s', $value);
        $errors = DateTimeImmutable::getLastErrors();

        if ($parsed === false) {
            return null;
        }

        if (is_array($errors) && (($errors['warning_count'] ?? 0) > 0 || ($errors['error_count'] ?? 0) > 0)) {
            return null;
        }

        return $parsed->format('Y-m-d H:i:s');
    }

    private function limit(?string $value, int $length): ?string
    {
        if ($value === null) {
            return null;
        }

        if (mb_strlen($value) <= $length) {
            return $value;
        }

        return mb_substr($value, 0, $length);
    }
}
