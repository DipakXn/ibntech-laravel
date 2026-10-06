<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = ArticleResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Article Overview',
            'totalLabel' => 'Total Articles',
            'totalHint' => 'All articles',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New Article'),
        ];
    }
}
