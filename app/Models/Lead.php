<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'form_submissions';

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
        'message',
        'page_url',
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

    protected function payloadString(string $key): ?string
    {
        $value = data_get($this->payload, $key);

        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }
}
