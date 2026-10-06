<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentLeadsWidget extends TableWidget
{
    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent submission activity')
            ->description('Surface new contact requests and downloads without leaving the dashboard.')
            ->query(Lead::query()->latest()->limit(8))
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->weight('medium'),
                TextColumn::make('company')
                    ->placeholder('Independent')
                    ->toggleable(),
                TextColumn::make('form_label')
                    ->badge(),
                TextColumn::make('email')
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Search submissions, companies, or emails')
            ->emptyStateIcon('heroicon-o-inbox-stack')
            ->emptyStateHeading('No submissions yet')
            ->emptyStateDescription('New enquiries and downloads will appear here as soon as the site starts capturing them.')
            ->paginated(false);
    }
}
