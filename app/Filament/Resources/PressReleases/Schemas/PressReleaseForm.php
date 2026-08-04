<?php

namespace App\Filament\Resources\PressReleases\Schemas;

use App\Filament\Schemas\ContentBuilder;
use App\Filament\Schemas\SeoMetaSchema;
use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Helpers\TemplateHelper;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PressReleaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
            ])
            ->components([
                Section::make('Press release details')
                    ->description('Set the announcement copy, URL, and presentation template.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('template')
                            ->options(TemplateHelper::pressReleaseTemplateOptions())
                            ->default('default')
                            ->required(),
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Section::make('Publishing')
                    ->description('Manage category, visibility, and supporting artwork.')
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name', fn ($query) => $query->forModule(Category::MODULE_PRESS_RELEASE))
                            ->searchable()
                            ->preload()
                            ->createOptionForm(self::categoryFields())
                            ->createOptionUsing(fn (array $data): int => Category::query()->create([
                                ...$data,
                                'module' => Category::MODULE_PRESS_RELEASE,
                            ])->getKey()),
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->collection('featured_image')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('180')
                            ->maxSize(4096),
                    ])
                    ->columnSpan(1),
                ContentBuilder::make(),
                SeoMetaSchema::make(),
            ]);
    }

    private static function categoryFields(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->rules([
                    fn () => \Illuminate\Validation\Rule::unique(Category::class, 'slug')
                        ->where('module', Category::MODULE_PRESS_RELEASE),
                ]),
            Select::make('parent_id')
                ->label('Parent Category')
                ->options(fn (): array => self::parentOptions(Category::MODULE_PRESS_RELEASE))
                ->searchable()
                ->preload()
                ->placeholder('None'),
        ];
    }

    private static function parentOptions(string $module): array
    {
        $categories = Category::query()
            ->forModule($module)
            ->with('childrenRecursive')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return self::flattenCategories($categories);
    }

    private static function flattenCategories(Collection $categories, int $depth = 0): array
    {
        $options = [];

        foreach ($categories as $category) {
            $options[$category->id] = str_repeat('- ', $depth).$category->name;
            $options += self::flattenCategories($category->childrenRecursive, $depth + 1);
        }

        return $options;
    }
}
