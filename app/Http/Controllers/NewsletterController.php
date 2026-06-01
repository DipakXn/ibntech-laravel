<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use App\Services\SeoService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class NewsletterController extends Controller
{
    public function __construct(
        protected NewsletterService $newsletterService,
        protected SeoService $seoService
    ) {
    }

    public function index(): Response
    {
        $newsletters = $this->newsletterService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'Newsletters | ' . config('app.name'),
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
        $latestNewsletters = $this->newsletterService->latestPublished();

        abort_unless($newsletter, 404);
        abort_unless(View::exists('newsletters.'.$newsletter->template), 404);

        return response()->view('newsletters.'.$newsletter->template, compact('newsletter', 'latestNewsletters'));
    }
}
