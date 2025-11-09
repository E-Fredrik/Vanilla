<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimony;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'featuredProducts' => Product::with('categories')
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get(),
            'testimonies' => Testimony::approved()
                ->general()
                ->latest()
                ->get(),
            'products' => Product::orderBy('name')->get(), // For testimony form dropdown
        ]);
    }
}