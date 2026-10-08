<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@php
    $siteName = $settings['site_name'] ?? 'Pak Namak & Masala Jaat (PVT) Limited';
    $routeName = request()->route()?->getName();
    $seoDefaults = config("seo.pages.$routeName");

    // Title/description precedence: dashboard override -> config default -> view section.
    $pageTitle = $seoDefaults
        ? (($settings["seo_{$routeName}_title"] ?? '') ?: $seoDefaults['title'])
        : trim($__env->yieldContent('title', 'Home')).' | '.$siteName;
    $pageDescription = $seoDefaults
        ? (($settings["seo_{$routeName}_description"] ?? '') ?: $seoDefaults['description'])
        : trim($__env->yieldContent('description', config('seo.default_description')));
    $pageImage = trim($__env->yieldContent('og_image', asset('images/og-image.jpg')));
    $canonical = url()->current();
    $robots = trim($__env->yieldContent('robots', 'index, follow, max-image-preview:large'));
    $tagId = $settings['google_tag_id'] ?? config('seo.google_tag_id');

    $orgId = route('home').'#organization';
    $graph = [
        array_filter([
            '@type' => ['Organization', 'LocalBusiness'],
            '@id' => $orgId,
            'name' => $siteName,
            'alternateName' => ['Pak Namak', 'پاک نمک اینڈ مصالحہ جات'],
            'url' => route('home'),
            'logo' => asset('images/logo-480.png'),
            'image' => asset('images/og-image.jpg'),
            'description' => config('seo.default_description'),
            'telephone' => $settings['phone'] ?? null,
            'email' => $settings['email'] ?? null,
            'foundingDate' => $settings['founded_year'] ?? null,
            'priceRange' => 'Rs',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Basti Dhore Wala Stop, near Adda Bahawalwah, Melsi–Multan Road',
                'addressLocality' => 'Melsi',
                'addressRegion' => 'Punjab',
                'postalCode' => '61180',
                'addressCountry' => 'PK',
            ],
            'geo' => ['@type' => 'GeoCoordinates', 'latitude' => 29.9171363, 'longitude' => 71.9900305],
            'hasMap' => $settings['map_url'] ?? null,
            'areaServed' => ['Melsi', 'Vehari', 'Multan', 'Burewala', 'Khanewal', 'Punjab'],
            'sameAs' => array_values(array_filter([$settings['facebook'] ?? null, $settings['tiktok'] ?? null, $settings['youtube'] ?? null, $settings['instagram'] ?? null])),
        ]),
        [
            '@type' => 'WebSite',
            '@id' => route('home').'#website',
            'url' => route('home'),
            'name' => $siteName,
            'inLanguage' => ['en', 'ur'],
            'publisher' => ['@id' => $orgId],
        ],
    ];
    if ($seoDefaults && $routeName !== 'home') {
        $graph[] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $seoDefaults['label'], 'item' => $canonical],
            ],
        ];
    }
