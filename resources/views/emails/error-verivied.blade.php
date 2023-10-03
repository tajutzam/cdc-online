<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Success</title>
    <style>
        /* Styling untuk tampilan email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Membuat kontainer email mengisi tinggi seluruh viewport */
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .error-message {
            color: #eb2828; /* Warna hijau untuk pesan sukses */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verification Failed</h1>
        <p class="error-message">{{$data}}</p>
    </div>
</body>
</html>
