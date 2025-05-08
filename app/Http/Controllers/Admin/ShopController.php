<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ShopProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ShopController extends Controller
{
    public function index()
    {
        $shops = User::where('role', 'shop')
                    ->with('shopProfile')
                    ->paginate(10);
                    
        return view('admin.shops.index', compact('shops'));
    }
    
    public function create()
    {
        return view('admin.shops.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'shop_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'public_number' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'xml_link' => 'nullable|url|max:255',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'shop',
        ]);
        
        ShopProfile::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'company_name' => $request->company_name,
            'registration_number' => $request->registration_number,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'public_number' => $request->public_number,
            'website' => $request->website,
            'xml_link' => $request->xml_link,
        ]);
        
        return redirect()->route('admin.shops.index')
                         ->with('success', 'Shop created successfully');
    }
    
    public function edit($id)
    {
        $shop = User::where('role', 'shop')
                   ->with('shopProfile')
                   ->findOrFail($id);
                   
        return view('admin.shops.edit', compact('shop'));
    }
    
    public function update(Request $request, $id)
    {
        $shop = User::where('role', 'shop')->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($shop->id),
            ],
            'shop_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'public_number' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'xml_link' => 'nullable|url|max:255',
        ]);
        
        $shop->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            
            $shop->update([
                'password' => Hash::make($request->password),
            ]);
        }
        
        if ($shop->shopProfile) {
            $shop->shopProfile->update([
                'shop_name' => $request->shop_name,
                'company_name' => $request->company_name,
                'registration_number' => $request->registration_number,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'public_number' => $request->public_number,
                'website' => $request->website,
                'xml_link' => $request->xml_link,
            ]);
        } else {
            ShopProfile::create([
                'user_id' => $shop->id,
                'shop_name' => $request->shop_name,
                'company_name' => $request->company_name,
                'registration_number' => $request->registration_number,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'public_number' => $request->public_number,
                'website' => $request->website,
                'xml_link' => $request->xml_link,
            ]);
        }
        
        return redirect()->route('admin.shops.index')
                         ->with('success', 'Shop updated successfully');
    }
    
    public function destroy($id)
    {
        $shop = User::where('role', 'shop')->findOrFail($id);
        $shop->delete();
        
        return redirect()->route('admin.shops.index')
                         ->with('success', 'Shop deleted successfully');
    }
}