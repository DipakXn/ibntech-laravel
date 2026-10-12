<?php

namespace App\Filament\Tables;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Actions\PreviewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContentRecordActions
{
    public static function apply(Table $table): Table
    {
        return $table
            ->recordActionsColumnLabel('Actions')
            ->recordActions([
                static::make(),
            ]);
    }

    public static function make(): ActionGroup
    {
        return ActionGroup::make([
            PreviewAction::make(),
            EditAction::make()
                ->color('gray')
                ->icon(Heroicon::OutlinedPencil)
                ->visible(fn (?Model $record): bool => static::allows($record, 'edit')),
            DeleteAction::make()
                ->icon(Heroicon::OutlinedTrash)
                ->visible(fn (?Model $record): bool => static::allows($record, 'delete')),
        ])
            ->label('Actions')
            ->icon(Heroicon::EllipsisVertical)
            ->color('gray')
            ->button()
            ->outlined()
            ->size(Size::Small)
            ->extraAttributes([
                'class' => 'ibn-content-actions',
            ]);
    }

    protected static function allows(?Model $record, string $ability): bool
    {
        if (! $record) {
            return true;
        }

        $resource = CmsPreviewType::tryFromModel($record)?->filamentResource();

        if ($resource === null) {
            return false;
        }

        return match ($ability) {
            'edit' => $resource::canEdit($record),
            'delete' => $resource::canDelete($record),
            default => false,
        };
    }
}
