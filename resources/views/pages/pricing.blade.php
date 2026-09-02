@php
    $yes = 'yes';
    $no = 'no';
    $addon = 'addon';

    $pricingTables = [
        'cash' => [
            'us' => [
                'title' => 'Cash Base Accounting',
                'price_label' => 'Price in USD',
                'symbol' => '$',
                'plans' => [
                    ['key' => 'basic', 'name' => 'Basic', 'volume' => 'Up to 100 Transactions', 'price_old' => 150, 'price_new' => 120, 'package' => 'CBA US (Basic)', 'popular' => false],
                    ['key' => 'essential', 'name' => 'Essential', 'volume' => '100 to 300 Transactions', 'price_old' => 300, 'price_new' => 240, 'package' => 'CBA US (Essential)', 'popular' => false],
                    ['key' => 'advance', 'name' => 'Advance', 'volume' => '300 to 600 Transactions', 'price_old' => 600, 'price_new' => 480, 'package' => 'CBA US (Advance)', 'popular' => true],
                    ['key' => 'plus', 'name' => 'Plus', 'volume' => '600 to 1000 Transactions', 'price_old' => 1000, 'price_new' => 800, 'package' => 'CBA US (Plus)', 'popular' => false],
                    ['key' => 'custom', 'name' => 'Custom', 'volume' => '1000+ Transactions', 'price_old' => null, 'price_new' => 'Custom', 'package' => 'CBA US (Custom)', 'popular' => false],
                ],
                'features' => [
                    ['name' => 'Bookkeeping', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Payroll', 'values' => [$addon, $addon, $addon, $addon, $addon]],
                    ['name' => 'Bank & CC Reconciliation', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Financial Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Customized Reporting', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Dedicated Bookkeeper', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Fixed Assets Management', 'values' => [$no, $no, $no, $no, $yes]],
                    ['name' => 'Free Consultation', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Sales Tax Reconciliation', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                ],
            ],
            'uk' => [
                'title' => 'Cash Base Accounting',
                'price_label' => 'Price in GBP',
                'symbol' => '£',
                'plans' => [
                    ['key' => 'basic', 'name' => 'Basic', 'volume' => '050 - 300 Transactions', 'price_old' => 117, 'price_new' => 94, 'package' => 'CBA UK (Basic)', 'popular' => false],
                    ['key' => 'essential', 'name' => 'Essential', 'volume' => '300 - 750 Transactions', 'price_old' => 235, 'price_new' => 188, 'package' => 'CBA UK (Essential)', 'popular' => false],
                    ['key' => 'advance', 'name' => 'Advance', 'volume' => '750 - 1100 Transactions', 'price_old' => 505, 'price_new' => 404, 'package' => 'CBA UK (Advance)', 'popular' => true],
                    ['key' => 'plus', 'name' => 'Plus', 'volume' => '1800 Plus Transactions', 'price_old' => 1000, 'price_new' => 800, 'package' => 'CBA UK (Plus)', 'popular' => false],
                    ['key' => 'custom', 'name' => 'Custom', 'volume' => 'For Dedicated Resources', 'price_old' => null, 'price_new' => 'Custom', 'package' => 'CBA UK (Custom)', 'popular' => false],
                ],
                'features' => [
                    ['name' => 'Bookkeeping', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Payroll', 'values' => [$addon, $addon, $addon, $addon, $addon]],
                    ['name' => 'Bank & CC Reconciliation', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Financial Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'VAT Reconciliation (UK)', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Customized Reporting', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Fixed Assets Management', 'values' => [$no, $no, $no, $no, $yes]],
                    ['name' => 'Free Consultation', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                ],
            ],
        ],
        'accrual' => [
            'us' => [
                'title' => 'Accrual Base Accounting',
                'price_label' => 'Price in USD',
                'symbol' => '$',
                'plans' => [
                    ['key' => 'basic', 'name' => 'Basic', 'volume' => '050 to 200 Transactions', 'price_old' => 200, 'price_new' => 160, 'package' => 'ABA US (Basic)', 'popular' => false],
                    ['key' => 'essential', 'name' => 'Essential', 'volume' => '200 to 600 Transactions', 'price_old' => 400, 'price_new' => 320, 'package' => 'ABA US (Essential)', 'popular' => false],
                    ['key' => 'advance', 'name' => 'Advance', 'volume' => '600 to 1200 Transactions', 'price_old' => 900, 'price_new' => 720, 'package' => 'ABA US (Advance)', 'popular' => true],
                    ['key' => 'plus', 'name' => 'Plus', 'volume' => '1200 Plus Transactions', 'price_old' => 1600, 'price_new' => 1280, 'package' => 'ABA US (Plus)', 'popular' => false],
                    ['key' => 'custom', 'name' => 'Custom', 'volume' => 'For Dedicated Resources', 'price_old' => null, 'price_new' => '-', 'package' => 'ABA US (Custom)', 'popular' => false],
                ],
                'features' => [
                    ['name' => 'Bookkeeping', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'AP/AR Management', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Payroll', 'values' => [$addon, $addon, $addon, $addon, $addon]],
                    ['name' => 'Monthly Profit & Loss Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Balance Sheet', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Debtors Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Creditors Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Cash Forecasting', 'values' => [$no, $no, $yes, $yes, $yes]],
                    ['name' => 'Budget Wise Actual Analysis', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Cost Accounting', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Inventory Management', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Fixed Assets Management', 'values' => [$no, $no, $no, $no, $yes]],
                    ['name' => 'Sales Tax Reconciliation', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                ],
            ],
            'uk' => [
                'title' => 'Accrual Base Accounting',
                'price_label' => 'Price in GBP',
                'symbol' => '£',
                'plans' => [
                    ['key' => 'basic', 'name' => 'Basic', 'volume' => '050 - 200 Transactions', 'price_old' => 150, 'price_new' => 120, 'package' => 'ABA UK (Basic)', 'popular' => false],
                    ['key' => 'essential', 'name' => 'Essential', 'volume' => '200 - 600 Transactions', 'price_old' => 300, 'price_new' => 240, 'package' => 'ABA UK (Essential)', 'popular' => false],
                    ['key' => 'advance', 'name' => 'Advance', 'volume' => '600 - 1200 Transactions', 'price_old' => 600, 'price_new' => 480, 'package' => 'ABA UK (Advance)', 'popular' => true],
                    ['key' => 'plus', 'name' => 'Plus', 'volume' => '1200 Plus Transactions', 'price_old' => 1240, 'price_new' => 992, 'package' => 'ABA UK (Plus)', 'popular' => false],
                    ['key' => 'custom', 'name' => 'Custom', 'volume' => 'For Dedicated Resources', 'price_old' => null, 'price_new' => '-', 'package' => 'ABA UK (Custom)', 'popular' => false],
                ],
                'features' => [
                    ['name' => 'Bookkeeping', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'AP/ AR Management', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Payroll', 'values' => [$addon, $addon, $addon, $addon, $addon]],
                    ['name' => 'Monthly Profit & Loss Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Balance Sheet', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Debtors Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Monthly Creditors Report', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                    ['name' => 'Cash Forecasting', 'values' => [$no, $no, $yes, $yes, $yes]],
                    ['name' => 'Budget Wise Actual Analysis', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Cost Accounting', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Inventory Management', 'values' => [$no, $no, $no, $yes, $yes]],
                    ['name' => 'Fixed Assets Management', 'values' => [$no, $no, $no, $no, $yes]],
                    ['name' => 'VAT Reconciliation (UK)', 'values' => [$yes, $yes, $yes, $yes, $yes]],
                ],
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/pricing.css'])
@endpush

@section('content')
    <div
        class="pricing-page"
        x-data="{ basis: 'cash', region: 'us' }"
        :class="'is-' + region"
    >
        <section class="pricing-section" aria-labelledby="pricing-title">
            <div class="pricing-shell">
                <header class="pricing-header">
                    <h1 id="pricing-title">Pricing Based on Your Business Needs</h1>
                    <p class="pricing-header__sub">Flexible Pricing Example</p>
                </header>

                <div class="pricing-basis" role="tablist" aria-label="Accounting type">
                    <button
                        type="button"
                        class="pricing-basis__btn"
                        role="tab"
                        id="pricing-tab-cash"
                        :class="{ 'is-active': basis === 'cash' }"
                        :aria-selected="basis === 'cash'"
                        aria-controls="pricing-table-panel"
                        @click="basis = 'cash'"
                    >
                        Cash Base Accounting
                    </button>
                    <button
                        type="button"
                        class="pricing-basis__btn"
                        role="tab"
                        id="pricing-tab-accrual"
                        :class="{ 'is-active': basis === 'accrual' }"
                        :aria-selected="basis === 'accrual'"
                        aria-controls="pricing-table-panel"
                        @click="basis = 'accrual'"
                    >
                        Accrual Base Accounting
                    </button>
                </div>

                <div class="pricing-toolbar">
                    <div class="pricing-region" role="group" aria-label="Pricing region">
                        <button
                            type="button"
                            class="pricing-region__btn pricing-region__btn--us"
                            :class="{ 'is-active': region === 'us' }"
                            :aria-pressed="region === 'us'"
                            @click="region = 'us'"
                        >
                            US Pricing
                        </button>
                        <button
                            type="button"
                            class="pricing-region__btn pricing-region__btn--uk"
                            :class="{ 'is-active': region === 'uk' }"
                            :aria-pressed="region === 'uk'"
                            @click="region = 'uk'"
                        >
                            UK Pricing
                        </button>
                    </div>

                    <div class="pricing-table-titles">
                        <h2 class="pricing-table-title" x-show="basis === 'cash'">Cash Base Accounting</h2>
                        <h2 class="pricing-table-title" x-show="basis === 'accrual'" x-cloak>Accrual Base Accounting</h2>
                    </div>
                </div>

                <div class="pricing-table-panel" id="pricing-table-panel" role="tabpanel">
                    @foreach ($pricingTables as $basisKey => $regions)
                        @foreach ($regions as $regionKey => $table)
                            <div
                                class="pricing-table-scroll"
                                x-show="basis === '{{ $basisKey }}' && region === '{{ $regionKey }}'"
                                @unless ($basisKey === 'cash' && $regionKey === 'us') x-cloak @endunless
                            >
                                <table class="pricing-table">
                                    <caption class="sr-only">{{ $table['title'] }} {{ $table['price_label'] }} comparison</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="pricing-table__feature-head">Features</th>
                                            @foreach ($table['plans'] as $plan)
                                                <th
                                                    scope="col"
                                                    class="is-{{ $plan['key'] }}{{ $plan['popular'] ? ' is-popular' : '' }}"
                                                >
                                                    <span class="pricing-table__plan">{{ $plan['name'] }}</span>
                                                    @if ($plan['popular'])
                                                        <span class="pricing-popular">Popular</span>
                                                    @endif
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="pricing-table__volume">
                                            <th scope="row">Transaction Volume Per Month</th>
                                            @foreach ($table['plans'] as $plan)
                                                <td class="{{ $plan['popular'] ? 'is-popular' : '' }}">{{ $plan['volume'] }}</td>
                                            @endforeach
                                        </tr>
                                        <tr class="pricing-table__price">
                                            <th scope="row">{{ $table['price_label'] }}</th>
                                            @foreach ($table['plans'] as $plan)
                                                <td class="{{ $plan['popular'] ? 'is-popular' : '' }}">
                                                    <div class="pricing-price">
                                                        @if ($plan['price_old'])
                                                            <div class="pricing-price__offer">
                                                                <span class="pricing-off">20% OFF</span>
                                                                <span class="pricing-price__old">{{ $table['symbol'] }}{{ $plan['price_old'] }}</span>
                                                                <span class="pricing-price__new">{{ $table['symbol'] }}{{ $plan['price_new'] }}</span>
                                                            </div>
                                                        @else
                                                            <span class="pricing-price__custom">{{ $plan['price_new'] }}</span>
                                                        @endif
                                                        <button
                                                            type="button"
                                                            class="pricing-enquire"
                                                            data-contact-modal-trigger
                                                            data-contact-variant="pricing-enquire"
                                                            data-contact-service="{{ $plan['package'] }}"
                                                            aria-label="Enquire now about {{ $plan['package'] }}"
                                                        >
                                                            Enquire Now
                                                        </button>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                        @foreach ($table['features'] as $feature)
                                            <tr>
                                                <th scope="row">{{ $feature['name'] }}</th>
                                                @foreach ($feature['values'] as $index => $value)
                                                    @php $plan = $table['plans'][$index]; @endphp
                                                    <td class="{{ $plan['popular'] ? 'is-popular' : '' }}">
                                                        @if ($value === 'yes')
                                                            <span class="pricing-icon pricing-icon--yes">
                                                                <i class="fa-solid fa-check" aria-hidden="true"></i>
                                                                <span class="sr-only">Included</span>
                                                            </span>
                                                        @elseif ($value === 'no')
                                                            <span class="pricing-icon pricing-icon--no">
                                                                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                                                <span class="sr-only">Not included</span>
                                                            </span>
                                                        @else
                                                            <span class="pricing-addon">Add-on</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
