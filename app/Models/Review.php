<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'shop_id',
        'rating',
        'content',
        'status',
        'admin_notes',
        'shop_reply',
        'reply_date'
    ];

    protected $casts = [
        'rating' => 'integer',
        'reply_date' => 'datetime'
    ];

    /**
     * Get the user that wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product being reviewed.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the shop being reviewed.
     */
    public function shop()
    {
        return $this->belongsTo(ShopProfile::class, 'shop_id');
    }
}