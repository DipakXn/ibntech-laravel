<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Services\Analytics\VisitorAnalyticsRange;
use App\Services\Analytics\VisitorAnalyticsService;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class VisitorTrendChart extends ChartWidget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected ?string $heading = 'Visitors and page views';

    protected ?string $maxHeight = '18rem';

    protected ?string $emptyStateHeading = 'No page views in this date range';

    protected ?string $emptyStateDescription = 'Unique visitors and page views appear here after public pages are tracked.';

    protected int|string|array $columnSpan = 'full';

    public string $preset = VisitorAnalyticsRange::LAST_30;

    public ?string $dateFrom = null;

    public ?string $dateTo = null;

    /**
     * @var array{labels: list<string>, visitors: list<int>, page_views: list<int>, has_data: bool}|null
     */
    private ?array $trend = null;

    public static function canView(): bool
    {
        return auth()->user() instanceof User && auth()->user()->isAdministrator();
    }

    public function getDescription(): string|Htmlable|null
    {
        return $this->range()->label();
    }

    public function isEmpty(): bool
    {
        return ! $this->trend()['has_data'];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $trend = $this->trend();

        return [
            'datasets' => [
                [
                    'label' => 'Unique Visitors',
                    'data' => $trend['visitors'],
                    'borderColor' => '#2e2e80',
                    'backgroundColor' => 'rgba(46, 46, 128, 0.12)',
                    'pointBackgroundColor' => '#2e2e80',
                    'tension' => 0.3,
                    'fill' => false,
                ],
                [
                    'label' => 'Page Views',
                    'data' => $trend['page_views'],
                    'borderColor' => '#4caf50',
                    'backgroundColor' => 'rgba(76, 175, 80, 0.12)',
                    'pointBackgroundColor' => '#4caf50',
                    'tension' => 0.3,
                    'fill' => false,
                ],
            ],
            'labels' => $trend['labels'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }

    private function range(): VisitorAnalyticsRange
    {
        return VisitorAnalyticsRange::make($this->preset, $this->dateFrom, $this->dateTo);
    }

    /**
     * @return array{labels: list<string>, visitors: list<int>, page_views: list<int>, has_data: bool}
     */
    private function trend(): array
    {
        return $this->trend ??= app(VisitorAnalyticsService::class)->dailyTrend($this->range());
    }
}
