@extends('layouts.admin')

@section('title', $category->exists ? 'Edit category' : 'Add category')

@section('content')
    <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="card">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <div class="form-grid">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
                @error('slug')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="sort_order">Display order</label>
                <input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
            </div>
            <div class="field full">
                <label for="name_ur">Urdu subtitle</label>
                <input type="text" id="name_ur" name="name_ur" class="ur" dir="rtl" value="{{ old('name_ur', $category->name_ur) }}">
            </div>
        </div>
        <div class="form-actions">
            <button class="btn">Save category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
@endsection
