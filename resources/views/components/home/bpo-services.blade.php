@php
    $construction = [
        ['title' => 'Civil Engineering Support', 'text' => 'Structural planning and engineering solutions', 'icon' => 'fa-compass-drafting'],
        ['title' => 'Construction Documentation', 'text' => 'Detailed drawing & drafting and Project records', 'icon' => 'fa-file-lines'],
        ['title' => 'Quantity Takeoff & Estimation', 'text' => 'Precise material and cost calculations', 'icon' => 'fa-ruler-combined'],
    ];

    $fund = [
        ['title' => 'Hedge Fund Support', 'text' => 'Fund accounting and reporting', 'icon' => 'fa-chart-column'],
        ['title' => 'Family Office Services', 'text' => 'Asset and wealth management', 'icon' => 'fa-heart'],
        ['title' => 'Fund Administration', 'text' => 'End-to-end fund operations', 'icon' => 'fa-database'],
    ];

    $software = ['Trimble.webp', 'Procore.webp', 'Costx.webp', 'Stack.webp', 'Bluebeam.webp'];
    $trust = ['ISO 9001:2015', 'ISO 27001:2022', 'ISO 20000-1:2018', 'GDPR', 'SOC 2 Ready', 'HIPAA', 'PCI-DSS'];
@endphp

<section class="home-section" aria-labelledby="home-bpo-title">
    <div class="home-shell">
        <div class="home-card home-bpo__panel">
            <div class="home-bpo__header">
                <i class="fa-solid fa-users text-xl" aria-hidden="true"></i>
                <h2 id="home-bpo-title">
                    Full-Time Remote Construction Engineering &amp; Middle and Back Office Support Solutions
                </h2>
            </div>

            <div class="home-bpo__split">
                <div class="home-bpo__col home-bpo__col--eng">
                    <h3>
                        <i class="fa-solid fa-house" aria-hidden="true"></i>
                        Construction Engineering Services
                    </h3>
                    <p>Accurate estimation, efficient management, quality drawing, drafting, and reliable bid management for better outcomes.</p>

                    <div class="home-bpo__items">
                        @foreach ($construction as $item)
                            <article>
                                <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                                <div>
                                    <h4>{{ $item['title'] }}</h4>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="home-bpo__meta">
                        <p class="home-bpo__meta-label">Software we master</p>
                        <div class="home-software-grid home-bpo__software">
                            @foreach ($software as $logo)
                                <div class="home-logo-chip">
                                    <img src="{{ asset('images/construction-engineering-software-logos/'.$logo) }}" alt="{{ pathinfo($logo, PATHINFO_FILENAME) }}" width="100" height="36" loading="lazy" decoding="async">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="home-bpo__actions">
                        <a href="#" class="home-btn home-btn--navy" data-contact-modal-trigger>
                            <i class="fa-regular fa-comments" aria-hidden="true"></i>
                            Hire Full-Time Remote Engineers →
                        </a>
                    </div>
                </div>

                <div class="home-bpo__col home-bpo__col--fund">
                    <h3>
                        <i class="fa-solid fa-dollar-sign" aria-hidden="true"></i>
                        Fund Middle and Back Office Services
                    </h3>
                    <p>Expert support from family office to fund administration, ensuring accuracy, compliance, and seamless operations.</p>

                    <div class="home-bpo__items">
                        @foreach ($fund as $item)
                            <article>
                                <i class="fa-solid {{ $item['icon'] }}" aria-hidden="true"></i>
                                <div>
                                    <h4>{{ $item['title'] }}</h4>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="home-bpo__meta">
                        <p class="home-bpo__meta-label">Trust &amp; compliance</p>
                        <div class="home-chip-row">
                            @foreach ($trust as $item)
                                <span class="home-chip">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="home-bpo__actions">
                        <a href="#" class="home-btn home-btn--green" data-contact-modal-trigger>
                            <i class="fa-regular fa-comments" aria-hidden="true"></i>
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
            <a href="#" class="home-btn home-btn--grad mt-6" data-contact-modal-trigger>Connect with an Expert</a>
        </div>
    </div>
</section>
