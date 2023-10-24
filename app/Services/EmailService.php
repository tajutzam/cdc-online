<?php


namespace App\Services;

use App\Mail\EmailVeriviedMail;
use App\Mail\SubmissionsEmail;

class EmailService
{

    private EmailVeriviedMail $emailVeriviedMail;
    private SubmissionsEmail $submissionsEmail;

    public function __construct()
    {
        $this->emailVeriviedMail = new EmailVeriviedMail();
        $this->submissionsEmail = new SubmissionsEmail();
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


    public function sendEmailSubmissions($to, $message)
    {
        $details = [
            'title' => 'Pengajuan Alumni',
            'body' => $message,
        ];
        $this->submissionsEmail->details = $details;
        \Mail::to($to)->send($this->submissionsEmail);

    }

}