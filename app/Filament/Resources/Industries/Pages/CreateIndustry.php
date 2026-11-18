<?php

namespace App\Filament\Resources\Industries\Pages;

use App\Filament\Concerns\ScaffoldsContentTemplate;
use App\Filament\Resources\Industries\IndustryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIndustry extends CreateRecord
{
    use ScaffoldsContentTemplate;

    protected static string $resource = IndustryResource::class;
}
