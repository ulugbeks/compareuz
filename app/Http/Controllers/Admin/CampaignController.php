<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\ShopProfile;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('shop.user')->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }
    
    public function edit($id)
    {
        $campaign = Campaign::with('shop.user')->findOrFail($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }
    
    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,active,rejected,completed',
            'admin_notes' => 'nullable|string',
        ]);
        
        $campaign->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'approved_at' => $request->status == 'active' ? now() : $campaign->approved_at,
        ]);
        
        return redirect()->route('admin.campaigns.index')
                         ->with('success', 'Campaign updated successfully');
    }
    
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();
        
        return redirect()->route('admin.campaigns.index')
                         ->with('success', 'Campaign deleted successfully');
    }
}