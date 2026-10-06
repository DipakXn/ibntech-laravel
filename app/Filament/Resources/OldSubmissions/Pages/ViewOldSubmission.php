<?php

namespace App\Filament\Resources\OldSubmissions\Pages;

use App\Filament\Resources\OldSubmissions\OldSubmissionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewOldSubmission extends ViewRecord
{
    protected static string $resource = OldSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
