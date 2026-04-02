<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStockItems = Inventory::where('quantity', '<=', new \Illuminate\Database\Query\Expression('reorder_level'))->count();
        $recentTransactions = Transaction::with(['product', 'user'])->latest()->take(5)->get();

        return view('dashboard', compact('totalProducts', 'lowStockItems', 'recentTransactions'));
    }
}
