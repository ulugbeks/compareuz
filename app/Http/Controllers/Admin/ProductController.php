<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'shop'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    
    public function create()
    {
        $categories = Category::all();
        $shops = ShopProfile::all();
        return view('admin.products.create', compact('categories', 'shops'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'image' => 'nullable|url',
            'manufacturer' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'in_stock' => 'nullable|integer|min:0',
            'ean' => 'nullable|string|max:255',
            'used' => 'nullable|boolean',
            'shop_id' => 'required|exists:shop_profiles,id',
            'description' => 'nullable|string',
        ]);
        
        Product::create($request->all());
        
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully');
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $shops = ShopProfile::all();
        return view('admin.products.edit', compact('product', 'categories', 'shops'));
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0',
            'image' => 'nullable|url',
            'manufacturer' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'in_stock' => 'nullable|integer|min:0',
            'ean' => 'nullable|string|max:255',
            'used' => 'nullable|boolean',
            'shop_id' => 'required|exists:shop_profiles,id',
            'description' => 'nullable|string',
        ]);
        
        $product->update($request->all());
        
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully');
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully');
    }
}