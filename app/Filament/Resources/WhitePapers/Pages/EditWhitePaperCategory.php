<?php

namespace App\Filament\Resources\WhitePapers\Pages;

use App\Filament\Resources\WhitePapers\WhitePaperCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWhitePaperCategory extends EditRecord
{
    protected static string $resource = WhitePaperCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
