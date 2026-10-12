<?php

namespace App\Filament\Resources\Newsletters\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\Newsletters\NewsletterResource;
use App\Filament\Actions\MoveToTrashAction;
use Filament\Resources\Pages\EditRecord;

class EditNewsletter extends EditRecord
{
    protected static string $resource = NewsletterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            MoveToTrashAction::make(),
        ];
    }
}
