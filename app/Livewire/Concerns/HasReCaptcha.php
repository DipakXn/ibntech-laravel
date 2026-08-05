<?php

namespace App\Livewire\Concerns;

use App\Rules\ReCaptcha;

trait HasReCaptcha
{
    public ?string $recaptchaToken = null;

    /**
     * Get the validation rules for reCAPTCHA.
     *
     * @return array
     */
    protected function getReCaptchaRules(): array
    {
        if (app()->runningUnitTests() || app()->environment('testing')) {
            return [];
        }

        if (! config('services.recaptcha.secret_key') || ! config('services.recaptcha.site_key')) {
            return [];
        }

        return [
            'recaptchaToken' => ['required', new ReCaptcha()],
        ];
    }

    /**
     * Dispatch an event to reset the reCAPTCHA widget on the frontend.
     */
    protected function resetReCaptcha(): void
    {
        $this->recaptchaToken = null;
        $this->dispatch('reset-recaptcha');
    }
}
