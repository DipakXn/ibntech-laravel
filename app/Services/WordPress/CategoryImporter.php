<?php

namespace App\Services\WordPress;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryImporter
{
    /**
     * @param  array<int, array<int, string>>  $paths
     * @return array{category: ?Category, unmapped: array<int, string>}
     */
    public function resolve(array $paths): array
    {
        $paths = array_values(array_filter($paths));

        if ($paths === []) {
            return [
                'category' => null,
                'unmapped' => [],
            ];
        }

        $primaryPath = array_shift($paths);
        $category = $this->firstOrCreatePath($primaryPath);

        $unmapped = [];

        foreach ($paths as $path) {
            $unmapped[] = implode(' > ', $path);
        }

        return [
            'category' => $category,
            'unmapped' => $unmapped,
        ];
    }

    /**
     * @param  array<int, string>  $path
     */
    protected function firstOrCreatePath(array $path): ?Category
    {
        $parentId = null;
        $category = null;

        foreach ($path as $name) {
            $name = trim($name);

            if ($name === '') {
                continue;
            }

            $slug = Str::slug($name) ?: Str::slug(Str::limit($name, 60, ''));

            if ($slug === '') {
                continue;
            }

            $category = Category::query()->firstOrCreate(
                [
                    'module' => Category::MODULE_BLOG,
                    'slug' => $slug,
                ],
                [
                    'name' => $name,
                    'parent_id' => $parentId,
                ],
            );

            $parentId = $category->id;
        }

        return $category;
    }
}
