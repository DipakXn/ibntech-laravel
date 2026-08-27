<?php

namespace Tests\Unit;

use App\Pagination\PathPagePaginator;
use Tests\TestCase;

class PathPagePaginatorTest extends TestCase
{
    public function test_it_builds_trailing_slash_page_urls(): void
    {
        $paginator = new PathPagePaginator(range(1, 15), 40, 15, 2, [
            'path' => 'http://localhost/blog/category/cybersecurity/',
        ]);

        $this->assertSame('http://localhost/blog/category/cybersecurity/', $paginator->url(1));
        $this->assertSame('http://localhost/blog/category/cybersecurity/page/2/', $paginator->url(2));
        $this->assertSame('http://localhost/blog/category/cybersecurity/', $paginator->previousPageUrl());
        $this->assertSame('http://localhost/blog/category/cybersecurity/page/3/', $paginator->nextPageUrl());
    }
}
