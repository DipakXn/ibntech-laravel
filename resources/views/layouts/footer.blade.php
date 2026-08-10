@php
    $organizationName = $websiteSettings?->organization_name ?: 'IBN Technologies Ltd';
    $offices = $websiteSettings?->offices ?: [
        [
            'name' => 'IBN Technologies LLC.',
            'address' => '66 West Flagler Street Suite 900 Miami, FL 33130',
            'flag' => 'us',
            'email' => null,
            'phones' => [
                ['label' => 'Cybersecurity and Cloud', 'number' => '+1-281-544-0740'],
                ['label' => 'Finance & Accounting and Others', 'number' => '+1-844-644-8440'],
            ],
        ],
        [
            'name' => 'IBN Tech Ltd.',
            'address' => '30 Orange Street, London UK WC2H 7HF',
            'flag' => 'uk',
            'email' => null,
            'phones' => [
                ['label' => 'Cybersecurity and Cloud', 'number' => '+44-203-769-9111'],
                ['label' => 'Finance & Accounting and Others', 'number' => '+44-800-041-8618'],
            ],
        ],
        [
            'name' => 'IBN Technologies Ltd.',
            'address' => 'Kohinoor House, 2nd floor, 691/A/1B, Plot no. 7, Bibwewadi Road, Pune-411037, Maharashtra, India',
            'flag' => 'in',
            'email' => 'sales@ibntech.com',
            'phones' => [
                ['label' => null, 'number' => '020-711-79586'],
            ],
        ],
    ];
    $socialLinks = $websiteSettings?->socialLinks() ?: [];
    $socialNetworkIcons = [
        'facebook' => ['label' => 'Facebook', 'icon' => 'fa-brands fa-facebook-f'],
        'linkedin' => ['label' => 'LinkedIn', 'icon' => 'fa-brands fa-linkedin-in'],
        'twitter' => ['label' => 'X', 'icon' => 'fa-brands fa-x-twitter'],
        'instagram' => ['label' => 'Instagram', 'icon' => 'fa-brands fa-instagram'],
        'youtube' => ['label' => 'YouTube', 'icon' => 'fa-brands fa-youtube'],
    ];
    $officeFlagIcons = [
        'us' => [
            'src' => asset('images/icons/united-states-flag-icon.webp'),
            'alt' => 'United States flag',
        ],
        'uk' => [
            'src' => asset('images/icons/united-kingdom-flag-icon.webp'),
            'alt' => 'United Kingdom flag',
        ],
        'in' => [
            'src' => asset('images/icons/india-flag-icon.webp'),
            'alt' => 'India flag',
        ],
    ];
    $resolveOfficeFlag = static function (array $office) use ($officeFlagIcons): ?array {
        $code = strtolower((string) ($office['flag'] ?? ''));

        if (isset($officeFlagIcons[$code])) {
            return $officeFlagIcons[$code];
        }

        $haystack = strtolower(($office['name'] ?? '').' '.($office['address'] ?? ''));

        $resolved = match (true) {
            str_contains($haystack, 'miami') || str_contains($haystack, ' fl ') || str_contains($haystack, 'usa') || str_contains($haystack, 'llc') => 'us',
            str_contains($haystack, 'london') || str_contains($haystack, ' uk ') || str_contains($haystack, 'united kingdom') => 'uk',
            str_contains($haystack, 'pune') || str_contains($haystack, 'india') || str_contains($haystack, 'maharashtra') => 'in',
            default => null,
        };

        return $resolved ? ($officeFlagIcons[$resolved] ?? null) : null;
    };
@endphp

