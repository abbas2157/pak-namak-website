@extends('layouts.site')

@section('title', 'Contact Us')
@section('description', 'Contact Pak Namak for salt and masala orders or bulk inquiries. Call or WhatsApp +92 307 8479818, email info@paknamak.pk, or visit us on Melsi–Multan Road.')

@section('content')
    @php
        $socials = [
            'facebook' => $settings['facebook'] ?? null,
            'youtube' => $settings['youtube'] ?? null,
            'tiktok' => $settings['tiktok'] ?? null,
            'whatsapp' => $settings['whatsapp_link'] ?? null,
        ];
        $productOptions = ['50 KG Salt', '10 KG Salt', '5 KG Salt', 'Thaila Salt', 'Packet Salt', 'Dalla Namak'];
        $selected = old('product', request('product'));
    @endphp

    {{-- Section 0: intro + form --}}
    <div class="et_pb_section">
        <div class="et_pb_row row-wide bg-white">
            <div class="col col-1_2">
                <div class="mod mb-10" style="color:#d9d9d9"><h4 lang="ur" class="h14up c-orange t-right">رابطہ کیجیے</h4></div>
                <div class="mod mb-10"><h2 lang="ur" class="h72 c-green t-right">ہم سے رابطہ کریں</h2></div>
                <div class="mod txt16" style="margin-top:7px"><p lang="ur" class="t-right">معیاری نمک اور مصالحہ جات کے آرڈرز یا تھوک معلومات کے لیے آج ہی ہم سے رابطہ کریں۔<br>ہماری ٹیم آپ کو بروقت اور بہترین سروس فراہم کرنے کے لیے تیار ہے۔</p></div>
                <div class="mod mb-10"><h1 class="h72 c-green t-left">Contact Us</h1></div>
                <div class="mod txt16" style="margin-top:7px"><p>Contact us today for quality salt and masala orders or bulk inquiries.<br>Our team is ready to assist you with reliable service and quick response.</p></div>
                @include('site.partials.social', ['links' => $socials])
            </div>
            <div class="col col-1_2 bg-grey pad-40">
                <div class="mod">
                    <form class="wpcf7-form" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        @if(session('success'))
                            <div class="form-msg ok">{{ session('success') }}</div>
                        @endif
                        <p>
                            <label for="name">Your Name / آپ کا نام</label>
                            <input class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required maxlength="120">
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p>
                            <label for="phone">Phone Number / فون نمبر</label>
                            <input class="form-control" id="phone" name="phone" type="tel" placeholder="03XXXXXXXXX" value="{{ old('phone') }}" required maxlength="30">
                            @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p>
                            <label for="product">Product / پروڈکٹ</label>
                            <select class="form-control" id="product" name="product">
                                @foreach($productOptions as $option)
                                    <option value="{{ $option }}" @selected($selected === $option)>{{ $option }}</option>
                                @endforeach
                                @foreach($products->diff($productOptions) as $name)
                                    <option value="{{ $name }}" @selected($selected === $name)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            <label for="message">Your Message / پیغام</label>
                            <textarea class="form-control" id="message" name="message" placeholder="Write your message" maxlength="2000">{{ old('message') }}</textarea>
                            @error('message')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p><input class="btn" type="submit" value="Send Message"></p>
                    </form>
                </div>
            </div>
        </div>

        <div class="et_pb_row equal gutters1">
            <div class="col col-1_2 bg-green-dark pad-30">
                <div class="mod contact-icon mb-20"><svg viewBox="0 0 512 512"><path d="M497.4 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6.6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0-14-27.6z"/></svg></div>
                <div class="mod mb-0"><h4 class="h24 c-white">Phone</h4></div>
                <div class="mod lh16 mb-20 c-white"><p><a href="tel:{{ preg_replace('/[^\d+]/', '', $settings['phone'] ?? '') }}">{{ $settings['phone'] ?? '' }}</a></p></div>
            </div>
            <div class="col col-1_2 bg-orange pad-30">
                <div class="mod contact-icon mb-20"><svg viewBox="0 0 512 512"><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/></svg></div>
                <div class="mod mb-0"><h4 class="h24 c-white">Email</h4></div>
                <div class="mod lh16 mb-20 c-white"><p><a href="mailto:{{ $settings['email'] ?? '' }}">{{ $settings['email'] ?? '' }}</a></p></div>
            </div>
        </div>
    </div>

    {{-- Section 1: map --}}
    @if(!empty($settings['map_embed_url']))
        <div class="et_pb_section">
            <div class="et_pb_row">
                <div class="col col-4_4">
                    <div class="mod mb-10"><h2 class="h52 t-left">Visit Us</h2></div>
                    <div class="mod mb-10"><h2 lang="ur" class="t-right">{{ $settings['address'] ?? '' }}</h2></div>
                    <div class="mod map-embed">
                        <iframe src="{{ $settings['map_embed_url'] }}" title="Pak Namak location on Google Maps" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    </div>
                    @if(!empty($settings['map_url']))
                        <div class="mod btn-wrap" style="margin-top:20px"><a class="et_pb_button btn-green" href="{{ $settings['map_url'] }}" target="_blank" rel="noopener">Get Directions</a></div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @include('site.partials.contact-section')
@endsection
