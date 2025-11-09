<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        Log::info('Product store attempt', ['data' => $request->except('image')]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'ingredients' => 'nullable|string',
                'categories' => 'required|array|min:1',
                'categories.*' => 'exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validated['imagePath'] = $path;
                Log::info('Image uploaded', ['path' => $path]);
            }

            $product = Product::create($validated);
            
            // Attach categories
            $product->categories()->attach($request->categories);
            
            Log::info('Product created', ['product_id' => $product->id]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully.');
                
        } catch (\Exception $e) {
            Log::error('Product creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $product->load('categories');
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        Log::info('Product update attempt', ['product_id' => $product->id, 'data' => $request->except('image')]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'ingredients' => 'nullable|string',
                'categories' => 'required|array|min:1',
                'categories.*' => 'exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            if ($request->hasFile('image')) {
                if ($product->imagePath && Storage::disk('public')->exists($product->imagePath)) {
                    Storage::disk('public')->delete($product->imagePath);
                    Log::info('Old image deleted', ['path' => $product->imagePath]);
                }

                $path = $request->file('image')->store('images', 'public');
                $validated['imagePath'] = $path;
                Log::info('New image uploaded', ['path' => $path]);
            }

            $product->update($validated);
            
            // Sync categories
            $product->categories()->sync($request->categories);
            
            Log::info('Product updated', ['product_id' => $product->id]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully.');
                
        } catch (\Exception $e) {
            Log::error('Product update failed', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->withErrors(['error' => 'Failed to update product: ' . $e->getMessage()]);
        }
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

        // Detach all categories before deletion
        $product->categories()->detach();
        
        // Delete the product
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
