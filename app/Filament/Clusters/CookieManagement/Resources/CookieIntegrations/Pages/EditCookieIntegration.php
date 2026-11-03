<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Pages;

use App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\CookieIntegrationResource;
use Filament\Resources\Pages\EditRecord;

class EditCookieIntegration extends EditRecord
{
    protected static string $resource = CookieIntegrationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
