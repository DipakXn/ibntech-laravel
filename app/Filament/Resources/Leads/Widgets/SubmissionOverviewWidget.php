<?php

namespace App\Filament\Resources\Leads\Widgets;

use App\Services\Leads\SubmissionOverview;
use Filament\Widgets\Widget;

class SubmissionOverviewWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.record-period-overview';

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array{heading: string, cards: list<array{label: string, value: int, hint: string}>}
     */
    protected function getViewData(): array
    {
        $counts = app(SubmissionOverview::class)->counts();

        return [
            'heading' => 'Submission Overview',
            'cards' => [
                [
                    'label' => 'Total Submissions',
                    'value' => $counts['total'],
                    'hint' => 'All form submissions',
                ],
                [
                    'label' => 'Today',
                    'value' => $counts['today'],
                    'hint' => 'Created today',
                ],
                [
                    'label' => 'This Week',
                    'value' => $counts['this_week'],
                    'hint' => 'Current week',
                ],
                [
                    'label' => 'This Month',
                    'value' => $counts['this_month'],
                    'hint' => 'Current month',
                ],
            ],
        ];
    }
}
