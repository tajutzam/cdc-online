<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }

        h1 {
            color: #333;
            font-size: 24px;
        }

        p {
            color: #555;
            font-size: 16px;
        }

        a {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reset Password</h1>
        <p>Klik tautan di bawah ini untuk mereset kata sandi Anda:</p>
        <a href="{{ $data['url'] }}">Reset Password</a>
        <p>Tautan reset password akan kedaluwarsa pada tanggal {{ $data['expired'] }}.</p>
        <p>Jika Anda tidak meminta reset kata sandi, Anda bisa mengabaikan email ini dengan aman.</p>
        <p>Terima kasih,<br>{{ config('app.name') }}</p>
    </div>
    <p class="footer">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</body>

</html>
