<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\VisitorAnalytics;
use App\Services\Analytics\VisitorAnalyticsRange;
use App\Services\Analytics\VisitorAnalyticsService;

class DashboardVisitorTrendChart extends DashboardTrendChart
{
    protected ?string $heading = 'Visitor trend';

    protected ?string $description = 'Unique visitors, last 30 days';

    protected ?string $emptyStateHeading = 'No visitors in the last 30 days';

    protected ?string $emptyStateDescription = 'Unique visitors appear here after public pages are tracked.';

    /**
     * @var array{labels: list<string>, visitors: list<int>, page_views: list<int>, has_data: bool}|null
     */
    private ?array $trend = null;

    public static function canView(): bool
    {
        return VisitorAnalytics::canAccess();
    }

    public function isEmpty(): bool
    {
        return ! $this->trend()['has_data'];
    }

    protected function getData(): array
    {
        $trend = $this->trend();

        return [
            'datasets' => [
                $this->dataset('Unique Visitors', $trend['visitors'], '#2e2e80'),
            ],
            'labels' => $trend['labels'],
        ];
    }

    /**
     * @return array{labels: list<string>, visitors: list<int>, page_views: list<int>, has_data: bool}
     */
    private function trend(): array
    {
        return $this->trend ??= app(VisitorAnalyticsService::class)->dailyTrend(
            VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30),
        );
    }
}
