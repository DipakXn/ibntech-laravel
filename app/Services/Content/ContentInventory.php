<?php

namespace App\Services\Content;

use App\Models\Article;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Ebook;
use App\Models\Industry;
use App\Models\LandingPage;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\PressRelease;
use App\Models\WhitePaper;
use Illuminate\Database\Eloquent\Model;

class ContentInventory
{
    /**
     * Total records for each content module, counted in one aggregated query.
     *
     * @return array<string, int>
     */
    public function totals(): array
    {
        $models = $this->models();
        $union = null;

        foreach ($models as $key => $model) {
            $query = $model::query()
                ->toBase()
                ->selectRaw('? as content_key, COUNT(*) as total', [$key]);

            $union = $union === null ? $query : $union->unionAll($query);
        }

        $totals = array_fill_keys(array_keys($models), 0);

        foreach ($union->get() as $row) {
            $totals[(string) $row->content_key] = (int) $row->total;
        }

        return $totals;
    }

    /**
     * @return array<string, class-string<Model>>
     */
    public function models(): array
    {
        return [
            'pages' => Page::class,
            'blogs' => Blog::class,
            'industries' => Industry::class,
            'case_studies' => CaseStudy::class,
            'landing_pages' => LandingPage::class,
            'newsletters' => Newsletter::class,
            'press_releases' => PressRelease::class,
            'ebooks' => Ebook::class,
            'white_papers' => WhitePaper::class,
            'articles' => Article::class,
        ];
    }
}
