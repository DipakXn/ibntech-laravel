<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AdminEventsRelationManager extends RelationManager
{
    protected static string $relationship = 'adminEvents';

    protected static ?string $title = 'Audit history';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return UserResource::canViewAny();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('When')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('action')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline()->toString()),
                TextColumn::make('actor_email')
                    ->label('Actor')
                    ->placeholder('System'),
                TextColumn::make('changes')
                    ->formatStateUsing(function (mixed $state): string {
                        if (! is_array($state) || $state === []) {
                            return '—';
                        }

                        return collect($state)->map(function (mixed $value, string $key): string {
                            if ($key === 'password') {
                                return 'Password changed';
                            }

                            if (is_array($value)) {
                                return $key.': '.self::display($value['from'] ?? null).' → '.self::display($value['to'] ?? null);
                            }

                            return $key.': '.self::display($value);
                        })->implode('; ');
                    })
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25])
            ->headerActions([])
            ->recordActions([])
            ->emptyStateHeading('No account changes yet')
            ->emptyStateDescription('Role, password, activation, invitation, and deletion events are recorded here.');
    }

    private static function display(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'yes' : 'no';
        }

        if ($value === null || $value === '') {
            return '—';
        }

        return (string) $value;
    }
}
