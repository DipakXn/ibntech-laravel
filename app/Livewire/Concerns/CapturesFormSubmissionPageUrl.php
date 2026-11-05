<?php

namespace App\Livewire\Concerns;

use App\Support\FormSubmissionPageUrl;

trait CapturesFormSubmissionPageUrl
{
    protected function captureFormSubmissionPageUrl(?string $candidate = null): string
    {
        $existing = property_exists($this, 'pageUrl') && is_string($this->pageUrl)
            ? $this->pageUrl
            : '';

        return FormSubmissionPageUrl::resolve($candidate ?? $existing);
    }

    protected function syncFormSubmissionPageUrl(?string $candidate = null): void
    {
        if (! property_exists($this, 'pageUrl')) {
            return;
        }

        $this->pageUrl = $this->captureFormSubmissionPageUrl($candidate);
    }
}
