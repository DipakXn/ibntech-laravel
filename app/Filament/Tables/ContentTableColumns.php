<?php

namespace App\Filament\Tables;

use App\Filament\Concerns\HasContentTrashTabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;

class ContentTableColumns
{
    public static function trashedAt(): TextColumn
    {
        return TextColumn::make('deleted_at')
            ->label('Trashed')
            ->dateTime()
            ->sortable()
            ->visible(fn (HasTable $livewire): bool => static::isTrashTab($livewire));
    }

    protected static function isTrashTab(HasTable $livewire): bool
    {
        if (! $livewire instanceof Component) {
            return false;
        }

        if (in_array(HasContentTrashTabs::class, class_uses_recursive($livewire), true)) {
            /** @var HasContentTrashTabs&Component $livewire */
            return $livewire->isTrashTabActive();
        }

        return property_exists($livewire, 'activeTab') && ($livewire->activeTab ?? 'all') === 'trash';
    }
}
