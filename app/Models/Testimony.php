<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'content',
        'status',
    ];

    /**
     * Get the product this testimony belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope to get only approved testimonies.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get general testimonies (not tied to products).
     */
    public function scopeGeneral($query)
    {
        return $query->whereNull('product_id');
    }
}
