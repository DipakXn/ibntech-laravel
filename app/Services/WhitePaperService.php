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
    ) {
    }

    public function paginatePublished(): LengthAwarePaginator
    {
        return $this->whitePapers->paginatePublished();
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
