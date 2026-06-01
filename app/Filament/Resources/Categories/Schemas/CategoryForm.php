<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryForm
{
    public static function configure(Schema $schema, string $module = Category::MODULE_BLOG): Schema
    {
        return $schema
            ->columns([
                'lg' => 2,
            ])
            ->components([
                Section::make('Category details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->rules([
                                fn (?Category $record) => Rule::unique(Category::class, 'slug')
                                    ->where('module', $module)
                                    ->ignore($record),
                            ]),
                        Select::make('parent_id')
                            ->label('Parent Category')
                            ->options(fn (?Category $record): array => self::parentOptions($record, $module))
                            ->searchable()
                            ->preload()
                            ->placeholder('None'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    private static function parentOptions(?Category $record, string $module): array
    {
        $excludedIds = $record ? $record->selfAndDescendantIds() : [];

        $categories = Category::query()
            ->forModule($module)
            ->with('childrenRecursive')
            ->whereNull('parent_id')
            ->when($excludedIds, fn ($query) => $query->whereNotIn('id', $excludedIds))
            ->orderBy('name')
            ->get();

        return self::flattenCategories($categories, $excludedIds);
    }

    private static function flattenCategories(Collection $categories, array $excludedIds, int $depth = 0): array
    {
        $options = [];

        foreach ($categories as $category) {
            if (in_array($category->id, $excludedIds, true)) {
                continue;
            }

            $options[$category->id] = str_repeat('- ', $depth).$category->name;
            $options += self::flattenCategories($category->childrenRecursive, $excludedIds, $depth + 1);
        }

        return $options;
    }
}
