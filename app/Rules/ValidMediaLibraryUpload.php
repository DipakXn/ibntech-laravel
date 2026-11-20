<?php

namespace App\Rules;

use App\Support\MediaLibrary\MediaLibraryFileValidator;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ValidMediaLibraryUpload implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_array($value)) {
            $value = reset($value);
        }

        if (! $value instanceof UploadedFile && ! $value instanceof TemporaryUploadedFile) {
            $fail('Choose a JPG, PNG, GIF, WebP, or PDF file.');

            return;
        }

        $message = MediaLibraryFileValidator::rejectionMessage(
            originalName: $value->getClientOriginalName(),
            extension: (string) $value->getClientOriginalExtension(),
            mime: strtolower((string) $value->getMimeType()),
            bytes: (int) $value->getSize(),
        );

        if ($message !== null) {
            $fail($message);
        }
    }
}
