<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\User;

// Check and create sample data
if (Category::count() === 0) {
    // Create categories
    $cat1 = Category::firstOrCreate(
        ['name' => 'Electronics'],
        ['description' => 'Electronic devices and accessories']
    );
    $cat2 = Category::firstOrCreate(
        ['name' => 'Office Supplies'],
        ['description' => 'Office materials and stationery']
    );
    $cat3 = Category::firstOrCreate(
        ['name' => 'Furniture'],
        ['description' => 'Office and home furniture']
    );

    // Create suppliers
    $sup1 = Supplier::firstOrCreate(
        ['email' => 'sales@techdist.com'],
        ['name' => 'Tech Distributors Inc.', 'phone' => '555-0001', 'address' => '123 Tech Street']
    );
    $sup2 = Supplier::firstOrCreate(
        ['email' => 'contact@officeplus.com'],
        ['name' => 'Office Plus Co.', 'phone' => '555-0002', 'address' => '456 Office Ave']
    );
    $sup3 = Supplier::firstOrCreate(
        ['email' => 'info@furniture.com'],
        ['name' => 'Furniture World', 'phone' => '555-0003', 'address' => '789 Furniture Blvd']
    );

    // Create products
    $prod1 = Product::firstOrCreate(
        ['sku' => 'LAPTOP-001'],
        ['name' => 'Laptop Computer', 'category_id' => $cat1->id, 'supplier_id' => $sup1->id, 'price' => 999.99, 'description' => 'High-performance laptop']
    );
    $prod2 = Product::firstOrCreate(
        ['sku' => 'MON-4K-001'],
        ['name' => 'Monitor 4K', 'category_id' => $cat1->id, 'supplier_id' => $sup1->id, 'price' => 399.99, 'description' => '27-inch 4K monitor']
    );
    $prod3 = Product::firstOrCreate(
        ['sku' => 'MOUSE-001'],
        ['name' => 'Wireless Mouse', 'category_id' => $cat1->id, 'supplier_id' => $sup1->id, 'price' => 29.99, 'description' => 'Ergonomic wireless mouse']
    );
    $prod4 = Product::firstOrCreate(
        ['sku' => 'CHAIR-001'],
        ['name' => 'Office Desk Chair', 'category_id' => $cat3->id, 'supplier_id' => $sup3->id, 'price' => 249.99, 'description' => 'Ergonomic office chair']
    );
    $prod5 = Product::firstOrCreate(
        ['sku' => 'PAPER-001'],
        ['name' => 'A4 Paper Ream', 'category_id' => $cat2->id, 'supplier_id' => $sup2->id, 'price' => 9.99, 'description' => '500 sheets A4']
    );
    $prod6 = Product::firstOrCreate(
        ['sku' => 'PEN-001'],
        ['name' => 'Ballpoint Pens Box', 'category_id' => $cat2->id, 'supplier_id' => $sup2->id, 'price' => 12.99, 'description' => 'Box of 50 pens']
    );
    $prod7 = Product::firstOrCreate(
        ['sku' => 'DESK-001'],
        ['name' => 'Standing Desk', 'category_id' => $cat3->id, 'supplier_id' => $sup3->id, 'price' => 599.99, 'description' => 'Adjustable height desk']
    );
    $prod8 = Product::firstOrCreate(
        ['sku' => 'USB-HUB-001'],
        ['name' => 'USB Hub 7-Port', 'category_id' => $cat1->id, 'supplier_id' => $sup1->id, 'price' => 49.99, 'description' => '7-port USB 3.0']
    );

    // Create inventory records
    Inventory::firstOrCreate(
        ['product_id' => $prod1->id],
        ['quantity' => 5, 'reorder_level' => 3, 'location' => 'Warehouse A']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod2->id],
        ['quantity' => 12, 'reorder_level' => 5, 'location' => 'Warehouse A']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod3->id],
        ['quantity' => 2, 'reorder_level' => 10, 'location' => 'Warehouse B']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod4->id],
        ['quantity' => 7, 'reorder_level' => 4, 'location' => 'Warehouse C']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod5->id],
        ['quantity' => 25, 'reorder_level' => 15, 'location' => 'Warehouse A']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod6->id],
        ['quantity' => 18, 'reorder_level' => 10, 'location' => 'Warehouse B']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod7->id],
        ['quantity' => 3, 'reorder_level' => 2, 'location' => 'Warehouse C']
    );
    Inventory::firstOrCreate(
        ['product_id' => $prod8->id],
        ['quantity' => 8, 'reorder_level' => 5, 'location' => 'Warehouse A']
    );

    // Create transactions
    $admin = User::where('email', 'admin@inventory.com')->first();

    if ($admin && Transaction::count() === 0) {
        Transaction::create(['product_id' => $prod1->id, 'user_id' => $admin->id, 'type' => 'in', 'quantity' => 5, 'transaction_date' => now()->subDays(5), 'notes' => 'Initial stock']);
        Transaction::create(['product_id' => $prod5->id, 'user_id' => $admin->id, 'type' => 'out', 'quantity' => 10, 'transaction_date' => now()->subDays(3), 'notes' => 'Sold to customer']);
        Transaction::create(['product_id' => $prod2->id, 'user_id' => $admin->id, 'type' => 'in', 'quantity' => 12, 'transaction_date' => now()->subDays(2), 'notes' => 'Restocking']);
        Transaction::create(['product_id' => $prod3->id, 'user_id' => $admin->id, 'type' => 'out', 'quantity' => 1, 'transaction_date' => now()->subDay(), 'notes' => 'Customer purchase']);
        Transaction::create(['product_id' => $prod4->id, 'user_id' => $admin->id, 'type' => 'in', 'quantity' => 7, 'transaction_date' => now(), 'notes' => 'Supplier delivery']);
    }

    echo "✓ Sample data created successfully!\n";
    echo "✓ 3 Categories created\n";
    echo "✓ 3 Suppliers created\n";
    echo "✓ 8 Products created\n";
    echo "✓ 8 Inventory records created\n";
    echo "✓ 5 Transactions created\n";
} else {
    echo "✓ Sample data already exists in the database!\n";
}
