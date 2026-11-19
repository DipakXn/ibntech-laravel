<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Filament\Resources\Leads\LeadResource;
use App\Filament\Tables\GroupedRecordActions;
use App\Models\Lead;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        $table = $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(query: fn (Builder $query, string $search): Builder => self::applySearch($query, $search))
                    ->sortable(),
                TextColumn::make('email')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Lead::STATUS_SPAM => 'Spam',
                        default => 'New',
                    })
                    ->color(fn (string $state): string => $state === Lead::STATUS_SPAM ? 'danger' : 'success'),
                TextColumn::make('job_title')
                    ->label('Job Title')
                    ->toggleable(),
                TextColumn::make('company')
                    ->toggleable(),
                TextColumn::make('lead_source')
                    ->label('Lead Source')
                    ->placeholder('')
                    ->toggleable(),
                TextColumn::make('service')
                    ->label('Service / Plan')
                    ->toggleable(),
                TextColumn::make('package_selected')
                    ->label('Selected Plan')
                    ->toggleable(),
                TextColumn::make('needed_service')
                    ->label('Needed Service')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('resource_type')
                    ->label('Resource Type')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('hire_when')
                    ->label('When to hire')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('asset_title')
                    ->label('Asset')
                    ->toggleable(),
                TextColumn::make('form_label')
                    ->badge(),
                TextColumn::make('page_url')
                    ->label('Page URL')
                    ->limit(50)
                    ->tooltip(fn ($record): ?string => $record->page_url)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(),
                TextColumn::make('user_agent')
                    ->label('User Agent')
                    ->limit(50)
                    ->tooltip(fn ($record): ?string => $record->user_agent)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('status')
                    ->label('Status')
                    ->schema([
                        Select::make('value')
                            ->label('Status')
                            ->options(Lead::statusFilterOptions())
                            ->default('inbox')
                            ->selectablePlaceholder(false),
                    ])
                    ->default(['value' => 'inbox'])
                    ->query(fn (Builder $query, array $data): Builder => Lead::applyStatusFilter(
                        $query,
                        is_string($data['value'] ?? null) ? $data['value'] : 'inbox',
                    )),
                SelectFilter::make('form_name')
                    ->label('Form')
                    ->options(Lead::formOptions())
                    ->searchable(),
                Filter::make('created_at')
                    ->label('Submitted')
                    ->schema([
                        DatePicker::make('from')->label('From date'),
                        DatePicker::make('until')->label('Until date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '>=', $date))
                            ->when($data['until'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Search submissions by name, email, company, message, form, or page URL')
            ->emptyStateIcon('heroicon-o-inbox-stack')
            ->emptyStateHeading('No submissions captured')
            ->emptyStateDescription('When visitors submit forms or download assets, they will appear here.')
            ->striped()
            ->recordUrl(fn (Lead $record): string => LeadResource::getUrl('view', ['record' => $record]));

        return GroupedRecordActions::apply($table, [
            ViewAction::make(),
            EditAction::make()
                ->color('gray')
                ->icon(Heroicon::OutlinedPencil),
            Action::make('markSpam')
                ->label('Spam')
                ->icon(Heroicon::OutlinedNoSymbol)
                ->color('danger')
                ->visible(fn (Lead $record): bool => ! $record->isSpam())
                ->requiresConfirmation()
                ->action(function (Lead $record): void {
                    $record->update(['status' => Lead::STATUS_SPAM]);

                    Notification::make()
                        ->title('Submission marked as spam')
                        ->success()
                        ->send();
                }),
            Action::make('markInbox')
                ->label('Restore')
                ->icon(Heroicon::OutlinedInbox)
                ->visible(fn (Lead $record): bool => $record->isSpam())
                ->action(function (Lead $record): void {
                    $record->update(['status' => Lead::STATUS_NEW]);

                    Notification::make()
                        ->title('Submission restored to inbox')
                        ->success()
                        ->send();
                }),
        ])->toolbarActions([
            BulkActionGroup::make([
                BulkAction::make('markAsSpam')
                    ->label('Mark as spam')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Lead $record) => $record->update(['status' => Lead::STATUS_SPAM]));

                        Notification::make()
                            ->title('Submissions marked as spam')
                            ->success()
                            ->send();
                    }),
                BulkAction::make('restoreToInbox')
                    ->label('Restore to inbox')
                    ->icon('heroicon-o-inbox')
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        $records->each(fn (Lead $record) => $record->update(['status' => Lead::STATUS_NEW]));

                        Notification::make()
                            ->title('Submissions restored to inbox')
                            ->success()
                            ->send();
                    }),
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function applySearch(Builder $query, string $search): Builder
    {
        $like = '%'.addcslashes($search, '%_\\').'%';

        return $query->where(function (Builder $query) use ($like): void {
            foreach ([
                'name',
                'email',
                'phone',
                'company',
                'form_name',
                'message',
                'page_url',
            ] as $index => $column) {
                $method = $index === 0 ? 'where' : 'orWhere';
                $query->{$method}($column, 'like', $like);
            }

            $query->orWhere('payload', 'like', $like);
        });
    }
}
