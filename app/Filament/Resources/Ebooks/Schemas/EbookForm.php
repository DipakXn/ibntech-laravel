<?php

namespace App\Filament\Resources\Ebooks\Schemas;

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

class EbookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
            ])
            ->components([
                Section::make('Asset details')
                    ->description('Define the download record and landing page structure.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('template')
                            ->options(TemplateHelper::ebookTemplateOptions())
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
                    ->description('Set category, live status, and the cover artwork.')
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name', fn ($query) => $query->forModule(Category::MODULE_EBOOK))
                            ->searchable()
                            ->preload()
                            ->createOptionForm(self::categoryFields())
                            ->createOptionUsing(fn (array $data): int => Category::query()->create([
                                ...$data,
                                'module' => Category::MODULE_EBOOK,
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
                            ->disk('public')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('180')
                            ->maxSize(4096),
                        SpatieMediaLibraryFileUpload::make('download_pdf')
                            ->label('eBook PDF')
                            ->collection('download_pdf')
                            ->disk('public')
                            ->visibility('public')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240),
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
                        ->where('module', Category::MODULE_EBOOK),
                ]),
            Select::make('parent_id')
                ->label('Parent Category')
                ->options(fn (): array => self::parentOptions(Category::MODULE_EBOOK))
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
