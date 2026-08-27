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
            [
                'type' => 'cta',
                'data' => [
                    'heading' => 'Talk to an expert',
                    'description' => 'Book a strategy call.',
                    'button_label' => 'Get started',
                ],
            ],
        ]);

        $this->assertStringContainsString('Launch plan', $plainText);
        $this->assertStringContainsString('Keep the migration structured.', $plainText);
        $this->assertStringContainsString('How long?', $plainText);
        $this->assertStringContainsString('Usually 6 weeks.', $plainText);
        $this->assertStringContainsString('Talk to an expert', $plainText);
        $this->assertStringContainsString('Get started', $plainText);
    }

    public function test_it_does_not_rewrite_existing_native_blocks_on_read(): void
    {
        $blocks = [
            [
                'type' => 'paragraph',
                'data' => ['content' => '<p>Already saved.</p>'],
            ],
        ];

        $this->assertSame($blocks, BlockContent::normalize($blocks));
        $this->assertSame($blocks, json_decode((string) BlockContent::encode($blocks), true));
    }
}
