<?php

namespace App\Support\ContentTemplates;

class ScaffoldResult
{
    public function __construct(
        public readonly bool $bladeCreated,
        public readonly bool $cssCreated,
        public readonly string $bladePath,
        public readonly string $cssPath,
    ) {}

    public function notice(): string
    {
        $files = $this->bladePath."\n".$this->cssPath;
        $created = $this->bladeCreated || $this->cssCreated;

        $lead = $created
            ? 'Starter Blade and CSS files are ready. Customize them in Cursor. Commit and deploy these files with the database record.'
            : 'This record uses the Blade and CSS files that were already on disk. Nothing was overwritten.';

        return $lead."\n\n"
            .$files."\n\n"
            .'Restart `npm run dev` so Vite loads a new stylesheet. Production needs `npm run build` before that CSS is served.';
    }
}
