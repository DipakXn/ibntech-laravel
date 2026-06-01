<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
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
                TextColumn::make('role')
                    ->badge()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('name')
            ->searchPlaceholder('Search users and roles')
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading('No users found')
            ->emptyStateDescription('Invite a teammate when you are ready to expand admin access.')
            ->striped()
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
