<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\SeoService;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService,
        protected SeoService $seoService,
    ) {
    }

    public function index(): Response
    {
        $articles = $this->articleService->paginatePublished();

        $this->seoService->setCurrent([
            'meta_title' => 'Articles | ' . config('app.name'),
            'meta_description' => 'Browse expert articles, practical explainers, and editorial insights from the team.',
            'og_title' => 'Articles',
            'og_description' => 'Browse expert articles, practical explainers, and editorial insights from the team.',
            'canonical_url' => route('articles.index'),
        ]);

        return response()->view('articles.index', compact('articles'));
    }

    public function show(string $slug): Response
    {
        $article = $this->articleService->getPublishedBySlug($slug);

        abort_unless($article, 404);

        return response()->view('articles.templates.' . $article->template, compact('article'));
    }
}
