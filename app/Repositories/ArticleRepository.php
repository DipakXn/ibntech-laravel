<?php

namespace App\Repositories;

use App\Models\Article;
use App\Pagination\PathPagePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ArticleRepository
{
    public function latestPublished(int $limit = 3): Collection
    {
        return Article::query()
            ->published()
            ->with(['category', 'media.model'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function paginatePublished(int $perPage = 9, int $page = 1, ?string $path = null): LengthAwarePaginator
    {
        $results = Article::query()
            ->published()
            ->with(['category', 'seoMeta'])
            ->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        if ($path === null) {
            return $results;
        }

        return PathPagePaginator::wrap($results, $path);
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
