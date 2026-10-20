<?php

namespace App\Support\AdminToolbar;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Clusters\SmtpSettings\Pages\SmtpConfiguration;
use App\Filament\Pages\CloudflareCache;
use App\Filament\Pages\LogViewer;
use App\Filament\Pages\QueueMonitor;
use App\Filament\Pages\SystemMaintenance;
use App\Filament\Pages\VisitorAnalytics;
use App\Filament\Pages\WebsiteSettings;
use App\Filament\Resources\Articles\ArticleCategoryResource;
use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogCategoryResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyCategoryResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookCategoryResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseCategoryResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\WhitePapers\WhitePaperCategoryResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Models\Category;
use App\Models\Lead;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

class AdminToolbar
{
    /**
     * The registered admin panel. Public requests have no current panel, so
     * canAccessPanel() must receive this instance explicitly.
     */
    public static function shouldRender(): bool
    {
        $user = auth()->user();

        return $user instanceof User
            && $user->canAccessPanel(Filament::getPanel('admin'));
    }

    /**
     * @param  array<string, mixed>  $viewData
     * @return array<string, mixed>|null
     */
    public static function forView(array $viewData): ?array
    {
        if (! static::shouldRender()) {
            return null;
        }

        $user = auth()->user();

        return [
            'siteUrl' => url('/'),
            'dashboardUrl' => Filament::getUrl(),
            'profileUrl' => Filament::getProfileUrl(),
            'logoutUrl' => Filament::getLogoutUrl(),
            'userName' => trim((string) $user?->name) !== '' ? trim((string) $user->name) : (string) $user?->email,
            'newItems' => static::newItems(),
            'context' => static::contextAction($viewData),
            'submissions' => static::submissions(),
            'controlItems' => static::controlItems(),
            'clearCacheUrl' => SystemMaintenance::canAccess() && Route::has('filament.admin.clear-cache')
                ? route('filament.admin.clear-cache')
                : null,
        ];
    }

    /**
     * @return list<array{label: string, url: string}>
     */
    private static function newItems(): array
    {
        $items = [
            [BlogResource::class, 'Blog'],
            [CaseStudyResource::class, 'Case study'],
            [PressReleaseResource::class, 'Press release'],
            [EbookResource::class, 'eBook'],
            [WhitePaperResource::class, 'White paper'],
            [ArticleResource::class, 'Article'],
            [PageResource::class, 'Page'],
            [IndustryResource::class, 'Industry'],
            [LandingPageResource::class, 'Landing page'],
            [NewsletterResource::class, 'Newsletter'],
        ];

        $links = [];

        foreach ($items as [$resource, $label]) {
            if ($resource::canCreate()) {
                $links[] = [
                    'label' => $label,
                    'url' => $resource::getUrl('create'),
                ];
            }
        }

        return $links;
    }

    /**
     * Route name decides the action. Blade loops such as `@forelse ($blogs as $blog)`
     * leak the last item into the layout data, so scanning every view variable
     * would offer Edit Blog on a category archive.
     *
     * @param  array<string, mixed>  $viewData
     * @return array{label: string, url: string}|null
     */
    private static function contextAction(array $viewData): ?array
    {
        $routeName = request()->route()?->getName();

        if (! is_string($routeName)) {
            return null;
        }

        if ($routeName === 'cms.preview.show') {
            $type = CmsPreviewType::tryFrom((string) request()->route('type'));

            return $type instanceof CmsPreviewType
                ? static::editAction($type, $viewData[$type->viewVariable()] ?? null)
                : null;
        }

        $singular = static::singularRoutes()[$routeName] ?? null;

        if ($singular instanceof CmsPreviewType) {
            return static::editAction($singular, $viewData[$singular->viewVariable()] ?? null);
        }

        if (in_array($routeName, ['blog.category', 'blog.category.page'], true)) {
            $category = $viewData['category'] ?? null;
            $resource = $category instanceof Category ? static::categoryResource($category->module) : null;

            if (! $category instanceof Category || $resource === null || ! $resource::canEdit($category)) {
                return null;
            }

            return [
                'label' => 'Edit Category',
                'url' => $resource::getUrl('edit', ['record' => $category]),
            ];
        }

        $listing = static::listings()[$routeName] ?? null;

        if ($listing === null) {
            return null;
        }

        [$resource, $label] = $listing;

        if (! $resource::canViewAny()) {
            return null;
        }

        return [
            'label' => $label,
            'url' => $resource::getUrl('index'),
        ];
    }

    private static function editAction(CmsPreviewType $type, mixed $record): ?array
    {
        $modelClass = $type->modelClass();

        if (! $record instanceof $modelClass) {
            return null;
        }

        $resource = $type->filamentResource();

        if (! $resource::canEdit($record)) {
            return null;
        }

        return [
            'label' => 'Edit '.static::typeLabel($type),
            'url' => $resource::getUrl('edit', ['record' => $record]),
        ];
    }

