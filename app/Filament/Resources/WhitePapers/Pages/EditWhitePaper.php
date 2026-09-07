<?php

namespace App\Filament\Resources\WhitePapers\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\WhitePapers\WhitePaperResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWhitePaper extends EditRecord
{
    protected static string $resource = WhitePaperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            DeleteAction::make(),
        ];
    }
}
