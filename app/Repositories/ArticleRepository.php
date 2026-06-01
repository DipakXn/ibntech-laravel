<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ArticleRepository
{
    public function paginatePublished(int $perPage = 9): LengthAwarePaginator
    {
        return Article::query()
            ->published()
            ->with(['category', 'seoMeta'])
            ->latest()
            ->paginate($perPage);
    }

    public function findPublishedBySlug(string $slug): ?Article
    {
        return Cache::remember("article:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return Article::query()
                ->published()
                ->with(['category', 'seoMeta'])
                ->where('slug', $slug)
                ->first();
        });
    }
}
