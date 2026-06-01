<?php

namespace App\Filament\Resources\WhitePapers\Pages;

use App\Filament\Resources\WhitePapers\WhitePaperResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhitePapers extends ListRecords
{
    protected static string $resource = WhitePaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New White Paper'),
        ];
    }
}
