<?php

namespace App\Filament\Resources\Newsletters\Tables;

use App\Filament\Actions\PreviewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NewslettersTable
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
            ->searchPlaceholder('Search newsletters, slugs, and templates')
            ->emptyStateIcon('heroicon-o-envelope')
            ->emptyStateHeading('No newsletters yet')
            ->emptyStateDescription('Create a newsletter page to publish an insight-led email archive or editorial page.')
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
