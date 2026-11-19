<?php

namespace App\Models;

use App\Services\SiteRedirects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentRedirect extends Model
{
    use SoftDeletes;

    public const ORIGIN_MANUAL = 'manual';

    public const ORIGIN_SLUG = 'slug';

    public const ORIGIN_LEGACY = 'legacy';

    public const STATUS_PERMANENT = 301;

    public const STATUS_TEMPORARY = 302;

    public const STATUS_TEMPORARY_STRICT = 307;

    public const STATUS_GONE = 410;

    public const STATUS_LEGAL = 451;

    public const MATCH_EXACT = 'exact';

    public const MATCH_CONTAINS = 'contains';

    public const MATCH_STARTS_WITH = 'starts_with';

    public const MATCH_ENDS_WITH = 'ends_with';

    public const MATCH_REGEX = 'regex';

    /** @var list<string> */
    public const MATCH_TYPES = [
        self::MATCH_EXACT,
        self::MATCH_CONTAINS,
        self::MATCH_STARTS_WITH,
        self::MATCH_ENDS_WITH,
        self::MATCH_REGEX,
    ];

    /** @var list<int> */
    public const RESPONSE_CODES = [
        self::STATUS_PERMANENT,
        self::STATUS_TEMPORARY,
        self::STATUS_TEMPORARY_STRICT,
        self::STATUS_GONE,
        self::STATUS_LEGAL,
    ];

    /** @var list<int> */
    public const REDIRECT_CODES = [
        self::STATUS_PERMANENT,
        self::STATUS_TEMPORARY,
        self::STATUS_TEMPORARY_STRICT,
    ];

    protected $fillable = [
        'source_path',
        'target_path',
        'status_code',
        'match_type',
        'ignore_case',
        'is_active',
        'origin',
        'note',
    ];

    protected $attributes = [
        'status_code' => self::STATUS_PERMANENT,
        'match_type' => self::MATCH_EXACT,
        'ignore_case' => false,
        'is_active' => true,
        'hits' => 0,
        'origin' => self::ORIGIN_MANUAL,
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'ignore_case' => 'boolean',
            'status_code' => 'integer',
            'hits' => 'integer',
            'last_accessed_at' => 'datetime',
        ];
    }

    public static function hidesTarget(int $statusCode): bool
    {
        return in_array($statusCode, [self::STATUS_GONE, self::STATUS_LEGAL], true);
    }

    protected static function booted(): void
    {
        static::saved(function (ContentRedirect $redirect): void {
            $redirects = app(SiteRedirects::class);
            $redirects->forget($redirect->source_path);

            $original = $redirect->getOriginal('source_path');

            if (is_string($original) && $original !== $redirect->source_path) {
                $redirects->forget($original);
            }
        });

        static::deleted(function (ContentRedirect $redirect): void {
            app(SiteRedirects::class)->forget($redirect->source_path);
        });

        static::restored(function (ContentRedirect $redirect): void {
            app(SiteRedirects::class)->forget($redirect->source_path);
        });
    }
}
