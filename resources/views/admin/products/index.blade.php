@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="card">
        <div class="card-head">
            <h2>{{ $products->count() }} products</h2>
            <a href="{{ route('admin.products.create') }}" class="btn">+ Add product</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Order</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><img src="{{ $product->image_url }}" alt="" class="thumb"></td>
                        <td><strong>{{ $product->name }}</strong>@if($product->name_ur)<div class="ur muted">{{ $product->name_ur }}</div>@endif</td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>{{ $product->price ? 'Rs '.number_format($product->price) : 'On request' }}</td>
                        <td>{{ $product->sort_order }}</td>
                        <td>@if($product->is_active)<span class="pill pill-green">Visible</span>@else<span class="pill">Hidden</span>@endif</td>
                        <td><div class="row-actions">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-light btn-sm">Edit</a>
                            @include('admin.partials.delete', ['action' => route('admin.products.destroy', $product), 'confirm' => 'Delete this product?'])
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty">No products yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
