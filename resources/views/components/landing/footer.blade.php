@php
    $socialLinks = [
        [
            'label' => 'facebook',
            'url' => 'https://www.facebook.com/ibntechnologies/',
            'icon' => 'fa-brands fa-facebook-f',
        ],
        [
            'label' => 'LinkedIn',
            'url' => 'https://www.linkedin.com/company/ibn-technologies-limited/',
            'icon' => 'fa-brands fa-linkedin-in',
        ],
        [
            'label' => 'twitter',
            'url' => 'https://twitter.com/IBNTechnology/',
            'icon' => 'fa-brands fa-x-twitter',
        ],
        [
            'label' => 'instagram',
            'url' => 'https://www.instagram.com/ibntechnologies/',
            'icon' => 'fa-brands fa-instagram',
        ],
        [
            'label' => 'youtube',
            'url' => 'https://www.youtube.com/@ibn-technologies',
            'icon' => 'fa-brands fa-youtube',
        ],
    ];
@endphp

<footer class="lp-footer" role="contentinfo">
    <div class="lp-footer__social">
        <nav class="lp-footer__social-inner" aria-label="Social media">
            @foreach ($socialLinks as $link)
                <a
                    href="{{ $link['url'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="lp-footer__social-link"
                >
                    <i class="{{ $link['icon'] }}" aria-hidden="true"></i>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>

    <div class="lp-footer__legal">
        <div class="lp-footer__legal-inner">
            <p class="lp-footer__copyright">All Rights Reserved &copy; {{ now()->year }} IBN Technologies Ltd</p>
            <nav class="lp-footer__policies" aria-label="Legal">
                <a href="https://ibntech.com/privacy-policy/">Privacy Policy</a>
                <span class="lp-footer__divider" aria-hidden="true">|</span>
                <a href="https://ibntech.com/terms-of-use/">Terms and Conditions</a>
            </nav>
        </div>
    </div>
</footer>
