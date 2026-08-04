<?php

namespace App\Filament\Resources\Newsletters\Schemas;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Schemas\SeoMetaSchema;
use App\Helpers\TemplateHelper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsletterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
            ])
            ->components([
                Section::make('Newsletter details')
                    ->description('Organize the newsletter URL, Blade template, and publishing state.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('template')
                            ->options(TemplateHelper::newsletterTemplateOptions())
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Section::make('Publishing')
                    ->description('Control visibility and the featured image used on the newsletter archive and share cards.')
                    ->schema([
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
                            ->maxSize(4096)
                            ->helperText('Used for newsletter archive cards and share previews. Replacing this image removes the previous one.'),
                    ])
                    ->columnSpan(1),
                SeoMetaSchema::make(),
            ]);
    }
}
