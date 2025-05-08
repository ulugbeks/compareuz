<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\XmlFeed;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class XmlFeedController extends Controller
{
    public function index()
    {
        $xmlFeeds = XmlFeed::with('shop.user')->paginate(10);
        return view('admin.xml-feeds.index', compact('xmlFeeds'));
    }
    
    public function create()
    {
        $shops = ShopProfile::all();
        return view('admin.xml-feeds.create', compact('shops'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shop_profiles,id',
            'url' => 'required|url',
            'is_active' => 'boolean',
        ]);
        
        XmlFeed::create([
            'shop_id' => $request->shop_id,
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
        ]);
        
        return redirect()->route('admin.xml-feeds.index')
                         ->with('success', 'XML Feed created successfully');
    }
    
    public function edit($id)
    {
        $xmlFeed = XmlFeed::findOrFail($id);
        $shops = ShopProfile::all();
        return view('admin.xml-feeds.edit', compact('xmlFeed', 'shops'));
    }
    
    public function update(Request $request, $id)
    {
        $xmlFeed = XmlFeed::findOrFail($id);
        
        $request->validate([
            'shop_id' => 'required|exists:shop_profiles,id',
            'url' => 'required|url',
            'is_active' => 'boolean',
        ]);
        
        $xmlFeed->update([
            'shop_id' => $request->shop_id,
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
        ]);
        
        return redirect()->route('admin.xml-feeds.index')
                         ->with('success', 'XML Feed updated successfully');
    }
    
    public function destroy($id)
    {
        $xmlFeed = XmlFeed::findOrFail($id);
        $xmlFeed->delete();
        
        return redirect()->route('admin.xml-feeds.index')
                         ->with('success', 'XML Feed deleted successfully');
    }
    
    public function process($id)
    {
        $xmlFeed = XmlFeed::findOrFail($id);
        
        // Process the feed manually
        try {
            Artisan::call('import:xml-feeds', ['feed_id' => $id]);
            return redirect()->route('admin.xml-feeds.index')
                            ->with('success', 'XML Feed processed successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.xml-feeds.index')
                            ->with('error', 'Error processing XML Feed: ' . $e->getMessage());
        }
    }
}