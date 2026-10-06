<?php

namespace App\Filament\Clusters\SmtpSettings\Concerns;

use Illuminate\Contracts\Support\Htmlable;

trait HasSmtpSettingsPageHeading
{
    use HasSmtpSettingsPageChrome;

    public function getHeading(): string|Htmlable
    {
        return 'SMTP Settings';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Configure and manage outgoing email';
    }
}
