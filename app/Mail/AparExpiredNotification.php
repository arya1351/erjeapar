<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AparExpiredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $apar;

    public function __construct($apar) {
        $this->apar = $apar;
    }

    public function build() {
        return $this->subject('Notifikasi Kedaluwarsa APAR')
                    ->view('email.apar_expired')
                    ->with([
                        'jenis' => $this->apar->jenis,
                        'merek' => $this->apar->merek,
                        'no_apar' => $this->apar->no_apar,
                        'gedung' => $this->apar->gedungs->nama_gedung,
                        'tanggal_exp' => $this->apar->tanggal_exp,
                    ]);
    }
}
