<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class WordPressPagesSeeder extends Seeder
{
    /**
     * Stage 1 infrastructure pages from WordPress export (published only).
     * Skips slugs that already exist.
     */
    public function run(): void
    {
        $pages = array (
  0 => 
  array (
    'title' => 'IT Services',
    'slug' => 'it-services',
    'template' => 'it-services',
    'status' => 'published',
  ),
  1 => 
  array (
    'title' => 'CFO Services',
    'slug' => 'cfo-services',
    'template' => 'cfo-services',
    'status' => 'published',
  ),
  2 => 
  array (
    'title' => 'Back And Middle Office Services',
    'slug' => 'back-and-middle-office-services',
    'template' => 'back-and-middle-office-services',
    'status' => 'published',
  ),
  3 => 
  array (
    'title' => 'Family Office Services',
    'slug' => 'family-office-services',
    'template' => 'family-office-services',
    'status' => 'published',
  ),
  4 => 
  array (
    'title' => 'Hedgefund Administration',
    'slug' => 'hedgefund-administration',
    'template' => 'hedgefund-administration',
    'status' => 'published',
  ),
  5 => 
  array (
    'title' => 'Fund Investor Reporting',
    'slug' => 'fund-investor-reporting',
    'template' => 'fund-investor-reporting',
    'status' => 'published',
  ),
  6 => 
  array (
    'title' => 'Treasury Management Services Outsourcing',
    'slug' => 'treasury-management-services-outsourcing',
    'template' => 'treasury-management-services-outsourcing',
    'status' => 'published',
  ),
  7 => 
  array (
    'title' => 'Travel Bpo Outsourcing Services',
    'slug' => 'travel-bpo-outsourcing-services',
    'template' => 'travel-bpo-outsourcing-services',
    'status' => 'published',
  ),
  8 => 
  array (
    'title' => 'Retail',
    'slug' => 'retail',
    'template' => 'retail',
    'status' => 'published',
  ),
  9 => 
  array (
    'title' => 'Hospitality',
    'slug' => 'hospitality',
    'template' => 'hospitality',
    'status' => 'published',
  ),
  10 => 
  array (
    'title' => 'Recruitment Firms',
    'slug' => 'recruitment-firms',
    'template' => 'recruitment-firms',
    'status' => 'published',
  ),
  11 => 
  array (
    'title' => 'Transport and Logistics Services',
    'slug' => 'transport-and-logistics',
    'template' => 'transport-and-logistics',
    'status' => 'published',
  ),
  12 => 
  array (
    'title' => 'Multi Location Business',
    'slug' => 'multi-location-business',
    'template' => 'multi-location-business',
    'status' => 'published',
  ),
  13 => 
  array (
    'title' => 'Telecommunication Outsourcing Services',
    'slug' => 'telecommunication-outsourcing-services',
    'template' => 'telecommunication-outsourcing-services',
    'status' => 'published',
  ),
  14 => 
  array (
    'title' => 'Mortgage',
    'slug' => 'mortgage',
    'template' => 'mortgage',
    'status' => 'published',
  ),
  15 => 
  array (
    'title' => 'Infrastructure',
    'slug' => 'infrastructure',
    'template' => 'infrastructure',
    'status' => 'published',
  ),
  16 => 
  array (
    'title' => 'Transition Methodology',
    'slug' => 'bpotransition-methodology',
    'template' => 'bpotransition-methodology',
    'status' => 'published',
  ),
  17 => 
  array (
    'title' => 'Press release',
    'slug' => 'pressrelease',
    'template' => 'pressrelease',
    'status' => 'published',
  ),
  18 => 
  array (
    'title' => 'Testimonials',
    'slug' => 'testimonials',
    'template' => 'testimonials',
    'status' => 'published',
  ),
  19 => 
  array (
    'title' => 'White Papers',
    'slug' => 'whitepapers',
    'template' => 'whitepapers',
    'status' => 'published',
  ),
  20 => 
  array (
    'title' => 'Business Partner',
    'slug' => 'business-partner',
    'template' => 'business-partner',
    'status' => 'published',
  ),
  21 => 
  array (
    'title' => 'Microsoft Certified Partners',
    'slug' => 'microsoft-certified-partners',
    'template' => 'microsoft-certified-partners',
    'status' => 'published',
  ),
  22 => 
  array (
    'title' => 'Faq',
    'slug' => 'faq',
    'template' => 'faq',
    'status' => 'published',
  ),
  23 => 
  array (
    'title' => 'Technology Solutions',
    'slug' => 'technology-solutions',
    'template' => 'technology-solutions',
    'status' => 'published',
  ),
  24 => 
  array (
    'title' => 'Tech Support Services',
    'slug' => 'tech-support-services',
    'template' => 'tech-support-services',
    'status' => 'published',
  ),
  25 => 
  array (
    'title' => 'Microsoft Dynamics Nav',
    'slug' => 'microsoft-dynamics-nav',
    'template' => 'microsoft-dynamics-nav',
    'status' => 'published',
  ),
  26 => 
  array (
    'title' => 'Finance Management',
    'slug' => 'finance-management',
    'template' => 'finance-management',
    'status' => 'published',
  ),
  27 => 
  array (
    'title' => 'Project Management',
    'slug' => 'project-management',
    'template' => 'project-management',
    'status' => 'published',
  ),
  28 => 
  array (
    'title' => 'Sales Marketing And Service Management',
    'slug' => 'sales-marketing-and-service-management',
    'template' => 'sales-marketing-and-service-management',
    'status' => 'published',
  ),
  29 => 
  array (
    'title' => 'Business Intelligence And Reporting',
    'slug' => 'business-intelligence-and-reporting',
    'template' => 'business-intelligence-and-reporting',
    'status' => 'published',
  ),
  30 => 
  array (
    'title' => 'Supply Chain Management Manufacturing',
    'slug' => 'supply-chain-management-manufacturing',
    'template' => 'supply-chain-management-manufacturing',
    'status' => 'published',
  ),
  31 => 
  array (
    'title' => 'Human Resources Management Hrm',
    'slug' => 'human-resources-management-hrm',
    'template' => 'human-resources-management-hrm',
    'status' => 'published',
  ),
  32 => 
  array (
    'title' => 'Accounting System And Integration',
    'slug' => 'accounting-system-and-integration',
    'template' => 'accounting-system-and-integration',
    'status' => 'published',
  ),
  33 => 
  array (
    'title' => 'Current job opening',
    'slug' => 'current-job-opening',
    'template' => 'current-job-opening',
    'status' => 'published',
  ),
  34 => 
  array (
    'title' => 'Kpo Services',
    'slug' => 'kpo-services',
    'template' => 'kpo-services',
    'status' => 'published',
  ),
  35 => 
  array (
    'title' => 'Bpo Services',
    'slug' => 'bpo-services',
    'template' => 'bpo-services',
    'status' => 'published',
  ),
  36 => 
  array (
    'title' => 'White Paper 2',
    'slug' => 'white-paper-2',
    'template' => 'white-paper-2',
    'status' => 'published',
  ),
  37 => 
  array (
    'title' => 'White Paper 3',
    'slug' => 'white-paper-3',
    'template' => 'white-paper-3',
    'status' => 'published',
  ),
  38 => 
  array (
    'title' => 'Bookkeeping Services Hartford',
    'slug' => 'bookkeeping-services-hartford',
    'template' => 'bookkeeping-services-hartford',
    'status' => 'published',
  ),
  39 => 
  array (
    'title' => 'Bookkeeping Services Los Angeles',
    'slug' => 'bookkeeping-services-los-angeles',
    'template' => 'bookkeeping-services-los-angeles',
    'status' => 'published',
  ),
  40 => 
  array (
    'title' => 'Bookkeeping Services San Diego',
    'slug' => 'bookkeeping-services-san-diego',
    'template' => 'bookkeeping-services-san-diego',
    'status' => 'published',
  ),
  41 => 
  array (
    'title' => 'Bookkeeping Services San Jose',
    'slug' => 'bookkeeping-services-san-jose',
    'template' => 'bookkeeping-services-san-jose',
    'status' => 'published',
  ),
  42 => 
  array (
    'title' => 'Bookkeeping Services Austin',
    'slug' => 'bookkeeping-services-austin',
    'template' => 'bookkeeping-services-austin',
    'status' => 'published',
  ),
  43 => 
  array (
    'title' => 'Bookkeeping Services San Francisco',
    'slug' => 'bookkeeping-services-san-francisco',
    'template' => 'bookkeeping-services-san-francisco',
    'status' => 'published',
  ),
  44 => 
  array (
    'title' => 'Healthcare Bookkeeping Services',
    'slug' => 'healthcare-bookkeeping-services',
    'template' => 'healthcare-bookkeeping-services',
    'status' => 'published',
  ),
  45 => 
  array (
    'title' => 'Virtual Cfo Services',
    'slug' => 'virtual-cfo-services',
    'template' => 'virtual-cfo-services',
    'status' => 'published',
  ),
  46 => 
  array (
    'title' => 'Back Offices Services',
    'slug' => 'back-offices-services',
    'template' => 'back-offices-services',
    'status' => 'published',
  ),
  47 => 
  array (
    'title' => 'Fund Accounting Services',
    'slug' => 'fund-accounting-services',
    'template' => 'fund-accounting-services',
    'status' => 'published',
  ),
  48 => 
  array (
    'title' => 'Privacy Policy - IBN Technologies Ltd',
    'slug' => 'privacy-policy',
    'template' => 'privacy-policy',
    'status' => 'published',
  ),
  49 => 
  array (
    'title' => 'General Terms & Conditions',
    'slug' => 'terms-of-use',
    'template' => 'terms-of-use',
    'status' => 'published',
  ),
  50 => 
  array (
    'title' => 'Data Processing',
    'slug' => 'data-processing',
    'template' => 'data-processing',
    'status' => 'published',
  ),
  51 => 
  array (
    'title' => 'Bookkeeping For Us',
    'slug' => 'bookkeeping-for-us',
    'template' => 'bookkeeping-for-us',
    'status' => 'published',
  ),
  52 => 
  array (
    'title' => 'Bookkeeping Service Restaurants',
    'slug' => 'bookkeeping-service-restaurants',
    'template' => 'bookkeeping-service-restaurants',
    'status' => 'published',
  ),
  53 => 
  array (
    'title' => 'Bookkeeping For Large Organisation',
    'slug' => 'bookkeeping-for-large-organisation',
    'template' => 'bookkeeping-for-large-organisation',
    'status' => 'published',
  ),
  54 => 
  array (
    'title' => 'Bookkeeping For Small Business',
    'slug' => 'bookkeeping-for-small-business',
    'template' => 'bookkeeping-for-small-business',
    'status' => 'published',
  ),
  55 => 
  array (
    'title' => 'outsourced-bookkeeping-services-USA',
    'slug' => 'outsourced-bookkeeping-services-usa',
    'template' => 'outsourced-bookkeeping-services-usa',
    'status' => 'published',
  ),
  56 => 
  array (
    'title' => 'Bookkeeping Services For Small Businesses',
    'slug' => 'bookkeeping-services-for-small-businesses',
    'template' => 'bookkeeping-services-for-small-businesses',
    'status' => 'published',
  ),
  57 => 
  array (
    'title' => 'Bookkeeping Services for Restaurants',
    'slug' => 'restaurants-bookkeeping-services',
    'template' => 'restaurants-bookkeeping-services',
    'status' => 'published',
  ),
  58 => 
  array (
    'title' => 'Bookkeeping Services for Retail Stores',
    'slug' => 'bookkeeping-services-for-retail-stores',
    'template' => 'bookkeeping-services-for-retail-stores',
    'status' => 'published',
  ),
  59 => 
  array (
    'title' => 'Assistance To Cfo Services',
    'slug' => 'assistant-to-cfo-services',
    'template' => 'assistant-to-cfo-services',
    'status' => 'published',
  ),
  60 => 
  array (
    'title' => 'Bookkeeping for Marketing and Advertising Companies',
    'slug' => 'marketing-and-advertising-bookkeeping-services',
    'template' => 'marketing-and-advertising-bookkeeping-services',
    'status' => 'published',
  ),
  61 => 
  array (
    'title' => 'Bookkeeping for Food and Beverage Companies',
    'slug' => 'food-and-beverage-bookkeeping-services',
    'template' => 'food-and-beverage-bookkeeping-services',
    'status' => 'published',
  ),
  62 => 
  array (
    'title' => 'Bookkeeping for Legal Services',
    'slug' => 'legal-bookkeeping-services',
    'template' => 'legal-bookkeeping-services',
    'status' => 'published',
  ),
  63 => 
  array (
    'title' => 'Bookkeeping for Finance Businesses',
    'slug' => 'finance-businesses-bookkeeping-service',
    'template' => 'finance-businesses-bookkeeping-service',
    'status' => 'published',
  ),
  64 => 
  array (
    'title' => 'Bookkeeping for IT Businesses',
    'slug' => 'it-business-bookkeeping-service',
    'template' => 'it-business-bookkeeping-service',
    'status' => 'published',
  ),
  65 => 
  array (
    'title' => 'Data Migration',
    'slug' => 'data-migration-services',
    'template' => 'data-migration-services',
    'status' => 'published',
  ),
  66 => 
  array (
    'title' => 'Database Consulting',
    'slug' => 'database-consulting',
    'template' => 'database-consulting',
    'status' => 'published',
  ),
  67 => 
  array (
    'title' => 'Database Monitoring and Support',
    'slug' => 'database-monitoring-and-support',
    'template' => 'database-monitoring-and-support',
    'status' => 'published',
  ),
  68 => 
  array (
    'title' => 'Database Performance Tuning',
    'slug' => 'database-performance-tuning',
    'template' => 'database-performance-tuning',
    'status' => 'published',
  ),
  69 => 
  array (
    'title' => 'API Testing',
    'slug' => 'api-testing',
    'template' => 'api-testing',
    'status' => 'published',
  ),
  70 => 
  array (
    'title' => 'Quote to Cash',
    'slug' => 'quote-to-cash',
    'template' => 'quote-to-cash',
    'status' => 'published',
  ),
  71 => 
  array (
    'title' => 'Cyber Security Testing',
    'slug' => 'cyber-security-testing',
    'template' => 'cyber-security-testing',
    'status' => 'published',
  ),
  72 => 
  array (
    'title' => 'Functional Testing',
    'slug' => 'functional-testing',
    'template' => 'functional-testing',
    'status' => 'published',
  ),
  73 => 
  array (
    'title' => 'Order to Cash',
    'slug' => 'order-to-cash',
    'template' => 'order-to-cash',
    'status' => 'published',
  ),
  74 => 
  array (
    'title' => 'Thank You Brochures Download',
    'slug' => 'thank-you-brochures-download',
    'template' => 'thank-you-brochures-download',
    'status' => 'published',
  ),
  75 => 
  array (
    'title' => 'Record To Report',
    'slug' => 'record-to-report',
    'template' => 'record-to-report',
    'status' => 'published',
  ),
  76 => 
  array (
    'title' => 'Virtual DBA Services',
    'slug' => 'virtual-dba-services',
    'template' => 'virtual-dba-services',
    'status' => 'published',
  ),
  77 => 
  array (
    'title' => 'IT Staff Sourcing',
    'slug' => 'it-staff-sourcing',
    'template' => 'it-staff-sourcing',
    'status' => 'published',
  ),
  78 => 
  array (
    'title' => 'Mobile App Testing',
    'slug' => 'mobile-app-testing',
    'template' => 'mobile-app-testing',
    'status' => 'published',
  ),
  79 => 
  array (
    'title' => 'Performance Testing',
    'slug' => 'performance-testing',
    'template' => 'performance-testing',
    'status' => 'published',
  ),
  80 => 
  array (
    'title' => 'Security Testing',
    'slug' => 'security-testing',
    'template' => 'security-testing',
    'status' => 'published',
  ),
  81 => 
  array (
    'title' => 'SEO Testing',
    'slug' => 'seo-testing',
    'template' => 'seo-testing',
    'status' => 'published',
  ),
  82 => 
  array (
    'title' => 'Sharepoint',
    'slug' => 'sharepoint',
    'template' => 'sharepoint',
    'status' => 'published',
  ),
  83 => 
  array (
    'title' => 'Test Automation',
    'slug' => 'test-automation',
    'template' => 'test-automation',
    'status' => 'published',
  ),
  84 => 
  array (
    'title' => 'Record to Report CFO',
    'slug' => 'record-to-report-cfo',
    'template' => 'record-to-report-cfo',
    'status' => 'published',
  ),
  85 => 
  array (
    'title' => 'Reporting Analysis Planning',
    'slug' => 'reporting-analysis-planning',
    'template' => 'reporting-analysis-planning',
    'status' => 'published',
  ),
  86 => 
  array (
    'title' => 'Data Conversion',
    'slug' => 'data-conversion',
    'template' => 'data-conversion',
    'status' => 'published',
  ),
  87 => 
  array (
    'title' => 'Data Entry',
    'slug' => 'data-entry',
    'template' => 'data-entry',
    'status' => 'published',
  ),
  88 => 
  array (
    'title' => 'Record Management',
    'slug' => 'record-management',
    'template' => 'record-management',
    'status' => 'published',
  ),
  89 => 
  array (
    'title' => 'Thank You Free Trial',
    'slug' => 'thank-you-free-trial',
    'template' => 'thank-you-free-trial',
    'status' => 'published',
  ),
  90 => 
  array (
    'title' => 'Treasury Management',
    'slug' => 'treasury-management',
    'template' => 'treasury-management',
    'status' => 'published',
  ),
  91 => 
  array (
    'title' => 'Outsourcing',
    'slug' => 'outsourcing',
    'template' => 'outsourcing',
    'status' => 'published',
  ),
  92 => 
  array (
    'title' => 'Ebooks',
    'slug' => 'ebook',
    'template' => 'ebook',
    'status' => 'published',
  ),
  93 => 
  array (
    'title' => 'Intelligent Process Automation',
    'slug' => 'intelligent-process-automation',
    'template' => 'intelligent-process-automation',
    'status' => 'published',
  ),
  94 => 
  array (
    'title' => 'IBN Team',
    'slug' => 'ibn-team',
    'template' => 'ibn-team',
    'status' => 'published',
  ),
  95 => 
  array (
    'title' => 'Thanks You',
    'slug' => 'thank-you',
    'template' => 'thank-you',
    'status' => 'published',
  ),
  96 => 
  array (
    'title' => 'Hedge Fund Services',
    'slug' => 'hedge-fund-services',
    'template' => 'hedge-fund-services',
    'status' => 'published',
  ),
  97 => 
  array (
    'title' => 'CPA Outsourcing',
    'slug' => 'cpa-outsourcing',
    'template' => 'cpa-outsourcing',
    'status' => 'published',
  ),
  98 => 
  array (
    'title' => 'Payroll Processing old',
    'slug' => 'payroll-processing-old',
    'template' => 'payroll-processing-old',
    'status' => 'published',
  ),
  99 => 
  array (
    'title' => 'Bookkeeping Services Vermont',
    'slug' => 'bookkeeping-services-vermont',
    'template' => 'bookkeeping-services-vermont',
    'status' => 'published',
  ),
  100 => 
  array (
    'title' => 'Bookkeeping Services  Las Vegas',
    'slug' => 'bookkeeping-services-las-vegas',
    'template' => 'bookkeeping-services-las-vegas',
    'status' => 'published',
  ),
  101 => 
  array (
    'title' => 'Bookkeeping Services Chicago',
    'slug' => 'bookkeeping-services-chicago',
    'template' => 'bookkeeping-services-chicago',
    'status' => 'published',
  ),
  102 => 
  array (
    'title' => 'About IBN',
    'slug' => 'about-ibn',
    'template' => 'about-ibn',
    'status' => 'published',
  ),
  103 => 
  array (
    'title' => 'Bookkeeping Services Phoenix',
    'slug' => 'bookkeeping-services-phoenix',
    'template' => 'bookkeeping-services-phoenix',
    'status' => 'published',
  ),
  104 => 
  array (
    'title' => 'Bookkeeping Services UK',
    'slug' => 'bookeeping-for-uk',
    'template' => 'bookeeping-for-uk',
    'status' => 'published',
  ),
  105 => 
  array (
    'title' => 'Ecommerce Bookkeeping Services',
    'slug' => 'ecommerce-bookkeeping-services',
    'template' => 'ecommerce-bookkeeping-services',
    'status' => 'published',
  ),
  106 => 
  array (
    'title' => 'Bookkeeping for Real Estate and Construction Businesses',
    'slug' => 'real-estate-construction-bookkeeping-services',
    'template' => 'real-estate-construction-bookkeeping-services',
    'status' => 'published',
  ),
  107 => 
  array (
    'title' => 'Invoice Process Automation',
    'slug' => 'invoice-process-automation',
    'template' => 'invoice-process-automation',
    'status' => 'published',
  ),
  108 => 
  array (
    'title' => 'Manufacturing Accounting and Bookkeeping Services',
    'slug' => 'manufacturing-accounting-and-bookkeeping-services',
    'template' => 'manufacturing-accounting-and-bookkeeping-services',
    'status' => 'published',
  ),
  109 => 
  array (
    'title' => 'Sales Order Processing',
    'slug' => 'sales-order-processing',
    'template' => 'sales-order-processing',
    'status' => 'published',
  ),
  110 => 
  array (
    'title' => 'Medical Claim Automation',
    'slug' => 'medical-claim-automation',
    'template' => 'medical-claim-automation',
    'status' => 'published',
  ),
  111 => 
  array (
    'title' => 'Electronic Funds Transfer',
    'slug' => 'electronic-funds-transfer',
    'template' => 'electronic-funds-transfer',
    'status' => 'published',
  ),
  112 => 
  array (
    'title' => 'Contact Us',
    'slug' => 'contact-us',
    'template' => 'contact-us',
    'status' => 'published',
  ),
  113 => 
  array (
    'title' => 'Hedge Fund Accounting',
    'slug' => 'hedge-fund-accounting',
    'template' => 'hedge-fund-accounting',
    'status' => 'published',
  ),
  114 => 
  array (
    'title' => 'Empowering Business Processes with AI, ML, and RPA-Driven Cloud Automation',
    'slug' => 'empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation',
    'template' => 'empowering-business-processes-with-ai-ml-and-rpa-driven-cloud-automation',
    'status' => 'published',
  ),
  115 => 
  array (
    'title' => 'Outsource Construction Engineering Services',
    'slug' => 'real-estate-and-construction-engineering-services',
    'template' => 'real-estate-and-construction-engineering-services',
    'status' => 'published',
  ),
  116 => 
  array (
    'title' => 'Bookkeeping Services  California',
    'slug' => 'bookkeeping-services-california',
    'template' => 'bookkeeping-services-california',
    'status' => 'published',
  ),
  117 => 
  array (
    'title' => 'Bookkeeping Services New York',
    'slug' => 'bookkeeping-services-new-york',
    'template' => 'bookkeeping-services-new-york',
    'status' => 'published',
  ),
  118 => 
  array (
    'title' => 'Thank You Download',
    'slug' => 'thank-you-download',
    'template' => 'thank-you-download',
    'status' => 'published',
  ),
  119 => 
  array (
    'title' => 'Bookkeeping Services Florida',
    'slug' => 'bookkeeping-services-florida',
    'template' => 'bookkeeping-services-florida',
    'status' => 'published',
  ),
  120 => 
  array (
    'title' => 'Boost your business with Accounting offers',
    'slug' => 'boost-your-business-with-accounting-offers',
    'template' => 'boost-your-business-with-accounting-offers',
    'status' => 'published',
  ),
  121 => 
  array (
    'title' => 'Bookkeeping Services Usa',
    'slug' => 'bookkeeping-services-usa',
    'template' => 'bookkeeping-services-usa',
    'status' => 'published',
  ),
  122 => 
  array (
    'title' => 'Hospitality Bookkeeping And Accounting Services',
    'slug' => 'hospitality-bookkeeping-and-accounting-services',
    'template' => 'hospitality-bookkeeping-and-accounting-services',
    'status' => 'published',
  ),
  123 => 
  array (
    'title' => 'Travel Bookkeeping Service',
    'slug' => 'travel-bookkeeping-service',
    'template' => 'travel-bookkeeping-service',
    'status' => 'published',
  ),
  124 => 
  array (
    'title' => 'Salesforce',
    'slug' => 'salesforce',
    'template' => 'salesforce',
    'status' => 'published',
  ),
  125 => 
  array (
    'title' => 'Bookkeeping Services Texas',
    'slug' => 'bookkeeping-services-texas',
    'template' => 'bookkeeping-services-texas',
    'status' => 'published',
  ),
  126 => 
  array (
    'title' => 'Article',
    'slug' => 'article',
    'template' => 'article',
    'status' => 'published',
  ),
  127 => 
  array (
    'title' => 'Robotic Process Automation(RPA) Services',
    'slug' => 'robotics-process-automation',
    'template' => 'robotics-process-automation',
    'status' => 'published',
  ),
  128 => 
  array (
    'title' => 'Finance and Accounting Services',
    'slug' => 'finance-and-accounting-services',
    'template' => 'finance-and-accounting-services',
    'status' => 'published',
  ),
  129 => 
  array (
    'title' => 'USA & UK Tax Preparation Services',
    'slug' => 'us-uk-tax-preparation-services',
    'template' => 'us-uk-tax-preparation-services',
    'status' => 'published',
  ),
  130 => 
  array (
    'title' => 'Procure to pay solution',
    'slug' => 'procure-to-pay',
    'template' => 'procure-to-pay',
    'status' => 'published',
  ),
  131 => 
  array (
    'title' => 'Accounting Services for Small Business',
    'slug' => 'accounting-services-for-small-business',
    'template' => 'accounting-services-for-small-business',
    'status' => 'published',
  ),
  132 => 
  array (
    'title' => 'Pricing',
    'slug' => 'pricing',
    'template' => 'pricing',
    'status' => 'published',
  ),
  133 => 
  array (
    'title' => 'Free Consultation For Bookkeeping',
    'slug' => 'free-consultation-for-bookkeeping',
    'template' => 'free-consultation-for-bookkeeping',
    'status' => 'published',
  ),
  134 => 
  array (
    'title' => 'Free Consultation For Payroll Service',
    'slug' => 'free-consultation-for-payroll-service',
    'template' => 'free-consultation-for-payroll-service',
    'status' => 'published',
  ),
  135 => 
  array (
    'title' => 'Free Consultation For Tax Return Preparation',
    'slug' => 'free-consultation-for-tax-return',
    'template' => 'free-consultation-for-tax-return',
    'status' => 'published',
  ),
  136 => 
  array (
    'title' => 'Free Consultation For AP AR Management',
    'slug' => 'free-consultation-for-ap-ar-management',
    'template' => 'free-consultation-for-ap-ar-management',
    'status' => 'published',
  ),
  137 => 
  array (
    'title' => 'Free Consultation For IPA',
    'slug' => 'free-consultation-for-ipa',
    'template' => 'free-consultation-for-ipa',
    'status' => 'published',
  ),
  138 => 
  array (
    'title' => 'Thanks You For Bookkeeping',
    'slug' => 'thanks-you-for-bookkeeping',
    'template' => 'thanks-you-for-bookkeeping',
    'status' => 'published',
  ),
  139 => 
  array (
    'title' => 'Thanks You for payroll service',
    'slug' => 'thanks-you-for-payroll-service',
    'template' => 'thanks-you-for-payroll-service',
    'status' => 'published',
  ),
  140 => 
  array (
    'title' => 'Thanks You  For AP AR Management',
    'slug' => 'thanks-you-for-ap-ar-management',
    'template' => 'thanks-you-for-ap-ar-management',
    'status' => 'published',
  ),
  141 => 
  array (
    'title' => 'Thanks You For Tax Preparation',
    'slug' => 'thanks-you-for-tax-preparation',
    'template' => 'thanks-you-for-tax-preparation',
    'status' => 'published',
  ),
  142 => 
  array (
    'title' => 'Thanks You  For IPA',
    'slug' => 'thanks-you-for-ipa',
    'template' => 'thanks-you-for-ipa',
    'status' => 'published',
  ),
  143 => 
  array (
    'title' => 'Free Trial',
    'slug' => 'free-trial',
    'template' => 'free-trial',
    'status' => 'published',
  ),
  144 => 
  array (
    'title' => 'Thanks You  For Free Trail',
    'slug' => 'thanks-you-for-free-trail',
    'template' => 'thanks-you-for-free-trail',
    'status' => 'published',
  ),
  145 => 
  array (
    'title' => 'Free Consultation',
    'slug' => 'free-consultation',
    'template' => 'free-consultation',
    'status' => 'published',
  ),
  146 => 
  array (
    'title' => 'Bookkeeping Services',
    'slug' => 'bookkeeping-services',
    'template' => 'bookkeeping-services',
    'status' => 'published',
  ),
  147 => 
  array (
    'title' => 'Payroll Services',
    'slug' => 'payroll-processing',
    'template' => 'payroll-processing',
    'status' => 'published',
  ),
  148 => 
  array (
    'title' => 'Expert Bookkeeping to Fuel Your Business Growth Landing Page',
    'slug' => 'outsourced-bookkeeping',
    'template' => 'outsourced-bookkeeping',
    'status' => 'published',
  ),
  149 => 
  array (
    'title' => 'Accounts Payable and Receivable Automation',
    'slug' => 'ap-ar-automation',
    'template' => 'ap-ar-automation',
    'status' => 'published',
  ),
  150 => 
  array (
    'title' => 'Accounts Payable and Receivable Services Update page',
    'slug' => 'accounts-payable-and-accounts-receivable-services',
    'template' => 'accounts-payable-and-accounts-receivable-services',
    'status' => 'published',
  ),
  151 => 
  array (
    'title' => 'Free Consultation For Construction',
    'slug' => 'free-consultation-for-construction',
    'template' => 'free-consultation-for-construction',
    'status' => 'published',
  ),
  152 => 
  array (
    'title' => 'Thanks You  For Construction',
    'slug' => 'thank-you-for-construction-services-consultation',
    'template' => 'thank-you-for-construction-services-consultation',
    'status' => 'published',
  ),
  153 => 
  array (
    'title' => 'Tax Preparation Services USA',
    'slug' => 'tax-preparation-services-usa',
    'template' => 'tax-preparation-services-usa',
    'status' => 'published',
  ),
  154 => 
  array (
    'title' => 'Managed SIEM SOC Services',
    'slug' => 'managed-siem-soc-services',
    'template' => 'managed-siem-soc-services',
    'status' => 'published',
  ),
  155 => 
  array (
    'title' => 'vCISO Services',
    'slug' => 'vciso-services',
    'template' => 'vciso-services',
    'status' => 'published',
  ),
  156 => 
  array (
    'title' => 'Managed Detection Response Services',
    'slug' => 'managed-detection-response-services',
    'template' => 'managed-detection-response-services',
    'status' => 'published',
  ),
  157 => 
  array (
    'title' => 'Cybersecurity Audit Compliance Services',
    'slug' => 'cybersecurity-audit-compliance-services',
    'template' => 'cybersecurity-audit-compliance-services',
    'status' => 'published',
  ),
  158 => 
  array (
    'title' => 'Cybersecurity Maturity Assessment Services',
    'slug' => 'cybersecurity-maturity-assessment-services',
    'template' => 'cybersecurity-maturity-assessment-services',
    'status' => 'published',
  ),
  159 => 
  array (
    'title' => 'Microsoft Security Services',
    'slug' => 'microsoft-security-services',
    'template' => 'microsoft-security-services',
    'status' => 'published',
  ),
  160 => 
  array (
    'title' => 'DevSecOps Services',
    'slug' => 'devsecops-services',
    'template' => 'devsecops-services',
    'status' => 'published',
  ),
  161 => 
  array (
    'title' => 'Microsoft Office 365 Migration Support Services',
    'slug' => 'microsoft-office-365-migration-support-services',
    'template' => 'microsoft-office-365-migration-support-services',
    'status' => 'published',
  ),
  162 => 
  array (
    'title' => 'Business Continuity Disaster Recovery Services',
    'slug' => 'business-continuity-disaster-recovery-services',
    'template' => 'business-continuity-disaster-recovery-services',
    'status' => 'published',
  ),
  163 => 
  array (
    'title' => 'Cloud Managed Services',
    'slug' => 'cloud-managed-services',
    'template' => 'cloud-managed-services',
    'status' => 'published',
  ),
  164 => 
  array (
    'title' => 'Cloud Consulting And Migration Services',
    'slug' => 'cloud-consulting-and-migration-services',
    'template' => 'cloud-consulting-and-migration-services',
    'status' => 'published',
  ),
  165 => 
  array (
    'title' => 'Construction Takeoff Estimation Services',
    'slug' => 'construction-takeoff-estimation-services',
    'template' => 'construction-takeoff-estimation-services',
    'status' => 'published',
  ),
  166 => 
  array (
    'title' => 'Construction Documentation Services',
    'slug' => 'construction-documentation-services',
    'template' => 'construction-documentation-services',
    'status' => 'published',
  ),
  167 => 
  array (
    'title' => 'Civil Engineering Services',
    'slug' => 'civil-engineering-services',
    'template' => 'civil-engineering-services',
    'status' => 'published',
  ),
  168 => 
  array (
    'title' => 'Thanks You For Cybersecurity',
    'slug' => 'thanks-you-for-cybersecurity',
    'template' => 'thanks-you-for-cybersecurity',
    'status' => 'published',
  ),
  169 => 
  array (
    'title' => 'Thanks You For Cloud',
    'slug' => 'thanks-you-for-cloud',
    'template' => 'thanks-you-for-cloud',
    'status' => 'published',
  ),
  170 => 
  array (
    'title' => 'Free Consultation For Cybersecurity',
    'slug' => 'free-consultation-for-cybersecurity',
    'template' => 'free-consultation-for-cybersecurity',
    'status' => 'published',
  ),
  171 => 
  array (
    'title' => 'Free Consultation For Cloud',
    'slug' => 'free-consultation-for-cloud',
    'template' => 'free-consultation-for-cloud',
    'status' => 'published',
  ),
  172 => 
  array (
    'title' => 'Tax Preparation Services UK',
    'slug' => 'tax-preparation-services-uk',
    'template' => 'tax-preparation-services-uk',
    'status' => 'published',
  ),
  173 => 
  array (
    'title' => 'Cookies Policy',
    'slug' => 'cookies-policy',
    'template' => 'cookies-policy',
    'status' => 'published',
  ),
  174 => 
  array (
    'title' => 'AWS Cloud Services',
    'slug' => 'aws-cloud-services',
    'template' => 'aws-cloud-services',
    'status' => 'published',
  ),
  175 => 
  array (
    'title' => 'AWS Partner',
    'slug' => 'aws-partner',
    'template' => 'aws-partner',
    'status' => 'published',
  ),
  176 => 
  array (
    'title' => '1040 Tax Filing',
    'slug' => '1040-tax-filing',
    'template' => '1040-tax-filing',
    'status' => 'published',
  ),
  177 => 
  array (
    'title' => 'AI Consulting Services',
    'slug' => 'ai-consulting-services',
    'template' => 'ai-consulting-services',
    'status' => 'published',
  ),
  178 => 
  array (
    'title' => 'Agentic AI Services',
    'slug' => 'agentic-ai-services',
    'template' => 'agentic-ai-services',
    'status' => 'published',
  ),
  179 => 
  array (
    'title' => 'AI Development Services',
    'slug' => 'ai-development-services',
    'template' => 'ai-development-services',
    'status' => 'published',
  ),
  180 => 
  array (
    'title' => 'SAP Services',
    'slug' => 'sap-services',
    'template' => 'sap-services',
    'status' => 'published',
  ),
  181 => 
  array (
    'title' => 'SOC 2 Type 2',
    'slug' => 'soc-2-compliance',
    'template' => 'soc-2-compliance',
    'status' => 'published',
  ),
);

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
            'bpotransition-methodology' => [
                'meta_title' => 'Transition Methodology Services | IBN Technologies',
                'meta_description' => 'Discover IBN’s Transition Methodology Services for BPO/KPO. Ensure smooth knowledge transfer, planning, and execution for successful outsourcing transitions.',
                'canonical_url' => 'https://www.ibntech.com/bpotransition-methodology/',
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
            'family-office-services' => [
                'meta_title' => 'IBNTech: Your Family Office Outsourcing Services Partner',
                'meta_description' => 'Maximize investment value with IBN’s Family Office Outsourcing Services. Strengthen operations and gain strategic support for long-term financial growth.',
                'canonical_url' => 'https://www.ibntech.com/family-office-services/',
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
        ];

        foreach ($seoBySlug as $slug => $seo) {
            $page = Page::query()->where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            SeoMeta::query()->updateOrCreate(
                [
                    'metable_type' => Page::class,
                    'metable_id' => $page->id,
                ],
                [
                    'meta_title' => $seo['meta_title'],
                    'meta_description' => $seo['meta_description'],
                    'og_title' => $seo['meta_title'],
                    'og_description' => $seo['meta_description'],
                    'canonical_url' => $seo['canonical_url'] ?? null,
                ]
            );
        }
    }
}
