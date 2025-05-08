<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'shop_id',
        'amount',
        'payment_method',
        'status',
        'invoice_number',
        'description'
    ];

    /**
     * Get the shop that the payment belongs to.
     */
    public function shop()
    {
        return $this->belongsTo(ShopProfile::class, 'shop_id');
    }
}