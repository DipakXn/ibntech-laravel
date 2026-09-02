@php
    $img = fn (string $file): string => asset('images/supply-chain-management-manufacturing/'.$file);

    $salesReceivablesItems = [
        [
            'title' => 'Alternative Ship -Tos :',
            'open' => true,
            'body' => 'Set up multiple ship-to addresses to accommodate customers that in addition to a main business address have more than one site to which order can be shipped. These additional locations can then be selected by the order processor when creating a sales order or invoice.',
        ],
        [
            'title' => 'Basic Receivables :',
            'open' => false,
            'body' => 'Set up and maintain the customer table. Post sales transactions in journals and manage receivables; register customers and manage receivables using general journals. Together with Multiple Currencies, this module can post sales transactions and manage receivables in multiple currencies for each customer. Basic Receivables is integrated with Basic General Ledger and Inventory and is required for the configuration of all other Sales and Receivables module. Sales Invoicing is also frequently used with this module.',
        ],
        [
            'title' => 'Calendars :',
            'open' => false,
            'body' => 'Set up calendars with working and non-working days. Assign a base calendar to customers, vendors, locations, companies, shipping agent services, and the service management setup and make changes to each as necessary. Calendar entries will be used in date calculations on sales orders, purchase orders, transfer orders, production orders, service orders, and requisition and planning worksheets',
        ],
        [
            'title' => 'Campaign Pricing :',
            'open' => false,
            'body' => 'Work with sales prices and sales line discounts connected with specific campaigns. After you have activated the prices/ discounts, any customer or contact related to a company currently in a segment associated with a given campaign can access the price/discount associated with that campaign. Prices are valid for the life of the campaign or until you decide to deactivate them. When you create a sales document or service order, the campaign price/discount is included among the pricing reductions available when Microsoft Dynamics NAV chooses the price to retrieve on the line.',
        ],
        [
            'title' => 'Order Promising :',
            'open' => false,
            'body' => 'Promise accurate order shipment and delivery dates to customers based on an item’s current and future availability. When items are not available to meet a customer’s requested delivery date, calculate the earliest shipment date as either an available-to-promise date that is based on upcoming uncommitted supply or a capable-to-promise date—a date when items can become available should they be replenished.',
        ],
        [
            'title' => 'Sales Invoicing :',
            'open' => false,
            'body' => 'Set up, post, and print customer invoices and sales credit memos. This module is fully integrated with General Ledger and Inventory.',
        ],
        [
            'title' => 'Sales Line Discounting :',
            'open' => false,
            'body' => 'Manage flexible item price discount structures that differentiate between special agreements with individual customers and customer groups, and are conditioned by such parameters as minimum quantity, unit of measure, currency, item variant and time period. The best unit price, as based on the highest discount, unit price is calculated for the sales line when the order details meet the conditions specified in the sales line discounts table.',
        ],
        [
            'title' => 'Sales Line Pricing :',
            'open' => false,
            'body' => 'Manage flexible item price structures that differentiate between special agreements with individual customers and customer groups, and are conditioned by such parameters as minimum quantity, unit of measure, currency, item variant and time period. The best, that is, the lowest, unit price is brought to the sales line when the order details meet the conditions specified in the sales prices table. Make updates and changes to the price agreements as recorded in the sales prices table by using the sales price worksheet.',
        ],
        [
            'title' => 'Sales Order Management :',
            'open' => false,
            'body' => 'Manage sales quotes, blanket sales orders, and sales order processes. Setting up an invoice directly differs from setting up a sales order in which the quantity available is adjusted as soon as an amount is entered on a sales order line. Quantity available is not affected by an invoice until the invoice is posted. Use the Sales Order Management module to: > Manage partial shipments. > Ship and invoice separately. > Create prepayment invoices for the sales order. > Use quotes and blanket orders in the sales phase. (Quotes and blanket orders do not affect inventory figures.)',
        ],
        [
            'title' => 'Sales Return Order Management :',
            'open' => false,
            'body' => 'This module enables you to create a sales return order, so you can compensate a customer for wrong or damaged items. Items can be received against the sales return order. Create a partial return receipt or combine return receipts on one credit memo. Link sales return orders with replacement sales orders.',
        ],
        [
            'title' => 'Shipping Agents :',
            'open' => false,
            'body' => 'Set up multiple shipping agents (for example, UPS, DHL, external carriers, or your own carrier) and relate their services (express, overnight, standard) with shipping time. Associate default shipping agents and their services with individual customers or specify those details on sales orders and transfer orders to improve accuracy of order promising.',
        ],
    ];

    $salesTaxItems = [
        [
            'title' => 'Sales Tax :',
            'open' => true,
            'body' => 'Calculate Sales Tax and set up individual tax areas for each customer and vendor. Also enables you to calculate the use tax on the tax. Sales tax can also be calculated from the general journal lines. Please check your local pricelist for availability',
        ],
    ];

    $purchasePayablesItems = [
        [
            'title' => 'Alternative Order Addresses :',
            'open' => true,
            'body' => 'Set up multiple addresses to manage orders from vendors that in addition to a main business address have more than one site from which they ship orders. These additional locations can then be selected by the purchasing agent when creating a purchase order or invoice.',
        ],
        [
            'title' => 'Basic Payables :',
            'open' => false,
            'body' => 'Set up and maintain a vendor table, post purchase transactions in journals, and manage payables. Includes the vendor table and enables you to generate vendor ledger entries using general journals. Use this together with the Multiple Currencies module to post purchase transactions and manage payables in multiple currencies for each vendor. This module is always used if your solution requires a vendor table. It is integrated with General Ledger and Inventory and it is required for the configuration of all other Purchase and Payabfrequently used with this module.',
        ],
        [
            'title' => 'Drop Shipments :',
            'open' => false,
            'body' => 'Handle order shipments directly from the vendor to the customer without having to physically stock items in your inventory while still keeping track of order costs and profit. The drop shipment process is facilitated through the automatic linking of sales and purchase orders that control the built-in sequence of posting tasks.',
        ],
        [
            'title' => 'Purchase Invoicing :',
            'open' => false,
            'body' => 'Set up, post, and print purchase invoices and purchase credit memos. This module is integrated with General Ledger and Inventory.',
        ],
        [
            'title' => 'Purchase Line Discounting :',
            'open' => false,
            'body' => 'Manage multiple item purchase price discounts that you have negotiated with individual vendors as based on such parameters as minimum quantity, unit of measure, currency, item variant and time period. The best, as based on the highest discount, unit cost is calculated for the purchase line when the order details meet the conditions specified in the purchase line discounts table.',
        ],
        [
            'title' => 'Purchase Invoice Discounts :',
            'open' => false,
            'body' => 'Calculate invoice discounts automatically. The discount can differ from vendor to vendor with different minimum amounts (also in different currencies) and different rates, depending on the size of the invoice. The discount is calculated on the individual item lines and becomes part of the net sum of the invoice.',
        ],
        [
            'title' => 'Purchase Order Management :',
            'open' => false,
            'body' => 'Manage purchase quotes, blanket orders, and purchase order processes. Creating a purchase order differs from creating a purchase invoice directly. The quantity available is adjusted as soon as an amount is entered on a purchase order line, but it is not affected by a purchase invoice until the invoice is posted. Use this module to: > Manage partial receipts. > Receive and invoice separately and create prepayment invoices for the purchase order. > Use quotes and blanket orders in the purchase phase. (Quotes and blanket orders do not affect inventory figures.)',
        ],
        [
            'title' => 'Purchase Return Order Management :',
            'open' => false,
            'body' => 'Create a purchase return order in order to compensate your own company for wrong or damaged items. Items can then be picked from the purchase return order. You can set up partial return shipments or combine return shipments in one credit memo and link purchase return orders with replacement purchase orders.',
        ],
        [
            'title' => 'Requisition Management :',
            'open' => false,
            'body' => 'Automate the supply planning process by using the Requisition Worksheet. Generate optimal suggestions for replenishing inventory through purchases and transfers based on the items current and future demand and availability, as well as a variety of planning parameters, such as minimum and maximum quantities and reorder quantities. Display a graphical overview of the planning impact and allow the user to change the plan using a drag-and-drop operation, prior to executing the plan. Alternatively, use Order Planninga simplified supply planning tool that enables you to plan supply for all types of demand in an order-by-order fashion, with no considerations for optimization.',
        ],
    ];

    $inventoryItems = [
        [
            'title' => 'Analysis Reports',
            'open' => true,
            'body' => 'Set up multiple addresses to manage orders from vendors that in addition to a main business address have more than one site from which they ship orders. These additional locations can then be selected by the purchasing agent when creating a purchase order or invoice.',
        ],
        [
            'title' => 'Alternative Vendors :',
            'open' => false,
            'body' => 'Set up multiple addresses to manage orders from vendors that in addition to a main business address have more than one site from which they ship orders. These additional locations can then be selected by the purchasing agent when creating a purchase order or invoice.',
        ],
        [
            'title' => 'Basic Inventory :',
            'open' => false,
            'body' => 'Set up multiple addresses to manage orders from vendors that in addition to a main business address have more than one site from which they ship orders. These additional locations can then be selected by the purchasing agent when creating a purchase order or invoice.',
        ],
        [
            'title' => 'Bin',
            'open' => false,
            'body' => 'Set up multiple addresses to manage orders from vendors that in addition to a main business address have more than one site from which they ship orders. These additional locations can then be selected by the purchasing agent when creating a purchase order or invoice.',
        ],
        [
            'title' => 'Cycle Counting',
            'open' => false,
            'body' => 'Set up multiple addresses to manage orders from vendors that in addition to a main business address have more than one site from which they ship orders. These additional locations can then be selected by the purchasing agent when creating a purchase order or invoice.',
        ],
        [
            'title' => 'Item Budgets :',
            'open' => false,
            'body' => 'Make sales and purchase budgets on the customer, vendor, and item levels, and in both amounts and quantities. Prepare and record a sales budget that can serve as input to decisionmakers in other operational areas, such as purchasing and logistics. Decision-makers gain information about future expected demand that they can use for business discussions with the customers. After budgets are made, track the actual sales performance by means of calculating the variance. The ability to move budgeted figures between the system and Excel provides additional flexibility to the budgeting process.',
        ],
        [
            'title' => 'Item Charges :',
            'open' => false,
            'body' => 'Manage item charges. Include the value of additional cost components such as freight or insurance into the unit cost or unit price of an item.',
        ],
        [
            'title' => 'Item Cross References :',
            'open' => false,
            'body' => 'Quickly and precisely identify the items a customer is ordering on the basis of item numbers other than your own. Cross-reference information from customers, vendors, and manufacturers, as well as generic numbers, universal product codes (UPCs), and European article numbers (EANs) that can be stored and easily accessed.',
        ],
        [
            'title' => 'Item Substitutions :',
            'open' => false,
            'body' => 'Link items with the same or similar characteristics so that if a customer orders an item that is unavailable, you can offer substitute items and avoid losing the sale. Or, provide an extra service to your customer by offering lower-cost alternatives.',
        ],
        [
            'title' => 'Item Tracking :',
            'open' => false,
            'body' => 'Link items with the same or similar characteristics so that if a customer orders an item that is unavailable, you can offer substitute items and avoid losing the sale. Or, provide an extra service to your customer by offering lower-cost alternatives.',
        ],
        [
            'title' => 'Item Categories :',
            'open' => false,
            'body' => 'Use item categories to group items into a hierarchical structure and you can define your own custom categories, assigning attributes to each category. When you add items to a category, the items inherit the attributes of the category, ensuring a common set of attributes on items in the same category, and saving you time. If required, you can still assign item specific attributes to particular items.',
        ],
        [
            'title' => 'Item Attributes :',
            'open' => false,
            'body' => 'Use item attributes to add custom data, such as color, country of manufacture, size, or product dimensions, to applicable items, supplementing built-in global item fields. You can define your own type of attribute options, including list, text, integer, and decimal, along with unit of measure for the two latter numeric types. Attribute names and option list entries can also be translated to support multiple language requirements. You can also block attributes or attribute option values from being used in the future, for example, if they are no longer applicable. When you add items to sales and purchase documents, or just organize your items, you can view and filter on the attribute values to limit the list of items to choose from or take action on.',
        ],
        [
            'title' => 'Image Analyzer :',
            'open' => false,
            'body' => 'The Image Analyzer extension uses powerful image analytics provided by the Computer Vision API for Microsoft Cognitive Services to detect attributes in images you add to items and contact persons.',
        ],
        [
            'title' => 'Assembly Management :',
            'open' => false,
            'body' => 'Specify a list of sellable items, raw materials, subassemblies and/ or resources as an Assembly Bill of Materials that comprises a finished item or a kit. Use assembly orders to replenish assembly items, to stock or capture the customers special requirements to the kit’s bill of materials directly from the sales quote, blanket, and order line in the assembly-to-order processes.',
        ],
        [
            'title' => 'Location Transfers :',
            'open' => false,
            'body' => 'Track inventory as it is moved from one location to another and account for the value of inventory in transit and at various locations.',
        ],
        [
            'title' => 'Multiple Locations :',
            'open' => false,
            'body' => 'Serenity Is Multi-Faceted Blockchain Based Ecosystem, Energy Retailer For The People, Focusing On The Promotion Of Sustainable Living, ReManage inventory in multiple locations that may represent a production plant, distribution centers, warehouses, show rooms, retail outlets and service cars. newable Energy Production And Smart Energy Grid Utility Services.',
        ],
        [
            'title' => 'Nonstock Items :',
            'open' => false,
            'body' => 'Offer items to customers that are not part of your regular inventory but that you can order from the vendor or manufacturer on a one-off basis. Such items are registered as nonstock items but otherwise are treated like any other item.',
        ],
    ];

    $warehouseItems = [
        [
            'title' => 'Automated Data Capture System (ADCS)',
            'body' => 'Capture data automatically. Keep data accurate, even in a hectic environment. ADCS supports some of the workflows in the Warehouse Management Systems module that enables warehouse automation.',
        ],
        [
            'title' => 'Bin Setup',
            'body' => 'Easily set up and maintain your bins by defining both the layout of your warehouse and dimensions of your racks, columns, and shelves; set up and maintain your planning parameters by defining the limitations and characteristics of each bin.',
        ],
        [
            'title' => 'Internal Picks and Put-Aways',
            'body' => 'Create pick and put-away orders for internal purposes, without using a source document (such as a purchase order or a sales order). For example, pick items for testing or put away production output.',
        ],
        [
            'title' => 'Warehouse Management Systems',
            'body' => 'Manage items on a bin level. Receive and put away items in a bin; pick items from a bin according to a put-away template; and pick items based on the zone and bin ranking. Move items between bins using a report for optimizing the space usage and the picking process, or move items manually. Warehouse instruction documents are created for the pick and put-away process, which can be carried out for sales, purchases, transfers, returns, and production orders. Service orders are not included.',
        ],
    ];

    $manufacturingItems = [
        [
            'title' => 'Production Bill of Materials',
            'body' => 'Create bills of materials and calculate standard costs. Required for the configuration of all other Manufacturing modules.',
        ],
        [
            'title' => 'Production Orders',
            'body' => 'Create and manage production orders, and post consumption and output to the production orders. After you have created a production order, you can calculate net requirements based on that production order. The Production Orders module includes a manual supply planning tool as an alternative to automatic planning. The Order Planning window provides the visibility and tools you need to manually plan for demand from sales lines and then to create different types of supply orders directly.',
        ],
        [
            'title' => 'Agile Manufacturing',
            'body' => 'This module enables you to run the Agile Manufacturing, Supply Planning, and Capacity Planning modules.',
        ],
        [
            'title' => 'Version Management',
            'body' => 'Create and manage different versions of the manufacturing bill of materials and routings. You must purchase the Basic Capacity Planning module before you can set up multiple versions of routings.',
        ],
    ];

    $supplyCapacityItems = [
        [
            'title' => 'Basic Supply Planning',
            'body' => 'Plan material requirements based on demand with support for master production scheduling and materials requirements planning. Basic Supply Planning includes:',
            'list' => [
                'Automatic production orders and purchase orders.',
                'Action messages for fast and easy balancing of supply and demand.',
                'Support for bucket-less and bucketed material requirements planning.',
                'The Setup for items with their own reordering policy, including registration of whether they are manufactured by or purchased from a third party.',
            ],
        ],
        [
            'title' => 'Demand Forecasting',
            'body' => 'Manage demand forecasting based on items. Input demand (sales) forecasts for products and components in a more convenient way (daily, monthly, quarterly). This data allows the system to plan and create production and purchase orders taking into consideration the demand forecast together with the level of available inventory and parameters of requirement planning.',
        ],
        [
            'title' => 'Sales and Inventory Forecasting',
            'body' => 'You can use the Sales and Inventory Forecast extension to get deep insights about potential sales and a clear overview of expected stock-outs. The built-in Cortana Intelligence leverages historical data and helps you manage your stock and respond to your customers. Based on the forecast, the Sales and Inventory extension helps create replenishment requests for vendors and saves you time.',
        ],
        [
            'title' => 'Basic Capacity Planning',
            'body' => 'Add capacities (work centers) to the manufacturing process. Set up routings and use these routings on production orders and in material requirements planning. View loads and the task list for the capacities.',
        ],
        [
            'title' => 'Finite Loading',
            'body' => 'Manage finite loading of capacity-constraint resources. Taking capacity constraints into account so that no more work is assigned to a work center than the capacities can be expected to execute during a given time period. This is a simple tool without any optimization. Used with the Order Promising module, Finite Loading also enables the system to calculate capable-to-promise (CTP).',
        ],
        [
            'title' => 'Machine Centers',
            'body' => 'Add machine centers as capacities to the manufacturing process. Machine centers are designed to help you manage capacity of a single machine/producing resource. With machine centers, you can plan/manage capacity on several levels: on a more detailed level for machine centers and on a consolidated level for work centers. Machine centers allow users to store more default information about manufacturing processes, such as setup time or default scrap percentage.',
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/supply-chain-management-manufacturing.css'])
@endpush

@section('content')
    <div class="scmm-page">
        {{-- Hero Section --}}
        <section class="scmm-hero" aria-labelledby="scmm-hero-title">
            <img
                class="scmm-hero__bg"
                src="{{ $img('supply-chain-management-manufacturing.webp') }}"
                alt=""
                aria-hidden="true"
                width="1400"
                height="700"
                decoding="async"
                fetchpriority="high"
            >
            <div class="site-shell scmm-hero__inner">
                <div class="scmm-hero__copy">
                    <h1 id="scmm-hero-title">Supply Chain Management &amp; Manufacturing</h1>
                    <div class="scmm-hero__actions">
                        <a
                            href="{{ route('page.show', ['slug' => 'contact-us']) }}"
                            class="scmm-btn scmm-btn--cream"
                        >
                            Get a Free Consultation Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content Sections --}}
        <div class="scmm-content">
            {{-- Section 1: Sales and Receivables --}}
            <section class="scmm-section" aria-labelledby="scmm-sales-receivables-title">
                <div class="site-shell">
                    <h2 id="scmm-sales-receivables-title" class="scmm-heading">Sales and Receivables</h2>

                    <div class="scmm-acc">
                        @foreach ($salesReceivablesItems as $item)
                            <details @if ($item['open']) open @endif>
                                <summary>
                                    <span class="scmm-acc__icon" aria-hidden="true">
                                        <svg class="scmm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                        </svg>
                                        <svg class="scmm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                        </svg>
                                    </span>
                                    <span class="scmm-acc__title">{{ $item['title'] }}</span>
                                </summary>
                                <div class="scmm-acc__body">
                                    <p>{{ $item['body'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Section 2: Sales Tax --}}
            <section class="scmm-section" aria-labelledby="scmm-sales-tax-title">
                <div class="site-shell">
                    <h2 id="scmm-sales-tax-title" class="scmm-heading">Sales Tax</h2>

                    <div class="scmm-acc">
                        @foreach ($salesTaxItems as $item)
                            <details @if ($item['open']) open @endif>
                                <summary>
                                    <span class="scmm-acc__icon" aria-hidden="true">
                                        <svg class="scmm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                        </svg>
                                        <svg class="scmm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                        </svg>
                                    </span>
                                    <span class="scmm-acc__title">{{ $item['title'] }}</span>
                                </summary>
                                <div class="scmm-acc__body">
                                    <p>{{ $item['body'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Section 3: Purchase and Payables --}}
            <section class="scmm-section" aria-labelledby="scmm-purchase-payables-title">
                <div class="site-shell">
                    <h2 id="scmm-purchase-payables-title" class="scmm-heading">Purchase and Payables</h2>

                    <div class="scmm-acc">
                        @foreach ($purchasePayablesItems as $item)
                            <details @if ($item['open']) open @endif>
                                <summary>
                                    <span class="scmm-acc__icon" aria-hidden="true">
                                        <svg class="scmm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                        </svg>
                                        <svg class="scmm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                        </svg>
                                    </span>
                                    <span class="scmm-acc__title">{{ $item['title'] }}</span>
                                </summary>
                                <div class="scmm-acc__body">
                                    <p>{{ $item['body'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Section 4: Inventory --}}
            <section class="scmm-section" aria-labelledby="scmm-inventory-title">
                <div class="site-shell">
                    <h2 id="scmm-inventory-title" class="scmm-heading">Inventory</h2>

                    <div class="scmm-acc">
                        @foreach ($inventoryItems as $item)
                            <details @if ($item['open']) open @endif>
                                <summary>
                                    <span class="scmm-acc__icon" aria-hidden="true">
                                        <svg class="scmm-acc__icon-plus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm200 136c0-13.3-10.7-24-24-24s-24 10.7-24 24v80h-80c-13.3 0-24 10.7-24 24s10.7 24 24 24h80v80c0 13.3 10.7 24 24 24s24-10.7 24-24v-80h80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-80v-80z"></path>
                                        </svg>
                                        <svg class="scmm-acc__icon-minus" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M384 80c26.5 0 48 21.5 48 48v256c0 26.5-21.5 48-48 48H64c-26.5 0-48-21.5-48-48V128c0-26.5 21.5-48 48-48h320zM64 32C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm40 200c-13.3 0-24 10.7-24 24s10.7 24 24 24h240c13.3 0 24-10.7 24-24s-10.7-24-24-24H104z"></path>
                                        </svg>
                                    </span>
                                    <span class="scmm-acc__title">{{ $item['title'] }}</span>
                                </summary>
                                <div class="scmm-acc__body">
                                    <p>{{ $item['body'] }}</p>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Section 5: Warehouse Management --}}
            <section class="scmm-section" aria-labelledby="scmm-warehouse-title">
                <div class="site-shell">
                    <h2 id="scmm-warehouse-title" class="scmm-heading">Warehouse Management</h2>

                    <div class="scmm-blocks">
                        @foreach ($warehouseItems as $item)
                            <div class="scmm-block">
                                <h3 class="scmm-block__title">{{ $item['title'] }}</h3>
                                <p class="scmm-block__body">{{ $item['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Section 6: Manufacturing --}}
            <section class="scmm-section" aria-labelledby="scmm-manufacturing-title">
                <div class="site-shell">
                    <h2 id="scmm-manufacturing-title" class="scmm-heading">Manufacturing</h2>

                    <div class="scmm-blocks">
                        @foreach ($manufacturingItems as $item)
                            <div class="scmm-block">
                                <h3 class="scmm-block__title">{{ $item['title'] }}</h3>
                                <p class="scmm-block__body">{{ $item['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Section 7: Supply & Capacity Planning --}}
            <section class="scmm-section scmm-section--last" aria-labelledby="scmm-supply-capacity-title">
                <div class="site-shell">
                    <h2 id="scmm-supply-capacity-title" class="scmm-heading">Supply &amp; Capacity Planning</h2>

                    <div class="scmm-blocks">
                        @foreach ($supplyCapacityItems as $item)
                            <div class="scmm-block">
                                <h3 class="scmm-block__title">{{ $item['title'] }}</h3>
                                <p class="scmm-block__body">{{ $item['body'] }}</p>
                                @if (! empty($item['list']))
                                    <ul class="scmm-block__list">
                                        @foreach ($item['list'] as $li)
                                            <li>{{ $li }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
