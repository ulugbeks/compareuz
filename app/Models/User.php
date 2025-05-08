<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Comment this out if you don't need API tokens

class User extends Authenticatable
{
    use HasFactory, Notifiable; // Remove HasApiTokens if not using Sanctum

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'first_name',
        'last_name',
        'description',
        'avatar',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shopProfile()
    {
        return $this->hasOne(ShopProfile::class);
    }
}