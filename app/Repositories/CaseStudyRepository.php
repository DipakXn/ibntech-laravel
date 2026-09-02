<?php

namespace App\Repositories;

use App\Models\CaseStudy;
use App\Pagination\PathPagePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
}
