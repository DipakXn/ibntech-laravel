<?php

namespace App\Filament\Schemas;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Lead;
use App\Services\Sitemap\SitemapSettings;
use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\HtmlString;

class WebsiteSettingsSchema
{
    /**
     * @return array<int, Tabs>
     */
    public static function components(): array
    {
        return [
            Tabs::make('Website settings')
                ->persistTabInQueryString('settings-tab')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Brand & Logo')
                        ->schema(self::brandSection()),
                    Tab::make('Metadata')
                        ->schema(self::metadataSection()),
                    Tab::make('Open Graph & Twitter')
                        ->schema(self::socialMetaSection()),
                    Tab::make('Robots')
                        ->schema(self::robotsSection()),
                    Tab::make('Sitemap')
                        ->schema(self::sitemapSection()),
                    Tab::make('Contact & Social')
                        ->schema(self::contactSection()),
                    Tab::make('Form notifications')
                        ->schema(self::formNotificationsSection()),
                    Tab::make('Analytics & Scripts')
                        ->schema(self::analyticsSection()),
                ]),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function brandSection(): array
    {
        return [
            Section::make('Brand identity')
                ->description('Site name and logo assets used across the public website.')
                ->schema([
                    TextInput::make('site_name')
                        ->label('Site Name')
                        ->maxLength(255)
                        ->required(),
                    TextInput::make('organization_name')
                        ->label('Organization Name')
                        ->maxLength(255),
                    TextInput::make('tagline')
                        ->label('Tagline')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('site_logo')
                        ->label('Site Logo')
                        ->collection('site_logo')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('120')
                        ->maxSize(4096)
                        ->helperText('Primary header logo. When set, it replaces the CSS tile logo.'),
                    SpatieMediaLibraryFileUpload::make('site_logo_dark')
                        ->label('Site Logo (Dark)')
                        ->collection('site_logo_dark')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('120')
                        ->maxSize(4096)
                        ->helperText('Optional inverted logo for dark backgrounds.'),
                    SpatieMediaLibraryFileUpload::make('favicon')
                        ->label('Favicon')
                        ->collection('favicon')
                        ->visibility('public')
                        ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/svg+xml', 'image/jpeg', 'image/webp'])
                        ->maxSize(1024)
                        ->helperText('Browser tab icon. Falls back to static favicon_io assets when empty.'),
                    SpatieMediaLibraryFileUpload::make('apple_touch_icon')
                        ->label('Apple Touch Icon')
                        ->collection('apple_touch_icon')
                        ->visibility('public')
                        ->image()
                        ->maxSize(2048)
                        ->helperText('Recommended 180×180 PNG.'),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function metadataSection(): array
    {
        return [
            Section::make('General metadata defaults')
                ->description('Fallback SEO values used when a page has no content-specific metadata.')
                ->schema([
                    TextInput::make('default_meta_title')
                        ->label('Default Meta Title')
                        ->maxLength(255)
                        ->helperText('Used when a page has no meta title. Site name is used if empty.'),
                    TextInput::make('default_meta_keywords')
                        ->label('Default Meta Keywords')
                        ->maxLength(255)
                        ->helperText('Comma-separated keywords (optional).'),
                    TextInput::make('default_locale')
                        ->label('Default Locale')
                        ->maxLength(20)
                        ->placeholder('en'),
                    Textarea::make('default_meta_description')
                        ->label('Default Meta Description')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function socialMetaSection(): array
    {
        return [
            Section::make('Open Graph defaults')
                ->description('Defaults for social sharing previews when page-level OG fields are empty.')
                ->schema([
                    TextInput::make('og_site_name')
                        ->label('OG Site Name')
                        ->maxLength(255),
                    Select::make('og_type')
                        ->label('Default OG Type')
                        ->options([
                            'website' => 'Website',
                            'article' => 'Article',
                            'profile' => 'Profile',
                        ])
                        ->default('website'),
                    TextInput::make('og_locale')
                        ->label('OG Locale')
                        ->maxLength(20),
                    TextInput::make('og_image_alt')
                        ->label('Default OG Image Alt')
                        ->maxLength(255),
                    SpatieMediaLibraryFileUpload::make('default_og_image')
                        ->label('Default OG Image')
                        ->collection('default_og_image')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('160')
                        ->maxSize(4096)
                        ->columnSpanFull()
                        ->helperText('Fallback Open Graph / Twitter image when a page has no featured or OG image.'),
                ])
                ->columns(2),
            Section::make('Twitter / X defaults')
                ->schema([
                    Select::make('twitter_card_type')
                        ->label('Twitter Card Type')
                        ->options([
                            'summary' => 'Summary',
                            'summary_large_image' => 'Summary Large Image',
                            'player' => 'Player',
                        ])
                        ->default('summary_large_image'),
                    TextInput::make('twitter_site')
                        ->label('Twitter Site')
                        ->placeholder('@IBN Technologies')
                        ->maxLength(100),
                    TextInput::make('twitter_creator')
                        ->label('Twitter Creator')
                        ->placeholder('@IBN Technologies')
                        ->maxLength(100),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function robotsSection(): array
    {
        return [
            Section::make('Robots meta defaults')
                ->description('Default robots directives for pages without custom SEO robots settings.')
                ->schema([
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
                    TextInput::make('custom_meta_robots')
                        ->label('Custom Meta Robots Override')
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->helperText('When set, this replaces the composed robots string above.'),
                    Textarea::make('robots_txt')
                        ->label('robots.txt Contents')
                        ->rows(8)
                        ->columnSpanFull()
                        ->helperText('Published at /robots.txt from this field when the page is requested.'),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function sitemapSection(): array
    {
        $changefreqOptions = array_combine(
            config('sitemap.changefreq_values', []),
            array_map('ucfirst', config('sitemap.changefreq_values', [])),
        ) ?: [];

        return [
            Section::make('XML sitemap')
                ->description('Dynamic sitemap index and per-content sitemaps. URLs follow this environment\'s APP_URL.')
                ->schema([
                    Toggle::make('sitemap_enabled')
                        ->label('Enable sitemap')
                        ->default(true)
                        ->dehydrated(true),
                    Toggle::make('sitemap_add_to_robots')
                        ->label('Add Sitemap directive to robots.txt')
                        ->default(true)
                        ->helperText('Only the Sitemap line is managed. Existing User-agent, Allow, and Disallow rules are left unchanged.'),
                    Toggle::make('sitemap_include_lastmod')
                        ->label('Include lastmod')
                        ->default(true),
                    Toggle::make('sitemap_include_changefreq')
                        ->label('Include changefreq')
                        ->default(false)
                        ->helperText('Optional. Search engines typically ignore this hint.'),
                    Toggle::make('sitemap_include_priority')
                        ->label('Include priority')
                        ->default(false)
                        ->helperText('Optional. Search engines typically ignore this hint.'),
                    TextInput::make('sitemap_cache_ttl')
                        ->label('Cache TTL (seconds)')
                        ->numeric()
                        ->minValue(0)
                        ->default(3600)
                        ->helperText('0 disables sitemap caching. Content changes still invalidate cached sitemaps.'),
                    Placeholder::make('sitemap_links')
                        ->label('Sitemap URLs')
                        ->content(function ($get): HtmlString {
                            return new HtmlString(self::sitemapLinksHtml(
                                (bool) ($get('sitemap_enabled') ?? true),
                                is_array($get('sitemap_types')) ? $get('sitemap_types') : null,
                            ));
                        })
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('Content types')
                ->description('Enable or disable each child sitemap and set default changefreq/priority values.')
                ->schema([
                    Repeater::make('sitemap_types')
                        ->label('Sitemaps')
                        ->schema([
                            TextInput::make('key')
                                ->hidden()
                                ->dehydrated(),
                            Placeholder::make('label_display')
                                ->label('Sitemap')
                                ->content(fn ($get): string => SitemapType::tryFrom((string) $get('key'))?->label()
                                    ?? (string) ($get('label') ?: $get('key') ?: '')),
                            Toggle::make('enabled')
                                ->label('Enabled')
                                ->inline(false)
                                ->dehydrated(true),
                            Select::make('changefreq')
                                ->label('Default changefreq')
                                ->options($changefreqOptions),
                            TextInput::make('priority')
                                ->label('Default priority')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(1)
                                ->step(0.1),
                        ])
                        ->columns(4)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderable(false)
                        ->columnSpanFull(),
                ]),
            Section::make('Custom URLs')
                ->description('Optional extra URLs for custom-sitemap.xml. Do not add existing CMS pages here. Set change frequency and priority on the page instead. Query strings are preserved as entered.')
                ->schema([
                    Repeater::make('sitemap_custom_urls')
                        ->label('Custom URLs')
                        ->schema([
                            TextInput::make('url')
                                ->label('URL')
                                ->required()
                                ->maxLength(2048)
                                ->helperText('Absolute http(s) URL or a path starting with /.')
                                ->columnSpan(2),
                            Toggle::make('enabled')
                                ->label('Enabled')
                                ->default(true),
                            DateTimePicker::make('lastmod')
                                ->label('Last modified')
                                ->seconds(false),
                            Select::make('changefreq')
                                ->label('Change frequency')
                                ->options($changefreqOptions),
                            TextInput::make('priority')
                                ->label('Priority')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(1)
                                ->step(0.1),
                        ])
                        ->columns(3)
                        ->defaultItems(0)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['url'] ?? null)
                        ->addActionLabel('Add custom URL')
                        ->columnSpanFull(),
                ]),
        ];
    }

    /**
     * @param  list<array<string, mixed>>|null  $typeRows
     */
    private static function sitemapLinksHtml(bool $sitemapEnabled, ?array $typeRows): string
    {
        if (! $sitemapEnabled) {
            return '<p class="text-sm text-gray-600 dark:text-gray-400">Sitemap generation is disabled. Enable the sitemap above and save to publish XML sitemaps.</p>';
        }

        $enabledTypes = self::enabledSitemapTypes($typeRows);
        $items = '';

        foreach ([
            ['Sitemap index', url('/sitemap.xml')],
            ['Sitemap index (alias)', url('/sitemap_index.xml')],
        ] as [$label, $href]) {
            $items .= '<li><span>'.e($label).':</span> <a href="'.e($href).'" target="_blank" rel="noopener">'.e($href).'</a></li>';
        }

        foreach (SitemapType::cases() as $type) {
            $label = $type->label();
            $href = url('/'.$type->fileName());

            if (! in_array($type, $enabledTypes, true)) {
                $items .= '<li class="text-gray-500 dark:text-gray-400"><span>'.e($label).':</span> '
                    .e($href).' (disabled)</li>';

                continue;
            }

            $items .= '<li><span>'.e($label).':</span> <a href="'.e($href).'" target="_blank" rel="noopener">'.e($href).'</a></li>';
        }

        return '<ul class="list-disc ps-5 space-y-1 text-sm">'.$items.'</ul>';
    }

    /**
     * @param  list<array<string, mixed>>|null  $typeRows
     * @return list<SitemapType>
     */
    private static function enabledSitemapTypes(?array $typeRows): array
    {
        $stored = is_array($typeRows) && $typeRows !== []
            ? SitemapType::storedState($typeRows)
            : null;

        $sitemapSettings = new SitemapSettings(app(WebsiteSettingService::class)->get());
        $enabled = [];

        foreach (SitemapType::cases() as $type) {
            $typeEnabled = $stored !== null
                ? (bool) ($stored[$type->value]['enabled'] ?? $type->defaults()['enabled'])
                : $sitemapSettings->typeEnabled($type);

            if ($typeEnabled) {
                $enabled[] = $type;
            }
        }

        return $enabled;
    }

    /**
     * @return array<int, Section>
     */
    protected static function contactSection(): array
    {
        return [
            Section::make('Header contacts')
                ->description('Phones and email shown in the site top bar.')
                ->schema([
                    TextInput::make('contact_email')
                        ->label('Contact Email')
                        ->email()
                        ->maxLength(255),
                    Repeater::make('header_phones')
                        ->label('Header Phones')
                        ->schema([
                            TextInput::make('label')
                                ->label('Label')
                                ->placeholder('USA')
                                ->maxLength(50)
                                ->required(),
                            TextInput::make('number')
                                ->label('Phone Number')
                                ->maxLength(50)
                                ->required(),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->reorderable()
                        ->collapsible()
                        ->columnSpanFull(),
                ]),
            Section::make('Office addresses')
                ->description('Displayed in the site footer address column.')
                ->schema([
                    Repeater::make('offices')
                        ->label('Offices')
                        ->schema([
                            TextInput::make('name')
                                ->label('Office Name')
                                ->maxLength(255)
                                ->required(),
                            Textarea::make('address')
                                ->label('Address')
                                ->rows(2)
                                ->required()
                                ->columnSpanFull(),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->maxLength(255),
                            Repeater::make('phones')
                                ->label('Phones')
                                ->schema([
                                    TextInput::make('label')
                                        ->label('Label')
                                        ->maxLength(100),
                                    TextInput::make('number')
                                        ->label('Number')
                                        ->maxLength(50)
                                        ->required(),
                                ])
                                ->columns(2)
                                ->defaultItems(0)
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->columnSpanFull(),
                ]),
            Section::make('Social profile URLs')
                ->schema([
                    TextInput::make('social_facebook')
                        ->label('Facebook')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('social_linkedin')
                        ->label('LinkedIn')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('social_twitter')
                        ->label('X / Twitter')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('social_instagram')
                        ->label('Instagram')
                        ->url()
                        ->maxLength(255),
                    TextInput::make('social_youtube')
                        ->label('YouTube')
                        ->url()
                        ->maxLength(255),
                ])
                ->columns(2),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function formNotificationsSection(): array
    {
        return [
            Section::make('Admin notification recipients')
                ->description('Internal emails for new website form submissions. Visitor thank-you emails are unchanged.')
                ->schema([
                    TextInput::make('form_notification_to')
                        ->label('Default Form Notification Email')
                        ->email()
                        ->maxLength(255)
                        ->helperText('Global fallback “To” address for all form admin notifications when a form has no override.')
                        ->columnSpanFull(),
                    Repeater::make('form_notification_overrides')
                        ->label('Form Notification Overrides')
                        ->schema([
                            Select::make('form_name')
                                ->label('Form')
                                ->options(fn (): array => Lead::formOptions())
                                ->searchable()
                                ->required()
                                ->columnSpan(1),
                            TextInput::make('admin_to')
                                ->label('Admin notification email')
                                ->email()
                                ->maxLength(255)
                                ->helperText('Leave blank to use the default.')
                                ->columnSpan(1),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->reorderable(false)
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['form_name'] ?? null)
                        ->addActionLabel('Add form override')
                        ->columnSpanFull(),
                ]),
        ];
    }

    /**
     * @return array<int, Section>
     */
    protected static function analyticsSection(): array
    {
        return [
            Section::make('Analytics & verification')
                ->description('Site-wide tracking IDs and search console verification tags.')
                ->schema([
                    TextInput::make('google_analytics_id')
                        ->label('Google Analytics ID')
                        ->placeholder('G-XXXXXXXXXX')
                        ->maxLength(50),
                    TextInput::make('google_tag_manager_id')
                        ->label('Google Tag Manager ID')
                        ->placeholder('GTM-XXXXXXX')
                        ->maxLength(50),
                    TextInput::make('google_site_verification')
                        ->label('Google Site Verification')
                        ->maxLength(255)
                        ->helperText('Content value for the google-site-verification meta tag.'),
                    TextInput::make('bing_site_verification')
                        ->label('Bing Site Verification')
                        ->maxLength(255),
                ])
                ->columns(2),
            Section::make('Global scripts')
                ->schema([
                    Textarea::make('custom_head_code')
                        ->label('Custom Head Code')
                        ->rows(5)
                        ->columnSpanFull()
                        ->helperText('Injected into every page <head>. Use carefully.'),
                    Textarea::make('custom_body_end_code')
                        ->label('Custom Body End Code')
                        ->rows(5)
                        ->columnSpanFull()
                        ->helperText('Injected before </body> on every page.'),
                ]),
        ];
    }
}
