<?php

namespace App\Filament\Resources\AnalyticsExcludedIps\Pages;

use App\Filament\Resources\AnalyticsExcludedIps\AnalyticsExcludedIpResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnalyticsExcludedIp extends EditRecord
{
    protected static string $resource = AnalyticsExcludedIpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
