<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CloudflareSetting extends Model
{
    protected $hidden = [
        'api_token',
    ];

    protected $fillable = [
        'api_token',
        'zone_id',
        'last_purge_type',
        'last_purge_url_count',
        'last_purged_at',
    ];

    protected function casts(): array
    {
        return [
            'api_token' => 'encrypted',
            'last_purge_url_count' => 'integer',
            'last_purged_at' => 'datetime',
        ];
    }
}
