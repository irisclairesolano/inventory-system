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
        .alert-box { 
            background-color: #D3968C; 
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
        .security-icon { font-size: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 Inventory Management System</h1>
            <h2>Security Notification</h2>
        </div>

        <div class="alert-box">
            <div class="security-icon">🔐</div>
            <h3>Password Changed Successfully</h3>
            <p>Your password has been updated in our system.</p>
        </div>

        <div class="info-box">
            <p><strong>Account Details:</strong></p>
            <p>👤 User: <span class="highlight">{{ $user->name }}</span></p>
            <p>📧 Email: <span class="highlight">{{ $user->email }}</span></p>
            <p>🕐 Time: <span class="highlight">{{ $timestamp }}</span></p>
        </div>

        <div class="info-box">
            <p><strong>🔒 Security Notice:</strong></p>
            <p>If you didn't change your password, please:</p>
            <ul>
                <li>Contact your administrator immediately</li>
                <li>Reset your password again</li>
                <li>Check your account for any unusual activity</li>
            </ul>
        </div>

        <div class="info-box">
            <p><strong>💡 Security Tips:</strong></p>
            <ul>
                <li>Use a strong, unique password</li>
                <li>Don't share your password with anyone</li>
                <li>Change your password regularly</li>
                <li>Always log out when you're done</li>
            </ul>
        </div>

        <div class="footer">
            <p>This is an automated security message from the Inventory Management System.</p>
            <p>If you have questions, please contact your administrator.</p>
            <p>© {{ date('Y') }} Inventory Management System</p>
        </div>
    </div>
</body>
</html>
