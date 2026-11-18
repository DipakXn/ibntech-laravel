<?php

namespace App\Filament\Resources\LandingPages\Pages;

use App\Filament\Concerns\ScaffoldsContentTemplate;
use App\Filament\Resources\LandingPages\LandingPageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLandingPage extends CreateRecord
{
    use ScaffoldsContentTemplate;

    protected static string $resource = LandingPageResource::class;
}
