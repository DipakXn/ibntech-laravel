@php
    $img = fn (string $file): string => asset('images/bookkeeping-service-restaurants/'.$file);

    $servicePoints = [
        [
            'title' => 'Recording Sales:',
            'text' => 'As a restaurant runs on daily sales, keeping a daily sales journal is imperative for the restaurants owners. Credit card transactions instantly hit the bank however cash transactions need to be deposited in the bank as well. A delay in depositing cash has to then be maintained in the books of accounts as on the day of the transaction. IBN’s expert bookkeeping service team assists restaurants owners in maintaining their sales ledger to avoid error in accounting.',
        ],
        [
            'title' => 'Accounts Payable:',
            'text' => 'As managers of restaurants are busy with attending customers, the invoices that need to be paid get a second priority. This slack results in late payments and discrepancies. IBN technology limited bookkeeping experts prepare a systematic approach to make sure regular invoices and unforeseen expenses are duly recorded and paid on time.',
        ],
        [
            'title' => 'Payroll:',
            'text' => 'Payroll Processing is a major pain area for restaurant owners. IBN’s payroll processing and bookkeeping service team assists in safe and secure data migration to a cloud book keeping software.',
        ],
        [
            'title' => 'Reconciliation:',
            'text' => 'It is an elemental function for the hospitality industry to have all their bank accounts and records with credit cards, loans, payroll liabilities and lines of credit reconciled on time. IBNs bookkeeping service has a special feature of flash reporting in case of malicious activities noticed in your bank accounts.',
        ],
        [
            'title' => 'Financial Reporting:',
            'text' => 'Food and Beverage industry works with a very tight profit margin. In the absence of financial reporting running a restaurant can invite unnecessary loop holes in the accounting system. IBNs bookkeeping service team gives insights on the basis of costs incurred versus profits earned after careful analysis of total sales against overhead costs.',
        ],
    ];

    $industries = [
        [
            'label' => 'Bookkeeping Service for Restaurants',
            'slug' => 'bookkeeping-service-restaurants',
        ],
        [
            'label' => 'Bookkeeping For Small Business',
            'slug' => 'bookkeeping-for-small-business',
        ],
        [
            'label' => 'Bookkeeping For CPA Firms',
            'slug' => 'cpa-outsourcing',
        ],
        [
            'label' => 'Bookkeeping for Non Profit',
            'slug' => null,
            'href' => route('page.show', ['slug' => 'bookkeeping-service-restaurants']).'#',
        ],
        [
            'label' => 'Bookkeeping For Large Organisation',
            'slug' => 'bookkeeping-for-large-organisation',
        ],
    ];

    $areas = [
        [
            'label' => 'Bookkeeping For U.S.A',
            'slug' => 'bookkeeping-services-usa',
        ],
        [
            'label' => 'Bookkeeping For U.K',
            'slug' => 'bookeeping-for-uk',
        ],
    ];

    $checkSvg = '<svg aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>';
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/bookkeeping-service-restaurants.css'])
@endpush

@section('content')
    <div class="bksr-page">
        {{-- Hero --}}
        <section
            class="bksr-hero"
            aria-labelledby="bksr-hero-title"
            style="--bksr-hero-image: url('{{ $img('bookkeeping-service-restaurants.webp') }}')"
        >
            <div class="site-shell bksr-hero__inner">
                <div class="bksr-hero__copy">
                    <h1 id="bksr-hero-title">Bookkeeping Service for Restaurants</h1>
                    <div class="bksr-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="bksr-btn bksr-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Intro (overlapping card) --}}
        <section class="bksr-intro" aria-labelledby="bksr-intro-title">
            <div class="site-shell">
                <div class="bksr-intro__card">
                    <h2 id="bksr-intro-title" class="sr-only">Overview</h2>
                    <p>
                        Bookkeeping Service for Restaurants is a very complex process. Running a successful restaurant can be taxing as the day to day operations can be taxing for an individual. Bookkeeping service for restaurants is crucial as even a slight delay in maintenance of book of accounts can cause the restaurant owner heavily.
                    </p>
                    <p>
                        IBN Technology Limited uses extensive measures to make sure the bookkeeping services for restaurants is accurate and efficient.
                    </p>
                    <p>
                        Primarily book keeping service for restaurants includes:-
                    </p>
                </div>
            </div>
        </section>

        {{-- Service details --}}
        <section class="bksr-section" aria-labelledby="bksr-services-title">
            <div class="site-shell bksr-services">
                <h2 id="bksr-services-title" class="sr-only">Bookkeeping Services Included</h2>

                @foreach ($servicePoints as $point)
                    <p>
                        <strong>{{ $point['title'] }}</strong> {{ $point['text'] }}
                    </p>
                @endforeach

                <p>
                    IBN Technologies Limited houses in house bookkeeping service professionals that understand the financial challenges faced by restaurant industry. Customised book keeping solutions are designed specifically to suit the bookkeeping needs of restaurants and hotels.
                </p>
                <p>
                    Bookkeeping services for restaurants by IBN’s experts that are well acquainted in globally acknowledged cloud and accounting softwares such as Sage, Creative Solutions, IRIS, Peachtree, Quicken, NetSuite, Master Builder, VT Transactions, Viztopia, Business Works, MyOB, Lacerte, ProSeries, ATX, and many other renowned softwares such as Xero, Intuit Pro-Advisors, Intuit Point of Sale Pro-Advisor, Wave and FreeBooks.
                </p>
            </div>
        </section>

        {{-- Industries & Areas --}}
        <section class="bksr-serve" aria-labelledby="bksr-industries-title">
            <div class="site-shell bksr-serve__inner">
                <div class="bksr-serve__copy">
                    <div class="bksr-serve__cols">
                        <div class="bksr-serve__col">
                            <h2 id="bksr-industries-title">Industries We Serve</h2>
                            <ul class="bksr-check-list">
                                @foreach ($industries as $item)
                                    <li>
                                        <a
                                            href="{{ $item['href'] ?? route('page.show', ['slug' => $item['slug']]) }}"
                                        >
                                            {!! $checkSvg !!}
                                            <span>{{ $item['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="bksr-serve__col">
                            <h2 id="bksr-areas-title">Areas We Serve</h2>
                            <ul class="bksr-check-list">
                                @foreach ($areas as $item)
                                    <li>
                                        <a href="{{ route('page.show', ['slug' => $item['slug']]) }}">
                                            {!! $checkSvg !!}
                                            <span>{{ $item['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bksr-serve__media">
                    <img
                        src="{{ $img('signs-you-need-offshore-bookkeeping.webp') }}"
                        alt="Signs You Need Offshore Bookkeeping"
                        width="650"
                        height="650"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Contact form (WordPress “Let’s Talk Business” modal, on-page in Laravel) --}}
        <section
            class="bksr-section bksr-consult"
            id="contact-us"
            aria-labelledby="bksr-consult-title"
        >
            <div class="site-shell bksr-consult__inner">
                <aside class="bksr-consult__card" aria-labelledby="bksr-consult-title">
                    <div class="bksr-consult__header">
                        <h2 id="bksr-consult-title">Let’s Talk Business</h2>
                        <p>Book a quick strategy call with our experts to discuss your business needs.</p>
                    </div>
                    <div class="bksr-consult__body">
                        <livewire:forms.contact-form
                            form-name="bookkeeping-service-restaurants"
                            id-prefix="bksr"
                            :show-company="true"
                            :show-service="false"
                            message-placeholder="Message"
                            submit-label="Submit"
                            layout="home"
                        />
                    </div>
                </aside>
            </div>
        </section>
    </div>
@endsection
