@extends('layouts.admin')

@section('title', $product->exists ? 'Edit product' : 'Add product')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" class="card">
        @csrf
        @if($product->exists) @method('PUT') @endif
        <div class="form-grid">
            <div class="field">
                <label for="name">Name (English)</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="name_ur">Name (Urdu)</label>
                <input type="text" id="name_ur" name="name_ur" class="ur" dir="rtl" value="{{ old('name_ur', $product->name_ur) }}">
            </div>
            <div class="field">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">— None —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="price">Price (Rs)</label>
                <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $product->price) }}">
                <div class="hint">Leave empty to show “contact us for price”.</div>
                @error('price')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field full">
                <span class="label">Pack sizes</span>
                <div class="check-row">
                    @foreach(App\Models\Product::PACK_SIZES as $size)
                        <label class="check"><input type="checkbox" name="pack_sizes[]" value="{{ $size }}" @checked(in_array($size, old('pack_sizes', $product->pack_sizes ?? [])))> {{ $size }}</label>
                    @endforeach
                </div>
                <div class="hint">Customers pick one of these on the Products page before ordering. Leave all unticked if the product has a single size.</div>
                @error('pack_sizes.*')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field full">
                <label for="description">Description (Urdu or English)</label>
                <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="field">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                @error('image')<div class="error">{{ $message }}</div>@enderror
                @if($product->image)<img src="{{ $product->image_url }}" alt="" class="preview">@endif
            </div>
            <div class="field">
                <label for="sort_order">Display order</label>
                <input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                <label class="check" style="margin-top:16px"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active))> Visible on website</label>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn">Save product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
@endsection
