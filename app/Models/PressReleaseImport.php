<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tracks WordPress Press Releases imported into Laravel.
 *
 * Native Laravel Press Releases must never have a row here. Match by
 * source_key (normalized permalink), never update a record that has no mapping.
 */
class PressReleaseImport extends Model
{
    protected $fillable = [
        'source_key',
        'source_url',
        'press_release_id',
        'source_file',
        'checksum',
        'imported_at',
    ];

    protected $casts = [
        'imported_at' => 'datetime',
    ];

    public function pressRelease(): BelongsTo
    {
        return $this->belongsTo(PressRelease::class);
    }
}