<footer class="site-footer" role="contentinfo">
    <div class="site-shell site-footer__grid">
        <section class="site-footer__column" aria-labelledby="footer-address-heading">
            <h3 id="footer-address-heading" class="site-footer__heading">
                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                Address
            </h3>

            @foreach ($offices as $office)
                <div class="site-footer__address-card">
                    @if (!empty($office['name']))
                        <strong class="site-footer__office-name">{{ $office['name'] }}</strong>
                    @endif

                    @if (!empty($office['address']))
                        @php $officeFlag = $resolveOfficeFlag($office); @endphp
                        <p class="site-footer__address">
                            @if ($officeFlag)
                                <img
                                    class="site-footer__flag"
                                    src="{{ $officeFlag['src'] }}"
                                    alt="{{ $officeFlag['alt'] }}"
                                    width="22"
                                    height="16"
                                    loading="lazy"
                                    decoding="async"
                                >
                            @endif
                            <span>{{ $office['address'] }}</span>
                        </p>
                    @endif

                    @foreach (($office['phones'] ?? []) as $phone)
                        @php
                            $phoneNumber = $phone['number'] ?? '';
                            $phoneLabel = $phone['label'] ?? null;
                            $telHref = 'tel:' . preg_replace('/[^\d+]/', '', $phoneNumber);
                        @endphp
                        @if ($phoneNumber !== '')
                            <p class="site-footer__contact">
                                @if ($phoneLabel)
                                    <span class="site-footer__contact-label">{{ $phoneLabel }}:</span>
                                @endif
                                <a href="{{ $telHref }}">
                                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                                    <span>{{ $phoneNumber }}</span>
                                </a>
                            </p>
                        @endif
                    @endforeach

                    @if (!empty($office['email']))
                        <p class="site-footer__contact">
                            <a href="mailto:{{ $office['email'] }}">
                                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                                <span>{{ $office['email'] }}</span>
                            </a>
                        </p>
                    @endif
                </div>
            @endforeach
        </section>

        <section class="site-footer__column site-footer__column--wide" aria-labelledby="footer-services-heading">
            <h3 id="footer-services-heading" class="site-footer__heading">
                <i class="fa-solid fa-gears" aria-hidden="true"></i>
                Services
            </h3>

            <div class="site-footer__service-grid">
                <div class="site-footer__service-group">
                    <h4>Cybersecurity Services</h4>
                    <ul class="site-footer__service-list">
                        <li>
                            <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                            <a href="{{ route('page.show', ['slug' => 'vapt-services']) }}">VAPT Services</a>
                        </li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><span>SOC &amp; SIEM</span></li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><span>MDR Services</span></li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><span>vCISO Services</span></li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><span>Microsoft Security</span></li>
                    </ul>
                </div>

                <div class="site-footer__service-group">
                    <h4>Finance &amp; Accounting</h4>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><span>Bookkeeping Services</span></li>
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><span>Tax Return Preparation Services</span></li>
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><span>Payroll Services</span></li>
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><span>AP/AR Services</span></li>
                    </ul>
                </div>

                <div class="site-footer__service-group">
                    <h4>Cloud Services</h4>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><span>Multi Cloud Consulting and Migration Services</span></li>
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><span>Managed Cloud and Security Services</span></li>
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><span>Business Continuity and Disaster Recovery</span></li>
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><span>DevSecOps Implementation Services</span></li>
                    </ul>
                </div>

                <div class="site-footer__service-group">
                    <h4>Automation</h4>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-robot" aria-hidden="true"></i><span>AP/AR Automation</span></li>
                        <li><i class="fa-solid fa-robot" aria-hidden="true"></i><span>RPA Implementation</span></li>
                    </ul>

                    <h4 class="site-footer__subheading">BPO Services</h4>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-building" aria-hidden="true"></i><span>Construction Documentation Services</span></li>
                        <li><i class="fa-solid fa-building" aria-hidden="true"></i><span>Construction Takeoff and Estimation Services</span></li>
                        <li><i class="fa-solid fa-building" aria-hidden="true"></i><span>Fund Middle and Back Office Services</span></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="site-footer__column" aria-labelledby="footer-company-heading">
            <h3 id="footer-company-heading" class="site-footer__heading">
                <i class="fa-solid fa-building" aria-hidden="true"></i>
                Company
            </h3>

            <nav aria-label="Company">
                <ul class="site-footer__links">
                    <li><a href="{{ route('page.show', ['slug' => 'about']) }}"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><span>About Us</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'our-vision']) }}"><i class="fa-regular fa-eye" aria-hidden="true"></i><span>Vision and Mission</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'services']) }}"><i class="fa-regular fa-lightbulb" aria-hidden="true"></i><span>Thought Leadership</span></a></li>
                    <li><a href="{{ route('case-studies.index') }}"><i class="fa-solid fa-trophy" aria-hidden="true"></i><span>Awards and Recognition</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'about']) }}"><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i><span>History</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'contact']) }}"><i class="fa-solid fa-briefcase" aria-hidden="true"></i><span>Career</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'contact']) }}"><i class="fa-solid fa-phone" aria-hidden="true"></i><span>Contact Us</span></a></li>
                </ul>
            </nav>

            <div class="site-footer__stack">
                <h3 id="footer-insights-heading" class="site-footer__heading">
                    <i class="fa-solid fa-book-open-reader" aria-hidden="true"></i>
                    Insights &amp; Resources
                </h3>

                <nav aria-label="Insights and resources">
                    <ul class="site-footer__links">
                        <li><a href="{{ route('case-studies.index') }}"><i class="fa-regular fa-file-lines" aria-hidden="true"></i><span>Case Studies</span></a></li>
                        <li><a href="{{ route('blog.index') }}"><i class="fa-solid fa-blog" aria-hidden="true"></i><span>Blogs</span></a></li>
                        <li><a href="{{ route('press-releases.index') }}"><i class="fa-regular fa-newspaper" aria-hidden="true"></i><span>Press Releases</span></a></li>
                        <li><a href="{{ route('ebooks.index') }}"><i class="fa-solid fa-book" aria-hidden="true"></i><span>eBooks</span></a></li>
                        <li><a href="{{ route('white-papers.index') }}"><i class="fa-regular fa-folder-open" aria-hidden="true"></i><span>White Papers &amp; Reports</span></a></li>
                        <li><a href="{{ route('blog.index') }}"><i class="fa-regular fa-pen-to-square" aria-hidden="true"></i><span>Articles</span></a></li>
                        <li><a href="{{ route('page.show', ['slug' => 'contact']) }}"><i class="fa-regular fa-circle-question" aria-hidden="true"></i><span>FAQ's</span></a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="site-footer__social">
        <div class="site-shell">
            <nav class="site-footer__social-icons" aria-label="Social media">
                @foreach ($socialNetworkIcons as $network => $meta)
                    @if (!empty($socialLinks[$network]))
                        <a href="{{ $socialLinks[$network] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $meta['label'] }}">
                            <i class="{{ $meta['icon'] }}" aria-hidden="true"></i>
                        </a>
                    @else
                        <span aria-hidden="true"><i class="{{ $meta['icon'] }}"></i></span>
                    @endif
                @endforeach
            </nav>
        </div>
    </div>

    <div class="site-footer__bottom">
        <div class="site-shell site-footer__bottom-inner">
            <p>All Rights Reserved &copy; {{ now()->year }} {{ $organizationName }}</p>
            <nav class="site-footer__legal" aria-label="Legal">
                <a href="{{ route('page.show', ['slug' => 'contact']) }}">Privacy Policy</a>
                <a href="{{ route('page.show', ['slug' => 'contact']) }}">Terms and Conditions</a>
                <a href="{{ route('page.show', ['slug' => 'contact']) }}">Cookies Policy</a>
            </nav>
        </div>
    </div>
</footer>
