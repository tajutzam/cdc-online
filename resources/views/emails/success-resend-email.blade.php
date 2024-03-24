<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .success-icon {
            color: #4CAF50;
            font-size: 48px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333333;
        }

        p {
            color: #666666;
            font-size: 16px;
        }

        .go-home-link {
            color: #ffffff;
            background-color: #4CAF50;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
    <title>Email Verification Success</title>
</head>

<body>
    <div class="success-container">
        <div class="success-icon">&#10003;</div>
        <h2>Link Verifikasi Berhasil Dikirim</h2>
        <p>Silahkan Periksa Email Anda untuk melakukan aktivasi akun</p>
        <a href="{{ route('/') }}" class="go-home-link">Kembali Ke Home</a>
    </div>
</body>

</html>
