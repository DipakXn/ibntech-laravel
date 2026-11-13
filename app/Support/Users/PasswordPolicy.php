<?php

namespace App\Support\Users;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class PasswordPolicy
{
    public const HELPER = 'Use at least 12 characters with uppercase and lowercase letters, a number, and a symbol.';

    public static function register(): void
    {
        Password::defaults(fn (): Password => Password::min(12)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols());
    }

    public static function generate(): string
    {
        return 'Aa1!'.Str::password(16);
    }
}
