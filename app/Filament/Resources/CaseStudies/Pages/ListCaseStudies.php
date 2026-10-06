<?php

namespace App\Filament\Resources\CaseStudies\Pages;

use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCaseStudies extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = CaseStudyResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Case Study Overview',
            'totalLabel' => 'Total Case Studies',
            'totalHint' => 'All case studies',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
