<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = PageResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Page Overview',
            'totalLabel' => 'Total Pages',
            'totalHint' => 'All pages',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
