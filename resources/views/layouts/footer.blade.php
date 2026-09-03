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
@endphp

<footer class="site-footer" role="contentinfo">
    <div class="site-shell site-footer__grid">
        <section class="site-footer__column" aria-labelledby="footer-address-heading">
            <p id="footer-address-heading" class="site-footer__heading">
                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                Address
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

        <section class="site-footer__column site-footer__column--wide" aria-labelledby="footer-services-heading">
            <p id="footer-services-heading" class="site-footer__heading">
                <i class="fa-solid fa-gears" aria-hidden="true"></i>
                Services
            </p>

            <div class="site-footer__service-grid">
                <div class="site-footer__service-group">
                    <p class="site-footer__group-heading">Cybersecurity Services</p>
                    <ul class="site-footer__service-list">
                        <li>
                            <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                            <a href="{{ route('page.show', ['slug' => 'vapt-services']) }}">VAPT Services</a>
                        </li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'managed-siem-soc-services']) }}">SOC &amp; SIEM</a></li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'managed-detection-response-services']) }}">MDR Services</a></li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'vciso-services']) }}">vCISO Services</a></li>
                        <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'microsoft-security-services']) }}">Microsoft Security</a></li>
                    </ul>
                </div>

                <div class="site-footer__service-group">
                    <p class="site-footer__group-heading">Finance &amp; Accounting</p>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'bookkeeping-services']) }}">Bookkeeping Services</a></li>
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'us-uk-tax-preparation-services']) }}">Tax Return Preparation Services</a></li>
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'payroll-processing']) }}">Payroll Services</a></li>
                        <li><i class="fa-solid fa-calculator" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'accounts-payable-and-accounts-receivable-services']) }}">AP/AR Services</a></li>
                    </ul>
                </div>

                <div class="site-footer__service-group">
                    <p class="site-footer__group-heading">Cloud Services</p>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'cloud-consulting-and-migration-services']) }}">Multi Cloud Consulting and Migration Services</a></li>
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'cloud-managed-services']) }}">Managed Cloud and Security Services</a></li>
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'business-continuity-disaster-recovery-services']) }}">Business Continuity and Disaster Recovery</a></li>
                        <li><i class="fa-solid fa-cloud" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'devsecops-services']) }}">DevSecOps Implementation Services</a></li>
                    </ul>
                </div>

                <div class="site-footer__service-group">
                    <p class="site-footer__group-heading">Automation</p>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-robot" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'ap-ar-automation']) }}">AP/AR Automation</a></li>
                        <li><i class="fa-solid fa-robot" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'robotics-process-automation']) }}">RPA Implementation</a></li>
                    </ul>

                    <p class="site-footer__subheading">BPO Services</p>
                    <ul class="site-footer__service-list">
                        <li><i class="fa-solid fa-building" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'construction-documentation-services']) }}">Construction Documentation Services</a></li>
                        <li><i class="fa-solid fa-building" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'construction-takeoff-estimation-services']) }}">Construction Takeoff and Estimation Services</a></li>
                        <li><i class="fa-solid fa-building" aria-hidden="true"></i><a href="{{ route('page.show', ['slug' => 'back-and-middle-office-services']) }}">Fund Middle and Back Office Services</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="site-footer__column" aria-labelledby="footer-company-heading">
            <p id="footer-company-heading" class="site-footer__heading">
                <i class="fa-solid fa-building" aria-hidden="true"></i>
                Company
            </p>

            <nav aria-label="Company">
                <ul class="site-footer__links">
                    <li><a href="{{ route('page.show', ['slug' => 'about-ibn']) }}"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><span>About Us</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'our-vision']) }}"><i class="fa-regular fa-eye" aria-hidden="true"></i><span>Vision and Mission</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'services']) }}"><i class="fa-regular fa-lightbulb" aria-hidden="true"></i><span>Thought Leadership</span></a></li>
                    <li><a href="{{ route('case-studies.index') }}"><i class="fa-solid fa-trophy" aria-hidden="true"></i><span>Awards and Recognition</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'about']) }}"><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i><span>History</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'current-job-opening']) }}"><i class="fa-solid fa-briefcase" aria-hidden="true"></i><span>Career</span></a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'contact-us']) }}"><i class="fa-solid fa-phone" aria-hidden="true"></i><span>Contact Us</span></a></li>
                </ul>
            </nav>

            <div class="site-footer__stack">
                <p id="footer-insights-heading" class="site-footer__heading">
                    <i class="fa-solid fa-book-open-reader" aria-hidden="true"></i>
                    Insights &amp; Resources
                </p>

                <nav aria-label="Insights and resources">
                    <ul class="site-footer__links">
                        <li><a href="{{ route('case-studies.index') }}"><i class="fa-regular fa-file-lines" aria-hidden="true"></i><span>Case Studies</span></a></li>
                        <li><a href="{{ route('blog.index') }}"><i class="fa-solid fa-blog" aria-hidden="true"></i><span>Blogs</span></a></li>
                        <li><a href="{{ route('pressrelease.index') }}"><i class="fa-regular fa-newspaper" aria-hidden="true"></i><span>Press Releases</span></a></li>
                        <li><a href="{{ route('ebooks.index') }}"><i class="fa-solid fa-book" aria-hidden="true"></i><span>eBooks</span></a></li>
                        <li><a href="{{ route('white-papers.index') }}"><i class="fa-regular fa-folder-open" aria-hidden="true"></i><span>White Papers &amp; Reports</span></a></li>
                        <li><a href="{{ route('blog.index') }}"><i class="fa-regular fa-pen-to-square" aria-hidden="true"></i><span>Articles</span></a></li>
                        <li><a href="{{ route('page.show', ['slug' => 'faq']) }}"><i class="fa-regular fa-circle-question" aria-hidden="true"></i><span>FAQ's</span></a></li>
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
                <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>
                <a href="{{ route('page.show', ['slug' => 'terms-of-use']) }}">Terms and Conditions</a>
                <a href="{{ route('page.show', ['slug' => 'cookies-policy']) }}">Cookies Policy</a>
            </nav>
        </div>
    </div>
</footer>
