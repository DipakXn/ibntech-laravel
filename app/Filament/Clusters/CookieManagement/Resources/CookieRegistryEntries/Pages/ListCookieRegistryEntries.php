<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Pages;

use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\CookieRegistryEntryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCookieRegistryEntries extends ListRecords
{
    protected static string $resource = CookieRegistryEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
