<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('categories')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'ingredients' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Store in storage/app/public/images
            $path = $request->file('image')->store('images', 'public');
            $validated['imagePath'] = $path;
        }

        $product = Product::create($validated);
        
        // Attach categories
        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $product->load('categories');
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'ingredients' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->imagePath && Storage::disk('public')->exists($product->imagePath)) {
                Storage::disk('public')->delete($product->imagePath);
            }

            // Store new image
            $path = $request->file('image')->store('images', 'public');
            $validated['imagePath'] = $path;
        }

        $product->update($validated);
        
        // Sync categories
        $product->categories()->sync($request->categories);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->imagePath && Storage::disk('public')->exists($product->imagePath)) {
            Storage::disk('public')->delete($product->imagePath);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
