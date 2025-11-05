<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products', ['products' => $products]);
    }

    public function show($id) {
        $product = Product::find($id);
        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('detailProduct', ['product' => $product]);
    }


    public function home() {
        $featuredProduct = Product::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('home', ['featuredProducts' => $featuredProduct]);
    }
}
