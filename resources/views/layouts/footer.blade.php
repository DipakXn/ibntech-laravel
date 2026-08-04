@php
    $organizationName = $websiteSettings?->organization_name ?: 'IBN Technologies Ltd';
    $offices = $websiteSettings?->offices ?: [
        [
            'name' => 'IBN Technologies LLC.',
            'address' => '66 West Flagler Street Suite 900 Miami, FL 33130',
            'email' => null,
            'phones' => [
                ['label' => 'Cybersecurity and Cloud', 'number' => '+1-281-544-0740'],
                ['label' => 'Finance & Accounting and Others', 'number' => '+1-844-644-8440'],
            ],
        ],
        [
            'name' => 'IBN Tech Ltd.',
            'address' => '30 Orange Street, London UK WC2H 7HF',
            'email' => null,
            'phones' => [
                ['label' => 'Cybersecurity and Cloud', 'number' => '+44-203-769-9111'],
                ['label' => 'Finance & Accounting and Others', 'number' => '+44-800-041-8618'],
            ],
        ],
        [
            'name' => 'IBN Technologies Ltd.',
            'address' => 'Kohinoor House, 2nd floor, 691/A/1B, Plot no. 7, Bibwewadi Road, Pune-411037, Maharashtra, India',
            'email' => 'sales@ibntech.com',
            'phones' => [
                ['label' => null, 'number' => '020-711-79586'],
            ],
        ],
    ];
    $socialLinks = $websiteSettings?->socialLinks() ?: [];
@endphp

