@php
    $img = fn (string $file): string => asset('images/sales-marketing-and-service-management/'.$file);

    $salesMarketingItems = [
        [
            'title' => 'Campaign Management :',
            'open' => true,
            'paragraphs' => [
                'Organize campaigns based on segments of your contacts that you define. Define segments based on specific criteria, such as sales, contact profiles, and interactions, and reuse existing segments or segmentation criteria. Use the Merge feature in Word (or send other file formats) to communicate with the contacts in your segment. To send a document to people of different nationalities in their native language, use Campaign Management with Interaction/Document Management.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Relationship Management :',
            'open' => false,
            'paragraphs' => [
                'You can work more effectively with Relationship Management from your phone, taking advantage of enhancements to the Sales and Relationship Management Role Center. A simplified CRM includes contact management, interactions, and sales opportunities. You can also use improved interactions logging from your phone, logging email messages using Office 365.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Contact Classification :',
            'open' => false,
            'paragraphs' => [
                'Sort your contacts into categories, and automatically classify your customers based on criteria you specify. For example, you can see the program group contacts in terms of revenue. Use this information to target contacts for your campaigns. Divide your customers into ABC segments and even use this module for rating (assign the weights of two questions to identify the value of a third question).',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Contact Management :',
            'open' => false,
            'paragraphs' => [
                'Maintain an overview of your contacts, and personalize your approach to them. Record your contact information for all business relationships. This module is tightly integrated with the Sales and Receivables application area. You can also:',
            ],
            'list' => [
                'Specify the individual people related to each contact.',
                'Get an automatic alert if you enter contact information that already exists with the duplicate check function.',
                'Get a precise view of prospects and customers by categorizing your contacts based on profiling questions.',
                'Issue quotes to prospects or create sales documents for specific contacts if you have Sales Order Management.',
                'Use Contact Synchronization to integrate your contacts from Microsoft Dynamics NAV 2018 with your People Hub in Office 365 or Microsoft Outlook.',
                'Keep your contacts synchronized between Microsoft Dynamics NAV 2018 and Office 365 or Microsoft Outlook, and automatically run a background synchronization at scheduled times.',
                'Use filters to synchronize only the Microsoft Dynamics NAV 2018 contacts that you want to see in Office 365 or Microsoft Outlook.',
            ],
            'after' => null,
        ],
        [
            'title' => 'Interaction /Document Management :',
            'open' => false,
            'paragraphs' => [
                'Record all the interactions that you have with your contacts for example, telephone calls, meetings, or letters. Attach documents to interactions (Word, Excel, or .txt files). You can also automatically record other interactions for example, all Microsoft Dynamics NAV documents that you send to your contacts, such as sales orders or quotes, can be logged and retrieved at a later time. By using TAPI (Telephony Application Programming Interface) compliant telecom devices, you can call a contact by clicking a button on the electronic contact card.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Mail Logging for Microsoft Exchange Server :',
            'open' => false,
            'paragraphs' => [
                'Log all email correspondence. Log inbound and outbound email messages sent through Microsoft Dynamics NAV or Microsoft Outlook, and set up the program to log automatically or manually in Microsoft Dynamics NAV. The solution is server-based and requires Microsoft Exchange Server (please refer to the Microsoft Dynamics NAV software requirements) in order for you to keep email messages in their natural environment to ease administration.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Opportunity Management :',
            'open' => false,
            'paragraphs' => [
                'Keep track of sales opportunities. Section your sales processes into different stages, and use this information to get an overview of and manage your sales opportunities.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Outlook Client Integration :',
            'open' => false,
            'paragraphs' => [
                'Synchronize your to-do items and your contacts in Microsoft Dynamics NAV with meetings, tasks, and contacts in Outlook. Create, update, cancel, and delete in one program and, at a specific time, synchronize from within Outlook. You can also customize synchronization by adding fields or adding new entities to be synchronized.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Notifications :',
            'open' => false,
            'paragraphs' => [
                'You can take advantage of non-intrusive, intelligent in application notifications, which guide you through relevant processes according to the context you are working in. The new type of notifications help even untrained users carry out advanced tasks, while the unobtrusive design does not prevent you from carrying on with your work. You can also use Microsoft Word templates to create the layout for email notifications, ensuring all messages look consistent and coherent.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Task Management :',
            'open' => false,
            'paragraphs' => [
                'Organize the tasks related to your sales and marketing activities. Create to-do lists for yourself and assign tasks to other users or teams of users. Automatically create recurring to-do items and activities consisting of several to-do items.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Integration with Dynamics 365 for Sales :',
            'open' => false,
            'paragraphs' => [
                'Integrate Dynamics NAV with Dynamics 365 for Sales in a few easy steps using assisted setup. The assisted setup helps you synchronize your data across the two, including sales orders, item availability, units of measure, and currencies.',
            ],
            'list' => [],
            'after' => null,
        ],
    ];

    $serviceManagement1Items = [
        [
            'title' => 'Planning and Dispatching :',
            'open' => true,
            'paragraphs' => [
                'Assign personnel to work orders and log details such as work order handling and work order status. For dispatching, manage service personnel and field technician information, and filter according to availability, skills, and stock items. Gain an overview of service task prioritization, service loads, and task escalations.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Service Contract Management :',
            'open' => false,
            'paragraphs' => [
                'Set up an agreement with the customer concerning the service level to be delivered. With this module, you can:',
            ],
            'list' => [
                'Maintain information on contract history, contract renewal, and contract templates.',
                'Manage warranty details on service items and spare parts.',
                'Record details on service levels, response times, and discount levels, as well as on the service history of each contract, including used service items and parts and labor hours.',
                'Measure contract profitability.',
                'Generate contract quotes. It is recommended that you also use the Service Order Management and Service Item Management modules',
            ],
            'after' => null,
        ],
        [
            'title' => 'Service Item Management :',
            'open' => false,
            'paragraphs' => [
                'Record and keep track of all your service items, including contract information, component management, and BOM reference and warranty information. Use the Trendscape Analysis feature to view key performance indicators on the service item in a given time frame.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Service Order Management :',
            'open' => false,
            'paragraphs' => [
                'Register your after-sales issues including service requests, services due, service orders, and repair requests. Service requests can be initiated by the customer or created automatically according to the terms in your service agreement. Data can be entered in the service orders by a call center employee or by your repair shop. You can also use this module to register impromptu or one-off service orders. Register and manage equipment loaned to customers. Get a complete history of your service orders and service order quotes through the Service Order Log.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Service Price Management :',
            'open' => false,
            'paragraphs' => [
                'Set up, maintain, and monitor your service prices. Set up price groups based on different criteria—such as the service item (or several item groups), the service task involved, or the type of fault—for a limited period of time, or for a specific customer or currency. Define price calculation structures that include all parameters involved in providing service—for example, the parts used, the different work types, and the service charges. The system automatically assigns the correct price structure to the service orders that match the service price group criteria. You can also assign fixed prices, minimum prices, or maximum prices to service price groups and view statistics about the profitability of each service price group.',
            ],
            'list' => [],
            'after' => null,
        ],
    ];

    $serviceManagement2Items = [
        [
            'title' => 'General :',
            'open' => true,
            'paragraphs' => [
                'Model real-life business processes such as best practices or industry-specific standards. For example, ensure a customer’s credit limit has been independently verified or require a twoperson approval for a significant vendor payment. Workflows in Microsoft Dynamics NAV focus on three main building blocks and workflow processes, short or long, are likely to be comprised of steps related to these three blocks, which are:',
            ],
            'list' => [
                'Approvalleave a work task, item, or document in a blocked or unapproved state until approved by a suitable person in your organization.',
                'Notificationtell users that something has happened and/ or that they need to take some kind of action.',
                'Process automation—execute a process routine and have the Microsoft Dynamics NAV system calculate something or perform an action.',
            ],
            'after' => 'Along with approval, notification, and process automation, workflows in events react to real parameters in your business. Workflows can be triggered by credit limits, geographies, totals, individual owners, or any one of hundreds of other potential conditions.',
        ],
        [
            'title' => 'Sales & Marketing :',
            'open' => false,
            'paragraphs' => [
                'Out of the box, Dynamics NAV 2018 supports sales document and customer approval workflows that enable users to submit sales documents and customer verification, for approval according to a predefined hierarchy of approval managers. The approvals can be done with accounting manager or another similar significant role in your company. In this way, you can have workflows that need approval when sales discounts exceed a limit and need approval by sales managers, or you can have notifications sent to account managers when new customers are created in a particular geography.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Purchase and Integration :',
            'open' => false,
            'paragraphs' => [
                'Microsoft Dynamics NAV 2018 integration with Optical Character Recognition (OCR) services and purchase workflows go hand-in-hand. External invoices can be received, processed, and generate payment lines with workflows. At any stage a user can change the conditions for automatically processing and have documents sent for approval before processing if they exceed limits or some other condition.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Workflow groups and features :',
            'open' => false,
            'paragraphs' => [],
            'list' => [
                'Sales & Purchase Documents',
                'Sales & Marketing',
                'Finance',
                'Integration workflows',
                'Administration',
                'Job queue support for process automation',
                'Email and Microsoft Dynamics NAV Notes for notifications',
                'Workflow designer',
            ],
            'after' => null,
        ],
    ];

    $eservicesItems = [
        [
            'title' => 'Electronic Invoicing :',
            'open' => true,
            'paragraphs' => [
                'Electronic Invoicing Send and receive electronic invoices and credit memos as either files or using a document exchange service. Out-of-the-box, the PEPPOL format and the free Tradeshift document exchange service are supported, but the architecture allows for adding additional formats or document exchange service software (requires partner customization). In addition, a number of standards used in electronic document exchange are now supported, including a Global Location Number (GLN) ID for customers and vendors, Global Trade Item Number (GTIN) for items, and international codes on units of measures, currencies, tax codes, tax schemes, and countries. Furthermore, a new Document Sending Profile concept aggregates all tasks around sending documents, be it by email message, print, or file and enables you to set up preferred send behavior defaults for a customer or vendor, or a group of customers/vendors. Received electronic documents are integrated into the document management features, that is, they are stored in Incoming Documents, along with PDF or scanned paper invoices, from which the user can create Purchase Invoices and Purchase Credit Memos, or General Journal Lines, and add text-to-account rules to automatically default account rules based on the vendor or line data. Errors and warnings in connection with the conversion are available for the incoming document, and links to the document enables navigation from any created document, posted document, or ledger entry in Microsoft Dynamics NAV. Using a free Tradeshift account, documents can be sent to and received from other parties on the Tradeshift network, and delivery status as well as activity logging is available inside Microsoft Dynamics NAV for the document exchange service interaction. Workflow can be added to automatically process any incoming electronic document, for example, from creating the corresponding draft purchase document in Microsoft Dynamics NAV to posting it and creating payment lines depending on workflow conditions, such as per vendor and/or amount.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Currency exchange :',
            'open' => false,
            'paragraphs' => [
                'rates Update currency exchange rates using third-party web services that deliver exchange rates as XML files or streams. Updates can be performed manually or automatically using the job queue functionality. Yahoo and European Central Bank (ECB) currency feeds are supported out of the box, and other currency services can be added mapping the data in the feed into the currency exchange rates setup, a task that can be done in the end user client without developer permissions.',
            ],
            'list' => [],
            'after' => null,
        ],
    ];

    $documentManagementItems = [
        [
            'title' => 'Incoming documents :',
            'open' => true,
            'paragraphs' => [
                'Scanned incoming paper as well as electronic documents can be stored in Microsoft Dynamics NAV in Incoming Documents. From here, they can be further processed into documents in Microsoft Dynamics NAV. Links to the incoming document allow navigation from any created document, posted document, or financial transaction ledger entry in Microsoft Dynamics NAV. From these locations, the linked original document(s) is accessible for viewing. It is also possible to find ledger entries that do not have an attached incoming document, and attach an incoming document entry manually. Paper documents can be scanned and added manually to the incoming documents, or captured using a phone or tablet with the Microsoft Dynamics NAV app or, for example, Office Lens.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Optical Character Recognition (OCR) :',
            'open' => false,
            'paragraphs' => [
                'The OCR integration enables you to extract unstructured PDFs, lines of an invoice, scanned invoices or credit memos into structured data, allowing further automatic processing similar to electronic documents. Add text-to-account rules to automatically default account rules based on the vendor. Out-of-the-box, the Kofax1) Invoice Capture Service (ICS) for Microsoft Dynamics NAV is supported, but the architecture allows for use of a different OCR service or external software (requires partner customization). With the Kofax Invoice Capture Service integration, header, lines and total information can be extracted. Documents can also be forwarded directly to the OCR service using email messages. Take advantage of vendor synchronization. Vendor information including number, name, address, VAT registration, phone, and bank account data is transferred to Kofax ICS when synchronizing. To use Kofax Invoice Capture Service for Microsoft Dynamics NAV, an account must be created at Lexmark Invoice Capture Service and a free SKU will be available. Incoming documents can be sent to and received from OCR manually, as well as automatically using a job queue.',
            ],
            'list' => [],
            'after' => null,
        ],
        [
            'title' => 'Incoming document workflow :',
            'open' => false,
            'paragraphs' => [
                'Add workflows to automatically process any incoming electronic document, e.g.,',
            ],
            'list' => [
                'Send and receive documents to/from OCR automatically,',
                'Create draft purchase document in Dynamics NAV',
                'Post draft document',
                'Create payment lines for posted documents',
            ],
            'after' => 'Workflow conditions can be defined by the user to control flow based on, e.g., vendor or amount.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/sales-marketing-and-service-management.css'])
@endpush

@section('content')
    <div class="smsm-page">
        {{-- Hero --}}
        <section class="smsm-hero" aria-labelledby="smsm-hero-title">
            <img
                class="smsm-hero__bg"
                src="{{ $img('sales-marketing-and-service-management.webp') }}"
                alt="Sales, Marketing, and Service Management"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell smsm-hero__inner">
                <div class="smsm-hero__copy">
                    <h1 id="smsm-hero-title">Sales, Marketing, and<br>Service Management</h1>
                    <div class="smsm-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="smsm-btn smsm-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section 1: Sales and Marketing --}}
        <section class="smsm-section" aria-labelledby="smsm-sales-title">
            <div class="site-shell">
                <h2 id="smsm-sales-title" class="smsm-heading">Sales and Marketing</h2>

                <div class="smsm-acc">
                    @foreach ($salesMarketingItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span class="smsm-acc__icon" aria-hidden="true">
                                    <svg class="smsm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                    </svg>
                                    <svg class="smsm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                    </svg>
                                </span>
                                <span class="smsm-acc__title">{{ $item['title'] }}</span>
                            </summary>
                            <div class="smsm-acc__body">
                                @foreach ($item['paragraphs'] as $p)
                                    <p>{{ $p }}</p>
                                @endforeach

                                @if (! empty($item['list']))
                                    <ul>
                                        @foreach ($item['list'] as $li)
                                            <li>{{ $li }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (! empty($item['after']))
                                    <p>{{ $item['after'] }}</p>
                                @endif
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 2: Service Management --}}
        <section class="smsm-section" aria-labelledby="smsm-service1-title">
            <div class="site-shell">
                <h2 id="smsm-service1-title" class="smsm-heading">Service Management</h2>

                <div class="smsm-acc">
                    @foreach ($serviceManagement1Items as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span class="smsm-acc__icon" aria-hidden="true">
                                    <svg class="smsm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                    </svg>
                                    <svg class="smsm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                    </svg>
                                </span>
                                <span class="smsm-acc__title">{{ $item['title'] }}</span>
                            </summary>
                            <div class="smsm-acc__body">
                                @foreach ($item['paragraphs'] as $p)
                                    <p>{{ $p }}</p>
                                @endforeach

                                @if (! empty($item['list']))
                                    <ul>
                                        @foreach ($item['list'] as $li)
                                            <li>{{ $li }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (! empty($item['after']))
                                    <p>{{ $item['after'] }}</p>
                                @endif
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 3: Service Management (Workflows) --}}
        <section class="smsm-section" aria-labelledby="smsm-service2-title">
            <div class="site-shell">
                <h2 id="smsm-service2-title" class="smsm-heading">Service Management</h2>

                <div class="smsm-acc">
                    @foreach ($serviceManagement2Items as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span class="smsm-acc__icon" aria-hidden="true">
                                    <svg class="smsm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                    </svg>
                                    <svg class="smsm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                    </svg>
                                </span>
                                <span class="smsm-acc__title">{{ $item['title'] }}</span>
                            </summary>
                            <div class="smsm-acc__body">
                                @foreach ($item['paragraphs'] as $p)
                                    <p>{{ $p }}</p>
                                @endforeach

                                @if (! empty($item['list']))
                                    <ul>
                                        @foreach ($item['list'] as $li)
                                            <li>{{ $li }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (! empty($item['after']))
                                    <p>{{ $item['after'] }}</p>
                                @endif
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 4: E-services --}}
        <section class="smsm-section" aria-labelledby="smsm-eservices-title">
            <div class="site-shell">
                <h2 id="smsm-eservices-title" class="smsm-heading">E-services</h2>

                <div class="smsm-acc">
                    @foreach ($eservicesItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span class="smsm-acc__icon" aria-hidden="true">
                                    <svg class="smsm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                    </svg>
                                    <svg class="smsm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                    </svg>
                                </span>
                                <span class="smsm-acc__title">{{ $item['title'] }}</span>
                            </summary>
                            <div class="smsm-acc__body">
                                @foreach ($item['paragraphs'] as $p)
                                    <p>{{ $p }}</p>
                                @endforeach

                                @if (! empty($item['list']))
                                    <ul>
                                        @foreach ($item['list'] as $li)
                                            <li>{{ $li }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (! empty($item['after']))
                                    <p>{{ $item['after'] }}</p>
                                @endif
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Section 5: Document Management --}}
        <section class="smsm-section smsm-section--last" aria-labelledby="smsm-doc-title">
            <div class="site-shell">
                <h2 id="smsm-doc-title" class="smsm-heading">Document Management</h2>

                <div class="smsm-acc">
                    @foreach ($documentManagementItems as $item)
                        <details @if ($item['open']) open @endif>
                            <summary>
                                <span class="smsm-acc__icon" aria-hidden="true">
                                    <svg class="smsm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                    </svg>
                                    <svg class="smsm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                    </svg>
                                </span>
                                <span class="smsm-acc__title">{{ $item['title'] }}</span>
                            </summary>
                            <div class="smsm-acc__body">
                                @foreach ($item['paragraphs'] as $p)
                                    <p>{{ $p }}</p>
                                @endforeach

                                @if (! empty($item['list']))
                                    <ul>
                                        @foreach ($item['list'] as $li)
                                            <li>{{ $li }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (! empty($item['after']))
                                    <p>{{ $item['after'] }}</p>
                                @endif
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
