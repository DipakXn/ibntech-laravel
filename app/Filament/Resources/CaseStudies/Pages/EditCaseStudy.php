<?php

namespace App\Filament\Resources\CaseStudies\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Actions\MoveToTrashAction;
use Filament\Resources\Pages\EditRecord;

class EditCaseStudy extends EditRecord
{
    protected static string $resource = CaseStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            MoveToTrashAction::make(),
        ];
    }
}
