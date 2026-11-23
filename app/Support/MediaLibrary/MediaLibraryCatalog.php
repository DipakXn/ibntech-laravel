<?php

namespace App\Support\MediaLibrary;

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\MediaLibrary;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\SeoMeta;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use App\Models\WhitePaper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryCatalog
{
    /**
     * @var list<int>
     */
    public const PER_PAGE_OPTIONS = [10, 25, 50];

    /**
     * @var array<string, string>
     */
    private const IMAGE_FORMATS = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
    ];

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
     * @return array<class-string, string>
     */
    public static function ownerOptions(): array
    {
        return [
            MediaLibrary::class => 'Media Library',
            Blog::class => 'Blogs',
            Article::class => 'Articles',
            Page::class => 'Pages',
            Industry::class => 'Industries',
            LandingPage::class => 'Landing pages',
            Newsletter::class => 'Newsletters',
            CaseStudy::class => 'Case studies',
            Ebook::class => 'eBooks',
            PressRelease::class => 'Press releases',
            WhitePaper::class => 'White papers',
            Testimonial::class => 'Testimonials',
            SeoMeta::class => 'SEO images',
            WebsiteSetting::class => 'Website settings',
        ];
    }

    /**
     * Image fields filter by format. Fields that accept both images and PDFs filter by those kinds.
     *
     * @param  array<int, string>|null  $acceptedFileTypes
     * @return array<string, string>
     */
    public static function kindOptions(?array $acceptedFileTypes): array
    {
        $images = self::wantsImages($acceptedFileTypes);
        $pdfs = self::wantsPdfs($acceptedFileTypes);

        if ($images && $pdfs) {
            return [
                'image' => 'Images',
                'pdf' => 'PDFs',
            ];
        }

        if ($images) {
            return [
                'jpg' => 'JPG',
                'png' => 'PNG',
                'gif' => 'GIF',
                'webp' => 'WebP',
            ];
        }

        return [];
    }

    /**
     * @param  array<int, string>|null  $acceptedFileTypes
     * @return LengthAwarePaginator<int, array{id: int, name: string, extension: string, size: string, preview_url: string|null}>
     */
    public static function browse(
        ?array $acceptedFileTypes,
        ?string $search = null,
        ?string $kind = null,
        ?string $owner = null,
        int $page = 1,
        int $perPage = 10,
    ): LengthAwarePaginator {
        $perPage = in_array($perPage, self::PER_PAGE_OPTIONS, true) ? $perPage : 10;
        $kind = array_key_exists((string) $kind, self::kindOptions($acceptedFileTypes)) ? $kind : null;
        $owner = array_key_exists((string) $owner, self::ownerOptions()) ? $owner : null;
        $query = self::query($acceptedFileTypes, $search, $kind, $owner);
        $total = (clone $query)->count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min(max(1, $page), $total === 0 ? 1 : $lastPage);

        return $query
            ->paginate(perPage: $perPage, pageName: 'libraryPickerPage', page: $page)
            ->through(fn (Media $media): array => self::present($media));
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
    private static function query(?array $acceptedFileTypes, ?string $search, ?string $kind = null, ?string $owner = null): Builder
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

        $format = self::IMAGE_FORMATS[$kind ?? ''] ?? null;

        if ($kind === 'image') {
            $query->where('mime_type', 'like', 'image/%');
        } elseif ($kind === 'pdf') {
            $query->whereIn('mime_type', ['application/pdf', 'application/x-pdf']);
        } elseif ($format !== null) {
            $query->where('mime_type', $format);
        }

        if ($owner !== null && array_key_exists($owner, self::ownerOptions())) {
            $query->where('model_type', $owner);
        }

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
