<?php

namespace App\Filament\Resources\OldSubmissions\Tables;

use App\Filament\Resources\OldSubmissions\OldSubmissionResource;
use App\Models\OldSubmission;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OldSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(query: function (Builder $query, string $search): void {
                        $like = '%'.addcslashes($search, '%_\\').'%';
                        $columns = [
                            'name',
                            'email',
                            'phone',
                            'company',
                            'form_name',
                            'message',
                            'service',
                            'job_title',
                            'city',
                            'lead_source',
                            'external_submission_id',
                            'page_url',
                        ];

                        $query->where(function (Builder $query) use ($columns, $like): void {
                            foreach ($columns as $index => $column) {
                                $method = $index === 0 ? 'where' : 'orWhere';
                                $query->{$method}($column, 'like', $like);
                            }

                            $query->orWhere('fields', 'like', $like);
                        });
                    })
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('email')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('phone')
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('company')
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('job_title')
                    ->label('Job title')
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('service')
                    ->label('Service')
                    ->toggleable()
                    ->placeholder('—'),
                TextColumn::make('city')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),
                TextColumn::make('form_name')
                    ->label('Form')
                    ->badge()
                    ->sortable(),
                TextColumn::make('page_url')
                    ->label('Page URL')
                    ->limit(50)
                    ->tooltip(fn (OldSubmission $record): ?string => $record->page_url)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ip_address')
                    ->label('IP address')
                    ->toggleable(),
                TextColumn::make('external_submission_id')
                    ->label('Submission ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('submitted_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('form_name')
                    ->label('Form')
                    ->options(fn (): array => OldSubmission::optionsFor('form_name'))
                    ->searchable(),
                Filter::make('submitted_at')
                    ->label('Submitted')
                    ->schema([
                        DatePicker::make('from')->label('From date'),
                        DatePicker::make('until')->label('Until date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('submitted_at', '>=', $date))
                            ->when($data['until'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('submitted_at', '<=', $date));
                    }),
                SelectFilter::make('lead_source')
                    ->label('Lead source')
                    ->options(fn (): array => OldSubmission::optionsFor('lead_source'))
                    ->searchable(),
                SelectFilter::make('service')
                    ->label('Service')
                    ->options(fn (): array => OldSubmission::optionsFor('service'))
                    ->searchable(),
                SelectFilter::make('utm_source')
                    ->label('UTM source')
                    ->options(fn (): array => OldSubmission::optionsFor('utm_source'))
                    ->searchable(),
            ])
            ->defaultSort('submitted_at', 'desc')
            ->searchPlaceholder('Search by name, email, company, form, or any exported field')
            ->emptyStateIcon('heroicon-o-archive-box')
            ->emptyStateHeading('No historical submissions imported')
            ->emptyStateDescription('Elementor exports appear here after old-submissions:import runs. This list is read-only.')
            ->striped()
            ->recordUrl(fn (OldSubmission $record): string => OldSubmissionResource::getUrl('view', ['record' => $record]))
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
