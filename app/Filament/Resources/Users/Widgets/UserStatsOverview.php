<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends StatsOverviewWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $users = User::query()->get();
        $inactive = $users->reject(fn (User $user): bool => $user->isActiveAccount())->count();

        return [
            Stat::make('Total users', (string) $users->count())
                ->description($inactive === 0 ? 'All accounts are active' : $inactive.' inactive')
                ->icon(Heroicon::OutlinedUsers)
                ->color('info'),
            Stat::make('Administrators', (string) $users->filter(fn (User $user): bool => $user->isAdministrator())->count())
                ->description('Active administrator access')
                ->icon(Heroicon::OutlinedShieldCheck)
                ->color('primary'),
            Stat::make('Authors', (string) $users->filter(fn (User $user): bool => $user->isAuthor())->count())
                ->description('Active author access')
                ->icon(Heroicon::OutlinedPencilSquare)
                ->color('gray'),
        ];
    }
}
