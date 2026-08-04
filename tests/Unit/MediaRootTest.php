<?php

namespace Tests\Unit;

use App\Support\Filesystem\MediaRoot;
use Tests\TestCase;

class MediaRootTest extends TestCase
{
    public function test_it_resolves_relative_roots_from_the_application_base_path(): void
    {
        $resolved = MediaRoot::resolve('public/uploads');

        $this->assertSame(
            str_replace('\\', '/', base_path('public/uploads')),
            $resolved,
        );
    }

    public function test_it_preserves_absolute_unix_roots(): void
    {
        $this->assertSame(
            '/home/user/public_html/uploads',
            MediaRoot::resolve('/home/user/public_html/uploads'),
        );
    }

    public function test_it_preserves_absolute_windows_roots(): void
    {
        $this->assertSame(
            'C:/inetpub/wwwroot/uploads',
            MediaRoot::resolve('C:\\inetpub\\wwwroot\\uploads'),
        );
    }
}
