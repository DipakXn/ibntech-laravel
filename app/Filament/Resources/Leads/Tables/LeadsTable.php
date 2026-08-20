<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Models\Lead;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('job_title')
                    ->label('Job Title')
                    ->toggleable(),
                TextColumn::make('company')
                    ->toggleable(),
                TextColumn::make('service')
                    ->label('Service / Plan')
                    ->toggleable(),
                TextColumn::make('asset_title')
                    ->label('Asset')
                    ->toggleable(),
                TextColumn::make('form_label')
                    ->badge(),
                TextColumn::make('page_url')
                    ->label('Page URL')
                    ->limit(50)
                    ->tooltip(fn ($record): ?string => $record->page_url)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(),
                TextColumn::make('user_agent')
                    ->label('User Agent')
                    ->limit(50)
                    ->tooltip(fn ($record): ?string => $record->user_agent)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('form_name')
                    ->label('Form')
                    ->options(Lead::formOptions()),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Search submissions by name, email, company, or form')
            ->emptyStateIcon('heroicon-o-inbox-stack')
            ->emptyStateHeading('No submissions captured')
            ->emptyStateDescription('When visitors submit forms or download assets, they will appear here.')
            ->striped()
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
