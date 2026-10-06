<?php

namespace App\Filament\Resources\AnalyticsExcludedIps\Pages;

use App\Filament\Resources\AnalyticsExcludedIps\AnalyticsExcludedIpResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnalyticsExcludedIps extends ListRecords
{
    protected static string $resource = AnalyticsExcludedIpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
