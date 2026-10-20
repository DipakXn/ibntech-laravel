<?php

namespace App\Support;

use App\Models\Blog;
use App\Models\Category;

final class BlogContactModalCampaign
{
    /**
     * @var list<string>
     */
    public const PRIORITY_SLUGS = [
        'msoc',
        'soc-2',
        'vapt',
    ];

    /**
     * @var array<string, array{title: string, subtitle: string}>
     */
    public const CONTENT_BY_SLUG = [
        'msoc' => [
            'title' => 'What does a live SOC dashboard catch that yours misses?',
            'subtitle' => 'Book a walkthrough of real-time threat detection in action.',
        ],
        'soc-2' => [
            'title' => 'Questions about SOC 2 compliance?',
            'subtitle' => 'Speak with our compliance team about what your organization actually needs.',
        ],
        'vapt' => [
            'title' => 'Not sure what kind of VAPT you actually need?',
            'subtitle' => 'Network, web app, API, cloud. 15-minute call can save weeks of guesswork.',
        ],
    ];

    /**
     * @return array{slug: string, title: string, subtitle: string}|null
     */
    public static function forBlog(Blog $blog): ?array
    {
        $blog->loadMissing('category.parent');

        $category = $blog->category;

        if (! $category instanceof Category) {
            return null;
        }

        $slugsInChain = self::categorySlugChain($category);

        foreach (self::PRIORITY_SLUGS as $slug) {
            if (in_array($slug, $slugsInChain, true)) {
                return array_merge(['slug' => $slug], self::CONTENT_BY_SLUG[$slug]);
            }
        }

        return null;
    }

    /**
     * @return list<string>
     */
    private static function categorySlugChain(Category $category): array
    {
        $slugs = [];
        $current = $category;
        $guard = 0;

        while ($guard < 10) {
            $slugs[] = $current->slug;

            if (! $current->parent_id) {
                break;
            }

            $current->loadMissing('parent');

            if (! $current->parent instanceof Category) {
                break;
            }

            $current = $current->parent;
            $guard++;
        }

        return $slugs;
    }
}
