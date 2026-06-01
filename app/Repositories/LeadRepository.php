<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function create(array $attributes): Lead
    {
        return Lead::query()->create($attributes);
    }
}

