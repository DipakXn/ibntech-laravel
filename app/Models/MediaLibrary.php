<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MediaLibrary extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('library')
            ->useDisk((string) config('media-library.disk_name', 'media'));
    }

    public static function singleton(): self
    {
        $existing = static::query()->first();

        if ($existing instanceof self) {
            return $existing;
        }

        return static::query()->create();
    }
}
