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
                ['label' => null, 'number' => '020-6768-0404'],
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
    $hasSocialLinks = collect($socialNetworkIcons)->keys()->contains(fn ($network) => ! empty($socialLinks[$network]));
@endphp

<footer class="site-footer" role="contentinfo">
    <div class="site-shell site-footer__grid">
        <section class="site-footer__column" aria-labelledby="footer-address-heading">
            <p id="footer-address-heading" class="site-footer__heading">
                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                <span>Address</span>
            </p>

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

        <section class="site-footer__column" aria-labelledby="footer-services-heading">
            <p id="footer-services-heading" class="site-footer__heading">
                <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                <span>Services</span>
            </p>

            <div class="site-footer__service-group">
                <div class="site-footer__group-head">
                    <span class="site-footer__group-icon" aria-hidden="true"><i class="fa-solid fa-shield-halved"></i></span>
                    <p class="site-footer__group-heading">Cybersecurity Services</p>
                </div>
                <ul class="site-footer__service-list">
                    <li><a href="{{ route('page.show', ['slug' => 'vapt-services']) }}"><span>VAPT Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'managed-siem-soc-services']) }}"><span>SOC &amp; SIEM</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'managed-detection-response-services']) }}"><span>MDR Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'vciso-services']) }}"><span>vCISO Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'microsoft-security-services']) }}"><span>Microsoft Security</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="site-footer__service-group">
                <div class="site-footer__group-head">
                    <span class="site-footer__group-icon" aria-hidden="true"><i class="fa-solid fa-calculator"></i></span>
                    <p class="site-footer__group-heading">Finance &amp; Accounting</p>
                </div>
                <ul class="site-footer__service-list">
                    <li><a href="{{ route('page.show', ['slug' => 'bookkeeping-services']) }}"><span>Bookkeeping Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'us-uk-tax-preparation-services']) }}"><span>Tax Return Preparation Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'payroll-processing']) }}"><span>Payroll Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'accounts-payable-and-accounts-receivable-services']) }}"><span>AP/AR Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </section>

        <section class="site-footer__column site-footer__column--continued" aria-labelledby="footer-services-heading">
            <div class="site-footer__service-group">
                <div class="site-footer__group-head">
                    <span class="site-footer__group-icon" aria-hidden="true"><i class="fa-solid fa-cloud"></i></span>
                    <p class="site-footer__group-heading">Cloud Services</p>
                </div>
                <ul class="site-footer__service-list">
                    <li><a href="{{ route('page.show', ['slug' => 'cloud-consulting-and-migration-services']) }}"><span>Multi Cloud Consulting and Migration Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'cloud-managed-services']) }}"><span>Managed Cloud and Security Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'business-continuity-disaster-recovery-services']) }}"><span>Business Continuity and Disaster Recovery</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'devsecops-services']) }}"><span>DevSecOps Implementation Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="site-footer__service-group">
                <div class="site-footer__group-head">
                    <span class="site-footer__group-icon" aria-hidden="true"><i class="fa-solid fa-robot"></i></span>
                    <p class="site-footer__group-heading">Automation</p>
                </div>
                <ul class="site-footer__service-list">
                    <li><a href="{{ route('page.show', ['slug' => 'ap-ar-automation']) }}"><span>AP/AR Automation</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'robotics-process-automation']) }}"><span>RPA Implementation</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="site-footer__service-group">
                <div class="site-footer__group-head">
                    <span class="site-footer__group-icon" aria-hidden="true"><i class="fa-solid fa-building"></i></span>
                    <p class="site-footer__subheading">BPO Services</p>
                </div>
                <ul class="site-footer__service-list">
                    <li><a href="{{ route('page.show', ['slug' => 'construction-documentation-services']) }}"><span>Construction Documentation Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'construction-takeoff-estimation-services']) }}"><span>Construction Takeoff and Estimation Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'back-and-middle-office-services']) }}"><span>Fund Middle and Back Office Services</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </section>

        <section class="site-footer__column" aria-labelledby="footer-company-heading">
            <p id="footer-company-heading" class="site-footer__heading">
                <i class="fa-solid fa-building" aria-hidden="true"></i>
                <span>Company</span>
            </p>

            <nav aria-label="Company">
                <ul class="site-footer__links">
                    <li><a href="{{ route('page.show', ['slug' => 'about-ibn']) }}"><span>About Us</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><span>Vision and Mission</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'ibn-team']) }}"><span>Thought Leadership</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><span>Awards and Recognition</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="javascript:void(0)"><span>History</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'current-job-opening']) }}"><span>Career</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'contact-us']) }}"><span>Contact Us</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                </ul>
            </nav>

            <div class="site-footer__stack">
                <p id="footer-insights-heading" class="site-footer__heading">
                    <i class="fa-solid fa-book-open-reader" aria-hidden="true"></i>
                    <span>Insights &amp; Resources</span>
                </p>

                <nav aria-label="Insights and resources">
                    <ul class="site-footer__links">
                        <li><a href="{{ route('case-studies.index') }}"><span>Case Studies</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('blog.index') }}"><span>Blogs</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('pressrelease.index') }}"><span>Press Releases</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('ebooks.index') }}"><span>eBooks</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('white-papers.index') }}"><span>White Papers &amp; Reports</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('articles.index') }}"><span>Articles</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('page.show', ['slug' => 'faq']) }}"><span>FAQ's</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="site-footer__bottom">
        <div class="site-shell site-footer__bottom-inner">
            <p class="site-footer__copyright">All Rights Reserved &copy; {{ now()->year }} {{ $organizationName }}</p>

            @if ($hasSocialLinks)
                <nav class="site-footer__social-icons" aria-label="Social media">
                    @foreach ($socialNetworkIcons as $network => $meta)
                        @if (!empty($socialLinks[$network]))
                            <a href="{{ $socialLinks[$network] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $meta['label'] }}">
                                <i class="{{ $meta['icon'] }}" aria-hidden="true"></i>
                            </a>
                        @endif
                    @endforeach
                </nav>
            @endif

            <nav class="site-footer__legal" aria-label="Legal">
                <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>
                <a href="{{ route('page.show', ['slug' => 'terms-of-use']) }}">Terms and Conditions</a>
                <a href="{{ route('page.show', ['slug' => 'cookies-policy']) }}">Cookies Policy</a>
            </nav>
        </div>
    </div>
</footer>
