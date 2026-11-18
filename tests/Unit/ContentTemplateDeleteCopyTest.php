<?php

namespace Tests\Unit;

use App\Filament\Support\ContentTemplateDeleteCopy;
use App\Models\Blog;
use App\Models\Page;
use PHPUnit\Framework\TestCase;

class ContentTemplateDeleteCopyTest extends TestCase
{
    public function test_template_modules_include_blade_and_css_warning_on_trash_and_force_delete(): void
    {
        $page = new Page(['template' => 'about-us']);

        foreach ([
            ContentTemplateDeleteCopy::trashDescription($page),
            ContentTemplateDeleteCopy::forceDeleteDescription($page),
        ] as $message) {
            $this->assertStringContainsString('Blade and CSS', $message);
            $this->assertStringContainsString('does not remove them automatically', $message);
        }
    }

    public function test_other_modules_keep_the_generic_trash_copy(): void
    {
        $blog = new Blog(['template' => 'default']);

        $this->assertStringNotContainsString(
            'Blade and CSS',
            ContentTemplateDeleteCopy::trashDescription($blog),
        );
    }

    public function test_restore_mentions_files_are_unchanged_for_template_modules(): void
    {
        $page = new Page(['template' => 'about-us']);

        $this->assertStringContainsString(
            'were not changed while the item was in trash',
            ContentTemplateDeleteCopy::restoreDescription($page),
        );
    }
}
