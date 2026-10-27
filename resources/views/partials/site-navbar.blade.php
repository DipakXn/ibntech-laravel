<nav class="navbar" aria-label="Primary">
  <div class="navbar-container">
    <button
      type="button"
      class="navbar-toggler"
      id="navbarToggler"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Open menu"
    >
      <span class="sr-only navbar-toggler__label">Open menu</span>
      <i class="fas fa-bars nav-menu-icon" aria-hidden="true"></i>
    </button>

    <a class="navbar-brand" href="{{ route('home') }}">
      <img alt="IBN Technologies Logo" class="ibn-logo" src="{{ asset('uploads/web-img/ibn-logo.webp') }}" width="512" height="182" decoding="async">
    </a>

    <div class="d-block d-sm-none">
      <div class="calls-sec">
        <a class="Bookmeeting1" href="#" data-contact-modal-trigger>
          <span>Book a Meeting</span>
        </a>
      </div>
    </div>

    <ul class="navbar-nav" id="navbarNav">

      <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault();">
          <span class="nav-link__main">
            <span class="nav-link__icon" aria-hidden="true"><i class="fa-solid fa-layer-group"></i></span>
            <span class="nav-link__text">Capabilities</span>
          </span>
          <svg class="dd-arow" width="12" height="12" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z" />
          </svg>
        </a>
        <div class="dropdown-menu special-view">
          <div class="megamenu">
            <div class="menu-row">
              <div class="menu-categories">
                <div class="menulinks deskmeg-menu">
                  <div class="menu-category-heading active" data-target="cybersecurity-services">
                    <span class="icoms" aria-hidden="true">

                      <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                        <defs>
                          <image width="56" height="64" id="Cybersecurity"
                            data-nav-icon="{{ asset('images/nav-icons/e76124d19493a299.png') }}" />
                        </defs>
<use href="#Cybersecurity" x="4" y="0" />
                      </svg>
                    </span>
                    <div>Cybersecurity Services<span class="sutile">Protecting your digital
                        assets</span></div>
                  </div>
                  <div class="menu-category-heading" data-target="cloud-services">
                    <span class="icoms" aria-hidden="true">

                      <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                        <defs>
                          <image width="64" height="48" id="Cloud"
                            data-nav-icon="{{ asset('images/nav-icons/3104da9db4596bcf.png') }}" />
                        </defs>
<use href="#Cloud" x="0" y="8" />
                      </svg>
                    </span>
                    <div>Cloud Services<span class="sutile">Scalable cloud solutions</span>
                    </div>
                  </div>

                  <div class="menu-category-heading" data-target="automation">
                    <span class="icoms" aria-hidden="true">
                      <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64"><defs><image width="60" height="62" id="ai" data-nav-icon="{{ asset('images/nav-icons/b0bd0929c77bba07.png') }}"/></defs><use href="#ai" x="2" y="1"/></svg>
                    </span>
                    <div>AI Consulting & Development<span class="sutile">AI Strategy & Solutions</span>
                    </div>
                  </div>

                  <div class="menu-category-heading" data-target="sap-services">
                    <span class="icoms" aria-hidden="true">
                      <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64"><defs><image width="64" height="64" id="sap" data-nav-icon="{{ asset('images/nav-icons/c44ad35466cc9d2b.png') }}"/></defs><use href="#sap"/></svg>
                    </span>
                    <div>SAP Services<span class="sutile">SAP solutions & support</span>
                    </div>
                  </div>

                  <div class="menu-category-heading" data-target="finance-accounting">
                    <span class="icoms" aria-hidden="true">

                      <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                        <defs>
                          <image width="64" height="64" id="Finance"
                            data-nav-icon="{{ asset('images/nav-icons/30bf977c8eeda3b7.png') }}" />
                        </defs>
<use href="#Finance" x="0" y="0" />
                      </svg>
                    </span>
                    <div>Finance &amp; Accounting<span class="sutile">Expert financial
                        management</span></div>
                  </div>
                  
                  <div class="menu-category-heading" data-target="bpo-services">
                    <span class="icoms" aria-hidden="true">
                      <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                        <defs>
                          <image width="52" height="64" id="BPO"
                            data-nav-icon="{{ asset('images/nav-icons/b56a21ed9c973ad5.png') }}" />
                        </defs>
