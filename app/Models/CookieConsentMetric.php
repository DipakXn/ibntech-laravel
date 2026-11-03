<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookieConsentMetric extends Model
{
    protected $fillable = [
        'accept_all_count',
        'reject_all_count',
        'custom_count',
        'withdrawal_count',
    ];

    protected function casts(): array
    {
        return [
            'accept_all_count' => 'integer',
            'reject_all_count' => 'integer',
            'custom_count' => 'integer',
            'withdrawal_count' => 'integer',
        ];
    }

    public static function record(string $action): void
    {
        $column = match ($action) {
            'accept_all' => 'accept_all_count',
            'reject_all' => 'reject_all_count',
            'custom' => 'custom_count',
            'withdrawal' => 'withdrawal_count',
            default => null,
        };

        if ($column === null) {
            return;
        }

        $metric = static::query()->first();

        if (! $metric) {
            $metric = static::query()->create([
                'accept_all_count' => 0,
                'reject_all_count' => 0,
                'custom_count' => 0,
                'withdrawal_count' => 0,
            ]);
        }

        $metric->increment($column);
    }
}
