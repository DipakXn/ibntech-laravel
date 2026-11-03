<?php

namespace App\Filament\Clusters\CookieManagement\Resources\CookieIntegrations\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CookieIntegrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category_key')
                    ->label('Category')
                    ->badge(),
                TextColumn::make('environments')
                    ->listWithLineBreaks()
                    ->badge(),
                IconColumn::make('is_enabled')
                    ->label('Enabled')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
