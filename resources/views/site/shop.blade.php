@extends('layouts.site')

@section('title', 'Shop')

@section('content')
    {{-- Section 0: hero --}}
    <div class="et_pb_section hero-shop">
        <div class="et_pb_row row-800">
            <div class="col col-4_4">
                <div class="mod mb-10 t-center"><h1 class="h72 c-white">Welcome to Pak Namak &amp; Masala Jaat</h1></div>
                <div class="mod lh16 c-white t-center"><p>We provide high-quality salt in multiple weight options to meet both retail and wholesale needs.</p></div>
                <div class="mod lh16 c-white t-center"><p>ہم ریٹیل اور تھوک دونوں ضروریات کے لیے مختلف وزن میں اعلیٰ معیار کا نمک فراہم کرتے ہیں۔</p></div>
            </div>
        </div>
    </div>

    {{-- Section 1: products --}}
    <div class="et_pb_section">
        <div class="et_pb_row">
            <div class="col col-4_4">
                <div class="mod mb-10"><h2 class="h52 t-left">Our available salt products include:</h2></div>
                <div class="mod mb-10"><h2 class="h52 t-right">:ہماری دستیاب مصنوعات درج ذیل ہیں</h2></div>
                <div class="mod lh16"><p class="t-left">We ensure purity, proper grinding, and secure packaging in every product.<br>For pricing and bulk orders, please contact us directly.</p></div>
                <div class="mod lh16"><p class="t-right">ہم ہر پروڈکٹ میں خالص پن، معیاری پسائی اور محفوظ پیکنگ کو یقینی بناتے ہیں۔<br>قیمت اور تھوک آرڈر کے لیے براہِ کرم ہم سے رابطہ کریں۔</p></div>
            </div>
        </div>

        @foreach($categories as $category)
            <div class="et_pb_row">
                <div class="col col-4_4">
                    <div class="mod mb-10"><h2 class="h52 t-left">{{ $category->name }}</h2></div>
                    @if($category->name_ur)<div class="mod mb-10"><h2 class="t-right">{{ $category->name_ur }}</h2></div>@endif
                </div>
            </div>
            @foreach($category->products->chunk(3) as $chunk)
                <div @class(['et_pb_row', 'row-pt0' => $loop->parent->first && $loop->first])>
                    @foreach($chunk as $product)
                        <div class="col col-1_3">
                            <div class="mod et_pb_image thumb-225 t-center"><img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy"></div>
                            <div class="mod mb-0"><h4 class="h24">{{ $product->name }}@if($product->name_ur) ({{ $product->name_ur }})@endif</h4></div>
                            <div class="mod lh16">
                                @if($product->description)<p class="t-right">{{ $product->description }}</p>@endif
                                @if($product->price)
                                    <p class="t-right">Rs {{ number_format($product->price) }}</p>
                                @else
                                    <p class="t-right">قیمت اور تھوک آرڈر کے لیے براہِ کرم ہم سے رابطہ کریں۔</p>
                                @endif
                            </div>
                            @include('site.partials.social', ['links' => ['whatsapp' => $settings['whatsapp_link'] ?? null]])
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endforeach
    </div>

    {{-- Section 2: FAQs --}}
    @if($faqs->isNotEmpty())
        <div class="et_pb_section">
            <div class="et_pb_row">
                <div class="col col-4_4">
                    <div class="mod mb-10"><h2 class="h52 t-left">Frequently Asked Questions (FAQs)</h2></div>
                    <div class="mod mb-10"><h2 class="h52 t-right">اکثر پوچھے جانے والے سوالات</h2></div>
                    <div class="mod accordion">
                        @foreach($faqs as $faq)
                            <div @class(['toggle', 'open' => $loop->first])>
                                <h5 class="toggle-title">{{ $faq->question }}@if($faq->question_ur) {{ $faq->question_ur }}@endif</h5>
                                <div class="toggle-content">
                                    <p>{{ $faq->answer }}</p>
                                    @if($faq->answer_ur)<p>{{ $faq->answer_ur }}</p>@endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('site.partials.contact-section')
@endsection
