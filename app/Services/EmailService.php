<?php


namespace App\Services;

use App\Mail\EmailVeriviedMail;

class EmailService
{

    private EmailVeriviedMail $emailVeriviedMail;

    public function __construct()
    {
        $this->emailVeriviedMail = new EmailVeriviedMail();
    }

    public function sendEmailVerifikasi($to, $link, $expired)
    {

        $details = [
            'title' => 'Verifikasi Email',
            'body' => 'Selamat , akun mu sudah terdaftar silahkan Verifikasi akun sebelum login',
            'link' => $link,
            'expire' => $expired
        ];


        $this->emailVeriviedMail->details = $details;

        \Mail::to($to)->send($this->emailVeriviedMail);

    }


}