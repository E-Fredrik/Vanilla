<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimony;

class HomeController extends Controller
{
    public function index()
    {
        // // Fetch products
        // $productModel = new Product();
        // $featuredProducts = $productModel->getLatestProducts();
        
        // // Fetch testimonies
        // $testimonyModel = new Testimony();
        // $testimonies = $testimonyModel->getTestimonies();
        
        return view('home', [
            'featuredProducts' => Product::orderBy('created_at', 'desc')
                ->limit(4)
                ->get(),
            'testimonies' => Testimony::all()
        ]);
    }
}