    /**
     * @return array{url: string, count: int}|null
     */
    private static function submissions(): ?array
    {
        if (! LeadResource::canViewAny()) {
            return null;
        }

        return [
            'url' => LeadResource::getUrl(),
            'count' => Lead::query()->whereDate('created_at', '>=', now()->subDays(7))->count(),
        ];
    }

    /**
     * @return list<array{label: string, url: string}>
     */
    private static function controlItems(): array
    {
        $items = [
            [WebsiteSettings::class, 'canAccess', 'Website Settings'],
            [VisitorAnalytics::class, 'canAccess', 'Visitor analytics'],
            [UserResource::class, 'canViewAny', 'Users'],
            [SmtpConfiguration::class, 'canAccess', 'SMTP configuration'],
            [QueueMonitor::class, 'canAccess', 'Queue monitor'],
            [LogViewer::class, 'canAccess', 'Application logs'],
            [CloudflareCache::class, 'canAccess', 'Cloudflare cache'],
            [SystemMaintenance::class, 'canAccess', 'System maintenance'],
        ];

        $links = [];

        foreach ($items as [$class, $method, $label]) {
            if ($class::$method()) {
                $links[] = [
                    'label' => $label,
                    'url' => $class::getUrl(),
                ];
            }
        }

        return $links;
    }

    /**
     * @return class-string|null
     */
    private static function categoryResource(?string $module): ?string
    {
        return match ($module) {
            Category::MODULE_BLOG => BlogCategoryResource::class,
            Category::MODULE_ARTICLE => ArticleCategoryResource::class,
            Category::MODULE_CASE_STUDY => CaseStudyCategoryResource::class,
            Category::MODULE_EBOOK => EbookCategoryResource::class,
            Category::MODULE_PRESS_RELEASE => PressReleaseCategoryResource::class,
            Category::MODULE_WHITE_PAPER => WhitePaperCategoryResource::class,
            default => null,
        };
    }

    /**
     * @return array<string, CmsPreviewType>
     */
    private static function singularRoutes(): array
    {
        return [
            'home' => CmsPreviewType::Page,
            'page.show' => CmsPreviewType::Page,
            'blog.show' => CmsPreviewType::Blog,
            'articles.show' => CmsPreviewType::Article,
            'case-studies.show' => CmsPreviewType::CaseStudy,
            'ebooks.show' => CmsPreviewType::Ebook,
            'pressrelease.show' => CmsPreviewType::PressRelease,
            'white-papers.show' => CmsPreviewType::WhitePaper,
            'landing-pages.show' => CmsPreviewType::LandingPage,
            'newsletters.show' => CmsPreviewType::Newsletter,
            'industries.show' => CmsPreviewType::Industry,
        ];
    }

    /**
     * @return array<string, array{0: class-string, 1: string}>
     */
    private static function listings(): array
    {
        return [
            'blog.index' => [BlogResource::class, 'Manage Blogs'],
            'articles.index' => [ArticleResource::class, 'Manage Articles'],
            'articles.page' => [ArticleResource::class, 'Manage Articles'],
            'case-studies.index' => [CaseStudyResource::class, 'Manage Case Studies'],
            'case-studies.page' => [CaseStudyResource::class, 'Manage Case Studies'],
            'ebooks.index' => [EbookResource::class, 'Manage eBooks'],
            'ebooks.page' => [EbookResource::class, 'Manage eBooks'],
            'pressrelease.index' => [PressReleaseResource::class, 'Manage Press Releases'],
            'pressrelease.page' => [PressReleaseResource::class, 'Manage Press Releases'],
            'white-papers.index' => [WhitePaperResource::class, 'Manage White Papers'],
            'white-papers.page' => [WhitePaperResource::class, 'Manage White Papers'],
            'newsletters.index' => [NewsletterResource::class, 'Manage Newsletters'],
        ];
    }

    private static function typeLabel(CmsPreviewType $type): string
    {
        return match ($type) {
            CmsPreviewType::Page => 'Page',
            CmsPreviewType::Blog => 'Blog',
            CmsPreviewType::Article => 'Article',
            CmsPreviewType::CaseStudy => 'Case Study',
            CmsPreviewType::PressRelease => 'Press Release',
            CmsPreviewType::Ebook => 'eBook',
            CmsPreviewType::WhitePaper => 'White Paper',
            CmsPreviewType::LandingPage => 'Landing Page',
            CmsPreviewType::Newsletter => 'Newsletter',
            CmsPreviewType::Industry => 'Industry',
        };
    }
}
