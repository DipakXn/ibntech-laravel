<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Services\AllApplicationCacheService;
use App\Services\ApplicationCacheService;
use App\Services\CompiledViewService;
use App\Services\FrameworkCacheService;
use App\Services\MaintenanceActionLogger;
use App\Services\PartialCacheClearException;
use App\Services\Sitemap\SitemapCacheService;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Throwable;

class SystemMaintenance extends Page
{
    public const APPLICATION_CACHE_CONFIRMATION = 'This removes every entry in the configured cache store, including sitemap XML, cached website settings, the cookie-consent snapshot, and rate-limit counters. Sessions, queue jobs, database content, cache locks, compiled views, and the route and configuration cache files stay in place.';

    protected static ?string $title = 'Cache Management';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Cache Management';

    protected static ?string $slug = 'system-maintenance';

    protected static ?int $navigationSort = 9;

    protected ?string $subheading = 'Monitor and manage application, framework, and sitemap caches.';

    protected Width|string|null $maxContentWidth = 'full';

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function cacheStoreName(): string
    {
        return (string) config('cache.default');
    }

    public function configurationCacheStatus(): string
    {
        return is_file(app()->getCachedConfigPath()) ? 'Cached' : 'Not cached';
    }

    public function routeCacheStatus(): string
    {
        return is_file(app()->getCachedRoutesPath()) ? 'Cached' : 'Not cached';
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cache status')
                    ->description('Read-only. Shows the cache store and whether route and configuration cache files exist.')
                    ->icon(Heroicon::OutlinedInformationCircle)
                    ->extraAttributes(['class' => 'ibn-maintenance-status'])
                    ->columns([
                        'default' => 1,
                        'sm' => 3,
                    ])
                    ->schema([
                        Placeholder::make('cache_store')
                            ->label('Cache store')
                            ->content(fn (): string => $this->cacheStoreName()),
                        Placeholder::make('configuration_cache')
                            ->label('Configuration cache')
                            ->content(fn (): string => $this->configurationCacheStatus()),
                        Placeholder::make('route_cache')
                            ->label('Route cache')
                            ->content(fn (): string => $this->routeCacheStatus()),
                    ]),
                Grid::make([
                    'default' => 1,
                    'md' => 2,
                    'xl' => 3,
                ])
                    ->extraAttributes(['class' => 'ibn-maintenance-actions'])
                    ->schema([
                    $this->maintenanceSection(
                        heading: 'Clear Sitemap Cache',
                        description: 'Removes cached XML sitemaps so they are regenerated on the next request.',
                        icon: Heroicon::OutlinedGlobeAlt,
                        action: $this->clearSitemapCacheAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear Application Cache',
                        description: 'Removes every entry in the configured cache store. Sessions, jobs, and database content stay in place.',
                        icon: Heroicon::OutlinedArrowPath,
                        action: $this->clearCacheAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear View Cache',
                        description: 'Deletes compiled Blade templates so Laravel compiles them again on the next request.',
                        icon: Heroicon::OutlinedCodeBracket,
                        action: $this->clearCompiledViewsAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear Route Cache',
                        description: 'Deletes the cached route file so the next request loads routes from the route files.',
                        icon: Heroicon::OutlinedMap,
                        action: $this->clearRouteCacheAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear Configuration Cache',
                        description: 'Deletes the cached configuration file so the next request reads config files and the environment.',
                        icon: Heroicon::OutlinedCog6Tooth,
                        action: $this->clearConfigurationCacheAction(),
                    ),
                    $this->maintenanceSection(
                        heading: 'Clear All Application Cache',
                        description: 'Clears the configuration cache, route cache, compiled views, and application cache, in that order.',
                        icon: Heroicon::OutlinedCircleStack,
                        action: $this->clearAllApplicationCacheAction(),
                        extraClass: 'ibn-maintenance-card--all',
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
                    action: 'clear_sitemap_cache',
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
            ->label('Clear Application Cache')
            ->button()
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Clear application cache?')
            ->modalDescription(self::APPLICATION_CACHE_CONFIRMATION)
            ->modalSubmitActionLabel('Clear Application Cache')
            ->action(function (): void {
                $this->run(
                    action: 'clear_application_cache',
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
            ->label('Clear View Cache')
            ->button()
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Clear view cache?')
            ->modalDescription('This deletes compiled Blade templates. Laravel compiles them again on the next request. The application cache, route cache, configuration cache, sessions, and database content stay in place.')
            ->modalSubmitActionLabel('Clear View Cache')
            ->action(function (): void {
                $this->run(
                    action: 'clear_view_cache',
                    operation: fn () => app(CompiledViewService::class)->clear(),
                    successTitle: 'View cache cleared',
                    successBody: 'Blade templates will be compiled again on the next request.',
                    failureTitle: 'Failed to clear view cache',
                    failureBody: 'Could not clear the view cache. Please try again or check the application logs.',
                    logMessage: 'Failed to clear view cache.',
                );
            });
    }

    public function clearRouteCacheAction(): Action
    {
        return Action::make('clearRouteCache')
            ->label('Clear Route Cache')
            ->button()
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Clear route cache?')
            ->modalDescription('This deletes the cached route file. The next request loads routes from the route files. Nothing is rebuilt. The application cache, compiled views, configuration cache, sessions, and database content stay in place.')
            ->modalSubmitActionLabel('Clear Route Cache')
            ->action(function (): void {
                $this->run(
                    action: 'clear_route_cache',
                    operation: fn () => app(FrameworkCacheService::class)->clearRoutes(),
                    successTitle: 'Route cache cleared',
                    successBody: 'The next request will load routes from the route files.',
                    failureTitle: 'Failed to clear route cache',
                    failureBody: 'Could not clear the route cache. Please try again or check the application logs.',
                    logMessage: 'Failed to clear route cache.',
                );
            });
    }

    public function clearConfigurationCacheAction(): Action
    {
        return Action::make('clearConfigurationCache')
            ->label('Clear Configuration Cache')
            ->button()
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Clear configuration cache?')
            ->modalDescription('This deletes the cached configuration file. The next request reads configuration from the environment and the config files. Configuration is not rebuilt. The application cache, compiled views, route cache, sessions, and database content stay in place.')
            ->modalSubmitActionLabel('Clear Configuration Cache')
            ->action(function (): void {
                $this->run(
                    action: 'clear_configuration_cache',
                    operation: fn () => app(FrameworkCacheService::class)->clearConfig(),
                    successTitle: 'Configuration cache cleared',
                    successBody: 'The next request will read configuration from the environment and config files.',
                    failureTitle: 'Failed to clear configuration cache',
                    failureBody: 'Could not clear the configuration cache. Please try again or check the application logs.',
                    logMessage: 'Failed to clear configuration cache.',
                );
            });
    }

    public function clearAllApplicationCacheAction(): Action
    {
        return Action::make('clearAllApplicationCache')
            ->label('Clear All Application Cache')
            ->button()
            ->color('danger')
            ->requiresConfirmation()
            ->modalHeading('Clear all application cache?')
            ->modalDescription('This clears the configuration cache, the route cache, compiled views, and the application cache store, in that order. Configuration, routes, and views are not rebuilt. Sessions, queue jobs, database content, and cache locks stay in place. Sitemap XML is removed with the application cache.')
            ->modalSubmitActionLabel('Clear All Application Cache')
            ->action(function (): void {
                $this->run(
                    action: 'clear_all_application_cache',
                    operation: fn () => app(AllApplicationCacheService::class)->clear(),
                    successTitle: 'Application, view, route, and configuration caches cleared',
                    successBody: 'Configuration, routes, and views were not rebuilt.',
                    failureTitle: 'Failed to clear all application cache',
                    failureBody: 'Could not clear all application cache. Please try again or check the application logs.',
                    logMessage: 'Failed to clear all application cache.',
                );
            });
    }

    private function maintenanceSection(string $heading, string $description, Heroicon $icon, Action $action, string $extraClass = ''): Section
    {
        return Section::make($heading)
            ->description($description)
            ->icon($icon)
            ->extraAttributes([
                'class' => trim('ibn-maintenance-card '.$extraClass),
            ])
            ->footerActions([$action]);
    }

    private function run(
        string $action,
        callable $operation,
        string $successTitle,
        string $successBody,
        string $failureTitle,
        string $failureBody,
        string $logMessage,
    ): void {
        $actor = $this->actor();
        $logger = app(MaintenanceActionLogger::class);

        try {
            $operation();

            $logger->succeeded($action, $actor);

            Notification::make()
                ->success()
                ->title($successTitle)
                ->body($successBody)
                ->send();
        } catch (PartialCacheClearException $exception) {
            $logger->failed($logMessage, $action, $actor, $exception, [
                'step' => $exception->failedStep,
                'completed_steps' => $exception->completedSteps,
            ]);

            Notification::make()
                ->danger()
                ->title($failureTitle)
                ->body($exception->publicMessage())
                ->send();
        } catch (Throwable $exception) {
            $logger->failed($logMessage, $action, $actor, $exception);

            Notification::make()
                ->danger()
                ->title($failureTitle)
                ->body($failureBody)
                ->send();
        }
    }

    private function actor(): ?User
    {
        $user = auth()->user();

        return $user instanceof User ? $user : null;
    }
}
