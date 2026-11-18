<?php

namespace App\Filament\Schemas;

use App\Rules\ContentTemplateSlug;
use App\Rules\PublishedTemplateAssetsExist;
use App\Services\ContentTemplateScaffold;
use App\Support\ContentTemplates\ContentTemplateKind;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class ContentTemplateForm
{
    public const FEATURED_IMAGE_HELP = 'Used for SEO, social sharing, and listings. The in-page hero is defined in the Blade file, not by this image.';

    public static function slug(ContentTemplateKind $kind): TextInput
    {
        return TextInput::make('slug')
            ->required()
            ->maxLength(ContentTemplateScaffold::MAX_SLUG_LENGTH)
            ->live(onBlur: true)
            ->unique(ignoreRecord: true)
            ->rules([
                fn (): ContentTemplateSlug => new ContentTemplateSlug($kind),
            ])
            ->afterStateUpdated(function (?string $state, Set $set, string $operation): void {
                if ($operation === 'create') {
                    $set('template', (string) $state);
                }
            })
            ->helperText('Lowercase letters, numbers, and hyphens. This becomes the public URL. The Blade and CSS filenames stay on the template name chosen at creation.');
    }

    public static function template(): TextInput
    {
        return TextInput::make('template')
            ->label('Template')
            ->readOnly()
            ->dehydrated()
            ->helperText('Set from the slug when the record is created. Later slug changes do not rename the Blade or CSS file.');
    }

    /**
     * @return list<Placeholder>
     */
    public static function assetPlaceholders(ContentTemplateKind $kind): array
    {
        $scaffold = app(ContentTemplateScaffold::class);

        return [
            Placeholder::make('blade_availability')
                ->label('Blade file')
                ->content(fn (Get $get): string => $scaffold->availabilityLabel(
                    $scaffold->bladeExists($kind, (string) $get('template')),
                ))
                ->visible(fn (string $operation): bool => $operation === 'edit'),
            Placeholder::make('css_availability')
                ->label('CSS file')
                ->content(fn (Get $get): string => $scaffold->availabilityLabel(
                    $scaffold->cssExists($kind, (string) $get('template')),
                ))
                ->visible(fn (string $operation): bool => $operation === 'edit'),
        ];
    }

    public static function publishRule(ContentTemplateKind $kind): \Closure
    {
        return fn (Get $get, string $operation): PublishedTemplateAssetsExist => new PublishedTemplateAssetsExist(
            $kind,
            (string) ($get('template') ?: ''),
            $operation === 'edit',
        );
    }
}
