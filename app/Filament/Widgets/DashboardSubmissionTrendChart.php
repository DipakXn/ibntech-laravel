<?php

namespace App\Filament\Widgets;

use App\Services\Leads\SubmissionOverview;

class DashboardSubmissionTrendChart extends DashboardTrendChart
{
    protected ?string $heading = 'Submission trend';

    protected ?string $description = 'Last 30 days';

    protected ?string $emptyStateHeading = 'No submissions in the last 30 days';

    protected ?string $emptyStateDescription = 'Daily submission totals appear here once forms are submitted.';

    /**
     * @var array{labels: list<string>, counts: list<int>, has_data: bool}|null
     */
    private ?array $trend = null;

    public function isEmpty(): bool
    {
        return ! $this->trend()['has_data'];
    }

    protected function getData(): array
    {
        $trend = $this->trend();

        return [
            'datasets' => [
                $this->dataset('Submissions', $trend['counts'], '#4caf50'),
            ],
            'labels' => $trend['labels'],
        ];
    }

    /**
     * @return array{labels: list<string>, counts: list<int>, has_data: bool}
     */
    private function trend(): array
    {
        return $this->trend ??= app(SubmissionOverview::class)->dailyTrend();
    }
}
