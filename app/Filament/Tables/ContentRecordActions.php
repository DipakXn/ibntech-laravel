<?php

namespace App\Filament\Tables;

use App\CmsPreview\CmsPreviewType;
use App\Filament\Actions\ForceDeleteContentAction;
use App\Filament\Actions\MoveToTrashAction;
use App\Filament\Actions\PreviewAction;
use App\Filament\Actions\RestoreContentAction;
use Filament\Actions\ActionGroup;
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
            PreviewAction::make()
                ->visible(fn (?Model $record): bool => static::isActive($record)),
            EditAction::make()
                ->color('gray')
                ->icon(Heroicon::OutlinedPencil)
                ->visible(fn (?Model $record): bool => static::isActive($record) && static::allows($record, 'edit')),
            MoveToTrashAction::make()
                ->visible(fn (?Model $record): bool => static::isActive($record) && static::allows($record, 'delete')),
            RestoreContentAction::make()
                ->visible(fn (?Model $record): bool => static::isTrashed($record) && static::allows($record, 'delete')),
            ForceDeleteContentAction::make()
                ->visible(fn (?Model $record): bool => static::isTrashed($record) && static::allows($record, 'delete')),
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

    protected static function isActive(?Model $record): bool
    {
        if (! $record) {
            return true;
        }

        if (! method_exists($record, 'trashed')) {
            return true;
        }

        return ! $record->trashed();
    }

    protected static function isTrashed(?Model $record): bool
    {
        if (! $record || ! method_exists($record, 'trashed')) {
            return false;
        }

        return $record->trashed();
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
