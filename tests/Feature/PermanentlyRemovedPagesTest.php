<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PermanentlyRemovedPagesTest extends TestCase
{
    /**
     * @return array<string, array{0: string}>
     */
    public static function permanentlyRemovedPages(): array
    {
        return [
            'payroll processing old' => ['/payroll-processing-old/'],
            'back offices services' => ['/back-offices-services/'],
        ];
    }

    #[Test]
    #[DataProvider('permanentlyRemovedPages')]
    public function permanently_removed_pages_return_gone(string $path): void
    {
        $this->get($path)->assertGone();
    }
}
