<?php

namespace App\Models;

use App\Services\CookieConsent\CookieConsentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CookieCategory extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
        'details',
        'is_mandatory',
        'is_enabled',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_mandatory' => 'boolean',
            'is_enabled' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(CookieRegistryEntry::class);
    }

    public function isNecessary(): bool
    {
        return $this->key === 'necessary';
    }

    protected static function booted(): void
    {
        static::saving(function (CookieCategory $category): void {
            if ($category->key === 'necessary') {
                $category->is_mandatory = true;
                $category->is_enabled = true;
            }
        });

        static::saved(function (CookieCategory $category): void {
            if ($category->wasChanged(['is_enabled', 'is_mandatory'])) {
                CookieConsentSetting::query()->increment('config_version');
            }

            app(CookieConsentRepository::class)->forget();
        });

        static::deleted(function (): void {
            app(CookieConsentRepository::class)->forget();
        });
    }
}
