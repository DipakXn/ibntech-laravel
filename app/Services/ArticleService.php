<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function __construct(
        protected ArticleRepository $articles,
        protected SeoService $seoService,
    ) {
    }

    public function paginatePublished(): LengthAwarePaginator
    {
        return $this->articles->paginatePublished();
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
