<?php

namespace App\Rules;

use App\Services\SiteRedirects;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;

class ValidManagedRedirect implements ValidationRule
{
    public function __construct(
        private readonly string $target,
        private readonly ?int $ignoreId = null,
        private readonly int $statusCode = 301,
        private readonly string $matchType = 'exact',
        private readonly bool $ignoreCase = false,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! in_array($this->statusCode, [410, 451], true) && trim($this->target) === '') {
            return;
        }

        try {
            app(SiteRedirects::class)->assert(
                (string) $value,
                $this->target,
                $this->ignoreId,
                $this->statusCode,
                $this->matchType,
                $this->ignoreCase,
            );
        } catch (ValidationException $exception) {
            $fail((string) collect($exception->errors())->flatten()->first());
        }
    }
}
