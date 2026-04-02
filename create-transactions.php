<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

$products = Product::all();
$user = User::where('role', 'admin')->first();

if (!$user) {
    echo "❌ No admin user found!\n";
    exit;
}

echo "Creating sample transactions...\n";

$types = ['in', 'out'];
$dates = [];
for ($i = 0; $i < 15; $i++) {
    $dates[] = Carbon::now()->subDays($i);
}

$count = 0;
foreach ($products->random(10) as $product) {
    foreach (array_slice($dates, 0, rand(1, 3)) as $date) {
        Transaction::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'type' => $types[array_rand($types)],
            'quantity' => rand(1, 10),
            'notes' => 'Sample transaction',
            'transaction_date' => $date,
        ]);
        $count++;
    }
}

echo "✓ Created $count sample transactions!\n";
echo "Dashboard now has data to display.\n";
