<?php

namespace App\Models;

use App\Services\CookieConsent\CookieConsentRepository;
use Illuminate\Database\Eloquent\Model;

class CookieIntegration extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
        'category_key',
        'consent_categories',
        'is_enabled',
        'environments',
        'measurement_id',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'consent_categories' => 'array',
            'is_enabled' => 'boolean',
            'environments' => 'array',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (CookieIntegration $integration): void {
            $allowed = config('cookie-consent.environments', []);

            $integration->environments = array_values(array_intersect(
                array_map('strval', (array) $integration->environments),
                is_array($allowed) ? $allowed : [],
            ));

            if ($integration->key === 'recaptcha') {
                $integration->category_key = 'necessary';
                $integration->consent_categories = ['necessary'];
            } elseif ($integration->key === 'gtm') {
                $categories = array_values(array_intersect(
                    array_map('strval', (array) $integration->consent_categories),
                    ['analytics', 'marketing', 'functional'],
                ));
                $integration->consent_categories = $categories === []
                    ? ['analytics', 'marketing']
                    : $categories;
                $integration->category_key = 'mixed';
            } else {
                if (! in_array($integration->category_key, ['analytics', 'marketing', 'functional'], true)) {
                    $integration->category_key = 'analytics';
                }

                $integration->consent_categories = [$integration->category_key];
            }

            if (in_array($integration->key, ['google_ads', 'linkedin'], true)) {
                $id = trim((string) $integration->measurement_id);
                $integration->measurement_id = preg_match('/^[A-Za-z0-9_-]{2,40}$/', $id) === 1 ? $id : null;
            } else {
                $integration->measurement_id = null;
            }
        });

        static::saved(function (CookieIntegration $integration): void {
            if ($integration->wasChanged(['category_key', 'consent_categories', 'is_enabled'])) {
                CookieConsentSetting::query()->increment('config_version');
            }

            app(CookieConsentRepository::class)->forget();
        });
    }
}
