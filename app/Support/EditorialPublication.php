<?php

namespace App\Support;

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EditorialPublication
{
    public const DRAFT = 'draft';

    public const SCHEDULED = 'scheduled';

    public const PUBLISHED = 'published';

    public const PUBLISH_DATE_HELP = 'A future date stays offline until that time, then the scheduler marks it Published. Drafts are never auto-published. Laravel created_at is not changed.';

    public const BLOG_PUBLISH_DATE_HELP = 'A future date stays offline until that time, then the scheduler marks it Published. Drafts are never auto-published. WordPress imports store the original publish date here. Laravel created_at is not changed.';

    /**
     * @return array<string, class-string<Model>>
     */
    public static function modelsByPrefix(): array
    {
        return [
            'blog' => Blog::class,
            'article' => Article::class,
            'case-study' => CaseStudy::class,
            'ebook' => Ebook::class,
            'pressrelease' => PressRelease::class,
            'whitepapers' => WhitePaper::class,
        ];
    }

    /**
     * @return list<class-string<Model>>
     */
    public static function models(): array
    {
        return array_values(self::modelsByPrefix());
    }

    /**
     * @return class-string<Model>|null
     */
    public static function modelForPrefix(string $prefix): ?string
    {
        return self::modelsByPrefix()[$prefix] ?? null;
    }

    public static function appliesTo(Model $model): bool
    {
        return in_array($model::class, self::models(), true);
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::DRAFT => 'Draft',
            self::SCHEDULED => 'Scheduled',
            self::PUBLISHED => 'Published',
        ];
    }

    /**
     * @return list<string>
     */
    public static function reservedStatuses(): array
    {
        return [self::PUBLISHED, self::SCHEDULED];
    }

    public static function badgeColor(?string $status): string
    {
        return match ($status) {
            self::PUBLISHED => 'success',
            self::SCHEDULED => 'warning',
            default => 'gray',
        };
    }

    public static function normalizeStatus(?string $status, mixed $publishedAt): string
    {
        $status = $status ?: self::DRAFT;

        if ($status === self::DRAFT) {
            return self::DRAFT;
        }

        $at = self::asCarbon($publishedAt);

        if ($at instanceof CarbonInterface && $at->greaterThan(now())) {
            return self::SCHEDULED;
        }

        if ($status === self::SCHEDULED && $at instanceof CarbonInterface && $at->lessThanOrEqualTo(now())) {
            return self::PUBLISHED;
        }

        return $status;
    }

    /**
     * An empty publish date stays public, matching the existing created_at fallback.
     * A future instant is not due yet.
     */
    public static function isDue(mixed $publishedAt): bool
    {
        $at = self::asCarbon($publishedAt);

        return ! $at instanceof CarbonInterface || $at->lessThanOrEqualTo(now());
    }

    private static function asCarbon(mixed $publishedAt): ?CarbonInterface
    {
        if ($publishedAt instanceof CarbonInterface) {
            return $publishedAt;
        }

        if ($publishedAt instanceof DateTimeInterface) {
            return Carbon::instance($publishedAt);
        }

        if (is_string($publishedAt) && $publishedAt !== '') {
            return Carbon::parse($publishedAt);
        }

        return null;
    }
}
