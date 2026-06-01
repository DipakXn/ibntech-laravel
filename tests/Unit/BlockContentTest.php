<?php

namespace Tests\Unit;

use App\Support\BlockContent;
use PHPUnit\Framework\TestCase;

class BlockContentTest extends TestCase
{
    public function test_it_normalizes_legacy_text_into_a_paragraph_block(): void
    {
        $blocks = BlockContent::normalize("First line\n\nSecond line");

        $this->assertSame('paragraph', $blocks[0]['type']);
        $this->assertStringContainsString('<p>First line</p>', $blocks[0]['data']['content']);
    }

    public function test_it_extracts_plain_text_from_mixed_blocks(): void
    {
        $plainText = BlockContent::toPlainText([
            [
                'type' => 'heading',
                'data' => ['text' => 'Launch plan'],
            ],
            [
                'type' => 'paragraph',
                'data' => ['content' => '<p>Keep the migration structured.</p>'],
            ],
            [
                'type' => 'faq',
                'data' => [
                    'items' => [
                        [
                            'question' => 'How long?',
                            'answer' => '<p>Usually 6 weeks.</p>',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertStringContainsString('Launch plan', $plainText);
        $this->assertStringContainsString('Keep the migration structured.', $plainText);
        $this->assertStringContainsString('How long?', $plainText);
        $this->assertStringContainsString('Usually 6 weeks.', $plainText);
    }
}
