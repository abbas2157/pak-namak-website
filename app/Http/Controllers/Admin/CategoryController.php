<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form', ['category' => new Category]);
    }

    public function store(Request $request)
    {
        Category::create($this->validated($request));

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($this->validated($request, $category));

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted. Its products are now uncategorised.');
    }

    private function validated(Request $request, ?Category $category = null): array
    {
        $request->merge(['slug' => Str::slug($request->input('name', ''))]);

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($category)],
            'name_ur' => 'nullable|string|max:200',
            'sort_order' => 'nullable|integer|min:0',
        ], ['slug.unique' => 'A category with this name already exists.']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
