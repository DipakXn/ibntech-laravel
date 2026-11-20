<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Page;
use App\Models\Testimonial;
use App\Support\Testimonials\TestimonialPlacements;
use Closure;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
            ])
            ->components([
                Section::make('Testimonial')
                    ->description('The quote and the person it came from. The website layout stays in the Blade template.')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Customer name')
                            ->required()
                            ->maxLength(2000),
                        TextInput::make('designation')
                            ->maxLength(2000),
                        TextInput::make('company_name')
                            ->label('Company name')
                            ->maxLength(2000),
                        Textarea::make('quote')
                            ->label('Testimonial text')
                            ->required()
                            ->rows(8)
                            ->columnSpanFull(),
                        Select::make('rating')
                            ->options([
                                1 => '1 star',
                                2 => '2 stars',
                                3 => '3 stars',
                                4 => '4 stars',
                                5 => '5 stars',
                            ])
                            ->placeholder('No rating')
                            ->nullable()
                            ->helperText('Optional. The homepage carousel shows this many stars. Leave it empty to hide the stars.'),
                        Select::make('page_id')
                            ->label('Related service')
                            ->relationship(
                                name: 'servicePage',
                                titleAttribute: 'title',
                                modifyQueryUsing: fn (Builder $query): Builder => $query
                                    ->where('status', 'published')
                                    ->orderBy('title'),
                            )
                            ->getOptionLabelFromRecordUsing(fn (Page $record): string => $record->title.' (/'.$record->slug.'/)')
                            ->searchable(['title', 'slug'])
                            ->preload()
                            ->nullable()
                            ->helperText('Optional. The service this quote is about. It does not by itself place the quote on that page.'),
                    ])
                    ->columns(2)
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Section::make('Publishing')
                    ->description('A testimonial is public only when it is published, active, and added to a section.')
                    ->schema([
                        Select::make('status')
                            ->options([
                                Testimonial::STATUS_PUBLISHED => 'Published',
                                Testimonial::STATUS_UNPUBLISHED => 'Unpublished',
                            ])
                            ->default(Testimonial::STATUS_UNPUBLISHED)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Inactive testimonials stay off the website, including published ones.'),
                        SpatieMediaLibraryFileUpload::make('client_image')
                            ->label('Client image or logo')
                            ->collection('client_image')
                            ->visibility('public')
                            ->image()
                            ->maxSize(4096)
                            ->helperText('Optional. The homepage avatar uses this image. Without one, the template keeps the user icon.'),
                    ])
                    ->columnSpan(1),
                Section::make('Sections')
                    ->description('Choose the homepage carousel or a page section, and the order inside that section.')
                    ->schema([
                        Repeater::make('placements')
                            ->relationship()
                            ->schema([
                                Select::make('placement')
                                    ->label('Section')
                                    ->options(fn (): array => TestimonialPlacements::options())
                                    ->searchable()
                                    ->required()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                TextInput::make('sort_order')
                                    ->label('Display order')
                                    ->numeric()
                                    ->integer()
                                    ->minValue(0)
                                    ->required()
                                    ->default(1)
                                    ->helperText('Lower numbers appear first.'),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->reorderable(false)
                            ->addActionLabel('Add section')
                            ->itemLabel(function (array $state): ?string {
                                $placement = $state['placement'] ?? null;

                                return is_string($placement) && $placement !== ''
                                    ? TestimonialPlacements::label($placement)
                                    : null;
                            })
                            ->rules([
                                fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
                                    $placements = collect(is_array($value) ? $value : [])
                                        ->map(fn (mixed $item): ?string => is_array($item) ? ($item['placement'] ?? null) : null)
                                        ->filter(fn (?string $placement): bool => is_string($placement) && $placement !== '');

                                    if ($placements->count() !== $placements->unique()->count()) {
                                        $fail('Each section can be selected once.');
                                    }
                                },
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
