<?php

namespace App\Repositories;

use App\Models\Ebook;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EbookRepository
{
    public function paginatePublished(int $perPage = 9): LengthAwarePaginator
    {
        return Ebook::query()
            ->published()
            ->with('seoMeta')
            ->latest()
            ->paginate($perPage);
    }

    public function findPublishedBySlug(string $slug): ?Ebook
    {
        return Cache::remember("ebook:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return Ebook::query()
                ->published()
                ->with('seoMeta')
                ->where('slug', $slug)
                ->first();
        });
    }
}
