import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { readdirSync } from 'node:fs';
import { join } from 'node:path';

const pageCssEntries = readdirSync(join('resources', 'css', 'pages'))
    .filter((file) => file.endsWith('.css'))
    .map((file) => `resources/css/pages/${file}`);

const industryCssEntries = readdirSync(join('resources', 'css', 'industries'))
    .filter((file) => file.endsWith('.css'))
    .map((file) => `resources/css/industries/${file}`);

const landingPageCssEntries = readdirSync(join('resources', 'css', 'landing-pages'))
    .filter((file) => file.endsWith('.css'))
    .map((file) => `resources/css/landing-pages/${file}`);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/filament/admin/theme.css',
                'resources/js/app.js',
                ...pageCssEntries,
                ...industryCssEntries,
                ...landingPageCssEntries,
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
