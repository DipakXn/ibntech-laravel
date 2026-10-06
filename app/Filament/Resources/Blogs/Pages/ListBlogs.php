<?php

namespace App\Filament\Resources\Blogs\Pages;

use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\Concerns\ShowsPeriodOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBlogs extends ListRecords
{
    use ShowsPeriodOverview;

    protected static string $resource = BlogResource::class;

    protected function periodOverview(): array
    {
        return [
            'heading' => 'Blog Overview',
            'totalLabel' => 'Total Blogs',
            'totalHint' => 'All blogs',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
