<?php

namespace App\Filament\Resources\Newsletters\Pages;

use App\Filament\Concerns\ScaffoldsContentTemplate;
use App\Filament\Resources\Newsletters\NewsletterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletter extends CreateRecord
{
    use ScaffoldsContentTemplate;

    protected static string $resource = NewsletterResource::class;
}
