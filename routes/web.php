<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/about', function() {
    return view('aboutUs');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');

// Public testimony submission
Route::post('/testimonies', [TestimonyController::class, 'store'])->name('testimonies.store');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Product CRUD Routes
    Route::resource('admin/products', AdminProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    
    // Admin Category CRUD Routes
    Route::resource('admin/categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    // Admin Testimony Management
    Route::prefix('admin/testimonies')->name('admin.testimonies.')->group(function () {
        Route::get('/', [TestimonyController::class, 'index'])->name('index');
        Route::post('/{testimony}/approve', [TestimonyController::class, 'approve'])->name('approve');
        Route::post('/{testimony}/reject', [TestimonyController::class, 'reject'])->name('reject');
        Route::delete('/{testimony}', [TestimonyController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';