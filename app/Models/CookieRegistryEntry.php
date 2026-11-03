<?php

namespace App\Models;

use App\Services\CookieConsent\CookieConsentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CookieRegistryEntry extends Model
{
    protected $fillable = [
        'cookie_category_id',
        'name',
        'provider',
        'purpose',
        'duration',
        'domain',
        'privacy_policy_url',
        'integration_key',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CookieCategory::class, 'cookie_category_id');
    }

    protected static function booted(): void
    {
        static::saving(function (CookieRegistryEntry $entry): void {
            $key = strtolower(trim((string) $entry->integration_key));
            $entry->integration_key = preg_match('/^[a-z0-9_-]{2,40}$/', $key) === 1 ? $key : null;

            $url = trim((string) $entry->privacy_policy_url);

            if ($url === '') {
                $entry->privacy_policy_url = null;
            } elseif (! str_starts_with($url, '/') && preg_match('/^https?:\/\//i', $url) !== 1) {
                $entry->privacy_policy_url = null;
            }
        });

        static::saved(function (): void {
            app(CookieConsentRepository::class)->forget();
        });

        static::deleted(function (): void {
            app(CookieConsentRepository::class)->forget();
        });
    }
}
