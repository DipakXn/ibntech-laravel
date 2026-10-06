<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\VisitorAnalytics;
use App\Services\Analytics\VisitorAnalyticsRange;
use App\Services\Analytics\VisitorAnalyticsService;
use Filament\Widgets\Widget;

class DashboardVisitorPreviewWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.dashboard-visitor-preview';

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return VisitorAnalytics::canAccess();
    }

    /**
     * @return array{
     *     cards: list<array{label: string, value: int, hint: string}>,
     *     analyticsUrl: string
     * }
     */
    protected function getViewData(): array
    {
        $kpis = app(VisitorAnalyticsService::class)->kpis(
            VisitorAnalyticsRange::make(VisitorAnalyticsRange::LAST_30),
        );

        return [
            'cards' => [
                [
                    'label' => 'Total Visitors',
                    'value' => $kpis['total_visitors'],
                    'hint' => 'Unique visitors, all time',
                ],
                [
                    'label' => 'Visitors Today',
                    'value' => $kpis['visitors_today'],
                    'hint' => 'Unique visitors',
                ],
                [
                    'label' => 'Visitors This Week',
                    'value' => $kpis['visitors_this_week'],
                    'hint' => 'Unique visitors',
                ],
                [
                    'label' => 'Visitors This Month',
                    'value' => $kpis['visitors_this_month'],
                    'hint' => 'Unique visitors',
                ],
            ],
            'analyticsUrl' => VisitorAnalytics::getUrl(),
        ];
    }
}
