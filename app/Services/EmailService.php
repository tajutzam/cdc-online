<?php


namespace App\Services;

use App\Mail\EmailVeriviedMail;
use App\Mail\RecoveryPasswordMail;
use App\Mail\SubmissionsEmail;
use App\Mail\SuccessUpdatePasswordMail;
use Illuminate\Support\Facades\Mail;

class EmailService
{

    private EmailVeriviedMail $emailVeriviedMail;
    private SubmissionsEmail $submissionsEmail;
    private RecoveryPasswordMail $recoveryPasswordMail;
    private SuccessUpdatePasswordMail $successUpdatePasswordMail;

    public function __construct()
    {
        $this->emailVeriviedMail = new EmailVeriviedMail();
        $this->submissionsEmail = new SubmissionsEmail();
        $this->recoveryPasswordMail = new RecoveryPasswordMail();
        $this->successUpdatePasswordMail = new SuccessUpdatePasswordMail();
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

        Mail::to($to)->send($this->emailVeriviedMail);

    }


    public function sendEmailSubmissions($to, $message)
    {
        $details = [
            'title' => 'Pengajuan Alumni',
            'body' => $message,
        ];
        $this->submissionsEmail->details = $details;
        Mail::to($to)->send($this->submissionsEmail);

    }


    public function sendEmailRecovery($to, $link, $expired)
    {
        $data = [
            'url' => $link,
            'expired' => $expired
        ];
        $this->recoveryPasswordMail->data = $data;
        Mail::to($to)->send($this->recoveryPasswordMail);
    }

    public function sendEmailSuccessUpdatePassword($user){
        $this->successUpdatePasswordMail->user = $user;
        Mail::to($user->email)->send($this->successUpdatePasswordMail);
    }

}