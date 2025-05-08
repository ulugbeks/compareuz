<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ShopProfileController;

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/shop/balance/add', [App\Http\Controllers\ShopProfileController::class, 'addBalance'])->name('shop.balance.add')->middleware(['auth', 'user.type:shop']);
Route::post('/shop/reviews/{review}/reply', [App\Http\Controllers\ShopProfileController::class, 'replyToReview'])->name('shop.reviews.reply')->middleware(['auth', 'user.type:shop']);

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trending', [HomeController::class, 'trending'])->name('trending');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Registration route
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Authenticated user routes
Route::middleware(['auth', 'user.type:user'])->prefix('user')->group(function () {
    Route::get('/profile/reviews', [UserProfileController::class, 'reviews'])->name('user.profile.reviews');
    Route::get('/profile/info', [UserProfileController::class, 'info'])->name('user.profile.info');
    Route::get('/profile/alerts', [UserProfileController::class, 'alerts'])->name('user.profile.alerts');
    Route::get('/profile/accounts', [UserProfileController::class, 'accounts'])->name('user.profile.accounts');
    Route::get('/profile/email', [UserProfileController::class, 'email'])->name('user.profile.email');
    Route::get('/profile/password', [UserProfileController::class, 'password'])->name('user.profile.password');
    Route::get('/profile/bugs', [UserProfileController::class, 'bugs'])->name('user.profile.bugs');
    
    // POST routes for updating profile
    Route::post('/profile/info', [UserProfileController::class, 'updateInfo'])->name('user.profile.info.update');
    Route::post('/profile/alerts', [UserProfileController::class, 'updateAlerts'])->name('user.profile.alerts.update');
    Route::post('/profile/email', [UserProfileController::class, 'updateEmail'])->name('user.profile.email.update');
    Route::post('/profile/password', [UserProfileController::class, 'updatePassword'])->name('user.profile.password.update');
    Route::post('/profile/bugs', [UserProfileController::class, 'reportBug'])->name('user.profile.bugs.submit');

    Route::post('/products/{product}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('products.reviews.store');
    Route::put('/products/reviews/{review}', [App\Http\Controllers\ReviewController::class, 'update'])->name('products.reviews.update');
    Route::delete('/products/reviews/{review}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('products.reviews.destroy');
});

// Authenticated shop routes
Route::middleware(['auth', 'user.type:shop'])->prefix('shop')->group(function () {
    Route::get('/profile/reviews', [ShopProfileController::class, 'reviews'])->name('shop.profile.reviews');
    Route::get('/profile/campaigns', [ShopProfileController::class, 'campaigns'])->name('shop.profile.campaigns');
    Route::get('/profile/campaigns/banner', [ShopProfileController::class, 'campaignsBanner'])->name('shop.profile.campaigns.banner');
    Route::get('/profile/campaigns/elements', [ShopProfileController::class, 'campaignsElements'])->name('shop.profile.campaigns.elements');
    Route::get('/profile/history-pay', [ShopProfileController::class, 'historyPay'])->name('shop.profile.history-pay');
    Route::get('/profile/info', [ShopProfileController::class, 'info'])->name('shop.profile.info');
    Route::get('/profile/alert', [ShopProfileController::class, 'alert'])->name('shop.profile.alert');
    Route::get('/profile/email', [ShopProfileController::class, 'email'])->name('shop.profile.email');
    Route::get('/profile/password', [ShopProfileController::class, 'password'])->name('shop.profile.password');
    Route::get('/profile/bugs', [ShopProfileController::class, 'bugs'])->name('shop.profile.bugs');
    
    // POST routes for updating shop profile
    Route::post('/profile/info', [ShopProfileController::class, 'updateInfo'])->name('shop.profile.info.update');
    Route::post('/profile/alert', [ShopProfileController::class, 'updateAlert'])->name('shop.profile.alert.update');
    Route::post('/profile/email', [ShopProfileController::class, 'updateEmail'])->name('shop.profile.email.update');
    Route::post('/profile/password', [ShopProfileController::class, 'updatePassword'])->name('shop.profile.password.update');
    Route::post('/profile/bugs', [ShopProfileController::class, 'reportBug'])->name('shop.profile.bugs.submit');
    Route::post('/profile/campaigns/banner', [ShopProfileController::class, 'createBannerCampaign'])->name('shop.profile.campaigns.banner.create');
    Route::post('/profile/campaigns/elements', [ShopProfileController::class, 'createElementsCampaign'])->name('shop.profile.campaigns.elements.create');
});

// Admin Routes
Route::middleware(['auth', 'user.type:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Users
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    
    // Shops
    Route::resource('shops', App\Http\Controllers\Admin\ShopController::class);
    
    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    
    // Products
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    
    // XML Feeds
    Route::resource('xml-feeds', App\Http\Controllers\Admin\XmlFeedController::class);
    Route::post('xml-feeds/{id}/process', [App\Http\Controllers\Admin\XmlFeedController::class, 'process'])->name('xml-feeds.process');
    
    // Campaigns
    Route::resource('campaigns', App\Http\Controllers\Admin\CampaignController::class)->except(['create', 'store']);
    
    // Reviews
    Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class)->except(['create', 'store']);
    
    // Bug Reports
    Route::resource('bugs', App\Http\Controllers\Admin\BugController::class)->except(['create', 'store']);
    
    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