<use href="#BPO" x="6" y="0" />
                      </svg></span>
                    <div>BPO Services<span class="sutile">Outsourcing for efficiency</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="menu-content">
                <div id="cybersecurity-services" class="submenu active">
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'vapt-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" width="120"
                            height="120">
                            <defs>
                              <image width="120" height="120" id="vapt"
                                data-nav-icon="{{ asset('images/nav-icons/3fa094b78ee072d6.png') }}" />
                            </defs>
<use href="#vapt" x="0" y="0" />
                          </svg>
                        </span>
                        <div>Vulnerability Assessment and Penetration Testing (VAPT)
                          <span class="sub-dc">Identify and fix security gaps</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'managed-siem-soc-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="64" height="46" id="SIEM"
                                data-nav-icon="{{ asset('images/nav-icons/26ed416dd0116523.png') }}" />
                            </defs>
<use href="#SIEM" x="0" y="9" />
                          </svg>
                        </span>
                        <div>Managed SIEM And SOC Services
                          <span class="sub-dc">24/7 security monitoring</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'vciso-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="61" height="61" id="vCISO"
                                data-nav-icon="{{ asset('images/nav-icons/8c92aca924fd93df.png') }}" />
                            </defs>
<use href="#vCISO" x="1" y="2" />
                          </svg>
                        </span>
                        <div>vCISO Services
                          <span class="sub-dc">Virtual CISO expertise</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'managed-detection-response-services']) }}">

                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 45" width="45"
                          height="45">
                          <defs>
                            <image width="27" height="27" id="Detection"
                              data-nav-icon="{{ asset('images/nav-icons/b3356d79d4606fd8.png') }}" />
                          </defs>
<use href="#Detection" x="4" y="4" />
                        </svg>
                        <div>Managed Detection and Response
                          <span class="sub-dc">Rapid threat response</span>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'microsoft-security-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 452 452" width="452"
                            height="452">
                            <defs>
                              <image width="358" height="378" id="Microsoft"
                                data-nav-icon="{{ asset('images/nav-icons/c590a71401a313dc.png') }}" />
                            </defs>
<use href="#Microsoft" x="47" y="37" />
                          </svg>
                        </span>
                        <div>Managed Microsoft Security Services
                          <span class="sub-dc">Microsoft security solutions</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'cybersecurity-maturity-assessment-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="60" height="54" id="Maturity-Risk-Assessment"
                                data-nav-icon="{{ asset('images/nav-icons/2fe5e2f1682dfba8.png') }}" />
                            </defs>
<use href="#Maturity-Risk-Assessment" x="3" y="5" />
                          </svg>
                        </span>
                        <div>Cyber Security Maturity Risk Assessment
                          <span class="sub-dc">Assess and improve security posture</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'cybersecurity-audit-compliance-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="56" height="54" id="Audit"
                                data-nav-icon="{{ asset('images/nav-icons/9743184541005b18.png') }}" />
                            </defs>
<use href="#Audit" x="4" y="5" />
                          </svg>
                        </span>
                        <div>Compliance Management and Audit Services
                          <span class="sub-dc">Stay compliant with regulations</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'soc-2-compliance']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64"><defs><image width="86" height="86" id="soc2" data-nav-icon="{{ asset('images/nav-icons/2063fcf6540e9b6b.png') }}"/></defs><use href="#soc2" x="-9" y="-14"/></svg>
                        </span>
                        <div>SOC 2 Compliance
                          <span class="sub-dc">Security you can prove</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div id="cloud-services" class="submenu">
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'cloud-consulting-and-migration-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="64" height="60" id="Multi-Cloud"
                                data-nav-icon="{{ asset('images/nav-icons/0e68f0c8f11a2a68.png') }}" />
                            </defs>
<use href="#Multi-Cloud" x="0" y="2" />
                          </svg>
                        </span>
                        <div>Multi Cloud Consulting and Migration Services
                          <span class="sub-dc">Seamless cloud migration</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'cloud-managed-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100"
                            height="100">
                            <defs>
                              <image width="100" height="100" id="Managed-Cloud"
                                data-nav-icon="{{ asset('images/nav-icons/c2210556d81d151f.png') }}" />
                            </defs>
<use href="#Managed-Cloud" x="1" y="15" />
                          </svg>
                        </span>
                        <div>Managed Cloud and Security Services
                          <span class="sub-dc">Secure cloud management</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'business-continuity-disaster-recovery-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="55" height="55" id="Recovery"
                                data-nav-icon="{{ asset('images/nav-icons/4287b30a1accc414.png') }}" />
                            </defs>
