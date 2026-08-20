@php
    $img = fn (string $file): string => asset('images/ibn-team/'.$file);

    $members = [
        [
            'id' => 'ajay-mehta',
            'name' => 'Ajay Mehta',
            'title' => 'Founder and CEO',
            'modal_title' => 'Founder and CEO',
            'image' => $img('ajay-sir-1.webp'),
            'alt' => 'Ajay Mehta',
            'linkedin' => 'https://in.linkedin.com/in/ajaymehta77',
            'bio' => [
                'Ajay Mehta is responsible for overall strategic and operational, including setting the vision, crafting and implementing the strategy, and driving growth. He is focused on delivering superior financial performance along with high customer and people satisfaction with a goal to make IBN a notable company.',
                'He firmly believes that cutting-edge technology should be used to solve complex, real-world problems. He has an eye to catch a glimpse of the big technological waves early and leveraging them, much before rest of the mass wakes up to those.',
                'Ajay has founded IBN in 1999 and has taken the companies value to the next level by mean of all the business ethics and Business Innovations while being focused on developing and accelerating innovation across the company.',
            ],
        ],
        [
            'id' => 'pratik-shah',
            'name' => 'Pratik Shah',
            'title' => 'CTO – Cloud',
            'modal_title' => 'CTO',
            'image' => $img('pratik-sir-1.webp'),
            'alt' => 'Pratik Shah',
            'linkedin' => 'https://in.linkedin.com/in/ajaymehta77',
            'bio' => [
                'Pratik is a seasoned Technology Advisor and is responsible for designing the solutions that enable our global clients to drive business value and IT transformation, helping them exploit the power of Enterprise Mobility & Cloud, Internet-of-Things, and Big Data Analytics. As a strategist, he uses his skills and experience to help drive innovation that ensures clients maximize the value that Cloud brings to organizations in a secure, compliant, and optimized way. He is a proven leader in the cloud space with over 16 years of experience creating and scaling very large cloud platforms and services. He has led his teams to successfully deliver several Technology Strategy & Product consulting engagements with some of the Enterprises in the field of Energy, Utilities, Logistics, Construction, and Manufacturing. Pratik is passionate about building Connected Enterprises and helping them grow faster using modern technologies.',
            ],
        ],
        [
            'id' => 'surendra-bairagi',
            'name' => 'Surendra Bairagi',
            'title' => 'Global Head – Sales & Strategies',
            'modal_title' => 'Global Head Sales & Strategies',
            'image' => $img('surendra-sir-1.webp'),
            'alt' => 'Surendra Bairagi',
            'linkedin' => 'https://in.linkedin.com/in/surendra-bairagi-5bb4188',
            'bio' => [
                'Surendra is an astute Business Strategist, Cloud Evangelist and has Business Leadership experience in creating highly effective sales teams and leading strategic sales efforts with large global enterprises. He is involved in strategic planning and implementation of technology-led activities and innovations benefiting the core business.',
                'He is responsible for driving CloudIBN’s global growth strategy and market leadership by delivering and supporting Cloud Services and solutions.',
                'He brings with him 16 plus years of experience in IT Sales and Marketing, channel operations, customer-centric operations, business development, and business partnerships. His journey of 16 years has seen coveted technical and managerial roles which allowed him to lead teams of exceptional sizes, develop and coordinate sales selling cycles to result in surpassing revenue targets.',
                'He strongly believes in creating authentic and mutually significant long-term relationships with customers. His background also includes leadership positions in top-tier companies such as Tata Communications and Sify Technologies Ltd, where he was responsible for the end-to-end strategies to advance the company’s Cloud Computing position.',
            ],
        ],
        [
            'id' => 'nejal-panchal',
            'name' => 'Nejal Panchal',
            'title' => 'Sr. Process Manager – FOF & HF',
            'modal_title' => 'Senior Process Manager',
            'image' => $img('nejal-sir-1-1.webp'),
            'alt' => 'Nejal Panchal',
            'linkedin' => 'https://in.linkedin.com/in/panchal82',
            'bio' => [
                'Mr. Nejal Panchal brings a robust background in Production Engineering and Business Administration to his role as a seasoned Process Manager and Market Researcher. With over 20 years of experience, he has distinguished himself in Process Management, Market Data Analysis, and project oversight. Known for his decisive management approach, exceptional communication prowess, and proficiency in negotiation, Mr. Panchal excels in ensuring operational excellence. His expertise spans managing Hedge Funds, Fund of Funds, and Private Equity middle and back office operations. He possesses a solid foundation in fund data analysis, encompassing fund accounting and comprehensive market research. In his current capacity, Mr. Panchal focuses on maintaining operational stability and enhancing service delivery efficiency. He prioritizes quality assurance, regulatory compliance, and optimizing productivity. His strategic insights are instrumental in advising senior management on refining processes, systems, and procedures to drive organizational success.',
            ],
        ],
        [
            'id' => 'aniket-ruke',
            'name' => 'Aniket Ruke',
            'title' => 'General Manager – F & A',
            'modal_title' => 'General Manager – F & A',
            'image' => $img('aniket-sir-2.webp'),
            'alt' => 'Aniket Ruke',
            'linkedin' => 'https://in.linkedin.com/in/aniket-ruke-67aaaa14',
            'bio' => [
                'Aniket Ruke brings over 15 years of extensive experience in the accounting field, covering the US, Canada, Mexico, the UK, Iceland, and Australia. He has a proven track record of delivering high-quality work across diverse industries, including manufacturing, construction, automotive, insurance, financial institutions, law firms, medical and hospitality sectors, and non-profit organizations such as schools, churches, and welfare organizations. He excels in managing complex accounting tasks such as sales tax, GST, and VAT reconciliation. He is proficient in a wide range of accounting software, including all versions of QuickBooks, NetSuite, Xero, Sage 50, Microsoft Great Plains Dynamics, MYOB, and more. Known for his high-quality work and maintaining a healthy work environment, Aniket has successfully retained numerous clients. His expertise and dedication to excellence make him a vital asset to our team.',
            ],
        ],
        [
            'id' => 'pradip-gore',
            'name' => 'Pradip Gore',
            'title' => 'DGM – ITEs',
            'modal_title' => 'DGM – ITEs',
            'image' => $img('pradip-sir-1.webp'),
            'alt' => 'Pradip Gore',
            'linkedin' => 'https://in.linkedin.com/in/pradip-gore',
            'bio' => [
                'Pradip spearheads strategic business development for IBN’s fintech domain, leveraging over 12 years of expertise in acquisition and customer management. His passion lies in understanding business challenges and delivering optimal solutions.',
                'Pradip is responsible for planning and overseeing marketing and sales activities, ensuring exceptional support and fostering strong customer relationships.',
            ],
        ],
    ];
