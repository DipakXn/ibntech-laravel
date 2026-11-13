<?php

namespace App\Filament\Auth;

use App\Support\Users\PasswordPolicy;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

class EditProfile extends BaseEditProfile
{
    protected function getPasswordFormComponent(): Component
    {
        $component = parent::getPasswordFormComponent();

        if ($component instanceof TextInput) {
            $component->helperText(PasswordPolicy::HELPER);
        }

        return $component;
    }
}
