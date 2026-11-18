<?php

namespace App\Filament\Resources\LandingPages\Schemas;

use App\Filament\Schemas\ContentTemplateForm;
use App\Filament\Schemas\SeoMetaSchema;
use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\LandingPage;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LandingPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 3,
            ])
            ->components([
                Section::make('Landing page details')
                    ->description('Organize the landing page URL, Blade template, and publishing state.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        ContentTemplateForm::slug(ContentTemplateKind::LandingPage),
                        ContentTemplateForm::template(),
                        ...ContentTemplateForm::assetPlaceholders(ContentTemplateKind::LandingPage),
                        Select::make('thank_you_slug')
                            ->label('Thank You Page')
                            ->placeholder('No redirect (on-page success)')
                            ->helperText('Successful form submissions redirect to this published landing page. Thank-you pages and the page you are editing are not listed.')
                            ->options(fn (?LandingPage $record): array => LandingPage::thankYouSelectOptions($record?->getKey()))
                            ->searchable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan([
                        'lg' => 2,
                    ]),
                Section::make('Publishing')
                    ->description('Control visibility and the featured image used across campaign previews.')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required()
                            ->rules([
                                ContentTemplateForm::publishRule(ContentTemplateKind::LandingPage),
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
                SeoMetaSchema::make(),
            ]);
    }
}
