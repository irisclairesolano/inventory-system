<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class ProductCategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed products in each category.
     */
    public function run(): void
    {
        // Ensure suppliers exist
        if (Supplier::count() === 0) {
            Supplier::create(['name' => 'Tech Distributors Inc.', 'email' => 'sales@techdist.com', 'phone' => '555-0001', 'address' => '123 Tech Street']);
            Supplier::create(['name' => 'Office Plus Co.', 'email' => 'contact@officeplus.com', 'phone' => '555-0002', 'address' => '456 Office Ave']);
            Supplier::create(['name' => 'Furniture World', 'email' => 'info@furniture.com', 'phone' => '555-0003', 'address' => '789 Furniture Blvd']);
        }

        // Ensure categories exist
        if (Category::count() === 0) {
            Category::create(['name' => 'Electronics', 'description' => 'Electronic devices and accessories']);
            Category::create(['name' => 'Office Supplies', 'description' => 'Office materials and stationery']);
            Category::create(['name' => 'Furniture', 'description' => 'Office and home furniture']);
        }

        $suppliers = Supplier::all();

        // Electronics Category
        $electronics = Category::where('name', 'Electronics')->first();
        if ($electronics) {
            $electronicsProducts = [
                ['name' => 'Laptop Dell XPS 13', 'sku' => 'DELL-XPS-13', 'price' => 75000],
                ['name' => 'HP Printer LaserJet Pro', 'sku' => 'HP-LJ-PRO-M404', 'price' => 18000],
                ['name' => 'USB-C Hub 7-in-1', 'sku' => 'USB-HUB-7IN1', 'price' => 3500],
                ['name' => 'Wireless Mouse Logitech', 'sku' => 'LOG-MOUSE-MX3', 'price' => 6500],
                ['name' => 'Mechanical Keyboard RGB', 'sku' => 'KEY-RGB-MECH', 'price' => 8500],
                ['name' => '4K Monitor LG 27"', 'sku' => 'LG-MON-27-4K', 'price' => 24000],
                ['name' => 'Portable SSD 1TB', 'sku' => 'SSD-PORT-1TB', 'price' => 8000],
                ['name' => 'HDMI Cable 2.1', 'sku' => 'HDMI-21-2M', 'price' => 1200],
            ];
            $this->seedProductsForCategory($electronics, $electronicsProducts, $suppliers);
        }

        // Office Supplies Category
        $officeSupplies = Category::where('name', 'Office Supplies')->first();
        if ($officeSupplies) {
            $suppliesProducts = [
                ['name' => 'A4 Paper Ream 500 Sheets', 'sku' => 'PAPER-A4-500', 'price' => 350],
                ['name' => 'Ink Cartridge Black HP', 'sku' => 'INK-HP-BK-XL', 'price' => 2200],
                ['name' => 'Sticky Notes 3x3 100 pack', 'sku' => 'STICKY-3X3-100', 'price' => 300],
                ['name' => 'Ballpoint Pen Set 50pcs', 'sku' => 'PEN-BALL-50', 'price' => 800],
                ['name' => 'File Folders Assorted 12 pack', 'sku' => 'FOLDERS-12', 'price' => 550],
                ['name' => 'Stapler Heavy Duty', 'sku' => 'STAPLER-HD', 'price' => 1400],
                ['name' => 'Tape Dispenser with Tape', 'sku' => 'TAPE-DISP', 'price' => 650],
                ['name' => 'Binder Clips Assorted 24pcs', 'sku' => 'CLIPS-24', 'price' => 450],
            ];
            $this->seedProductsForCategory($officeSupplies, $suppliesProducts, $suppliers);
        }

        // Furniture Category
        $furniture = Category::where('name', 'Furniture')->first();
        if ($furniture) {
            $furnitureProducts = [
                ['name' => 'Ergonomic Office Chair', 'sku' => 'CHAIR-ERGO-BLK', 'price' => 22000],
                ['name' => 'Standing Desk Electric', 'sku' => 'DESK-STAND-ELEC', 'price' => 32000],
                ['name' => 'Bookshelf 5-Tier', 'sku' => 'SHELF-5TIER-WHT', 'price' => 8500],
                ['name' => 'Conference Table 8-seater', 'sku' => 'TABLE-CONF-8', 'price' => 50000],
                ['name' => 'Storage Cabinet Metal', 'sku' => 'CAB-STOR-MTL', 'price' => 13000],
                ['name' => 'Executive Desk', 'sku' => 'DESK-EXEC-OAK', 'price' => 38000],
                ['name' => 'Meeting Chair Mesh', 'sku' => 'CHAIR-MESH-GRY', 'price' => 16000],
                ['name' => 'Desk Lamp LED', 'sku' => 'LAMP-LED-BLK', 'price' => 4000],
            ];
            $this->seedProductsForCategory($furniture, $furnitureProducts, $suppliers);
        }

        $this->command->info('✓ Successfully seeded 7+ products in each category!');
    }

    private function seedProductsForCategory(Category $category, array $products, Collection $suppliers): void
    {
        foreach ($products as $productData) {
            $product = Product::firstOrCreate(
                ['sku' => $productData['sku']],
                [
                    'name' => $productData['name'],
                    'category_id' => $category->id,
                    'supplier_id' => $suppliers->random()->id,
                    'price' => $productData['price'],
                    'description' => 'Product in ' . $category->name . ' category',
                ]
            );

            // Create inventory record if doesn't exist
            Inventory::firstOrCreate(
                ['product_id' => $product->id],
                [
                    'quantity' => rand(20, 100),
                    'reorder_level' => rand(5, 15),
                    'location' => 'Warehouse A',
                ]
            );
        }
    }
}
