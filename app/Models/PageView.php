<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'visitor_id',
        'visited_at',
        'path',
        'content_type',
        'content_id',
        'referrer_host',
        'country',
        'device',
        'browser',
        'operating_system',
    ];

    protected function casts(): array
    {
        return [
            'visited_at' => 'datetime',
            'content_id' => 'integer',
        ];
    }
}
