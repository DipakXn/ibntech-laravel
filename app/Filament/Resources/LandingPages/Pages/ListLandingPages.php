<?php

namespace App\Filament\Resources\LandingPages\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\LandingPages\LandingPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLandingPages extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = LandingPageResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Landing Page Overview',
            'totalLabel' => 'Total Landing Pages',
            'totalHint' => 'All landing pages',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
