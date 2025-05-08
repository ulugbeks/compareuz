<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\ShopProfile;
use App\Models\Bug;
use App\Models\Campaign;
use App\Models\Payment;
use App\Models\Review;
use App\Models\XmlFeed;
use Carbon\Carbon;

class ShopProfileController extends Controller
{
    public function reviews()
    {
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        if (!$shop) {
            return redirect()->route('shop.profile.info')
                ->with('error', 'Please complete your shop profile first');
        }
        
        $reviews = Review::where('shop_id', $shop->id)
            ->with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('shop.profile.shop-profile-reviews', compact('reviews'));
    }

    public function campaigns()
    {
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        // Calculate how many clicks you can get with the current balance
        $bannerCost = 0.00005; // cost per click for banner
        $elementsCost = 0.18; // cost per click for elements
        
        $bannerClicks = $shop && $shop->balance > 0 ? floor($shop->balance / $bannerCost) : 0;
        $highlightClicks = $shop && $shop->balance > 0 ? floor($shop->balance / $elementsCost) : 0;
        
        return view('shop.profile.shop-profile-campaigns', compact('bannerClicks', 'highlightClicks'));
    }

    public function campaignsBanner()
    {
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        $bannerCost = 0.00005; // cost per click for banner
        $bannerClicks = $shop && $shop->balance > 0 ? floor($shop->balance / $bannerCost) : 0;
        
        return view('shop.profile.shop-profile-campaigns-banner', compact('bannerClicks'));
    }

    public function campaignsElements()
    {
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        $elementsCost = 0.18; // cost per click for elements
        $elementsClicks = $shop && $shop->balance > 0 ? floor($shop->balance / $elementsCost) : 0;
        
        return view('shop.profile.shop-profile-campaigns-elements', compact('elementsClicks'));
    }

    public function historyPay()
    {
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        if ($shop) {
            $payments = $shop->payments()->orderBy('created_at', 'desc')->paginate(10);
            return view('shop.profile.shop-profile-history-pay', compact('payments'));
        }
        
        return redirect()->route('shop.profile.campaigns')
                ->with('error', 'Shop profile not found.');
    }

    public function info()
    {
        $shopProfile = ShopProfile::where('user_id', Auth::id())->first();
        
        $workingHours = [];
        $paymentMethods = [];
        
        if ($shopProfile) {
            if ($shopProfile->working_hours) {
                $workingHours = is_string($shopProfile->working_hours) 
                    ? json_decode($shopProfile->working_hours, true) 
                    : $shopProfile->working_hours;
            }
            
            if ($shopProfile->payment_methods) {
                $paymentMethods = is_string($shopProfile->payment_methods) 
                    ? json_decode($shopProfile->payment_methods, true) 
                    : $shopProfile->payment_methods;
            }
        }
        
        return view('shop.profile.shop-profile-info', compact('shopProfile', 'workingHours', 'paymentMethods'));
    }

    public function alert()
    {
        $shopProfile = ShopProfile::where('user_id', Auth::id())->first();
        return view('shop.profile.shop-profile-alert', compact('shopProfile'));
    }

    public function email()
    {
        return view('shop.profile.shop-profile-email');
    }

    public function password()
    {
        return view('shop.profile.shop-profile-password');
    }

