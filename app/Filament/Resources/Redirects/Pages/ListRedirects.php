<?php

namespace App\Filament\Resources\Redirects\Pages;

use App\Filament\Resources\Redirects\RedirectResource;
use App\Models\ContentRedirect;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListRedirects extends ListRecords
{
    protected static string $resource = RedirectResource::class;

    public function isTrashTabActive(): bool
    {
        return ($this->activeTab ?? 'all') === 'trash';
    }

    /**
     * @return array<string, Tab>
     */
    public function getTabs(): array
    {
        $active = ContentRedirect::query()->where('is_active', true)->count();
        $inactive = ContentRedirect::query()->where('is_active', false)->count();
        $trashed = ContentRedirect::onlyTrashed()->count();

        return [
            'all' => Tab::make('All ('.($active + $inactive).')'),
            'active' => Tab::make('Active ('.$active.')')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('is_active', true)),
            'inactive' => Tab::make('Inactive ('.$inactive.')')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('is_active', false)),
            'trash' => Tab::make('Trash ('.$trashed.')')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query
                    ->withoutGlobalScopes([SoftDeletingScope::class])
                    ->onlyTrashed()),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add New'),
        ];
    }
}
