<?php

namespace App\Filament\Schemas;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class SeoMetaSchema
{
    public static function make(string $heading = 'SEO Metadata', bool $pageSitemapOverrides = false): Section
    {
        return Section::make($heading)
            ->description('Manage search engine and social metadata for this record.')
            ->schema([
                Section::make('Basic SEO')
                    ->relationship('seoMeta')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255),
                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->helperText('Comma separated keywords (optional)')
                            ->maxLength(255),
                        TextInput::make('canonical_url')
                            ->label('Canonical URL')
                            ->url()
                            ->maxLength(255),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('focus_keyword')
                            ->label('Focus Keyword')
                            ->maxLength(255),
                        Select::make('robots_index')
                            ->label('Indexing')
                            ->options([
                                'index' => 'Index',
                                'noindex' => 'Noindex',
                            ])
                            ->default('index'),
                        Select::make('robots_follow')
                            ->label('Follow Links')
                            ->options([
                                'follow' => 'Follow',
                                'nofollow' => 'Nofollow',
                            ])
                            ->default('follow'),
                        TextInput::make('robots_max_snippet')
                            ->label('Max Snippet')
                            ->helperText('Use -1 for unlimited')
                            ->maxLength(10),
                        Select::make('robots_max_image_preview')
                            ->label('Max Image Preview')
                            ->options([
                                'none' => 'None',
                                'standard' => 'Standard',
                                'large' => 'Large',
                            ])
                            ->default('large'),
                        Placeholder::make('snippet_preview')
                            ->label('SEO Snippet Preview')
                            ->content(fn ($get) => self::snippetPreviewHtml($get)),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Open Graph / Social')
                    ->relationship('seoMeta')
                    ->schema([
                        TextInput::make('og_title')
                            ->label('OG Title')
                            ->maxLength(255),
                        Textarea::make('og_description')
                            ->label('OG Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('og_image')
                            ->label('Open Graph Image')
                            ->collection('og_image')
                            ->image()
                            ->maxSize(4096)
                            ->helperText('Optional override. If empty, the Featured Image will be used for OG tags.'),
                        TextInput::make('og_image_alt')
                            ->label('OG Image Alt Text')
                            ->maxLength(255),
                        Select::make('og_type')
                            ->label('OG Type')
                            ->options([
                                'article' => 'Article',
                                'website' => 'Website',
                                'profile' => 'Profile',
                            ])
                            ->default('article'),
                        TextInput::make('og_site_name')
                            ->label('OG Site Name')
                            ->maxLength(255),
                        TextInput::make('og_locale')
                            ->label('OG Locale')
                            ->maxLength(10)
                            ->default(config('app.locale')),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Twitter')
                    ->relationship('seoMeta')
                    ->schema([
                        Select::make('twitter_card_type')
                            ->label('Twitter Card Type')
                            ->options([
                                'summary' => 'Summary',
                                'summary_large_image' => 'Summary Large Image',
                                'player' => 'Player',
                            ])
                            ->default('summary_large_image'),
                        TextInput::make('twitter_title')
                            ->label('Twitter Title')
                            ->maxLength(255),
                        Textarea::make('twitter_description')
                            ->label('Twitter Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('twitter_image')
                            ->label('Twitter Image')
                            ->collection('twitter_image')
                            ->image()
                            ->maxSize(4096)
                            ->helperText('Optional override. Uses Twitter Image first, then Open Graph Image, then Featured Image.'),
                        TextInput::make('twitter_creator')
                            ->label('Twitter Creator')
                            ->maxLength(100),
                        TextInput::make('twitter_site')
                            ->label('Twitter Site')
                            ->maxLength(100),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Article Metadata')
                    ->relationship('seoMeta')
                    ->schema([
                        TextInput::make('article_author')
                            ->label('Author')
                            ->maxLength(255),
                        DateTimePicker::make('published_at')
                            ->label('Published Date')
                            ->withoutSeconds(),
                        DateTimePicker::make('modified_at')
                            ->label('Modified Date')
                            ->withoutSeconds(),
                        TextInput::make('article_section')
                            ->label('Section / Category')
                            ->maxLength(255),
                        TagsInput::make('article_tags')
                            ->label('Tags / Keywords'),
                        TextInput::make('reading_time')
                            ->label('Reading Time (mins)')
                            ->numeric(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Schema / Structured Data')
                    ->relationship('seoMeta')
                    ->schema([
                        Textarea::make('json_ld')
                            ->label('JSON-LD (raw)')
                            ->rows(6)
                            ->columnSpanFull(),
                        Toggle::make('schema_generated')
                            ->label('Auto-generate BlogPosting Schema'),
                        Toggle::make('faq_schema')
                            ->label('Include FAQ Schema'),
                    ])
                    ->collapsible(),

                Section::make('Advanced / Technical')
                    ->relationship('seoMeta')
                    ->schema([
                        Toggle::make('sitemap_include')
                            ->label('Include in sitemap')
                            ->default(true),
                        ...($pageSitemapOverrides ? [
                            Select::make('sitemap_changefreq')
                                ->label('Sitemap change frequency')
                                ->options(array_combine(
                                    config('sitemap.changefreq_values', []),
                                    array_map('ucfirst', config('sitemap.changefreq_values', [])),
                                ))
                                ->placeholder('Use Pages sitemap default')
                                ->helperText('Optional. Leave empty to use the Pages sitemap default.'),
                            TextInput::make('sitemap_priority')
                                ->label('Sitemap priority')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(1)
                                ->step(0.1)
                                ->placeholder('Use Pages sitemap default')
                                ->helperText('Optional. Leave empty to use the Pages sitemap default. Homepage uses 1.0 when empty.'),
                        ] : []),
                        TextInput::make('redirect_url')
                            ->label('Redirect URL')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('custom_meta_robots')
                            ->label('Custom meta robots')
                            ->maxLength(255),
                        Textarea::make('custom_head_code')
                            ->label('Custom Head Code (raw)')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ])
            ->columns(2)
            ->compact()
            ->columnSpanFull();
    }

    private static function snippetPreviewHtml($get): HtmlString
    {
        $title = $get('meta_title') ?: config('app.name');
        $desc = $get('meta_description') ?: '';
        $url = $get('canonical_url') ?: url()->current();

        $title = e(Str::limit($title, 60));
        $desc = e(Str::limit($desc, 160));
        $url = e($url);
        $snippet = '<div style="font-family:Arial,Helvetica,sans-serif;">'.
                "<div style=\"color:#1a0dab;font-size:14px;margin-bottom:4px;\">{$url}</div>".
                "<div style=\"color:#202124;font-weight:600;font-size:18px;margin-bottom:4px;\">{$title}</div>".
                "<div style=\"color:#4d5156;font-size:13px;\">{$desc}</div>".
                '</div>';

        $html = <<<HTML
<div x-data="{ open: false }" @keydown.escape.window="open = false">
    <button
        type="button"
        @click="open = true"
        class="filament-button filament-button-size-md inline-flex items-center gap-2 px-3 py-2 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white rounded-md shadow-sm"
        style="margin-bottom:8px;"
    >
        
        <span class="font-medium">Preview SEO Snippet</span>
    </button>

    <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center" style="background: rgba(0,0,0,0.5);">
        <div class="bg-white rounded shadow-lg overflow-auto" style="max-width:720px; width:95%; max-height:80%;">
            <div class="p-4 border-b" style="display:flex; justify-content:space-between; align-items:center;">
                <h3 style="margin:0; font-size:16px; font-weight:600;">SEO Snippet Preview</h3>
                <button type="button" @click="open = false" aria-label="Close" class="text-gray-600 hover:text-gray-800" style="background:none;border:0;font-size:20px;line-height:1;">&times;</button>
            </div>
            <div class="p-4" style="padding:16px;">
                {$snippet}
            </div>
        </div>
    </div>
</div>
HTML;

        return new HtmlString($html);
    }
}