<use href="#Recovery" x="6" y="6" />
                          </svg>
                        </span>
                        <div>Business Continuity and Disaster Recovery
                          <span class="sub-dc">Ensure business resilience</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'devsecops-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100"
                            height="100">
                            <defs>
                              <image width="100" height="100" id="DevSecOps"
                                data-nav-icon="{{ asset('images/nav-icons/08eb907655a5c224.png') }}" />
                            </defs>
<use href="#DevSecOps" x="0" y="0" />
                          </svg>
                        </span>
                        <div>DevSecOps Implementation Services
                          <span class="sub-dc">Integrate security in DevOps</span>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="submenu-column">

                    <div>
                      <a href="{{ route('page.show', ['slug' => 'microsoft-office-365-migration-support-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg width="30" height="30" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="8" height="8" fill="#2196f3">
                            </rect>
                            <rect x="14" y="2" width="8" height="8" fill="#4caf50">
                            </rect>
                            <rect x="2" y="14" width="8" height="8" fill="#ff9800">
                            </rect>
                            <rect x="14" y="14" width="8" height="8" fill="#e91e63">
                            </rect>
                          </svg>
                        </span>
                        <div>Microsoft 365/ Office 365 Migration and Support Services
                          <span class="sub-dc">Microsoft cloud expertise</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'aws-cloud-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg width="30" height="30" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            fill="none">

                            <path fill="#252F3E"
                              d="M4.51 7.687c0 .197.02.357.058.475.042.117.096.245.17.384a.233.233 0 01.037.123c0 .053-.032.107-.1.16l-.336.224a.255.255 0 01-.138.048c-.054 0-.107-.026-.16-.074a1.652 1.652 0 01-.192-.251 4.137 4.137 0 01-.165-.315c-.415.491-.936.737-1.564.737-.447 0-.804-.129-1.064-.385-.261-.256-.394-.598-.394-1.025 0-.454.16-.822.484-1.1.325-.278.756-.416 1.304-.416.18 0 .367.016.564.042.197.027.4.07.612.118v-.39c0-.406-.085-.689-.25-.854-.17-.166-.458-.246-.868-.246-.186 0-.377.022-.574.07a4.23 4.23 0 00-.575.181 1.525 1.525 0 01-.186.07.326.326 0 01-.085.016c-.075 0-.112-.054-.112-.166v-.262c0-.085.01-.15.037-.186a.399.399 0 01.15-.113c.185-.096.409-.176.67-.24.26-.07.537-.101.83-.101.633 0 1.096.144 1.394.432.293.288.442.726.442 1.314v1.73h.01zm-2.161.811c.175 0 .356-.032.548-.096.191-.064.362-.182.505-.342a.848.848 0 00.181-.341c.032-.129.054-.283.054-.465V7.03a4.43 4.43 0 00-.49-.09 3.996 3.996 0 00-.5-.033c-.357 0-.618.07-.793.214-.176.144-.26.347-.26.614 0 .25.063.437.196.566.128.133.314.197.559.197zm4.273.577c-.096 0-.16-.016-.202-.054-.043-.032-.08-.106-.112-.208l-1.25-4.127a.938.938 0 01-.049-.214c0-.085.043-.133.128-.133h.522c.1 0 .17.016.207.053.043.032.075.107.107.208l.894 3.535.83-3.535c.026-.106.058-.176.1-.208a.365.365 0 01.214-.053h.425c.102 0 .17.016.213.053.043.032.08.107.101.208l.841 3.578.92-3.578a.458.458 0 01.107-.208.346.346 0 01.208-.053h.495c.085 0 .133.043.133.133 0 .027-.006.054-.01.086a.76.76 0 01-.038.133l-1.283 4.127c-.032.107-.069.177-.111.209a.34.34 0 01-.203.053h-.457c-.101 0-.17-.016-.213-.053-.043-.038-.08-.107-.101-.214L8.213 5.37l-.82 3.439c-.026.107-.058.176-.1.213-.043.038-.118.054-.213.054h-.458zm6.838.144a3.51 3.51 0 01-.82-.096c-.266-.064-.473-.134-.612-.214-.085-.048-.143-.101-.165-.15a.378.378 0 01-.031-.149v-.272c0-.112.042-.166.122-.166a.3.3 0 01.096.016c.032.011.08.032.133.054.18.08.378.144.585.187.213.042.42.064.633.064.336 0 .596-.059.777-.176a.575.575 0 00.277-.508.52.52 0 00-.144-.373c-.095-.102-.276-.193-.537-.278l-.772-.24c-.388-.123-.676-.305-.851-.545a1.275 1.275 0 01-.266-.774c0-.224.048-.422.143-.593.096-.17.224-.32.384-.438.16-.122.34-.213.553-.277.213-.064.436-.091.67-.091.118 0 .24.005.357.021.122.016.234.038.346.06.106.026.208.052.303.085.096.032.17.064.224.096a.46.46 0 01.16.133.289.289 0 01.047.176v.251c0 .112-.042.171-.122.171a.552.552 0 01-.202-.064 2.427 2.427 0 00-1.022-.208c-.303 0-.543.048-.708.15-.165.1-.25.256-.25.475 0 .149.053.277.16.379.106.101.303.202.585.293l.756.24c.383.123.66.294.825.513.165.219.244.47.244.748 0 .23-.047.437-.138.619a1.436 1.436 0 01-.388.47c-.165.133-.362.23-.591.299-.24.075-.49.112-.761.112z" />

                            <g fill="#F90" fill-rule="evenodd" clip-rule="evenodd">

                              <path
                                d="M14.465 11.813c-1.75 1.297-4.294 1.986-6.481 1.986-3.065 0-5.827-1.137-7.913-3.027-.165-.15-.016-.353.18-.235 2.257 1.313 5.04 2.109 7.92 2.109 1.941 0 4.075-.406 6.039-1.239.293-.133.543.192.255.406z" />

                              <path
                                d="M15.194 10.98c-.223-.287-1.479-.138-2.048-.069-.17.022-.197-.128-.043-.24 1-.705 2.645-.502 2.836-.267.192.24-.053 1.89-.99 2.68-.143.123-.281.06-.218-.1.213-.53.687-1.72.463-2.003z" />

                            </g>

                          </svg>
                        </span>
                        <div>AWS Cloud Services
                          <span class="sub-dc">Scalable and secure cloud solutions</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'aws-partner']) }}">
                        <span class="icoms" aria-hidden="true">
                          <!-- Replace this SVG with your AWS Partner icon -->
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90" width="90" height="90">
                            <defs>
                              <image width="78" height="90" id="awspartner" data-nav-icon="{{ asset('images/nav-icons/5db17444f4fa64df.png') }}" />
                            </defs>
