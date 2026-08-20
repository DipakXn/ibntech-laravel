@extends('layouts.landing')

@php
    $inrToUsd = 85.6933;

    $calculator = [
        100 => ['tools' => 275000, 'fte' => 500000, 'impl' => 60000, 'ibn' => 65000],
        200 => ['tools' => 300000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 71000],
        300 => ['tools' => 325000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 77000],
        400 => ['tools' => 350000, 'fte' => 600000, 'impl' => 60000, 'ibn' => 83000],
        500 => ['tools' => 375000, 'fte' => 800000, 'impl' => 60000, 'ibn' => 89000],
        600 => ['tools' => 400000, 'fte' => 800000, 'impl' => 90000, 'ibn' => 95000],
        700 => ['tools' => 425000, 'fte' => 900000, 'impl' => 90000, 'ibn' => 101000],
        800 => ['tools' => 450000, 'fte' => 1000000, 'impl' => 90000, 'ibn' => 107000],
        900 => ['tools' => 475000, 'fte' => 1200000, 'impl' => 100000, 'ibn' => 113000],
        1000 => ['tools' => 500000, 'fte' => 1400000, 'impl' => 100000, 'ibn' => 119000],
    ];

    $usd = function (int $amount) use ($inrToUsd): string {
        return '$ '.number_format($amount / $inrToUsd, 2, '.', ',');
    };

    $base = $calculator[100];
    $baseInHouse = $base['tools'] + $base['fte'] + $base['impl'];
    $baseSaving = $baseInHouse - $base['ibn'];
    $basePercent = (string) round(($baseSaving / $baseInHouse) * 100).'%';
@endphp

@section('content')
<div class="lsoc-page">
    <h1 class="sr-only">SOC Calculator</h1>

    <section class="lsoc-calculator" aria-label="SOC cost calculator">
        <div
            class="lsoc-calc"
            id="calculator"
            data-rate="{{ $inrToUsd }}"
            data-costs='@json($calculator)'
        >
            <label class="lsoc-calc__select-label" for="lsoc-users">
                <strong>SELECT USER COUNT :</strong>
            </label>
            <select id="lsoc-users" name="users">
                @foreach (array_keys($calculator) as $count)
                    <option value="{{ $count }}">{{ $count }} Users</option>
                @endforeach
            </select>

            <label for="lsoc-toolsCost">
                <strong>IN-HOUSE SOC EXPENSES </strong><br>
                SIEM Platform, SOAR Platform, Endpoint Detection &amp; Response (EDR) PlatformS, Extended Detection &amp; Response (XDR) Platform, Threat Intelligence Feed, Cloud Compute, Vulnerability Assessment, Ticketing Platform :
            </label>
            <input id="lsoc-toolsCost" type="text" value="{{ $usd($base['tools']) }}" readonly>

            <label for="lsoc-employeeCost">
                <strong>FULL TIME EMPLOYEE COMPENSATION 24x7 :</strong><br>
                Security Analysts , SOC Manager , Security Engineers ,Threat Researchers
            </label>
            <input id="lsoc-employeeCost" type="text" value="{{ $usd($base['fte']) }}" readonly>

            <label for="lsoc-maintenanceCost">
                <strong>PRODUCT IMPLEMENTATION &amp; MAINTENANC :</strong>
            </label>
            <input id="lsoc-maintenanceCost" type="text" value="{{ $usd($base['impl']) }}" readonly>

            <label for="lsoc-inHouseTotal">
                <strong>TOTAL IN-HOUSE COST :</strong>
            </label>
            <input id="lsoc-inHouseTotal" type="text" value="{{ $usd($baseInHouse) }}" readonly>

            <label for="lsoc-ourCost">
                <strong>OUR ESTIMATED COST ANNUALLY :</strong>
            </label>
            <input id="lsoc-ourCost" type="text" value="{{ $usd($base['ibn']) }}" readonly>

            <label for="lsoc-saving">
                <strong>TOTAL SAVING :</strong>
            </label>
            <input id="lsoc-saving" type="text" value="{{ $usd($baseSaving) }}" readonly>

            <label for="lsoc-percentsaving">
                <strong>SAVING :</strong>
            </label>
            <input id="lsoc-percentsaving" type="text" value="{{ $basePercent }}" readonly>
        </div>
    </section>

    <button class="lsoc-sales" type="button" data-lsoc-open aria-haspopup="dialog" aria-controls="lsoc-consult">
        Speak to Sales
    </button>

    <div class="lsoc-modal" id="lsoc-consult" hidden>
        <div class="lsoc-modal__backdrop" data-lsoc-close></div>
        <div
            class="lsoc-modal__panel"
            role="dialog"
            aria-modal="true"
            aria-labelledby="lsoc-consult-title"
        >
            <button class="lsoc-modal__close" type="button" data-lsoc-close aria-label="Close consultation form">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <h2 id="lsoc-consult-title">Schedule A Free Consultation!</h2>
            <livewire:forms.landing-inquiry-form
                :landing-page-slug="$landingPage->slug"
                :landing-page-title="$landingPage->title"
                id-prefix="lp-soc-calculator"
                wire:key="landing-inquiry-soc-calculator"
            />
        </div>
    </div>
</div>

<script>
    (function () {
        const root = document.getElementById('calculator');
        const select = document.getElementById('lsoc-users');
        const modal = document.getElementById('lsoc-consult');

        if (root && select) {
            const costs = JSON.parse(root.getAttribute('data-costs') || '{}');
            const rate = Number(root.getAttribute('data-rate') || '85.6933');
            const money = (value) => '$ ' + (Number(value) / rate).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            const setValue = (id, value) => {
                const field = document.getElementById(id);
                if (field) {
                    field.value = value;
                }
            };

            const update = () => {
                const row = costs[select.value];

                if (!row) {
                    return;
                }

                const inHouse = row.tools + row.fte + row.impl;
                const saving = inHouse - row.ibn;

                setValue('lsoc-toolsCost', money(row.tools));
                setValue('lsoc-employeeCost', money(row.fte));
                setValue('lsoc-maintenanceCost', money(row.impl));
                setValue('lsoc-inHouseTotal', money(inHouse));
                setValue('lsoc-ourCost', money(row.ibn));
                setValue('lsoc-saving', money(saving));
                setValue('lsoc-percentsaving', Math.round((saving / inHouse) * 100) + '%');
            };

            select.addEventListener('change', update);
            update();
        }

        if (!modal) {
            return;
        }

        const openModal = () => {
            modal.hidden = false;
            document.body.classList.add('lsoc-modal-open');
        };

        const closeModal = () => {
            modal.hidden = true;
            document.body.classList.remove('lsoc-modal-open');
        };

        document.querySelectorAll('[data-lsoc-open]').forEach((button) => {
            button.addEventListener('click', openModal);
        });

        document.querySelectorAll('[data-lsoc-close]').forEach((button) => {
            button.addEventListener('click', closeModal);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.hidden) {
                closeModal();
            }
        });
    })();
</script>
@endsection
