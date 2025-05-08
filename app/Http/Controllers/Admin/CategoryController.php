<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('admin.categories.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);
        
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'level' => $request->parent_id ? Category::findOrFail($request->parent_id)->level + 1 : 0,
        ]);
        
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully');
    }
    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)
                             ->where('parent_id', null)
                             ->get();
                             
        return view('admin.categories.edit', compact('category', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($id) {
                    if ($value == $id) {
                        $fail('A category cannot be its own parent.');
                    }
                },
            ],
            'description' => 'nullable|string',
        ]);
        
        $level = 0;
        if ($request->parent_id) {
            $parentCategory = Category::findOrFail($request->parent_id);
            $level = $parentCategory->level + 1;
        }
        
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'level' => $level,
        ]);
        
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category updated successfully');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Move products in this category to parent category or null
        if ($category->products->count() > 0) {
            foreach ($category->products as $product) {
                $product->update(['category_id' => $category->parent_id]);
            }
        }
        
        // Move child categories to parent
        if ($category->children->count() > 0) {
            foreach ($category->children as $child) {
                $child->update(['parent_id' => $category->parent_id]);
            }
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully');
    }
}