@endphp
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="{{ $robots }}">
    <link rel="canonical" href="{{ $canonical }}">
    @if(!empty($settings['google_site_verification']))
        <meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_PK">
    <meta property="og:locale:alternate" content="ur_PK">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $siteName }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @stack('schema')

    <meta name="theme-color" content="#00463b">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('images/icon-192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @stack('preload')
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">

    @if($tagId)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $tagId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', @json($tagId));
        </script>
    @endif
</head>
<body id="top">
@php
    $menu = [
        ['Home', route('home'), request()->routeIs('home'), []],
        ['Products', route('products'), request()->routeIs('products'), []],
        ['FAQs', route('faqs'), request()->routeIs('faqs'), []],
        ['About Us', route('about'), request()->routeIs('about'), []],
        ['Become a Dealer', route('dealer'), request()->routeIs('dealer'), []],
        ['Contact Us', route('contact'), request()->routeIs('contact'), []],
    ];
@endphp

<div id="top-header">
    <div class="container">
        <div id="et-info">
            @if(!empty($settings['phone']))
                <span id="et-info-phone"><svg viewBox="0 0 24 24" width="13" height="13" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>{{ $settings['phone'] }}</span>
            @endif
            @if(!empty($settings['email']))
                <a href="mailto:{{ $settings['email'] }}"><span id="et-info-email"><svg viewBox="0 0 24 24" width="13" height="13" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>{{ $settings['email'] }}</span></a>
            @endif
        </div>
    </div>
</div>

<header id="main-header">
    <div class="container">
        <div class="logo_container">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo-160.png') }}" width="80" height="80" alt="Pak Namak and Masala Jaat PVT Limited" id="logo"></a>
        </div>
        <div id="et-top-navigation">
            <nav id="top-menu-nav">
                <ul id="top-menu">
                    @foreach($menu as [$label, $url, $active, $children])
                        <li @class(['current-menu-item' => $active, 'menu-item-has-children' => $children])>
                            <a href="{{ $url }}">{{ $label }}</a>
                            @if($children)
                                <ul class="sub-menu">
                                    @foreach($children as $childLabel => $childUrl)
                                        <li><a href="{{ $childUrl }}">{{ $childLabel }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div id="et_mobile_nav_menu">
                <button class="mobile_menu_bar" aria-label="Menu" onclick="document.getElementById('mobile_menu').classList.toggle('open')">
                    <svg viewBox="0 0 24 24" width="32" height="32" aria-hidden="true"><path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
                </button>
            </div>
        </div>
        <ul id="mobile_menu" class="et_mobile_menu">
            @foreach($menu as [$label, $url, $active, $children])
                @if($children)
                    @foreach($children as $childLabel => $childUrl)
                        <li><a href="{{ $childUrl }}">{{ $childLabel }}</a></li>
                    @endforeach
                @else
                    <li><a href="{{ $url }}">{{ $label }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</header>

<div id="page-container">
    <div id="et-main-area">
        @yield('content')

        @php
            $ftPhone = $settings['phone'] ?? '';
            $ftWa = $settings['whatsapp'] ?? '';
        @endphp
        <footer id="main-footer" class="ft">
            <div class="container ft-grid">
                <div class="ft-brand">
                    <a href="{{ route('home') }}" class="ft-logo">
                        <img src="{{ asset('images/logo-160.png') }}" width="64" height="64" alt="" loading="lazy">
                        <span>Pak Namak<small>&amp; Masala Jaat</small></span>
                    </a>
                    @if(!empty($settings['tagline_ur']))<p class="ft-tagline" lang="ur" dir="rtl">{{ $settings['tagline_ur'] }}</p>@endif
                    <p>Clean, properly ground salt and pure masala from Melsi, Punjab — packed for homes, shops and wholesale buyers.</p>
                    @include('site.partials.social', ['class' => 'ft-social', 'links' => [
                        'facebook' => $settings['facebook'] ?? null,
                        'youtube' => $settings['youtube'] ?? null,
                        'tiktok' => $settings['tiktok'] ?? null,
                        'instagram' => $settings['instagram'] ?? null,
                        'whatsapp' => $settings['whatsapp_link'] ?? null,
                    ]])
                </div>

                <nav class="ft-col" aria-labelledby="ft-company">
                    <h2 id="ft-company">Company</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('faqs') }}">FAQs</a></li>
                        <li><a href="{{ route('dealer') }}">Become a Dealer</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </nav>

                <nav class="ft-col" aria-labelledby="ft-products">
                    <h2 id="ft-products">Products</h2>
                    <ul>
                        @forelse($footerCategories as $category)
                            <li><a href="{{ route('products') }}#{{ $category->slug }}">{{ $category->name }}</a></li>
                        @empty
                            <li><a href="{{ route('products') }}">All products</a></li>
                        @endforelse
                    </ul>
                </nav>

                <div class="ft-col ft-contact">
                    <h2>Get in touch</h2>
                    <ul>
                        @if(!empty($settings['address']))
                            <li>
                                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                                <span><span lang="ur" dir="rtl" class="ft-address">{{ $settings['address'] }}</span>
                                @if(!empty($settings['map_url']))<a href="{{ $settings['map_url'] }}" target="_blank" rel="noopener" class="ft-more">Get directions →</a>@endif</span>
                            </li>
                        @endif
                        @if($ftPhone)
                            <li>
                                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>
                                <a href="tel:{{ preg_replace('/[^\d+]/', '', $ftPhone) }}">{{ $ftPhone }}</a>
                            </li>
                        @endif
                        @if(!empty($settings['email']))
                            <li>
                                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
                                <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
                            </li>
                        @endif
                        @if(!empty($settings['business_hours']))
                            <li>
                                <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm1 10.4 3.2 3.2-1.4 1.4L11 13.2V6h2z"/></svg>
                                <span>{{ $settings['business_hours'] }}</span>
                            </li>
                        @endif
                    </ul>
                    @if($ftWa)
                        <a class="ft-wa" href="https://wa.me/{{ $ftWa }}?text={{ rawurlencode("Assalam o Alaikum, please share today's rates for Pak Namak products.") }}" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5.3-.5c.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3zM12 21.8a9.8 9.8 0 0 1-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4A9.8 9.8 0 1 1 12 21.8zM20.5 3.5A11.8 11.8 0 0 0 1.9 17.7L.2 24l6.4-1.7A11.8 11.8 0 0 0 24 12c0-3.2-1.2-6.2-3.5-8.5z"/></svg>
                            Get today's rates on WhatsApp
                        </a>
                    @endif
                </div>
            </div>

            <div class="ft-bottom">
                <div class="container ft-bottom-inner">
                    <p>© {{ date('Y') }} {{ $siteName }}@if(!empty($settings['ntn']))<span class="ft-ntn">NTN {{ $settings['ntn'] }}</span>@endif</p>
                    <ul>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms</a></li>
                        <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
                        <li><a href="#top" class="ft-top">Back to top ↑</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>

<script>
    (function () {
        var header = document.getElementById('main-header');
        function onScroll() { header.classList.toggle('et-fixed-header', window.scrollY > 0); }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        document.querySelectorAll('.accordion .toggle-title').forEach(function (title) {
            title.addEventListener('click', function () {
                var item = title.parentElement, wasOpen = item.classList.contains('open');
                item.parentElement.querySelectorAll('.toggle').forEach(function (t) { t.classList.remove('open'); });
                if (!wasOpen) item.classList.add('open');
            });
        });
    })();
</script>
</body>
</html>
