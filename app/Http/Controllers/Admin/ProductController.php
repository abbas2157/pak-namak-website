<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('sort_order')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product(['is_active' => true]), 'categories' => Category::orderBy('sort_order')->get()]);
    }

    public function store(Request $request)
    {
        Product::create($this->validated($request));

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', ['product' => $product, 'categories' => Category::orderBy('sort_order')->get()]);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($this->validated($request, $product));

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:120',
            'name_ur' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:2000',
            'price' => 'nullable|numeric|min:0',
            'pack_sizes' => 'nullable|array',
            'pack_sizes.*' => ['string', Rule::in(Product::PACK_SIZES)],
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:4096',
        ]);

        // Keep sizes in shelf order (50g → 10kg) whatever order the boxes were ticked in.
        $data['pack_sizes'] = array_values(array_intersect(Product::PACK_SIZES, $data['pack_sizes'] ?? [])) ?: null;
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if (! $product || $product->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $product?->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteImage($product?->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        return $data;
    }

    private function uniqueSlug(string $name, ?int $ignoreId): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        for ($i = 2; Product::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists(); $i++) {
            $slug = "$base-$i";
        }

        return $slug;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
