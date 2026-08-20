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
        'header-contact-modal' => 'Header Contact Modal',
        'vapt-services-quote' => 'VAPT Services Quote',
        'vapt-pricing-quote' => 'VAPT Pricing Quote',
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
}
