<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ShopProfile;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\XmlFeed;
use App\Models\Category;
use App\Models\Review;
use App\Models\Bug;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for dashboard cards
        $usersCount = User::where('role', 'user')->count();
        $shopsCount = User::where('role', 'shop')->count();
        $productsCount = Product::count();
        $campaignsCount = Campaign::count();
        $categoriesCount = Category::count();
        $reviewsCount = Review::count();
        $pendingReviewsCount = Review::where('status', 'pending')->count();
        $bugsCount = Bug::where('status', 'new')->count();
        
        // Get latest users
        $latestUsers = User::latest()->take(5)->get();
        
        // Get latest XML imports
        $latestImports = XmlFeed::with('shop.user')
                              ->latest('updated_at')
                              ->take(5)
                              ->get();
        
        // Get latest reviews
        $latestReviews = Review::with(['user', 'product', 'shop'])
                             ->latest()
                             ->take(5)
                             ->get();
        
        // Get pending campaigns
        $pendingCampaigns = Campaign::with('shop')
                                  ->where('status', 'pending')
                                  ->latest()
                                  ->take(5)
                                  ->get();
        
        return view('admin.dashboard', compact(
            'usersCount',
            'shopsCount',
            'productsCount',
            'campaignsCount',
            'categoriesCount',
            'reviewsCount',
            'pendingReviewsCount',
            'bugsCount',
            'latestUsers',
            'latestImports',
            'latestReviews',
            'pendingCampaigns'
        ));
    }
}