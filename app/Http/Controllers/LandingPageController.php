<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Services\LandingPageService;
use Illuminate\Http\Response;

class LandingPageController extends Controller
{
    public function __construct(
        protected LandingPageService $landingPageService,
        protected CmsContentRenderer $renderer,
    ) {}

    public function show(string $slug): Response
    {
        $landingPage = $this->landingPageService->getPublishedLandingPageBySlug($slug);

        abort_unless($landingPage, 404);

        return $this->renderer->render($landingPage);
    }
}
