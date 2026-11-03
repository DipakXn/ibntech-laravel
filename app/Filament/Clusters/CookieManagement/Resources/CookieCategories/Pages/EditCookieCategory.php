<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Pages;

use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\CookieCategoryResource;
use Filament\Resources\Pages\EditRecord;

class EditCookieCategory extends EditRecord
{
    protected static string $resource = CookieCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
