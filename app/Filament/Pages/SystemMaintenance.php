<?php

namespace App\Filament\Pages;

use App\Services\ApplicationCacheService;
use App\Services\CompiledViewService;
use App\Services\Sitemap\SitemapCacheService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Log;
use Throwable;

class SystemMaintenance extends Page
{
    protected static ?string $title = 'System Maintenance';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'System Maintenance';

    protected static ?string $slug = 'system-maintenance';

    protected static ?int $navigationSort = 9;

    protected ?string $subheading = 'Clear cached sitemaps, application cache, and compiled Blade views.';

    protected Width|string|null $maxContentWidth = 'full';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 3,
                ])->schema([
                    $this->maintenanceSection(
                        heading: 'Clear Sitemap Cache',
                        description: 'Removes cached XML sitemaps so they are regenerated on the next request.',
                        icon: Heroicon::OutlinedGlobeAlt,
                        action: $this->clearSitemapCacheAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear Cache',
                        description: 'Removes cached application data from the configured cache store.',
                        icon: Heroicon::OutlinedArrowPath,
                        action: $this->clearCacheAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear Compiled Views',
                        description: 'Deletes compiled Blade templates so Laravel recompiles them on the next request.',
                        icon: Heroicon::OutlinedCodeBracket,
                        action: $this->clearCompiledViewsAction(),
                    ),
                ]),
            ]);
    }

    public function clearSitemapCacheAction(): Action
    {
        return Action::make('clearSitemapCache')
            ->label('Clear Sitemap Cache')
            ->button()
            ->color('gray')
            ->requiresConfirmation()
            ->modalHeading('Clear sitemap cache?')
            ->modalDescription('This removes cached XML sitemaps. They will be regenerated on the next request. Website content and other cached data are not affected.')
            ->modalSubmitActionLabel('Clear Sitemap Cache')
            ->action(function (): void {
                $this->run(
                    operation: fn () => app(SitemapCacheService::class)->forgetAll(),
                    successTitle: 'Sitemap cache cleared',
                    successBody: 'XML sitemaps will be regenerated on the next request.',
                    failureTitle: 'Failed to clear sitemap cache',
                    failureBody: 'Could not clear the sitemap cache. Please try again or check the application logs.',
                    logMessage: 'Failed to clear sitemap cache.',
                );
            });
    }

    public function clearCacheAction(): Action
    {
        return Action::make('clearCache')
            ->label('Clear Cache')
            ->button()
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Clear application cache?')
            ->modalDescription('This removes all cached application data from the configured cache store. Sessions, queue jobs, database content, and website settings are not affected.')
            ->modalSubmitActionLabel('Clear Cache')
            ->action(function (): void {
                $this->run(
                    operation: fn () => app(ApplicationCacheService::class)->clear(),
                    successTitle: 'Application cache cleared',
                    successBody: 'Cached CMS content will reload from the database on the next request.',
                    failureTitle: 'Failed to clear cache',
                    failureBody: 'Could not clear the application cache. Please try again or check the application logs.',
                    logMessage: 'Failed to clear application cache.',
                );
            });
    }

    public function clearCompiledViewsAction(): Action
    {
        return Action::make('clearCompiledViews')
            ->label('Clear Compiled Views')
            ->button()
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Clear compiled views?')
            ->modalDescription('This deletes compiled Blade templates. Laravel recompiles them on the next request. Application data, sessions, and the cache store are not affected.')
            ->modalSubmitActionLabel('Clear Compiled Views')
            ->action(function (): void {
                $this->run(
                    operation: fn () => app(CompiledViewService::class)->clear(),
                    successTitle: 'Compiled views cleared',
                    successBody: 'Blade templates will be recompiled on the next request.',
                    failureTitle: 'Failed to clear compiled views',
                    failureBody: 'Could not clear compiled views. Please try again or check the application logs.',
                    logMessage: 'Failed to clear compiled views.',
                );
            });
    }

    private function maintenanceSection(string $heading, string $description, Heroicon $icon, Action $action): Section
    {
        return Section::make($heading)
            ->description($description)
            ->icon($icon)
            ->footerActions([$action]);
    }

    private function run(
        callable $operation,
        string $successTitle,
        string $successBody,
        string $failureTitle,
        string $failureBody,
        string $logMessage,
    ): void {
        try {
            $operation();

            Notification::make()
                ->success()
                ->title($successTitle)
                ->body($successBody)
                ->send();
        } catch (Throwable $exception) {
            Log::error($logMessage, [
                'exception' => $exception,
            ]);

            Notification::make()
                ->danger()
                ->title($failureTitle)
                ->body($failureBody)
                ->send();
        }
    }
}
