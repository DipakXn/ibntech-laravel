<?php

namespace App\Filament\Resources\AnalyticsExcludedIps\Tables;

use App\Filament\Tables\GroupedRecordActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnalyticsExcludedIpsTable
{
    public static function configure(Table $table): Table
    {
        $table = $table
            ->columns([
                TextColumn::make('ip_address')
                    ->label('IP address or range')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->placeholder('No description')
                    ->searchable()
                    ->wrap(),
                IconColumn::make('is_enabled')
                    ->label('Enabled')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('ip_address')
            ->searchPlaceholder('Search addresses and descriptions')
            ->emptyStateIcon('heroicon-o-no-symbol')
            ->emptyStateHeading('No excluded IPs')
            ->emptyStateDescription('Add an office, localhost, or network range to keep internal traffic out of visitor analytics.')
            ->striped();

        return GroupedRecordActions::apply($table, [
            EditAction::make()
                ->color('gray')
                ->icon(Heroicon::OutlinedPencil),
            DeleteAction::make(),
        ]);
    }
}
