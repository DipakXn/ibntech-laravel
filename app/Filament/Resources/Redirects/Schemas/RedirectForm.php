<?php

namespace App\Filament\Resources\Redirects\Schemas;

use App\Models\ContentRedirect;
use App\Rules\ValidManagedRedirect;
use App\Services\SiteRedirects;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\Size;

class RedirectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->extraAttributes(['class' => 'ibn-redirection-form'])
                    ->schema([
                        Repeater::make('sources')
                            ->label('Source URLs')
                            ->extraAttributes(['class' => 'ibn-redirection-sources'])
                            ->schema([
                                Group::make()
                                    ->extraAttributes(['class' => 'ibn-source-fields'])
                                    ->schema([
                                        TextInput::make('source_path')
                                            ->hiddenLabel()
                                            ->required()
                                            ->maxLength(2048)
                                            ->placeholder(fn (Get $get): string => match ((string) $get('match_type')) {
                                                ContentRedirect::MATCH_CONTAINS => 'Enter text the path contains',
                                                ContentRedirect::MATCH_STARTS_WITH => 'Enter the beginning of the path',
                                                ContentRedirect::MATCH_ENDS_WITH => 'Enter the end of the path',
                                                ContentRedirect::MATCH_REGEX => 'Enter a regular expression',
                                                default => 'Enter the full source path',
                                            })
                                            ->live(onBlur: true)
                                            ->extraAttributes(['class' => 'ibn-source-input'])
                                            ->rules([
                                                fn (Get $get, ?ContentRedirect $record): ValidManagedRedirect => new ValidManagedRedirect(
                                                    (string) $get('../../target_path'),
                                                    $record?->getKey(),
                                                    (int) ($get('../../status_code') ?: ContentRedirect::STATUS_PERMANENT),
                                                    (string) ($get('match_type') ?: ContentRedirect::MATCH_EXACT),
                                                    in_array($get('ignore_case'), [1, '1', true], true),
                                                ),
                                            ]),
                                        Select::make('match_type')
                                            ->hiddenLabel()
                                            ->options([
                                                ContentRedirect::MATCH_EXACT => 'Exact',
                                                ContentRedirect::MATCH_CONTAINS => 'Contains',
                                                ContentRedirect::MATCH_STARTS_WITH => 'Starts With',
                                                ContentRedirect::MATCH_ENDS_WITH => 'End With',
                                                ContentRedirect::MATCH_REGEX => 'Regex',
                                            ])
                                            ->default(ContentRedirect::MATCH_EXACT)
                                            ->selectablePlaceholder(false)
                                            ->native(true)
                                            ->live()
                                            ->required()
                                            ->extraAttributes(['class' => 'ibn-source-match']),
                                        Checkbox::make('ignore_case')
                                            ->label('Ignore Case')
                                            ->default(false)
                                            ->live()
                                            ->extraAttributes(['class' => 'ibn-source-ignore-case']),
                                    ]),
                            ])
                            ->defaultItems(1)
                            ->minItems(1)
                            ->maxItems(20)
                            ->reorderable(false)
                            ->addActionLabel('Add another')
                            ->addActionAlignment(Alignment::Start)
                            ->addAction(fn (Action $action): Action => $action
                                ->label('Add another')
                                ->color('gray')
                                ->size(Size::Medium))
                            ->deleteAction(fn (Action $action): Action => $action
                                ->label('Remove')
                                ->icon(null)
                                ->link()
                                ->color('danger')
                                ->size(Size::Medium))
                            ->rules([
                                fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
                                    $redirects = app(SiteRedirects::class);
                                    $paths = collect(is_array($value) ? $value : [])
                                        ->map(function (mixed $item) use ($redirects): ?string {
                                            if (! is_array($item)) {
                                                return null;
                                            }

                                            $type = (string) ($item['match_type'] ?? ContentRedirect::MATCH_EXACT);
                                            $pattern = $redirects->normalizePattern((string) ($item['source_path'] ?? ''), $type);

                                            return $pattern === null ? null : $type.'|'.$pattern;
                                        })
                                        ->filter();

                                    if ($paths->count() !== $paths->unique()->count()) {
                                        $fail('Each source URL must be different.');
                                    }
                                },
                            ]),
                        TextInput::make('target_path')
                            ->label('Destination URL')
                            ->required(fn (Get $get): bool => ! ContentRedirect::hidesTarget((int) $get('status_code')))
                            ->maxLength(2048)
                            ->placeholder('Enter a path or a full URL'),
                        ToggleButtons::make('status_code')
                            ->label('Redirection Type')
                            ->options([
                                (string) ContentRedirect::STATUS_PERMANENT => '301 Permanent Move',
                                (string) ContentRedirect::STATUS_TEMPORARY => '302 Temporary Move',
                                (string) ContentRedirect::STATUS_TEMPORARY_STRICT => '307 Temporary Redirect',
                                (string) ContentRedirect::STATUS_GONE => '410 Content Deleted',
                                (string) ContentRedirect::STATUS_LEGAL => '451 Content Unavailable for Legal Reasons',
                            ])
                            ->colors([
                                (string) ContentRedirect::STATUS_PERMANENT => 'primary',
                                (string) ContentRedirect::STATUS_TEMPORARY => 'primary',
                                (string) ContentRedirect::STATUS_TEMPORARY_STRICT => 'primary',
                                (string) ContentRedirect::STATUS_GONE => 'primary',
                                (string) ContentRedirect::STATUS_LEGAL => 'primary',
                            ])
                            ->default((string) ContentRedirect::STATUS_PERMANENT)
                            ->formatStateUsing(fn (mixed $state): string => (string) ($state ?: ContentRedirect::STATUS_PERMANENT))
                            ->dehydrateStateUsing(fn (mixed $state): int => (int) $state)
                            ->inline()
                            ->live()
                            ->required()
                            ->extraAttributes(['class' => 'ibn-redirection-type']),
                        ToggleButtons::make('is_active')
                            ->label('Status')
                            ->options([
                                '1' => 'Activate',
                                '0' => 'Deactivate',
                            ])
                            ->colors([
                                '1' => 'primary',
                                '0' => 'gray',
                            ])
                            ->default('1')
                            ->formatStateUsing(fn (mixed $state): string => $state === null || in_array($state, [1, '1', true], true) ? '1' : '0')
                            ->dehydrateStateUsing(fn (mixed $state): bool => in_array($state, [1, '1', true], true))
                            ->grouped()
                            ->inline()
                            ->required()
                            ->extraAttributes(['class' => 'ibn-redirection-status']),
                    ]),
            ]);
    }
}
