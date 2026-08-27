<?php

namespace Tests\Unit;

use App\Support\Html\UnknownElementUnwrapper;
use PHPUnit\Framework\TestCase;

class UnknownElementUnwrapperTest extends TestCase
{
    public function test_it_promotes_children_of_numeric_word_tags(): void
    {
        $html = '<span134233117><h2>The Key</h2><span>Later paragraph about accuracy.</span></span134233117>';

        $unwrapped = (new UnknownElementUnwrapper)->unwrap($html);

        $this->assertStringNotContainsString('span134233117', $unwrapped);
        $this->assertStringContainsString('<h2>The Key</h2>', $unwrapped);
        $this->assertStringContainsString('Later paragraph about accuracy.', $unwrapped);
        $this->assertStringContainsString('<h2>Keep heading</h2>', (new UnknownElementUnwrapper)->unwrap('<div><h2>Keep heading</h2></div>'));
    }

    public function test_it_leaves_safe_markup_intact(): void
    {
        $html = '<p>Hello <a href="/x">link</a></p><ul><li>Item</li></ul>';

        $unwrapped = (new UnknownElementUnwrapper)->unwrap($html);

        $this->assertStringContainsString('<p>Hello <a href="/x">link</a></p>', $unwrapped);
        $this->assertStringContainsString('<ul><li>Item</li></ul>', $unwrapped);
    }
}
