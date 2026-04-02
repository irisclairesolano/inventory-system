<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes accessible to ALL authenticated users
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // View-only routes for staff and admin
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
});

// Routes for ADMIN only
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Product CRUD
    Route::resource('products', ProductController::class)->except(['index', 'show']);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);

    // Inventory management
    Route::resource('inventory', InventoryController::class)->except(['index']);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
