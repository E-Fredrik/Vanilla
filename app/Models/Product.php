<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $ingredients;
    private $imagePath;

    protected $fillable = [
        'name',
        'price',
        'description',
        'ingredients',
        'imagePath'
    ];

    // public function getProducts() {
    //     return self::all();
    // }

    // public function getProductById($id) {
    //     return self::find($id);
    // }

    // public function getLatestProducts() {
    //     return self::orderBy('created_at', 'desc')
    //         ->limit(4)
    //         ->get();
    // }
}
