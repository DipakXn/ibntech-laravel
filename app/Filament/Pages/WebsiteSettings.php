<?php

namespace App\Filament\Pages;

use App\Filament\Schemas\WebsiteSettingsSchema;
use App\Models\WebsiteSetting;
use App\Services\ApplicationCacheService;
use App\Services\FormNotificationSettingService;
use App\Services\Sitemap\SitemapCacheService;
use App\Services\WebsiteSettingService;
use App\Support\Sitemap\SitemapCustomUrls;
use App\Support\Sitemap\SitemapType;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @property-read Schema $form
 */
class WebsiteSettings extends Page
{
    protected static ?string $title = 'Website Settings';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Website Settings';

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.pages.website-settings';

    protected ?string $subheading = 'Manage brand assets, default SEO metadata, robots, contact details, and analytics.';

    protected Width|string|null $maxContentWidth = 'full';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill($this->formDataFromRecord($this->getRecord()));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    ...WebsiteSettingsSchema::components(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $overrides = $data['form_notification_overrides'] ?? [];
        unset($data['form_notification_overrides']);

        if (isset($this->data['sitemap_types']) && is_array($this->data['sitemap_types'])) {
            $data['sitemap_types'] = $this->data['sitemap_types'];
        }

        if (isset($data['sitemap_types']) && is_array($data['sitemap_types'])) {
            $data['sitemap_types'] = SitemapType::storedState($data['sitemap_types']);
        }

        if (isset($data['sitemap_custom_urls']) && is_array($data['sitemap_custom_urls'])) {
            $data['sitemap_custom_urls'] = SitemapCustomUrls::normalize($data['sitemap_custom_urls']);
        }

        $service = app(WebsiteSettingService::class);
        $record = $this->getRecord();

        if (! $record) {
            $record = new WebsiteSetting;
        }

        $record->fill($data);
        $record->save();

        $this->form->record($record)->saveRelationships();

        app(FormNotificationSettingService::class)->sync(is_array($overrides) ? $overrides : []);

        $service->forget();
        $service->syncRobotsTxt($record->fresh());
        app(SitemapCacheService::class)->forgetAll();

        $this->form->fill($this->formDataFromRecord($record->fresh()));

        Notification::make()
            ->success()
            ->title('Website settings saved')
            ->send();
    }

    public function getRecord(): ?WebsiteSetting
    {
        return WebsiteSetting::query()->first();
    }

    /**
     * @return array<string, mixed>
     */
    private function formDataFromRecord(?WebsiteSetting $record): array
    {
        $attributes = $record?->attributesToArray() ?? app(WebsiteSettingService::class)->defaultAttributes();
        $attributes['form_notification_overrides'] = app(FormNotificationSettingService::class)->repeaterState();
        $attributes['sitemap_types'] = SitemapType::formState(
            is_array($attributes['sitemap_types'] ?? null) ? $attributes['sitemap_types'] : null
        );
        $attributes['sitemap_custom_urls'] = is_array($attributes['sitemap_custom_urls'] ?? null)
            ? $attributes['sitemap_custom_urls']
            : [];

        return $attributes;
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('clearSitemapCache')
                ->label('Clear sitemap cache')
                ->color('gray')
                ->icon(Heroicon::OutlinedGlobeAlt)
                ->action(function (): void {
                    app(SitemapCacheService::class)->forgetAll();

                    Notification::make()
                        ->success()
                        ->title('Sitemap cache cleared')
                        ->body('XML sitemaps will be regenerated on the next request.')
                        ->send();
                }),
            Action::make('clearCache')
                ->label('Clear cache')
                ->color('danger')
                ->icon(Heroicon::OutlinedArrowPath)
                ->requiresConfirmation()
                ->modalHeading('Clear application cache?')
                ->modalDescription('This removes all cached application data from the configured cache store. Sessions, queue jobs, database content, and website settings are not affected.')
                ->modalSubmitActionLabel('Clear cache')
                ->action(function (): void {
                    try {
                        app(ApplicationCacheService::class)->clear();

                        Notification::make()
                            ->success()
                            ->title('Application cache cleared')
                            ->body('Cached CMS content will reload from the database on the next request.')
                            ->send();
                    } catch (Throwable $exception) {
                        Log::error('Failed to clear application cache.', [
                            'exception' => $exception,
                        ]);

                        Notification::make()
                            ->danger()
                            ->title('Failed to clear cache')
                            ->body('Could not clear the application cache. Please try again or check the application logs.')
                            ->send();
                    }
                }),
        ];
    }
}
