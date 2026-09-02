<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PathPagePaginator extends LengthAwarePaginator
{
    public static function wrap(LengthAwarePaginator $results, string $path): self
    {
        return new self(
            $results->getCollection(),
            $results->total(),
            $results->perPage(),
            $results->currentPage(),
            [
                'path' => rtrim($path, '/'),
                'pageName' => $results->getPageName(),
            ]
        );
    }

    /**
     * Build a trailing-slash URL using /page/{n}/ instead of ?page={n}.
     *
     * @param  int  $page
     */
    public function url($page): string
    {
        if ($page <= 0) {
            $page = 1;
        }

        $url = $page <= 1
            ? $this->path().'/'
            : $this->path().'/page/'.$page.'/';

        if (count($this->query) > 0) {
            $url .= '?'.Arr::query($this->query);
        }

        return $url.$this->buildFragment();
    }
}
