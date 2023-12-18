<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Approval Notification</title>
</head>

<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <div style="background-color: #f4f4f4; padding: 20px; text-align: center;">
        <h2 style="color: #333;">Partner Approval Notification</h2>
    </div>

    <div
        style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <p>Hello {{ $mitra->name }},</p>

        <p>Kami telah menerima pengajuan Anda untuk menjadi mitra kami. Setelah kami pelajari lebih lanjut, kami dengan
            berat hati harus menolak pengajuan Anda.</p>

        <p>Ada beberapa hal yang menjadi pertimbangan kami dalam menolak pengajuan Anda, yaitu:

            * {{ $alasan }}

            Kami memahami bahwa Anda telah berusaha untuk memenuhi persyaratan yang telah kami terapkan. Namun, kami
            percaya bahwa keputusan ini adalah yang terbaik untuk kedua belah pihak.</p>

        <p>Kami berterima kasih atas waktu dan perhatian Anda.</p>

        <p>Hormat kami,<br>CDC Polije</p>
    </div>

</body>

</html>
