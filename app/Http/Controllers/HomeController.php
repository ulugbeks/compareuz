<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // For now we'll use dummy data; later we'll fetch from database
        $trendingProducts = []; 
        
        return view('home', compact('trendingProducts'));
    }
    
    public function trending()
    {
        return view('trending');
    }
    
    public function privacy()
    {
        return view('pages.privacy');
    }
    
    public function terms()
    {
        return view('pages.terms');
    }
}