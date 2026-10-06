<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class RecentActivityWidget extends Widget
{
    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.recent-activity-widget';

    protected int|string|array $columnSpan = 1;

    protected function getViewData(): array
    {
        $items = Collection::make()
            ->merge(Blog::query()->latest()->limit(3)->get()->map(fn (Blog $blog): array => [
                'title' => $blog->title,
                'type' => 'Blog',
                'status' => $blog->status,
                'url' => BlogResource::getUrl('edit', ['record' => $blog]),
                'date' => $blog->updated_at,
            ]))
            ->merge(CaseStudy::query()->latest()->limit(3)->get()->map(fn (CaseStudy $caseStudy): array => [
                'title' => $caseStudy->title,
                'type' => 'Case study',
                'status' => $caseStudy->status,
                'url' => CaseStudyResource::getUrl('edit', ['record' => $caseStudy]),
                'date' => $caseStudy->updated_at,
            ]))
            ->merge(Ebook::query()->latest()->limit(3)->get()->map(fn (Ebook $ebook): array => [
                'title' => $ebook->title,
                'type' => 'eBook',
                'status' => $ebook->status,
                'url' => EbookResource::getUrl('edit', ['record' => $ebook]),
                'date' => $ebook->updated_at,
            ]))
            ->merge(PressRelease::query()->latest()->limit(3)->get()->map(fn (PressRelease $pressRelease): array => [
                'title' => $pressRelease->title,
                'type' => 'Press release',
                'status' => $pressRelease->status,
                'url' => PressReleaseResource::getUrl('edit', ['record' => $pressRelease]),
                'date' => $pressRelease->updated_at,
            ]))
            ->merge(WhitePaper::query()->latest()->limit(3)->get()->map(fn (WhitePaper $whitePaper): array => [
                'title' => $whitePaper->title,
                'type' => 'White paper',
                'status' => $whitePaper->status,
                'url' => WhitePaperResource::getUrl('edit', ['record' => $whitePaper]),
                'date' => $whitePaper->updated_at,
            ]))
            ->merge(Page::query()->latest()->limit(3)->get()->map(fn (Page $page): array => [
                'title' => $page->title,
                'type' => 'Page',
                'status' => $page->status,
                'url' => PageResource::getUrl('edit', ['record' => $page]),
                'date' => $page->updated_at,
            ]))
            ->sortByDesc('date')
            ->take(6)
            ->values();

        return ['items' => $items];
    }
}
