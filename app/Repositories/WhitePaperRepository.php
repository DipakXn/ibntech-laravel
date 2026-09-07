<?php

namespace App\Repositories;

use App\Models\WhitePaper;
use App\Pagination\PathPagePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class WhitePaperRepository
{
    public function latestPublished(int $limit = 1): Collection
    {
        return WhitePaper::query()
            ->published()
            ->with(['category', 'media.model'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function paginatePublished(int $perPage = 9, int $page = 1, ?string $path = null): LengthAwarePaginator
    {
        $results = WhitePaper::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        if ($path === null) {
            return $results;
        }

        return PathPagePaginator::wrap($results, $path);
    }

    public function findPublishedBySlug(string $slug): ?WhitePaper
    {
        return Cache::remember("white-paper:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return WhitePaper::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}
