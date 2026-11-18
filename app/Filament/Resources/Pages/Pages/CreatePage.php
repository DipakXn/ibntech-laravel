<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Concerns\ScaffoldsContentTemplate;
use App\Filament\Resources\Pages\PageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    use ScaffoldsContentTemplate;

    protected static string $resource = PageResource::class;
}
