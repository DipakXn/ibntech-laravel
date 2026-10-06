<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\User;
use App\Models\WhitePaper;
use Filament\Resources\Resource;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RecentActivityWidget extends Widget
{
    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.recent-activity-widget';

    protected int|string|array $columnSpan = 1;

    protected function getViewData(): array
    {
        $groups = [
            $this->latestActivity(Blog::class, 'Blog', BlogResource::class),
            $this->latestActivity(CaseStudy::class, 'Case study', CaseStudyResource::class),
            $this->latestActivity(PressRelease::class, 'Press release', PressReleaseResource::class),
            $this->latestActivity(Ebook::class, 'eBook', EbookResource::class),
            $this->latestActivity(WhitePaper::class, 'White paper', WhitePaperResource::class),
        ];

        $user = auth()->user();

        if ($user instanceof User && $user->isAuthor()) {
            $groups[] = $this->latestActivity(Article::class, 'Article', ArticleResource::class);
        } else {
            $groups[] = $this->latestActivity(Page::class, 'Page', PageResource::class);
        }

        $items = collect($groups)
            ->flatMap(fn (Collection $group): Collection => $group)
            ->sortByDesc('date')
            ->take(6)
            ->values();

        return ['items' => $items];
    }

    /**
     * @param  class-string<Model>  $model
     * @param  class-string<Resource>  $resource
     * @return Collection<int, array{title: string, type: string, status: string, url: string, date: mixed}>
     */
    private function latestActivity(string $model, string $type, string $resource): Collection
    {
        return $model::query()->latest()->limit(3)->get()->map(fn (Model $record): array => [
            'title' => (string) $record->getAttribute('title'),
            'type' => $type,
            'status' => (string) $record->getAttribute('status'),
            'url' => $resource::getUrl('edit', ['record' => $record]),
            'date' => $record->getAttribute('updated_at'),
        ]);
    }
}
