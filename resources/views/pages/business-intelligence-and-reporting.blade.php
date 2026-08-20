@php
    $img = fn (string $file): string => asset('images/business-intelligence-and-reporting/'.$file);

    $formServiceOptions = [
        'Bookkeeping Services',
        'Payroll Processing',
        'Procure to Pay',
        'Accounts Payable and Receivable',
        'Financial Reporting',
        'Controller Services',
    ];

    $biItems = [
        [
            'title' => 'Business intelligence and reporting :',
            'open' => true,
            'body' => 'You can use embedded Power BI to easily create insightful charts and reports using Power BI, and make them available within your Microsoft Dynamics NAV role center. Leverage the Microsoft Dynamics NAV 2018 Power BI Content Pack to get started, and utilize existing Power BI security to manage reports. Embedded Power BI reporting is easily visible from within the most highly-used lists in Dynamics NAV.',
        ],
    ];

    $cashItems = [
        [
            'title' => 'Bank Account Management',
            'open' => true,
            'body' => 'Create, operate and manage multiple bank accounts for catering to your diverse business needs and across different currencies.',
        ],
        [
            'title' => 'Electronic Payments and Direct Debits',
            'open' => false,
            'body' => 'Create payment proposals based on vendor documents and generate bank payment files in ISO20022/SEPA format or use the Bank Data Conversion Service for generating the appropriate electronic payment file for your bank. Easily keep track of the payment export history for your electronic payments and recreate a payment file whenever needed. Apply payments comes with simple streamlined process to mark and process the desired transactions. Create direct debit collections to get the money directly from your customers bank account and generate a bank direct debit file in ISO20022/SEPA format. In NAV 2018 you can insert hyperlinks to online payment services into your invoices, providing your customers with a more efficient way to pay an invoice online. You can also install the PayPal integration extension. This creates links in invoices to PayPal Standards online payment. PayPal offers a trustworthy global payment service with multiple ways of accepting payments, including credit card processing and PayPal accounts.',
        ],
        [
            'title' => 'Reconciliation of Incoming and Outgoing Bank Transactions',
            'open' => false,
            'body' => 'Import bank transaction data from electronic files sent from your bank in ISO20022/SEPA format—or use the Bank Data Conversion Service for other file types. Apply the bank transactions automatically to open customer and vendor ledger entries and create your own mapping rules. Review the proposed applications and account mappings in an easy and intuitive way. It is possible to modify the algo algorithm behind the record matching is possible by modifying, removing or adding rules.',
        ],
        [
            'title' => 'Bank Account Reconciliation',
            'open' => false,
            'body' => 'Import bank statement data from electronic files sent from you bank in ISO20022/SEPA format—or use the Bank Data Conversion Service for other file types. Reconcile your bank statement data automatically to open bank account ledger entries and keep track of all bank statements. You can also Reconcile your bank payments in the Payment Reconciliation Journal, completing payments and reconciliation in one place and in one step. Now you can match customer payments, vendor payments, and bank transactions all in the Payment Reconciliation journal. You can also filter the statement information to view only the transactions that need attention, hiding those that do not. You can see a summary of outstanding bank information and drill-down to see the detail in payment reconciliation. To verify before posting the reconciliation, you can print the outstanding bank information on a test report.',
        ],
        [
            'title' => 'Check Writing',
            'open' => false,
            'body' => 'Generate Computer printed checks with a unique number series for each bank account. You can specify on the payment journal line whether you want this payment to be made with a computer or a manual check. This assists internal control by ensuring that the computer check is actually printed before posting the payment. Check printing comes with flexible user options, such as voiding a check, reprinting, using check forms with preprinted stubs, testing before printing, and also the possibility to consolidate payments for a vendor into a single check.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/business-intelligence-and-reporting.css'])
@endpush

@section('content')
    <div class="bir-page">
        {{-- Hero --}}
        <section class="bir-hero" aria-labelledby="bir-hero-title">
            <img
                class="bir-hero__bg"
                src="{{ $img('business-intelligence-and-reporting.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell bir-hero__inner">
                <div class="bir-hero__copy">
                    <h1 id="bir-hero-title">Business intelligence and reporting</h1>
                    <div class="bir-hero__actions">
                        <a href="#request-form-demo" class="bir-btn bir-btn--cream">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Accordion content --}}
        <section class="bir-section" aria-labelledby="bir-bi-title">
            <div class="site-shell">
                <h2 id="bir-bi-title" class="bir-heading">Business intelligence and reporting</h2>

                <div class="bir-acc">
                    @foreach ($biItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span>{{ $item['title'] }}</span>
                            </summary>
                            <div class="bir-acc__body">
                                <p>{{ $item['body'] }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>

                <h2 id="bir-cash-title" class="bir-heading bir-heading--spaced">Cash Management</h2>

                <div class="bir-acc">
                    @foreach ($cashItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span>{{ $item['title'] }}</span>
                            </summary>
                            <div class="bir-acc__body">
                                <p>{{ $item['body'] }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Contact form --}}
        <section
            class="bir-section bir-consult"
            id="request-form-demo"
            aria-labelledby="bir-consult-title"
        >
            <div class="site-shell bir-consult__inner">
                <aside class="bir-consult__card" aria-labelledby="bir-consult-title">
                    <div class="bir-consult__header">
                        <h2 id="bir-consult-title">Schedule A Call with Our Experts</h2>
                        <p>Explore our packages and enhance your finances with our team !</p>
                    </div>
                    <div class="bir-consult__body">
                        <livewire:forms.contact-form
                            form-name="business-intelligence-and-reporting"
                            id-prefix="bir"
                            :show-company="false"
                            :show-service="true"
                            :service-options="$formServiceOptions"
                            service-placeholder="Please Select Services"
                            message-placeholder="What kind of accounting solution are you looking for?"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>

                <div class="bir-consult__media">
                    <img
                        src="{{ $img('form-image.webp') }}"
                        alt="form Image"
                        width="540"
                        height="364"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
