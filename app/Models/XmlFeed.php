<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XmlFeed extends Model
{
    protected $fillable = [
        'shop_id',
        'url',
        'last_processed',
        'is_active',
        'error_message',
        'products_count',
        'success_count',
        'error_count'
    ];

    protected $casts = [
        'last_processed' => 'datetime',
        'is_active' => 'boolean',
        'products_count' => 'integer',
        'success_count' => 'integer',
        'error_count' => 'integer'
    ];

    /**
     * Get the shop that owns the XML feed.
     */
    public function shop()
    {
        return $this->belongsTo(ShopProfile::class, 'shop_id');
    }
    
    /**
     * Get the products for this XML feed.
     */
    public function products()
    {
        return $this->hasDistanceThrough(Product::class, ShopProfile::class, 'id', 'shop_id', 'shop_id', 'id');
    }
    
    /**
     * Get the status of the feed
     */
    public function getStatusAttribute()
    {
        if (!$this->is_active) {
            return 'inactive';
        }
        
        if ($this->error_message) {
            return 'error';
        }
        
        if ($this->last_processed) {
            return 'processed';
        }
        
        return 'pending';
    }
}