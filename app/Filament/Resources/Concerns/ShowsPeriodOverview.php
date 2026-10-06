<?php

namespace App\Filament\Resources\Concerns;

use App\Filament\Widgets\RecordPeriodOverviewWidget;

trait ShowsPeriodOverview
{
    protected function getHeaderWidgets(): array
    {
        $overview = $this->periodOverview();

        return [
            RecordPeriodOverviewWidget::make([
                'recordModel' => static::getResource()::getModel(),
                'overviewHeading' => $overview['heading'],
                'totalLabel' => $overview['totalLabel'],
                'totalHint' => $overview['totalHint'],
            ]),
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    /**
     * @return array{heading: string, totalLabel: string, totalHint: string}
     */
    abstract protected function periodOverview(): array;
}
