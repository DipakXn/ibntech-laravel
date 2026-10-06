@php
    $construction = [
        ['title' => 'Civil Engineering Support', 'text' => 'Structural planning and engineering solutions', 'icon' => 'fa-compass-drafting', 'href' => route('page.show', ['slug' => 'civil-engineering-services']),],
        ['title' => 'Construction Documentation', 'text' => 'Detailed drawing & drafting and Project records', 'icon' => 'fa-file-lines', 'href' => route('page.show', ['slug' => 'construction-documentation-services']),],
        ['title' => 'Quantity Takeoff & Estimation', 'text' => 'Precise material and cost calculations', 'icon' => 'fa-house', 'href' => route('page.show', ['slug' => 'construction-takeoff-estimation-services']),],
    ];

    $fund = [
        ['title' => 'Hedge Fund Support', 'text' => 'Fund accounting and reporting', 'icon' => 'fa-dollar-sign', 'href' => route('page.show', ['slug' => 'hedge-fund-services']),],
        ['title' => 'Family Office Services', 'text' => 'Asset and wealth management', 'icon' => 'fa-heart', 'href' => route('page.show', ['slug' => 'family-office-services']),],
        ['title' => 'Fund Administration', 'text' => 'End-to-end fund operations', 'icon' => 'fa-database', 'href' => route('page.show', ['slug' => 'hedgefund-administration']),],
    ];

    $software = ['Trimble.webp', 'Procore.webp', 'Costx.webp', 'Stack.webp', 'Bluebeam.webp'];
    $trust = ['ISO 9001:2015', 'ISO 27001:2022', 'ISO 20000-1:2018', 'GDPR', 'SOC 2 Ready', 'HIPAA', 'PCI-DSS'];
@endphp

<section class="home-section home-section--lavender" aria-labelledby="home-bpo-title" data-scroll-anchor="bpo-section">
    <div class="home-shell">
        <div class="home-card home-bpo__panel">
            <div class="home-bpo__header">
                <span class="home-bpo__header-icon" aria-hidden="true">
                    <i class="fa-solid fa-people-arrows"></i>
                </span>
                <h2 id="home-bpo-title">
                    Full-Time Remote Construction Engineering &amp; Middle and Back Office Support Solutions
                </h2>
            </div>

            <div class="home-bpo__split">
                <div class="home-bpo__col home-bpo__col--eng">
                    <h3>
                        <span class="home-bpo__col-icon" aria-hidden="true">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        Construction Engineering Services
                    </h3>
                    <p>Accurate estimation, efficient management, quality drawing, drafting, and reliable bid management for better outcomes.</p>

                    <div class="home-bpo__items">
                        @foreach ($construction as $item)
                            <article>
                                <a href="{{ $item['href'] }}">
                                    <span class="home-bpo__item-icon" aria-hidden="true">
                                        <i class="fa-solid {{ $item['icon'] }}"></i>
                                    </span>
                                    <div class="home-bpo__item-copy">
                                        <h4>{{ $item['title'] }}</h4>
                                        <p>{{ $item['text'] }}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <div class="home-bpo__meta">
                        <p class="home-bpo__meta-label">
                            <i class="fa-solid fa-desktop" aria-hidden="true"></i>
                            Software we master
                        </p>
                        <div class="home-software-grid home-bpo__software">
                            @foreach ($software as $logo)
                                <div class="home-logo-chip">
                                    <img src="{{ asset('images/construction-engineering-software-logos/'.$logo) }}" alt="{{ pathinfo($logo, PATHINFO_FILENAME) }}" width="100" height="36" loading="lazy" decoding="async">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="home-bpo__actions">
                        <a href="javascript:void(0)" class="home-btn home-btn--navy" data-scroll-target="home-form" data-contact-modal-trigger>
                            <span class="home-bpo__btn-icon" aria-hidden="true">
                                <i class="fa-regular fa-comments"></i>
                            </span>
                            Hire Full-Time Remote Engineers →
                        </a>
                    </div>
                </div>

                <div class="home-bpo__col home-bpo__col--fund">
                    <h3>
                        <span class="home-bpo__col-icon" aria-hidden="true">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </span>
                        Fund Middle and Back Office Services
                    </h3>
                    <p>Expert support from family office to fund administration, ensuring accuracy, compliance, and seamless operations.</p>

                    <div class="home-bpo__items">
                        @foreach ($fund as $item)
                            <article>
                                <a href="{{ $item['href'] }}">
                                    <span class="home-bpo__item-icon" aria-hidden="true">
                                        <i class="fa-solid {{ $item['icon'] }}"></i>
                                    </span>
                                    <div class="home-bpo__item-copy">
                                        <h4>{{ $item['title'] }}</h4>
                                        <p>{{ $item['text'] }}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    <div class="home-bpo__meta">
                        <p class="home-bpo__meta-label">
                            <i class="fa-solid fa-award" aria-hidden="true"></i>
                            Trust &amp; compliance
                        </p>
                        <div class="home-chip-row">
                            @foreach ($trust as $item)
                                <span class="home-chip">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="home-bpo__actions">
                        <a href="javascript:void(0)" class="home-btn home-btn--green" data-contact-modal-trigger>
                            <span class="home-bpo__btn-icon" aria-hidden="true">
                                <i class="fa-regular fa-comments"></i>
                            </span>
                            Get Back Office Support →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-bpo__cta">
        <div class="home-shell">
            <h3 class="home-section-title">Ready to Transform Your Business?</h3>
            <p class="home-section-lead mx-auto max-w-3xl">
                Explore our next-generation solutions designed to optimize your operations and future-proof your business for unprecedented growth and lasting competitive advantage.
            </p>
            <a href="javascript:void(0)" class="home-btn home-btn--grad mt-6" data-scroll-target="home-form">Connect with an Expert</a>
        </div>
    </div>
</section>
