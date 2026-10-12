<?php

namespace App\Filament\Resources\Newsletters\Tables;

use App\Filament\Tables\ContentBulkActions;
use App\Filament\Tables\ContentRecordActions;
use App\Filament\Tables\ContentTableColumns;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NewslettersTable
{
    public static function configure(Table $table): Table
    {
        $table
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
                ContentTableColumns::trashedAt(),
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
            ->toolbarActions([
                ContentBulkActions::group(),
            ]);

        return ContentRecordActions::apply($table);
    }
}
