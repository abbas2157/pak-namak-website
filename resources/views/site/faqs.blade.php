@extends('layouts.site')

@section('title', 'FAQs')
@section('description', 'Answers to common questions about Pak Namak salt and masala: product types, carton sizes, Dalla Namak, wholesale rates, ordering, delivery and dealership.')

@push('preload')
    <link rel="preload" as="image" href="{{ asset('images/hero-bg.jpg') }}" fetchpriority="high">
@endpush

@push('schema')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqs->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq->question,
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq->answer],
        ])->values(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    {{-- Section 0: hero --}}
    <div class="et_pb_section hero-shop">
        <div class="et_pb_row row-800">
            <div class="col col-4_4">
                <div class="mod mb-10 t-center"><h1 class="h72 c-white">Frequently Asked Questions</h1></div>
                <div class="mod lh16 c-white t-center"><p>Everything you need to know about our salt, masala, ordering and delivery.</p></div>
                <div class="mod lh16 c-white t-center"><p lang="ur">اکثر پوچھے جانے والے سوالات</p></div>
            </div>
        </div>
    </div>

    {{-- Section 1: accordion --}}
    <div class="et_pb_section">
        <div class="et_pb_row">
            <div class="col col-4_4">
                <div class="mod mb-10"><h2 class="h52 t-left">Frequently Asked Questions (FAQs)</h2></div>
                <div class="mod mb-10"><h2 lang="ur" class="h52 t-right">اکثر پوچھے جانے والے سوالات</h2></div>
                @if($faqs->isNotEmpty())
                    @include('site.partials.faq-accordion')
                @else
                    <div class="mod lh16"><p>No questions published yet.</p></div>
                @endif
            </div>
        </div>
        <div class="et_pb_row">
            <div class="col col-4_4">
                <div class="mod txt16 t-center"><p>Still have a question? Call or WhatsApp us, or send a message.</p></div>
                <div class="mod btn-wrap t-center"><a class="et_pb_button btn-green" href="{{ route('contact') }}">Contact Us</a></div>
            </div>
        </div>
    </div>

    @include('site.partials.contact-section')
@endsection
