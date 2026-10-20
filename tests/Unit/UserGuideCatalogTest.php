<?php

namespace Tests\Unit;

use App\Support\UserGuide\UserGuideCatalog;
use App\Support\UserGuide\UserGuideTopic;
use RuntimeException;
use Tests\TestCase;

class UserGuideCatalogTest extends TestCase
{
    public function test_the_project_guide_loads_every_group_and_renders_internal_links(): void
    {
        $catalog = app(UserGuideCatalog::class);
        $topics = $catalog->topics();

        $this->assertGreaterThanOrEqual(20, count($topics));
        $this->assertSame(UserGuideCatalog::GROUPS, array_values(array_unique(array_map(
            fn (UserGuideTopic $topic): string => $topic->group,
            $topics,
        ))));

        $rendered = $catalog->render($catalog->find('control-panel'));

        $this->assertStringContainsString('IBNTECH Control', $rendered->html);
        $this->assertStringContainsString('href="/admin/user-guide?topic=roles-and-access"', $rendered->html);
        $this->assertNotEmpty($rendered->headings);

        foreach ($topics as $topic) {
            $document = $catalog->render($topic);
            $this->assertNotSame('', trim(strip_tags($document->html)));
        }
    }

    public function test_search_matches_every_term_across_title_and_body(): void
    {
        $catalog = app(UserGuideCatalog::class);

        $matches = $catalog->search('QUEUE_MONITOR_MAX');
        $slugs = array_map(fn (UserGuideTopic $topic): string => $topic->slug, $matches);

        $this->assertEqualsCanonicalizing([
            'environment-reference',
            'queues-logs-and-maintenance',
        ], $slugs);

        $this->assertSame([], $catalog->search('queue not-a-real-token'));
        $this->assertCount(count($catalog->topics()), $catalog->search('   '));
    }

    public function test_html_in_topic_bodies_is_stripped_and_broken_links_fail(): void
    {
        $directory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-user-guide-'.bin2hex(random_bytes(4));
        mkdir($directory);

        try {
            file_put_contents($directory.DIRECTORY_SEPARATOR.'01-safe-topic.md', <<<'MD'
---
title: Safe topic
group: Getting started
summary: A fixture topic.
sort: 10
---

Hello <script>alert("x")</script> world.

[Itself](topic:safe-topic)
MD);
            file_put_contents($directory.DIRECTORY_SEPARATOR.'02-broken-link.md', <<<'MD'
---
title: Broken link
group: Getting started
summary: A fixture topic with a bad link.
sort: 20
---

[Missing](topic:missing-topic)
MD);

            $catalog = new UserGuideCatalog($directory);
            $html = $catalog->render($catalog->find('safe-topic'))->html;

            $this->assertStringContainsString('Hello', $html);
            $this->assertStringContainsString('world', $html);
            $this->assertStringNotContainsString('<script', $html);
            $this->assertStringContainsString('href="/admin/user-guide?topic=safe-topic"', $html);

            try {
                $catalog->render($catalog->find('broken-link'));
                $this->fail('A topic link to an unknown slug should fail.');
            } catch (RuntimeException $exception) {
                $this->assertStringContainsString('missing-topic', $exception->getMessage());
            }
        } finally {
            foreach (glob($directory.DIRECTORY_SEPARATOR.'*') ?: [] as $file) {
                unlink($file);
            }

            rmdir($directory);
        }
    }

    public function test_invalid_filenames_are_rejected(): void
    {
        $directory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'ibn-user-guide-'.bin2hex(random_bytes(4));
        mkdir($directory);
        file_put_contents($directory.DIRECTORY_SEPARATOR.'Notes.md', <<<'MD'
---
title: Notes
group: Getting started
summary: Bad filename.
sort: 10
---

Body
MD);

        try {
            (new UserGuideCatalog($directory))->topics();
            $this->fail('An invalid user guide filename should be rejected.');
        } catch (RuntimeException $exception) {
            $this->assertStringContainsString('01-topic-slug.md', $exception->getMessage());
        } finally {
            unlink($directory.DIRECTORY_SEPARATOR.'Notes.md');
            rmdir($directory);
        }
    }
}
