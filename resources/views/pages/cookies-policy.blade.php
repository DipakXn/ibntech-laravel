@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/cookies-policy.css'])
@endpush

@section('content')
    <article class="cookies-policy-page">
        <div class="site-shell cookies-policy-page__inner">
            <h1>Cookies Policy</h1>

            <p>
                This Cookies Policy explains how <strong>IBN Technologies Limited</strong> ("we", "us", "our") uses cookies and similar technologies on our websites (the "Site"), and the choices you have.
            </p>
            <p>
                By using our Site you consent to the use of cookies as described in this policy unless you disable them through your browser or preference settings.
            </p>

            <h2 id="what-are-cookies">1. What are cookies and similar technologies?</h2>
            <p>
                Cookies are small text files placed on your device when you visit a website. Similar technologies include web beacons, pixel tags, local storage, and other tracking tools.
            </p>
            <p>
                These technologies help websites recognise your device and remember information about your visit.
            </p>

            <h2 id="types">2. Types of cookies we use</h2>
            <p>We use the following categories of cookies on our Site:</p>

            <div class="cookies-policy-page__table-wrap">
                <table class="cookies-policy-page__table">
                    <caption class="sr-only">Categories of cookies used on the IBN Technologies website</caption>
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Typical examples / duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Essential / Strictly necessary</strong></td>
                            <td>Required for the Site to function (e.g., navigation, security, cookie-consent storage).</td>
                            <td>Session cookies or persistent cookies (e.g., session, cookie-consent — typically short-term).</td>
                        </tr>
                        <tr>
                            <td><strong>Analytics / Performance</strong></td>
                            <td>Collect anonymised information about Site usage so we can improve it (pages visited, time on site).</td>
                            <td>Analytics cookies (e.g., Google Analytics) — typically up to 2 years depending on provider.</td>
                        </tr>
                        <tr>
                            <td><strong>Marketing / Advertising</strong></td>
                            <td>Used to deliver and measure advertising, and to show content relevant to your interests.</td>
                            <td>Third-party advertising cookies — durations vary (often 30 days to 2 years).</td>
                        </tr>
                        <tr>
                            <td><strong>Functional</strong></td>
                            <td>Remember user preferences and settings (language, region, form inputs).</td>
                            <td>Persistent cookies — durations vary.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="cookies-policy-page__note" role="note">
                <strong>Note:</strong> The exact names and durations of cookies may change. Where possible we provide cookie names and retention periods in a cookie table on this page — otherwise please refer to the third-party provider's documentation (for example Google Analytics).
            </div>

            <h2 id="how-we-use">3. How we use cookies</h2>
            <ul>
                <li>To enable core site functionality and maintain security (essential cookies).</li>
                <li>To remember your cookie consent choice and site preferences.</li>
                <li>To analyse and improve our Site’s performance and user experience.</li>
                <li>To personalise and deliver marketing, advertising, and measure campaign effectiveness (where permitted).</li>
            </ul>

            <h2 id="third-party">4. Third-party cookies</h2>
            <p>
                Some cookies are set by third-party services used on our Site (for example analytics, advertising or social media providers).
            </p>
            <p>
                We do not control third-party cookies; these are subject to the third party’s own policies. For details and opt-out options, please consult those providers directly.
            </p>
            <h3>Examples of common third-party services</h3>
            <ul>
                <li>Google Analytics (analytics)</li>
                <li>Advertising networks (e.g., programmatic ad platforms)</li>
                <li>Social networks (when you use social sharing features)</li>
            </ul>

            <h2 id="cookie-table">5. Example cookie table (sample)</h2>
            <div class="cookies-policy-page__table-wrap">
                <table class="cookies-policy-page__table">
                    <caption class="sr-only">Sample cookies used on the IBN Technologies website</caption>
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
                        <tr>
                            <td><em>ibn_cookie_consent</em></td>
                            <td>IBN Technologies Ltd</td>
                            <td>Essential</td>
                            <td>Stores whether you accepted cookie categories</td>
                            <td>1 year</td>
                        </tr>
                        <tr>
                            <td><em>_ga</em></td>
                            <td>Google Analytics</td>
                            <td>Analytics</td>
                            <td>Distinguishes users (analytics)</td>
                            <td>2 years</td>
                        </tr>
                        <tr>
                            <td><em>_gid</em></td>
                            <td>Google Analytics</td>
                            <td>Analytics</td>
                            <td>Used to distinguish users</td>
                            <td>24 hours</td>
                        </tr>
                        <tr>
                            <td><em>fr</em></td>
                            <td>Facebook</td>
                            <td>Marketing</td>
                            <td>Used by Facebook to deliver a series of advertisement products</td>
                            <td>3 months</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 id="manage">6. How to manage or disable cookies</h2>
            <p>You can control cookies in several ways:</p>
            <ol>
                <li><strong>Cookie banner / preferences:</strong> Use the cookie preference tool on the Site to enable or disable non-essential categories.</li>
                <li><strong>Browser controls:</strong> Most browsers let you block or delete cookies. See your browser’s help pages for instructions (Chrome, Firefox, Edge, Safari, etc.).</li>
                <li><strong>Third-party opt-outs:</strong> Many analytics and advertising providers provide opt-out tools (for example, Google Analytics opt-out). Consult the provider’s website for details.</li>
            </ol>
            <p class="cookies-policy-page__notice">
                Be aware that blocking or removing cookies may affect the functionality of the Site and your experience.
            </p>

            <h2 id="changes">7. Changes to this Cookies Policy</h2>
            <p>
                We may update this Cookies Policy occasionally to reflect changes in law, technology, or our practices. When we update the policy we will revise the "Effective date" at the top of this page.
            </p>
            <p>
                Continued use of the Site after changes indicates acceptance of the updated policy.
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
