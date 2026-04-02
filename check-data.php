<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Inventory;

echo "Database Data Check:\n";
echo "Total Products: " . Product::count() . "\n";
echo "Total Inventories: " . Inventory::count() . "\n";
echo "Total Transactions: " . Transaction::count() . "\n";
echo "Low Stock Items: " . Inventory::whereRaw('quantity <= reorder_level')->count() . "\n";
