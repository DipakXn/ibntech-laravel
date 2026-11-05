<?php

namespace App\Filament\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Login extends BaseLogin
{
    public const ROUTE_PATH = 'ibn-tech-cms-login';

    protected string $view = 'filament.auth.login';

    protected Width|string|null $maxWidth = Width::ScreenLarge;

    protected array $extraBodyAttributes = [
        'class' => 'ibn-login-screen',
    ];

    public function getHeading(): string|Htmlable|null
    {
        return 'Control Center';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Manage website content, lead submissions, resources, and publishing workflows from one centralized dashboard.';
    }

    public function hasLogo(): bool
    {
        return false;
    }

    protected function getEmailFormComponent(): Component
    {
        $component = parent::getEmailFormComponent();

        if ($component instanceof TextInput) {
            $component
                ->prefixIcon(Heroicon::OutlinedEnvelope)
                ->placeholder('Enter your email address');
        }

        return $component;
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::auth/pages/login.form.password.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->required()
            ->prefixIcon(Heroicon::OutlinedLockClosed)
            ->placeholder('Enter your password');
    }

    protected function getRememberFormComponent(): Component
    {
        $component = parent::getRememberFormComponent();

        if ($component instanceof Checkbox && filament()->hasPasswordReset()) {
            $component->hint(new HtmlString(Blade::render('<x-filament::link :href="filament()->getRequestPasswordResetUrl()" tabindex="-1">{{ __(\'filament-panels::auth/pages/login.actions.request_password_reset.label\') }}</x-filament::link>')));
        }

        return $component;
    }

    protected function getAuthenticateFormAction(): Action
    {
        return parent::getAuthenticateFormAction()
            ->icon(Heroicon::OutlinedArrowRight);
    }
}
