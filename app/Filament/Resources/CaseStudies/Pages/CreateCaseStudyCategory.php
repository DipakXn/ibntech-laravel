<?php

namespace App\Filament\Resources\CaseStudies\Pages;

use App\Filament\Resources\CaseStudies\CaseStudyCategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;

class CreateCaseStudyCategory extends CreateRecord
{
    protected static string $resource = CaseStudyCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['module'] = Category::MODULE_CASE_STUDY;

        return $data;
    }
}
