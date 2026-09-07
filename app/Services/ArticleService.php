<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    public function __construct(
        protected ArticleRepository $articles,
        protected SeoService $seoService,
    ) {}

    public function latestPublished(int $limit = 3): Collection
    {
        return $this->articles->latestPublished($limit);
    }

    public function paginatePublished(int $page = 1, ?string $path = null, int $perPage = 9): LengthAwarePaginator
    {
        return $this->articles->paginatePublished($perPage, $page, $path);
    }

    public function getPublishedBySlug(string $slug): ?Article
    {
        $article = $this->articles->findPublishedBySlug($slug);

        if ($article) {
            $this->seoService->setCurrentForModel($article);
        }

        return $article;
    }
}
