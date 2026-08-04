<?php

namespace App\Support\MediaLibrary;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaPathResolver
{
    /**
     * Resolve the storage directory for a media item (no trailing slash).
     */
    public static function forMedia(Media $media): string
    {
        $model = $media->model;
        $modelType = $media->model_type;

        if ($model instanceof Model) {
            $modelType = $model::class;
        }

        return static::resolve(
            modelType: is_string($modelType) ? $modelType : null,
            collection: $media->collection_name,
            model: $model instanceof Model ? $model : null,
            date: static::resolveMediaDate($media),
        );
    }

    /**
     * Resolve the storage directory from Filament upload context.
     */
    public static function forUpload(?string $modelType, ?string $collection, ?Model $model = null): string
    {
        return static::resolve(
            modelType: $modelType,
            collection: $collection,
            model: $model,
            date: now(),
        );
    }

    public static function resolve(
        ?string $modelType,
        ?string $collection,
        ?Model $model = null,
        ?Carbon $date = null,
    ): string {
        $date ??= now();
        $collection ??= 'default';
        $map = config('media-library.path_map', []);

        $template = null;

        if ($modelType && isset($map[$modelType][$collection])) {
            $template = $map[$modelType][$collection];
        } elseif ($modelType && isset($map[$modelType]['*'])) {
            $template = $map[$modelType]['*'];
        } elseif (isset($map['*'][$collection])) {
            $template = $map['*'][$collection];
        } else {
            $template = (string) config('media-library.fallback_path', 'media/miscellaneous/{YYYY}/{MM}');
        }

        return static::interpolate($template, $model, $date);
    }

    protected static function interpolate(string $template, ?Model $model, Carbon $date): string
    {
        $slug = static::resolveSlug($model);

        $replacements = [
            '{YYYY}' => $date->format('Y'),
            '{MM}' => $date->format('m'),
            '{slug}' => $slug,
            '{model}' => $model ? Str::kebab(class_basename($model)) : 'misc',
        ];

        $path = strtr($template, $replacements);
        $prefix = trim((string) config('media-library.prefix', ''), '/');

        if ($prefix !== '') {
            $path = $prefix.'/'.$path;
        }

        return trim(preg_replace('#/+#', '/', $path) ?? $path, '/');
    }

    protected static function resolveSlug(?Model $model): string
    {
        if (! $model) {
            return 'unsorted';
        }

        foreach (['slug', 'key', 'name'] as $attribute) {
            $value = $model->getAttribute($attribute);

            if (is_string($value) && trim($value) !== '') {
                return Str::slug($value);
            }
        }

        if ($model->getKey()) {
            return (string) $model->getKey();
        }

        return 'unsorted';
    }

    protected static function resolveMediaDate(Media $media): Carbon
    {
        if ($media->created_at instanceof Carbon) {
            return $media->created_at;
        }

        if (! empty($media->created_at)) {
            return Carbon::parse($media->created_at);
        }

        return now();
    }
}
