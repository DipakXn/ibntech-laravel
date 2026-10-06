<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Services\Analytics\VisitorAnalyticsRange;
use App\Services\Analytics\VisitorAnalyticsService;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class VisitorAnalytics extends Page
{
    protected static ?string $title = 'Visitor analytics';

    protected static ?string $navigationLabel = 'Visitor analytics';

    protected static ?string $slug = 'visitor-analytics';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?int $navigationSort = 8;

    protected string $view = 'filament.pages.visitor-analytics';

    protected ?string $subheading = 'Unique visitors and page views from the public site. Visitors are distinct visitor IDs. Page views are tracked records.';

    protected Width|string|null $maxContentWidth = 'full';

    public string $preset = VisitorAnalyticsRange::LAST_30;

    public ?string $dateFrom = null;

    public ?string $dateTo = null;

    public string $contentType = '';

    public string $contentSort = 'page_views';

    public string $contentDirection = 'desc';

    public int $contentPage = 1;

    public static function canAccess(): bool
    {
        return auth()->user() instanceof User && auth()->user()->isAdministrator();
    }

    public function updatedPreset(string $value): void
    {
        if ($value === VisitorAnalyticsRange::CUSTOM && ($this->dateFrom === null || $this->dateFrom === '' || $this->dateTo === null || $this->dateTo === '')) {
            $current = VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30);
            $this->dateFrom = $current->startsAt->toDateString();
            $this->dateTo = $current->endsAt->toDateString();
        }

        $this->contentPage = 1;
    }

    public function updatedDateFrom(): void
    {
        $this->preset = VisitorAnalyticsRange::CUSTOM;
        $this->contentPage = 1;
    }

    public function updatedDateTo(): void
    {
        $this->preset = VisitorAnalyticsRange::CUSTOM;
        $this->contentPage = 1;
    }

    public function updatedContentType(): void
    {
        $this->contentPage = 1;
    }

    public function sortContent(string $column): void
    {
        if (! in_array($column, ['page_views', 'unique_visitors', 'last_viewed'], true)) {
            return;
        }

        if ($this->contentSort === $column) {
            $this->contentDirection = $this->contentDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->contentSort = $column;
            $this->contentDirection = 'desc';
        }

        $this->contentPage = 1;
    }

    public function setContentPage(int $page): void
    {
        $this->contentPage = max(1, $page);
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $service = app(VisitorAnalyticsService::class);
        $range = $this->range();

        return [
            'range' => $range,
            'presets' => [
                VisitorAnalyticsRange::LAST_7 => 'Last 7 Days',
                VisitorAnalyticsRange::LAST_30 => 'Last 30 Days',
                VisitorAnalyticsRange::LAST_90 => 'Last 90 Days',
                VisitorAnalyticsRange::CUSTOM => 'Custom Date Range',
            ],
            'kpis' => $service->kpis($range),
            'topContent' => $service->topContent($range),
            'content' => $service->contentPerformance(
                $range,
                $this->contentType,
                $this->contentSort,
                $this->contentDirection,
                page: $this->contentPage,
            ),
            'contentTypes' => $service->contentTypeOptions(),
            'referrers' => $service->referrers($range),
            'countries' => $service->countries($range),
            'devices' => $service->devices($range),
            'browsers' => $service->browsers($range),
            'operatingSystems' => $service->operatingSystems($range),
        ];
    }

    private function range(): VisitorAnalyticsRange
    {
        return VisitorAnalyticsRange::make($this->preset, $this->dateFrom, $this->dateTo);
    }
}
