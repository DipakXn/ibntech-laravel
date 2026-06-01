<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Resources\Ebooks\EbookCategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;

class CreateEbookCategory extends CreateRecord
{
    protected static string $resource = EbookCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['module'] = Category::MODULE_EBOOK;

        return $data;
    }
}
