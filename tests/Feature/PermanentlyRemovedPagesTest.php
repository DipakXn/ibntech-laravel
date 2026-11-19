<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PermanentlyRemovedPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{0: string}>
     */
    public static function permanentlyRemovedPages(): array
    {
        return [
            'payroll processing old' => ['/payroll-processing-old/'],
            'back offices services' => ['/back-offices-services/'],
            'removed case study' => ['/accounting-finannce-cpa-firm-case-study-2/'],
        ];
    }

    #[Test]
    #[DataProvider('permanentlyRemovedPages')]
    public function permanently_removed_pages_return_gone(string $path): void
    {
        $this->get($path)->assertGone();
    }
}
