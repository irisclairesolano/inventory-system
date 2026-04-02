<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .alert { background: #FFF3CD; padding: 15px; border-radius: 5px; }
        h2 { color: #C00000; }
    </style>
</head>
<body>
    <h2>⚠️ Low Stock Alert</h2>
    <div class="alert">
        <p><strong>Product:</strong> {{ $product->name }}</p>
        <p><strong>Current Stock:</strong> {{ $currentStock }} units</p>
        <p><strong>Reorder Level:</strong> {{ $reorderLevel }} units</p>
        <p>Please reorder this product immediately to avoid stockouts.</p>
    </div>
    <p style="color: #666; font-size: 12px;">This is an automated message from the Inventory Management System.</p>
</body>
</html>