<use href="#awspartner" x="6" y="0" />
                          </svg>
                        </span>
                        <div>AWS Partner
                          <span class="sub-dc">Trusted AWS consulting and solutions</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                                <div id="automation" class="submenu">
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'ai-consulting-services']) }}"><span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 59" width="64" height="59"><defs><image width="63" height="53" id="aiconsulting" data-nav-icon="{{ asset('images/nav-icons/bc20991676506869.png') }}"/></defs><use href="#aiconsulting" x="1" y="5"/></svg>
                        </span>
                        <div>AI Consulting Services<span class="sub-dc">AI strategy & roadmap</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'agentic-ai-services']) }}"><span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64"><defs><image width="62" height="60" id="aiagent" data-nav-icon="{{ asset('images/nav-icons/4713f1a862f24c51.png') }}"/></defs><use href="#aiagent" x="1" y="2"/></svg>
                        </span>
                        <div>Agentic AI Services<span class="sub-dc">Autonomous AI agent solutions</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'ai-development-services']) }}"><span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64"><defs><image width="58" height="50" id="aidevelopement" data-nav-icon="{{ asset('images/nav-icons/02cfe80559ea4201.png') }}"/></defs><use href="#aidevelopement" x="3" y="7"/></svg>
                        </span>
                        <div>AI Development Services<span class="sub-dc">Custom AI solution development</span>
                        </div>
                      </a>
                    </div>
                    
                    
                      
                  </div>
                  <div class="submenu-column">
                    <div><a href="{{ route('page.show', ['slug' => 'ap-ar-automation']) }}"><span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="64" height="64" id="ap-ar-automation"
                                data-nav-icon="{{ asset('images/nav-icons/ab39567ee6b816ed.png') }}" />
                            </defs>
<use href="#ap-ar-automation" x="0" y="0" />
                          </svg>
                        </span>
                        <div>AP/AR Automation<span class="sub-dc">Automate accounts
                            processes</span></div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'robotics-process-automation']) }}"><span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="64" height="64" id="RPA"
                                data-nav-icon="{{ asset('images/nav-icons/8192ee30a107260e.png') }}" />
                            </defs>
