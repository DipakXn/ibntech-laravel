<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function create(array $attributes): Lead
    {
        return Lead::query()->create($attributes);
    }

    public function hasRecentDuplicate(string $email, string $formName, ?string $ipAddress, int $seconds = 120): bool
    {
        return Lead::query()
            ->where('email', $email)
            ->where('form_name', $formName)
            ->when($ipAddress, fn ($query) => $query->where('ip_address', $ipAddress))
            ->where('created_at', '>=', now()->subSeconds($seconds))
            ->exists();
    }
}

