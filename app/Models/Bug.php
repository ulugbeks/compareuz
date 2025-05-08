<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'status',
        'admin_notes'
    ];

    /**
     * Get the user that reported the bug.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}