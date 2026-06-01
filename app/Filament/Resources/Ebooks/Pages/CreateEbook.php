<?php

namespace App\Filament\Resources\Ebooks\Pages;

use App\Filament\Resources\Ebooks\EbookResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEbook extends CreateRecord
{
    protected static string $resource = EbookResource::class;
}
