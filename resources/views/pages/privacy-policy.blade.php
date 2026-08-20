@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/privacy-policy.css'])
@endpush

@section('content')
    <article class="privacy-policy-page">
        <div class="site-shell privacy-policy-page__inner">
            <h1>Privacy Policy - IBN Technologies Ltd</h1>

            <p>
                This Privacy Policy governs how IBN Technologies Ltd collects, uses, and protects personal information submitted via its website. We are committed to safeguarding your privacy and ensuring that your personal data is handled with transparency and care.
            </p>

            <h2 id="scope-of-this-policy">Scope of This Policy</h2>
            <p>
                This privacy policy applies to all data collected through this website and governs data practices across IBN Technologies Ltd and its affiliated entities, including:
            </p>
            <ul>
                <li>IBN Technologies Ltd (India)</li>
                <li>IBN Tech Ltd (UK)</li>
            </ul>
            <p>(Collectively referred to as "IBN Technologies Ltd group entities")</p>

            <h2 id="how-we-collect-your-information">How we collect your Information</h2>
            <p>IBN Technologies Ltd may receive and collect personal information through the following ways:</p>
            <ul>
                <li><strong>Directly from you</strong>: when you fill out forms, subscribe to newsletters, request information, or otherwise interact with the website.</li>
                <li><strong>Automatically</strong>: via cookies, analytics tools, and access logs which may collect IP addresses, browser type, location, and usage data.</li>
            </ul>

            <h2 id="purpose-of-data-use">Purpose of Data Use</h2>
            <p>Information collected by IBN Technologies Ltd is used for the following purposes:</p>
            <ul>
                <li>To respond to your inquiries or requests.</li>
                <li>To provide the services or information you request.</li>
                <li>To improve website functionality and user experience.</li>
                <li>To send service-related communications and optional marketing material (with your consent).</li>
            </ul>

            <h2 id="data-sharing-across-group-entities">Data Sharing Across Group Entities</h2>
            <p>
                Any personal information submitted via this website may be accessed, processed, or stored by IBN Technologies Ltd group entities, including IBN Technologies Ltd (India) and IBN Tech Ltd (UK).
            </p>
            <p>
                This cross-border data usage is necessary to deliver global services efficiently and to ensure seamless support and processing across the operational units of IBN Technologies Ltd.
            </p>

            <h2 id="how-we-protect-your-data">How we Protect your Data</h2>
            <p>
                IBN Technologies Ltd takes data protection seriously and uses a combination of physical, administrative, and technical safeguards to protect your information, including:
            </p>
            <ul>
                <li>Secure servers</li>
                <li>Encryption protocols</li>
                <li>Access controls</li>
                <li>Regular audits and vulnerability testing</li>
            </ul>
            <p>
                All measures are in accordance with international data protection standards such as <strong>ISO 9001:2015 | 20000-1:2018 | 27001:2022</strong>
            </p>

            <h2 id="links-to-third-party-websites">Links to Third-Party Websites</h2>
            <p>
                The website may contain links to external websites not operated by IBN Technologies Ltd. We do not take responsibility for the content or privacy practices of these websites. All users should ensure they understand the privacy terms of any third-party websites they visit.
            </p>

            <h2 id="your-data-rights">Your Data Rights</h2>
            <p>You have the following rights with respect to your personal information:</p>
            <ul>
                <li>Right to access your data.</li>
                <li>Right to correct or update inaccurate data.</li>
                <li>Right to withdraw consent.</li>
                <li>Right to request deletion of data (subject to legal or contractual retention requirements).</li>
            </ul>
            <p>
                To exercise these rights, please email <a href="mailto:info@ibntech.com">info@ibntech.com</a>.
            </p>

            <h2 id="keeping-you-informed">Keeping You Informed: Policy Updates</h2>
            <p>
                IBN Technologies Ltd may revise this Privacy Policy periodically. All updates will be posted on this page with a revised effective date. We encourage users to check this page frequently for any changes to stay informed about how we protect the personal information we collect. You acknowledge and agree that it is your responsibility to periodically review this Privacy Policy and be aware of any changes.
            </p>
        </div>
    </article>
@endsection
