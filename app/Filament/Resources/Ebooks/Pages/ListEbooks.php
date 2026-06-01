<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Resources\Ebooks\EbookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEbooks extends ListRecords
{
    protected static string $resource = EbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New eBook'),
        ];
    }
}
