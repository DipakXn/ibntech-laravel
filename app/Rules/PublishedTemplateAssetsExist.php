<?php

namespace App\Rules;

use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;

class PublishedTemplateAssetsExist implements ValidationRule
{
    public function __construct(
        private readonly ContentTemplateKind $kind,
        private readonly string $template,
        private readonly bool $enforce,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->enforce || $value !== 'published') {
            return;
        }

        try {
            app(ContentTemplateScaffold::class)->assertAssetsExist($this->kind, $this->template);
        } catch (ValidationException $exception) {
            $fail((string) collect($exception->errors())->flatten()->first());
        }
    }
}
