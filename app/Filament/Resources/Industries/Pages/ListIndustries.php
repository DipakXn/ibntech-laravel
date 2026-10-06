<?php

namespace App\Filament\Resources\Industries\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\Industries\IndustryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIndustries extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = IndustryResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Industry Overview',
            'totalLabel' => 'Total Industries',
            'totalHint' => 'All industries',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
