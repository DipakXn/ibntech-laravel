<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\Pages;

use App\Filament\Clusters\CookieManagement\Resources\CookieRegistryEntries\CookieRegistryEntryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCookieRegistryEntry extends EditRecord
{
    protected static string $resource = CookieRegistryEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
