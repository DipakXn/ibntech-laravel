<?php

namespace App\Filament\Schemas;

use App\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ContentBuilder
{
    public static function make(string $name = 'content'): Section
    {
        return Section::make('Content Builder')
            ->description('Add reusable blocks, then drag them into order. Use image and gallery blocks for inline media.')
            ->schema([
                Builder::make($name)
                    ->label('Content Builder')
                    ->blocks(self::blocks())
                    ->blockIcons()
                    ->blockNumbers(false)
                    ->collapsible()
                    ->collapsed()
                    ->reorderableWithDragAndDrop()
                    ->columnSpanFull()
                    ->required(),
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
                    self::mediaUpload('image')
                        ->label('Image')
                        ->required(),
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
            ->disk('public')
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
}
