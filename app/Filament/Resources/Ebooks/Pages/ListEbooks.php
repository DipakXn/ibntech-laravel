<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\Ebooks\EbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEbooks extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = EbookResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'eBook Overview',
            'totalLabel' => 'Total eBooks',
            'totalHint' => 'All eBooks',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New eBook'),
        ];
    }
}
