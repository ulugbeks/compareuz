<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'level',
        'description'
    ];

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all parent categories in a breadcrumb trail
     */
    public function getBreadcrumbAttribute()
    {
        $trail = collect([$this]);
        $parent = $this->parent;
        
        while ($parent) {
            $trail->prepend($parent);
            $parent = $parent->parent;
        }
        
        return $trail;
    }
}