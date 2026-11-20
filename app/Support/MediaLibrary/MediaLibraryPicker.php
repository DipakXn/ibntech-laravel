<?php

namespace App\Support\MediaLibrary;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryPicker
{
    public function __construct(private MediaLibraryCopier $copier) {}

    public function attach(SpatieMediaLibraryFileUpload $component, int $mediaId): void
    {
        $record = $this->record($component);

        if (! $record instanceof Model || ! $record instanceof HasMedia || ! $record->exists) {
            Notification::make()
                ->title('Save this record before choosing a library file.')
                ->warning()
                ->send();

            return;
        }

        $source = Media::query()->find($mediaId);

        if (! $source instanceof Media) {
            Notification::make()
                ->title('That library file is no longer available.')
                ->danger()
                ->send();

            return;
        }

        $collection = $component->getCollection() ?? 'default';
        $properties = $component->resolvedCustomProperties();

        if ($collection === 'content_blocks' && blank($properties['block_id'] ?? null)) {
            Notification::make()
                ->title('This image block is missing its id. Add the block again, then choose a file.')
                ->warning()
                ->send();

            return;
        }

        try {
            $copy = $this->copier->copy(
                source: $source,
                destination: $record,
                collection: $collection,
                customProperties: $properties,
                acceptedFileTypes: $component->getAcceptedFileTypes(),
                maxKilobytes: $component->getMaxSize(),
            );
        } catch (InvalidArgumentException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();

            return;
        }

        $record->unsetRelation('media');
        $uuid = (string) $copy->uuid;

        if ($component->isMultiple()) {
            $state = $component->getRawState() ?? [];
            $state[$uuid] = $uuid;
            $component->rawState($state);
        } else {
            $component->rawState([$uuid => $uuid]);
        }

        Notification::make()
            ->title('Copied the file onto this record. The original stays in the library.')
            ->success()
            ->send();
    }

    private function record(SpatieMediaLibraryFileUpload $component): mixed
    {
        try {
            return $component->getRecord();
        } catch (\Throwable) {
            return null;
        }
    }
}
