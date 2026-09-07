<?php

namespace App\Services;

use App\Models\WhitePaper;
use App\Repositories\WhitePaperRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WhitePaperService
{
    public function __construct(
        protected WhitePaperRepository $whitePapers,
        protected SeoService $seoService,
    ) {}

    public function latestPublished(int $limit = 1): Collection
    {
        return $this->whitePapers->latestPublished($limit);
    }

    public function paginatePublished(int $page = 1, ?string $path = null, int $perPage = 9): LengthAwarePaginator
    {
        return $this->whitePapers->paginatePublished($perPage, $page, $path);
    }

    public function getPublishedBySlug(string $slug): ?WhitePaper
    {
        $whitePaper = $this->whitePapers->findPublishedBySlug($slug);

        if ($whitePaper) {
            $this->seoService->setCurrentForModel($whitePaper);
        }

        return $whitePaper;
    }
}
