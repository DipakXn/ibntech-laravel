<?php

namespace App\Support\MediaLibrary;

use Illuminate\Support\Facades\Schema;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LegacyMediaColumns
{
    /**
     * @var array<string, bool>
     */
    private static array $columns = [];

    public static function register(): void
    {
        $model = config('media-library.media_model', Media::class);

        $model::creating(function (Media $media): void {
            if (self::hasColumn('mediable_type') && blank($media->getAttribute('mediable_type'))) {
                $media->setAttribute('mediable_type', $media->model_type);
                $media->setAttribute('mediable_id', $media->model_id);
            }

            if (self::hasColumn('path') && blank($media->getAttribute('path'))) {
                $media->setAttribute('path', $media->file_name ?: 'file');
            }
        });
    }

    private static function hasColumn(string $column): bool
    {
        if (! (self::$columns[$column] ?? false)) {
            self::$columns[$column] = Schema::hasTable('media') && Schema::hasColumn('media', $column);
        }

        return self::$columns[$column];
    }
}
