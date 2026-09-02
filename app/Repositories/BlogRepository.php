<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Pagination\PathPagePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository
{
    public function paginatePublished(?string $categorySlug = null, ?string $search = null, int $perPage = 9): LengthAwarePaginator
    {
        return Blog::query()
            ->published()
            ->with(['category', 'seoMeta', 'media'])
            ->when($categorySlug, function ($query) use ($categorySlug) {
                $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $categorySlug));
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function paginatePublishedForCategoryIds(
        array $categoryIds,
        int $perPage = 15,
        int $page = 1,
        ?string $path = null
    ): LengthAwarePaginator {
        $results = Blog::query()
            ->published()
            ->with(['category', 'seoMeta', 'media'])
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->paginate($perPage, ['*'], 'page', $page);

        if ($path === null) {
            return $results;
        }

        return PathPagePaginator::wrap($results, $path);
    }

    public function findPublishedBySlug(string $slug): ?Blog
    {
        return Blog::query()
            ->published()
            ->with(['category.parent', 'seoMeta', 'media'])
            ->where('slug', $slug)
            ->first();
    }

    public function latestPublished(int $limit = 3): Collection
    {
        return Blog::query()
            ->published()
            ->with(['category', 'media'])
            ->latest()
            ->limit($limit)
            ->get();
    }
}
