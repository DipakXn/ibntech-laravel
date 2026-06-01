<?php

namespace App\Services;

use App\Models\Newsletter;
use App\Repositories\NewsletterRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewsletterService
{
    public function __construct(
        protected NewsletterRepository $newsletters,
        protected SeoService $seoService
    ) {
    }

    public function paginatePublished(): LengthAwarePaginator
    {
        return $this->newsletters->paginatePublished();
    }

    public function latestPublished(int $limit = 3): Collection
    {
        return $this->newsletters->latestPublished($limit);
    }

    public function getPublishedBySlug(string $slug): ?Newsletter
    {
        $newsletter = $this->newsletters->findPublishedBySlug($slug);

        if ($newsletter) {
            $this->seoService->setCurrentForModel($newsletter);
        }

        return $newsletter;
    }
}
