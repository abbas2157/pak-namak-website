@extends('layouts.site')

@section('title', 'Home')
@section('description', 'Pak Namak & Masala Jaat (PVT) Limited, Melsi: cleaned and finely ground rock salt, Dalla Namak, Khulla Namak, packed salt and premium Masala Jaat for homes, shops and restaurants.')

@push('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}" fetchpriority="high">
@endpush

@section('content')
    {{-- Section 0: hero --}}
    <div class="et_pb_section hero-home">
        <div class="et_pb_row row-800">
            <div class="col col-4_4">
                <div class="mod mb-10 t-center" style="color:#d9d9d9"><h2 lang="ur"><span style="color:#fff">{{ $settings['tagline_ur'] ?? 'خالص نمک، خالص زندگی' }}</span></h2></div>
                <div class="mod mb-10 t-center"><h1 class="h72 c-white">{{ $settings['site_name'] ?? 'Pak Namak & Masala Jaat (PVT) Limited' }}</h1></div>
                <div class="mod t-center txt16 c-white" style="padding-top:1px;margin-bottom:30px"><p lang="ur">{!! nl2br(e($settings['hero_text_ur'] ?? '')) !!}</p></div>
                <div class="mod btn-wrap t-center"><a class="et_pb_button btn-white" href="{{ route('products') }}">Our Products</a></div>
            </div>
        </div>
    </div>

    {{-- Section 1: three services --}}
    <div class="et_pb_section bg-grey">
        <div class="et_pb_row">
            @foreach([
                ['icon-1.png', 'Salt Processing & Grinding', 'We purchase raw salt and process it with proper cleaning and grinding methods.'],
                ['icon-2.png', 'Multiple Packaging Solution', 'We supply Dalla Namak, Khulla Namak, and packed salt in different quantities.'],
                ['icon-3.png', 'All Range of Masala Jaat', 'We provide a wide variety of high-quality Masala Jaat for everyday cooking needs.'],
            ] as [$icon, $title, $text])
                <div class="col col-1_3 border-2 pad-20">
                    <div class="mod et_pb_image icon-64 mb-20"><img src="{{ asset('images/'.$icon) }}" width="64" height="64" alt=""></div>
                    <div class="mod mb-0"><h5 class="h20">{{ $title }}</h5></div>
                    <div class="mod lh16"><p>{{ $text }}</p></div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Section 2: family owned --}}
    <div class="et_pb_section bg-white">
        <div class="et_pb_row">
            <div class="col col-4_4">
                <div class="mod"><h2 class="h52"><span class="c-333">Family Owned &amp; Operated Since {{ $settings['founded_year'] ?? '2024' }}</span></h2></div>
            </div>
        </div>
        <div class="et_pb_row">
            <div class="col col-2_5">
                <div class="mod et_pb_image"><img src="{{ asset('images/logo-480.png') }}" width="480" height="480" loading="lazy" alt="Pak Namak and Masala Jaat PVT Limited logo"></div>
                <div class="mod txt16">
                    <p>Pak Namak &amp; Masala Jaat is a trusted supplier of high-quality salt, carefully processed and ground for purity.</p>
                    <p><br>We offer Dalla Namak, Khulla Namak, and hygienically packed salt along with a complete range of premium Masala Jaat.</p>
                </div>
                <div class="mod btn-wrap"><a class="et_pb_button btn-green" href="{{ route('about') }}">More About Us</a></div>
            </div>
            <div class="col col-3_5">
                <div class="mod et_pb_image"><img src="{{ asset('images/packet-salt-800.jpg') }}" width="800" height="1067" loading="lazy" alt="Pak Namak packed salt packets"></div>
            </div>
        </div>
    </div>

    {{-- Section 3: primary goals --}}
    <div class="et_pb_section">
        <div class="et_pb_row">
            <div class="col col-4_4">
                <div class="mod"><h2 class="h52">Our Primary Goals</h2></div>
            </div>
        </div>
        <div class="et_pb_row equal gutters1 row-pb0">
            <div class="col col-1_3 pad-30">
                <div class="mod et_pb_image icon-64 mb-20"><img src="{{ asset('images/icon-1.png') }}" width="64" height="64" loading="lazy" alt=""></div>
                <div class="mod mb-0"><h4 class="h24">Ensure Premium Quality</h4></div>
                <div class="mod lh16 mb-20"><p>Our primary goal is to maintain the highest standards of purity and quality in all our salt and masala products.</p></div>
            </div>
            <div class="col col-1_3 pad-30 bg-white">
                <div class="mod et_pb_image icon-64 mb-20 bg-white"><img src="{{ asset('images/icon-2.png') }}" width="64" height="64" loading="lazy" alt=""></div>
                <div class="mod mb-0"><h4 class="h24"><span class="c-black">Customer Satisfaction</span></h4></div>
                <div class="mod lh16 mb-20"><p><span class="c-666">We aim to build long-term relationships by providing reliable products and competitive pricing.</span></p></div>
            </div>
            <div class="col col-1_3 pad-30 bg-white">
                <div class="mod et_pb_image icon-64 mb-20"><img src="{{ asset('images/icon-3.png') }}" width="64" height="64" loading="lazy" alt=""></div>
                <div class="mod mb-0"><h4 class="h24"><span class="c-black">Growth &amp; Improvement</span></h4></div>
                <div class="mod lh16 mb-20"><p><span class="c-666">We strive to expand our product range and improve our processes through innovation and efficiency.</span></p></div>
            </div>
        </div>
    </div>

    {{-- Section 4: partnering --}}
    <div class="et_pb_section" style="overflow:hidden">
        <div class="et_pb_row row-pb29">
            <div class="col col-1_2 col-pad-10pct">
                <div class="mod mb-10"><h2 class="h52">Partnering With Local Chefs &amp; Restaurants</h2></div>
                @foreach(preg_split('/\r?\n/', trim($settings['hero_text_ur'] ?? '')) as $line)
                    <div class="mod txt16"><h3 lang="ur" class="t-right">{{ rtrim($line, '۔') }}</h3></div>
                @endforeach
            </div>
            <div class="col col-1_2">
                <div class="mod et_pb_image t-center"><img src="{{ asset('images/products-banner.webp') }}" width="800" height="925" loading="lazy" alt="Pak Namak salt products"></div>
            </div>
        </div>
    </div>

@endsection
