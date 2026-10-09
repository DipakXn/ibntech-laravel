<?php

use App\CmsPreview\CmsPreviewType;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\CmsPreviewController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PressReleaseController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WhitePaperController;
use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapType;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', function (WebsiteSettingService $settings) {
    return response($settings->robotsTxtContents(), 200, [
        'Content-Type' => 'text/plain; charset=UTF-8',
        'Cache-Control' => 'no-cache, private',
    ]);
})->name('robots');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap_index.xml', [SitemapController::class, 'legacyIndex'])->name('sitemap.legacy-index');
Route::get('/{file}', [SitemapController::class, 'show'])
    ->where('file', SitemapType::filePattern())
    ->name('sitemap.show');

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/category/{slug}/page/{page}', [BlogController::class, 'categoryPage'])
    ->where('page', '[1-9][0-9]*')
    ->name('blog.category.page');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/article', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/page/{page}', [ArticleController::class, 'page'])
    ->where('page', '[1-9][0-9]*')
    ->name('articles.page');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/case-study', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-study/page/{page}', [CaseStudyController::class, 'page'])
    ->where('page', '[1-9][0-9]*')
    ->name('case-studies.page');
Route::get('/case-study/{slug}', [CaseStudyController::class, 'show'])->name('case-studies.show');
Route::get('/case-study/{slug}/download', [CaseStudyController::class, 'download'])->name('case-studies.download');
Route::get('/ebook', [EbookController::class, 'index'])->name('ebooks.index');
Route::get('/ebook/page/{page}', [EbookController::class, 'page'])
    ->where('page', '[1-9][0-9]*')
    ->name('ebooks.page');
Route::get('/ebook/{slug}', [EbookController::class, 'show'])->name('ebooks.show');
Route::get('/ebook/{slug}/download', [EbookController::class, 'download'])->name('ebooks.download');
Route::get('/pressrelease', [PressReleaseController::class, 'index'])->name('pressrelease.index');
Route::get('/pressrelease/page/{page}', [PressReleaseController::class, 'page'])
    ->where('page', '[1-9][0-9]*')
    ->name('pressrelease.page');
Route::get('/pressrelease/{slug}', [PressReleaseController::class, 'show'])
    ->where('slug', '^(?!page$).+')
    ->name('pressrelease.show');
Route::get('/whitepapers', [WhitePaperController::class, 'index'])->name('white-papers.index');
Route::get('/whitepapers/page/{page}', [WhitePaperController::class, 'page'])
    ->where('page', '[1-9][0-9]*')
    ->name('white-papers.page');
Route::get('/whitepapers/{slug}', [WhitePaperController::class, 'show'])->name('white-papers.show');
Route::get('/industry/{slug}', [IndustryController::class, 'show'])->name('industries.show');
Route::get('/lp/{slug}', [LandingPageController::class, 'show'])->name('landing-pages.show');
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletters.index');
Route::get('/newsletter/{slug}', [NewsletterController::class, 'show'])->name('newsletters.show');
Route::redirect('/contact', '/contact-us/', 301);
Route::redirect('/contact/contact-us', '/contact-us/', 301);

Route::get('/preview/{type}/{id}', [CmsPreviewController::class, 'show'])
    ->whereIn('type', CmsPreviewType::values())
    ->where('id', '[0-9]+')
    ->name('cms.preview.show');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '^(?!admin$|article$|blog$|case-study$|ebook$|ibn-tech-cms-login$|industry$|lp$|newsletter$|pressrelease$|press-releases$|preview$|whitepapers$|livewire$|storage$|up$|sitemap(?:_index)?\\.xml$|(?:page|post|category|article|case-study|ebook|white-paper|press-release|industry|lp|newsletter|custom)-sitemap\\d*\\.xml$).+')
    ->name('page.show');
