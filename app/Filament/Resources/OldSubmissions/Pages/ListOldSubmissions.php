<?php

namespace App\Filament\Resources\OldSubmissions\Pages;

use App\Filament\Resources\OldSubmissions\OldSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListOldSubmissions extends ListRecords
{
    protected static string $resource = OldSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
