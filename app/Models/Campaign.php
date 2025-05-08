<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'type',
        'shop_id',
        'start_date',
        'end_date',
        'status',
        'banner_image',
        'target_url',
        'budget',
        'cost_per_click',
        'impressions',
        'clicks',
        'admin_notes',
        'notes',
        'approved_at'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'approved_at' => 'datetime'
    ];

    /**
     * Get the shop that owns the campaign.
     */
    public function shop()
    {
        return $this->belongsTo(ShopProfile::class, 'shop_id');
    }

    /**
     * Scope a query to only include active campaigns.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('start_date', '<=', now())
                     ->where(function($query) {
                         $query->where('end_date', '>=', now())
                               ->orWhereNull('end_date');
                     });
    }

    /**
     * Scope a query to only include banner campaigns.
     */
    public function scopeBanner($query)
    {
        return $query->where('type', 'banner');
    }

    /**
     * Scope a query to only include element campaigns.
     */
    public function scopeElements($query)
    {
        return $query->where('type', 'elements');
    }
}