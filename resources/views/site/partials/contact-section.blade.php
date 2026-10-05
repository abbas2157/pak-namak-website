{{-- Green company/contact section that closes every page on the live site --}}
@php
    $phone = $settings['phone'] ?? '';
    $phoneParts = preg_match('/^(\+\d{2})\s*(.*)$/', $phone, $m) ? [$m[1], $m[2]] : ['', $phone];
@endphp
<div class="et_pb_section bg-green">
    <div class="et_pb_row">
        <div class="col col-1_2">
            <div class="mod mb-0"><h4 class="h24 c-white">{{ $settings['site_name'] ?? 'Pak Namak & Masala Jaat (PVT) Limited' }}</h4></div>
            <div class="mod txt16 c-white"><p class="t-right">پاک نمک اینڈ مصالحہ جات معیاری نمک کی خریداری اور صفائی سے پسائی کے ذریعے خالص اور بہترین مصنوعات فراہم کرتا ہے</p></div>
            @include('site.partials.social', ['links' => $socialOrder ?? [
                'facebook' => $settings['facebook'] ?? null,
                'tiktok' => $settings['tiktok'] ?? null,
                'youtube' => $settings['youtube'] ?? null,
                'whatsapp' => $settings['whatsapp_link'] ?? null,
            ]])
        </div>
        <div class="col col-1_2">
            <div class="mod mb-0"><h5 class="h20 c-white">Contact</h5></div>
            @if($phone)
                <div class="mod lh16 mb-10 c-white"><p>{{ $phoneParts[0] }} <a href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}">{{ $phoneParts[1] }}</a></p></div>
            @endif
            @if(!empty($settings['email']))
                <div class="mod lh16 mb-10 c-white"><p>{{ $settings['email'] }}</p></div>
            @endif
            @if(!empty($settings['address']))
                <div class="mod lh16 mb-10 c-white"><p><a href="{{ $settings['map_url'] ?? '#' }}" target="_blank" rel="noopener">{{ $settings['address'] }}</a></p></div>
            @endif
        </div>
    </div>
</div>
