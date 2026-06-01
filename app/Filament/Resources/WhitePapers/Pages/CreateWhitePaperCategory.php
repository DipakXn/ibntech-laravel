<?php

namespace App\Filament\Resources\WhitePapers\Pages;

use App\Filament\Resources\WhitePapers\WhitePaperCategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;

class CreateWhitePaperCategory extends CreateRecord
{
    protected static string $resource = WhitePaperCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['module'] = Category::MODULE_WHITE_PAPER;

        return $data;
    }
}
