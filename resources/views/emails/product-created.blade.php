<!DOCTYPE html>
<html>
<head>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #0A3323; 
            color: #F7F4D5; 
            margin: 0; 
            padding: 20px; 
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #F7F4D5; 
            color: #0A3323; 
            padding: 30px; 
            border-radius: 10px; 
            border: 2px solid #839958; 
        }
        .header { 
            text-align: center; 
            color: #105666; 
            border-bottom: 2px solid #D3968C; 
            padding-bottom: 20px; 
            margin-bottom: 20px; 
        }
        .success-box { 
            background-color: #839958; 
            color: #F7F4D5; 
            padding: 20px; 
            border-radius: 5px; 
            margin: 20px 0; 
            text-align: center;
        }
        .info-box { 
            background-color: #E8E6C8; 
            padding: 15px; 
            border-radius: 5px; 
            margin: 10px 0; 
        }
        .footer { 
            text-align: center; 
            margin-top: 30px; 
            font-size: 12px; 
            color: #839958; 
        }
        h1 { color: #105666; }
        .highlight { color: #D3968C; font-weight: bold; }
        .product-icon { font-size: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Inventory Management System</h1>
            <h2>Product Management</h2>
        </div>

        <div class="success-box">
            <div class="product-icon">✅</div>
            <h3>New Product Added Successfully!</h3>
            <p>A new product has been added to the inventory system.</p>
        </div>

        <div class="info-box">
            <p><strong>📦 Product Details:</strong></p>
            <p>🏷️ Name: <span class="highlight">{{ $product->name }}</span></p>
            @if($product->sku)
                <p>🔖 SKU: <span class="highlight">{{ $product->sku }}</span></p>
            @endif
            @if($product->category)
                <p>📂 Category: <span class="highlight">{{ $product->category->name }}</span></p>
            @endif
            @if($product->supplier)
                <p>🏭 Supplier: <span class="highlight">{{ $product->supplier->name }}</span></p>
            @endif
            <p>💰 Price: <span class="highlight">${{ number_format($product->price, 2) }}</span></p>
            @if($product->description)
                <p>📝 Description: {{ $product->description }}</p>
            @endif
        </div>

        <div class="info-box">
            <p><strong>👤 Added By:</strong></p>
            <p>Name: <span class="highlight">{{ $user->name }}</span></p>
            <p>Email: <span class="highlight">{{ $user->email }}</span></p>
            <p>Role: <span class="highlight">{{ ucfirst($user->role) }}</span></p>
            <p>Date: <span class="highlight">{{ now()->format('Y-m-d H:i') }}</span></p>
        </div>

        <div class="info-box">
            <p><strong>🔗 Quick Actions:</strong></p>
            <p>You can:</p>
            <ul>
                <li>View the product details</li>
                <li>Update product information</li>
                <li>Set inventory levels</li>
                <li>Add product images</li>
            </ul>
        </div>

        <div class="footer">
            <p>This is an automated notification from the Inventory Management System.</p>
            <p>If you have questions about this product, please contact {{ $user->email }}.</p>
            <p>© {{ date('Y') }} Inventory Management System</p>
        </div>
    </div>
</body>
</html>
