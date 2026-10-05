@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" class="card">
        @csrf @method('PUT')
        <div class="form-grid">
            @foreach($fields as $key => [$label, $rules])
                @php($isUrdu = str_ends_with($key, '_ur') || $key === 'address')
                <div @class(['field', 'full' => in_array($key, ['hero_text_ur', 'address'])])>
                    <label for="{{ $key }}">{{ $label }}</label>
                    @if($key === 'hero_text_ur')
                        <textarea id="{{ $key }}" name="{{ $key }}" class="ur" dir="rtl" rows="5">{{ old($key, $values[$key] ?? '') }}</textarea>
                        <div class="hint">Shown on the Home page. Each line is a new line on the site.</div>
                    @else
                        <input type="{{ str_contains($rules, 'email') ? 'email' : (str_contains($rules, 'url') ? 'url' : 'text') }}"
                               id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $values[$key] ?? '') }}"
                               @if($isUrdu) class="ur" dir="rtl" @endif>
                    @endif
                    @error($key)<div class="error">{{ $message }}</div>@enderror
                </div>
            @endforeach
        </div>
        <div class="form-actions">
            <button class="btn">Save settings</button>
        </div>
    </form>
@endsection
