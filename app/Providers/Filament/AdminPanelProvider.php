<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use App\Filament\Pages\AdminDashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Enums\ThemeMode;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->profile()
            ->brandName('IBNTECH Control')
            ->brandLogo(new HtmlString('
                <div class="ibn-brand-lockup">
                    <div class="ibn-brand-mark">
                        <span>I</span>
                        <span>B</span>
                        <span>N</span>
                    </div>
                    <div class="ibn-brand-wordmark">
                        <strong>IBNTECH</strong>
                        <small>Control</small>
                    </div>
                </div>
            '))
            ->darkMode()
            ->defaultThemeMode(ThemeMode::System)
            ->colors([
                'primary' => Color::hex('#4caf50'),
                'info' => Color::hex('#2e2e80'),
                'gray' => Color::Slate,
            ])
            ->font('Satoshi, Manrope, Inter, Segoe UI, sans-serif')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->sidebarWidth('18rem')
            ->collapsedSidebarWidth('5rem')
            ->sidebarCollapsibleOnDesktop()
            ->collapsibleNavigationGroups()
            ->navigationGroups([
                NavigationGroup::make('Workspace')->icon(Heroicon::OutlinedSquares2x2)->collapsed(false),
                NavigationGroup::make('Content')->icon(Heroicon::OutlinedDocumentDuplicate)->collapsed(false),
                NavigationGroup::make('Sales')->icon(Heroicon::OutlinedChartBarSquare)->collapsed(false),
                NavigationGroup::make('Administration')->icon(Heroicon::OutlinedShieldCheck)->collapsed(false),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                AdminDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_START,
                fn (): string => view('filament.hooks.head')->render(),
            )
            ->renderHook(
                PanelsRenderHook::TOPBAR_START,
                fn (): string => view('filament.hooks.topbar-start')->render(),
            );
    }
}
