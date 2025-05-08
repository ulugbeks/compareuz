<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10'
        ]);
        
        $product = Product::findOrFail($productId);
        
        // Create the review
        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $product->id;
        $review->shop_id = $product->shop_id;
        $review->rating = $request->rating;
        $review->content = $request->content;
        $review->status = 'pending'; // Reviews need approval
        $review->save();
        
        return redirect()->back()->with('success', 'Your review has been submitted and is pending approval.');
    }
    
    public function update(Request $request, $id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10'
        ]);
        
        $review->rating = $request->rating;
        $review->content = $request->content;
        $review->status = 'pending'; // Reset to pending when edited
        $review->save();
        
        return redirect()->back()->with('success', 'Your review has been updated and is pending approval.');
    }
    
    public function destroy($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $review->delete();
        
        return redirect()->back()->with('success', 'Your review has been deleted.');
    }
}