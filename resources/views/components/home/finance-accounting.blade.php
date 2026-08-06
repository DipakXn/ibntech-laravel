@php
    $services = [
        ['title' => 'Bookkeeping Services', 'text' => 'Accurate, real-time records', 'icon' => 'fa-book'],
        ['title' => 'Tax Return Preparation', 'text' => 'US, UK & 1040 filing', 'icon' => 'fa-file-invoice-dollar'],
        ['title' => 'AP / AR Services', 'text' => 'Accounts payable & receivable', 'icon' => 'fa-file-invoice'],
        ['title' => 'AP / AR Automation', 'text' => 'Automated AP & AR workflows', 'icon' => 'fa-robot'],
        ['title' => 'Payroll Services', 'text' => 'Efficient payroll management', 'icon' => 'fa-money-check-dollar'],
        ['title' => 'Treasury Management', 'text' => 'Optimising cash flow', 'icon' => 'fa-wallet'],
        ['title' => 'Financial Reporting', 'text' => 'Insights & planning', 'icon' => 'fa-chart-pie'],
        ['title' => 'Virtual CFO Services', 'text' => 'Strategic financial leadership', 'icon' => 'fa-briefcase'],
    ];

    $software = [
        'Quickbooks.webp', 'xero.webp', 'Netsuite.webp', 'Sage.webp', 'zoho-books.webp', 'wave.webp',
        'gusto.webp', 'billcertificate.webp', 'float-certified.webp', 'relay-certified-banking.webp', 'adp.webp', 'yardi.webp',
    ];

    $certified = [
        'quickbook.webp', 'xero-advisor.webp', 'gusto-payroll.webp', 'billcertificate.webp', 'float-certified.webp', 'relay-certified-banking.webp',
    ];
@endphp

<section class="home-section home-section--mint" aria-labelledby="home-finance-title">
    <div class="home-shell">
        <div class="flex items-center gap-3">
            <span class="inline-grid h-11 w-11 place-items-center rounded-xl bg-[#1f6b36] text-white">
                <i class="fa-solid fa-calculator" aria-hidden="true"></i>
            </span>
            <div>
                <h2 id="home-finance-title" class="text-2xl font-bold text-[#1f6b36] md:text-3xl">Finance &amp; Accounting Services</h2>
                <p class="text-[var(--home-muted)]">Smarter Decisions. Faster Outcomes.</p>
            </div>
        </div>

        <div class="home-finance__layout">
            <aside class="home-finance__promo">
                <span class="home-pill home-pill--soft !bg-white/15 !text-white">Since 1999 · ISO Certified</span>
                <h3>Outsourced Accounting &amp; Bookeeping Solutions</h3>
                <p>Accurate books, compliant taxes, and clear financial insights to help your business grow.</p>
                <div class="home-finance__promo-stats">
                    <div>
                        <strong>1,500+</strong>
                        <span>Active clients</span>
                    </div>
                    <div>
                        <strong>50M+</strong>
                        <span>Transactions processed</span>
                    </div>
                </div>
                <p class="mt-5 text-sm text-white/85">Compliant with GDPR · HIPAA · SOC 2 · PCI-DSS</p>
            </aside>

            <div class="home-finance__services">
                @foreach ($services as $service)
                    <article class="home-card">
                        <i class="fa-solid {{ $service['icon'] }}" aria-hidden="true"></i>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="home-finance__logos">
            <article class="home-card">
                <h3>Certified Accounting Excellence</h3>
                <div class="home-software-grid !grid-cols-3">
                    @foreach ($certified as $logo)
                        <div class="home-logo-chip">
                            <img src="{{ asset('images/accounting-certified-logos/'.$logo) }}" alt="{{ pathinfo($logo, PATHINFO_FILENAME) }}" width="110" height="40" loading="lazy" decoding="async">
                        </div>
                    @endforeach
                </div>
            </article>
            <article class="home-card">
                <h3>Software expertise</h3>
                <div class="home-software-grid">
                    @foreach ($software as $logo)
                        <div class="home-logo-chip">
                            <img src="{{ asset('images/accounting-software-expertise-logos/'.$logo) }}" alt="{{ pathinfo($logo, PATHINFO_FILENAME) }}" width="110" height="40" loading="lazy" decoding="async">
                        </div>
                    @endforeach
                </div>
            </article>
        </div>

        <div class="home-cta-bar home-cta-bar--green">
            <div>
                <h3>Don't Compromise Your Business Accounting with Inaccurate Books</h3>
                <p>Outsource your bookkeeping and accounting to experienced professionals who ensure accuracy, compliance, and timely reporting.</p>
            </div>
            <a href="#" class="home-btn home-btn--white" data-contact-modal-trigger>Schedule a Free Consultation →</a>
        </div>
    </div>
</section>
