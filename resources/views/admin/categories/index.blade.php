@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="card">
        <div class="card-head">
            <h2>Product categories</h2>
            <a href="{{ route('admin.categories.create') }}" class="btn">+ Add category</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Name</th><th>Urdu subtitle</th><th>Products</th><th>Order</th><th></th></tr></thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td class="ur">{{ $category->name_ur }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->sort_order }}</td>
                        <td><div class="row-actions">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-light btn-sm">Edit</a>
                            @include('admin.partials.delete', ['action' => route('admin.categories.destroy', $category), 'confirm' => 'Delete this category? Its products will become uncategorised.'])
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No categories yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <p class="muted" style="margin:14px 0 0">Categories with no visible products are hidden on the Products page.</p>
    </div>
@endsection
