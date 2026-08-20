@php
    $logos = [
        'abitach.webp', 'askmia.webp', 'Atlantic-data.webp', 'Aurionpro.webp', 'Azuga.webp',
        'bike-bazaar.webp', 'British-Orient.webp', 'Chemito.webp', 'Cloud-Rewind.webp', 'Contata.webp',
        'Demand-media.webp', 'Digital-Zone.webp', 'Docully.webp', 'DOD-Technologies.webp', 'EM6-Worldwide.webp',
        'Ephlux.webp', 'instem.webp', 'Isckon.webp', 'Lattice.webp', 'Lenden.webp',
        'LT.webp', 'Mapmyindia.webp', 'Maximeyes.webp', 'MTX.webp', 'orowealth.webp',
        'Routematic.webp', 'Tradesun.webp', 'vsoftcorp.webp', 'Wassha.webp', 'Wint.webp',
    ];
@endphp

<section class="home-clients" aria-label="Our clients">
    <div class="home-shell">
        <div class="home-clients__divider">
            <span class="home-pill home-pill--green">Our Clients</span>
        </div>
    </div>
    <div class="home-marquee" data-home-marquee>
        <div class="home-marquee__track">
            @foreach ([...$logos, ...$logos] as $logo)
                <div class="home-logo-chip">
                    <img
                        src="{{ asset('images/clients-logo/'.$logo) }}"
                        alt="{{ pathinfo($logo, PATHINFO_FILENAME) }} client logo"
                        width="140"
                        height="48"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            @endforeach
        </div>
    </div>
</section>
