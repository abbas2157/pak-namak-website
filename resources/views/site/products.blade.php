@extends('layouts.site')

@section('title', 'Products')
@section('description', 'Pak Namak salt in 50 kg, 10 kg and 5 kg bags, household packets, and pure Masala Jaat in packets from 50g to 10kg. Wholesale and retail rates on WhatsApp.')

@push('preload')
    <link rel="preload" as="image" href="{{ asset('images/packet-salt-800.jpg') }}" fetchpriority="high">
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
                    'availability' => 'https://schema.org/InStock', 'url' => route('products'),
                ] : null,
            ]),
        ]),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    @php
        $waBase = 'https://wa.me/'.($settings['whatsapp'] ?? '').'?text=';
        $orderText = fn (string $item) => "Assalam o Alaikum, I would like to order: {$item}. Please share today's rate.";
        $waLink = fn (string $item) => $waBase.rawurlencode($orderText($item));
        $ratesLink = $waBase.rawurlencode("Assalam o Alaikum, please share today's rates for Pak Namak products.");
        $phone = $settings['phone'] ?? '';
        $tel = 'tel:'.preg_replace('/[^\d+]/', '', $phone);
        $productCount = $categories->sum(fn ($c) => $c->products->count());
        $price = fn ($product) => $product->price ? 'Rs '.number_format($product->price) : null;
        // Tiles for products still waiting on a photo.
        $swatches = ['#6d4a2f', '#56652a', '#4a5724', '#7a3b22', '#5b3a24'];
        $waIcon = 'M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5.3-.5c.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3zM12 21.8a9.8 9.8 0 0 1-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4A9.8 9.8 0 1 1 12 21.8zM20.5 3.5A11.8 11.8 0 0 0 1.9 17.7L.2 24l6.4-1.7A11.8 11.8 0 0 0 24 12c0-3.2-1.2-6.2-3.5-8.5z';
    @endphp

    <div class="pp">
        {{-- Hero --}}
        <section class="pp-hero">
            <div class="container pp-hero-grid">
                <div class="pp-hero-text">
                    <nav class="pp-crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a> <span aria-hidden="true">/</span> Products</nav>
                    <h1>Salt &amp; masala, <br>packed for every need</h1>
                    <p class="pp-lead">Pure, properly ground salt and everyday masala — in sizes for homes, shops and wholesale buyers.</p>
                    <p class="pp-lead-ur" lang="ur" dir="rtl">ریٹیل اور تھوک دونوں ضروریات کے لیے مختلف وزن میں اعلیٰ معیار</p>
                    <div class="pp-hero-actions">
                        <a class="pp-btn pp-btn-wa pp-btn-lg" href="{{ $ratesLink }}" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="{{ $waIcon }}"/></svg>Order on WhatsApp
                        </a>
                        <a class="pp-btn pp-btn-outline-light pp-btn-lg" href="{{ route('dealer') }}">Become a Dealer</a>
                    </div>
                </div>
                <div class="pp-hero-media">
                    <img src="{{ asset('images/packet-salt-800.jpg') }}" width="800" height="800" alt="Pak Namak packet salt" fetchpriority="high">
                    <dl class="pp-hero-stats">
                        <div><dt>Products</dt><dd>{{ $productCount }}</dd></div>
                        <div><dt>Pack sizes</dt><dd>50g–50kg</dd></div>
                    </dl>
                </div>
            </div>
        </section>

        {{-- Filter bar --}}
        <div class="pp-bar">
            <div class="container pp-bar-inner">
                <div class="pp-tabs" role="group" aria-label="Product categories">
                    <button type="button" class="is-active" data-filter="all" aria-pressed="true">All <span>{{ $productCount }}</span></button>
                    @foreach($categories as $category)
                        <button type="button" data-filter="{{ $category->slug }}" aria-pressed="false">{{ $category->name }} <span>{{ $category->products->count() }}</span></button>
                    @endforeach
                </div>
                <label class="pp-search">
                    <span class="sr-only">Search products</span>
                    <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                    <input type="search" id="pp-search" placeholder="Search products…" autocomplete="off">
                </label>
            </div>
        </div>

        <div class="container pp-main">
            @foreach($categories as $category)
                @php
                    $hasSizes = $category->products->contains(fn ($p) => ! empty($p->pack_sizes));
                    $count = $category->products->count();
                @endphp
                <section class="pp-group" id="{{ $category->slug }}" data-group="{{ $category->slug }}" aria-labelledby="{{ $category->slug }}-title">
                    <header class="pp-group-head">
                        <div>
                            <h2 id="{{ $category->slug }}-title">{{ $category->name }}</h2>
                            <p>{{ $count }} {{ Str::plural('product', $count) }}@if($hasSizes) · packets from 50g to 10kg @endif</p>
                        </div>
                        @if($category->name_ur)<p class="pp-group-ur" lang="ur" dir="rtl">{{ $category->name_ur }}</p>@endif
                    </header>

                    @if($category->layout === 'table')
                        {{-- One item in many sizes: one photo, one row per size --}}
                        @php
                            $cover = $category->products->first(fn ($p) => $p->image) ?? $category->products->first();
                        @endphp
                        <div class="pp-sizes">
                            <div class="pp-sizes-media">
                                <img src="{{ $cover->image_url }}" alt="{{ $category->name }}" loading="lazy">
                            </div>
                            <div class="pp-sizes-body">
                                <p class="pp-sizes-hint">Pick a packet size — sold by the carton</p>
                                <table class="pp-table">
                                    <thead><tr><th scope="col">Packet size</th><th scope="col">Per carton</th><th scope="col">Rate</th><th scope="col"><span class="sr-only">Order</span></th></tr></thead>
                                    <tbody>
                                    @foreach($category->products as $product)
                                        @php
                                            // "700G ( گرام ) (10 Packets)" -> size "700g", packs "10"
                                            preg_match('/^(.*?)\s*\((\d+)\s*packets?\)\s*$/iu', $product->name, $m);
                                            $size = trim(preg_replace('/\s*\(\s*[^\x00-\x7F]+\s*\)/u', '', $m[1] ?? $product->name));
                                            $size = preg_match('/^\d+\s*(g|kg)$/i', $size) ? strtolower(str_replace(' ', '', $size)) : $size;
                                        @endphp
                                        <tr class="pp-item" data-search="{{ mb_strtolower($product->name.' '.$product->name_ur.' '.$category->name) }}">
                                            <td class="pp-size">{{ $size }}</td>
                                            <td class="pp-packs">@if(isset($m[2])){{ $m[2] }} packets<span class="pp-hide-lg"> / carton</span>@endif</td>
                                            <td class="pp-rate">{{ $price($product) ?? 'On request' }}</td>
                                            <td class="pp-row-order">
                                                <a class="pp-btn pp-btn-wa pp-btn-sm" href="{{ $waLink($category->name.' '.$size.(isset($m[2]) ? " ({$m[2]} packets)" : '')) }}" target="_blank" rel="noopener">
                                                    <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path d="{{ $waIcon }}"/></svg>Order<span class="sr-only"> {{ $size }}</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div @class(['pp-grid', 'pp-grid-wide' => ! $hasSizes])>
                            @foreach($category->products as $product)
                                @php
                                    $sizes = $product->pack_sizes ?: [];
                                    $default = in_array('100g', $sizes) ? '100g' : ($sizes[0] ?? null);
                                    $item = $product->name.($default ? " ({$default})" : '');
                                @endphp
                                <article class="pp-card pp-item" data-search="{{ mb_strtolower($product->name.' '.$product->name_ur.' '.$category->name) }}">
                                    <div @class(['pp-card-media', 'pp-card-media-square' => $sizes])>
                                        @if($product->image)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                                        @else
                                            <div class="pp-swatch" style="background: {{ $swatches[$loop->index % count($swatches)] }}">
                                                <span lang="ur" dir="rtl">{{ $product->name_ur ?: $product->name }}</span>
                                                <small>Photo coming soon</small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="pp-card-body">
                                        <div class="pp-card-title">
                                            <h3>{{ $product->name }}</h3>
                                            @if($product->name_ur && $product->image)<span lang="ur" dir="rtl">{{ $product->name_ur }}</span>@endif
                                        </div>
                                        @if($product->description)<p class="pp-card-desc" lang="ur" dir="rtl">{{ $product->description }}</p>@endif

                                        @if($sizes)
                                            <div class="pp-chips" role="group" aria-label="Pack size for {{ $product->name }}">
                                                @foreach($sizes as $s)
                                                    <button type="button" data-size="{{ $s }}" aria-pressed="{{ $s === $default ? 'true' : 'false' }}" @class(['is-active' => $s === $default])>{{ $s }}</button>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="pp-card-foot">
                                            <span class="pp-rate">{{ $price($product) ?? 'Rate on request' }}</span>
                                            <div class="pp-card-actions">
                                                @unless($sizes)
                                                    <a class="pp-btn pp-btn-ghost pp-btn-sm" href="{{ route('contact', ['product' => $product->name]) }}">Enquire</a>
                                                @endunless
                                                <a class="pp-btn pp-btn-wa pp-btn-sm" href="{{ $waLink($item) }}" target="_blank" rel="noopener"
                                                   data-order="{{ $product->name }}">
                                                    <svg viewBox="0 0 24 24" width="14" height="14" aria-hidden="true"><path d="{{ $waIcon }}"/></svg>Order<span data-order-size>{{ $default ? ' '.$default : '' }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>
            @endforeach

            <div class="pp-empty" hidden>
                <h2>No products match your search</h2>
                <p>Try another word, or ask us on WhatsApp — we'll tell you what's available.</p>
                <button type="button" class="pp-btn pp-btn-primary" data-clear-search>Show all products</button>
            </div>

            {{-- How to order --}}
            <section class="pp-steps" aria-labelledby="pp-steps-title">
                <h2 id="pp-steps-title">How to order</h2>
                <ol>
                    <li><span>1</span><div><h3>Pick your products</h3><p>Choose sizes and quantities from the list above.</p></div></li>
                    <li><span>2</span><div><h3>Message or call us</h3><p>Tap Order — WhatsApp opens with the product and size already filled in.</p></div></li>
                    <li><span>3</span><div><h3>Confirm rate &amp; delivery</h3><p>We share today's rate and arrange delivery or pickup.</p></div></li>
                </ol>
            </section>

            {{-- Dealer CTA --}}
            <section class="pp-cta">
                <div>
                    <h2>Buying in bulk or running a shop?</h2>
                    <p>Become a Pak Namak dealer and get wholesale rates for your area.</p>
                </div>
                <div class="pp-cta-actions">
                    @if($phone)<a class="pp-btn pp-btn-light" href="{{ $tel }}">Call {{ $phone }}</a>@endif
                    <a class="pp-btn pp-btn-outline-light" href="{{ route('dealer') }}">Become a Dealer</a>
                </div>
            </section>
        </div>

        {{-- Phone: quick actions always in reach --}}
        <div class="pp-actionbar">
            @if($phone)
                <a class="pp-btn pp-btn-ghost" href="{{ $tel }}">
                    <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2z"/></svg>Call
                </a>
            @endif
            <a class="pp-btn pp-btn-wa" href="{{ $ratesLink }}" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" width="17" height="17" aria-hidden="true"><path d="{{ $waIcon }}"/></svg>Get today's rates
            </a>
        </div>
    </div>

    <script>
        (function () {
            var waBase = @json($waBase);
            var text = function (item) { return "Assalam o Alaikum, I would like to order: " + item + ". Please share today's rate."; };

            // Pack size chips: keep the Order link's WhatsApp message in step with the picked size.
            document.querySelectorAll('.pp-chips').forEach(function (group) {
                group.addEventListener('click', function (e) {
                    var chip = e.target.closest('button[data-size]');
                    if (!chip) return;
                    group.querySelectorAll('button').forEach(function (b) {
                        var on = b === chip;
                        b.classList.toggle('is-active', on);
                        b.setAttribute('aria-pressed', on ? 'true' : 'false');
                    });
                    var order = group.closest('.pp-card').querySelector('[data-order]');
                    order.href = waBase + encodeURIComponent(text(order.dataset.order + ' (' + chip.dataset.size + ')'));
                    order.querySelector('[data-order-size]').textContent = ' ' + chip.dataset.size;
                });
            });

            // Category tabs + search
            var tabs = document.querySelectorAll('.pp-tabs button');
            var groups = document.querySelectorAll('.pp-group');
            var search = document.getElementById('pp-search');
            var empty = document.querySelector('.pp-empty');
            var filter = 'all';

            function apply() {
                var term = search.value.trim().toLowerCase(), shown = 0;
                groups.forEach(function (group) {
                    var visible = 0;
                    group.querySelectorAll('.pp-item').forEach(function (item) {
                        var match = !term || item.dataset.search.indexOf(term) !== -1;
                        item.hidden = !match;
                        if (match) visible++;
                    });
                    group.hidden = (filter !== 'all' && group.dataset.group !== filter) || visible === 0;
                    if (!group.hidden) shown++;
                });
                empty.hidden = shown > 0;
            }

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    filter = tab.dataset.filter;
                    tabs.forEach(function (t) {
                        t.classList.toggle('is-active', t === tab);
                        t.setAttribute('aria-pressed', t === tab ? 'true' : 'false');
                    });
                    apply();
                    var bar = document.querySelector('.pp-bar');
                    if (bar.getBoundingClientRect().top < 0 || window.scrollY > bar.offsetTop) {
                        window.scrollTo({ top: bar.offsetTop - 10, behavior: 'smooth' });
                    }
                });
            });
            search.addEventListener('input', apply);
            document.querySelector('[data-clear-search]').addEventListener('click', function () {
                search.value = '';
                tabs[0].click();
            });
        })();
    </script>
@endsection
