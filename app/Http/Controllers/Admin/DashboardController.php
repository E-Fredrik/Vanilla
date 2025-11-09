<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
        ];

        $recentProducts = Product::with('categories')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentProducts'));
    }
}