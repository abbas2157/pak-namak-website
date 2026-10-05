@extends('layouts.admin')

@section('title', $member->exists ? 'Edit team member' : 'Add team member')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" class="card">
        @csrf
        @if($member->exists) @method('PUT') @endif
        <div class="form-grid">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $member->title) }}" placeholder="Chief Executive Officer (CEO)" required>
                @error('title')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="bio">Bio (English)</label>
                <textarea id="bio" name="bio">{{ old('bio', $member->bio) }}</textarea>
            </div>
            <div class="field">
                <label for="bio_ur">Bio (Urdu)</label>
                <textarea id="bio_ur" name="bio_ur" class="ur" dir="rtl">{{ old('bio_ur', $member->bio_ur) }}</textarea>
            </div>
            @foreach(['facebook' => 'Facebook', 'tiktok' => 'TikTok', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'twitter' => 'X (Twitter)', 'youtube' => 'YouTube', 'whatsapp' => 'WhatsApp link'] as $key => $label)
                <div class="field">
                    <label for="{{ $key }}">{{ $label }} URL</label>
                    <input type="url" id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $member->$key) }}">
                    @error($key)<div class="error">{{ $message }}</div>@enderror
                </div>
            @endforeach
            <div class="field">
                <label for="sort_order">Display order</label>
                <input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}">
            </div>
            <div class="field full">
                <label for="photo">Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                @error('photo')<div class="error">{{ $message }}</div>@enderror
                @if($member->photo_url)<img src="{{ $member->photo_url }}" alt="" class="preview">@endif
            </div>
        </div>
        <div class="form-actions">
            <button class="btn">Save</button>
            <a href="{{ route('admin.team.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
@endsection
