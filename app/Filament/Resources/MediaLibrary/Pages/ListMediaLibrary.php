<?php

namespace App\Filament\Resources\MediaLibrary\Pages;

use App\Filament\Resources\MediaLibrary\MediaLibraryResource;
use App\Rules\ValidMediaLibraryUpload;
use App\Support\MediaLibrary\MediaLibraryFileValidator;
use App\Support\MediaLibrary\MediaLibraryUploader;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\RenderHook;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ListMediaLibrary extends ListRecords
{
    protected static string $resource = MediaLibraryResource::class;

    public ?int $selectedMediaId = null;

    private static bool $pagerHookRegistered = false;

    public function boot(): void
    {
        if (self::$pagerHookRegistered) {
            return;
        }

        self::$pagerHookRegistered = true;

        FilamentView::registerRenderHook(
            TablesRenderHook::CONTENT_AFTER,
            fn (array $data): string => view('filament.media-library.pager', [
                'paginator' => $data['records'] ?? null,
            ])->render(),
            scopes: static::class,
        );
    }

    private ?int $resolvedSelection = null;

    private bool $selectionResolved = false;

    public function selectMedia(int $mediaId): void
    {
        $this->selectedMediaId = $mediaId;
        $this->selectionResolved = false;
    }

    public function resolvedSelectedMediaId(): ?int
    {
        if ($this->selectionResolved) {
            return $this->resolvedSelection;
        }

        $this->selectionResolved = true;
        $records = $this->recordsOnPage();

        if ($this->selectedMediaId && $records->contains(
            fn (Media $record): bool => (int) $record->getKey() === (int) $this->selectedMediaId,
        )) {
            return $this->resolvedSelection = (int) $this->selectedMediaId;
        }

        $first = $records->first();

        return $this->resolvedSelection = $first instanceof Media ? (int) $first->getKey() : null;
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 4,
                ])
                    ->extraAttributes(['class' => 'ibn-media-layout'])
                    ->schema([
                        Group::make([
                            $this->getTabsContentComponent(),
                            RenderHook::make(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE),
                            EmbeddedTable::make(),
                            RenderHook::make(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER),
                        ])->columnSpan(['default' => 1, 'lg' => 3]),
                        View::make('filament.media-library.panel')
                            ->viewData(fn (): array => [
                                'media' => Media::query()->find($this->resolvedSelectedMediaId()),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }

    /**
     * @return Collection<int, Media>
     */
    private function recordsOnPage(): Collection
    {
        $records = $this->getTableRecords();

        if ($records instanceof Paginator || $records instanceof CursorPaginator) {
            return collect($records->items());
        }

        return collect($records);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('upload')
                ->label('Upload')
                ->icon(Heroicon::OutlinedArrowUpTray)
                ->color('primary')
                ->schema([
                    FileUpload::make('file')
                        ->label('File')
                        ->required()
                        ->storeFiles(false)
                        ->acceptedFileTypes(MediaLibraryFileValidator::acceptedMimeTypes())
                        ->maxSize(MediaLibraryFileValidator::PDF_MAX_KILOBYTES)
                        ->rules([new ValidMediaLibraryUpload])
                        ->helperText('JPG, PNG, GIF, and WebP up to 4 MB. PDF up to 10 MB. Existing files are not replaced.'),
                ])
                ->action(function (array $data, MediaLibraryUploader $uploader): void {
                    try {
                        $uploader->store(self::uploadedFile($data['file'] ?? null));
                    } catch (ValidationException $exception) {
                        Notification::make()
                            ->title($exception->validator->errors()->first() ?: 'The file could not be uploaded.')
                            ->danger()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title('File added to the Media Library')
                        ->success()
                        ->send();
                }),
        ];
    }

    private static function uploadedFile(mixed $file): UploadedFile|TemporaryUploadedFile
    {
        if (is_array($file)) {
            $file = reset($file);
        }

        if ($file instanceof UploadedFile || $file instanceof TemporaryUploadedFile) {
            return $file;
        }

        throw ValidationException::withMessages([
            'file' => 'Choose a JPG, PNG, GIF, WebP, or PDF file.',
        ]);
    }
}
