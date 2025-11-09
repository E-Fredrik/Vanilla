<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('ingredients', 'like', '%' . $searchTerm . '%');
            });
        }

        // Category filter
        $selectedCategory = $request->get('category', 'all');
        if ($selectedCategory && $selectedCategory !== 'all') {
            $query->whereHas('categories', function ($q) use ($selectedCategory) {
                $q->where('categories.id', $selectedCategory);
            });
        }

        // Get view mode (default to grid)
        $viewMode = $request->get('view', 'grid');
        
        // Dynamic pagination based on view mode
        $perPage = $viewMode === 'list' ? 5 : 6;
        
        $products = $query->paginate($perPage)->appends([
            'search' => $request->search,
            'category' => $selectedCategory,
            'view' => $viewMode
        ]);

        // Get categories with product count
        $categories = Category::withCount('products')->get();

        return view('products', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchTerm' => $request->search ?? '',
            'viewMode' => $viewMode
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('detailProduct', ['product' => $product]);
    }

    public function home()
    {
        $featuredProduct = Product::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('home', ['featuredProducts' => $featuredProduct]);
    }
}
