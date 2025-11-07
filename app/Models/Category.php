<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the products that belong to this category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
