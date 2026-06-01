<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Resources\Ebooks\EbookCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEbookCategory extends EditRecord
{
    protected static string $resource = EbookCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
