<?php

namespace App\Filament\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroupedRecordActions
{
    /**
     * @param  array<Action|ActionGroup>  $actions
     */
    public static function apply(Table $table, array $actions): Table
    {
        return $table
            ->recordActionsColumnLabel('Actions')
            ->recordActions([
                self::group($actions),
            ]);
    }

    /**
     * @param  array<Action|ActionGroup>  $actions
     */
    public static function group(array $actions): ActionGroup
    {
        return ActionGroup::make($actions)
            ->label('Actions')
            ->icon(Heroicon::EllipsisVertical)
            ->color('gray')
            ->button()
            ->outlined()
            ->size(Size::Small)
            ->extraAttributes([
                'class' => 'ibn-content-actions',
            ]);
    }
}
