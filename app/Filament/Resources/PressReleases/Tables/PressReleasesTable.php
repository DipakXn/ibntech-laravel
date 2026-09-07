<?php

namespace App\Filament\Resources\PressReleases\Tables;

use App\Filament\Actions\PreviewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PressReleasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('template')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
            ])
            ->defaultSort(fn ($query) => $query->latest())
            ->searchPlaceholder('Search press releases and status')
            ->emptyStateIcon('heroicon-o-newspaper')
            ->emptyStateHeading('No press releases yet')
            ->emptyStateDescription('Add your first company announcement to build the press archive.')
            ->striped()
            ->recordActions([
                PreviewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
