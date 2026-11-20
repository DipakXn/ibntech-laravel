<?php

namespace App\Support\MediaLibrary;

use App\Models\MediaLibrary;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryCatalog
{
    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     * @return array<int|string, string>
     */
    public static function options(?array $acceptedFileTypes, ?string $search = null): array
    {
        return self::query($acceptedFileTypes, $search)
            ->limit(50)
            ->get()
            ->mapWithKeys(fn (Media $media): array => [
                $media->getKey() => self::label($media),
            ])
            ->all();
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     * @return list<array{id: int, name: string, extension: string, size: string, preview_url: string|null}>
     */
    public static function cards(?array $acceptedFileTypes, ?string $search = null): array
    {
        return self::query($acceptedFileTypes, $search)
            ->limit(60)
            ->get()
            ->map(fn (Media $media): array => self::present($media))
            ->values()
            ->all();
    }

    /**
     * @return array{id: int, name: string, extension: string, size: string, preview_url: string|null}
     */
    public static function present(Media $media): array
    {
        return [
            'id' => (int) $media->getKey(),
            'name' => (string) $media->file_name,
            'extension' => self::extension($media),
            'size' => self::sizeLabel($media),
            'preview_url' => self::previewUrl($media),
        ];
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     * @return Builder<Media>
     */
    private static function query(?array $acceptedFileTypes, ?string $search): Builder
    {
        $query = Media::query()->with('model')->latest('id');
        $wantsImages = self::wantsImages($acceptedFileTypes);
        $wantsPdfs = self::wantsPdfs($acceptedFileTypes);

        $query->where(function (Builder $query) use ($wantsImages, $wantsPdfs): void {
            if ($wantsImages) {
                $query->orWhere('mime_type', 'like', 'image/%');
            }

            if ($wantsPdfs) {
                $query->orWhereIn('mime_type', ['application/pdf', 'application/x-pdf']);
            }
        });

        $search = trim((string) $search);

        if ($search !== '') {
            $like = '%'.addcslashes($search, '%_\\').'%';
            $query->where(function (Builder $query) use ($like): void {
                $query->where('file_name', 'like', $like)
                    ->orWhere('name', 'like', $like);
            });
        }

        return $query;
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     */
    private static function wantsImages(?array $acceptedFileTypes): bool
    {
        if ($acceptedFileTypes === null || $acceptedFileTypes === []) {
            return true;
        }

        foreach ($acceptedFileTypes as $type) {
            $type = strtolower($type);

            if ($type === 'image/*' || str_starts_with($type, 'image/')) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     */
    private static function wantsPdfs(?array $acceptedFileTypes): bool
    {
        if ($acceptedFileTypes === null || $acceptedFileTypes === []) {
            return true;
        }

        foreach ($acceptedFileTypes as $type) {
            $type = strtolower($type);

            if (in_array($type, ['application/pdf', 'application/x-pdf', '.pdf'], true)) {
                return true;
            }
        }

        return false;
    }

    private static function label(Media $media): string
    {
        $owner = $media->model;
        $ownerLabel = $owner instanceof MediaLibrary
            ? 'Library'
            : class_basename($owner ?? 'File');

        return $media->file_name.' ('.$ownerLabel.')';
    }

    private static function extension(Media $media): string
    {
        $extension = strtolower((string) pathinfo((string) $media->file_name, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg' => 'JPG',
            '' => 'FILE',
            default => strtoupper($extension),
        };
    }

    private static function sizeLabel(Media $media): string
    {
        $bytes = (int) $media->size;

        if ($bytes <= 0) {
            return '—';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1).' MB';
        }

        return number_format($bytes / 1024, 0).' KB';
    }

    private static function previewUrl(Media $media): ?string
    {
        if (! str_starts_with((string) $media->mime_type, 'image/')) {
            return null;
        }

        try {
            return $media->getUrl();
        } catch (\Throwable) {
            return null;
        }
    }
}
