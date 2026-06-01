<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected string $view = 'filament.auth.login';

    protected Width|string|null $maxWidth = Width::ScreenLarge;

    protected array $extraBodyAttributes = [
        'class' => 'ibn-login-screen',
    ];

    public function getHeading(): string | Htmlable | null
    {
        return 'Control Center';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'Manage website content, lead submissions, resources, and publishing workflows from one centralized dashboard.';
    }

    public function hasLogo(): bool
    {
        return false;
    }
}