    public function bugs()
    {
        return view('shop.profile.shop-profile-bugs');
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'public_number' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'xml_link' => 'nullable|url|max:255',
        ]);

        $shopProfile = ShopProfile::where('user_id', Auth::id())->first();
        if (!$shopProfile) {
            $shopProfile = new ShopProfile();
            $shopProfile->user_id = Auth::id();
        }

        $shopProfile->shop_name = $request->shop_name;
        $shopProfile->company_name = $request->company_name;
        $shopProfile->registration_number = $request->registration_number;
        $shopProfile->address = $request->address;
        $shopProfile->contact_number = $request->contact_number;
        $shopProfile->public_number = $request->public_number;
        $shopProfile->website = $request->website;
        $shopProfile->xml_link = $request->xml_link;
        
        // Handle payment methods
        $paymentMethods = [];
        if ($request->has('payment_cash')) $paymentMethods[] = 'cash';
        if ($request->has('payment_card')) $paymentMethods[] = 'card';
        if ($request->has('payment_transfer')) $paymentMethods[] = 'transfer';
        if ($request->has('payment_leasing')) $paymentMethods[] = 'leasing';
        $shopProfile->payment_methods = json_encode($paymentMethods);
        
        $shopProfile->payment_description = $request->payment_description;
        $shopProfile->delivery_description = $request->delivery_description;
        
        // Handle working hours
        $workingHours = [
            'monday' => ['from' => $request->monday_from, 'to' => $request->monday_to],
            'tuesday' => ['from' => $request->tuesday_from, 'to' => $request->tuesday_to],
            'wednesday' => ['from' => $request->wednesday_from, 'to' => $request->wednesday_to],
            'thursday' => ['from' => $request->thursday_from, 'to' => $request->thursday_to],
            'friday' => ['from' => $request->friday_from, 'to' => $request->friday_to],
            'saturday' => ['from' => $request->saturday_from, 'to' => $request->saturday_to],
            'sunday' => ['from' => $request->sunday_from, 'to' => $request->sunday_to],
        ];
        $shopProfile->working_hours = json_encode($workingHours);
        
        if ($request->hasFile('banner')) {
            if ($shopProfile->banner && Storage::disk('public')->exists(str_replace('storage/', '', $shopProfile->banner))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $shopProfile->banner));
            }
            $path = $request->file('banner')->store('banners', 'public');
            $shopProfile->banner = 'storage/' . $path;
        }
        
        $shopProfile->save();
        
        // Create/update XML feed if provided
        if ($request->xml_link) {
            $xmlFeed = XmlFeed::where('shop_id', $shopProfile->id)->first();
            if (!$xmlFeed) {
                XmlFeed::create([
                    'shop_id' => $shopProfile->id,
                    'url' => $request->xml_link,
                    'is_active' => true
                ]);
            } else {
                $xmlFeed->url = $request->xml_link;
                $xmlFeed->save();
            }
        }
        
        return redirect()->back()->with('success', 'Shop profile updated successfully');
    }
    
    public function updateAlert(Request $request)
    {
        $shopProfile = ShopProfile::where('user_id', Auth::id())->first();
        if (!$shopProfile) {
            return redirect()->route('shop.profile.info')
                ->with('error', 'Please complete your shop profile first');
        }
        
        $shopProfile->news_email = $request->has('news_email');
        $shopProfile->review_notifications = $request->has('review_notifications');
        $shopProfile->campaign_notifications = $request->has('campaign_notifications');
        $shopProfile->save();
        
        return redirect()->back()->with('success', 'Notification settings updated successfully');
    }
    
    public function updateEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        
        $user->email = $request->new_email;
        $user->save();
        
        return redirect()->back()->with('success', 'Email address updated successfully');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->back()->with('success', 'Password updated successfully');
    }
    
    public function reportBug(Request $request)
    {
        $request->validate([
            'description' => 'required|string'
        ]);
        
        Bug::create([
            'user_id' => Auth::id(),
            'content' => $request->description,
            'status' => 'new'
        ]);
        
        return redirect()->back()->with('success', 'Bug report submitted successfully. Thank you for helping us improve!');
    }
    
    public function createBannerCampaign(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'campaign_name' => 'required|string|max:255',
            'campaign_link' => 'required|url',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'notes' => 'nullable|string'
        ]);
        
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        if (!$shop) {
            return redirect()->route('shop.profile.info')
                ->with('error', 'Please complete your shop profile first');
        }
        
        // Handle banner image upload
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('campaigns/banners', 'public');
        }
        
        // Create campaign
        Campaign::create([
            'shop_id' => $shop->id,
            'name' => $request->campaign_name,
            'type' => 'banner',
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
            'status' => 'pending',
            'banner_image' => $bannerPath ? 'storage/' . $bannerPath : null,
            'target_url' => $request->campaign_link,
            'cost_per_click' => 0.00005,
            'notes' => $request->notes
        ]);
        
        return redirect()->route('shop.profile.campaigns')
                ->with('success', 'Banner campaign submitted successfully and is awaiting approval.');
    }
    
    public function createElementsCampaign(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string'
        ]);
        
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        if (!$shop) {
            return redirect()->route('shop.profile.info')
                ->with('error', 'Please complete your shop profile first');
        }
        
        // Create campaign
        Campaign::create([
            'shop_id' => $shop->id,
            'name' => 'Highlight Elements Campaign - ' . now()->format('Y-m-d'),
            'type' => 'elements',
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
            'status' => 'pending',
            'cost_per_click' => 0.18,
            'notes' => $request->notes
        ]);
        
        return redirect()->route('shop.profile.campaigns')
                ->with('success', 'Elements highlight campaign submitted successfully and is awaiting approval.');
    }
    
    public function addBalance(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string'
        ]);
        
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        if (!$shop) {
            return redirect()->route('shop.profile.info')
                ->with('error', 'Please complete your shop profile first');
        }
        
        // Create a payment record
        $payment = Payment::create([
            'shop_id' => $shop->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'invoice_number' => 'INV-' . time()
        ]);
        
        // Update shop balance
        $shop->balance += $request->amount;
        $shop->save();
        
        return redirect()->route('shop.profile.history-pay')
            ->with('success', 'Balance added successfully. New balance: $' . number_format($shop->balance, 2));
    }
    
    public function replyToReview(Request $request, $reviewId)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);
        
        $shop = ShopProfile::where('user_id', Auth::id())->first();
        
        if (!$shop) {
            return redirect()->back()->with('error', 'Shop profile not found');
        }
        
        $review = Review::where('id', $reviewId)
            ->where('shop_id', $shop->id)
            ->first();
            
        if (!$review) {
            return redirect()->back()->with('error', 'Review not found');
        }
        
        $review->shop_reply = $request->reply;
        $review->reply_date = now();
        $review->save();
        
        return redirect()->back()->with('success', 'Reply added successfully');
    }
}