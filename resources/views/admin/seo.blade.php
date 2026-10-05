@extends('layouts.admin')

@section('title', 'SEO')

@section('content')
    <form method="POST" action="{{ route('admin.seo.update') }}">
        @csrf @method('PUT')

        <div class="card">
            <div class="card-head"><h2>Google</h2></div>
            <div class="form-grid">
                <div class="field">
                    <label for="google_site_verification">Search Console verification code</label>
                    <input type="text" id="google_site_verification" name="google_site_verification" value="{{ old('google_site_verification', $values['google_site_verification'] ?? '') }}" placeholder="Paste the code or the whole <meta> tag">
                    <div class="hint">Search Console → Add property → HTML tag method.</div>
                    @error('google_site_verification')<div class="error">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label for="google_tag_id">Google Analytics / Google tag ID</label>
                    <input type="text" id="google_tag_id" name="google_tag_id" value="{{ old('google_tag_id', $values['google_tag_id'] ?? $defaultTagId) }}" placeholder="G-XXXXXXX">
                    <div class="hint">Leave empty to turn tracking off. The current site uses {{ $defaultTagId }}.</div>
                    @error('google_tag_id')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        @foreach($pages as $key => $page)
            <div class="card">
                <div class="card-head">
                    <h2>{{ $page['label'] }}</h2>
                    <a href="{{ route($key) }}" target="_blank" class="btn btn-light btn-sm">View page ↗</a>
                </div>
                <div class="form-grid">
                    <div class="field full">
                        <label for="seo_{{ $key }}_title">Page title <span class="muted" data-count-for="seo_{{ $key }}_title" data-max="60"></span></label>
                        <input type="text" id="seo_{{ $key }}_title" name="seo_{{ $key }}_title" value="{{ old("seo_{$key}_title", $values["seo_{$key}_title"] ?? '') }}" placeholder="{{ $page['title'] }}">
                        @error("seo_{$key}_title")<div class="error">{{ $message }}</div>@enderror
                    </div>
                    <div class="field full">
                        <label for="seo_{{ $key }}_description">Meta description <span class="muted" data-count-for="seo_{{ $key }}_description" data-max="160"></span></label>
                        <textarea id="seo_{{ $key }}_description" name="seo_{{ $key }}_description" rows="2" placeholder="{{ $page['description'] }}">{{ old("seo_{$key}_description", $values["seo_{$key}_description"] ?? '') }}</textarea>
                        @error("seo_{$key}_description")<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        @endforeach

        <p class="muted">Empty fields use the default shown in grey. Aim for titles under 60 characters and descriptions under 160 so Google shows them in full.</p>
        <div class="form-actions"><button class="btn">Save SEO settings</button></div>
    </form>

    <script>
        document.querySelectorAll('[data-count-for]').forEach(function (counter) {
            var input = document.getElementById(counter.dataset.countFor), max = +counter.dataset.max;
            function update() {
                var len = (input.value || input.placeholder).length;
                counter.textContent = '(' + len + ' / ' + max + (input.value ? '' : ', default') + ')';
                counter.style.color = len > max ? '#c62828' : '';
            }
            input.addEventListener('input', update);
            update();
        });
    </script>
@endsection
