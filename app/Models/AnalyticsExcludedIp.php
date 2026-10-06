<?php

namespace App\Models;

use App\Services\Analytics\ExcludedIpMatcher;
use App\Services\Analytics\IpNetwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class AnalyticsExcludedIp extends Model
{
    protected $fillable = [
        'ip_address',
        'description',
        'is_enabled',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $record): void {
            $normalized = IpNetwork::normalize((string) $record->ip_address);

            if ($normalized === null) {
                throw ValidationException::withMessages([
                    'ip_address' => 'Enter a valid IPv4 address, IPv6 address, or CIDR range.',
                ]);
            }

            $record->ip_address = $normalized;

            $description = is_string($record->description) ? trim($record->description) : null;
            $record->description = $description === '' ? null : $description;
        });

        static::saved(fn () => ExcludedIpMatcher::flush());
        static::deleted(fn () => ExcludedIpMatcher::flush());
    }
}
