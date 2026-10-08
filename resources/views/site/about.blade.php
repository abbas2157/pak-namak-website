@extends('layouts.site')

@section('title', 'About Us')
@section('description', 'A family-owned salt and masala business run by three brothers since 2024. Meet the leadership team behind Pak Namak & Masala Jaat.')

@section('content')
    {{-- Section 0: intro --}}
    <div class="et_pb_section">
        <div class="et_pb_row">
            <div class="col col-4_4">
                <div class="mod mb-10 t-center" style="color:#d9d9d9"><h4 class="h14up c-orange">About US</h4></div>
                <div class="mod t-center"><h1 class="h72 c-green">Family Owned &amp; Operated Since {{ $settings['founded_year'] ?? '2024' }}</h1></div>
            </div>
        </div>
        <div class="et_pb_row equal gutters1">
            <div class="col col-1_2 bg-grey pad-30">
                <div class="mod mb-0"><h4 class="h24">About Us</h4></div>
                <div class="mod lh16 c-black">
                    <p>Pak Namak &amp; Masala Jaat is a family-owned business operated by three dedicated brothers who collectively manage operations, strategy, and financial oversight. With a shared commitment to quality, integrity, and long-term growth, we have built a structured management system to ensure efficiency and consistency across all departments.</p>
                    <p>Our leadership model is clearly defined, with each director responsible for a specialized domain while working collaboratively to achieve sustainable expansion and customer satisfaction.</p>
                </div>
            </div>
            <div class="col col-1_2 bg-orange pad-30">
                <div class="mod mb-0"><h4 lang="ur" class="h24 c-white t-right">ہمارے بارے میں</h4></div>
                <div class="mod lh16 c-white">
                    <p lang="ur" class="t-right">پاک نمک اینڈ مصالحہ جات ایک خاندانی کاروبار ہے جسے تین بھائی مشترکہ طور پر منظم انداز میں چلا رہے ہیں۔ ہم معیار، دیانت داری اور طویل مدتی ترقی کے اصولوں پر کام کرتے ہوئے نمک اور مصالحہ جات کی تیاری، پیکنگ اور فراہمی کا مکمل نظام سنبھالتے ہیں۔ ہماری انتظامیہ واضح ذمہ داریوں اور باہمی تعاون کے ذریعے</p>
                    <p lang="ur" class="t-right">کاروبار کو مستحکم اور منظم انداز میں آگے بڑھا رہی ہے</p>
                    <p lang="ur" class="t-right">معیاری نمک اور مصالحہ جات کے آرڈرز یا تھوک معلومات کے لیے آج ہی ہم سے رابطہ کریں۔<br>ہماری ٹیم آپ کو بروقت اور بہترین سروس فراہم کرنے کے لیے تیار ہے۔</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 1: leadership team --}}
    @if($team->isNotEmpty())
        <div class="et_pb_section">
            <div class="et_pb_row">
                <div class="col col-4_4">
                    <div class="mod mb-10"><h2 class="h52 t-center">Our Leadership Team</h2></div>
                </div>
            </div>
            @foreach($team as $member)
                <div class="et_pb_row">
                    <div class="col col-3_5">
                        <div class="mod mb-10" style="color:#d9d9d9"><h4 class="h14up c-green">{{ $member->title }}</h4></div>
                        <div class="mod mb-10"><h2 class="h52">{{ $member->name }}</h2></div>
                        @if($member->bio)<div class="mod txt16"><p>{{ $member->bio }}</p></div>@endif
                        @if($member->bio_ur)<div class="mod txt16"><p lang="ur" class="t-right">{{ $member->bio_ur }}</p></div>@endif
                        @include('site.partials.social', ['class' => 'no-neg', 'links' => $member->only(['facebook', 'tiktok', 'whatsapp', 'linkedin', 'twitter', 'youtube', 'instagram'])])
                    </div>
                    <div class="col col-2_5">
                        @if($member->photo_url)<div class="mod et_pb_image"><img src="{{ $member->photo_url }}" width="480" height="480" loading="lazy" alt="{{ $member->name }}, {{ $member->title }}"></div>@endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
