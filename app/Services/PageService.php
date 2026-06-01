<?php

namespace App\Services;

use App\Models\Page;
use App\Repositories\PageRepository;

class PageService
{
    public function __construct(
        protected PageRepository $pages,
        protected SeoService $seoService
    ) {
    }

    public function getHomePage(): ?Page
    {
        $page = $this->pages->getHomePage();

        if ($page) {
            $this->seoService->setCurrentForModel($page);
        }

        return $page;
    }

    public function getPublishedPageBySlug(string $slug): ?Page
    {
        $page = $this->pages->findPublishedBySlug($slug);

        if ($page) {
            $this->seoService->setCurrentForModel($page);
        }

        return $page;
    }
}

