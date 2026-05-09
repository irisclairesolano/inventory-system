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
        .welcome-box { 
            background-color: #839958; 
            color: #F7F4D5; 
            padding: 20px; 
            border-radius: 5px; 
            margin: 20px 0; 
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Inventory Management System</h1>
            <h2>Welcome Aboard!</h2>
        </div>

        <div class="welcome-box">
            <h3>Hello {{ $user->name }}!</h3>
            <p>Welcome to the Inventory Management System. Your account has been successfully created.</p>
        </div>

        <div class="info-box">
            <p><strong>Your Account Details:</strong></p>
            <p>📧 Email: <span class="highlight">{{ $user->email }}</span></p>
            <p>👤 Role: <span class="highlight">{{ ucfirst($user->role) }}</span></p>
            <p>🔐 Status: <span class="highlight">Active</span></p>
        </div>

        <div class="info-box">
            <p><strong>What's Next?</strong></p>
            @if($user->role === 'admin')
                <p>As an <strong>Administrator</strong>, you can:</p>
                <ul>
                    <li>📊 View the dashboard and reports</li>
                    <li>📦 Manage products and categories</li>
                    <li>🏭 Handle suppliers and inventory</li>
                    <li>👥 Manage user accounts</li>
                </ul>
            @else
                <p>As a <strong>Staff Member</strong>, you can:</p>
                <ul>
                    <li>📊 View the dashboard</li>
                    <li>📦 Browse products</li>
                    <li>📋 Check inventory levels</li>
                    <li>👤 Update your profile</li>
                </ul>
            @endif
        </div>

        <div class="info-box">
            <p><strong>🚀 Quick Start:</strong></p>
            <p>1. Visit your dashboard at: <a href="{{ config('app.url') }}/dashboard">{{ config('app.url') }}/dashboard</a></p>
            <p>2. Login with your email and password</p>
            <p>3. Explore the features available to your role</p>
        </div>

        <div class="footer">
            <p>This is an automated message from the Inventory Management System.</p>
            <p>If you didn't create this account, please contact your administrator.</p>
            <p>© {{ date('Y') }} Inventory Management System</p>
        </div>
    </div>
</body>
</html>
