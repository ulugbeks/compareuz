<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProfile extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'company_name',
        'registration_number',
        'address',
        'contact_number',
        'public_number',
        'website',
        'xml_link',
        'payment_methods',
        'payment_description',
        'delivery_description',
        'working_hours',
        'balance',
        'banner',
        'news_email',
        'review_notifications',
        'campaign_notifications'
    ];

    protected $casts = [
        'payment_methods' => 'array',
        'working_hours' => 'array',
        'news_email' => 'boolean',
        'review_notifications' => 'boolean',
        'campaign_notifications' => 'boolean'
    ];

    /**
     * Get the user that owns the shop profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the XML feeds for the shop.
     */
    public function xmlFeeds()
    {
        return $this->hasMany(XmlFeed::class, 'shop_id');
    }

    /**
     * Get the campaigns for the shop.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'shop_id');
    }

    /**
     * Get the products for the shop.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }

    /**
     * Get the payments for the shop.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'shop_id');
    }
}