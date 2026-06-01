<?php

namespace App\Repositories;

use App\Models\Newsletter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class NewsletterRepository
{
    public function latestPublished(int $limit = 3): Collection
    {
        return Newsletter::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function paginatePublished(int $perPage = 9): LengthAwarePaginator
    {
        return Newsletter::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage);
    }

    public function findPublishedBySlug(string $slug): ?Newsletter
    {
        return Cache::remember("newsletter:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return Newsletter::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}
