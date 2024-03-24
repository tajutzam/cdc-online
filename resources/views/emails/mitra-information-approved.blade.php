<!-- resources/views/emails/partner_approval_email.blade.php -->

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

    <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <p>Hello {{ $mitra->name }},</p>

        <p>Permintaan Pengajuan Informasi Atau Lowongan Disetujui Oleh Admin</p>


        <p>Terimakasih Atas Pengajuan Anda :). Jika ada pertanyaan, silahkan contact kami yaa.</p>

        <p>Hormat kami,<br>CDC Polije</p>
    </div>

</body>
</html>
