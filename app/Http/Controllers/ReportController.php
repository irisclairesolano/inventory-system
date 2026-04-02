<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Total number of products
        $totalProducts = Product::count();

        // Total stock value (price x quantity)
        $totalValue = Inventory::join('products', 'inventory.product_id', '=', 'products.id')
                        ->selectRaw('SUM(inventory.quantity * products.price) as total')
                        ->value('total') ?? 0;

        // Items with low stock
        $lowStockItems = Inventory::with('product')
                           ->whereRaw('quantity <= reorder_level')
                           ->get();

        // Stock count per category
        $stockByCategory = Category::with('products')->get();

        // Recent transactions (last 30 days)
        $recentTransactions = Transaction::with(['product', 'user'])
                               ->latest()
                               ->take(20)
                               ->get();

        return view('reports.index', compact(
            'totalProducts', 'totalValue', 'lowStockItems',
            'stockByCategory', 'recentTransactions'
        ));
    }
}
