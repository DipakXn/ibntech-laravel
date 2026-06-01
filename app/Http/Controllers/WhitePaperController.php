<?php

namespace App\Http\Controllers;

use App\Services\SeoService;
use App\Services\WhitePaperService;
use Illuminate\Http\Response;

class WhitePaperController extends Controller
{
    public function __construct(
        protected WhitePaperService $whitePaperService,
        protected SeoService $seoService,
    ) {
    }

    public function index(): Response
    {
        $whitePapers = $this->whitePaperService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'White Papers | ' . config('app.name'),
            'meta_description' => 'Research-led white papers, reports, and strategic resources from the team.',
            'og_title' => 'White Papers',
            'og_description' => 'Research-led white papers, reports, and strategic resources from the team.',
            'canonical_url' => route('white-papers.index'),
        ]);

        return response()->view('white-papers.index', compact('whitePapers'));
    }

    public function show(string $slug): Response
    {
        $whitePaper = $this->whitePaperService->getPublishedBySlug($slug);

        abort_unless($whitePaper, 404);

        return response()->view('white-papers.templates.' . $whitePaper->template, compact('whitePaper'));
    }
}
