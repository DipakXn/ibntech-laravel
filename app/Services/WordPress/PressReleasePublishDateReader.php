<?php

namespace App\Services\WordPress;

use Carbon\Carbon;
use SimpleXMLElement;

class PressReleasePublishDateReader
{
    /**
     * @return array{
     *     dates: array<string, Carbon>,
     *     permalinks: array<string, string>,
     *     duplicates: array<int, string>,
     *     invalid: array<int, array{permalink: string, date: string}>,
     *     extra: array<int, string>
     * }
     */
    public function mappings(string $path): array
    {
        if (! is_file($path)) {
            throw new \RuntimeException("Press release publish-date XML not found: {$path}");
        }

        $element = @simplexml_load_file($path, SimpleXMLElement::class, LIBXML_NOCDATA | LIBXML_NONET);

        if (! $element instanceof SimpleXMLElement) {
            throw new \RuntimeException("Unable to parse Press release publish-date XML: {$path}");
        }

        $dates = [];
        $permalinks = [];
        $duplicates = [];
        $invalid = [];

        foreach ($element->post as $post) {
            $permalink = trim(html_entity_decode((string) ($post->Permalink ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $rawDate = trim((string) ($post->Date ?? ''));
            $key = PressReleasePermalink::normalize($permalink);

            if ($key === '') {
                $invalid[] = ['permalink' => $permalink, 'date' => $rawDate];

                continue;
            }

            if (isset($dates[$key])) {
                $duplicates[] = $permalink;

                continue;
            }

            $parsed = $this->parseDate($rawDate);

            if ($parsed === null) {
                $invalid[] = ['permalink' => $permalink, 'date' => $rawDate];

                continue;
            }

            $dates[$key] = $parsed;
            $permalinks[$key] = $permalink;
        }

        return [
            'dates' => $dates,
            'permalinks' => $permalinks,
            'duplicates' => array_values(array_unique($duplicates)),
            'invalid' => $invalid,
            'extra' => [],
        ];
    }

    protected function parseDate(string $value): ?Carbon
    {
        if ($value === '') {
            return null;
        }

        try {
            return Carbon::parse($value)->startOfDay();
        } catch (\Throwable) {
            return null;
        }
    }
}
