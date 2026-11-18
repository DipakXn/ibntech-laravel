<?php

namespace App\Rules;

use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;

class ContentTemplateSlug implements ValidationRule
{
    public function __construct(
        private readonly ContentTemplateKind $kind,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            app(ContentTemplateScaffold::class)->assertSlug($this->kind, (string) $value);
        } catch (ValidationException $exception) {
            $fail((string) collect($exception->errors())->flatten()->first());
        }
    }
}
