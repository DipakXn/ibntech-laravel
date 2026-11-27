<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthSignal extends Model
{
    public const SCHEDULER = 'scheduler';

    public const QUEUE_WORKER = 'queue_worker';

    public const SNAPSHOT_LOCK = 'snapshot_lock';

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'key';

    protected $keyType = 'string';

    protected $fillable = [
        'key',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }
}
