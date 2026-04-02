<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $cat1 = Category::create(['name' => 'Electronics', 'description' => 'Electronic devices']);
        $cat2 = Category::create(['name' => 'Office Supplies', 'description' => 'Office materials']);

        // Create suppliers
        $sup1 = Supplier::create(['name' => 'Tech Distributors Inc.', 'email' => 'sales@techdist.com', 'phone' => '555-0001']);
        $sup2 = Supplier::create(['name' => 'Office Plus Co.', 'email' => 'contact@officeplus.com', 'phone' => '555-0002']);

        // Create products
        $prod1 = Product::create(['name' => 'Laptop', 'category_id' => $cat1->id, 'supplier_id' => $sup1->id, 'price' => 999.99, 'sku' => 'LAPTOP-001']);
        $prod2 = Product::create(['name' => 'Monitor', 'category_id' => $cat1->id, 'supplier_id' => $sup1->id, 'price' => 299.99, 'sku' => 'MON-001']);
        $prod3 = Product::create(['name' => 'Desk Chair', 'category_id' => $cat2->id, 'supplier_id' => $sup2->id, 'price' => 199.99, 'sku' => 'CHAIR-001']);

        // Create inventory records
        Inventory::create(['product_id' => $prod1->id, 'quantity' => 5, 'reorder_level' => 10]);
        Inventory::create(['product_id' => $prod2->id, 'quantity' => 15, 'reorder_level' => 5]);
        Inventory::create(['product_id' => $prod3->id, 'quantity' => 3, 'reorder_level' => 8]);
    }
}
