<?php

namespace App\Support\Redirects;

class ImportedRouteRedirects
{
    /**
     * Redirects previously declared in routes/web.php.
     * Sources and destinations are stored without a trailing slash.
     *
     * @return list<array{source: string, target: string, status: int}>
     */
    public static function definitions(): array
    {
        $permanent = [
            ['/contact', '/contact-us'],
            ['/contact/contact-us', '/contact-us'],
            ['/white-paper-2', '/whitepapers/how-cfos-benefit-from-profitcents'],
            ['/white-paper-3', '/whitepapers/how-ibn-helping-cfos-by-combining-efforts-with-profitcents'],
            ['/case-studies', '/case-study'],
            ['/9-best-payroll-service-providers', '/blog/9-best-payroll-service-providers'],
            ['/case-studies-6', '/case-study'],
            ['/construction-accounting-trends-for-2024', '/blog/construction-accounting-trends-for-2024'],
            ['/blog/why-businesses-outsourcing-accounts-payable-and-receivable', '/blog/why-businesses-outsource-accounts-payable-and-receivable'],
            ['/construction-accounting-services', '/blog/construction-accounting-services'],
            ['/accounts-payable-analytics', '/blog/accounts-payable-analytics'],
            ['/casestudies', '/case-study'],
            ['/best-practices-of-vendor-management', '/blog/best-practices-of-vendor-management'],
            ['/blog/top-services-of-accounting-outsourcing-companies-for-business-growth', '/blog/top-accounting-outsourcing-services-for-business-growth'],
            ['/ebooks', '/ebook'],
            ['/articles', '/article'],
            ['/free-consultation-for-ar-service', '/free-consultation-for-ap-ar-management'],
            ['/accounts-payable-analytics-three-essential-focus-areas', '/blog/accounts-payable-analytics'],
            ['/construction-accounting-services-ensuring-the-financial-success-of-your-business', '/blog/construction-accounting-services'],
            ['/vendor-management-importance-best-practices-and-benefits', '/blog/best-practices-of-vendor-management'],
            ['/3-key-components-of-an-income-statement-revenue-expenses-net-income', '/blog/components-of-an-income-statement'],
            ['/p2p-automation-the-key-to-streamlining-procurement-and-payments', '/blog/p2p-process-automation'],
            ['/the-power-of-3-way-matching-in-ap-automation', '/blog/3-way-matching-in-ap-automation'],
            ['/accounts-payable-audits-a-comprehensive-guide-for-businesses', '/blog/accounts-payable-audit-guide'],
            ['/cpa-firm-growth-strategies-for-expansion', '/blog/cpa-firm-growth-strategies'],
            ['/data-migration', '/data-migration-services'],
            ['/blog/automation-accounts-payable-in-the-digital-landscape-of-2023', '/blog/automation-accounts-payable-in-the-digital-landscape'],
            ['/pressrelease/offshore-outsourcing-solutions-in-focus-as-70-us-companies-embrace-remote-work-ibn-technologies-leads-the-way', '/pressrelease/offshore-outsourcing-solutions-in-focus-as'],
            ['/13-accounting-principles-the-keys-to-bankruptcy-resolution', '/blog/13-accounting-principles-the-keys-to-bankruptcy-resolution'],
            ['/bookkeeping-accounting-trends-for-small-businesses', '/blog/bookkeeping-accounting-small-business'],
            ['/fund-accounting-services-hedge-funds', '/fund-accounting-services'],
            ['/bookkeeping-services-in-florida', '/bookkeeping-services-florida'],
            ['/blog/bookkeeping-accounting-trends-for-small-businesses', '/blog/bookkeeping-accounting-small-business'],
        ];

        $rows = [];

        foreach ($permanent as [$source, $target]) {
            $rows[] = [
                'source' => $source,
                'target' => $target,
                'status' => 301,
            ];
        }

        foreach ([
            '/payroll-processing-old',
            '/back-offices-services',
            '/accounting-finannce-cpa-firm-case-study-2',
        ] as $source) {
            $rows[] = [
                'source' => $source,
                'target' => '',
                'status' => 410,
            ];
        }

        return $rows;
    }
}