<footer class="site-footer">
    <div class="site-shell site-footer__grid">
        <section class="site-footer__column">
            <h3><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Address</h3>

            @foreach ($offices as $office)
                <div class="site-footer__address-card">
                    <strong>{{ $office['name'] ?? '' }}</strong>
                    @if (!empty($office['address']))
                        <p class="contact-info">{{ $office['address'] }}</p>
                    @endif
                    @foreach (($office['phones'] ?? []) as $phone)
                        @php
                            $phoneNumber = $phone['number'] ?? '';
                            $phoneLabel = $phone['label'] ?? null;
                            $telHref = 'tel:' . preg_replace('/[^\d+]/', '', $phoneNumber);
                        @endphp
                        @if ($phoneNumber !== '')
                            <p class="contact-info">
                                @if ($phoneLabel)
                                    {{ $phoneLabel }}:<br>
                                @endif
                                <a href="{{ $telHref }}"><i class="fa-solid fa-phone" aria-hidden="true"></i> {{ $phoneNumber }}</a>
                            </p>
                        @endif
                    @endforeach
                    @if (!empty($office['email']))
                        <p class="contact-info"><a href="mailto:{{ $office['email'] }}"><i class="fa-solid fa-envelope" aria-hidden="true"></i> {{ $office['email'] }}</a></p>
                    @endif
                </div>
            @endforeach
        </section>

        <section class="site-footer__column site-footer__column--wide">
            <h3><i class="fa-solid fa-gears" aria-hidden="true"></i> Services</h3>
            <div class="site-footer__service-grid">
                <div>
                    <h4>Cybersecurity Services</h4>
                    <ul>
                        <li>VAPT Services</li>
                        <li>SOC &amp; SIEM</li>
                        <li>MDR Services</li>
                        <li>vCISO Services</li>
                        <li>Microsoft Security</li>
                    </ul>
                </div>
                <div>
                    <h4>Finance &amp; Accounting</h4>
                    <ul>
                        <li>Bookkeeping Services</li>
                        <li>Tax Return Preparation Services</li>
                        <li>Payroll Services</li>
                        <li>AP/AR Services</li>
                    </ul>
                </div>
                <div>
                    <h4>Cloud Services</h4>
                    <ul>
                        <li>Multi Cloud Consulting and Migration Services</li>
                        <li>Managed Cloud and Security Services</li>
                        <li>Business Continuity and Disaster Recovery</li>
                        <li>DevSecOps Implementation Services</li>
                    </ul>
                </div>
                <div>
                    <h4>Automation</h4>
                    <ul>
                        <li>AP/AR Automation</li>
                        <li>RPA Implementation</li>
                    </ul>

                    <h4 class="site-footer__subheading">BPO Services</h4>
                    <ul>
                        <li>Construction Documentation Services</li>
                        <li>Construction Takeoff and Estimation Services</li>
                        <li>Fund Middle and Back Office Services</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="site-footer__column">
            <h3><i class="fa-solid fa-building" aria-hidden="true"></i> Company</h3>
            <ul class="site-footer__links">
                <li><a href="{{ route('page.show', ['slug' => 'about']) }}"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> About Us</a></li>
                <li><a href="{{ route('page.show', ['slug' => 'our-vision']) }}"><i class="fa-regular fa-eye" aria-hidden="true"></i> Vision and Mission</a></li>
                <li><a href="{{ route('page.show', ['slug' => 'services']) }}"><i class="fa-regular fa-lightbulb" aria-hidden="true"></i> Thought Leadership</a></li>
                <li><a href="{{ route('case-studies.index') }}"><i class="fa-solid fa-trophy" aria-hidden="true"></i> Awards and Recognition</a></li>
                <li><a href="{{ route('page.show', ['slug' => 'about']) }}"><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i> History</a></li>
                <li><a href="{{ route('page.show', ['slug' => 'contact']) }}"><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Career</a></li>
                <li><a href="{{ route('page.show', ['slug' => 'contact']) }}"><i class="fa-solid fa-phone" aria-hidden="true"></i> Contact Us</a></li>
            </ul>

            <div class="site-footer__stack">
                <h3><i class="fa-solid fa-book-open-reader" aria-hidden="true"></i> Insights &amp; Resources</h3>
                <ul class="site-footer__links">
                    <li><a href="{{ route('case-studies.index') }}"><i class="fa-regular fa-file-lines" aria-hidden="true"></i> Case Studies</a></li>
                    <li><a href="{{ route('blog.index') }}"><i class="fa-solid fa-blog" aria-hidden="true"></i> Blogs</a></li>
                    <li><a href="{{ route('press-releases.index') }}"><i class="fa-regular fa-newspaper" aria-hidden="true"></i> Press Releases</a></li>
                    <li><a href="{{ route('ebooks.index') }}"><i class="fa-solid fa-book" aria-hidden="true"></i> eBooks</a></li>
                    <li><a href="{{ route('white-papers.index') }}"><i class="fa-regular fa-folder-open" aria-hidden="true"></i> White Papers &amp; Reports</a></li>
                    <li><a href="{{ route('blog.index') }}"><i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Articles</a></li>
                    <li><a href="{{ route('page.show', ['slug' => 'contact']) }}"><i class="fa-regular fa-circle-question" aria-hidden="true"></i> FAQ's</a></li>
                </ul>
            </div>
        </section>
    </div>

    <div class="site-footer__social">
        <div class="site-shell">
            <div class="site-footer__social-icons">
                @if (!empty($socialLinks['facebook']))
                    <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                @else
                    <span><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></span>
                @endif
                @if (!empty($socialLinks['linkedin']))
                    <a href="{{ $socialLinks['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                @else
                    <span><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></span>
                @endif
                @if (!empty($socialLinks['twitter']))
                    <a href="{{ $socialLinks['twitter'] }}" target="_blank" rel="noopener noreferrer" aria-label="X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                @else
                    <span><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></span>
                @endif
                @if (!empty($socialLinks['instagram']))
                    <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                @else
                    <span><i class="fa-brands fa-instagram" aria-hidden="true"></i></span>
                @endif
                @if (!empty($socialLinks['youtube']))
                    <a href="{{ $socialLinks['youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
                @else
                    <span><i class="fa-brands fa-youtube" aria-hidden="true"></i></span>
                @endif
            </div>
        </div>
    </div>

    <div class="site-footer__bottom">
        <div class="site-shell site-footer__bottom-inner">
            <p>All Rights Reserved &copy; {{ now()->year }} {{ $organizationName }}</p>
            <div class="site-footer__legal">
                <a href="{{ route('page.show', ['slug' => 'contact']) }}">Privacy Policy</a>
                <a href="{{ route('page.show', ['slug' => 'contact']) }}">Terms and Conditions</a>
                <a href="{{ route('page.show', ['slug' => 'contact']) }}">Cookies Policy</a>
            </div>
        </div>
    </div>
</footer>
