<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Pages;

use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\CookieRegistryEntryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCookieRegistryEntry extends CreateRecord
{
    protected static string $resource = CookieRegistryEntryResource::class;
}
