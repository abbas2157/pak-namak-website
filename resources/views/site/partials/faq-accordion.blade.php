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
