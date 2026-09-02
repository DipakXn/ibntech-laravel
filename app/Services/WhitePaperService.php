<?php

namespace App\Services;

use App\Models\WhitePaper;
use App\Repositories\WhitePaperRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WhitePaperService
{
    public function __construct(
        protected WhitePaperRepository $whitePapers,
        protected SeoService $seoService,
    ) {}

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
