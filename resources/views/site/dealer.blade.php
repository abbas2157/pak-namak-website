@extends('layouts.site')

@section('title', 'Become a Dealer')

@push('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}" fetchpriority="high">
@endpush

@section('content')
    @php($types = \App\Models\DealerApplication::BUSINESS_TYPES)
    @php($interests = \App\Models\DealerApplication::INTERESTS)
    @php($volumes = \App\Models\DealerApplication::VOLUMES)

    {{-- Section 0: hero --}}
    <div class="et_pb_section hero-shop">
        <div class="et_pb_row row-800">
            <div class="col col-4_4">
                <div class="mod mb-10 t-center"><h1 class="h72 c-white">Become a Pak Namak Dealer</h1></div>
                <div class="mod lh16 c-white t-center"><p>We are growing our distribution network across South Punjab. Partner with us to supply quality salt and masala in your city.</p></div>
                <div class="mod lh16 c-white t-center"><p lang="ur">ہم جنوبی پنجاب میں اپنا ڈسٹری بیوشن نیٹ ورک بڑھا رہے ہیں۔ اپنے شہر میں پاک نمک کے ڈیلر بنیں۔</p></div>
            </div>
        </div>
    </div>

    {{-- Section 1: benefits --}}
    <div class="et_pb_section bg-grey">
        <div class="et_pb_row">
            @foreach([
                ['icon-1.png', 'Consistent Quality', 'Every batch is cleaned, dried, ground and checked before packing, so your customers get the same product every time.'],
                ['icon-2.png', 'Dealer Rates', 'Wholesale pricing based on your monthly volume, with packing in 50kg, 10kg and 5kg bags and 250g–700g cartons.'],
                ['icon-3.png', 'Reliable Supply', 'Direct delivery across Melsi, Vehari, Multan, Burewala and Khanewal, and goods transport to other cities.'],
            ] as [$icon, $title, $text])
                <div class="col col-1_3 border-2 pad-20">
                    <div class="mod et_pb_image icon-64 mb-20"><img src="{{ asset('images/'.$icon) }}" width="64" height="64" alt=""></div>
                    <div class="mod mb-0"><h3 class="h20">{{ $title }}</h3></div>
                    <div class="mod lh16"><p>{{ $text }}</p></div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Section 2: form --}}
    <div class="et_pb_section">
        <div class="et_pb_row row-wide equal gutters1">
            <div class="col col-1_2 bg-green-dark pad-40">
                <div class="mod mb-10"><h2 class="h52 c-white">Who can apply?</h2></div>
                <div class="mod txt16 c-white">
                    <p>Wholesalers, distributors, retail shops, restaurants and hotels who buy salt or masala regularly.</p>
                    <p lang="ur" class="t-right">تھوک فروش، ڈسٹری بیوٹرز، دکاندار اور ریسٹورنٹس جو باقاعدگی سے نمک یا مصالحہ جات خریدتے ہیں۔</p>
                </div>
                <div class="mod mb-10" style="margin-top:30px"><h2 class="h24 c-white">What happens next?</h2></div>
                <div class="mod txt16 c-white">
                    <p>1. Send the form with your city and expected monthly volume.<br>
                       2. Our team calls you within 2 working days to discuss rates and delivery.<br>
                       3. You are welcome to visit our facility on Melsi–Multan Road before your first order.</p>
                </div>
            </div>
            <div class="col col-1_2 bg-grey pad-40">
                <div class="mod">
                    <form class="wpcf7-form" method="POST" action="{{ route('dealer.submit') }}">
                        @csrf
                        @if(session('success'))
                            <div class="form-msg ok">{{ session('success') }}</div>
                        @endif
                        <p>
                            <label for="name">Your Name / آپ کا نام</label>
                            <input class="form-control" id="name" name="name" value="{{ old('name') }}" required maxlength="120" placeholder="Enter your name">
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p>
                            <label for="phone">Phone / WhatsApp / فون نمبر</label>
                            <input class="form-control" id="phone" name="phone" type="tel" value="{{ old('phone') }}" required maxlength="30" placeholder="03XXXXXXXXX">
                            @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p>
                            <label for="business_name">Shop / Business Name / دکان کا نام</label>
                            <input class="form-control" id="business_name" name="business_name" value="{{ old('business_name') }}" required maxlength="150">
                            @error('business_name')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p>
                            <label for="business_type">Business Type / کاروبار کی قسم</label>
                            <select class="form-control" id="business_type" name="business_type" required>
                                @foreach($types as $value => $label)
                                    <option value="{{ $value }}" @selected(old('business_type') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            <label for="city">City / Area / شہر</label>
                            <input class="form-control" id="city" name="city" value="{{ old('city') }}" required maxlength="120" placeholder="e.g. Vehari">
                            @error('city')<span class="form-error">{{ $message }}</span>@enderror
                        </p>
                        <p>
                            <label for="interest">Interested In / دلچسپی</label>
                            <select class="form-control" id="interest" name="interest">
                                @foreach($interests as $value => $label)
                                    <option value="{{ $value }}" @selected(old('interest', 'both') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            <label for="monthly_volume">Expected Monthly Volume / ماہانہ مقدار</label>
                            <select class="form-control" id="monthly_volume" name="monthly_volume">
                                <option value="">— Select —</option>
                                @foreach($volumes as $value => $label)
                                    <option value="{{ $value }}" @selected(old('monthly_volume') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            <label for="message">Anything else? / مزید معلومات</label>
                            <textarea class="form-control" id="message" name="message" maxlength="2000" placeholder="Current suppliers, delivery needs, questions...">{{ old('message') }}</textarea>
                        </p>
                        <p><input class="btn" type="submit" value="Apply Now"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('site.partials.contact-section')
@endsection
