<?php

namespace Database\Seeders;

use App\Models\Newsletter;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class NewsletterSeeder extends Seeder
{
    public function run(): void
    {
        $newsletters = [
            [
                'title' => 'vCISO-as-a-Service: Executive Cyber Leadership Without the Full-Time Cost',
                'slug' => 'vciso-as-a-service',
                'seo' => [
                    'meta_title' => 'vCISO-as-a-Service: Executive Cyber Leadership Without the Full-Time Cost',
                    'meta_description' => 'How IBN helped a global hospitality enterprise strengthen governance, improve risk visibility, and achieve compliance readiness across multiple properties.',
                    'canonical_url' => 'https://www.ibntech.com/newsletter/vciso-as-a-service/',
                ],
            ],
            [
                'title' => 'Securing Enterprise AI: Data Protection, Prompt Integrity, and Governance at Scale',
                'slug' => 'securing-enterprise-ai-data-protection-prompt-integrity-and-governance-at-scale',
                'seo' => [
                    'meta_title' => 'Securing Enterprise AI: Data Protection, Prompt Integrity, and Governance at Scale',
                    'meta_description' => 'As generative AI embeds itself into enterprise operations, the security model is shifting from static vulnerabilities to dynamic, behavior-driven risks. Traditional controls alone are no longer sufficient.',
                    'canonical_url' => 'https://www.ibntech.com/newsletter/securing-enterprise-ai-data-protection-prompt-integrity-and-governance-at-scale/',
                ],
            ],
            [
                'title' => 'Cloud Misconfiguration Insights: Why Secure Architectures Still Fail in AWS & Azure',
                'slug' => 'cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure',
                'seo' => [
                    'meta_title' => 'Cloud Misconfiguration Insights: Why Secure Architectures Still Fail in AWS & Azure',
                    'meta_description' => 'Cloud platforms provide robust, secure-by-design infrastructure. Yet most real-world incidents are not caused by platform weaknesses—but by misconfigurations in identity, storage, and network controls.',
                    'canonical_url' => 'https://www.ibntech.com/newsletter/cloud-misconfiguration-insights-why-secure-architectures-still-fail-in-aws-azure/',
                ],
            ],
        ];

        foreach ($newsletters as $newsletterData) {
            $newsletter = Newsletter::query()->updateOrCreate(
                ['slug' => $newsletterData['slug']],
                [
                    'title' => $newsletterData['title'],
                    'template' => $newsletterData['slug'],
                    'status' => 'published',
                ]
            );

            if (! empty($newsletterData['seo'])) {
                SeoMeta::query()->updateOrCreate(
                    [
                        'metable_type' => Newsletter::class,
                        'metable_id' => $newsletter->id,
                    ],
                    [
                        'meta_title' => $newsletterData['seo']['meta_title'],
                        'meta_description' => $newsletterData['seo']['meta_description'],
                        'og_title' => $newsletterData['seo']['meta_title'],
                        'og_description' => $newsletterData['seo']['meta_description'],
                        'canonical_url' => $newsletterData['seo']['canonical_url'] ?? null,
                    ]
                );
            }

            Cache::forget("newsletter:{$newsletter->slug}");
        }
    }
}
