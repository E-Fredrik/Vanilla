<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'ingredients',
        'imagePath'
    ];

    /**
     * Get the categories for this product.
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the testimonies for this product.
     */
    public function testimonies() {
        return $this->hasMany(Testimony::class);
    }
}