<use href="#RPA" x="0" y="0" />
                          </svg>
                        </span>
                        <div>Robotic Process Automation (RPA)<span class="sub-dc">Automate
                            repetitive tasks</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>

                <div id="sap-services" class="submenu">
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'sap-services']) }}"><span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 56" width="64" height="56"><defs><image width="64" height="49" id="saphana" data-nav-icon="{{ asset('images/nav-icons/bc07f163f10158b4.png') }}"/></defs><use href="#saphana" y="4"/></svg>
                        </span>
                        <div>SAP S/4HANA & AI Transformation Services<span class="sub-dc">SAP AI-driven transformation</span>
                        </div>
                      </a>
                    </div>
                  </div>
                  
                </div>

                <div id="finance-accounting" class="submenu">
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'bookkeeping-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="60" height="60" id="Bookkeeping"
                                data-nav-icon="{{ asset('images/nav-icons/0d8123d1e8220ce7.png') }}" />
                            </defs>
<use href="#Bookkeeping" x="2" y="2" />
                          </svg>
                        </span>
                        <div>Bookkeeping Services
                          <span class="sub-dc">Accurate financial records</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'cfo-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="61" height="64" id="CFO"
                                data-nav-icon="{{ asset('images/nav-icons/c48e769627bb63fd.png') }}" />
                            </defs>
<use href="#CFO" x="1" y="0" />
                          </svg>
                        </span>
                        <div>CFO Services
                          <span class="sub-dc">Strategic financial leadership</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'payroll-processing']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="58" height="59" id="Payroll"
                                data-nav-icon="{{ asset('images/nav-icons/ac7a796ba52dea93.png') }}" />
                            </defs>
<use href="#Payroll" x="3" y="3" />
                          </svg>
                        </span>
                        <div>Payroll Services
                          <span class="sub-dc">Efficient payroll management</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'accounts-payable-and-accounts-receivable-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="56" height="55" id="AP-AR"
                                data-nav-icon="{{ asset('images/nav-icons/a043f7d890e68970.png') }}" />
                            </defs>
<use href="#AP-AR" x="4" y="4" />
                          </svg>
                        </span>
                        <div>AP/AR Services
                          <span class="sub-dc">Accounts payable/receivable</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="#">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="48" height="64" id="Financial-Reporting"
                                data-nav-icon="{{ asset('images/nav-icons/cc085328bf58b73e.png') }}" />
                            </defs>
<use href="#Financial-Reporting" x="8" y="0" />
                          </svg>
                        </span>
                        <div>Financial Reporting
                          <span class="sub-dc">Insightful financial reports</span>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="submenu-column">
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'treasury-management']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="62" height="58" id="Treasury"
                                data-nav-icon="{{ asset('images/nav-icons/f5e7d773eafab2aa.png') }}" />
                            </defs>
<use href="#Treasury" x="1" y="3" />
                          </svg>
                        </span>
                        <div>Treasury Management
                          <span class="sub-dc">Optimizing cash flow</span>
                        </div>
                      </a>
                    </div>

                    <div class="submenu-header">Tax Return Preparation Services</div>
                    <div class="submenu-header-sub">
                      <a href="#">
                        <span class="icoms" aria-hidden="true">

<svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
	<defs>
		<image  width="64" height="64" id="1040tax" data-nav-icon="{{ asset('images/nav-icons/047b55f1058f95a1.png') }}"/>
	</defs>
<use href="#1040tax" x="0" y="0"/>
</svg>
                          
                        </span>
                        <div class="ss-service">1040 Tax Filing
                          <span class="sub-dc">Individual income tax returns</span>
                        </div>
                      </a>
                    </div>
                    <div class="submenu-header-sub">
                      <a href="#">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="60" height="53" id="usa"
                                data-nav-icon="{{ asset('images/nav-icons/23515eece18285d3.png') }}" />
                            </defs>
<use href="#usa" x="1" y="6" />
                          </svg>
                        </span>
                        <div class="ss-service">US Tax Preparation
                          <span class="sub-dc">Federal & state tax services</span>
                        </div>
                      </a>
                    </div>
                    <div class="submenu-header-sub">
                      <a href="#">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="53" height="54" id="uk"
                                data-nav-icon="{{ asset('images/nav-icons/13add833aa93f467.png') }}" />
                            </defs>
