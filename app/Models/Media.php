<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = [
        'disk',
        'path',
        'title',
        'alt_text',
        'mime_type',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('created_at');
    }
}

