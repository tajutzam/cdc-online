<!DOCTYPE html>
<html>

<head>
    <title>Berhasil Memperbarui Kata Sandi</title>
</head>

<body>
    <h1>Berhasil Memperbarui Kata Sandi</h1>
    <p>Halo {{ $user->fullname }},</p>
    <p>Kami ingin memberi tahu Anda bahwa kata sandi akun Anda telah berhasil diperbarui. Ini adalah konfirmasi bahwa
        perubahan kata sandi Anda telah sukses dilakukan.</p>
    <p>Jika Anda merasa bahwa ini bukan tindakan Anda, atau jika Anda merasa ada masalah dengan akun Anda, segera
        hubungi dukungan kami.</p>
    <p>Terima kasih telah menggunakan layanan kami.</p>
    <p>Salam,<br>{{ config('app.name') }}</p>
</body>

</html>
