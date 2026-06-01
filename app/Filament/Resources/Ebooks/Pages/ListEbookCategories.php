<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Resources\Ebooks\EbookCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEbookCategories extends ListRecords
{
    protected static string $resource = EbookCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
