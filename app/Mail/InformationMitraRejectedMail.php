<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformationMitraRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mitra;

    private $alasan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mitra, $alasan)
    {
        //
        $this->mitra = $mitra;
        $this->alasan = $alasan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mitra-information-rejected', ['mitra' => $this->mitra, 'alasan' => $this->alasan]);
    }
}
