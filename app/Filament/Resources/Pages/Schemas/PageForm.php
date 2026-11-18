<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Schemas\ContentTemplateForm;
use App\Filament\Schemas\SeoMetaSchema;
use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
            ])
            ->components([
                Section::make('Page details')
                    ->description('Organize the page URL, template, and publishing state.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        ContentTemplateForm::slug(ContentTemplateKind::Page),
                        ContentTemplateForm::template(),
                        ...ContentTemplateForm::assetPlaceholders(ContentTemplateKind::Page),
                    ])
                    ->columns(2)
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Section::make('Publishing')
                    ->description('Control visibility and the featured image used for previews and social sharing.')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required()
                            ->rules([
                                ContentTemplateForm::publishRule(ContentTemplateKind::Page),
                            ]),
                        DateTimePicker::make('published_at')
                            ->label('Published Date')
                            ->seconds(false)
                            ->helperText('Public display and listing date. Leave empty for drafts. Laravel created_at is not changed.'),
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->collection('featured_image')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('180')
                            ->maxSize(4096)
                            ->helperText(ContentTemplateForm::FEATURED_IMAGE_HELP),
                    ])
                    ->columnSpan(1),
                SeoMetaSchema::make(pageSitemapOverrides: true),
            ]);
    }
}