<use href="#uk" x="6" y="5" />
                          </svg>
                        </span>
                        <div class="ss-service">UK Tax Preparation
                          <span class="sub-dc">HMRC compliance & filing</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                
                <div id="bpo-services" class="submenu">
                  <div class="submenu-column">
                    <div class="submenu-header">Construction Engineering Services</div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'civil-engineering-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
	<defs>
		<image  width="60" height="62" id="civil-engineering" data-nav-icon="{{ asset('images/nav-icons/fbb548cb5c6b0b0b.png') }}"/>
	</defs>
<use href="#civil-engineering" x="2" y="1"/>
</svg>
                        </span>
                        <div>Civil Engineering Services
                          <span class="sub-dc">Civil engineering solutions and support</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'construction-documentation-services']) }}">
                        <span class="icoms" aria-hidden="true">

                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="56" height="60" id="Construction-Documentation"
                                data-nav-icon="{{ asset('images/nav-icons/982ac74118bf1d3c.png') }}" />
                            </defs>
<use href="#Construction-Documentation" x="4" y="2" />
                          </svg>
                        </span>
                        <div>Construction Documentation Services
                          <span class="sub-dc">Detailed construction docs</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'construction-takeoff-estimation-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="89" height="89" id="Takeoff-and-Estimation"
                                data-nav-icon="{{ asset('images/nav-icons/8ba29673e9a42643.png') }}" />
                            </defs>
<use href="#Takeoff-and-Estimation" x="-10" y="-5" />
                          </svg>

                        </span>
                        <div>Construction Takeoff and Estimation Services
                          <span class="sub-dc">Accurate project estimates</span>
                        </div>
                      </a>
                    </div>

                  </div>
                  <div class="submenu-column">
                    <div class="submenu-header">Fund Middle and Back Office Services</div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'hedge-fund-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="64" height="64" id="Hedge-Fund"
                                data-nav-icon="{{ asset('images/nav-icons/6770f33bd4d84a2f.png') }}" />
                            </defs>
<use href="#Hedge-Fund" x="0" y="0" />
                          </svg>
                        </span>
                        <div>Hedge Fund
                          <span class="sub-dc">Hedge fund administration</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'family-office-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="83" height="88" id="Family-Office"
                                data-nav-icon="{{ asset('images/nav-icons/38a3b782640c7859.png') }}" />
                            </defs>
<use href="#Family-Office" x="-22" y="7" />
                          </svg>
                        </span>
                        <div>Family Office
                          <span class="sub-dc">Family office management</span>
                        </div>
                      </a>
                    </div>
                    <div>
                      <a href="{{ route('page.show', ['slug' => 'back-and-middle-office-services']) }}">
                        <span class="icoms" aria-hidden="true">
                          <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64"
                            height="64">
                            <defs>
                              <image width="64" height="64" id="Fund-Administration"
                                data-nav-icon="{{ asset('images/nav-icons/131b7496a38853cc.png') }}" />
                            </defs>
<use href="#Fund-Administration" x="0" y="0" />
                          </svg>
                        </span>
                        <div>Fund Administration
                          <span class="sub-dc">Fund admin services</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault();">
          <span class="nav-link__main">
            <span class="nav-link__icon" aria-hidden="true"><i class="fa-solid fa-industry"></i></span>
            <span class="nav-link__text">Industries</span>
          </span>
          <svg class="dd-arow" width="12" height="12" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z" />
          </svg>
        </a>
        <div class="dropdown-menu single-panel">
          <div class="megamenu">
            <ul class="submenu active">

              <li><a href="{{ route('industries.show', ['slug' => 'information-and-communication-technology']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="42" id="IT-Business"
                          data-nav-icon="{{ asset('images/nav-icons/96820a60e5bd8607.png') }}" />
                      </defs>
<use href="#IT-Business" x="0" y="1" />
                    </svg>
                  </span>
                  <div>Information & Communication Technology</div>
                </a></li>
                
              <li><a href="{{ route('industries.show', ['slug' => 'real-estate-and-construction']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="real-estate"
                          data-nav-icon="{{ asset('images/nav-icons/b9c23c011866ebdc.png') }}" />
                      </defs>
<use href="#real-estate" x="0" y="0" />
                    </svg>
                  </span>
                  <div>Real Estate and Construction</div>
                </a>
              </li>

              <li><a href="{{ route('industries.show', ['slug' => 'travel-and-hospitality']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="56" height="44" id="Hospitality"
                          data-nav-icon="{{ asset('images/nav-icons/5b938807b422a1dc.png') }}" />
                      </defs>
