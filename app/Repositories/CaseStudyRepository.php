<?php

namespace App\Repositories;

use App\Models\CaseStudy;
use App\Models\Category;
use App\Pagination\PathPagePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CaseStudyRepository
{
    public function paginatePublished(int $perPage = 9, int $page = 1, ?string $path = null): LengthAwarePaginator
    {
        $results = CaseStudy::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        if ($path === null) {
            return $results;
        }

        return PathPagePaginator::wrap($results, $path);
    }

    public function findPublishedBySlug(string $slug): ?CaseStudy
    {
        return Cache::remember("case-study:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return CaseStudy::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }

    /**
     * Get published case studies assigned to a category slug (or all categories if null).
     *
     * @return Collection<int, CaseStudy>
     */
    public function getPublishedByCategorySlug(
        ?string $categorySlug = null,
        ?int $limit = null,
        bool $childOnly = false,
        bool $includeChildren = false
    ): Collection {
        return CaseStudy::query()
            ->published()
            ->when($categorySlug !== null, function ($query) use ($categorySlug, $childOnly, $includeChildren) {
                $query->whereHas('category', function ($subQuery) use ($categorySlug, $childOnly, $includeChildren) {
                    $subQuery->where('module', Category::MODULE_CASE_STUDY);

                    if ($includeChildren) {
                        $subQuery->where(function ($sub) use ($categorySlug) {
                            $sub->where('slug', $categorySlug)
                                ->orWhereHas('parent', function ($parent) use ($categorySlug) {
                                    $parent->where('module', Category::MODULE_CASE_STUDY)
                                        ->where('slug', $categorySlug);
                                });
                        });
                    } else {
                        $subQuery->where('slug', $categorySlug);
                    }

                    if ($childOnly) {
                        $subQuery->whereNotNull('parent_id');
                    }
                });
            })
            ->with(['media.model', 'category'])
            ->latest()
            ->when($limit !== null, fn ($query) => $query->limit($limit))
            ->get();
    }

    public function latestPublished(int $limit = 1): Collection
    {
        return $this->getPublishedByCategorySlug(limit: $limit);
    }
}
