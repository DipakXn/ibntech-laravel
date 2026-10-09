<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            [
                'title' => 'Information & Communication Technology',
                'slug' => 'information-and-communication-technology',
                'template' => 'information-and-communication-technology',
                'seo' => [
                    'meta_title' => 'ICT Outsourcing services - IBN Tech',
                    'meta_description' => 'Drive tech innovation with outsourced cloud services, cybersecurity, and specialized ICT finance and accounting solutions for global tech firms.',
                ],
            ],
            [
                'title' => 'Real Estate and Construction',
                'slug' => 'real-estate-and-construction',
                'template' => 'real-estate-and-construction',
                'seo' => [
                    'meta_title' => 'Power Your Real Estate & Construction Growth with Secure IT & Outsourcing',
                    'meta_description' => 'Protect sensitive data and streamline workflows with IBN Technology’s cloud migration, security, and outsourcing solutions for real estate & construction.',
                ],
            ],
            [
                'title' => 'Travel and Hospitality',
                'slug' => 'travel-and-hospitality',
                'template' => 'travel-and-hospitality',
                'seo' => [
                    'meta_title' => 'Travel and Hospitality Outsourcing services - IBN Tech',
                    'meta_description' => 'Enhance guest services with outsourced finance, accounting, and cloud infrastructure. Secure your hospitality data with our advanced cybersecurity.',
                ],
            ],
            [
                'title' => 'E-commerce and Retail',
                'slug' => 'ecommerce-and-retail',
                'template' => 'ecommerce-and-retail',
                'seo' => [
                    'meta_title' => 'E-commerce and Retail Outsourcing services - IBN Tech',
                    'meta_description' => 'Scale your retail business with outsourced finance and accounting. We provide expert inventory data management and scalable cloud infrastructure support.',
                ],
            ],
            [
                'title' => 'Legal Firm',
                'slug' => 'legal-firm',
                'template' => 'legal-firm',
                'seo' => [
                    'meta_title' => 'Legal Firm Outsourcing services - IBN Technologies',
                    'meta_description' => 'Comprehensive outsourcing for law firms. We provide secure legal accounting, cloud document management, and robust cybersecurity to protect firm data.',
                ],
            ],
            [
                'title' => 'Manufacturing',
                'slug' => 'manufacturing',
                'template' => 'manufacturing',
                'seo' => [
                    'meta_title' => 'Manufacturing Outsourcing services - IBN Technologies',
                    'meta_description' => 'Optimize manufacturing with outsourced finance, accounting, and cloud solutions. Streamline your supply chain operations and cybersecurity protocols.',
                ],
            ],
            [
                'title' => 'Chemical & Energy',
                'slug' => 'chemical-and-energy',
                'template' => 'chemical-and-energy',
                'seo' => [
                    'meta_title' => 'Chemical and Energy Outsourcing services - IBN Tech',
                    'meta_description' => 'Strategic outsourcing for the energy sector. We manage complex finance and accounting, cloud data environments, and industrial cybersecurity.',
                ],
            ],
            [
                'title' => 'Healthcare & Pharma',
                'slug' => 'healthcare-and-pharma',
                'template' => 'healthcare-and-pharma',
                'seo' => [
                    'meta_title' => 'Finance, Security & Compliance Solutions for Healthcare & Pharmaceuticals',
                    'meta_description' => 'Achieve operational excellence with secure, compliant, and cost-efficient solutions for healthcare and pharma sectors.',
                ],
            ],
            [
                'title' => 'BFSI',
                'slug' => 'bfsi',
                'template' => 'bfsi',
                'seo' => [
                    'meta_title' => 'BFSI Outsourcing services - IBN Technologies',
                    'meta_description' => 'Secure outsourced solutions for banking and insurance. We specialize in financial accounting, cloud migration, and high-level cybersecurity compliance.',
                ],
            ],
            [
                'title' => 'Logistics and Transportation',
                'slug' => 'logistics-and-transportation',
                'template' => 'logistics-and-transportation',
                'seo' => [
                    'meta_title' => 'Logistics and Transportation Outsourcing Services - IBN Tech',
                    'meta_description' => 'Streamline logistics with outsourced finance, accounting, and cloud tracking systems. Protect your supply chain with our dedicated cybersecurity services.',
                ],
            ],
        ];

        foreach ($industries as $industryData) {
            $industry = Industry::query()->updateOrCreate(
                ['slug' => $industryData['slug']],
                [
                    'title' => $industryData['title'],
                    'template' => $industryData['template'],
                    'status' => 'published',
                ]
            );

            if (! empty($industryData['seo'])) {
                SeoMeta::query()->updateOrCreate(
                    [
                        'metable_type' => Industry::class,
                        'metable_id' => $industry->id,
                    ],
                    [
                        'meta_title' => $industryData['seo']['meta_title'],
                        'meta_description' => $industryData['seo']['meta_description'],
                        'og_title' => $industryData['seo']['meta_title'],
                        'og_description' => $industryData['seo']['meta_description'],
                    ]
                );
            }

            Cache::forget("industry:{$industryData['slug']}");
        }
    }
}
