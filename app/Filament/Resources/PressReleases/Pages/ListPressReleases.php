<?php

namespace App\Filament\Resources\PressReleases\Pages;

use App\Filament\Resources\PressReleases\PressReleaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPressReleases extends ListRecords
{
    protected static string $resource = PressReleaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New Press Release'),
        ];
    }
}
