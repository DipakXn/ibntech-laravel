<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthCheckRun extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'trigger',
        'overall',
        'checks',
        'checked_at',
    ];

    protected function casts(): array
    {
        return [
            'checks' => 'array',
            'checked_at' => 'datetime',
        ];
    }
}
