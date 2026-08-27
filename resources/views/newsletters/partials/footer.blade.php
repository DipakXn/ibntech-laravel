@php
    $organizationName = $websiteSettings?->organization_name ?: 'IBN Technologies Ltd.';
@endphp

<footer class="newsletter-footer" role="contentinfo">
    <div class="newsletter-footer__inner">
        <h2 class="newsletter-footer__title">Experience. Compliance. Partnership.</h2>

        <div class="newsletter-footer__grid">
            <article class="newsletter-footer__item">
                <span class="newsletter-footer__icon" aria-hidden="true">
                    <i class="fa-solid fa-award"></i>
                </span>
                <div>
                    <h3>Experience</h3>
                    <p>26 Years of Reliable, Scalable &amp; 24&times;7 Cybersecurity &amp; Cloud Expertise</p>
                </div>
            </article>

            <article class="newsletter-footer__item">
                <span class="newsletter-footer__icon" aria-hidden="true">
                    <i class="fa-solid fa-certificate"></i>
                </span>
                <div>
                    <h3>Certifications</h3>
                    <p>ISO 9001:2015 | ISO 27001:2022<br>ISO 20000:2018 | GDPR Compliant</p>
                </div>
            </article>

            <article class="newsletter-footer__item">
                <span class="newsletter-footer__icon newsletter-footer__icon--brand" aria-hidden="true">
                    <svg viewBox="0 0 23 23" focusable="false">
                        <rect x="1" y="1" width="10" height="10" rx="0.4"></rect>
                        <rect x="12" y="1" width="10" height="10" rx="0.4"></rect>
                        <rect x="1" y="12" width="10" height="10" rx="0.4"></rect>
                        <rect x="12" y="12" width="10" height="10" rx="0.4"></rect>
                    </svg>
                </span>
                <div>
                    <h3>Microsoft Partner</h3>
                    <p>Solution Partner: Azure | Security<br>Modern Work | Data &amp; AI</p>
                </div>
            </article>

            <article class="newsletter-footer__item">
                <span class="newsletter-footer__icon" aria-hidden="true">
                    <i class="fa-brands fa-aws"></i>
                </span>
                <div>
                    <h3>AWS Partner</h3>
                    <p>Advanced Consulting Partner</p>
                </div>
            </article>
        </div>

        <div class="newsletter-footer__bottom">
            <p>All Rights Reserved &copy; {{ now()->year }} {{ $organizationName }}</p>
            <nav class="newsletter-footer__legal" aria-label="Legal">
                <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>
                <span aria-hidden="true">|</span>
                <a href="{{ route('page.show', ['slug' => 'terms-of-use']) }}">Terms and Conditions</a>
                <span aria-hidden="true">|</span>
                <a href="{{ route('page.show', ['slug' => 'cookies-policy']) }}">Cookies Policy</a>
            </nav>
        </div>
    </div>
</footer>
