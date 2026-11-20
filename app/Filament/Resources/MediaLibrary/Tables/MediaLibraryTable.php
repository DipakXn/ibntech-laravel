<?php

namespace App\Filament\Resources\MediaLibrary\Tables;

use App\Filament\Resources\MediaLibrary\Pages\ListMediaLibrary;
use App\Filament\Tables\GroupedRecordActions;
use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\MediaLibrary;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\SeoMeta;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use App\Models\WhitePaper;
use App\Support\MediaLibrary\MediaLibraryUsage;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use RuntimeException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryTable
{
    public static function configure(Table $table): Table
    {
        $table = $table
            ->extraAttributes(['class' => 'ibn-media-library'])
            ->contentGrid([
                'default' => 2,
                'sm' => 3,
                'lg' => 4,
                'xl' => 5,
            ])
            ->paginationPageOptions([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->recordClasses(function (Media $record, ListMediaLibrary $livewire): ?string {
                return (int) $livewire->resolvedSelectedMediaId() === (int) $record->getKey()
                    ? 'ibn-media-selected'
                    : null;
            })
            ->columns([
                Stack::make([
                    ViewColumn::make('card')
                        ->label('')
                        ->view('filament.media-library.card'),
                ]),
            ])
            ->searchable(['file_name'])
            ->filters([
                Filter::make('kind')
                    ->label('Type')
                    ->schema([
                        Select::make('value')
                            ->label('Type')
                            ->options([
                                'image' => 'Images',
                                'pdf' => 'PDFs',
                                'other' => 'Other',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'image' => $query->where('mime_type', 'like', 'image/%'),
                            'pdf' => $query->whereIn('mime_type', ['application/pdf', 'application/x-pdf']),
                            'other' => $query->where(function (Builder $query): void {
                                $query->where('mime_type', 'not like', 'image/%')
                                    ->whereNotIn('mime_type', ['application/pdf', 'application/x-pdf']);
                            }),
                            default => $query,
                        };
                    }),
                Filter::make('owner')
                    ->label('Owner')
                    ->schema([
                        Select::make('value')
                            ->label('Owner')
                            ->options([
                                MediaLibrary::class => 'Media Library',
                                Blog::class => 'Blogs',
                                Article::class => 'Articles',
                                Page::class => 'Pages',
                                Industry::class => 'Industries',
                                LandingPage::class => 'Landing pages',
                                Newsletter::class => 'Newsletters',
                                CaseStudy::class => 'Case studies',
                                Ebook::class => 'eBooks',
                                PressRelease::class => 'Press releases',
                                WhitePaper::class => 'White papers',
                                Testimonial::class => 'Testimonials',
                                SeoMeta::class => 'SEO images',
                                WebsiteSetting::class => 'Website settings',
                            ]),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => filled($data['value'] ?? null)
                        ? $query->where('model_type', $data['value'])
                        : $query),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchPlaceholder('Search file names')
            ->emptyStateIcon(Heroicon::OutlinedPhoto)
            ->emptyStateHeading('No media yet')
            ->emptyStateDescription('Files uploaded on content records appear here. New library files are stored separately and do not replace existing images.')
            ->recordUrl(null);

        return GroupedRecordActions::apply($table, [
            Action::make('details')
                ->label('Details')
                ->icon(Heroicon::OutlinedEye)
                ->color('gray')
                ->slideOver()
                ->modalWidth(Width::Large)
                ->modalHeading(fn (Media $record): string => (string) $record->file_name)
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Close')
                ->modalContent(fn (Media $record) => view('filament.media-library.details', [
                    'media' => $record,
                    'usage' => app(MediaLibraryUsage::class),
                ])),
            Action::make('deleteFile')
                ->label('Delete')
                ->icon(Heroicon::OutlinedTrash)
                ->color('danger')
                ->requiresConfirmation()
                ->modalDescription('This removes the library file. Copies already placed on content records stay where they are.')
                ->visible(fn (Media $record): bool => app(MediaLibraryUsage::class)->canDelete($record))
                ->action(function (Media $record): void {
                    try {
                        app(MediaLibraryUsage::class)->delete($record);
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->title($exception->getMessage())
                            ->danger()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title('Library file deleted')
                        ->success()
                        ->send();
                }),
        ]);
    }
}
