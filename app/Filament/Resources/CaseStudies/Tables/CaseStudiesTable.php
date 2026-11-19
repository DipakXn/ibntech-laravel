<?php

namespace App\Filament\Resources\CaseStudies\Tables;

use App\Filament\Tables\ContentBulkActions;
use App\Filament\Tables\ContentRecordActions;
use App\Filament\Tables\ContentTableColumns;
use App\Support\EditorialPublication;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CaseStudiesTable
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
                    ->badge()
                    ->color(fn (string $state): string => EditorialPublication::badgeColor($state)),
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
                    ->options(EditorialPublication::options()),
            ])
            ->defaultSort(fn ($query) => $query->latest())
            ->searchPlaceholder('Search case studies and status')
            ->emptyStateIcon('heroicon-o-presentation-chart-bar')
            ->emptyStateHeading('No case studies yet')
            ->emptyStateDescription('Add your first proof point to populate the case study library.')
            ->striped()
            ->toolbarActions([
                ContentBulkActions::group(),
            ]);

        return ContentRecordActions::apply($table);
    }
}