<use href="#Hospitality" x="4" y="10" />
                    </svg>
                  </span>
                  <div>Travel and Hospitality</div>
                </a></li>

              <li><a href="{{ route('industries.show', ['slug' => 'ecommerce-and-retail']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="56" height="48" id="Ecommerce"
                          data-nav-icon="{{ asset('images/nav-icons/a091dec8a2c5d5f8.png') }}" />
                      </defs>
<use href="#Ecommerce" x="4" y="8" />
                    </svg>
                  </span>
                  <div>E-commerce and Retail</div>
                </a></li>

              <li><a href="{{ route('industries.show', ['slug' => 'legal-firm']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="40" height="44" id="Legal"
                          data-nav-icon="{{ asset('images/nav-icons/82a29abcd9e64080.png') }}" />
                      </defs>
<use href="#Legal" x="2" y="0" />
                    </svg>
                  </span>
                  <div>Legal Firm</div>
                </a></li>

              <li><a href="{{ route('industries.show', ['slug' => 'manufacturing']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Manufacturing"
                          data-nav-icon="{{ asset('images/nav-icons/d31bd276f9be2593.png') }}" />
                      </defs>
<use href="#Manufacturing" x="0" y="0" />
                    </svg>
                  </span>
                  <div>Manufacturing</div>
                </a></li>

                <li><a href="{{ route('industries.show', ['slug' => 'chemical-and-energy']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Chemical"
                          data-nav-icon="{{ asset('images/nav-icons/09d0f01bf31cb76b.png') }}" />
                      </defs>
<use href="#Chemical" x="0" y="0" />
                    </svg>
                  </span>
                  <div>Chemical & Energy</div>
                </a></li>

              

              <li><a href="{{ route('industries.show', ['slug' => 'healthcare-and-pharma']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Healthcare"
                          data-nav-icon="{{ asset('images/nav-icons/5328eecea7bb3f7a.png') }}" />
                      </defs>
<use href="#Healthcare" x="0" y="0" />
                    </svg>
                  </span>
                  <div>Healthcare & Pharma</div>
                </a></li>

                <li><a href="{{ route('industries.show', ['slug' => 'bfsi']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="39" id="Banking"
                          data-nav-icon="{{ asset('images/nav-icons/f2d91c566ff87a92.png') }}" />
                      </defs>
<use href="#Banking" x="2" y="5" />
                    </svg>
                  </span>
                  <div>BFSI</div>
                </a></li>

              <li><a href="{{ route('industries.show', ['slug' => 'logistics-and-transportation']) }}"><span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Logistic"
                          data-nav-icon="{{ asset('images/nav-icons/3efa407467735343.png') }}" />
                      </defs>
<use href="#Logistic" x="1" y="2" />
                    </svg>
                  </span>
                  <div>Logistics and Transportation</div>
                </a></li>

              
            </ul>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault();">
          <span class="nav-link__main">
            <span class="nav-link__icon" aria-hidden="true"><i class="fa-solid fa-book-open"></i></span>
            <span class="nav-link__text">Insights &amp; Resources</span>
          </span>
          <svg class="dd-arow" width="12" height="12" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z" />
          </svg>
        </a>
        <div class="dropdown-menu single-panel vertical-panel">
          <div class="megamenu">
            <ul class="submenu active">
              <li><a href="{{ route('case-studies.index') }}">
                  <span class="icoms" aria-hidden="true">
                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="case-study"
                          data-nav-icon="{{ asset('images/nav-icons/4655df7b20c59332.png') }}" />
                      </defs>
<use href="#case-study" x="0" y="0" />
                    </svg>
                  </span>
                  <div>Case Studies</div>
                </a></li>

              <li><a href="{{ route('blog.index') }}">
                  <span class="icoms" aria-hidden="true">
                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Blog"
                          data-nav-icon="{{ asset('images/nav-icons/7fa7608da7893cfe.png') }}" />
                      </defs>
<use href="#Blog" x="1" y="1" />
                    </svg>
                  </span>
                  <div>Blog</div>
                </a></li>

              <li><a href="{{ route('ebooks.index') }}">
                  <span class="icoms" aria-hidden="true">
                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="eBooks"
                          data-nav-icon="{{ asset('images/nav-icons/205f7160658a5482.png') }}" />
                      </defs>
