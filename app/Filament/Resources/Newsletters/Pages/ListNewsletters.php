<?php

namespace App\Filament\Resources\Newsletters\Pages;

use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use App\Filament\Resources\Newsletters\NewsletterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNewsletters extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = NewsletterResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Newsletter Overview',
            'totalLabel' => 'Total Newsletters',
            'totalHint' => 'All newsletters',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
