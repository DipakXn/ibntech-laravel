<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        $landingPages = [
            [
                'title' => 'VAPT Audit Services',
                'slug' => 'vapt-audit-services',
                'thank_you_slug' => 'vapt-audit-services-thank-you',
                'seo' => [
                    'meta_title' => 'VAPT Audit and Vulnerability Assessment | Expert VAPT Testing Services',
                    'meta_description' => 'IBN Tech offers expert VAPT Security Testing Services with over 26 years of cybersecurity experience. We conduct both manual and automated penetration testing to safeguard data, ensure compliance, and streamline your security strategy.',
                    'meta_keywords' => 'VAPT, VAPT audit services, vulnerability assessment, penetration testing, VAPT services India',
                ],
            ],
            [
                'title' => 'Cloud Consulting Services',
                'slug' => 'cloud-consulting-services',
                'thank_you_slug' => 'cloud-consulting-services-thank-you',
                'seo' => [
                    'meta_title' => 'Cloud Consulting Services',
                    'meta_description' => 'With 27+ years of industry expertise, we excel in delivering comprehensive Cloud Consulting, Multi Cloud solutions, and Private Cloud solutions. Our services encompass Cloud Management Services, Azure Consulting Services, and Azure Expert Managed Services Provider capabilities.',
                    'meta_keywords' => 'cloud consulting services, Azure consulting, AWS managed services, hybrid cloud, private cloud, cloud management services, cloud security',
                ],
            ],
            [
                'title' => 'Construction Engineering Services',
                'slug' => 'construction-engineering-services',
                'thank_you_slug' => null,
                'seo' => [
                    'meta_title' => 'Construction Engineering Services - IBN Technologies',
                    'meta_description' => "Whether you're managing multiple infrastructure projects, preparing competitive bids, or expanding your design team, IBN Technologies provides experienced engineers who work exclusively for your business.",
                    'meta_keywords' => 'construction engineering services, remote civil engineering staffing, CAD drafting, estimation and takeoffs, bid management, AutoCAD, Civil 3D, Revit',
                    'og_image_alt' => 'construction-lp-hero',
                ],
            ],
            [
                'title' => 'Cyber Security Services India',
                'slug' => 'cyber-security-services-india',
                'thank_you_slug' => 'cyber-security-services-india-thank-you',
                'seo' => [
                    'meta_title' => 'Cyber Security Services India - IBN Technologies',
                    'meta_description' => "Strengthen your security posture with IBN Technologies' end-to-end cybersecurity services. We help organizations identify vulnerabilities, achieve compliance, and protect critical business assets through Managed SOC, VAPT, SOC 2 Type II, SIEM, and vCISO services.",
                    'meta_keywords' => 'cyber security services India, managed SOC, VAPT, SOC 2 Type II, SIEM, vCISO, cybersecurity services',
                    'og_image_alt' => 'Cyber Security Services India',
                ],
            ],
            [
                'title' => 'Cybersecurity Services',
                'slug' => 'cybersecurity-services',
                'thank_you_slug' => 'cybersecurity-thank-you',
                'seo' => [
                    'meta_title' => 'Cybersecurity Services',
                    'meta_description' => 'Outsource your security and IT operations with our expert services: vCISO, Red Team Testing, mSOC, VAPT Services, ITSM, SIEM Services & more. Benefit from 24/7 threat monitoring, & optimised IT service management to keep your infrastructure safe & efficient.',
                    'meta_keywords' => 'cybersecurity services, vCISO, Red Team Testing, mSOC, VAPT, SIEM, managed SOC, penetration testing, SSO, MFA, IAM, XDR',
                    'og_image_alt' => 'Comprehensive Cybersecurity management',
                ],
            ],
            [
                'title' => 'Managed SOC Services',
                'slug' => 'managed-soc-services',
                'thank_you_slug' => 'cybersecurity-thank-you',
                'seo' => [
                    'meta_title' => 'Managed SOC Services - IBN Technologies',
                    'meta_description' => 'Reduce cyber risk and save up to 90% with IBN’s SOC-as-a-Service – Delivered by certified experts using Microsoft Sentinel, IBM QRadar, Splunk & Seceon.',
                    'meta_keywords' => 'Managed SOC Services, SOC as a Service, 24x7 SOC, Microsoft Sentinel, IBM QRadar, Splunk, Seceon, SOC 2 Type II',
                    'og_image_alt' => 'Managed SOC Services',
                ],
            ],
            [
                'title' => 'Office 365 Migration Consulting',
                'slug' => 'office-365-migration-consulting',
                'thank_you_slug' => 'office-365-migration-consulting-thank-you',
                'seo' => [
                    'meta_title' => 'Office 365 Migration Consulting - IBN Technologies',
                    'meta_description' => 'Transform your business with leading Office 365 migration consultants. Move to the cloud seamlessly with no data loss during the migration.',
                    'meta_keywords' => 'Office 365 Migration Consulting, Office 365 migration, Office 365 consultants, hybrid Exchange migration, ADFS for Office 365, Office 365 licensing',
                ],
            ],
            [
                'title' => 'SOC Calculator',
                'slug' => 'soc-calculator',
                'thank_you_slug' => null,
                'seo' => [
                    'meta_title' => 'SOC Calculator - IBN Technologies',
                    'meta_description' => 'Compare in-house SOC expenses with IBN Technologies managed SOC pricing. Select your user count to see estimated annual cost, total savings, and savings percentage.',
                    'meta_keywords' => 'SOC Calculator, in-house SOC cost, managed SOC, SOC as a Service, SOC savings calculator',
                ],
            ],
            [
                'title' => 'VAPT Audit Services Thank You',
                'slug' => 'vapt-audit-services-thank-you',
                'thank_you_slug' => null,
            ],
            [
                'title' => 'Cloud Consulting Services Thank You',
                'slug' => 'cloud-consulting-services-thank-you',
                'thank_you_slug' => null,
            ],
            [
                'title' => 'Cyber Security Services India Thank You',
                'slug' => 'cyber-security-services-india-thank-you',
                'thank_you_slug' => null,
            ],
            [
                'title' => 'Cybersecurity Thank You',
                'slug' => 'cybersecurity-thank-you',
                'thank_you_slug' => null,
            ],
            [
                'title' => 'Office 365 Migration Consulting Thank You',
                'slug' => 'office-365-migration-consulting-thank-you',
                'thank_you_slug' => null,
            ],
            [
                'title' => 'Thank You',
                'slug' => 'thank-you',
                'thank_you_slug' => null,
            ],
        ];

        foreach ($landingPages as $landingPageData) {
            $landingPage = LandingPage::query()->updateOrCreate(
                ['slug' => $landingPageData['slug']],
                [
                    'title' => $landingPageData['title'],
                    'template' => $landingPageData['slug'],
                    'thank_you_slug' => $landingPageData['thank_you_slug'],
                    'status' => 'published',
                ]
            );

            if (! empty($landingPageData['seo'])) {
                SeoMeta::query()->updateOrCreate(
                    [
                        'metable_type' => LandingPage::class,
                        'metable_id' => $landingPage->id,
                    ],
                    [
                        'meta_title' => $landingPageData['seo']['meta_title'],
                        'meta_description' => $landingPageData['seo']['meta_description'],
                        'meta_keywords' => $landingPageData['seo']['meta_keywords'] ?? null,
                        'og_title' => $landingPageData['seo']['meta_title'],
                        'og_description' => $landingPageData['seo']['meta_description'],
                        'og_image_alt' => $landingPageData['seo']['og_image_alt'] ?? null,
                    ]
                );
            }

            Cache::forget("landing-page:{$landingPage->slug}");
        }
    }
}
