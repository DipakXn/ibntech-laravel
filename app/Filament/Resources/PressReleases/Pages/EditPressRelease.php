<?php

namespace App\Filament\Resources\PressReleases\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\PressReleases\PressReleaseResource;
use App\Filament\Actions\MoveToTrashAction;
use Filament\Resources\Pages\EditRecord;

class EditPressRelease extends EditRecord
{
    protected static string $resource = PressReleaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            MoveToTrashAction::make(),
        ];
    }
}
