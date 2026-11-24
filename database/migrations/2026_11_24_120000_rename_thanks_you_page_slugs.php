<?php

use App\Models\ContentRedirect;
use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Public URL correction only. Blade templates stay on the misspelled names.
     *
     * @var array<string, string>
     */
    private const SLUGS = [
        'thanks-you-for-bookkeeping' => 'thank-you-for-bookkeeping',
        'thanks-you-for-payroll-service' => 'thank-you-for-payroll-service',
        'thanks-you-for-ap-ar-management' => 'thank-you-for-ap-ar-management',
        'thanks-you-for-tax-preparation' => 'thank-you-for-tax-preparation',
        'thanks-you-for-ipa' => 'thank-you-for-ipa',
        'thanks-you-for-free-trail' => 'thank-you-for-free-trail',
        'thanks-you-for-cybersecurity' => 'thank-you-for-cybersecurity',
        'thanks-you-for-cloud' => 'thank-you-for-cloud',
    ];

    public function up(): void
    {
        foreach (self::SLUGS as $from => $to) {
            if (Page::withTrashed()->where('slug', $to)->exists()) {
                continue;
            }

            $page = Page::query()
                ->where('slug', $from)
                ->where('status', 'published')
                ->first();

            if (! $page instanceof Page) {
                continue;
            }

            $page->slug = $to;
            $page->save();

            Cache::forget("page:{$from}");
            Cache::forget("page:{$to}");
        }

        $this->rewriteCanonicals(fromThanksYou: true);
    }

    public function down(): void
    {
        foreach (self::SLUGS as $from => $to) {
            if (! Page::withTrashed()->where('slug', $from)->exists()) {
                $page = Page::query()
                    ->where('slug', $to)
                    ->where('status', 'published')
                    ->first();

                if ($page instanceof Page) {
                    Page::withoutEvents(function () use ($page, $from): void {
                        $page->slug = $from;
                        $page->save();
                    });

                    Cache::forget("page:{$from}");
                    Cache::forget("page:{$to}");
                }
            }

            ContentRedirect::withTrashed()
                ->where('source_path', '/'.$from)
                ->where('target_path', '/'.$to)
                ->get()
                ->each
                ->forceDelete();
        }

        $this->rewriteCanonicals(fromThanksYou: false);
    }

    private function rewriteCanonicals(bool $fromThanksYou): void
    {
        foreach (self::SLUGS as $from => $to) {
            $old = $fromThanksYou ? $from : $to;
            $new = $fromThanksYou ? $to : $from;

            SeoMeta::query()
                ->where('canonical_url', 'like', '%'.$old.'%')
                ->get()
                ->each(function (SeoMeta $seo) use ($old, $new): void {
                    $canonical = $seo->canonical_url;

                    if (! is_string($canonical) || ! str_contains($canonical, $old)) {
                        return;
                    }

                    $seo->canonical_url = str_replace($old, $new, $canonical);
                    $seo->save();
                });
        }
    }
};
