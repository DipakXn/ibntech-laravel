<?php

namespace App\Filament\Resources\WhitePapers\Pages;

use App\Filament\Resources\WhitePapers\WhitePaperCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhitePaperCategories extends ListRecords
{
    protected static string $resource = WhitePaperCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
