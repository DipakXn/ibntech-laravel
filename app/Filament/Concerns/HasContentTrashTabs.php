<?php

namespace App\Filament\Concerns;

use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

trait HasContentTrashTabs
{
    /**
     * @return array<string, Tab>
     */
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'trash' => Tab::make('Trash')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query
                    ->withoutGlobalScopes([
                        SoftDeletingScope::class,
                    ])
                    ->onlyTrashed()),
        ];
    }

    public function isTrashTabActive(): bool
    {
        return ($this->activeTab ?? 'all') === 'trash';
    }
}
