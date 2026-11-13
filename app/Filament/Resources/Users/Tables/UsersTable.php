<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->withLastSessionActivity())
            ->columns([
                TextColumn::make('avatar')
                    ->label('')
                    ->state(fn (User $record): string => self::initials($record->name))
                    ->formatStateUsing(fn (string $state): HtmlString => new HtmlString('<span class="ibn-user-avatar" aria-hidden="true">'.e($state).'</span>'))
                    ->html(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (User $record): ?string => auth()->id() === $record->getKey() ? 'Signed in as this user' : null)
                    ->icon(fn (User $record): ?string => auth()->id() === $record->getKey() ? 'heroicon-o-check-circle' : null)
                    ->iconColor('primary'),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('role')
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => self::roleLabel($state))
                    ->color(fn (string $state): string => match ($state) {
                        User::ROLE_ADMINISTRATOR => 'primary',
                        User::ROLE_AUTHOR => 'info',
                        default => 'gray',
                    }),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('last_session_activity')
                    ->label('Last session activity')
                    ->placeholder('No active session')
                    ->tooltip('Latest timestamp in the sessions table for this account. It shows current sessions, not a permanent login history.')
                    ->formatStateUsing(function (mixed $state): ?string {
                        if (blank($state)) {
                            return null;
                        }

                        return Carbon::createFromTimestamp((int) $state)
                            ->timezone((string) config('app.timezone'))
                            ->format('M j, Y g:i A');
                    })
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        User::ROLE_ADMINISTRATOR => 'Administrator',
                        User::ROLE_AUTHOR => 'Author',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Account status')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->placeholder('All accounts'),
            ])
            ->defaultSort('updated_at', 'desc')
            ->searchPlaceholder('Search by name or email')
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateHeading('No users found')
            ->emptyStateDescription('Invite a teammate when you are ready to expand admin access.')
            ->striped()
            ->recordActions([
                EditAction::make(),
                self::deleteAction(),
            ]);
    }

    public static function deleteAction(): DeleteAction
    {
        return DeleteAction::make()
            ->visible(fn (User $record): bool => UserResource::canDelete($record))
            ->modalDescription('This removes sign-in access immediately. You cannot delete your own account or the last active administrator.');
    }

    public static function roleLabel(string $role): string
    {
        return match ($role) {
            User::ROLE_ADMINISTRATOR => 'Administrator',
            User::ROLE_AUTHOR => 'Author',
            default => ucfirst($role),
        };
    }

    public static function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $first = mb_substr((string) ($parts[0] ?? 'U'), 0, 1);
        $second = mb_substr((string) ($parts[1] ?? ''), 0, 1);

        return mb_strtoupper($first.$second);
    }
}
