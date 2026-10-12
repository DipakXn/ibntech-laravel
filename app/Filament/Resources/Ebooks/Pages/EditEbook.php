<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\Ebooks\EbookResource;
use App\Filament\Actions\MoveToTrashAction;
use Filament\Resources\Pages\EditRecord;

class EditEbook extends EditRecord
{
    protected static string $resource = EbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            MoveToTrashAction::make(),
        ];
    }
}
