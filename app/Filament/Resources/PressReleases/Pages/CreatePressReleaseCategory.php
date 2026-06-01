<?php

namespace App\Filament\Resources\PressReleases\Pages;

use App\Filament\Resources\PressReleases\PressReleaseCategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;

class CreatePressReleaseCategory extends CreateRecord
{
    protected static string $resource = PressReleaseCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['module'] = Category::MODULE_PRESS_RELEASE;

        return $data;
    }
}
