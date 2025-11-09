<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        Log::info('Category store attempt', ['data' => $request->all()]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string|max:500',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            $category = Category::create($validated);
            
            Log::info('Category created', ['category_id' => $category->id]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully.');
                
        } catch (\Exception $e) {
            Log::error('Category creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->withErrors(['error' => 'Failed to create category: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $category->loadCount('products');
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        Log::info('Category update attempt', ['category_id' => $category->id, 'data' => $request->all()]);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'description' => 'nullable|string|max:500',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            $category->update($validated);
            
            Log::info('Category updated', ['category_id' => $category->id]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category updated successfully.');
                
        } catch (\Exception $e) {
            Log::error('Category update failed', [
                'category_id' => $category->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->withErrors(['error' => 'Failed to update category: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Detach all products from this category instead of blocking deletion
        $category->products()->detach();

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully. Products have been uncategorized.');
    }
}