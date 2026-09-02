<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class WordPressPagesSeeder extends Seeder
{
    /**
     * Stage 1 infrastructure pages from WordPress export (published only).
     * Skips slugs that already exist.
     */
    public function run(): void
    {
        $pages = [
            0 => [
                'title' => 'IT Services',
                'slug' => 'it-services',
                'template' => 'it-services',
                'status' => 'published',
            ],
            1 => [
                'title' => 'CFO Services',
                'slug' => 'cfo-services',
                'template' => 'cfo-services',
                'status' => 'published',
            ],
            2 => [
                'title' => 'Back And Middle Office Services',
                'slug' => 'back-and-middle-office-services',
                'template' => 'back-and-middle-office-services',
                'status' => 'published',
            ],
            3 => [
                'title' => 'Family Office Services',
                'slug' => 'family-office-services',
                'template' => 'family-office-services',
                'status' => 'published',
            ],
            4 => [
                'title' => 'Hedgefund Administration',
                'slug' => 'hedgefund-administration',
                'template' => 'hedgefund-administration',
                'status' => 'published',
            ],
            5 => [
                'title' => 'Fund Investor Reporting',
                'slug' => 'fund-investor-reporting',
                'template' => 'fund-investor-reporting',
                'status' => 'published',
            ],
            6 => [
                'title' => 'Treasury Management Services Outsourcing',
                'slug' => 'treasury-management-services-outsourcing',
                'template' => 'treasury-management-services-outsourcing',
                'status' => 'published',
            ],
            7 => [
                'title' => 'Travel Bpo Outsourcing Services',
                'slug' => 'travel-bpo-outsourcing-services',
                'template' => 'travel-bpo-outsourcing-services',
                'status' => 'published',
            ],
            8 => [
                'title' => 'Retail',
                'slug' => 'retail',
                'template' => 'retail',
                'status' => 'published',
            ],
            9 => [
                'title' => 'Hospitality',
                'slug' => 'hospitality',
                'template' => 'hospitality',
                'status' => 'published',
            ],
            10 => [
                'title' => 'Recruitment Firms',
                'slug' => 'recruitment-firms',
                'template' => 'recruitment-firms',
                'status' => 'published',
            ],
            11 => [
                'title' => 'Transport and Logistics Services',
                'slug' => 'transport-and-logistics',
                'template' => 'transport-and-logistics',
                'status' => 'published',
            ],
            12 => [
                'title' => 'Multi Location Business',
                'slug' => 'multi-location-business',
                'template' => 'multi-location-business',
                'status' => 'published',
            ],
            13 => [
                'title' => 'Telecommunication Outsourcing Services',
                'slug' => 'telecommunication-outsourcing-services',
                'template' => 'telecommunication-outsourcing-services',
                'status' => 'published',
            ],
            14 => [
                'title' => 'Mortgage',
                'slug' => 'mortgage',
                'template' => 'mortgage',
                'status' => 'published',
            ],
            15 => [
                'title' => 'Infrastructure',
                'slug' => 'infrastructure',
                'template' => 'infrastructure',
                'status' => 'published',
            ],
            16 => [
                'title' => 'Transition Methodology',
                'slug' => 'bpotransition-methodology',
                'template' => 'bpotransition-methodology',
                'status' => 'published',
            ],
            17 => [
                'title' => 'Press release',
                'slug' => 'pressrelease',
                'template' => 'pressrelease',
                'status' => 'published',
            ],
            18 => [
                'title' => 'Testimonials',
                'slug' => 'testimonials',
                'template' => 'testimonials',
                'status' => 'published',
            ],
            19 => [
                'title' => 'White Papers',
                'slug' => 'whitepapers',
                'template' => 'whitepapers',
                'status' => 'published',
            ],
            20 => [
                'title' => 'Business Partner',
                'slug' => 'business-partner',
                'template' => 'business-partner',
                'status' => 'published',
            ],
            21 => [
                'title' => 'Microsoft Certified Partners',
                'slug' => 'microsoft-certified-partners',
                'template' => 'microsoft-certified-partners',
                'status' => 'published',
            ],
            22 => [
                'title' => 'Faq',
                'slug' => 'faq',
                'template' => 'faq',
                'status' => 'published',
            ],
            23 => [
                'title' => 'Technology Solutions',
                'slug' => 'technology-solutions',
                'template' => 'technology-solutions',
                'status' => 'published',
            ],
            24 => [
                'title' => 'Tech Support Services',
                'slug' => 'tech-support-services',
                'template' => 'tech-support-services',
                'status' => 'published',
            ],
            25 => [
                'title' => 'Microsoft Dynamics Nav',
                'slug' => 'microsoft-dynamics-nav',
                'template' => 'microsoft-dynamics-nav',
                'status' => 'published',
            ],
            26 => [
                'title' => 'Finance Management',
                'slug' => 'finance-management',
                'template' => 'finance-management',
                'status' => 'published',
            ],
            27 => [
                'title' => 'Project Management',
                'slug' => 'project-management',
                'template' => 'project-management',
                'status' => 'published',
            ],
            28 => [
                'title' => 'Sales Marketing And Service Management',
                'slug' => 'sales-marketing-and-service-management',
                'template' => 'sales-marketing-and-service-management',
                'status' => 'published',
            ],
            29 => [
                'title' => 'Business Intelligence And Reporting',
                'slug' => 'business-intelligence-and-reporting',
                'template' => 'business-intelligence-and-reporting',
                'status' => 'published',
            ],
            30 => [
                'title' => 'Supply Chain Management Manufacturing',
                'slug' => 'supply-chain-management-manufacturing',
                'template' => 'supply-chain-management-manufacturing',
                'status' => 'published',
            ],
            31 => [
                'title' => 'Human Resources Management Hrm',
                'slug' => 'human-resources-management-hrm',
                'template' => 'human-resources-management-hrm',
                'status' => 'published',
            ],
            32 => [
                'title' => 'Accounting System And Integration',
                'slug' => 'accounting-system-and-integration',
                'template' => 'accounting-system-and-integration',
                'status' => 'published',
            ],
            33 => [
                'title' => 'Current job opening',
                'slug' => 'current-job-opening',
                'template' => 'current-job-opening',
                'status' => 'published',
            ],
            34 => [
                'title' => 'Kpo Services',
                'slug' => 'kpo-services',
                'template' => 'kpo-services',
                'status' => 'published',
            ],
            35 => [
                'title' => 'Bpo Services',
                'slug' => 'bpo-services',
                'template' => 'bpo-services',
                'status' => 'published',
            ],
            36 => [
                'title' => 'White Paper 2',
                'slug' => 'white-paper-2',
                'template' => 'white-paper-2',
                'status' => 'published',
            ],
            37 => [
                'title' => 'White Paper 3',
                'slug' => 'white-paper-3',
                'template' => 'white-paper-3',
                'status' => 'published',
            ],
            38 => [
                'title' => 'Bookkeeping Services Hartford',
                'slug' => 'bookkeeping-services-hartford',
                'template' => 'bookkeeping-services-hartford',
                'status' => 'published',
            ],
            39 => [
                'title' => 'Bookkeeping Services Los Angeles',
                'slug' => 'bookkeeping-services-los-angeles',
                'template' => 'bookkeeping-services-los-angeles',
                'status' => 'published',
            ],
            40 => [
                'title' => 'Bookkeeping Services San Diego',
                'slug' => 'bookkeeping-services-san-diego',
                'template' => 'bookkeeping-services-san-diego',
                'status' => 'published',
            ],
            41 => [
                'title' => 'Bookkeeping Services San Jose',
                'slug' => 'bookkeeping-services-san-jose',
                'template' => 'bookkeeping-services-san-jose',
                'status' => 'published',
            ],
            42 => [
                'title' => 'Bookkeeping Services Austin',
                'slug' => 'bookkeeping-services-austin',
                'template' => 'bookkeeping-services-austin',
                'status' => 'published',
            ],
            43 => [
                'title' => 'Bookkeeping Services San Francisco',
                'slug' => 'bookkeeping-services-san-francisco',
                'template' => 'bookkeeping-services-san-francisco',
                'status' => 'published',
            ],
            44 => [
                'title' => 'Healthcare Bookkeeping Services',
                'slug' => 'healthcare-bookkeeping-services',
                'template' => 'healthcare-bookkeeping-services',
                'status' => 'published',
            ],
            45 => [
                'title' => 'Virtual Cfo Services',
                'slug' => 'virtual-cfo-services',
                'template' => 'virtual-cfo-services',
                'status' => 'published',
            ],
            46 => [
                'title' => 'Back Offices Services',
                'slug' => 'back-offices-services',
                'template' => 'back-offices-services',
                'status' => 'published',
            ],
            47 => [
                'title' => 'Fund Accounting Services',
                'slug' => 'fund-accounting-services',
                'template' => 'fund-accounting-services',
                'status' => 'published',
            ],
            48 => [
                'title' => 'Privacy Policy - IBN Technologies Ltd',
                'slug' => 'privacy-policy',
                'template' => 'privacy-policy',
                'status' => 'published',
            ],
            49 => [
                'title' => 'General Terms & Conditions',
                'slug' => 'terms-of-use',
                'template' => 'terms-of-use',
                'status' => 'published',
            ],
            50 => [
                'title' => 'Data Processing',
                'slug' => 'data-processing',
                'template' => 'data-processing',
                'status' => 'published',
            ],
            51 => [
                'title' => 'Bookkeeping For Us',
                'slug' => 'bookkeeping-for-us',
                'template' => 'bookkeeping-for-us',
                'status' => 'published',
            ],
            52 => [
                'title' => 'Bookkeeping Service Restaurants',
                'slug' => 'bookkeeping-service-restaurants',
                'template' => 'bookkeeping-service-restaurants',
                'status' => 'published',
            ],
            53 => [
                'title' => 'Bookkeeping For Large Organisation',
                'slug' => 'bookkeeping-for-large-organisation',
                'template' => 'bookkeeping-for-large-organisation',
                'status' => 'published',
            ],
            54 => [
                'title' => 'Bookkeeping For Small Business',
                'slug' => 'bookkeeping-for-small-business',
                'template' => 'bookkeeping-for-small-business',
                'status' => 'published',
            ],
            55 => [
                'title' => 'outsourced-bookkeeping-services-USA',
                'slug' => 'outsourced-bookkeeping-services-usa',
                'template' => 'outsourced-bookkeeping-services-usa',
                'status' => 'published',
            ],
            56 => [
                'title' => 'Bookkeeping Services For Small Businesses',
                'slug' => 'bookkeeping-services-for-small-businesses',
                'template' => 'bookkeeping-services-for-small-businesses',
                'status' => 'published',
            ],
            57 => [
                'title' => 'Bookkeeping Services for Restaurants',
                'slug' => 'restaurants-bookkeeping-services',
                'template' => 'restaurants-bookkeeping-services',
                'status' => 'published',
            ],
            58 => [
                'title' => 'Bookkeeping Services for Retail Stores',
                'slug' => 'bookkeeping-services-for-retail-stores',
                'template' => 'bookkeeping-services-for-retail-stores',
                'status' => 'published',
            ],
            59 => [
                'title' => 'Assistance To Cfo Services',
                'slug' => 'assistant-to-cfo-services',
                'template' => 'assistant-to-cfo-services',
                'status' => 'published',
            ],
            60 => [
                'title' => 'Bookkeeping for Marketing and Advertising Companies',
                'slug' => 'marketing-and-advertising-bookkeeping-services',
                'template' => 'marketing-and-advertising-bookkeeping-services',
                'status' => 'published',
            ],
            61 => [
                'title' => 'Bookkeeping for Food and Beverage Companies',
                'slug' => 'food-and-beverage-bookkeeping-services',
                'template' => 'food-and-beverage-bookkeeping-services',
                'status' => 'published',
            ],
            62 => [
                'title' => 'Bookkeeping for Legal Services',
                'slug' => 'legal-bookkeeping-services',
                'template' => 'legal-bookkeeping-services',
                'status' => 'published',
            ],
            63 => [
                'title' => 'Bookkeeping for Finance Businesses',
                'slug' => 'finance-businesses-bookkeeping-service',
                'template' => 'finance-businesses-bookkeeping-service',
                'status' => 'published',
            ],
            64 => [
                'title' => 'Bookkeeping for IT Businesses',
                'slug' => 'it-business-bookkeeping-service',
                'template' => 'it-business-bookkeeping-service',
                'status' => 'published',
            ],
            65 => [
                'title' => 'Data Migration',
                'slug' => 'data-migration-services',
                'template' => 'data-migration-services',
                'status' => 'published',
            ],
            66 => [
                'title' => 'Database Consulting',
                'slug' => 'database-consulting',
                'template' => 'database-consulting',
                'status' => 'published',
            ],
            67 => [
                'title' => 'Database Monitoring and Support',
                'slug' => 'database-monitoring-and-support',
                'template' => 'database-monitoring-and-support',
                'status' => 'published',
            ],
            68 => [
                'title' => 'Database Performance Tuning',
                'slug' => 'database-performance-tuning',
                'template' => 'database-performance-tuning',
                'status' => 'published',
            ],
            69 => [
                'title' => 'API Testing',
                'slug' => 'api-testing',
                'template' => 'api-testing',
                'status' => 'published',
            ],
            70 => [
                'title' => 'Quote to Cash',
                'slug' => 'quote-to-cash',
                'template' => 'quote-to-cash',
                'status' => 'published',
            ],
            71 => [
                'title' => 'Cyber Security Testing',
                'slug' => 'cyber-security-testing',
                'template' => 'cyber-security-testing',
                'status' => 'published',
            ],
            72 => [
                'title' => 'Functional Testing',
                'slug' => 'functional-testing',
                'template' => 'functional-testing',
                'status' => 'published',
            ],
            73 => [
                'title' => 'Order to Cash',
                'slug' => 'order-to-cash',
                'template' => 'order-to-cash',
                'status' => 'published',
            ],
            74 => [
                'title' => 'Thank You Brochures Download',
                'slug' => 'thank-you-brochures-download',
                'template' => 'thank-you-brochures-download',
                'status' => 'published',
            ],
            75 => [
                'title' => 'Record To Report',
                'slug' => 'record-to-report',
                'template' => 'record-to-report',
                'status' => 'published',
            ],
            76 => [
                'title' => 'Virtual DBA Services',
                'slug' => 'virtual-dba-services',
                'template' => 'virtual-dba-services',
                'status' => 'published',
            ],
            77 => [
                'title' => 'IT Staff Sourcing',
                'slug' => 'it-staff-sourcing',
                'template' => 'it-staff-sourcing',
                'status' => 'published',
            ],
            78 => [
                'title' => 'Mobile App Testing',
                'slug' => 'mobile-app-testing',
                'template' => 'mobile-app-testing',
                'status' => 'published',
            ],
            79 => [
                'title' => 'Performance Testing',
                'slug' => 'performance-testing',
                'template' => 'performance-testing',
                'status' => 'published',
            ],
            80 => [
                'title' => 'Security Testing',
                'slug' => 'security-testing',
                'template' => 'security-testing',
                'status' => 'published',
            ],
            81 => [
                'title' => 'SEO Testing',
                'slug' => 'seo-testing',
                'template' => 'seo-testing',
                'status' => 'published',
            ],
            82 => [
                'title' => 'Sharepoint',
                'slug' => 'sharepoint',
                'template' => 'sharepoint',
                'status' => 'published',
            ],
            83 => [
                'title' => 'Test Automation',
                'slug' => 'test-automation',
                'template' => 'test-automation',
                'status' => 'published',
            ],
            84 => [
                'title' => 'Record to Report CFO',
                'slug' => 'record-to-report-cfo',
                'template' => 'record-to-report-cfo',
                'status' => 'published',
            ],
            85 => [
                'title' => 'Reporting Analysis Planning',
                'slug' => 'reporting-analysis-planning',
                'template' => 'reporting-analysis-planning',
                'status' => 'published',
            ],
            86 => [
                'title' => 'Data Conversion',
                'slug' => 'data-conversion',
                'template' => 'data-conversion',
                'status' => 'published',
            ],
            87 => [
                'title' => 'Data Entry',
                'slug' => 'data-entry',
                'template' => 'data-entry',
                'status' => 'published',
            ],
            88 => [
                'title' => 'Record Management',
                'slug' => 'record-management',
                'template' => 'record-management',
                'status' => 'published',
            ],
            89 => [
                'title' => 'Thank You Free Trial',
                'slug' => 'thank-you-free-trial',
                'template' => 'thank-you-free-trial',
                'status' => 'published',
            ],
            90 => [
                'title' => 'Treasury Management',
                'slug' => 'treasury-management',
                'template' => 'treasury-management',
                'status' => 'published',
            ],
            91 => [
                'title' => 'Outsourcing',
                'slug' => 'outsourcing',
                'template' => 'outsourcing',
                'status' => 'published',
            ],
            92 => [
                'title' => 'Ebooks',
                'slug' => 'ebook',
                'template' => 'ebook',
                'status' => 'published',
            ],
            93 => [
                'title' => 'Intelligent Process Automation',
                'slug' => 'intelligent-process-automation',
                'template' => 'intelligent-process-automation',
                'status' => 'published',
            ],
            94 => [
                'title' => 'IBN Team',
                'slug' => 'ibn-team',
                'template' => 'ibn-team',
                'status' => 'published',
            ],
            95 => [
                'title' => 'Thanks You',
                'slug' => 'thank-you',
                'template' => 'thank-you',
                'status' => 'published',
            ],
            96 => [
                'title' => 'Hedge Fund Services',
                'slug' => 'hedge-fund-services',
                'template' => 'hedge-fund-services',
                'status' => 'published',
            ],
            97 => [
                'title' => 'CPA Outsourcing',
                'slug' => 'cpa-outsourcing',
                'template' => 'cpa-outsourcing',
                'status' => 'published',
            ],
            98 => [
                'title' => 'Payroll Processing old',
                'slug' => 'payroll-processing-old',
                'template' => 'payroll-processing-old',
                'status' => 'published',
            ],
            99 => [
                'title' => 'Bookkeeping Services Vermont',
                'slug' => 'bookkeeping-services-vermont',
                'template' => 'bookkeeping-services-vermont',
                'status' => 'published',
            ],
            100 => [
                'title' => 'Bookkeeping Services  Las Vegas',
                'slug' => 'bookkeeping-services-las-vegas',
                'template' => 'bookkeeping-services-las-vegas',
                'status' => 'published',
            ],
            101 => [
                'title' => 'Bookkeeping Services Chicago',
                'slug' => 'bookkeeping-services-chicago',
                'template' => 'bookkeeping-services-chicago',
                'status' => 'published',
            ],
            102 => [
                'title' => 'About IBN',
                'slug' => 'about-ibn',
                'template' => 'about-ibn',
                'status' => 'published',
            ],
            103 => [
                'title' => 'Bookkeeping Services Phoenix',
                'slug' => 'bookkeeping-services-phoenix',
                'template' => 'bookkeeping-services-phoenix',
                'status' => 'published',
            ],
            104 => [
                'title' => 'Bookkeeping Services UK',
                'slug' => 'bookeeping-for-uk',
                'template' => 'bookeeping-for-uk',
                'status' => 'published',
            ],
            105 => [
                'title' => 'Ecommerce Bookkeeping Services',
                'slug' => 'ecommerce-bookkeeping-services',
                'template' => 'ecommerce-bookkeeping-services',
                'status' => 'published',
            ],
            106 => [
                'title' => 'Bookkeeping for Real Estate and Construction Businesses',
                'slug' => 'real-estate-construction-bookkeeping-services',
                'template' => 'real-estate-construction-bookkeeping-services',
                'status' => 'published',
            ],
            107 => [
                'title' => 'Invoice Process Automation',
                'slug' => 'invoice-process-automation',
                'template' => 'invoice-process-automation',
                'status' => 'published',
            ],
            108 => [
                'title' => 'Manufacturing Accounting and Bookkeeping Services',
                'slug' => 'manufacturing-accounting-and-bookkeeping-services',
                'template' => 'manufacturing-accounting-and-bookkeeping-services',
                'status' => 'published',
            ],
            109 => [
                'title' => 'Sales Order Processing',
                'slug' => 'sales-order-processing',
                'template' => 'sales-order-processing',
                'status' => 'published',
            ],
            110 => [
                'title' => 'Medical Claim Automation',
                'slug' => 'medical-claim-automation',
                'template' => 'medical-claim-automation',
                'status' => 'published',
            ],
            111 => [
                'title' => 'Electronic Funds Transfer',
                'slug' => 'electronic-funds-transfer',
                'template' => 'electronic-funds-transfer',
                'status' => 'published',
            ],
            112 => [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'template' => 'contact-us',
                'status' => 'published',
            ],
            113 => [
                'title' => 'Hedge Fund Accounting',
                'slug' => 'hedge-fund-accounting',
                'template' => 'hedge-fund-accounting',
                'status' => 'published',
            ],
            114 => [
                'title' => 'Empowering Business Processes with AI, ML, and RPA-Driven Cloud Automation',
                'slug' => 'empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation',
                'template' => 'empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation',
                'status' => 'published',
            ],
            115 => [
                'title' => 'Outsource Construction Engineering Services',
                'slug' => 'real-estate-and-construction-engineering-services',
                'template' => 'real-estate-and-construction-engineering-services',
                'status' => 'published',
            ],
            116 => [
                'title' => 'Bookkeeping Services  California',
                'slug' => 'bookkeeping-services-california',
                'template' => 'bookkeeping-services-california',
                'status' => 'published',
            ],
            117 => [
                'title' => 'Bookkeeping Services New York',
                'slug' => 'bookkeeping-services-new-york',
                'template' => 'bookkeeping-services-new-york',
                'status' => 'published',
            ],
            118 => [
                'title' => 'Thank You Download',
                'slug' => 'thank-you-download',
                'template' => 'thank-you-download',
                'status' => 'published',
            ],
            119 => [
                'title' => 'Bookkeeping Services Florida',
                'slug' => 'bookkeeping-services-florida',
                'template' => 'bookkeeping-services-florida',
                'status' => 'published',
            ],
            120 => [
                'title' => 'Boost your business with Accounting offers',
                'slug' => 'boost-your-business-with-accounting-offers',
                'template' => 'boost-your-business-with-accounting-offers',
                'status' => 'published',
            ],
            121 => [
                'title' => 'Bookkeeping Services Usa',
                'slug' => 'bookkeeping-services-usa',
                'template' => 'bookkeeping-services-usa',
                'status' => 'published',
            ],
            122 => [
                'title' => 'Hospitality Bookkeeping And Accounting Services',
                'slug' => 'hospitality-bookkeeping-and-accounting-services',
                'template' => 'hospitality-bookkeeping-and-accounting-services',
                'status' => 'published',
            ],
            123 => [
                'title' => 'Travel Bookkeeping Service',
                'slug' => 'travel-bookkeeping-service',
                'template' => 'travel-bookkeeping-service',
                'status' => 'published',
            ],
            124 => [
                'title' => 'Salesforce',
                'slug' => 'salesforce',
                'template' => 'salesforce',
                'status' => 'published',
            ],
            125 => [
                'title' => 'Bookkeeping Services Texas',
                'slug' => 'bookkeeping-services-texas',
                'template' => 'bookkeeping-services-texas',
                'status' => 'published',
            ],
            126 => [
                'title' => 'Article',
                'slug' => 'article',
                'template' => 'article',
                'status' => 'published',
            ],
            127 => [
                'title' => 'Robotic Process Automation(RPA) Services',
                'slug' => 'robotics-process-automation',
                'template' => 'robotics-process-automation',
                'status' => 'published',
            ],
            128 => [
                'title' => 'Finance and Accounting Services',
                'slug' => 'finance-and-accounting-services',
                'template' => 'finance-and-accounting-services',
                'status' => 'published',
            ],
            129 => [
                'title' => 'USA & UK Tax Preparation Services',
                'slug' => 'us-uk-tax-preparation-services',
                'template' => 'us-uk-tax-preparation-services',
                'status' => 'published',
            ],
            130 => [
                'title' => 'Procure to pay solution',
                'slug' => 'procure-to-pay',
                'template' => 'procure-to-pay',
                'status' => 'published',
            ],
            131 => [
                'title' => 'Accounting Services for Small Business',
                'slug' => 'accounting-services-for-small-business',
                'template' => 'accounting-services-for-small-business',
                'status' => 'published',
            ],
            132 => [
                'title' => 'Pricing',
                'slug' => 'pricing',
                'template' => 'pricing',
                'status' => 'published',
            ],
            133 => [
                'title' => 'Free Consultation For Bookkeeping',
                'slug' => 'free-consultation-for-bookkeeping',
                'template' => 'free-consultation-for-bookkeeping',
                'status' => 'published',
            ],
            134 => [
                'title' => 'Free Consultation For Payroll Service',
                'slug' => 'free-consultation-for-payroll-service',
                'template' => 'free-consultation-for-payroll-service',
                'status' => 'published',
            ],
            135 => [
                'title' => 'Free Consultation For Tax Return Preparation',
                'slug' => 'free-consultation-for-tax-return',
                'template' => 'free-consultation-for-tax-return',
                'status' => 'published',
            ],
            136 => [
                'title' => 'Free Consultation For AP AR Management',
                'slug' => 'free-consultation-for-ap-ar-management',
                'template' => 'free-consultation-for-ap-ar-management',
                'status' => 'published',
            ],
            137 => [
                'title' => 'Free Consultation For IPA',
                'slug' => 'free-consultation-for-ipa',
                'template' => 'free-consultation-for-ipa',
                'status' => 'published',
            ],
            138 => [
                'title' => 'Thanks You For Bookkeeping',
                'slug' => 'thanks-you-for-bookkeeping',
                'template' => 'thanks-you-for-bookkeeping',
                'status' => 'published',
            ],
            139 => [
                'title' => 'Thanks You for payroll service',
                'slug' => 'thanks-you-for-payroll-service',
                'template' => 'thanks-you-for-payroll-service',
                'status' => 'published',
            ],
            140 => [
                'title' => 'Thanks You  For AP AR Management',
                'slug' => 'thanks-you-for-ap-ar-management',
                'template' => 'thanks-you-for-ap-ar-management',
                'status' => 'published',
            ],
            141 => [
                'title' => 'Thanks You For Tax Preparation',
                'slug' => 'thanks-you-for-tax-preparation',
                'template' => 'thanks-you-for-tax-preparation',
                'status' => 'published',
            ],
            142 => [
                'title' => 'Thanks You  For IPA',
                'slug' => 'thanks-you-for-ipa',
                'template' => 'thanks-you-for-ipa',
                'status' => 'published',
            ],
            143 => [
                'title' => 'Free Trial',
                'slug' => 'free-trial',
                'template' => 'free-trial',
                'status' => 'published',
            ],
            144 => [
                'title' => 'Thanks You  For Free Trail',
                'slug' => 'thanks-you-for-free-trail',
                'template' => 'thanks-you-for-free-trail',
                'status' => 'published',
            ],
            145 => [
                'title' => 'Free Consultation',
                'slug' => 'free-consultation',
                'template' => 'free-consultation',
                'status' => 'published',
            ],
            146 => [
                'title' => 'Bookkeeping Services',
                'slug' => 'bookkeeping-services',
                'template' => 'bookkeeping-services',
                'status' => 'published',
            ],
            147 => [
                'title' => 'Payroll Services',
                'slug' => 'payroll-processing',
                'template' => 'payroll-processing',
                'status' => 'published',
            ],
            148 => [
                'title' => 'Expert Bookkeeping to Fuel Your Business Growth Landing Page',
                'slug' => 'outsourced-bookkeeping',
                'template' => 'outsourced-bookkeeping',
                'status' => 'published',
            ],
            149 => [
                'title' => 'Accounts Payable and Receivable Automation',
                'slug' => 'ap-ar-automation',
                'template' => 'ap-ar-automation',
                'status' => 'published',
            ],
            150 => [
                'title' => 'Accounts Payable and Receivable Services Update page',
                'slug' => 'accounts-payable-and-accounts-receivable-services',
                'template' => 'accounts-payable-and-accounts-receivable-services',
                'status' => 'published',
            ],
            151 => [
                'title' => 'Free Consultation For Construction',
                'slug' => 'free-consultation-for-construction',
                'template' => 'free-consultation-for-construction',
                'status' => 'published',
            ],
            152 => [
                'title' => 'Thanks You  For Construction',
                'slug' => 'thank-you-for-construction-services-consultation',
                'template' => 'thank-you-for-construction-services-consultation',
                'status' => 'published',
            ],
            153 => [
                'title' => 'Tax Preparation Services USA',
                'slug' => 'tax-preparation-services-usa',
                'template' => 'tax-preparation-services-usa',
                'status' => 'published',
            ],
            154 => [
                'title' => 'Managed SIEM SOC Services',
                'slug' => 'managed-siem-soc-services',
                'template' => 'managed-siem-soc-services',
                'status' => 'published',
            ],
            155 => [
                'title' => 'vCISO Services',
                'slug' => 'vciso-services',
                'template' => 'vciso-services',
                'status' => 'published',
            ],
            156 => [
                'title' => 'Managed Detection Response Services',
                'slug' => 'managed-detection-response-services',
                'template' => 'managed-detection-response-services',
                'status' => 'published',
            ],
            157 => [
                'title' => 'Cybersecurity Audit Compliance Services',
                'slug' => 'cybersecurity-audit-compliance-services',
                'template' => 'cybersecurity-audit-compliance-services',
                'status' => 'published',
            ],
            158 => [
                'title' => 'Cybersecurity Maturity Assessment Services',
                'slug' => 'cybersecurity-maturity-assessment-services',
                'template' => 'cybersecurity-maturity-assessment-services',
                'status' => 'published',
            ],
            159 => [
                'title' => 'Microsoft Security Services',
                'slug' => 'microsoft-security-services',
                'template' => 'microsoft-security-services',
                'status' => 'published',
            ],
            160 => [
                'title' => 'DevSecOps Services',
                'slug' => 'devsecops-services',
                'template' => 'devsecops-services',
                'status' => 'published',
            ],
            161 => [
                'title' => 'Microsoft Office 365 Migration Support Services',
                'slug' => 'microsoft-office-365-migration-support-services',
                'template' => 'microsoft-office-365-migration-support-services',
                'status' => 'published',
            ],
            162 => [
                'title' => 'Business Continuity Disaster Recovery Services',
                'slug' => 'business-continuity-disaster-recovery-services',
                'template' => 'business-continuity-disaster-recovery-services',
                'status' => 'published',
            ],
            163 => [
                'title' => 'Cloud Managed Services',
                'slug' => 'cloud-managed-services',
                'template' => 'cloud-managed-services',
                'status' => 'published',
            ],
            164 => [
                'title' => 'Cloud Consulting And Migration Services',
                'slug' => 'cloud-consulting-and-migration-services',
                'template' => 'cloud-consulting-and-migration-services',
                'status' => 'published',
            ],
            165 => [
                'title' => 'Construction Takeoff Estimation Services',
                'slug' => 'construction-takeoff-estimation-services',
                'template' => 'construction-takeoff-estimation-services',
                'status' => 'published',
            ],
            166 => [
                'title' => 'Construction Documentation Services',
                'slug' => 'construction-documentation-services',
                'template' => 'construction-documentation-services',
                'status' => 'published',
            ],
            167 => [
                'title' => 'Civil Engineering Services',
                'slug' => 'civil-engineering-services',
                'template' => 'civil-engineering-services',
                'status' => 'published',
            ],
            168 => [
                'title' => 'Thanks You For Cybersecurity',
                'slug' => 'thanks-you-for-cybersecurity',
                'template' => 'thanks-you-for-cybersecurity',
                'status' => 'published',
            ],
            169 => [
                'title' => 'Thanks You For Cloud',
                'slug' => 'thanks-you-for-cloud',
                'template' => 'thanks-you-for-cloud',
                'status' => 'published',
            ],
            170 => [
                'title' => 'Free Consultation For Cybersecurity',
                'slug' => 'free-consultation-for-cybersecurity',
                'template' => 'free-consultation-for-cybersecurity',
                'status' => 'published',
            ],
            171 => [
                'title' => 'Free Consultation For Cloud',
                'slug' => 'free-consultation-for-cloud',
                'template' => 'free-consultation-for-cloud',
                'status' => 'published',
            ],
            172 => [
                'title' => 'Tax Preparation Services UK',
                'slug' => 'tax-preparation-services-uk',
                'template' => 'tax-preparation-services-uk',
                'status' => 'published',
            ],
            173 => [
                'title' => 'Cookies Policy',
                'slug' => 'cookies-policy',
                'template' => 'cookies-policy',
                'status' => 'published',
            ],
            174 => [
                'title' => 'AWS Cloud Services',
                'slug' => 'aws-cloud-services',
                'template' => 'aws-cloud-services',
                'status' => 'published',
            ],
            175 => [
                'title' => 'AWS Partner',
                'slug' => 'aws-partner',
                'template' => 'aws-partner',
                'status' => 'published',
            ],
            176 => [
                'title' => '1040 Tax Filing',
                'slug' => '1040-tax-filing',
                'template' => '1040-tax-filing',
                'status' => 'published',
            ],
            177 => [
                'title' => 'AI Consulting Services',
                'slug' => 'ai-consulting-services',
                'template' => 'ai-consulting-services',
                'status' => 'published',
            ],
            178 => [
                'title' => 'Agentic AI Services',
                'slug' => 'agentic-ai-services',
                'template' => 'agentic-ai-services',
                'status' => 'published',
            ],
            179 => [
                'title' => 'AI Development Services',
                'slug' => 'ai-development-services',
                'template' => 'ai-development-services',
                'status' => 'published',
            ],
            180 => [
                'title' => 'SAP Services',
                'slug' => 'sap-services',
                'template' => 'sap-services',
                'status' => 'published',
            ],
            181 => [
                'title' => 'SOC 2 Type 2',
                'slug' => 'soc-2-compliance',
                'template' => 'soc-2-compliance',
                'status' => 'published',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::query()->firstOrCreate(
                ['slug' => $pageData['slug']],
                [
                    'title' => $pageData['title'],
                    'template' => $pageData['template'],
                    'status' => $pageData['status'],
                ]
            );
        }

        $this->syncStageTwoSeo();
    }

    /**
     * SEO for Stage 2 pages built from WordPress XML (rank_math fields).
     */
    protected function syncStageTwoSeo(): void
    {
        $seoBySlug = [
            '1040-tax-filing' => [
                'meta_title' => ' Accurate IRS 1040 Filing | Claim Every Tax Credit',
                'meta_description' => 'Get the expert help you need for an accurate IRS 1040 filing. We specialize in maximizing refunds by securing every dollar you\'re entitled to',
                'canonical_url' => 'https://www.ibntech.com/1040-tax-filing/',
            ],
            'about-ibn' => [
                'meta_title' => 'About IBN | Trusted Outsourcing Partner Since 1999',
                'meta_description' => 'Learn About IBN—offering finance, accounting, payroll, data, and IT outsourcing services to help global businesses grow efficiently since 1999.',
                'canonical_url' => 'https://www.ibntech.com/about-ibn/',
            ],
            'accounting-services-for-small-business' => [
                'meta_title' => 'Accounting Services for Small Business - IBN Technologies',
                'meta_description' => 'We empower small businesses with affordable accounting services and cloud-based software tailored to your needs. From online bookkeeping to order management,',
                'canonical_url' => 'https://www.ibntech.com/accounting-services-for-small-business/',
            ],
            'accounting-system-and-integration' => [
                'meta_title' => 'Accounting System and Integration | IBN Technologies',
                'meta_description' => 'An integrated accounting framework to improve processes, ensure financial stability, and give a holistic view across POS, stores, back office, and front office.',
                'canonical_url' => 'https://www.ibntech.com/accounting-system-and-integration/',
            ],
            'ap-ar-automation' => [
                'meta_title' => 'Accounts Payable and Receivable Automation Service Provider - IBN Tech',
                'meta_description' => 'IBN Tech is leading AP and AR Automation Service provider, offering powerful analytical tools to streamline your business. Explore our services now!',
                'canonical_url' => 'https://www.ibntech.com/ap-ar-automation/',
            ],
            'accounts-payable-and-accounts-receivable-services' => [
                'meta_title' => 'Outsource Accounts Payable and Accounts Receivable Services | IBN Technologies',
                'meta_description' => 'Outsource accounts payable and accounts receivable services to IBN for efficient AR or AP management. Trusted provider of online AP and AR solutions for businesses.',
                'canonical_url' => 'https://www.ibntech.com/accounts-payable-and-accounts-receivable-services/',
            ],
            'ai-consulting-services' => [
                'meta_title' => 'AI Consulting Services and Strategic AI Implementation Solutions',
                'meta_description' => 'AI consulting services to unlock business value. We provide strategic roadmaps for generative AI integration, data readiness, and scalable cloud infrastructure.',
                'canonical_url' => 'https://www.ibntech.com/ai-consulting-services/',
            ],
            'agentic-ai-services' => [
                'meta_title' => 'Agentic AI Services and Autonomous Business Workflows',
                'meta_description' => 'Agentic AI services to transform your operations. Deploy autonomous AI agents for complex decision-making, task automation, and secure data processing.',
                'canonical_url' => 'https://www.ibntech.com/agentic-ai-services/',
            ],
            'ai-development-services' => [
                'meta_title' => 'AI Development Services and Scalable Intelligence Solutions',
                'meta_description' => 'AI development services to build advanced intelligence. Expert machine learning models, natural language processing, and secure cloud-native AI applications.',
                'canonical_url' => 'https://www.ibntech.com/ai-development-services/',
            ],
            'assistant-to-cfo-services' => [
                'meta_title' => 'Assistant To CFO Services - IBN Finance and Accounting',
                'meta_description' => 'Hire expert Assistant to CFO services from IBN Technologies. Get virtual financial support to streamline operations and boost business growth',
                'canonical_url' => 'https://www.ibntech.com/assistant-to-cfo-services/',
            ],
            'aws-cloud-services' => [
                'meta_title' => 'AWS Consulting and Managed Cloud Services | IBN Technologies',
                'meta_description' => 'Expert AWS cloud services with setup, monitoring, and migration support from IBN Technologies. Improve scalability, security, and cost efficiency through managed cloud services.',
                'canonical_url' => 'https://www.ibntech.com/aws-cloud-services/',
            ],
            'aws-partner' => [
                'meta_title' => 'AWS Cloud Partner and Managed Services | IBN Technologies',
                'meta_description' => 'Leverage IBN Technologies’ AWS partnership for cloud migration, optimization, and 24×7 managed services. Boost performance, security, and scalability.',
                'canonical_url' => 'https://www.ibntech.com/aws-partner/',
            ],
            'api-testing' => [
                'meta_title' => 'Reliable API Testing Services | IBN Tech Experts',
                'meta_description' => 'IBN Tech\'s API Testing services are designed to ensure the seamless functionality and interoperability of your application programming interfaces (API).',
                'canonical_url' => 'https://www.ibntech.com/api-testing/',
            ],
            'cyber-security-testing' => [
                'meta_title' => 'Cyber Security Testing - IBNTECH',
                'meta_description' => 'Explore cutting-edge cyber security testing solutions at IBNTech for robust digital protection. Stay ahead of threats with us!',
                'canonical_url' => 'https://www.ibntech.com/cyber-security-testing/',
            ],
            'functional-testing' => [
                'meta_title' => 'Functional Testing Services | Functional Testing industry | IBN Tech',
                'meta_description' => 'Explore Functional Testing Services to ensure your software performs flawlessly across all scenarios and platforms. Expertise meets efficiency here.',
                'canonical_url' => 'https://www.ibntech.com/functional-testing/',
            ],
            'mobile-app-testing' => [
                'meta_title' => 'Mobile App Testing Services | IBN Technologies',
                'meta_description' => 'Ensure flawless performance with IBN’s mobile app testing services. We offer functional, usability, and automation testing to deliver bug-free mobile apps',
                'canonical_url' => 'https://www.ibntech.com/mobile-app-testing/',
            ],
            'performance-testing' => [
                'meta_title' => 'Reliable Performance Testing Services - Enhance Efficiency',
                'meta_description' => 'Get reliable performance testing services from IBN’s expert team. Ensure speed, scalability, and efficiency to optimize your system’s performance.',
                'canonical_url' => 'https://www.ibntech.com/performance-testing/',
            ],
            'data-entry' => [
                'meta_title' => 'Outsourced Data Entry Services | Data Entry Company in India',
                'meta_description' => 'Get reliable and cost-effective outsource data entry services tailored to your needs. Save time and resources. Contact us today!',
                'canonical_url' => 'https://www.ibntech.com/data-entry/',
            ],
            'data-processing' => [
                'meta_title' => 'Data Processing Services | Innovative Solutions - IBNTECH',
                'meta_description' => 'Streamline your business operations with our Data Processing Services. Efficient, accurate, and secure handling of all your data needs.',
                'canonical_url' => 'https://www.ibntech.com/data-processing/',
            ],
            'data-migration-services' => [
                'meta_title' => 'Database Migration Services - IBNTECH',
                'meta_description' => 'Expert Database Migration Services - Securely transition your data with our experts at IBN Tech',
                'canonical_url' => 'https://www.ibntech.com/data-migration-services/',
            ],
            'data-conversion' => [
                'meta_title' => 'Outsource Data Conversion Services | IBN Technologies',
                'meta_description' => 'Looking to outsource data conversion services? We delivers high-quality, cost-effective solutions tailored to your business need. Contact Now',
                'canonical_url' => 'https://www.ibntech.com/data-conversion/',
            ],
            'record-management' => [
                'meta_title' => 'Outsource Record & Documents Management Services | IBN Tech',
                'meta_description' => 'Discover top-tier record management services for streamlined organization and enhanced data security. Optimize efficiency with expert solutions.',
                'canonical_url' => 'https://www.ibntech.com/record-management/',
            ],
            'electronic-funds-transfer' => [
                'meta_title' => 'Electronic Funds Transfer (EFT) Solutions | IBN technologies',
                'meta_description' => 'Explore IBN Tech’s EFT solutions for secure, fast money transfers. Learn about ACH, wire transfers, and more for efficient and seamless transactions.',
                'canonical_url' => 'https://www.ibntech.com/electronic-funds-transfer/',
            ],
            'invoice-process-automation' => [
                'meta_title' => 'Invoice Processing Automation Solutions | IBN Technologies',
                'meta_description' => 'Optimize your business with invoice processing automation. Reduce errors, save time, and enhance efficiency with our expert solutions.',
                'canonical_url' => 'https://www.ibntech.com/invoice-process-automation/',
            ],
            'medical-claim-automation' => [
                'meta_title' => 'Efficient Medical Claims Processing Services | Streamline Healthcare Billing',
                'meta_description' => 'Enhance your healthcare operations with our expert medical claims processing services. Reduce errors, expedite reimbursements, and improve efficiency.',
                'canonical_url' => 'https://www.ibntech.com/medical-claim-automation/',
            ],
            'database-monitoring-and-support' => [
                'meta_title' => 'Database Monitoring and Support',
                'meta_description' => 'Unlock Peak Performance! IBN Tech\'s 24/7 Managed Database Services ensure smooth operations, real-time insights, and crucial security. Stay ahead!',
                'canonical_url' => 'https://www.ibntech.com/database-monitoring-and-support/',
            ],
            'database-consulting' => [
                'meta_title' => 'Database Consulting Services - IBNTECH',
                'meta_description' => 'Maximize Your Data\'s Potential with IBN Tech\'s Professional Database Consulting Services. Enhance, Update, and Safeguard Your Database Systems for Success.',
                'canonical_url' => 'https://www.ibntech.com/database-consulting/',
            ],
            'database-performance-tuning' => [
                'meta_title' => 'Database Performance Tuning - IBNTECH',
                'meta_description' => 'IBN offers expert Database Performance Tuning Services—Oracle to SQL Server migration, monitoring, and SQL tuning for improved speed and reliability.',
                'canonical_url' => 'https://www.ibntech.com/database-performance-tuning/',
            ],
            'back-and-middle-office-services' => [
                'meta_title' => 'Middle and Back Office Services | Accounting Outsourcing',
                'meta_description' => 'Back-office accounting outsourcing can support nav calculation, reduce costs and increase operational efficiency. Hire middle and back office services.',
                'canonical_url' => 'https://www.ibntech.com/back-and-middle-office-services/',
            ],
            'finance-businesses-bookkeeping-service' => [
                'meta_title' => 'Outsourced Bookkeeping for Finance Businesses | IBN Tech',
                'meta_description' => 'Expert Outsourced Bookkeeping Services for Finance Businesses - Trustworthy and Efficient Solutions for Accurate Financial Records.',
                'canonical_url' => 'https://www.ibntech.com/finance-businesses-bookkeeping-service/',
            ],
            'it-business-bookkeeping-service' => [
                'meta_title' => 'Outsource Bookkeeping for IT Businesses',
                'meta_description' => 'Ibn Technologies provides specialized bookkeeping services for IT businesses. Our experts ensure accurate financial management. Contact us NOW !',
                'canonical_url' => 'https://www.ibntech.com/it-business-bookkeeping-service/',
            ],
            'it-services' => [
                'meta_title' => 'Application Development | IT Services and S/W Consulting',
                'meta_description' => 'IBN provides Application Development and end-to-end IT consulting through flexible, cost-efficient offshore delivery models. Get a free consultation today.',
                'canonical_url' => 'https://www.ibntech.com/it-services/',
            ],
            'it-staff-sourcing' => [
                'meta_title' => 'Expert IT Staff Sourcing Services | IBN Technologies',
                'meta_description' => 'Discover more about IT Staffing Services,Our expert team delivers tailored solutions for seamless recruitment.',
                'canonical_url' => 'https://www.ibntech.com/it-staff-sourcing/',
            ],
            'food-and-beverage-bookkeeping-services' => [
                'meta_title' => 'Outsourced Bookkeeping Services for Food & Beverage Industry',
                'meta_description' => 'Outsourced Food and Beverage Bookkeeping Services for Your Business. Streamline finances, ensure accuracy, and boost profitability.',
                'canonical_url' => 'https://www.ibntech.com/food-and-beverage-bookkeeping-services/',
            ],
            'legal-bookkeeping-services' => [
                'meta_title' => 'Outsourced Bookkeeping Services for Legal firm | IBN tech',
                'meta_description' => 'Expert Legal Bookkeeping Services - Optimize your legal practice with our reliable bookkeeping services designed specifically for law firms.',
                'canonical_url' => 'https://www.ibntech.com/legal-bookkeeping-services/',
            ],
            'managed-siem-soc-services' => [
                'meta_title' => 'Managed SOC and SIEM Services | 24/7 Monitoring and Response',
                'meta_description' => '24/7 managed SOC and SIEM services from IBN Technologies. Real-time threat detection, fast incident response, zero in-house overhead.',
                'canonical_url' => 'https://www.ibntech.com/managed-siem-soc-services/',
            ],
            'vciso-services' => [
                'meta_title' => 'vCISO Services | Virtual Chief Information Security Officer',
                'meta_description' => 'Strengthen your cybersecurity strategy with our vCISO services. Get expert guidance, risk management, and compliance support at a fraction of the cost.',
                'canonical_url' => 'https://www.ibntech.com/vciso-services/',
            ],
            'managed-detection-response-services' => [
                'meta_title' => 'Managed Detection and Response (MDR) Services | 24/7 Threat Defense',
                'meta_description' => 'Detect, respond, and neutralize cyber threats with our MDR services. Round-the-clock monitoring, rapid response, and advanced security intelligence.',
                'canonical_url' => 'https://www.ibntech.com/managed-detection-response-services/',
            ],
            'microsoft-certified-partners' => [
                'meta_title' => 'Microsoft Certified Gold Partner Services | IBN Technologies',
                'meta_description' => 'IBN, a Microsoft Certified Gold & SPLA Partner in India, offers Microsoft licenses, technical support, training, and marketing tools for your business.',
                'canonical_url' => 'https://www.ibntech.com/microsoft-certified-partners/',
            ],
            'microsoft-dynamics-nav' => [
                'meta_title' => 'Dynamics Navision, ERP & Business Management Solutions',
                'meta_description' => 'IBN is a leading Microsoft Dynamics NAV partner, providing ERP and business management solutions to small and mid-size companies worldwide.',
                'canonical_url' => 'https://www.ibntech.com/microsoft-dynamics-nav/',
            ],
            'microsoft-office-365-migration-support-services' => [
                'meta_title' => 'Microsoft 365 / Office 365 Migration and Support Services | IBN Techologies',
                'meta_description' => 'Seamless Microsoft 365 / Office 365 migration by IBN Tech with Azure and AWS integration for SMBs in the US, UK, and India ensuring zero downtime, secure cutover, and dedicated global support.',
                'canonical_url' => 'https://www.ibntech.com/microsoft-office-365-migration-support-services/',
            ],
            'microsoft-security-services' => [
                'meta_title' => 'Microsoft Security Services | Advanced Cloud Protection',
                'meta_description' => 'Safeguard your Microsoft 365 and Azure environment with our expert Microsoft security services. Protect data, prevent threats, and ensure compliance',
                'canonical_url' => 'https://www.ibntech.com/microsoft-security-services/',
            ],
            'devsecops-services' => [
                'meta_title' => 'DevSecOps Services | Secure Code and Compliance Automation',
                'meta_description' => 'DevSecOps services from IBN Technologies accelerate software delivery by securing code, protecting pipelines, automating testing, and ensuring compliance.',
                'canonical_url' => 'https://www.ibntech.com/devsecops-services/',
            ],
            'manufacturing-accounting-and-bookkeeping-services' => [
                'meta_title' => 'Accounting and Bookkeeping Services for Manufacturing - IBN',
                'meta_description' => 'Get the best manufacturing accounting and bookkeeping services to streamline costs, improve cash flow, and maximize profits.',
                'canonical_url' => 'https://www.ibntech.com/manufacturing-accounting-and-bookkeeping-services/',
            ],
            'marketing-and-advertising-bookkeeping-services' => [
                'meta_title' => 'Bookkeeping Services for Marketing & Advertising Companies | IBN',
                'meta_description' => 'Elevate Your Business with Outsourced Bookkeeping Services for Marketing and Advertising Companies - Drive success with our tailored solutions. Book now!',
                'canonical_url' => 'https://www.ibntech.com/marketing-and-advertising-bookkeeping-services/',
            ],
            'real-estate-construction-bookkeeping-services' => [
                'meta_title' => 'Real Estate & Construction Bookkeeping | IBN Tech',
                'meta_description' => 'Get outsourced real estate and construction bookkeeping services from IBN. Save time, cut costs & ensure accurate financials tailored to your industry.',
                'canonical_url' => 'https://www.ibntech.com/real-estate-construction-bookkeeping-services/',
            ],
            'real-estate-and-construction-engineering-services' => [
                'meta_title' => 'Real Estate & Construction BPO Services | IBN Technologies',
                'meta_description' => 'Outsource Real Estate & Construction Engineering back-office support to streamline projects, boost efficiency and enhance overall business productivity.',
                'canonical_url' => 'https://www.ibntech.com/real-estate-and-construction-engineering-services/',
            ],
            'bookeeping-for-uk' => [
                'meta_title' => 'Outsourced Bookkeeping Services for UK | Online Bookkeeper',
                'meta_description' => 'Bookkeeping services for UK businesses. IBN Technologies provides accurate, timely bookkeeping outsourced to experts.',
                'canonical_url' => 'https://www.ibntech.com/bookeeping-for-uk/',
            ],
            'bookkeeping-for-us' => [
                'meta_title' => 'Bookkeeping Services for USA by IBN | Online Bookkeeper',
                'meta_description' => 'Hire bookkeeping services for USA by IBN, an online bookkeeper for small and medium businesses, expert in Sage, Line, Xero, Quick books accounting, Quicken',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-for-us/',
            ],
            'bookkeeping-services-california' => [
                'meta_title' => 'Outsource Bookkeeping and Accounting Services in California, US',
                'meta_description' => 'Discover expert bookkeeping services California, USA. IBNTECH offers tailored, compliant, and efficient financial solutions for your business needs.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-california/',
            ],
            'bookkeeping-services-florida' => [
                'meta_title' => 'Bookkeeping Service in Miami, Florida | IBN Technologies',
                'meta_description' => 'Streamline finances with IBN’s bookkeeping service in Miami, Florida. Get accurate records, tax prep & custom accounting solutions for your business.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-florida/',
            ],
            'bookkeeping-services-texas' => [
                'meta_title' => 'Bookkeeping Services in Texas | Expert Accounting | IBN',
                'meta_description' => 'Get accurate and cost-effective bookkeeping services in Texas. Outsource to IBN’s expert team for reliable accounting tailored to your business needs.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-texas/',
            ],
            'bookkeeping-services-chicago' => [
                'meta_title' => 'Professional Bookkeeping Services in Chicago | IBN Tech',
                'meta_description' => 'Get expert bookkeeping services in Chicago with IBN. Accurate records, tax support & tailored accounting solutions for businesses of all sizes.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-chicago/',
            ],
            'bookkeeping-services-las-vegas' => [
                'meta_title' => 'Reliable Bookkeeping Services Las Vegas, NV | IBN Tech',
                'meta_description' => 'Discover expert bookkeeping services in Las Vegas, NV to streamline your finances. Our professionals ensure accuracy and compliance for your peace of mind.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-las-vegas/',
            ],
            'bookkeeping-services-new-york' => [
                'meta_title' => 'Bookkeeping Services in New York | IBN Technologies',
                'meta_description' => 'Boost efficiency with IBN’s bookkeeping services in New York. Get expert financial solutions tailored to streamline your business operations.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-new-york/',
            ],
            'bookkeeping-services-vermont' => [
                'meta_title' => 'Bookkeeping Services in Vermont | IBN Tech',
                'meta_description' => 'Discover expert outsourced bookkeeping services in Vermont. Enhance accuracy, save time, and focus on growth with our tailored financial solutions.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-vermont/',
            ],
            'bookkeeping-services-phoenix' => [
                'meta_title' => 'Bookkeeping Services in Phoenix, AZ | Accurate & Reliable Solutions',
                'meta_description' => 'Professional bookkeeping services in Phoenix, AZ, designed to streamline your finances. Get accurate records, customized solutions, and tax Support.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-phoenix/',
            ],
            'bookkeeping-services-austin' => [
                'meta_title' => 'Bookkeeping services for small business in Austin- IBN Tech',
                'meta_description' => 'Streamline your Austin business with our comprehensive bookkeeping services. Payroll, invoicing, tax planning, and financial reporting done right.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-austin/',
            ],
            'bookkeeping-services-hartford' => [
                'meta_title' => 'Hartford Bookkeeping Services for Small Businesses | IBN Tech',
                'meta_description' => 'Streamline your finances with expert bookkeeping services in Hartford. We offer comprehensive solutions for small businesses. Contact us NOW!',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-hartford/',
            ],
            'bookkeeping-services-san-jose' => [
                'meta_title' => 'Bookkeeping Services San Jose | IBN Technologies LLC',
                'meta_description' => 'San Jose bookkeeping : Ibn Technologies provides expert bookkeeping, financial reporting services for businesses in San Jose. Contact us Now!',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-san-jose/',
            ],
            'bookkeeping-services-san-diego' => [
                'meta_title' => 'Best Bookkeeping Services San Diego | IBN Technologies LLC',
                'meta_description' => 'Ibn Technologies offers reliable bookkeeping services in San Diego. We can handle ap-ar services, payroll, financial reporting for businesses.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-san-diego/',
            ],
            'bookkeeping-services-los-angeles' => [
                'meta_title' => 'Bookkeeping Services in Los Angeles | IBN Technologies LTD',
                'meta_description' => 'IBN Technologies provides expert bookkeeping services in Los Angeles. Accurate financial records, reporting, payroll - Contact us NOW !',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-los-angeles/',
            ],
            'bookkeeping-services-san-francisco' => [
                'meta_title' => 'Bookkeeping Services In San Francisco | IBN Technologies LTD',
                'meta_description' => 'Ibn Technologies offers expert bookkeeping, payroll, tax, and financial reporting services in San Francisco. Contact us Now !',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-san-francisco/',
            ],
            'restaurants-bookkeeping-services' => [
                'meta_title' => 'Restaurants Bookkeeping Services | Restaurant Bookkeeper | IBN',
                'meta_description' => 'IBN is Leading Restaurants Bookkeeping Service Provider. Streamline financial management for your restaurant business with expert bookkeeping solutions.',
                'canonical_url' => 'https://www.ibntech.com/restaurants-bookkeeping-services/',
            ],
            'bookkeeping-services-for-retail-stores' => [
                'meta_title' => 'Expert Retail Bookkeeping Services | IBN Technologies',
                'meta_description' => 'IBN Technologies offers specialized retail bookkeeping services to manage your inventory, sales, and financials, ensuring accuracy and efficiency for you.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-for-retail-stores/',
            ],
            'bookkeeping-services-usa' => [
                'meta_title' => 'Outsourced Bookkeeping Services in USA | Offshore Bookkeeper',
                'meta_description' => 'IBN is an offshore finance and accounting service provider offering outsourced bookkeeping services in the USA',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-usa/',
            ],
            'bookkeeping-for-large-organisation' => [
                'meta_title' => 'Bookkeeping Services for Large Organizations | Bookkeeper',
                'meta_description' => 'Bookkeeping services for large organizations, hire online bookkeeper for general ledger, invoicing, financial statement preparation, MIS preparations, AP/AR',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-for-large-organisation/',
            ],
            'bookkeeping-for-small-business' => [
                'meta_title' => 'Online Bookkeeping Services Company for Small Businesses',
                'meta_description' => 'Affordable bookkeeping services for small businesses by IBN, hire an online bookkeeper to deal with your all financial needs.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-for-small-business/',
            ],
            'bookkeeping-services-for-small-businesses' => [
                'meta_title' => 'Hire Bookkeeping Services for Small Business | IBN Tech',
                'meta_description' => 'Outsource bookkeeping services for small businesses; we offer reliable & cost-effective solutions to all financial solutions across USA & UK.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-services-for-small-businesses/',
            ],
            'bookkeeping-service-restaurants' => [
                'meta_title' => 'Virtual Bookkeeping Expert for Restaurants',
                'meta_description' => 'We offer outsource bookkeeping accounting services for restaurants. Our virtual bookkeeper streamline payroll process and update your books to enhance growth.',
                'canonical_url' => 'https://www.ibntech.com/bookkeeping-service-restaurants/',
            ],
            'bpo-services' => [
                'meta_title' => 'Business Process Outsourcing Services (BPO) by IBN Technologies',
                'meta_description' => 'IBN Tech offers specialized Business Process Outsourcing Services customized to streamline your operations. Maximize efficiency and profitability today!',
                'canonical_url' => 'https://www.ibntech.com/bpo-services/',
            ],
            'kpo-services' => [
                'meta_title' => 'Improve Efficiency with IBN\'s Outsourced KPO Solutions',
                'meta_description' => 'Outsourced KPO solutions to IBN Technologies and boost efficiency with expert support in bookkeeping, analytics, and process optimization. Contact us today!',
                'canonical_url' => 'https://www.ibntech.com/kpo-services/',
            ],
            'bpotransition-methodology' => [
                'meta_title' => 'Transition Methodology Services | IBN Technologies',
                'meta_description' => 'Discover IBN’s Transition Methodology Services for BPO/KPO. Ensure smooth knowledge transfer, planning, and execution for successful outsourcing transitions.',
                'canonical_url' => 'https://www.ibntech.com/bpotransition-methodology/',
            ],
            'infrastructure' => [
                'meta_title' => 'State of Art Infrastructure, Secured Network - India | IBN Technologies',
                'meta_description' => 'State of Art Infrastructure, Secured Network, Data Protection Policies place in India.',
                'canonical_url' => 'https://www.ibntech.com/infrastructure/',
            ],
            'boost-your-business-with-accounting-offers' => [
                'meta_title' => 'Boost your business with Best Accounting offers | USA',
                'meta_description' => 'Boost your business with expert accounting solutions from IBN Finance & Accounting. Streamline finances, ensure compliance & maximize profits effortlessly!',
                'canonical_url' => 'https://www.ibntech.com/boost-your-business-with-accounting-offers/',
            ],
            'business-intelligence-and-reporting' => [
                'meta_title' => 'Business Intelligence And Reporting - IBN Technologies',
                'meta_description' => 'Unlock the power of Business Intelligence Reporting and make data-driven decisions. Enhance your business insights with advanced analytics. Discover more.',
                'canonical_url' => 'https://www.ibntech.com/business-intelligence-and-reporting/',
            ],
            'business-partner' => [
                'meta_title' => 'IBN Business Partner Program | Sustain Business Growth',
                'meta_description' => 'Join IBN Business Partner Program to boost growth, build strong client relationships, and unlock efficiency with proven business and cost benefits.',
                'canonical_url' => 'https://www.ibntech.com/business-partner/',
            ],
            'business-continuity-disaster-recovery-services' => [
                'meta_title' => 'Business Continuity and Disaster Recovery Services | IBN Technologies',
                'meta_description' => 'IBN Techologies offers reliable business continuity and disaster recovery services to safeguard IT systems, ensure compliance, and provide strategies to minimize downtime.',
                'canonical_url' => 'https://www.ibntech.com/business-continuity-disaster-recovery-services/',
            ],
            'cfo-services' => [
                'meta_title' => 'Optimize Finances with Outsourced CFO Services - IBNTECH',
                'meta_description' => 'Maximize your financial strategy with outsourced CFO services. Gain insights, improve decision-making, and drive growth. Contact us now!',
                'canonical_url' => 'https://www.ibntech.com/cfo-services/',
            ],
            'civil-engineering-services' => [
                'meta_title' => 'Full-Time Remote Construction and Civil Engineering Support',
                'meta_description' => 'Full-time remote civil engineers supporting construction estimation, drawing, and drafting. Reduce cost, 99% accuracy, and scale your construction operations.',
                'canonical_url' => 'https://www.ibntech.com/civil-engineering-services/',
            ],
            'construction-takeoff-estimation-services' => [
                'meta_title' => 'Construction Takeoff and Estimation Services in USA | IBN Technologies',
                'meta_description' => 'IBN Technologies provides accurate construction takeoff and cost estimation services with BIM expertise. Improve bidding, reduce errors, and streamline costs with precise material takeoff for projects in the US and UAE.',
                'canonical_url' => 'https://www.ibntech.com/construction-takeoff-estimation-services/',
            ],
            'cloud-consulting-and-migration-services' => [
                'meta_title' => 'Cloud Consulting and Migration Services | IBN Technologies',
                'meta_description' => 'IBN Tech delivers expert cloud consulting and migration services across Azure, AWS, GCP & JioCloud. Secure, cost-efficient solutions for SMBs & enterprises.',
                'canonical_url' => 'https://www.ibntech.com/cloud-consulting-and-migration-services/',
            ],
            'cloud-managed-services' => [
                'meta_title' => 'Cloud Managed Services | Secure & Scalable Cloud Solutions — IBN Technologies',
                'meta_description' => 'IBN Technologies delivers Cloud Managed Services with secure migration, real time monitoring, and advanced cloud security tailored for enterprises',
                'canonical_url' => 'https://www.ibntech.com/cloud-managed-services/',
            ],
            'construction-documentation-services' => [
                'meta_title' => 'RFI Management and Construction Documentation Services | IBN Technologies',
                'meta_description' => 'IBN Technologies offers professional RFI management and construction documentation services, helping firms streamline submittals, BIM coordination, and project delivery with accuracy and efficiency.',
                'canonical_url' => 'https://www.ibntech.com/construction-documentation-services/',
            ],
            'cookies-policy' => [
                'meta_title' => 'Cookies Policy - IBN Technologies',
                'meta_description' => 'This Cookies Policy explains how IBN Technologies Limited uses cookies and similar technologies on our websites, and the choices you have.',
                'canonical_url' => 'https://www.ibntech.com/cookies-policy/',
            ],
            'cpa-outsourcing' => [
                'meta_title' => 'Outsourcing Services for CPA Firms | IBN Technologies',
                'meta_description' => 'IBN offers reliable outsourcing services for CPA firms—covering tax preparation, bookkeeping, and payroll to improve accuracy, compliance, and efficiency.',
                'canonical_url' => 'https://www.ibntech.com/cpa-outsourcing/',
            ],
            'pricing' => [
                'meta_title' => 'Transparent Bookkeeping Pricing | IBN Technologies',
                'meta_description' => 'Explore our transparent bookkeeping services pricing with affordable bookkeeping packages. Get a clear breakdown of bookkeeping costs & fees for virtual bookkeeping services.',
                'canonical_url' => 'https://www.ibntech.com/pricing/',
            ],
            'procure-to-pay' => [
                'meta_title' => 'IBN Technologies End-to-End Procure-to-Pay Solutions',
                'meta_description' => 'IBN Tech offers end-to-end Procure-to-Pay services designed to optimize your procurement cycle and deliver cost-effective solutions.',
                'canonical_url' => 'https://www.ibntech.com/procure-to-pay/',
            ],
            'privacy-policy' => [
                'meta_title' => 'Privacy Policy - IBN Technologies',
                'meta_description' => 'At IBNTech, we prioritize your data security. Our comprehensive privacy policy outlines our commitment to protecting your personal information.',
                'canonical_url' => 'https://www.ibntech.com/privacy-policy/',
            ],
            'terms-of-use' => [
                'meta_title' => 'Terms of Use | IBN Technologies Website Policies',
                'meta_description' => 'All content on this website—including text, images, video, and software—is the exclusive property of IBN. Unauthorized use or copying is prohibited.',
                'canonical_url' => 'https://www.ibntech.com/terms-of-use/',
            ],
            'testimonials' => [
                'meta_title' => 'Testimonials - IBN Technologies',
                'meta_description' => 'Our 22-year track record of successfully generating value through outsourcing is attested to by the glowing reviews we receive from clients.',
                'canonical_url' => 'https://www.ibntech.com/testimonials/',
            ],
            'contact-us' => [
                'meta_title' => 'Get in Touch with IBN Tech | Contact Us Today',
                'meta_description' => 'Get in touch with IBN Tech for expert business solutions. Contact us today to learn more about our services and how we can help your business thrive.',
                'canonical_url' => 'https://www.ibntech.com/contact-us/',
            ],
            'current-job-opening' => [
                'meta_title' => 'Job Opportunities at IBN Technologies Pune | Apply Now',
                'meta_description' => 'Explore job opportunities at IBN Technologies, Pune. Find career openings for freshers and professionals. Join us to grow your skills and achieve success.',
                'canonical_url' => 'https://www.ibntech.com/current-job-opening/',
            ],
            'cybersecurity-audit-compliance-services' => [
                'meta_title' => 'Cybersecurity Audit and Compliance Services | IBN Tech – Ensure Regulatory Security',
                'meta_description' => 'Cybersecurity Audit and Compliance Services from IBN Tech deliver audit-ready risk analysis, regulatory alignment, and ongoing compliance to protect your business.',
                'canonical_url' => 'https://www.ibntech.com/cybersecurity-audit-compliance-services/',
            ],
            'cybersecurity-maturity-assessment-services' => [
                'meta_title' => 'Cybersecurity Maturity Assessment Services | IBN Tech Security Experts',
                'meta_description' => 'IBN Tech offers Cybersecurity Maturity Assessment Services to identify gaps, ensure compliance, and build a roadmap for stronger security and resilience.',
                'canonical_url' => 'https://www.ibntech.com/cybersecurity-maturity-assessment-services/',
            ],
            'treasury-management' => [
                'meta_title' => 'Treasury Management Services | Optimize Cash Flow & Liquidity',
                'meta_description' => 'Improve cash flow and reduce financial risk with IBN’s Treasury Management Services. Optimize liquidity, forecasting, and investments for smart decisions.',
                'canonical_url' => 'https://www.ibntech.com/treasury-management/',
            ],
            'treasury-management-services-outsourcing' => [
                'meta_title' => 'Outsource Treasury Management Services - IBN Technologies',
                'meta_description' => 'IBN\'s outsourced treasury services can help you with payments, liquidity management, receivables, tax management, fee reconciliation, and more.',
                'canonical_url' => 'https://www.ibntech.com/treasury-management-services-outsourcing/',
            ],
            'faq' => [
                'meta_title' => 'Outsourcing FAQs Answered | IBN Technologies',
                'meta_description' => 'Clear your doubts about outsourcing with IBN Technologies’ expert FAQs. Get answers, debunk myths, and understand the process with confidence.',
                'canonical_url' => 'https://www.ibntech.com/faq/',
            ],
            'free-consultation' => [
                'meta_title' => 'Free 30 Min Consultation | Outsourced Finance & Accounting Services',
                'meta_description' => 'Book a free 30-minute consultation with IBN Technologies. Cut operational costs by up to 70% with expert outsourced finance and accounting solutions.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation/',
            ],
            'free-consultation-for-ap-ar-management' => [
                'meta_title' => 'Free Consultation For AP AR Management - IBN Technologies',
                'meta_description' => 'Take control of cash flow with expert AP/AR management. Improve cash flow, increase on-time payments, and save 15+ hours per week with IBN Technologies.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-ap-ar-management/',
            ],
            'free-consultation-for-cloud' => [
                'meta_title' => 'Free Consultation For Cloud - IBN Technologies',
                'meta_description' => 'Accelerate cloud transformation with IBN Technologies. Expert-led managed cloud, security, DevSecOps, and Microsoft 365 migration support.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-cloud/',
            ],
            'free-consultation-for-construction' => [
                'meta_title' => 'Free Consultation For Construction - IBN Technologies',
                'meta_description' => 'Hire skilled full-time remote engineers for construction support. Estimation, RFIs, drafting, and documentation with IBN Technologies.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-construction/',
            ],
            'free-consultation-for-cybersecurity' => [
                'meta_title' => 'Free Consultation For Cybersecurity - IBN Technologies',
                'meta_description' => 'Get a free cybersecurity assessment from IBN Tech. VAPT, SIEM & SOC, vCISO, MDR, Microsoft Security, and compliance audits.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-cybersecurity/',
            ],
            'free-consultation-for-ipa' => [
                'meta_title' => 'Free Consultation For IPA - IBN Technologies',
                'meta_description' => 'Experience workflow automation with IBN Technologies. Reduce AP/AR processing time, speed up order handling, and improve three-way matching accuracy.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-ipa/',
            ],
            'free-consultation-for-payroll-service' => [
                'meta_title' => 'Free Consultation For Payroll Service - IBN Technologies',
                'meta_description' => 'Outsourced payroll processing that is easy and accurate. Get a 100% accuracy guarantee, year-end reporting, and expert payroll support from IBN Technologies.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-payroll-service/',
            ],
            'free-consultation-for-tax-return' => [
                'meta_title' => 'Free Consultation For Tax Return Preparation - IBN Technologies',
                'meta_description' => 'Accurate tax return preparation with expert support. IBN Technologies handles 1120, 1120S, 1040, 1065, 990, and 1099 filings with 99% accuracy.',
                'canonical_url' => 'https://www.ibntech.com/free-consultation-for-tax-return/',
            ],
            'free-trial' => [
                'meta_title' => 'Free Trial - IBN Technologies',
                'meta_description' => 'Start a free 20-hour professional bookkeeping trial with IBN Technologies. No credit card required. Get a dedicated expert and real-time financial data.',
                'canonical_url' => 'https://www.ibntech.com/free-trial/',
            ],
            'family-office-services' => [
                'meta_title' => 'IBNTech: Your Family Office Outsourcing Services Partner',
                'meta_description' => 'Maximize investment value with IBN’s Family Office Outsourcing Services. Strengthen operations and gain strategic support for long-term financial growth.',
                'canonical_url' => 'https://www.ibntech.com/family-office-services/',
            ],
            'fund-accounting-services' => [
                'meta_title' => 'Fund Accounting Services | IBN Technologies',
                'meta_description' => 'IBN offers expert Fund Accounting Services with precise NAV calculation, reconciliation & reporting for hedge funds, mutual funds & private equity firms.',
                'canonical_url' => 'https://www.ibntech.com/fund-accounting-services/',
            ],
            'healthcare-bookkeeping-services' => [
                'meta_title' => 'Healthcare Bookkeeping Services | IBN Technologies',
                'meta_description' => 'Streamline your healthcare finances with expert healthcare bookkeeping services tailored for medical practices. Contact IBN Technologies today!',
                'canonical_url' => 'https://www.ibntech.com/healthcare-bookkeeping-services/',
            ],
            'hedgefund-administration' => [
                'meta_title' => 'IBNTech\'s Hedge Fund Administration Outsourcing Services',
                'meta_description' => 'Get the most efficient Hedge Fund Administration Outsourcing services with IBN Tech. With secure and reliable services. Contact Us NOW !',
                'canonical_url' => 'https://www.ibntech.com/hedgefund-administration/',
            ],
            'hedge-fund-services' => [
                'meta_title' => 'Expert Middle and Back Office Services for Hedge Funds',
                'meta_description' => 'Improve your hedge fund\'s performance with IBN Tech\'s middle and back office solutions, designed to streamline operations and reduce risk.',
                'canonical_url' => 'https://www.ibntech.com/hedge-fund-services/',
            ],
            'hedge-fund-accounting' => [
                'meta_title' => 'Hedge Fund Accounting - IBN Technologies',
                'meta_description' => 'Get reliable back and middle office services for your investment strategies. Let us manage your hedge fund accounting while you focus on returns.',
                'canonical_url' => 'https://www.ibntech.com/hedge-fund-accounting/',
            ],
            'hospitality' => [
                'meta_title' => 'Business Process Outsourcing (BPO) Services for Hospitality | IBN',
                'meta_description' => 'Boost efficiency and cut costs with expert Business Process outsourcing services. Streamline operations, and focus on core business growth for hospitality.',
                'canonical_url' => 'https://www.ibntech.com/hospitality/',
            ],
            'multi-location-business' => [
                'meta_title' => 'Multiple Location Business Services | Back Office Support Services',
                'meta_description' => 'IBN\'s core functions to facilitate Multi location Businesses including end-to-end service delivery across multiple locations, business development.',
                'canonical_url' => 'https://www.ibntech.com/multi-location-business/',
            ],
            'mortgage' => [
                'meta_title' => 'Mortgage Process Outsourcing Services in USA | IBN tech',
                'meta_description' => 'Streamline loan origination, servicing, closing & consumer lending with expert mortgage process outsourcing. Boost efficiency—book a call with IBN today!',
                'canonical_url' => 'https://www.ibntech.com/mortgage/',
            ],
            'order-to-cash' => [
                'meta_title' => 'Improve Order-to-Cash Cycle with Expert Solutions | IBN Tech',
                'meta_description' => 'Optimize your order-to-cash cycle for increased efficiency and profitability. Explore our comprehensive solutions today.',
                'canonical_url' => 'https://www.ibntech.com/order-to-cash/',
            ],
            'quote-to-cash' => [
                'meta_title' => 'Quote to Cash Process Outsourcing Service Provider | IBN Tech',
                'meta_description' => 'Optimize your quote to cash process outsourcing with IBN. From quoting to payment recording, we streamline bank uploads and cash application for efficiency.',
                'canonical_url' => 'https://www.ibntech.com/quote-to-cash/',
            ],
            'record-to-report' => [
                'meta_title' => 'Record-to-Report Services - Outsource your R2R Process to Experts',
                'meta_description' => 'Outsource your Record-to-Report process to IBN Tech. Automate financial close, reconciliation, analysis, and reporting to reduce risk and improve decision-making.',
                'canonical_url' => 'https://www.ibntech.com/record-to-report/',
            ],
            'record-to-report-cfo' => [
                'meta_title' => 'Record to Report CFO Services | IBN Technologies',
                'meta_description' => 'Enhance financial performance with expert Record to Report CFO solutions from IBN Technologies. Reliable virtual support for smarter business decisions.',
                'canonical_url' => 'https://www.ibntech.com/record-to-report-cfo/',
            ],
            'recruitment-firms' => [
                'meta_title' => 'Outsource Accounting for Recruitment Firms | IBN',
                'meta_description' => 'IBN offers outsourced accounting, bookkeeping, payroll, and tax services for recruitment firms—solving data, compliance, and digitalization challenges.',
                'canonical_url' => 'https://www.ibntech.com/recruitment-firms/',
            ],
            'retail' => [
                'meta_title' => 'Retail Outsourcing Services | Retail Sales Outsourcing | IBN Tech',
                'meta_description' => 'Transform your retail sales with IBN Tech\'s leading retail outsourcing services. Elevate efficiency, reduce costs, and enhance customer satisfaction.',
                'canonical_url' => 'https://www.ibntech.com/retail/',
            ],
            'hospitality-bookkeeping-and-accounting-services' => [
                'meta_title' => 'Hospitality Accounting and Bookkeeping Services | IBN',
                'meta_description' => 'IBN offers expert hospitality accounting and bookkeeping services to streamline finances, ensure compliance, maintain accuracy, and boost profitability.',
                'canonical_url' => 'https://www.ibntech.com/hospitality-bookkeeping-and-accounting-services/',
            ],
            'ibn-team' => [
                'meta_title' => 'IBNTech Team - IBN Technologies',
                'meta_description' => 'IBN Technologies\' management team consists of global leaders and outstanding achievers in business and society.',
                'canonical_url' => 'https://www.ibntech.com/ibn-team/',
            ],
            'finance-and-accounting-services' => [
                'meta_title' => 'Finance and Accounting Outsourcing Services | IBN Tech',
                'meta_description' => 'Streamline operations with IBN\'s finance and accounting outsourcing services. expert solutions for bookkeeping, payroll, tax preparation, and AP automation.',
                'canonical_url' => 'https://www.ibntech.com/finance-and-accounting-services/',
            ],
            'fund-investor-reporting' => [
                'meta_title' => 'Optimize Your Investments with Fund Investor Reporting',
                'meta_description' => 'Perfect for fund managers- IBNTech\'s Fund Investor Reporting will make life easier. Get real-time insights and make decisions that matter. Get started Now!',
                'canonical_url' => 'https://www.ibntech.com/fund-investor-reporting/',
            ],

            'soc-2-compliance' => [
                'meta_title' => 'SOC 2 Type 2 Compliance and Audit Services for Businesses',
                'meta_description' => 'Achieve SOC 2 Type 2 compliance and audit support, with expert security controls, and continuous monitoring. Ensure data protection, trust, and regulatory readiness.',
                'canonical_url' => 'https://www.ibntech.com/soc-2-compliance/',
            ],
            'payroll-processing' => [
                'meta_title' => 'Outsource Payroll Services | Online and Affordable Payroll Processing',
                'meta_description' => 'Outsource payroll services to IBN Tech for accurate, affordable payroll processing. Trusted provider of online payroll and HR solutions for USA businesses.',
                'canonical_url' => 'https://www.ibntech.com/payroll-processing/',
            ],
            'outsourcing' => [
                'meta_title' => 'Outsourcing Services for SMBs | IBN Technologies',
                'meta_description' => 'IBN Technologies offers expert outsourcing services to SMBs in the USA and UK—covering finance, accounting, back-office support & more across industries.',
                'canonical_url' => 'https://www.ibntech.com/outsourcing/',
            ],
            'outsourced-bookkeeping' => [
                'meta_title' => 'Expert Bookkeeping to Fuel Your Business Growth Landing Page - IBN Technologies',
                'meta_description' => 'Ditch time-consuming bookkeeping. IBN Tech\'s outsourced services save up to 70% on costs, streamline financials, and let you focus on scaling your business.',
                'canonical_url' => 'https://www.ibntech.com/outsourced-bookkeeping/',
            ],
            'outsourced-bookkeeping-services-usa' => [
                'meta_title' => 'Outsource Accounting Services To India - IBN Technologies',
                'meta_description' => 'Accounting and bookkeeping outsourcing to india. IBN helps businesses like you to take care of their accounting and bookkeeping',
                'canonical_url' => 'https://www.ibntech.com/outsourced-bookkeeping-services-usa/',
            ],
            'finance-management' => [
                'meta_title' => 'Financial Management Services - IBNTECH',
                'meta_description' => 'Harness the power of finance management to drive success and overcome challenges. Explore our solutions for efficient financial planning and decision-making.',
                'canonical_url' => 'https://www.ibntech.com/finance-management/',
            ],
            'project-management' => [
                'meta_title' => 'Project Management - Resources Basic | IBN Technologies',
                'meta_description' => 'IBN is a leading Project Management Service providing firm that helps Businesses to Manage Basic Resources, Capacity Management.',
                'canonical_url' => 'https://www.ibntech.com/project-management/',
            ],
            'human-resources-management-hrm' => [
                'meta_title' => 'Human Resources Management -Organize Employee Information | IBN',
                'meta_description' => 'We at IBN Tech provides Human Resources Management Services to Efficiently Manage your Company’s Man power. I',
                'canonical_url' => 'https://www.ibntech.com/human-resources-management-hrm/',
            ],
            'us-uk-tax-preparation-services' => [
                'meta_title' => 'USA & UK Tax Advisory Services | Tax Professionals | IBN Tech',
                'meta_description' => 'IBN Tech is the leading provider of USA & UK Tax Advisory Services. Get personalized advice and accurate tax filing from our expert Team.',
                'canonical_url' => 'https://www.ibntech.com/us-uk-tax-preparation-services/',
            ],
            'tax-preparation-services-usa' => [
                'meta_title' => 'Business Tax Preparation Services USA | IBN Technologies',
                'meta_description' => 'USA business tax preparation service: S-Corp, C-Corp and partnership filings, expense optimization & IRS audit support. Accurate, timely & compliant.',
                'canonical_url' => 'https://www.ibntech.com/tax-preparation-services-usa/',
            ],
            'tax-preparation-services-uk' => [
                'meta_title' => 'UK Tax Preparation Service | IBN Technologies',
                'meta_description' => 'Expert UK Tax Preparation Service for businesses and individuals. Accurate self-assessment, VAT, and corporate tax filing with full HMRC compliance.',
                'canonical_url' => 'https://www.ibntech.com/tax-preparation-services-uk/',
            ],
            'sap-services' => [
                'meta_title' => 'SAP Services and Managed ERP Solution',
                'meta_description' => 'SAP services to optimize your enterprise. We offer expert SAP S/4HANA migration, financial module accounting, and secure cloud hosting for global firms.',
                'canonical_url' => 'https://www.ibntech.com/sap-services/',
            ],
            'reporting-analysis-planning' => [
                'meta_title' => 'Reporting Analysis Planning | IBN Tech',
                'meta_description' => 'Explore IBN Tech\'s comprehensive solutions for Strategic Reporting Analysis and Planning. Gain insights and optimize with our expert tools and resources.',
                'canonical_url' => 'https://www.ibntech.com/reporting-analysis-planning/',
            ],
            'robotics-process-automation' => [
                'meta_title' => 'Robotic Process Automation Services | IBN Technologies',
                'meta_description' => 'Enhance efficiency with IBN Tech’s RPA services. Automate tasks, reduce errors, and improve productivity with AI-driven robotic process automation.',
                'canonical_url' => 'https://www.ibntech.com/robotics-process-automation/',
            ],
            'intelligent-process-automation' => [
                'meta_title' => 'Intelligent Process Automation Services | IBN Tech',
                'meta_description' => 'Streamline workflows, automate document processes, and boost efficiency across multiple document types and industries with our Intelligent Automation Solutions.',
                'canonical_url' => 'https://www.ibntech.com/intelligent-process-automation/',
            ],
            'empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation' => [
                'meta_title' => 'Empowering Business Processes with AI, ML, and RPA-Driven Cloud Automation',
                'meta_description' => 'Discover outsourcing accounting and bookkeeping services with IBN. We streamline your finances and provide accurate, timely insights to grow your business.',
                'canonical_url' => 'https://www.ibntech.com/empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation/',
            ],
            'thank-you-brochures-download' => [
                'meta_title' => 'Thank You Brochures Download - IBN Technologies',
                'meta_description' => 'Thank you for choosing to download our brochures. Please check your email for the brochure you requested. If you don\'t see it in your inbox, please ensure to check your spam or junk folder.',
                'canonical_url' => 'https://www.ibntech.com/thank-you-brochures-download/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'custom_meta_robots' => 'nofollow, noindex, nosnippet',
                'sitemap_include' => false,
            ],
            'thank-you-download' => [
                'meta_title' => 'Thank You Download - IBN Technologies',
                'meta_description' => 'Your file download link has been sent to your email.Please check your inbox (and spam/junk folder just in case) to access the file.',
                'canonical_url' => 'https://www.ibntech.com/thank-you-download/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thank-you-free-trial' => [
                'meta_title' => 'Thank You Free Trial - IBN Technologies',
                'meta_description' => 'Thank you for signing up! Enjoy the free trial of our outsourcing service. One of our team members will get in touch with you soon, to guide you through the next steps.',
                'canonical_url' => 'https://www.ibntech.com/thank-you-free-trial/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thank-you' => [
                'meta_title' => 'Thanks You - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thank-you/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-ap-ar-management' => [
                'meta_title' => 'Thanks You For AP AR Management - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-ap-ar-management/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thank-you-for-construction-services-consultation' => [
                'meta_title' => 'Thanks You For Construction - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thank-you-for-construction-services-consultation/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-free-trail' => [
                'meta_title' => 'Thanks You For Free Trail - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-free-trail/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-ipa' => [
                'meta_title' => 'Thanks You For IPA - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-ipa/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-bookkeeping' => [
                'meta_title' => 'Thanks You For Bookkeeping - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-bookkeeping/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-cloud' => [
                'meta_title' => 'Thanks You For Cloud - IBN Technologies',
                'meta_description' => 'Thank You for Choosing IBN Technologies for Your Cloud Transformation! Empower your business with flexible, cost-effective cloud solutions for seamless growth.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-cloud/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-cybersecurity' => [
                'meta_title' => 'Thanks You For Cybersecurity - IBN Technologies',
                'meta_description' => 'Thank You for Trusting IBN Technologies with Your Cybersecurity Needs! Secure your business with trusted cybersecurity solutions for resilience and peace of mind.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-cybersecurity/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-payroll-service' => [
                'meta_title' => 'Thanks You for payroll service - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-payroll-service/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
            'thanks-you-for-tax-preparation' => [
                'meta_title' => 'Thanks You For Tax Preparation - IBN Technologies',
                'meta_description' => 'Thank you for filling out the contact form! IBN Technologies offers expert finance, accounting, payroll, and IT outsourcing solutions to empower your business.',
                'canonical_url' => 'https://www.ibntech.com/thanks-you-for-tax-preparation/',
                'robots_index' => 'noindex',
                'robots_follow' => 'nofollow',
                'sitemap_include' => false,
            ],
        ];

        foreach ($seoBySlug as $slug => $seo) {
            $page = Page::query()->where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            $payload = [
                'meta_title' => $seo['meta_title'],
                'meta_description' => $seo['meta_description'],
                'og_title' => $seo['meta_title'],
                'og_description' => $seo['meta_description'],
                'canonical_url' => $seo['canonical_url'] ?? null,
            ];

            foreach (['robots_index', 'robots_follow', 'custom_meta_robots', 'sitemap_include', 'robots_max_image_preview'] as $field) {
                if (array_key_exists($field, $seo)) {
                    $payload[$field] = $seo[$field];
                }
            }

            if (($payload['robots_index'] ?? null) === 'noindex' && ! array_key_exists('robots_max_image_preview', $payload)) {
                $payload['robots_max_image_preview'] = null;
            }

            SeoMeta::query()->updateOrCreate(
                [
                    'metable_type' => Page::class,
                    'metable_id' => $page->id,
                ],
                $payload
            );

            if (array_key_exists('robots_index', $seo)) {
                Cache::forget("page:{$slug}");
            }
        }
    }
}