<use href="#eBooks" x="0" y="5" />
                    </svg>
                  </span>
                  <div>eBooks</div>
                </a></li>

              <li><a href="{{ route('white-papers.index') }}">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Whitepapers-and-Reports"
                          data-nav-icon="{{ asset('images/nav-icons/0b575756e30a76ee.png') }}" />
                      </defs>
<use href="#Whitepapers-and-Reports" x="2" y="0" />
                    </svg>
                  </span>
                  <div>Whitepapers &amp; Reports</div>
                </a></li>

              <li><a href="{{ route('pressrelease.index') }}">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Press-Releases"
                          data-nav-icon="{{ asset('images/nav-icons/4058aeb7d2023d72.png') }}" />
                      </defs>
<use href="#Press-Releases" x="1" y="0" />
                    </svg>

                  </span>
                  <div>Press Releases</div>
                </a></li>

              <li><a href="{{ route('articles.index') }}">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Articles"
                          data-nav-icon="{{ asset('images/nav-icons/ee9decf101741fac.png') }}" />
                      </defs>
<use href="#Articles" x="0" y="0" />
                    </svg>
                  </span>
                  <div>Articles</div>
                </a></li>
            </ul>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault();">
          <span class="nav-link__main">
            <span class="nav-link__icon" aria-hidden="true"><i class="fa-solid fa-building"></i></span>
            <span class="nav-link__text">Company</span>
          </span>
          <svg class="dd-arow" width="12" height="12" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z" />
          </svg>
        </a>
        <div class="dropdown-menu single-panel vertical-panel">
          <div class="megamenu">
            <ul class="submenu active">
              <li><a href="{{ route('page.show', ['slug' => 'about-ibn']) }}">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="About-IBN"
                          data-nav-icon="{{ asset('images/nav-icons/050daf5da8446d6c.png') }}" />
                      </defs>
<use href="#About-IBN" x="5" y="0" />
                    </svg>
                  </span>
                  <div>About IBN</div>
                </a></li>

              <li><a href="javascript:void(0)">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Vision-and-Mission"
                          data-nav-icon="{{ asset('images/nav-icons/c584dfdbaaad3970.png') }}" />
                      </defs>
<use href="#Vision-and-Mission" x="1" y="1" />
                    </svg>
                  </span>
                  <div>Vision and Mission</div>
                </a></li>

              <li><a href="javascript:void(0)">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="45" height="48" id="ceo"
                          data-nav-icon="{{ asset('images/nav-icons/0e098f18fc295248.png') }}" />
                      </defs>
<use href="#ceo" x="9" y="8" />
                    </svg>
                  </span>
                  <div>From the CEO</div>
                </a></li>

              <li><a href="{{ route('page.show', ['slug' => 'ibn-team']) }}">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Leadership"
                          data-nav-icon="{{ asset('images/nav-icons/a1e680baf959b21c.png') }}" />
                      </defs>
<use href="#Leadership" x="5" y="0" />
                    </svg>
                  </span>
                  <div>Thought Leadership</div>
                </a></li>

              <li><a href="javascript:void(0)">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Awards"
                          data-nav-icon="{{ asset('images/nav-icons/a337ee989a722e23.png') }}" />
                      </defs>
<use href="#Awards" x="2" y="0" />
                    </svg>
                  </span>
                  <div>Awards and Recognition</div>
                </a></li>

              <li><a href="{{ route('page.show', ['slug' => 'testimonials']) }}">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="Client-Stories"
                          data-nav-icon="{{ asset('images/nav-icons/1d1115023c641b3d.png') }}" />
                      </defs>
<use href="#Client-Stories" x="4" y="1" />
                    </svg>
                  </span>
                  <div>Client Stories</div>
                </a></li>

              <li><a href="javascript:void(0)">
                  <span class="icoms" aria-hidden="true">

                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                      <defs>
                        <image width="44" height="44" id="History"
                          data-nav-icon="{{ asset('images/nav-icons/dec44444876595aa.png') }}" />
                      </defs>
<use href="#History" x="3" y="3" />
                    </svg>
                  </span>
                  <div>History</div>
                </a></li>
            </ul>
          </div>
        </div>
      </li>
    </ul>

    <div class="d-none d-sm-block">
      <div class="calls-sec">
        <a class="Bookmeeting" href="#" data-contact-modal-trigger>
          <span>Get In Touch</span>
        </a>
      </div>
    </div>
  </div>
</nav>
