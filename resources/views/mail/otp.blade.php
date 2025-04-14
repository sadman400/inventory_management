<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            margin: 20px 0;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Verification Code</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            <p>Use the following One-Time Password ({{ $otp }}) to complete your verification process:</p>
            <p class="otp-code">123456</p> <!-- Replace with your dynamic OTP -->
            <p>This OTP is valid for the next 10 minutes. Please do not share it with anyone.</p>
        </div>
        <div class="footer">
            <p>If you did not request this, please ignore this email.</p>
        </div>
    </div>
</body>
</html>
