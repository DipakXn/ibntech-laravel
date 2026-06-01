<?php

namespace App\Filament\Resources\PressReleases\Pages;

use App\Filament\Resources\PressReleases\PressReleaseCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPressReleaseCategories extends ListRecords
{
    protected static string $resource = PressReleaseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
