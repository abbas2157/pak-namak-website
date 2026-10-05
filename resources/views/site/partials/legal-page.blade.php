{{-- Shared shell for Privacy Policy / Terms: $heading, $updated, then the page's legal_body section --}}
<div class="et_pb_section">
    <div class="et_pb_row">
        <div class="col col-4_4">
            <div class="mod mb-10" style="color:#d9d9d9"><h4 class="h14up c-orange">Last updated: {{ $updated }}</h4></div>
            <div class="mod"><h1 class="h52 c-green">{{ $heading }}</h1></div>
            <div class="mod legal txt16">
                @yield('legal_body')
            </div>
        </div>
    </div>
</div>
