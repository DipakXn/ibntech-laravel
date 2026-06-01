<?php

namespace App\Services;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    public function __construct(
        protected BlogRepository $blogs,
        protected SeoService $seoService
    ) {
    }

    public function paginatePublished(?string $categorySlug = null, ?string $search = null): LengthAwarePaginator
    {
        return $this->blogs->paginatePublished($categorySlug, $search);
    }

    public function paginatePublishedForCategoryIds(array $categoryIds): LengthAwarePaginator
    {
        return $this->blogs->paginatePublishedForCategoryIds($categoryIds);
    }

    public function getPublishedBySlug(string $slug): ?Blog
    {
        $blog = $this->blogs->findPublishedBySlug($slug);

        if ($blog) {
            $this->seoService->setCurrentForModel($blog);
        }

        return $blog;
    }

    public function latestPublished(int $limit = 3): Collection
    {
        return $this->blogs->latestPublished($limit);
    }
}
