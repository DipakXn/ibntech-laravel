<?php

namespace App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\Pages;

use App\Filament\Clusters\SmtpSettings\Concerns\HasSmtpSettingsPageHeading;
use App\Filament\Clusters\SmtpSettings\Resources\EmailLogs\EmailLogResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListEmailLogs extends ListRecords
{
    use HasSmtpSettingsPageHeading;

    protected static string $resource = EmailLogResource::class;

    protected Width|string|null $maxContentWidth = 'full';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
