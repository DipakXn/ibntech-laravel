@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/cookies-policy.css'])
@endpush

@section('content')
    @php
        $cookiePolicy = app(\App\Services\CookieConsent\CookieConsentRepository::class)->policy();
        $cookiePolicyCategories = $cookiePolicy['categories'] ?? [];
        $cookiePolicyEntries = $cookiePolicy['entries'] ?? [];
    @endphp
    <article class="cookies-policy-page">
        <div class="site-shell cookies-policy-page__inner">
            <h1>Cookies Policy</h1>

            <p>
                This Cookies Policy explains how <strong>IBN Technologies Limited</strong> ("we", "us", "our") uses cookies and similar technologies on our websites (the "Site"), and the choices you have.
            </p>
            <p>
                Optional cookies are used only after you allow them. Closing the cookie banner, scrolling, or continuing to browse does not count as consent. You can change or withdraw your choice at any time from Manage Cookies in the footer or from Cookie Settings in the banner.
            </p>

            <h2 id="what-are-cookies">1. What are cookies and similar technologies?</h2>
            <p>
                Cookies are small text files placed on your device when you visit a website. Similar technologies include web beacons, pixel tags, local storage, and other tracking tools.
            </p>
            <p>
                These technologies help websites recognise your device and remember information about your visit.
            </p>

            <h2 id="types">2. Types of cookies we use</h2>
            <p>We group cookies into the following categories:</p>

            <div class="cookies-policy-page__table-wrap">
                <table class="cookies-policy-page__table">
                    <caption class="sr-only">Categories of cookies used on the IBN Technologies website</caption>
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Purpose</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cookiePolicyCategories as $category)
                            @continue(empty($category['enabled']) && ($category['key'] ?? '') !== 'necessary')
                            <tr>
                                <td><strong>{{ $category['name'] }}</strong></td>
                                <td>{{ $category['description'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td><strong>Necessary cookies</strong></td>
                                <td>Required for security, forms, and storing your consent choice.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <h2 id="how-we-use">3. How we use cookies</h2>
            <ul>
                <li>To enable core site functionality and maintain security (necessary cookies).</li>
                <li>To remember the cookie categories you allowed or rejected.</li>
                <li>To measure site usage after you allow analytics cookies.</li>
                <li>To measure advertising after you allow marketing cookies.</li>
                <li>To show optional embedded media after you allow functional cookies.</li>
            </ul>

            <h2 id="third-party">4. Third-party services</h2>
            <p>
                Some cookies are set by services we use, such as form protection, analytics, or advertising. Those services run only in the category you allow, and only when that service is configured for the environment you are visiting.
            </p>
            <p>
                We do not control cookies set by the provider after you allow that category. Their own privacy notices explain how they use the information.
            </p>

            <h2 id="cookie-table">5. Cookies on this website</h2>
            <p>This table lists cookies confirmed for the current website. It does not include provider cookies that have not been verified.</p>
            <div class="cookies-policy-page__table-wrap">
                <table class="cookies-policy-page__table">
                    <caption class="sr-only">Cookies used on the IBN Technologies website</caption>
                    <thead>
                        <tr>
                            <th scope="col">Cookie name</th>
                            <th scope="col">Provider</th>
                            <th scope="col">Category</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cookiePolicyEntries as $entry)
                            <tr>
                                <td><em>{{ $entry['name'] }}</em></td>
                                <td>{{ $entry['provider'] }}</td>
                                <td>{{ $entry['category'] }}</td>
                                <td>
                                    {{ $entry['purpose'] }}
                                    @if (! empty($entry['privacyUrl']))
                                        <a href="{{ $entry['privacyUrl'] }}">Provider privacy notice</a>
                                    @endif
                                </td>
                                <td>{{ $entry['duration'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Confirmed cookie details will appear here.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <h2 id="manage">6. How to manage or withdraw consent</h2>
            <p>You can control cookies in several ways:</p>
            <ol>
                <li><strong>Cookie settings:</strong> Use Manage Cookies in the footer, or Cookie Settings in the banner, to allow or reject optional categories. Your previous choice is shown when you reopen the settings.</li>
                <li><strong>Browser controls:</strong> Most browsers let you block or delete cookies. See your browser’s help pages for instructions.</li>
                <li><strong>Provider controls:</strong> Analytics and advertising providers publish their own opt-out tools.</li>
            </ol>
            <p class="cookies-policy-page__notice">
                Blocking necessary cookies may affect forms, security checks, and saving your cookie choice.
            </p>

            <h2 id="changes">7. Changes to this Cookies Policy</h2>
            <p>
                We may update this Cookies Policy when our practices or the law change. When a change requires a new choice, the cookie banner is shown again. Using the site after an update does not replace that choice.
            </p>

            <h2 id="contact">8. Contact us</h2>
            <p>If you have questions about this Cookies Policy or our use of cookies, contact us:</p>
            <p class="cookies-policy-page__small">
                <strong>IBN Technologies Limited</strong><br>
                Email: <a href="mailto:info@ibntech.com">info@ibntech.com</a>
            </p>
        </div>
    </article>
@endsection
