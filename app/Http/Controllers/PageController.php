<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Services\PageService;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function __construct(
        protected PageService $pageService,
        protected CmsContentRenderer $renderer,
    ) {}

    public function home(): Response
    {
        $page = $this->pageService->getHomePage();

        abort_unless($page, 404);

        return $this->renderer->render($page);
    }

    public function show(string $slug): Response
    {
        $page = $this->pageService->getPublishedPageBySlug($slug);

        abort_unless($page, 404);

        return $this->renderer->render($page);
    }
}
