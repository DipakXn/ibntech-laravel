<?php

namespace App\Repositories;

use App\Models\CaseStudy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CaseStudyRepository
{
    public function paginatePublished(int $perPage = 9): LengthAwarePaginator
    {
        return CaseStudy::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage);
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
