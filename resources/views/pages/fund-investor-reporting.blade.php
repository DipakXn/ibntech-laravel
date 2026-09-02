@php
    $img = fn (string $file): string => asset('images/fund-investor-reporting/'.$file);
    $url = fn (string $slug): string => route('page.show', ['slug' => $slug]);

    $arrowSvg = '<svg aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg>';

    $ecommerce = $url('ecommerce-bookkeeping-services');
    $hospitality = $url('hospitality');

    $reportingItems = [
        [
            'href' => $ecommerce,
            'text' => 'Preparation of books of accounts and calculating the Net Asset Value with reference to share movements',
        ],
        [
            'href' => $hospitality,
            'text' => 'Preparation of Monthly / Quarterly financial statements tailored to client requirements, including Balance Sheets, Income Statements, Partners Capital Allocation Schedules, and Fund Performance Schedules',
        ],
        [
            'href' => $hospitality,
            'text' => 'Monthly/Quarterly preparation of Investor Statements',
        ],
        [
            'href' => $hospitality,
            'text' => 'Record expenses and capital transactions in accordance with US GAAP (including accruals, subscriptions and redemptions)',
        ],
        [
            'href' => $hospitality,
            'text' => 'Reconcile cash accounts with statements provided by prime brokers or custodians',
        ],
    ];

    $investorItems = [
        [
            'href' => $ecommerce,
            'text' => 'Maintain a record of each investors capital balance and allocate profits and losses in accordance with the most current limited partnership agreement (or equivalent) provided by the Fund',
        ],
        [
            'href' => $ecommerce,
            'text' => 'Calculate management fee and incentive allocation/carried interest based on the Funds governing documents',
        ],
        [
            'href' => $ecommerce,
            'text' => 'Liaise with the Fund’s tax advisor and independent auditors, and provide accounting records to assist in the preparation of the Funds annual income tax returns and annual audit.',
        ],
        [
            'href' => $ecommerce,
            'text' => 'Valuation Assistance',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/fund-investor-reporting.css'])
@endpush

@section('content')
    <div class="fir-page">
        {{-- Hero --}}
        <section class="fir-hero" aria-labelledby="fir-hero-title">
            <div class="site-shell fir-hero__inner">
                <div class="fir-hero__copy">
                    <h1 id="fir-hero-title">Fund Investor Reporting</h1>
                    <div class="fir-hero__actions">
                        <a href="{{ $url('contact-us') }}" class="fir-btn fir-btn--navy">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
                <div class="fir-hero__media">
                    <img
                        src="{{ $img('fund-investor-reporting.webp') }}"
                        alt="fund-investor-reporting"
                        width="500"
                        height="560"
                        fetchpriority="high"
                        decoding="async"
                    >
                </div>
            </div>
        </section>

        {{-- Fund / Partnership Accounting --}}
        <section class="fir-section" aria-labelledby="fir-reporting-title">
            <div class="site-shell fir-split">
                <div class="fir-split__media">
                    <img
                        src="{{ $img('fund-partnership-accounting-financial-reporting.webp') }}"
                        alt="Fund partnership accounting and financial reporting"
                        width="468"
                        height="525"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
                <div class="fir-split__copy">
                    <h2 id="fir-reporting-title">Fund / Partnership Accounting &amp; Financial Reporting:</h2>
                    <ul class="fir-list">
                        @foreach ($reportingItems as $item)
                            <li>
                                <a href="{{ $item['href'] }}">
                                    <span class="fir-list__icon">{!! $arrowSvg !!}</span>
                                    <span>{{ $item['text'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Investor capital, fees, audit, valuation --}}
        <section class="fir-section fir-section--tight" aria-label="Investor capital, fees, audit support, and valuation assistance">
            <div class="site-shell fir-split fir-split--reverse">
                <div class="fir-split__copy">
                    <ul class="fir-list">
                        @foreach ($investorItems as $item)
                            <li>
                                <a href="{{ $item['href'] }}">
                                    <span class="fir-list__icon">{!! $arrowSvg !!}</span>
                                    <span>{{ $item['text'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="fir-split__media">
                    <img
                        src="{{ $img('maintain-a-record-of-each-investors-capital-balance-and.webp') }}"
                        alt="maintain a record of each investors capital balance and"
                        width="468"
                        height="525"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
        </section>
    </div>
@endsection
