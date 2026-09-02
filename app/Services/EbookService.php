<?php

namespace App\Services;

use App\Models\Ebook;
use App\Repositories\EbookRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EbookService
{
    public function __construct(
        protected EbookRepository $ebooks,
        protected SeoService $seoService,
    ) {}

    public function paginatePublished(int $page = 1, ?string $path = null, int $perPage = 9): LengthAwarePaginator
    {
        return $this->ebooks->paginatePublished($perPage, $page, $path);
    }

    public function getPublishedBySlug(string $slug): ?Ebook
    {
        $ebook = $this->ebooks->findPublishedBySlug($slug);

        if ($ebook) {
            $this->seoService->setCurrentForModel($ebook);
        }

        return $ebook;
    }
}
