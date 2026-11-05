<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Services\LandingPageService;
use App\Services\SeoService;
use Illuminate\Http\Response;

class LandingPageController extends Controller
{
    public function __construct(
        protected LandingPageService $landingPageService,
        protected SeoService $seoService,
        protected CmsContentRenderer $renderer,
    ) {}

    public function index(): Response
    {
        $landingPages = $this->landingPageService->paginatePublishedCampaignPages();

        $this->seoService->setCurrent([
            'meta_title' => 'Landing Pages | '.config('app.name'),
            'meta_description' => 'Browse published campaign landing pages for cybersecurity, cloud, and managed services.',
            'og_title' => 'Landing Pages',
            'og_description' => 'Browse published campaign landing pages for cybersecurity, cloud, and managed services.',
            'canonical_url' => route('landing-pages.index'),
            'robots' => 'noindex, nofollow',
        ]);

        return response()->view('landing-pages.index', compact('landingPages'));
    }

    public function show(string $slug): Response
    {
        $landingPage = $this->landingPageService->getPublishedLandingPageBySlug($slug);

        abort_unless($landingPage, 404);

        return $this->renderer->render($landingPage);
    }
}
