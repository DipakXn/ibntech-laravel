<?php

namespace App\Filament\Resources\WhitePapers\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhitePapers extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = WhitePaperResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'White Paper Overview',
            'totalLabel' => 'Total White Papers',
            'totalHint' => 'All white papers',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New White Paper'),
        ];
    }
}
