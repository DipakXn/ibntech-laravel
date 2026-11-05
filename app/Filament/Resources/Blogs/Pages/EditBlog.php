<?php

namespace App\Filament\Resources\Blogs\Pages;

use App\Filament\Actions\PreviewAction;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Actions\MoveToTrashAction;
use Filament\Resources\Pages\EditRecord;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            MoveToTrashAction::make(),
        ];
    }
}
