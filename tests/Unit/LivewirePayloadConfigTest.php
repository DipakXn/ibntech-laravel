<?php

namespace Tests\Unit;

use Tests\TestCase;

class LivewirePayloadConfigTest extends TestCase
{
    public function test_it_allows_filament_builder_rich_editor_nesting(): void
    {
        $maxDepth = (int) config('livewire.payload.max_nesting_depth');

        $articleParagraphPath = 'data.content.684e5ca3-17b4-4668-89de-cd72e4b5fc67.data.content.content.6.content.0.content.0.content.0';
        $faqAnswerPath = 'data.content.684e5ca3-17b4-4668-89de-cd72e4b5fc67.data.items.0.answer.content.content.0.content.0.content.0.content.0';

        $this->assertGreaterThanOrEqual(50, $maxDepth);
        $this->assertLessThanOrEqual($maxDepth, count(explode('.', $articleParagraphPath)));
        $this->assertLessThanOrEqual($maxDepth, count(explode('.', $faqAnswerPath)));
    }
}
