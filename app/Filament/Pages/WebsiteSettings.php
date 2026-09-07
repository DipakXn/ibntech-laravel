<?php

namespace App\Filament\Pages;

use App\Filament\Schemas\WebsiteSettingsSchema;
use App\Models\WebsiteSetting;
use App\Services\ApplicationCacheService;
use App\Services\WebsiteSettingService;
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
        $record = $this->getRecord();

        $this->form->fill($record?->attributesToArray() ?? app(WebsiteSettingService::class)->defaultAttributes());
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
        $service = app(WebsiteSettingService::class);
        $record = $this->getRecord();
        $wasRecentlyCreated = false;

        if (! $record) {
            $record = new WebsiteSetting;
            $wasRecentlyCreated = true;
        }

        $record->fill($data);
        $record->save();

        $this->form->record($record)->saveRelationships();

        $service->forget();
        $service->syncRobotsTxt($record->fresh());

        if ($wasRecentlyCreated) {
            $this->form->fill($record->fresh()->attributesToArray());
        }

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
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
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
