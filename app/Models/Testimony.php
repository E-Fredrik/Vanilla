<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        "name",
        "content"
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    // public function getTestimonies() {
    //     return self::all();
    // }
}
