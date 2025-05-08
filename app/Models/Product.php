<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'link',
        'price',
        'price_sale',
        'image',
        'manufacturer',
        'model',
        'category_id',
        'category_full',
        'category_link',
        'in_stock',
        'ean',
        'used',
        'delivery_cost',
        'delivery_days',
        'shop_id',
        'description'
    ];

    protected $casts = [
        'price' => 'float',
        'price_sale' => 'float',
        'in_stock' => 'integer',
        'used' => 'boolean',
        'delivery_cost' => 'float',
        'delivery_days' => 'integer'
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the shop that owns the product.
     */
    public function shop()
    {
        return $this->belongsTo(ShopProfile::class, 'shop_id');
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the actual price (sale price if available, otherwise regular price)
     */
    public function getActualPriceAttribute()
    {
        return $this->price_sale && $this->price_sale < $this->price 
            ? $this->price_sale 
            : $this->price;
    }

    /**
     * Check if the product has a discount
     */
    public function getHasDiscountAttribute()
    {
        return $this->price_sale && $this->price_sale < $this->price;
    }

    /**
     * Calculate discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->has_discount && $this->price > 0) {
            return round((($this->price - $this->price_sale) / $this->price) * 100);
        }
        
        return 0;
    }
    
    /**
     * Get similar products based on the EAN
     */
    public function getSimilarProductsAttribute()
    {
        if (empty($this->ean)) {
            return collect();
        }
        
        return Product::where('ean', $this->ean)
            ->where('id', '!=', $this->id)
            ->with('shop')
            ->get();
    }
}