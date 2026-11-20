<?php

namespace App\Filament\Resources\Testimonials\Tables;

use App\Filament\Tables\GroupedRecordActions;
use App\Models\Testimonial;
use App\Support\Testimonials\TestimonialPlacements;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        $table = $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('company_name')
                    ->label('Company')
                    ->placeholder('—')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('quote')
                    ->label('Testimonial')
                    ->searchable()
                    ->limit(80)
                    ->wrap(),
                TextColumn::make('rating')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === Testimonial::STATUS_PUBLISHED ? 'Published' : 'Unpublished')
                    ->color(fn (string $state): string => $state === Testimonial::STATUS_PUBLISHED ? 'success' : 'gray')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sections')
                    ->label('Sections')
                    ->state(fn (Testimonial $record): string => $record->placements
                        ->map(fn ($placement): string => TestimonialPlacements::label($placement->placement))
                        ->join(', '))
                    ->placeholder('None')
                    ->wrap(),
                TextColumn::make('servicePage.title')
                    ->label('Related service')
                    ->placeholder('—')
                    ->wrap(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M j, Y g:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        Testimonial::STATUS_PUBLISHED => 'Published',
                        Testimonial::STATUS_UNPUBLISHED => 'Unpublished',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->placeholder('All'),
                SelectFilter::make('placement')
                    ->label('Section')
                    ->options(fn (): array => TestimonialPlacements::options())
                    ->searchable()
                    ->query(function (Builder $query, array $data): Builder {
                        $value = $data['value'] ?? null;

                        if (! is_string($value) || $value === '') {
                            return $query;
                        }

                        return $query->whereHas(
                            'placements',
                            fn (Builder $query): Builder => $query->where('placement', $value),
                        );
                    }),
                SelectFilter::make('page_id')
                    ->label('Related service')
                    ->relationship('servicePage', 'title')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('rating')
                    ->options([
                        1 => '1 star',
                        2 => '2 stars',
                        3 => '3 stars',
                        4 => '4 stars',
                        5 => '5 stars',
                    ]),
            ])
            ->defaultSort('customer_name')
            ->searchPlaceholder('Search name, company, or testimonial')
            ->emptyStateIcon(Heroicon::OutlinedChatBubbleLeftRight)
            ->emptyStateHeading('No testimonials')
            ->emptyStateDescription('Add a client quote, then choose the sections where it should appear.')
            ->striped()
            ->toolbarActions([
                BulkActionGroup::make([
                    self::bulkStatus('publish', 'Publish', Testimonial::STATUS_PUBLISHED, Heroicon::OutlinedCheckCircle),
                    self::bulkStatus('unpublish', 'Unpublish', Testimonial::STATUS_UNPUBLISHED, Heroicon::OutlinedEyeSlash),
                    self::bulkActive('activate', 'Activate', true, Heroicon::OutlinedCheck),
                    self::bulkActive('deactivate', 'Deactivate', false, Heroicon::OutlinedNoSymbol),
                    DeleteBulkAction::make(),
                ]),
            ]);

        return GroupedRecordActions::apply($table, [
            EditAction::make()
                ->color('gray')
                ->icon(Heroicon::OutlinedPencil),
            self::statusAction('publish', 'Publish', Testimonial::STATUS_PUBLISHED, Heroicon::OutlinedCheckCircle),
            self::statusAction('unpublish', 'Unpublish', Testimonial::STATUS_UNPUBLISHED, Heroicon::OutlinedEyeSlash),
            self::activeAction('activate', 'Activate', true, Heroicon::OutlinedCheck),
            self::activeAction('deactivate', 'Deactivate', false, Heroicon::OutlinedNoSymbol),
            DeleteAction::make(),
        ]);
    }

    private static function statusAction(string $name, string $label, string $status, Heroicon $icon): Action
    {
        return Action::make($name)
            ->label($label)
            ->icon($icon)
            ->requiresConfirmation()
            ->visible(fn (Testimonial $record): bool => $record->status !== $status)
            ->action(fn (Testimonial $record) => $record->update(['status' => $status]));
    }

    private static function activeAction(string $name, string $label, bool $active, Heroicon $icon): Action
    {
        return Action::make($name)
            ->label($label)
            ->icon($icon)
            ->requiresConfirmation()
            ->visible(fn (Testimonial $record): bool => $record->is_active !== $active)
            ->action(fn (Testimonial $record) => $record->update(['is_active' => $active]));
    }

    private static function bulkStatus(string $name, string $label, string $status, Heroicon $icon): BulkAction
    {
        return BulkAction::make($name)
            ->label($label)
            ->icon($icon)
            ->requiresConfirmation()
            ->deselectRecordsAfterCompletion()
            ->action(fn (Collection $records) => $records->each(fn (Testimonial $record) => $record->update(['status' => $status])));
    }

    private static function bulkActive(string $name, string $label, bool $active, Heroicon $icon): BulkAction
    {
        return BulkAction::make($name)
            ->label($label)
            ->icon($icon)
            ->requiresConfirmation()
            ->deselectRecordsAfterCompletion()
            ->action(fn (Collection $records) => $records->each(fn (Testimonial $record) => $record->update(['is_active' => $active])));
    }
}
