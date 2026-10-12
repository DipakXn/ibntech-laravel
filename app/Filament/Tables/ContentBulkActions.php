<?php

namespace App\Filament\Tables;

use App\Filament\Concerns\HasContentTrashTabs;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Livewire\Component;

class ContentBulkActions
{
    public static function group(): BulkActionGroup
    {
        return BulkActionGroup::make([
            static::moveToTrash(),
            static::restore(),
            static::forceDelete(),
        ]);
    }

    public static function moveToTrash(): DeleteBulkAction
    {
        return DeleteBulkAction::make('trash')
            ->label('Move to Trash')
            ->modalHeading(fn (DeleteBulkAction $action): string => 'Move selected '.$action->getTitleCasePluralModelLabel().' to trash')
            ->modalDescription('Selected items will be moved to trash. You can restore them later from the Trash tab.')
            ->modalSubmitActionLabel('Move to Trash')
            ->successNotificationTitle('Moved to trash')
            ->failureNotificationTitle('Could not move to trash')
            ->icon(Heroicon::OutlinedTrash)
            ->modalIcon(Heroicon::OutlinedTrash)
            ->hidden(fn (HasTable $livewire): bool => static::isTrashTab($livewire));
    }

    public static function restore(): BulkAction
    {
        return BulkAction::make('restore')
            ->label('Restore')
            ->icon(Heroicon::OutlinedArrowUturnLeft)
            ->color('success')
            ->requiresConfirmation()
            ->modalHeading('Restore selected items')
            ->modalDescription('Selected items will be restored and appear in the All listing again.')
            ->modalSubmitActionLabel('Restore')
            ->successNotificationTitle('Restored')
            ->failureNotificationTitle('Could not restore items')
            ->deselectRecordsAfterCompletion()
            ->visible(fn (HasTable $livewire): bool => static::isTrashTab($livewire))
            ->action(function (BulkAction $action, EloquentCollection | Collection | LazyCollection $records): void {
                $records->each(function ($record) use ($action): void {
                    if (! method_exists($record, 'restore') || ! $record->restore()) {
                        $action->reportBulkProcessingFailure();
                    }
                });
            });
    }

    public static function forceDelete(): BulkAction
    {
        return BulkAction::make('forceDelete')
            ->label('Delete Permanently')
            ->icon(Heroicon::OutlinedTrash)
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Delete selected items permanently')
            ->modalDescription('This action cannot be undone. Selected items and their related cleanup rules will be applied permanently.')
            ->modalSubmitActionLabel('Delete permanently')
            ->successNotificationTitle('Deleted permanently')
            ->failureNotificationTitle('Could not delete permanently')
            ->modalIcon(Heroicon::OutlinedTrash)
            ->deselectRecordsAfterCompletion()
            ->visible(fn (HasTable $livewire): bool => static::isTrashTab($livewire))
            ->action(function (BulkAction $action, EloquentCollection | Collection | LazyCollection $records): void {
                $records->each(function ($record) use ($action): void {
                    if (! method_exists($record, 'forceDelete') || ! $record->forceDelete()) {
                        $action->reportBulkProcessingFailure();
                    }
                });
            });
    }

    protected static function isTrashTab(HasTable $livewire): bool
    {
        if (! $livewire instanceof Component) {
            return false;
        }

        if (in_array(HasContentTrashTabs::class, class_uses_recursive($livewire), true)) {
            /** @var HasContentTrashTabs&Component $livewire */
            return $livewire->isTrashTabActive();
        }

        return property_exists($livewire, 'activeTab') && ($livewire->activeTab ?? 'all') === 'trash';
    }
}
