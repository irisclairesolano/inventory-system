<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Category;
use App\Models\Product;

echo "Product count per category:\n";
foreach (Category::all() as $cat) {
    $count = Product::where('category_id', $cat->id)->count();
    echo "- " . $cat->name . ": " . $count . " products\n";
}
echo "\nTotal products: " . Product::count() . "\n";
