<?php

namespace App\Livewire\Concerns;

use App\Support\LeadSource;
use Livewire\Attributes\Locked;

trait ProvidesOrganicLeadSource
{
    #[Locked]
    public string $leadSource = '';

    public function bootProvidesOrganicLeadSource(): void
    {
        $this->leadSource = LeadSource::ORGANIC_SEO;
    }
}
