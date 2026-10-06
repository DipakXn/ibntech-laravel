<?php

namespace App\Filament\Resources\PressReleases\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPressReleases extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = PressReleaseResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Press Release Overview',
            'totalLabel' => 'Total Press Releases',
            'totalHint' => 'All press releases',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New Press Release'),
        ];
    }
}
