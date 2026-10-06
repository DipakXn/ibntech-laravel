<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Industries\IndustryResource;
use App\Filament\Resources\LandingPages\LandingPageResource;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Services\Content\ContentInventory;
use Filament\Resources\Resource;
use Filament\Widgets\Widget;

class DashboardContentOverviewWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.dashboard-content-overview';

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array{items: list<array{label: string, total: int, url: ?string}>}
     */
    protected function getViewData(): array
    {
        $totals = app(ContentInventory::class)->totals();

        $items = [];

        foreach ($this->modules() as $key => $module) {
            $resource = $module['resource'];

            $items[] = [
                'label' => $module['label'],
                'total' => $totals[$key] ?? 0,
                'url' => $resource::canViewAny() ? $resource::getUrl() : null,
            ];
        }

        return ['items' => $items];
    }

    /**
     * @return array<string, array{label: string, resource: class-string<resource>}>
     */
    private function modules(): array
    {
        return [
            'pages' => ['label' => 'Pages', 'resource' => PageResource::class],
            'blogs' => ['label' => 'Blogs', 'resource' => BlogResource::class],
            'industries' => ['label' => 'Industries', 'resource' => IndustryResource::class],
            'case_studies' => ['label' => 'Case Studies', 'resource' => CaseStudyResource::class],
            'landing_pages' => ['label' => 'Landing Pages', 'resource' => LandingPageResource::class],
            'newsletters' => ['label' => 'Newsletters', 'resource' => NewsletterResource::class],
            'press_releases' => ['label' => 'Press Releases', 'resource' => PressReleaseResource::class],
            'ebooks' => ['label' => 'eBooks', 'resource' => EbookResource::class],
            'white_papers' => ['label' => 'White Papers', 'resource' => WhitePaperResource::class],
            'articles' => ['label' => 'Articles', 'resource' => ArticleResource::class],
        ];
    }
}
