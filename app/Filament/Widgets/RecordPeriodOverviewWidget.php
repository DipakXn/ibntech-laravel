<?php

namespace App\Filament\Widgets;

use App\Services\Overview\PeriodCounts;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class RecordPeriodOverviewWidget extends Widget
{
    protected static bool $isDiscovered = false;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.record-period-overview';

    protected int|string|array $columnSpan = 'full';

    /**
     * @var class-string<Model>
     */
    public string $recordModel = '';

    public string $overviewHeading = 'Overview';

    public string $totalLabel = 'Total';

    public string $totalHint = 'All records';

    /**
     * @return array{heading: string, cards: list<array{label: string, value: int, hint: string}>}
     */
    protected function getViewData(): array
    {
        if (! is_subclass_of($this->recordModel, Model::class)) {
            throw new InvalidArgumentException('A record model is required for the overview.');
        }

        $counts = app(PeriodCounts::class)->forModel($this->recordModel);

        return [
            'heading' => $this->overviewHeading,
            'cards' => [
                [
                    'label' => $this->totalLabel,
                    'value' => $counts['total'],
                    'hint' => $this->totalHint,
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
