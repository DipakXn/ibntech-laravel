<?php

namespace App\Filament\Resources\Industries\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\Industries\IndustryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIndustry extends EditRecord
{
    protected static string $resource = IndustryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            DeleteAction::make(),
        ];
    }
}
