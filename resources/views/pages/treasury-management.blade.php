@php
    $img = fn (string $file): string => asset('images/treasury-management/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
    $cashFlowUrl = route('blog.show', ['slug' => '10-cash-flow-management-to-keep-your-business-financially-healthy']);

    $guaranteeWorkflow = [
        'Bank Guarantee workflow helps in automizing the time-consuming manual application process.',
        'It extends right from the request stage to the issuance stage of Bank Guarantees.',
        'It focuses on getting the relevant approvals depending on the policies set out by the organization.',
        'It ensures that approval histories and documentations are stored in time for Audit purposes',
        'It helps in creating a sophisticated test of control that helps in allocating the authority and responsibility between the requestor, request analyst, treasury department and the approvers.',
    ];

    $guaranteeRole = [
        'Verification of the application with the supporting documents provided.',
        'Saving documents of every request to the server. Tracking guarantees and getting the flow completed at the earliest.',
        'Issued guarantee verification and maintaining a record for the same.',
        'Smart Tracker for reissue, amendments and intimating expiry of guarantees.',
    ];

    $ompwRole = [
        'Verification of documents with invoices.',
        'Initiating payments at banking',
        'Follow-up with banks and treasury approvers for execution of payment.',
        'Intimating the requestor regarding payment completion with remittance details.',
        'Data cleaning activities.',
    ];

    $clientOffers = [
        'Customer Credit Workflow',
        'Global Credit card Process',
        'Cash Sheet Process To Quantum AUTOMATION',
        'A Treasury helpdesk',
    ];

    $accountingSupport = [
        'Quantum JE processing & daily reconciliation of these JE\'s to make sure that entire activity has been accounted as per compliances.',
        'Prepare and send out Mobile Charges to Operating Units, P-card Draft to Operating Units, Active Pay Breakouts, Check listing and image support.',
        'Answer the queries of divisions in respect of above workings and processes.',
        'Managing the US cash pool activities in Quantum, training and verifying the work done by cash management team, answering divisions with all their IHB and securitization related queries, reclassing the old unclaimed transactions, making sure that all the requests made by divisions are taken care.',
        'Preparing various upload templates for quantum such as ACH templet, 401 K templet, HAS templet, Mobile charges templet, P-card templet, Active pay templet, United way templets and many more.',
        'Working on preparing T accounting templates for various instruments which will act as an supporting module for various divisions. Weekly getting them verified by Client Finance Manager.',
        'Assisting treasury team with Audits\' Queries. Managing the Securitization Report Dates & IHB Report Dates.',
    ];

    $jeActivitiesLeft = [
        'Hedge Accounting',
        'Bond Interest Accrual/Un used Fee JE',
        'Revaluations JE',
        'Additional Manual JE\'s,',
        'EUR paBa Bank Fees & FX',
        'EURO Bond Accrual',
        'True up JE and many more JE\'s',
    ];

    $jeActivitiesRight = [
        'Hedge Accounting',
        'AR Securitization',
        'Cash',
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/treasury-management.css'])
@endpush

@section('content')
    <div class="tm-page">
        {{-- Hero --}}
        <section class="tm-hero" aria-labelledby="tm-hero-title">
            <div class="site-shell tm-hero__inner">
                <div class="tm-hero__copy">
                    <h1 id="tm-hero-title">Treasury Management</h1>
                    <div class="tm-hero__actions">
                        <a href="{{ $contactUrl }}" class="tm-btn tm-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>

                <div class="tm-hero__media">
                    <img
                        src="{{ $img('bookkeeping-for-marketing-and-advertising-companies.webp') }}"
                        alt="bookkeeping for marketing and advertising companies"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Project Budgeting and Expense Monitoring --}}
        <section class="tm-section tm-section--cream" aria-labelledby="tm-budget-title">
            <div class="site-shell">
                <div class="tm-heading tm-heading--center">
                    <h2 id="tm-budget-title">Project Budgeting and Expense Monitoring</h2>
                </div>

                <div class="tm-cards">
                    <article class="tm-card">
                        <h3>What is Bank Guarantee Workflow</h3>
                        <ul>
                            @foreach ($guaranteeWorkflow as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="tm-card">
                        <h3>IBN's role in Bank Guarantee Flow</h3>
                        <ul>
                            @foreach ($guaranteeRole as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>

                <div class="tm-heading tm-heading--center tm-heading--sub">
                    <h2 id="tm-ompw-title">Online Manual Payment Workflow (OMPW)</h2>
                </div>

                <div class="tm-cards">
                    <article class="tm-card">
                        <h3>What is OMPW</h3>
                        <p>
                            Online Manual Payment Workflow (SharePoint) have centralized the management of requests and eliminates the risk of critical transactions being impacted by emails that gets missed or sent to the incorrect individual and implements approval matrix within the request flow successfully.
                        </p>
                    </article>

                    <article class="tm-card">
                        <h3>IBN's role in Bank Guarantee Flow</h3>
                        <p>IBN plays a vital role in -</p>
                        <ul>
                            @foreach ($ompwRole as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>

                <div class="tm-cta">
                    <a href="{{ $contactUrl }}" class="tm-btn tm-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>

        {{-- What Else Does IBN Offer This Client? --}}
        <section class="tm-section" aria-labelledby="tm-offer-title">
            <div class="site-shell tm-split">
                <div class="tm-split__media">
                    <img
                        src="{{ $img('at-ibn-tech-we-understand-that-marketing-and.webp') }}"
                        alt="at ibn tech, we understand that marketing and"
                        width="532"
                        height="362"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="tm-split__copy">
                    <h2 id="tm-offer-title">What Else Does IBN Offer This Client?</h2>
                    <p>
                        Similar to the Bank Workflow Guarantee Module and Online Manual Payment Workflow (SharePoint) module, IBN offers the following to this particular client as a part of its treasury management services.
                    </p>
                    <ul>
                        @foreach ($clientOffers as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Volume Matrix --}}
        <section class="tm-section tm-section--tight" aria-label="Volume matrix">
            <div class="site-shell">
                <div class="tm-matrix">
                    <img
                        src="{{ $img('treasury-management-1.webp') }}"
                        alt="treasury-management"
                        width="1024"
                        height="576"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Accounting Support list --}}
        <section class="tm-section tm-section--tight" aria-labelledby="tm-accounting-title">
            <div class="site-shell">
                <h2 id="tm-accounting-title" class="tm-heading tm-heading--left">
                    Accounting Support Offered By IBN In This Project
                </h2>
                <ul class="tm-support-list">
                    @foreach ($accountingSupport as $index => $item)
                        <li>
                            @if ($index === 3)
                                Managing the US cash pool activities in Quantum, training and verifying the work done by
                                <a href="{{ $cashFlowUrl }}">cash management</a>
                                team, answering divisions with all their IHB and securitization related queries, reclassing the old unclaimed transactions, making sure that all the requests made by divisions are taken care.
                            @else
                                {{ $item }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Accounting Support JE cards --}}
        <section class="tm-section" aria-labelledby="tm-je-title">
            <div class="site-shell">
                <div class="tm-heading tm-heading--center">
                    <h2 id="tm-je-title">Accounting Support Offered By IBN In This Project</h2>
                </div>

                <div class="tm-cards">
                    <article class="tm-card">
                        <h3>Processing JE's associated with below activities</h3>
                        <ul>
                            @foreach ($jeActivitiesLeft as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>

                    <article class="tm-card">
                        <h3>Processing JE's associated with below activities</h3>
                        <ul>
                            @foreach ($jeActivitiesRight as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>

                <h3 class="tm-je-note">
                    Preparing and Processing true up JEs to correct the variances found reconciliation
                </h3>

                <div class="tm-cta">
                    <a href="{{ $contactUrl }}" class="tm-btn tm-btn--navy">
                        Get a Free Consultation Today
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
