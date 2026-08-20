@php
    $img = fn (string $file): string => asset('images/finance-management/'.$file);

    $generalItems = [
        [
            'title' => 'Accounts Schedules',
            'open' => true,
            'body' => [
                'Powerful financial reporting tool that can help accountants and financial analysts to extract the most essential business data from the chart of accounts, budgets, cash flow accounts and cost types into financial reports, which can be used to efficiently monitor the health of the business and provide valuable input for the business decision makers. You get to choose the accounts you want to monitor and report on, change the order of the accounts, and combine figures in various ways, set up which columns to print, change the description of the accounts and supply them with additional notes. In addition, you can make simple calculations on the data you selected on the accounts schedules worksheet, and compare current figures with historical ones and with your budgets.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Allocations',
            'open' => false,
            'body' => [
                'Allocate general ledger entries to combinations of accounts, departments, and projects using allocation keys based on amount, percentage, or quantity. This feature is available through Recurring General Journals.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Basic General Ledger',
            'open' => false,
            'body' => [
                'This module includes all the basic functionality necessary for setting up a company and posting to the general ledger, chart of accounts, general journals, VAT facilities, recurring journals, and source codes. Also includes:',
            ],
            'list' => [
                'Facilities for internal and external reporting.',
                'RapidStart Services for Microsoft Dynamics NAV',
                'Workflow for approval of sales and purchase documents.',
                'Posting and reporting in your companys base currency.',
                'Posting and reporting in an additional currency with the addition of the Multiple Currencies module.',
                'Employee ledger entries: post general journal line with “Employee” as account type or balancing account type will generate an employee ledger entry.',
                'Capability to export data from any form to Microsoft Word or Microsoft Excel using style sheets. > Capability to link to external documents.',
                'Two languages—U.S. English and one other.',
                'Set up sales and purchase documents archiving. > Background posting.',
            ],
        ],
        [
            'title' => 'Basic XBRL',
            'open' => false,
            'body' => [
                'Export documents from Microsoft Dynamics NAV in XBRL (Extensible Business Reporting Language) format and import XBRL taxonomies into Microsoft Dynamics NAV from the Internet, email, or other systems. XBRL is an XML-based specification that uses accepted financial reporting standards based on standardized, underlying data tags.',
                'The module includes:',
            ],
            'list' => [
                'Capability to map your general ledger to XBRL taxonomies so that the same XBRL document instance can be used for various purposes, independent of the format required by the receiver of the document.',
                'Support for the XBRL 2.1 Specification released by the XBRL Consortium.',
            ],
        ],
        [
            'title' => 'Budgets',
            'open' => false,
            'body' => [
                'Work with budgets in general ledger accounts. After you have created a budget, you can print a balance that shows variances to the budget by percentage. Work with multiple budgets at one time. Budgets can be exported/ imported to/from Excel, allowing you to use all the calculation capabilities of Excel while preparing your budgets',
            ],
            'list' => [],
        ],
        [
            'title' => 'Change Log',
            'open' => false,
            'body' => [
                'Log user changes made to Microsoft Dynamics NAV master data. You can log all direct modifications a user makes to the data in the database, except for changes to “working documents” such as journals, sales orders, and purchase orders.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Consolidation',
            'open' => false,
            'body' => [
                'Consolidate companies in Microsoft Dynamics NAV. The companies can come from one or from several different Microsoft Dynamics NAV databases or other files, and you can import and export financial information in this module. If data used is retrieved from several Microsoft Dynamics NAV solutions, use this module only in the parent company.',
            ],
            'list' => [],
        ],
    ];

    $cashItems = [
        [
            'title' => 'Bank Account Management',
            'open' => true,
            'body' => [
                'Create, operate and manage multiple bank accounts for catering to your diverse business needs and across different currencies.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Electronic Payments and Direct Debits',
            'open' => false,
            'body' => [
                'Create payment proposals based on vendor documents and generate bank payment files in ISO20022/SEPA format or use the Bank Data Conversion Service for generating the appropriate electronic payment file for your bank. Easily keep track of the payment export history for your electronic payments and recreate a payment file whenever needed. Apply payments comes with simple streamlined process to mark and process the desired transactions. Create direct debit collections to get the money directly from your customers bank account and generate a bank direct debit file in ISO20022/SEPA format. In NAV 2018 you can insert hyperlinks to online payment services into your invoices, providing your customers with a more efficient way to pay an invoice online. You can also install the PayPal integration extension. This creates links in invoices to PayPal Standards online payment. PayPal offers a trustworthy global payment service with multiple ways of accepting payments, including credit card processing and PayPal accounts.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Reconciliation of Incoming and Outgoing Bank Transactions',
            'open' => false,
            'body' => [
                'Import bank transaction data from electronic files sent from your bank in ISO20022/SEPA format—or use the Bank Data Conversion Service for other file types. Apply the bank transactions automatically to open customer and vendor ledger entries and create your own mapping rules. Review the proposed applications and account mappings in an easy and intuitive way. It is possible to modify the algo algorithm behind the record matching is possible by modifying, removing or adding rules.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Bank Account Reconciliation',
            'open' => false,
            'body' => [
                'Import bank statement data from electronic files sent from you bank in ISO20022/SEPA format—or use the Bank Data Conversion Service for other file types. Reconcile your bank statement data automatically to open bank account ledger entries and keep track of all bank statements. You can also Reconcile your bank payments in the Payment Reconciliation Journal, completing payments and reconciliation in one place and in one step. Now you can match customer payments, vendor payments, and bank transactions all in the Payment Reconciliation journal. You can also filter the statement information to view only the transactions that need attention, hiding those that do not. You can see a summary of outstanding bank information and drill-down to see the detail in payment reconciliation. To verify before posting the reconciliation, you can print the outstanding bank information on a test report.',
            ],
            'list' => [],
        ],
        [
            'title' => 'Check Writing',
            'open' => false,
            'body' => [
                'Generate Computer printed checks with a unique number series for each bank account. You can specify on the payment journal line whether you want this payment to be made with a computer or a manual check. This assists internal control by ensuring that the computer check is actually printed before posting the payment. Check printing comes with flexible user options, such as voiding a check, reprinting, using check forms with preprinted stubs, testing before printing, and also the possibility to consolidate payments for a vendor into a single check.',
            ],
            'list' => [],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/finance-management.css'])
@endpush

@section('content')
    <div class="fm-page">
        {{-- Hero --}}
        <section class="fm-hero" aria-labelledby="fm-hero-title">
            <img
                class="fm-hero__bg"
                src="{{ $img('finance-management.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell fm-hero__inner">
                <div class="fm-hero__copy">
                    <h1 id="fm-hero-title">Finance Management</h1>
                    <div class="fm-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="fm-btn fm-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- General accordion --}}
        <section class="fm-section" aria-labelledby="fm-general-title">
            <div class="site-shell">
                <h2 id="fm-general-title" class="fm-heading">General</h2>

                <div class="fm-acc">
                    @foreach ($generalItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span>{{ $item['title'] }}</span>
                            </summary>
                            <div class="fm-acc__body">
                                @foreach ($item['body'] as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                                @if (! empty($item['list']))
                                    <ul>
                                        @foreach ($item['list'] as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Cash Management accordion --}}
        <section class="fm-section fm-section--last" aria-labelledby="fm-cash-title">
            <div class="site-shell">
                <h2 id="fm-cash-title" class="fm-heading">Cash Management</h2>

                <div class="fm-acc">
                    @foreach ($cashItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span>{{ $item['title'] }}</span>
                            </summary>
                            <div class="fm-acc__body">
                                @foreach ($item['body'] as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
