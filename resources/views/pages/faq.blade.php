@php
    $img = fn (string $file): string => asset('images/faq/'.$file);
    $contactUrl = route('page.show', ['slug' => 'contact-us']);
    $pricingUrl = route('page.show', ['slug' => 'pricing']);

    $groups = [
        [
            'id' => 'virtual-cfo',
            'title' => '01 FAQ Virtual CFO',
            'name' => 'faq-vcfo',
            'items' => [
                [
                    'q' => 'What would a Virtual CFO do for my company?',
                    'a' => [
                        'It depends on your company’s needs. The short answer is that which your own CFO or controller would do.',
                        'The difference is we have more experience and expertise on which to draw, and we only charge you when we are there.',
                    ],
                ],
                [
                    'q' => 'Does "virtual" mean that Virtual CFOs are only available online or over the phone? What if I need someone onsite?',
                    'a' => [
                        'The “virtual” in Virtual CFOs actually refers to the fact that we are not full-time employees. Otherwise we are very real. We work almost exclusively onsite at the client’s location where we can be most effective.',
                    ],
                ],
                [
                    'q' => 'Why do I need a Virtual CFO if I have a Public Accountant?',
                    'a' => [
                        'The “virtual” in Virtual CFOs actually refers to the fact that we are not full-time employees. Otherwise we are very real. We work almost exclusively onsite at the client’s location where we can be most effective.',
                    ],
                ],
                [
                    'q' => 'What is the difference between a Virtual CFO, a part time CFO, a fractional CFO, and a financial management consultant?',
                    'a' => [
                        'They are all terms used to describe a highly skilled financial professional who can provide a company with financial expertise and leadership that they would not have unless they had a full time CFO.',
                    ],
                ],
                [
                    'q' => 'Why do I need a Virtual CFO if my company has a controller?',
                    'a' => [
                        'You probably do not need a Virtual CFO if your controller: provides you with timely, accurate, and insightful financial and operational information about your business; is the person you trust to help you create and update your strategic plans; can help you assess your organizational efficiency; is helping you lead your company to the next level; has assembled a talented and professional accounting staff; can put together a financial package, effectively present it to your banker, and get the financing you need. If your controller cannot do these things, a Virtual CFO can.',
                    ],
                ],
                [
                    'q' => 'Is having a Virtual CFO expensive?',
                    'a' => [
                        'The idea of having a Virtual CFO is that your company only uses him for things that do not occur every day. Your staff is (or should be) able to handle day-to-day activity.',
                        'A Virtual CFO only works for you when you need him. It might be a day a week or a day a month. The cost at a day a week is less than half of the cost of a full-time controller.',
                    ],
                ],
                [
                    'q' => 'What if I don’t think I need a Virtual CFO every week? What if I just have a project I need completed?',
                    'a' => [
                        'Virtual CFOs will complete the projects your staff cannot.',
                    ],
                ],
            ],
        ],
        [
            'id' => 'bookkeeping',
            'title' => '02 Book Keeping',
            'name' => 'faq-bookkeeping',
            'items' => [
                [
                    'q' => 'Why do I need bookkeeping?',
                    'a' => [
                        'Having good bookkeeping will ensure you have efficient accounting systems. This helps you manage critical components of your business.',
                    ],
                ],
                [
                    'q' => 'Why should I outsource bookkeeping?',
                    'a' => [
                        'Most small and medium business owners do not have the knowledge, time or ability to effectively perform their bookkeeping duties. Outsourcing a bookkeeper will provide you with the time required to focus on your businesses operations.',
                    ],
                ],
                [
                    'q' => 'Can\'t my accountant or data entry person do my bookkeeping for me?',
                    'a' => [
                        'An accountant usually manages the preparation and filing of tax related tasks. A bookkeeping service handles your daily financial record keeping which affects the core components of your business. Bookkeepers even take care of the books using adjusted trial balance, maintain fixed assets, check extraneous expenses, take care of bank reconciliations, handle payrolls, and many more activities that are quite beyond the reach of an everyday accountant.',
                    ],
                ],
                [
                    'q' => 'Will I lose control of my business by outsourcing my bookkeeping?',
                    'a' => [
                        'Not at all. You, the business owner, maintain the final control and signing off authority on all transactions that the company undertakes. We provide you with all the information necessary to take the decision, but the final decision shall always remain yours.',
                    ],
                ],
                [
                    'q' => 'What services can you provide?',
                    'a' => [
                        'At IBN, We work with Restaurant industry, CPAs, eCommerce firms, Retail and Consumer businesses, IT Firms, Real Estate Firms and other business entities since 2007. Below are the services which we offered:',
                    ],
                ],
                [
                    'q' => 'Why should I outsource bookkeeping?',
                    'a' => [
                        'Most small and medium business owners do not have the knowledge, time or ability to effectively perform their bookkeeping duties. Outsourcing a bookkeeper will provide you with the time required to focus on your businesses operations.',
                    ],
                    'list' => [
                        'Book Keeping',
                        'Accounts Payable (AP/P2P)',
                        'Accounts Receivables (AR/O2C)',
                        'Bank Reconciliation',
                        'Payroll Processing',
                        'Fixed Asset Management',
                        'Tax Preparation',
                        'Financial statement preparation',
                        'Costing and Budgeting etc',
                    ],
                ],
                [
                    'q' => 'What software does First Class Accounts use?',
                    'a' => [
                        'We are certified with below:',
                    ],
                    'list' => [
                        'ISO 9001:2015 Certified Co.',
                        'Microsoft Gold Certified Partner',
                        'Wave Pro Network',
                        'Quick Books Pro advisors',
                        'Xero Certified Advisors',
                    ],
                    'a2' => [
                        'Apart from above certification, we have expertise in below accounting software’s',
                    ],
                    'list2' => [
                        'Creative Solution Accounting',
                        'Peach Tree',
                        'Tasbook 3',
                        'Bill.com',
                        'Intacct Software',
                        'Sage 50 Accounting',
                        'Sage Payroll',
                        'Quick Book Cash Register Plus – only for recording sales',
                        'Site Link Solutions For real estate and rented properties business purpose',
                    ],
                ],
                [
                    'q' => 'How much does a bookkeeper cost?',
                    'a' => [
                        'Virtual CFOs will complete the projects your staff cannot.',
                        'Major Differentiators at IBN apart from having committed expertise in domain is we have been successfully providing services at Outsourcing Cost, which is almost 40-50% cost saving compared to US and UK cost.',
                    ],
                    'after' => 'pricing',
                ],
            ],
        ],
        [
            'id' => 'bpo',
            'title' => '03 BPO',
            'name' => 'faq-bpo',
            'items' => [
                [
                    'q' => 'What does BPO stand for?',
                    'a' => [
                        'BPO stands for Business Process Outsourcing. In simple words, it is delegating the responsibilities of handling back office operations to reliable people outside your organisation.',
                    ],
                ],
                [
                    'q' => 'What are the different types of BPO processes/services provided by IBN?',
                    'a' => [
                        'since 1997.',
                        'Inbound Services – Technical support, Billing queries, refund request, sales support, customer retention and product information requests, sales and order fulfillment Outbound Services – prospective services and new service promotion Surveys and market research Data capturing and analysis services.',
                    ],
                ],
                [
                    'q' => 'How are project communications handled?',
                    'a' => [
                        'Ease of communication is a top service priority. Day-to-day production communication is handled via email, phone, Skype, web meeting',
                    ],
                ],
                [
                    'q' => 'How are documents and data exchanged?',
                    'a' => [
                        'IBN generally uses a remote connection directly in the client’s IS system (Remote Desktop, VPN, Web Services, Citrix), using the appropriate workflows, databases and files. Also document are exchanged through email, Google drive and dropbox.',
                    ],
                ],
                [
                    'q' => 'What about the safety of our customer data when we opt for BPO services from IBN Technologies Limited?',
                    'a' => [
                        'We, at IBN, believe in utmost privacy and security of any and all data that we work with. IBN Technologies has stringent policies in place, throughout its work processes, that ensure authenticity, confidentiality, and security of the data. Our secure servers ensure that none of the customer data goes beyond our network. IBN Technologies works like an additional limb of your own organisation. This ensure absolute transparency and visibility for you and allows control over the data you own.',
                    ],
                ],
                [
                    'q' => 'How does IBN Technologies Limited ensure quality and reliability in the services they offer?',
                    'a' => [
                        'Our testimonials from clients all over the world are a mark of pride that we wear for having promised, accurate, timely and reliable service provider in BPO industry. IBN earned certification for ISO 9001:2015 which is focused on meeting customer expectations and delivering customer satisfaction so you must pay attention to the customer.',
                    ],
                ],
                [
                    'q' => 'With a number of companies providing BPO services, why should I choose IBN Technologies Limited over anybody else?',
                    'a' => [
                        'With an extensive array of industry services that we provide outsourcing for, IBN provides a rare combination of expertise and variety that few business process outsourcing companies can provide. Tech-support services, both inbound and outbound, are proactive, timely, and extremely cost-effective.',
                        'Moreover, below are the 4 major benefits you will get once you outsource work to IBN',
                    ],
                    'benefits' => [
                        [
                            'title' => 'Time Benefit:',
                            'items' => [
                                'Allows to plan round the clock operations.',
                                'Data Processed & critical reports prepared overnight.',
                                'Allows you to focus on your business rather than on back office functions.',
                                'Streamlining priorities to avoid loss of business.',
                                'Save time from running the business & invest time in growing the business.',
                                'Time spent on managing administrative staff, hiring, evaluation, etc.',
                            ],
                        ],
                        [
                            'title' => 'Staff Benefit:',
                            'items' => [
                                'Highly Skilled Staff & already have experience working in US Processes which minimizes the cultural gap.',
                                'Wide Range of Industry experience from Finance & Accounting, AP / AR Support & Business Operations which includes customer support, Data Processing etc.',
                                'Understanding of Best Industry Practice & same help us in consulting approach for process improvements.',
                                'Right Level staff for different requirements',
                                'Reduce key employee risk as staff redundancy for each process is inbuilt in IBNs outsourcing approach.',
                            ],
                        ],
                        [
                            'title' => 'Business Benefit:',
                            'items' => [
                                'Cost Advantage',
                                'Save on Infrastructure and Technology for outsourced staff.',
                                'Access to Skilled Resources for expansion at short notice.',
                                'Time Zone Advantage.',
                                'Business continuity planning inbuilt as you have teams working at offshore location.',
                            ],
                        ],
                        [
                            'title' => 'Cost Benefit:',
                            'items' => [
                                'Lower cost of operations by 40%. This is even true for Jr. Accountant level staff in USA.',
                                'No Overhead Cost.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/faq.css'])
@endpush

@section('content')
    <div class="faq-page">
        <section class="faq-hero" aria-labelledby="faq-hero-title">
            <img
                class="faq-hero__bg"
                src="{{ $img('faq-hero.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                fetchpriority="high"
                decoding="async"
            >
            <div class="site-shell faq-hero__inner">
                <div class="faq-hero__copy">
                    <h1 id="faq-hero-title">FAQ</h1>
                    <p class="faq-hero__lede">How we work with clients</p>
                    <div class="faq-hero__actions">
                        <a href="{{ $contactUrl }}" class="faq-btn">
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-intro" aria-labelledby="faq-intro-title">
            <div class="site-shell">
                <h2 id="faq-intro-title" class="faq-intro__text">
                    We go deep to unlock insight and have the courage to act. We bring the right people together to challenge established thinking and drive transformation.
                </h2>
            </div>
        </section>

        @foreach ($groups as $group)
            <section class="faq-group" aria-labelledby="faq-{{ $group['id'] }}-title">
                <div class="site-shell">
                    <h2 id="faq-{{ $group['id'] }}-title" class="faq-group__title">{{ $group['title'] }}</h2>
                    <div class="faq-acc">
                        @foreach ($group['items'] as $index => $item)
                            <details
                                class="faq-acc__item"
                                name="{{ $group['name'] }}"
                                @if ($index === 0) open @endif
                            >
                                <summary>
                                    <span class="faq-acc__icon" aria-hidden="true"></span>
                                    <span>{{ $item['q'] }}</span>
                                </summary>
                                <div class="faq-acc__body">
                                    @foreach ($item['a'] as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach

                                    @if (! empty($item['list']))
                                        <ul>
                                            @foreach ($item['list'] as $entry)
                                                <li>{{ $entry }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if (! empty($item['a2']))
                                        @foreach ($item['a2'] as $paragraph)
                                            <p>{{ $paragraph }}</p>
                                        @endforeach
                                    @endif

                                    @if (! empty($item['list2']))
                                        <ul>
                                            @foreach ($item['list2'] as $entry)
                                                <li>{{ $entry }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if (! empty($item['benefits']))
                                        @foreach ($item['benefits'] as $benefit)
                                            <p><strong>{{ $benefit['title'] }}</strong></p>
                                            <ul>
                                                @foreach ($benefit['items'] as $entry)
                                                    <li>{{ $entry }}</li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    @endif

                                    @if (($item['after'] ?? null) === 'pricing')
                                        <p>
                                            <a href="{{ $pricingUrl }}">Click here for more information on pricing.</a>
                                        </p>
                                    @endif
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach
    </div>
@endsection