@endphp

@extends('layouts.app')

@push('styles')
    @vite(['resources/css/pages/ibn-team.css'])
@endpush

@section('content')
    <div
        class="ibn-team-page"
        x-data="{
            open: false,
            activeId: null,
            lastFocus: null,
            members: {{ Js::from($members) }},
            get active() {
                return this.members.find((member) => member.id === this.activeId) || null;
            },
            show(id, event) {
                this.activeId = id;
                this.open = true;
                this.lastFocus = event ? event.currentTarget : null;
                document.documentElement.classList.add('ibn-team-modal-open');
                this.$nextTick(() => {
                    const closeBtn = this.$root.querySelector('.ibn-team-modal__close');
                    if (closeBtn) {
                        closeBtn.focus();
                    }
                });
            },
            close() {
                if (! this.open) {
                    return;
                }
                this.open = false;
                document.documentElement.classList.remove('ibn-team-modal-open');
                if (this.lastFocus) {
                    this.lastFocus.focus();
                }
            }
        }"
        @keydown.escape.window="close()"
    >
        <section class="ibn-team-hero" aria-labelledby="ibn-team-title">
            <div class="site-shell ibn-team-hero__inner">
                <div class="ibn-team-hero__copy">
                    <h1 id="ibn-team-title">Our Team</h1>
                    <p>
                        Our skilled professionals combine modern thinking with in-depth industry experience to provide guidance that promotes productivity, growth, and long-term success. With advanced knowledge, we continue to set benchmarks in the industry. We bridge the gap between creative vision and practical execution, empowering businesses to succeed. As visionary leaders, we excel in creating client-centered solutions and high-value strategies that propel businesses forward.
                    </p>
                    <p>
                        Our team leverages cutting-edge technologies to stay ahead of trends while ensuring practical application. We are dedicated to fostering innovation and developing strategies that meet each client's unique needs. Our commitment to excellence drives us to consistently achieve outstanding results, setting us apart as industry leaders
                    </p>
                </div>

                <div class="ibn-team-grid" role="list">
                    @foreach ($members as $index => $member)
                        <article class="ibn-team-card" role="listitem">
                            <div class="ibn-team-card__photo">
                                <img
                                    src="{{ $member['image'] }}"
                                    alt="{{ $member['alt'] }}"
                                    width="650"
                                    height="650"
                                    @if ($index < 2) fetchpriority="high" @else loading="lazy" @endif
                                    decoding="async"
                                >
                            </div>
                            <h2>{{ $member['name'] }}</h2>
                            <p>{{ $member['title'] }}</p>
                            <button
                                type="button"
                                class="ibn-team-card__cta"
                                @click="show('{{ $member['id'] }}', $event)"
                                aria-haspopup="dialog"
                                aria-controls="ibn-team-profile"
                                :aria-expanded="open && activeId === '{{ $member['id'] }}'"
                            >
                                View Profile
                            </button>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <div
            class="ibn-team-modal"
            x-show="open"
            x-cloak
            x-transition.opacity.duration.200ms
            role="presentation"
        >
            <div class="ibn-team-modal__backdrop" @click="close()" aria-hidden="true"></div>

            <div
                class="ibn-team-modal__dialog"
                id="ibn-team-profile"
                role="dialog"
                aria-modal="true"
                :aria-labelledby="active ? 'ibn-team-profile-name' : null"
                tabindex="-1"
                @click.stop
            >
                <template x-if="active">
                    <div class="ibn-team-modal__layout">
                        <div class="ibn-team-modal__brand">
                            <div class="ibn-team-modal__photo">
                                <img :src="active.image" :alt="active.alt" width="650" height="650">
                            </div>
                            <h2 id="ibn-team-profile-name" x-text="active.name"></h2>
                            <p x-text="active.modal_title"></p>
                            <a
                                class="ibn-team-modal__linkedin"
                                :href="active.linkedin"
                                target="_blank"
                                rel="noopener noreferrer"
                                :aria-label="'View ' + active.name + ' on LinkedIn'"
                            >
                                <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </div>

                        <div class="ibn-team-modal__bio">
                            <button
                                type="button"
                                class="ibn-team-modal__close"
                                @click="close()"
                                aria-label="Close profile"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <template x-for="(paragraph, index) in active.bio" :key="index">
                                <p x-text="paragraph"></p>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
@endsection
