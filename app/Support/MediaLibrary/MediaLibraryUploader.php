<?php

namespace App\Support\MediaLibrary;

use App\Models\MediaLibrary;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryUploader
{
    public function store(UploadedFile|TemporaryUploadedFile $file): Media
    {
        $message = MediaLibraryFileValidator::rejectionMessage(
            originalName: $file->getClientOriginalName(),
            extension: (string) $file->getClientOriginalExtension(),
            mime: strtolower((string) $file->getMimeType()),
            bytes: (int) $file->getSize(),
        );

        if ($message !== null) {
            throw ValidationException::withMessages([
                'file' => $message,
            ]);
        }

        $library = MediaLibrary::singleton();
        $disk = (string) config('media-library.disk_name', 'media');
        $directory = MediaPathResolver::forUpload(MediaLibrary::class, 'library', $library);
        $fileName = MediaStoredFileName::unique($disk, $directory, $file->getClientOriginalName());

        return $library
            ->addMedia($file->getRealPath())
            ->usingFileName($fileName)
            ->usingName(pathinfo($fileName, PATHINFO_FILENAME))
            ->toMediaCollection('library', $disk);
    }
}
