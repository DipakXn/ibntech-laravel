<?php

namespace App\Models;

use App\Services\CookieConsent\CookieConsentRepository;
use App\Services\CookieConsent\JurisdictionResolver;
use Illuminate\Database\Eloquent\Model;

class CookieConsentSetting extends Model
{
    protected $fillable = [
        'banner_enabled',
        'banner_position',
        'consent_lifetime_days',
        'policy_version',
        'config_version',
        'privacy_policy_url',
        'cookie_policy_url',
        'banner_title',
        'banner_text',
        'accept_label',
        'reject_label',
        'settings_label',
        'save_label',
        'modal_title',
        'modal_text',
        'jurisdiction_mode',
        'jurisdiction_rules',
    ];

    protected function casts(): array
    {
        return [
            'banner_enabled' => 'boolean',
            'consent_lifetime_days' => 'integer',
            'config_version' => 'integer',
            'jurisdiction_rules' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (CookieConsentSetting $setting): void {
            $setting->banner_position = 'bottom';
            $setting->jurisdiction_mode = JurisdictionResolver::OPT_IN;
            $setting->consent_lifetime_days = max(1, min(730, (int) $setting->consent_lifetime_days));
            $setting->policy_version = trim((string) $setting->policy_version) ?: '1';
            $setting->jurisdiction_rules = self::normalizeRules($setting->jurisdiction_rules);
        });

        static::saved(function (): void {
            app(CookieConsentRepository::class)->forget();
        });
    }

    /**
     * @return list<array{countries: list<string>, mode: string}>
     */
    public static function normalizeRules(mixed $rules): array
    {
        if (! is_array($rules)) {
            return [];
        }

        $normalized = [];

        foreach ($rules as $rule) {
            if (! is_array($rule)) {
                continue;
            }

            $mode = $rule['mode'] ?? null;

            if (! in_array($mode, [JurisdictionResolver::OPT_IN, JurisdictionResolver::NOTICE], true)) {
                continue;
            }

            $countries = [];
            $rawCountries = $rule['countries'] ?? [];

            if (is_string($rawCountries)) {
                $rawCountries = preg_split('/\s*,\s*/', $rawCountries) ?: [];
            }

            foreach ((array) $rawCountries as $country) {
                $country = strtoupper(trim((string) $country));

                if (preg_match('/^[A-Z]{2}$/', $country) === 1) {
                    $countries[] = $country;
                }
            }

            $countries = array_values(array_unique($countries));

            if ($countries === []) {
                continue;
            }

            $normalized[] = [
                'countries' => $countries,
                'mode' => $mode,
            ];
        }

        return $normalized;
    }
}
