<?php

namespace App\Filament\Resources\Redirects\Tables;

use App\Filament\Resources\Redirects\Pages\ListRedirects;
use App\Filament\Tables\GroupedRecordActions;
use App\Models\ContentRedirect;
use App\Support\PathPageUrl;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class RedirectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('source_path')
                    ->label('From')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => self::publicPath($state))
                    ->wrap(),
                TextColumn::make('target_path')
                    ->label('To')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function (?string $state, ContentRedirect $record): string {
                        if ((int) $record->status_code === ContentRedirect::STATUS_GONE) {
                            return '410 Gone';
                        }

                        if ((int) $record->status_code === ContentRedirect::STATUS_LEGAL) {
                            return '451 Unavailable';
                        }

                        if ($state === null || $state === '') {
                            return '—';
                        }

                        if (preg_match('/^https?:\/\//i', $state) === 1) {
                            return $state;
                        }

                        return PathPageUrl::withTrailingSlash(url($state));
                    })
                    ->wrap(),
                TextColumn::make('status_code')
                    ->label('Type')
                    ->sortable(),
                TextColumn::make('hits')
                    ->label('Hits')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('F j, Y, G:i')
                    ->sortable(),
                TextColumn::make('last_accessed_at')
                    ->label('Last Accessed')
                    ->dateTime('F j, Y, G:i')
                    ->placeholder('—')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Search')
            ->emptyStateIcon(Heroicon::OutlinedArrowUturnRight)
            ->emptyStateHeading('No redirections')
            ->emptyStateDescription('Add a redirection, or change a published slug. Moved WordPress redirects are already in this list.')
            ->striped()
            ->recordActionsColumnLabel('Actions')
            ->recordActions([
                GroupedRecordActions::group([
                    Action::make('toggle')
                        ->label(fn (ContentRedirect $record): string => $record->is_active ? 'Deactivate' : 'Activate')
                        ->icon(Heroicon::OutlinedPower)
                        ->visible(fn (ContentRedirect $record): bool => ! $record->trashed())
                        ->action(function (ContentRedirect $record): void {
                            $record->update(['is_active' => ! $record->is_active]);
                        }),
                    EditAction::make()
                        ->color('gray')
                        ->icon(Heroicon::OutlinedPencil)
                        ->visible(fn (ContentRedirect $record): bool => ! $record->trashed()),
                    Action::make('trash')
                        ->label('Move to Trash')
                        ->icon(Heroicon::OutlinedTrash)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (ContentRedirect $record): bool => ! $record->trashed())
                        ->action(fn (ContentRedirect $record) => $record->delete()),
                    Action::make('restore')
                        ->label('Restore')
                        ->icon(Heroicon::OutlinedArrowUturnLeft)
                        ->color('success')
                        ->visible(fn (ContentRedirect $record): bool => $record->trashed())
                        ->action(fn (ContentRedirect $record) => $record->restore()),
                    Action::make('forceDelete')
                        ->label('Delete permanently')
                        ->icon(Heroicon::OutlinedTrash)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (ContentRedirect $record): bool => $record->trashed())
                        ->action(fn (ContentRedirect $record) => $record->forceDelete()),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('activate')
                        ->label('Activate')
                        ->icon(Heroicon::OutlinedCheck)
                        ->visible(fn (ListRedirects $livewire): bool => ! $livewire->isTrashTabActive())
                        ->action(function (Collection $records): void {
                            $records->each(fn (ContentRedirect $record) => $record->update(['is_active' => true]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('deactivate')
                        ->label('Deactivate')
                        ->icon(Heroicon::OutlinedNoSymbol)
                        ->visible(fn (ListRedirects $livewire): bool => ! $livewire->isTrashTabActive())
                        ->action(function (Collection $records): void {
                            $records->each(fn (ContentRedirect $record) => $record->update(['is_active' => false]));
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('trash')
                        ->label('Move to Trash')
                        ->icon(Heroicon::OutlinedTrash)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (ListRedirects $livewire): bool => ! $livewire->isTrashTabActive())
                        ->action(function (Collection $records): void {
                            $records->each(fn (ContentRedirect $record) => $record->delete());
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('restore')
                        ->label('Restore')
                        ->icon(Heroicon::OutlinedArrowUturnLeft)
                        ->color('success')
                        ->visible(fn (ListRedirects $livewire): bool => $livewire->isTrashTabActive())
                        ->action(function (Collection $records): void {
                            $records->each(fn (ContentRedirect $record) => $record->restore());
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('forceDelete')
                        ->label('Delete permanently')
                        ->icon(Heroicon::OutlinedTrash)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (ListRedirects $livewire): bool => $livewire->isTrashTabActive())
                        ->action(function (Collection $records): void {
                            $records->each(fn (ContentRedirect $record) => $record->forceDelete());
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    private static function publicPath(string $path): string
    {
        if ($path === '/') {
            return '/';
        }

        return rtrim($path, '/').'/';
    }
}
