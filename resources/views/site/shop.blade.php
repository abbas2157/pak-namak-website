@extends('layouts.site')

@section('title', 'Shop')
@section('description', 'Buy Pak Namak salt in 50 kg, 10 kg and 5 kg bags, retail packets from 250g to 700g, Dalla Namak and Masala Jaat. Wholesale and retail rates on request.')

@push('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}" fetchpriority="high">
@endpush

@push('schema')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Pak Namak salt and masala products',
        'itemListElement' => $categories->flatMap->products->values()->map(fn ($product, $i) => [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'item' => array_filter([
                '@type' => 'Product',
                'name' => $product->name,
                'image' => $product->image_url,
                'description' => $product->description ?: $product->name.' by Pak Namak & Masala Jaat',
                'category' => $product->category?->name,
                'brand' => ['@type' => 'Brand', 'name' => 'Pak Namak'],
                'offers' => $product->price ? [
                    '@type' => 'Offer', 'price' => (string) $product->price, 'priceCurrency' => 'PKR',
                    'availability' => 'https://schema.org/InStock', 'url' => route('shop'),
                ] : null,
            ]),
        ]),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    @php
        $waNumber = $settings['whatsapp'] ?? '';
        $waLink = fn (string $product) => 'https://wa.me/'.$waNumber.'?text='.rawurlencode(
            "Assalam o Alaikum, I would like to order: {$product}. Please share today's rate."
        );
        $phone = $settings['phone'] ?? '';
        $waIcon = 'M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5.3-.5c.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3zM12 21.8a9.8 9.8 0 0 1-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4A9.8 9.8 0 1 1 12 21.8zM20.5 3.5A11.8 11.8 0 0 0 1.9 17.7L.2 24l6.4-1.7A11.8 11.8 0 0 0 24 12c0-3.2-1.2-6.2-3.5-8.5z';
    @endphp

    {{-- Hero --}}
    <div class="et_pb_section hero-shop shop-hero">
        <div class="et_pb_row row-800">
            <div class="col col-4_4">
                <div class="mod mb-10 t-center"><h1 class="h52 c-white">Our Products</h1></div>
                <div class="mod lh16 c-white t-center"><p>Pure, properly ground salt and everyday masala, in pack sizes for homes, shops and wholesale buyers.</p></div>
                <div class="mod lh16 c-white t-center"><p lang="ur">ریٹیل اور تھوک دونوں ضروریات کے لیے مختلف وزن میں اعلیٰ معیار کا نمک اور مصالحہ جات</p></div>
            </div>
        </div>
    </div>

    {{-- Trust strip --}}
    <div class="shop-trust">
        <div class="container">
            <div><img src="{{ asset('images/icon-1.png') }}" width="40" height="40" alt=""><span><strong>Cleaned &amp; finely ground</strong>Every batch checked before packing</span></div>
            <div><img src="{{ asset('images/icon-2.png') }}" width="40" height="40" alt=""><span><strong>Hygienic packing</strong>From 250g packets to 50kg bags</span></div>
            <div><img src="{{ asset('images/icon-3.png') }}" width="40" height="40" alt=""><span><strong>Wholesale rates</strong>Today's rate on WhatsApp, same day</span></div>
        </div>
    </div>

    {{-- Category tabs --}}
    <nav class="shop-tabs" aria-label="Product categories">
        <div class="container">
            <button type="button" class="active" data-filter="all">All <span>{{ $categories->sum(fn ($c) => $c->products->count()) }}</span></button>
            @foreach($categories as $category)
                <button type="button" data-filter="{{ $category->slug }}">{{ $category->name }} <span>{{ $category->products->count() }}</span></button>
            @endforeach
        </div>
    </nav>

    {{-- Catalog --}}
    <div class="shop-catalog">
        <div class="container">
            @foreach($categories as $category)
                <section class="shop-group" id="{{ $category->slug }}" data-group="{{ $category->slug }}">
                    <header class="shop-group-head">
                        <h2>{{ $category->name }}</h2>
                        @if($category->name_ur)<p lang="ur">{{ $category->name_ur }}</p>@endif
                    </header>
                    <div class="shop-grid">
                        @foreach($category->products as $product)
                            <article class="product-card">
                                <div class="product-media">
                                    <img src="{{ $product->image_url }}" width="225" height="300" alt="{{ $product->name }} — Pak Namak" loading="lazy">
                                    <span class="product-badge">{{ $category->name }}</span>
                                </div>
                                <div class="product-body">
                                    <h3>{{ $product->name }}</h3>
                                    @if($product->name_ur)<p class="product-ur" lang="ur">{{ $product->name_ur }}</p>@endif
                                    @if($product->description)<p class="product-desc" lang="ur">{{ $product->description }}</p>@endif
                                    <div class="product-price">
                                        @if($product->price)
                                            Rs {{ number_format($product->price) }}
                                        @else
                                            Rates on request <small lang="ur">قیمت کے لیے رابطہ کریں</small>
                                        @endif
                                    </div>
                                    <div class="product-actions">
                                        @if($waNumber)
                                            <a class="btn-wa" href="{{ $waLink($product->name) }}" target="_blank" rel="noopener">
                                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="{{ $waIcon }}"/></svg>Order on WhatsApp
                                            </a>
                                        @endif
                                        <a class="btn-enquire" href="{{ route('contact', ['product' => $product->name]) }}">Enquire</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </div>

    {{-- Bulk CTA --}}
    <div class="shop-cta">
        <div class="container">
            <div>
                <h2>Need bulk quantity or custom packing?</h2>
                <p>We pack under your own brand for regular buyers and deliver across South Punjab.</p>
                <p lang="ur">تھوک مقدار یا اپنی مرضی کی پیکنگ کے لیے ہم سے رابطہ کریں۔</p>
            </div>
            <div class="shop-cta-actions">
                @if($phone)<a class="et_pb_button btn-white" href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}">Call {{ $phone }}</a>@endif
                <a class="et_pb_button btn-outline-white" href="{{ route('dealer') }}">Become a Dealer</a>
            </div>
        </div>
    </div>

    @include('site.partials.contact-section')

    <script>
        (function () {
            var tabs = document.querySelectorAll('.shop-tabs button');
            var groups = document.querySelectorAll('.shop-group');
            function show(filter) {
                tabs.forEach(function (t) { t.classList.toggle('active', t.dataset.filter === filter); });
                groups.forEach(function (g) { g.hidden = filter !== 'all' && g.dataset.group !== filter; });
            }
            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    show(tab.dataset.filter);
                    history.replaceState(null, '', tab.dataset.filter === 'all' ? location.pathname : '#' + tab.dataset.filter);
                    document.querySelector('.shop-catalog').scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            });
            var hash = location.hash.slice(1);
            if (hash && document.querySelector('[data-group="' + hash + '"]')) show(hash);
        })();
    </script>
@endsection
