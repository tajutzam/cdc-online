<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Terjadi Kesalahan Internal Server</title>
    <style>
        /* CSS untuk mengatur tampilan halaman 500 */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            /* Mengatur kontainer di tengah horizontal */
            align-items: center;
            /* Mengatur kontainer di tengah vertikal */
            height: 100vh;
            /* Mengisi seluruh tinggi viewport */
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .error-code {
            font-size: 36px;
            font-weight: bold;
            color: #e74c3c;
            /* Warna merah */
        }

        .error-message {
            font-size: 24px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-code">500</div>
        <br>
        <div class="error-message">{{ $errors }}</div>
    </div>
</body>

</html>
