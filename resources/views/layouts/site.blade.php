<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') | {{ $settings['site_name'] ?? 'Pak Namak & Masala Jaat' }}</title>
    <meta name="description" content="@yield('description', 'Pak Namak & Masala Jaat — trusted supplier of high-quality salt, Dalla Namak, Khulla Namak, packed salt and premium Masala Jaat.')">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/icon-192.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">
</head>
<body>
@php
    $orderUrl = $settings['order_url'] ?? '#';
    $menu = [
        ['Home', route('home'), request()->routeIs('home')],
        ['Shop', route('shop'), request()->routeIs('shop')],
        ['Order Now', $orderUrl, false],
        ['About Us', route('about'), request()->routeIs('about')],
        ['Contact Us', route('contact'), request()->routeIs('contact')],
    ];
@endphp

<div id="top-header">
    <div class="container">
        <div id="et-info">
            @if(!empty($settings['phone']))
                <span id="et-info-phone"><svg viewBox="0 0 24 24"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>{{ $settings['phone'] }}</span>
            @endif
            @if(!empty($settings['email']))
                <a href="mailto:{{ $settings['email'] }}"><span id="et-info-email"><svg viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>{{ $settings['email'] }}</span></a>
            @endif
        </div>
    </div>
</div>

<header id="main-header">
    <div class="container">
        <div class="logo_container">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Pak Namak and Masala Jaat PVT Limited" id="logo"></a>
        </div>
        <div id="et-top-navigation">
            <nav id="top-menu-nav">
                <ul id="top-menu">
                    @foreach($menu as [$label, $url, $active])
                        <li @class(['current-menu-item' => $active])><a href="{{ $url }}">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </nav>
            <div id="et_mobile_nav_menu">
                <button class="mobile_menu_bar" aria-label="Menu" onclick="document.getElementById('mobile_menu').classList.toggle('open')">
                    <svg viewBox="0 0 24 24"><path d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
                </button>
            </div>
        </div>
        <ul id="mobile_menu" class="et_mobile_menu">
            @foreach($menu as [$label, $url, $active])
                <li><a href="{{ $url }}">{{ $label }}</a></li>
            @endforeach
        </ul>
    </div>
</header>

<div id="page-container">
    <div id="et-main-area">
        @yield('content')

        <footer id="main-footer">
            <div id="footer-bottom">
                <div class="container">
                    <div id="footer-info">Powered By @ Pak Namak &amp; Masala Jaat (pvt) Limited</div>
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
