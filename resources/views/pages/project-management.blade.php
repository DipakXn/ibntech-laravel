@php
    $img = fn (string $file): string => asset('images/project-management/'.$file);

    $generalItems = [
        [
            'title' => 'Resources Basic',
            'open' => true,
            'body' => 'Resources Keep track of resources and prices. Register and sell resources, combine related resources into one resource group, or track individual resources. Divide resources into labor and equipment and allocate resources to a specific job in a time schedule.',
            'list' => [],
        ],
        [
            'title' => 'Capacity Management',
            'open' => false,
            'body' => 'Plan capacity and sales, and manage usage statistics and profitability of resources. Create your plan in a calendar system with the required level of detail and for the period of time that you need. Also monitor resource usage and get a complete overview of your capacity for each resource with information about availability and planned costs on orders and quotes',
            'list' => [],
        ],
        [
            'title' => 'Multiple Costs',
            'open' => false,
            'body' => 'Manage alternative costs for resources and resource groups. The costs can be fixed or based on an additional percentage or an additional fixed charge. Define as many work types as you need.',
            'list' => [],
        ],
        [
            'title' => 'Jobs',
            'open' => false,
            'body' => 'Keep track of usage on jobs and data for invoicing the customer. Manage both fixed-price jobs and time-and-materials jobs. You can also:',
            'list' => [
                'Create a plan for a job with multiple tasks and task groupings. Each task can have a budget and can be done for whatever period of time you need.',
                'Copy a budget from one job to another and set up a job-specific price list for charging of items, resources, and general ledger account expenses to the job’s customer.',
                'View suggested Work in Progress and Recognition postings for a job.',
                'Plan and invoice the job in a currency other than the local currency using Jobs together with Multiple Currencies.',
                'Assign a specific job to a specific customer and invoice the job completely or partially using Jobs together with Sales Invoicing.',
                'Use the new Jobs setup wizard to set up jobs, enter time sheets, and Job Journals more easily, and use the updated Project Manager role center to quickly access common tasks, new charts, and a new My Jobs list.',
                'On the Job Card, you can see tasks, use the new Project Manager field, and get better visibility into the costs and billings for your jobs.',
                'A new Job Quote report enables you to quickly email a customer the price for a project.',
            ],
        ],
        [
            'title' => 'Time Sheet',
            'open' => false,
            'body' => 'Time Sheet is a simple and flexible solution for time registration with manager approval. Time Sheet provides integration to the Service, Jobs, and Basic Resources modules.',
            'list' => [],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/project-management.css'])
@endpush

@section('content')
    <div class="pm-page">
        <section class="pm-hero" aria-labelledby="pm-hero-title">
            <img
                class="pm-hero__bg"
                src="{{ $img('project-management.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell pm-hero__inner">
                <div class="pm-hero__copy">
                    <h1 id="pm-hero-title">Project Management</h1>
                    <div class="pm-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="pm-btn pm-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="pm-section" aria-labelledby="pm-general-title">
            <div class="site-shell">
                <h2 id="pm-general-title" class="pm-heading">General</h2>

                <div class="pm-acc">
                    @foreach ($generalItems as $item)
                        <details name="pm-general" @if ($item['open']) open @endif>
                            <summary>
                                <span class="pm-acc__icon" aria-hidden="true">
                                    <svg class="pm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                    </svg>
                                    <svg class="pm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                    </svg>
                                </span>
                                <span class="pm-acc__title">{{ $item['title'] }}</span>
                            </summary>
                            <div class="pm-acc__body">
                                <p>{{ $item['body'] }}</p>
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
    </div>
@endsection
