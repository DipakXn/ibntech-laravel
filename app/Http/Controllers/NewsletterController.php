<?php

namespace App\Http\Controllers;

use App\CmsPreview\CmsContentRenderer;
use App\Services\NewsletterService;
use App\Services\SeoService;
use Illuminate\Http\Response;

class NewsletterController extends Controller
{
    public function __construct(
        protected NewsletterService $newsletterService,
        protected SeoService $seoService,
        protected CmsContentRenderer $renderer,
    ) {}

    public function index(): Response
    {
        $newsletters = $this->newsletterService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'Newsletters | '.config('app.name'),
            'meta_description' => 'Browse published newsletters, expert takeaways, and insight-led commentary.',
            'og_title' => 'Newsletters',
            'og_description' => 'Browse published newsletters, expert takeaways, and insight-led commentary.',
            'canonical_url' => route('newsletters.index'),
            'robots' => 'noindex, nofollow',
        ]);

        return response()->view('newsletters.index', compact('newsletters'));
    }

    public function show(string $slug): Response
    {
        $newsletter = $this->newsletterService->getPublishedBySlug($slug);

        abort_unless($newsletter, 404);

        return $this->renderer->render($newsletter);
    }
}
