<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public const MODULE_BLOG = 'blog';

    public const MODULE_CASE_STUDY = 'case_study';

    public const MODULE_EBOOK = 'ebook';

    public const MODULE_PRESS_RELEASE = 'press_release';

    public const MODULE_WHITE_PAPER = 'white_paper';

    public const MODULE_ARTICLE = 'article';

    protected $fillable = [
        'name',
        'slug',
        'module',
        'parent_id',
    ];

    public static function moduleOptions(): array
    {
        return [
            self::MODULE_BLOG => 'Blogs',
            self::MODULE_CASE_STUDY => 'Case Studies',
            self::MODULE_EBOOK => 'eBooks',
            self::MODULE_PRESS_RELEASE => 'Press Releases',
            self::MODULE_WHITE_PAPER => 'White Papers',
            self::MODULE_ARTICLE => 'Articles',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function scopeForModule(Builder $query, string $module): Builder
    {
        return $query->where('module', $module);
    }

    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Walk up to the top-level (parent) category. Roots return themselves.
     */
    public function root(): self
    {
        $category = $this;
        $guard = 0;

        while ($category->parent_id && $guard < 10) {
            $category->loadMissing('parent');

            if (! $category->parent instanceof self) {
                break;
            }

            $category = $category->parent;
            $guard++;
        }

        return $category;
    }

    public function selfAndDescendantIds(): array
    {
        $this->loadMissing('childrenRecursive');

        $ids = [$this->id];

        $collect = function ($categories) use (&$collect, &$ids): void {
            foreach ($categories as $category) {
                $ids[] = $category->id;
                $collect($category->childrenRecursive);
            }
        };

        $collect($this->childrenRecursive);

        return array_values(array_unique($ids));
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->latest('created_at');
    }
}
