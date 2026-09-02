<?php

namespace App\Filament\Schemas;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\User;
use App\Support\ContentCta;
use App\Support\Html\HtmlCodePreview;
use App\Support\Html\HtmlToBlocks;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ContentBuilder
{
    public static function make(string $name = 'content'): Section
    {
        return Section::make('Content Builder')
            ->description('Add reusable blocks, then drag them into order. Use HTML Code to paste markup, preview it, and convert it into the same heading, paragraph, and other native blocks. Use image and gallery blocks for inline media, and CTA blocks for in-content calls to action.')
            ->schema([
                Builder::make($name)
                    ->label('Content Builder')
                    ->blocks(self::blocks())
                    ->blockIcons()
                    ->blockNumbers(false)
                    ->collapsible()
                    ->collapsed()
                    ->reorderableWithDragAndDrop()
                    ->extraItemActions([
                        self::convertHtmlCodeItemAction(),
                    ])
                    ->partiallyRenderAfterActionsCalled()
                    ->mutateDehydratedStateUsing(static function (?array $state): array {
                        return array_values(HtmlToBlocks::expandHtmlCodeWorkspaces($state ?? []));
                    })
                    ->columnSpanFull()
                    ->required(),
                self::additionalAssetsSection(),
            ])
            ->columns(2)
            ->columnSpanFull()
            ->collapsible();
    }

    protected static function blocks(): array
    {
        return [
            Block::make('paragraph')
                ->label('Paragraph')
                ->icon('heroicon-o-bars-3-bottom-left')
                ->schema([
                    RichEditor::make('content')
                        ->label('Text')
                        ->toolbarButtons([
                            ['h2', 'h3', 'bold', 'italic', 'underline', 'link'],
                            ['blockquote', 'bulletList', 'orderedList', 'codeBlock'],
                        ])
                        ->required()
                        ->columnSpanFull(),
                ]),
            Block::make('heading')
                ->label('Heading')
                ->icon('heroicon-o-bars-3')
                ->schema([
                    Select::make('level')
                        ->options([
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                            'h4' => 'Heading 4',
                        ])
                        ->default('h2')
                        ->required(),
                    TextInput::make('text')
                        ->required()
                        ->maxLength(255),
                    Select::make('alignment')
                        ->options([
                            'left' => 'Left',
                            'center' => 'Center',
                        ])
                        ->default('left')
                        ->required(),
                ]),
            Block::make('image')
                ->label('Image')
                ->icon('heroicon-o-photo')
                ->schema([
                    self::blockId(),
                    TextInput::make('url')
                        ->label('Image URL')
                        ->maxLength(2048)
                        ->visible(fn (Get $get): bool => filled($get('url'))),
                    self::mediaUpload('image')
                        ->label('Image')
                        ->required(fn (Get $get): bool => blank($get('url'))),
                    TextInput::make('alt')
                        ->label('Alt text')
                        ->maxLength(255),
                    Textarea::make('caption')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
            Block::make('gallery')
                ->label('Gallery')
                ->icon('heroicon-o-squares-2x2')
                ->schema([
                    self::blockId(),
                    self::mediaUpload('images')
                        ->label('Gallery images')
                        ->multiple()
                        ->reorderable()
                        ->required(),
                    TextInput::make('title')
                        ->maxLength(255),
                    Textarea::make('caption')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
            Block::make('quote')
                ->label('Quote')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->schema([
                    Textarea::make('quote')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                    TextInput::make('author')
                        ->maxLength(255),
                    TextInput::make('role')
                        ->maxLength(255),
                ]),
            Block::make('buttons')
                ->label('Buttons')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    TextInput::make('title')
                        ->maxLength(255),
                    Repeater::make('items')
                        ->label('Buttons')
                        ->schema([
                            TextInput::make('label')
                                ->required()
                                ->maxLength(100),
                            TextInput::make('url')
                                ->required()
                                ->maxLength(2048),
                            Select::make('style')
                                ->options([
                                    'primary' => 'Primary',
                                    'secondary' => 'Secondary',
                                    'dark' => 'Dark',
                                ])
                                ->default('primary')
                                ->required(),
                            Select::make('target')
                                ->options([
                                    '_self' => 'Same tab',
                                    '_blank' => 'New tab',
                                ])
                                ->default('_self')
                                ->required(),
                        ])
                        ->defaultItems(1)
                        ->minItems(1)
                        ->maxItems(3)
                        ->columnSpanFull()
                        ->reorderableWithDragAndDrop(),
                ]),
            Block::make('cta')
                ->label('CTA')
                ->icon('heroicon-o-rocket-launch')
                ->columns(2)
                ->schema([
                    TextInput::make('heading')
                        ->label('Heading')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Textarea::make('description')
                        ->label('Description')
                        ->rows(3)
                        ->columnSpanFull(),
                    TextInput::make('button_label')
                        ->label('Button text')
                        ->required()
                        ->maxLength(100),
                    TextInput::make('button_url')
                        ->label('Button URL')
                        ->required()
                        ->maxLength(2048)
                        ->placeholder('/contact/'),
                    Select::make('button_target')
                        ->label('Open link')
                        ->options([
                            '_self' => 'Same tab',
                            '_blank' => 'New tab',
                        ])
                        ->default('_self')
                        ->required(),
                    Select::make('icon')
                        ->label('Icon')
                        ->options(ContentCta::icons())
                        ->placeholder('No icon')
                        ->searchable(),
                    Select::make('theme')
                        ->label('Style')
                        ->options(ContentCta::themes())
                        ->default('navy')
                        ->required(),
                ]),
            Block::make('embed')
                ->label('Embed')
                ->icon('heroicon-o-play-circle')
                ->schema([
                    TextInput::make('url')
                        ->label('Embed URL')
                        ->required()
                        ->maxLength(2048),
                    TextInput::make('title')
                        ->maxLength(255),
                    Textarea::make('caption')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
            Block::make('html_code')
                ->label('HTML Code')
                ->icon('heroicon-o-code-bracket')
                ->schema([
                    Textarea::make('html')
                        ->label('HTML')
                        ->helperText('Paste HTML here. This workspace is converted into native content blocks and is not stored. Scripts and unsafe markup are removed from the preview and conversion.')
                        ->rows(12)
                        ->live(debounce: 500)
                        ->extraInputAttributes([
                            'class' => 'font-mono',
                        ])
                        ->columnSpanFull(),
                    View::make('filament.forms.components.html-code-preview')
                        ->viewData(fn (Get $get): array => [
                            'preview' => HtmlCodePreview::make($get('html')),
                        ])
                        ->columnSpanFull(),
                    Actions::make([
                        Action::make('convertToBlocks')
                            ->label('Convert to Content Blocks')
                            ->icon('heroicon-m-arrow-path')
                            ->color('primary')
                            ->action(function (Get $get, Component $component): void {
                                self::convertWorkspaceFromComponent($component, (string) $get('html'));
                            }),
                    ]),
                ]),
            Block::make('code')
                ->label('Code')
                ->icon('heroicon-o-code-bracket-square')
                ->schema([
                    Select::make('language')
                        ->options([
                            'html' => 'HTML',
                            'css' => 'CSS',
                            'javascript' => 'JavaScript',
                            'php' => 'PHP',
                            'json' => 'JSON',
                            'bash' => 'Bash',
                            'text' => 'Plain text',
                        ])
                        ->default('text')
                        ->required(),
                    TextInput::make('filename')
                        ->maxLength(255),
                    Textarea::make('code')
                        ->required()
                        ->rows(12)
                        ->columnSpanFull(),
                ]),
            Block::make('table')
                ->label('Table')
                ->icon('heroicon-o-table-cells')
                ->schema([
                    TextInput::make('caption')
                        ->maxLength(255),
                    TagsInput::make('headers')
                        ->label('Header columns')
                        ->placeholder('Add column')
                        ->reorderable()
                        ->columnSpanFull(),
                    Repeater::make('rows')
                        ->schema([
                            TagsInput::make('columns')
                                ->label('Cells')
                                ->placeholder('Add cell')
                                ->reorderable()
                                ->required(),
                        ])
                        ->defaultItems(2)
                        ->columnSpanFull()
                        ->reorderableWithDragAndDrop(),
                ]),
            Block::make('faq')
                ->label('FAQ')
                ->icon('heroicon-o-question-mark-circle')
                ->schema([
                    TextInput::make('title')
                        ->maxLength(255),
                    Repeater::make('items')
                        ->label('Questions')
                        ->schema([
                            TextInput::make('question')
                                ->required()
                                ->maxLength(255),
                            RichEditor::make('answer')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'link'],
                                    ['bulletList', 'orderedList'],
                                ])
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->defaultItems(2)
                        ->minItems(1)
                        ->columnSpanFull()
                        ->reorderableWithDragAndDrop(),
                ]),
            Block::make('callout')
                ->label('Callout')
                ->icon('heroicon-o-megaphone')
                ->schema([
                    Select::make('tone')
                        ->options([
                            'info' => 'Info',
                            'success' => 'Success',
                            'warning' => 'Warning',
                            'danger' => 'Danger',
                        ])
                        ->default('info')
                        ->required(),
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    RichEditor::make('content')
                        ->toolbarButtons([
                            ['bold', 'italic', 'link'],
                            ['bulletList', 'orderedList'],
                        ])
                        ->required()
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function additionalAssetsSection(): Section
    {
        return Section::make('Additional CSS & JavaScript')
            ->description('Optional page-level CSS and JavaScript for this record only. These are not stored in content blocks and are never output on listing or archive pages.')
            ->schema([
                Textarea::make('additional_css')
                    ->label('Additional CSS')
                    ->helperText('Paste raw CSS, or a single <style> wrapper. Wrappers are stripped on save so the frontend does not emit nested style tags.')
                    ->rows(12)
                    ->extraInputAttributes([
                        'class' => 'font-mono',
                    ])
                    ->columnSpanFull()
                    ->visible(fn (): bool => self::canEditAdditionalAssets()),
                Textarea::make('additional_js')
                    ->label('Additional JavaScript')
                    ->helperText('Paste raw JavaScript, or a single <script> wrapper. This field is only available to authorized Filament users and runs only on this detail page, after Livewire.')
                    ->rows(12)
                    ->extraInputAttributes([
                        'class' => 'font-mono',
                    ])
                    ->columnSpanFull()
                    ->visible(fn (): bool => self::canEditAdditionalAssets()),
            ])
            ->collapsed()
            ->columnSpanFull();
    }

    protected static function canEditAdditionalAssets(): bool
    {
        $user = auth()->user();

        return $user instanceof User
            && in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_AUTHOR], true);
    }

    protected static function blockId(): Hidden
    {
        return Hidden::make('block_id')
            ->default(fn (): string => (string) Str::uuid())
            ->afterStateHydrated(function (Set $set, ?string $state): void {
                if (blank($state)) {
                    $set('block_id', (string) Str::uuid());
                }
            })
            ->dehydrated();
    }

    protected static function mediaUpload(string $name): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make($name)
            ->collection('content_blocks')
            ->visibility('public')
            ->image()
            ->imageEditor()
            ->imagePreviewHeight('160')
            ->maxSize(4096)
            ->customProperties(fn (Get $get): array => [
                'block_id' => $get('block_id'),
            ])
            ->filterMediaUsing(fn (Collection $media, Get $get): Collection => $media
                ->filter(fn ($item): bool => data_get($item, 'custom_properties.block_id') === $get('block_id'))
                ->values());
    }

    protected static function convertHtmlCodeItemAction(): Action
    {
        return Action::make('convertHtmlCode')
            ->label('Convert to Content Blocks')
            ->icon('heroicon-m-arrow-path')
            ->button()
            ->visible(function (Builder $component, array $arguments): bool {
                $item = $component->getRawState()[$arguments['item'] ?? ''] ?? null;

                return HtmlToBlocks::isWorkspace(is_array($item) ? $item : null);
            })
            ->action(function (array $arguments, Builder $component): void {
                self::replaceHtmlCodeItem($component, (string) ($arguments['item'] ?? ''));
            });
    }

    protected static function convertWorkspaceFromComponent(Component $component, string $html): void
    {
        [$builder, $itemKey] = self::resolveBuilderItem($component);

        if (! $builder instanceof Builder || $itemKey === null) {
            Notification::make()
                ->danger()
                ->title('Unable to convert this HTML workspace.')
                ->send();

            return;
        }

        self::replaceHtmlCodeItem($builder, $itemKey, $html);
    }

    /**
     * @return array{0: Builder|null, 1: string|null}
     */
    protected static function resolveBuilderItem(Component $component): array
    {
        $current = $component;
        $statePaths = [];

        while ($current) {
            $container = $current->getContainer();

            if ($container && filled($container->getStatePath())) {
                $statePaths[] = $container->getStatePath();
            }

            $parent = $container?->getParentComponent();

            if ($parent instanceof Builder) {
                $builderPath = $parent->getStatePath();
                $items = $parent->getRawState() ?? [];

                foreach ($statePaths as $path) {
                    if (! str_starts_with($path, $builderPath.'.')) {
                        continue;
                    }

                    $itemKey = explode('.', Str::after($path, $builderPath.'.'))[0] ?? null;

                    if (filled($itemKey) && array_key_exists($itemKey, $items)) {
                        return [$parent, $itemKey];
                    }
                }

                return [$parent, null];
            }

            $current = $parent;
        }

        return [null, null];
    }

    protected static function replaceHtmlCodeItem(Builder $builder, string $itemKey, ?string $html = null): void
    {
        $items = $builder->getRawState() ?? [];

        if (! HtmlToBlocks::isWorkspace($items[$itemKey] ?? null)) {
            return;
        }

        $newKeys = [];
        $replaced = HtmlToBlocks::convertWorkspaceInState(
            $items,
            $itemKey,
            $html,
            function () use ($builder, &$newKeys): string {
                $key = $builder->generateUuid() ?: (string) Str::uuid();
                $newKeys[] = $key;

                return $key;
            },
        );

        if ($replaced === $items) {
            Notification::make()
                ->warning()
                ->title('No content blocks could be created from this HTML.')
                ->send();

            return;
        }

        $builder->rawState($replaced);
        $builder->collapsed(false, shouldMakeComponentCollapsible: false);

        foreach ($newKeys as $newKey) {
            $data = $replaced[$newKey]['data'] ?? [];
            $schema = $builder->getChildSchema($newKey);

            if ($schema) {
                $schema->fill(filled($data) ? $data : null);
            }
        }

        $builder->callAfterStateUpdated();
        $builder->partiallyRender();
    }
}
