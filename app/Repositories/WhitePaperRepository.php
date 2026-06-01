<?php

namespace App\Repositories;

use App\Models\WhitePaper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class WhitePaperRepository
{
    public function paginatePublished(int $perPage = 9): LengthAwarePaginator
    {
        return WhitePaper::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage);
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
