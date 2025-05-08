<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'shop']);
        
        // Apply category filter
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        
        // Apply price filter
        if ($request->has('price')) {
            $priceRange = explode('-', $request->price);
            if (count($priceRange) == 2) {
                $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
            }
        }
        
        // Apply manufacturer filter
        if ($request->has('manufacturer')) {
            $query->where('manufacturer', $request->manufacturer);
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('price', 'asc');
            }
        } else {
            $query->orderBy('price', 'asc');
        }
        
        $products = $query->paginate(20);
        
        $categories = Category::all();
        $manufacturers = Product::distinct('manufacturer')->pluck('manufacturer');
        
        return view('products', compact('products', 'categories', 'manufacturers'));
    }
    
    public function search(Request $request)
    {
        $query = Product::with(['category', 'shop']);
        
        if ($request->filled('query')) {
            $searchTerm = $request->query;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('manufacturer', 'like', "%{$searchTerm}%")
                  ->orWhere('model', 'like', "%{$searchTerm}%");
            });
        }
        
        // Apply the same filters as the index method
        // [Similar filter code as in index method]
        
        $products = $query->paginate(20);
        
        return view('products', compact('products'));
    }
    
    public function show($id)
    {
        $product = Product::with(['category', 'shop'])->findOrFail($id);
        
        // Find other shops selling the same product (by EAN)
        $shopOffers = Product::where('ean', $product->ean)
            ->where('id', '!=', $product->id)
            ->with('shop')
            ->get();
        
        // Get product reviews
        $reviews = Review::where('product_id', $product->id)
            ->where('status', 'approved')
            ->with(['user', 'shop'])
            ->paginate(5);
        
        // Get related products
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
        return view('products.show', compact('product', 'shopOffers', 'reviews', 'relatedProducts'));
    }
}