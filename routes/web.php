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
Route::get('/lp', [LandingPageController::class, 'index'])->name('landing-pages.index');
Route::get('/lp/{slug}', [LandingPageController::class, 'show'])->name('landing-pages.show');
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletters.index');
Route::get('/newsletter/{slug}', [NewsletterController::class, 'show'])->name('newsletters.show');


// Redirections
Route::redirect('/contact', '/contact-us/', 301);
Route::redirect('/contact/contact-us', '/contact-us/', 301);
Route::redirect('/white-paper-2', '/whitepapers/how-cfos-benefit-from-profitcents/', 301);
Route::redirect('/white-paper-3', '/whitepapers/how-ibn-helping-cfos-by-combining-efforts-with-profitcents/', 301);
Route::redirect('/case-studies', '/case-study/', 301);
Route::redirect('/9-best-payroll-service-providers/', '/blog/9-best-payroll-service-providers/', 301);
Route::redirect('/case-studies-6', '/case-study/', 301);
Route::redirect('/construction-accounting-trends-for-2024', '/blog/construction-accounting-trends-for-2024/', 301);
Route::redirect('/blog/why-businesses-outsourcing-accounts-payable-and-receivable', '/blog/why-businesses-outsource-accounts-payable-and-receivable/', 301);
Route::redirect('/construction-accounting-services', '/blog/construction-accounting-services/', 301);
Route::redirect('/accounts-payable-analytics', '/blog/accounts-payable-analytics/', 301);
Route::redirect('/casestudies', '/case-study/', 301);
Route::redirect('/best-practices-of-vendor-management', '/blog/best-practices-of-vendor-management/', 301);
Route::redirect('/blog/top-services-of-accounting-outsourcing-companies-for-business-growth', '/blog/top-accounting-outsourcing-services-for-business-growth//', 301);
Route::redirect('/ebooks', '/ebook/', 301);
Route::redirect('/articles', '/article/', 301);
Route::redirect('/free-consultation-for-ar-service', '/free-consultation-for-ap-ar-management/', 301);
Route::redirect('/accounts-payable-analytics-three-essential-focus-areas', '/blog/accounts-payable-analytics/', 301);
Route::redirect('/construction-accounting-services-ensuring-the-financial-success-of-your-business', '/blog/construction-accounting-services/', 301);
Route::redirect('/vendor-management-importance-best-practices-and-benefits', '/blog/best-practices-of-vendor-management/', 301);
Route::redirect('/3-key-components-of-an-income-statement-revenue-expenses-net-income', '/blog/components-of-an-income-statement/', 301);
Route::redirect('/p2p-automation-the-key-to-streamlining-procurement-and-payments', '/blog/p2p-process-automation/', 301);
Route::redirect('/the-power-of-3-way-matching-in-ap-automation', '/blog/3-way-matching-in-ap-automation/', 301);
Route::redirect('/accounts-payable-audits-a-comprehensive-guide-for-businesses', '/blog/accounts-payable-audit-guide/', 301);
Route::redirect('/cpa-firm-growth-strategies-for-expansion', '/blog/cpa-firm-growth-strategies/', 301);
Route::redirect('/data-migration', '/data-migration-services/', 301);
Route::redirect('/blog/automation-accounts-payable-in-the-digital-landscape-of-2023', '/blog/automation-accounts-payable-in-the-digital-landscape/', 301);
Route::redirect('/pressrelease/offshore-outsourcing-solutions-in-focus-as-70-us-companies-embrace-remote-work-ibn-technologies-leads-the-way', '/pressrelease/offshore-outsourcing-solutions-in-focus-as/', 301);
Route::redirect('/13-accounting-principles-the-keys-to-bankruptcy-resolution', '/blog/13-accounting-principles-the-keys-to-bankruptcy-resolution/', 301);
Route::redirect('/bookkeeping-accounting-trends-for-small-businesses', '/blog/bookkeeping-accounting-small-business/', 301);
Route::redirect('/fund-accounting-services-hedge-funds', '/fund-accounting-services/', 301);
Route::redirect('/bookkeeping-services-in-florida', '/bookkeeping-services-florida//', 301);
Route::redirect('/blog/bookkeeping-accounting-trends-for-small-businesses', '/blog/bookkeeping-accounting-small-business/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);
Route::redirect('/case', '/case/', 301);

//Redirections end here

// Permanently removed pages (410 Gone)
Route::get('/payroll-processing-old', fn () => abort(410));
Route::get('/back-offices-services', fn () => abort(410));
Route::get('/accounting-finannce-cpa-firm-case-study-2', fn () => abort(410));

Route::get('/preview/{type}/{id}', [CmsPreviewController::class, 'show'])
    ->whereIn('type', CmsPreviewType::values())
    ->where('id', '[0-9]+')
    ->name('cms.preview.show');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '^(?!admin$|article$|blog$|case-study$|ebook$|ibn-tech-cms-login$|industry$|lp$|newsletter$|pressrelease$|press-releases$|preview$|whitepapers$|livewire$|storage$|up$|sitemap(?:_index)?\\.xml$|(?:page|post|category|article|case-study|ebook|white-paper|press-release|industry|lp|newsletter|custom)-sitemap\\d*\\.xml$).+')
    ->name('page.show');
