@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/terms-of-use.css'])
@endpush

@section('content')
    <article class="terms-of-use-page">
        <div class="site-shell terms-of-use-page__inner">
            <h1>General Terms &amp; Conditions</h1>

            <h2 id="acceptance-of-terms">Acceptance of Terms</h2>
            <p>
                This website Ibntech.com, is an online information service provided by IBN Technologies LTD By accessing or using this site, you agree to comply with and be bound by the following terms and conditions. Please read this document carefully before proceeding. These terms of use may be modified by IBN Technologies LTD. from time-to-time and posted on this Website.
            </p>

            <h2 id="copyrights">Copyrights and Other Intellectual Property</h2>
            <p>
                All content present on this Website is the exclusive property of IBN Technologies LTD. , including software, text, images, graphics, video and audio used herein.
            </p>
            <p>
                The IBN Technologies LTD. name and logo are trademarks which belong to and are owned by IBN Technologies LTD. These trademarks may not be used in any manner without prior written consent from IBN Technologies LTD.
            </p>

            <h2 id="use-of-this-website">Use of this Website</h2>
            <p>
                The content included in this Website is solely for the personal use of website users. You may not copy (other than a copy for personal use), modify, distribute, transmit, display, perform, reproduce, transfer, publish, license, or sell any of the contents of this Website without the prior written consent of IBN Technologies LTD., which may be withheld in its sole discretion.
            </p>
            <p>
                Unauthorized use of the materials appearing on this Website may violate copyright, trademark and other applicable laws, and could result in criminal or civil penalties.
            </p>
            <p>
                You agree to comply with all copyright laws worldwide in your use of this Website and to prevent any unauthorized copying of the materials provided herein. IBN Technologies LTD. does not grant any express or implied rights under any patents, trademarks, copyrights or trade secret information. IBN Technologies LTD. may monitor access to this Website.
            </p>

            <h2 id="no-warranties">No Warranties</h2>
            <p>
                IBN Technologies LTD. makes no warranties, express or implied, including, without limitation, those of merchantability and fitness for a particular purpose, with respect to any information, data, statements or products made available on this Website.
            </p>
            <p>
                This Website and all contents, materials, information, software, products and services provided on this Website, are provided on an “as is” and “as available” basis.
            </p>

            <h2 id="limitation-of-liability">Limitation of Liability</h2>
            <p>
                In no event will IBN Technologies LTD. be liable for any damages, including, without limitation, indirect, incidental, special, consequential or punitive damages, whether under a contract, tort or any other theory of liability, arising in connection with use of this Website or in connection with any failure of performance, error, omission, interruption, defect, delay in operation or transmission, computer virus, line system failure, loss of data, or loss of use related to this Website or any website operated by any third party or any contents of this Website or any other website, even if IBN Technologies LTD. is aware of the possibility of such damages.
            </p>

            <h2 id="indemnity">Indemnity</h2>
            <p>
                IBN Technologies LTD. shall be indemnified, defended and held harmless from and against all losses, expenses, damages and costs, including reasonable attorneys’ fees, arising out of or relating to any misuse by users of the content and services provided on this Website.
            </p>

            <h2 id="disclaimer">Disclaimer</h2>
            <p>
                This Website may contain inaccuracies and typographical and clerical errors. IBN Technologies LTD. expressly disclaims any obligation to update this Website or any of the materials on this Website. IBN Technologies LTD. does not warrant the accuracy or completeness of the materials or the reliability of any advice, opinion, statement or other information displayed or distributed through this Website. Any reliance on any such opinion, advice, statement, memorandum, or information shall be at your sole risk. IBN Technologies LTD. reserves the right, in its sole discretion, to correct any errors or omissions in any portion of the site.
            </p>

            <h2 id="modifications">Modifications</h2>
            <p>
                IBN Technologies LTD. may unilaterally change or discontinue any aspect of this Website at any time, including, its content or features.
            </p>

            <h2 id="third-party-content">Third Party Content</h2>
            <p>
                This Website provides links to websites and access to content, products and services from third parties, including users, advertisers, affiliates and sponsors of this Website. IBN Technologies LTD. is not responsible for the availability of, and content provided on, third party websites. Users are requested to peruse the policies posted by other websites regarding privacy and other topics before use. IBN Technologies LTD. is not responsible for third party content accessible through this Website, including opinions, advice, statements and advertisements, and you shall bear all risks associated with the use of such content. IBN Technologies LTD. is not responsible for any loss or damage of any sort incurred from dealing with any third party
            </p>

            <h2 id="terms-of-use-of-ibn-services">Terms of USE of IBN Services</h2>
            <p>
                All Service Level Agreement will take effect upon signing and will automatically renewed after one year.
            </p>
            <p>
                Both parties shall have the ability and right to bring an action against the other for a breach of Service Agreement.
            </p>
            <h3 id="refund-policy">Refund Policy</h3>
            <p>
                There is no refund policy applicable on any Services offered globally by IBN.
            </p>

            <h2 id="service-cancelation-policy">Service Cancelation Policy</h2>
            <p>
                By mutual consent, CLIENT and IBN may elect to end service level agreement by providing one months’ notice at any time of the contract.
            </p>
            <p>
                You agree to receive recurring messages from IBN TECHNOLOGIES LTD. Reply STOP to opt out or HELP for assistance. Message frequency may vary. Message and data rates may apply. Carriers are not liable for delayed or undelivered messages. No mobile information will be shared with third parties or affiliates for marketing or promotional purposes. All opt-in requests include text messaging originator opt-in data and consent; this information will not be shared with third parties.
            </p>
            <p>
                You agree to receive marketing offers and promotional updates from IBN TECHNOLOGIES LLC via SMS. Reply STOP to opt out, HELP for help. Message frequency may vary. Message and data rates may apply.
                <a href="{{ route('page.show', ['slug' => 'privacy-policy']) }}">Privacy Policy</a>.
            </p>
        </div>
    </article>
@endsection
