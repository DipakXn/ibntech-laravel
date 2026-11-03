<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieCategories\Pages;

use App\Filament\Clusters\CookieManagement\Resources\CookieCategories\CookieCategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListCookieCategories extends ListRecords
{
    protected static string $resource = CookieCategoryResource::class;
}
