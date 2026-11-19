<?php

namespace App\Models;

use App\Support\LeadSource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'form_submissions';

    public const STATUS_NEW = 'new';

    public const STATUS_SPAM = 'spam';

    public const FORM_OPTIONS = [
        'contact' => 'Contact Form',
        'homepage-contact' => 'Homepage Contact',
        'free-consultation-for-construction' => 'Free Consultation For Construction',
        'free-consultation-for-ipa' => 'Free Consultation For IPA',
        'free-consultation-for-payroll-service' => 'Free Consultation For Payroll Service',
        'free-consultation-for-tax-return' => 'Free Consultation For Tax Return Preparation',
        'free-trial' => 'Free Trial',
        'header-contact-modal' => 'Header Contact Modal',
        'vapt-services-quote' => 'VAPT Services Quote',
        'vapt-pricing-quote' => 'VAPT Pricing Quote',
        'pricing-enquire' => 'Pricing Enquire',
        'lead' => 'Lead Form',
        'newsletter_inquiry' => 'Newsletter Inquiry Form',
        'ebook_download' => 'Ebook Download Form',
        'case_study_download' => 'Case Study Download Form',
        'general' => 'General',
    ];

    public static function formOptions(): array
    {
        $options = self::FORM_OPTIONS;

        $landingPages = LandingPage::query()
            ->orderBy('title')
            ->get(['title', 'slug']);

        foreach ($landingPages as $landingPage) {
            if ($landingPage->isThankYouPage()) {
                continue;
            }

            $options[$landingPage->formName()] = $landingPage->title;
        }

        return $options;
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'form_name',
        'status',
        'message',
        'page_url',
        'visitor_id',
        'user_agent',
        'ip_address',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('created_at');
    }

    public function isSpam(): bool
    {
        return $this->status === self::STATUS_SPAM;
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_SPAM => 'Spam',
            default => 'New',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function statusFilterOptions(): array
    {
        return [
            'inbox' => 'Inbox (hide spam)',
            self::STATUS_NEW => 'New only',
            self::STATUS_SPAM => 'Spam',
            'all' => 'All statuses',
        ];
    }

    public static function applyStatusFilter(Builder $query, ?string $value): Builder
    {
        return match ($value) {
            self::STATUS_SPAM => $query->where('status', self::STATUS_SPAM),
            self::STATUS_NEW => $query->where('status', self::STATUS_NEW),
            'all' => $query,
            default => $query->where('status', '!=', self::STATUS_SPAM),
        };
    }

    public function getFormLabelAttribute(): string
    {
        if (is_string($this->form_name) && str_starts_with($this->form_name, 'lp-')) {
            $title = data_get($this->payload, 'landing_page_title');

            if (is_string($title) && $title !== '') {
                return $title;
            }

            return str(substr($this->form_name, 3))->replace('-', ' ')->title()->toString();
        }

        return static::FORM_OPTIONS[$this->form_name] ?? str($this->form_name ?: 'general')->replace('_', ' ')->title()->toString();
    }

    public function getJobTitleAttribute(): ?string
    {
        return data_get($this->payload, 'job_title');
    }

    public function getAssetTitleAttribute(): ?string
    {
        return data_get($this->payload, 'asset_title');
    }

    public function getServiceAttribute(): ?string
    {
        return data_get($this->payload, 'service');
    }

    public function getLeadSourceAttribute(): ?string
    {
        return $this->payloadString('lead_source');
    }

    public function getLeadSourceLabelAttribute(): string
    {
        return LeadSource::displayLabel($this->lead_source);
    }

    public function getPackageSelectedAttribute(): ?string
    {
        return $this->payloadString('package_selected') ?: $this->service;
    }

    public function getLookingForAttribute(): ?string
    {
        return $this->payloadString('looking_for');
    }

    public function getNeededServiceAttribute(): ?string
    {
        return $this->payloadString('needed_service');
    }

    public function getResourceTypeAttribute(): ?string
    {
        return $this->payloadString('resource_type');
    }

    public function getHireWhenAttribute(): ?string
    {
        return $this->payloadString('hire_when');
    }

    /**
     * Extra form answers stored in payload. Keys already shown as dedicated
     * admin fields (service, job_title, asset_title) are omitted when they
     * would duplicate another displayed value.
     *
     * @return list<array{key: string, label: string, value: string}>
     */
    public function extraAnswers(): array
    {
        $answers = [];

        foreach ([
            'package_selected' => 'Selected Plan',
            'looking_for' => 'What are you looking for?',
            'needed_service' => 'Which service do you need?',
            'resource_type' => 'Resource Type',
            'hire_when' => 'When do you want to hire?',
        ] as $key => $label) {
            $value = $this->payloadString($key);

            if ($value === null) {
                continue;
            }

            if ($key === 'looking_for' && $value === $this->service) {
                continue;
            }

            $answers[] = [
                'key' => $key,
                'label' => $label,
                'value' => $value,
            ];
        }

        return $answers;
    }

    /**
     * All extra form answers for read-only admin display (including payload-only keys).
     *
     * @return list<array{key: string, label: string, value: string}>
     */
    public function formAnswerPairs(): array
    {
        $answers = $this->extraAnswers();

        $known = [
            'job_title',
            'asset_title',
            'service',
            'package_selected',
            'looking_for',
            'needed_service',
            'resource_type',
            'hire_when',
            'lead_source',
            'landing_page_title',
            'form_name',
            'name',
            'email',
            'phone',
            'company',
            'message',
            'page_url',
            'g-recaptcha-response',
        ];

        $presented = array_merge(
            $known,
            array_column($answers, 'key'),
        );

        $payload = is_array($this->payload) ? $this->payload : [];

        foreach ($payload as $key => $value) {
            if (! is_string($key) || in_array($key, $presented, true)) {
                continue;
            }

            $stringValue = $this->stringifyPayloadValue($value);

            if ($stringValue === null) {
                continue;
            }

            $answers[] = [
                'key' => $key,
                'label' => str($key)->replace(['_', '-'], ' ')->title()->toString(),
                'value' => $stringValue,
            ];
        }

        return $answers;
    }

    protected function payloadString(string $key): ?string
    {
        $value = data_get($this->payload, $key);

        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }

    protected function stringifyPayloadValue(mixed $value): ?string
    {
        if (is_string($value)) {
            $value = trim($value);

            return $value === '' ? null : $value;
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        if (is_bool($value)) {
            return $value ? 'yes' : 'no';
        }

        if ($value === null) {
            return null;
        }

        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: null;
    }
}
