<?php

use App\Http\Controllers\{
    ProfileController,
    ProductController,
    CategoryController,
    SupplierController,
    InventoryController,
    DashboardController,
    ReportController,
    TransactionController
};

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/dashboard'));

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Users
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile page
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    // Edit page
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Products (read-only for non-admin)
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

    // Inventory (read-only)
    Route::get('/inventory', [InventoryController::class, 'index'])
        ->name('inventory.index');
});

/*
|--------------------------------------------------------------------------
| Admin Only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Full CRUD access via resource routes (clean + complete)
    Route::resource('products', ProductController::class)->except([
        'index', 'show', 'create'
    ]);

    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('inventory', InventoryController::class)->except(['index']);
    Route::resource('transactions', TransactionController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
});

require __DIR__.'/auth.php';