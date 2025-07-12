<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengajuanDisetujui extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $kegiatan; // Atau $kunjungan, tergantung yang disetujui
    public $catatan;

    public function __construct($user, $kegiatan = null, $kunjungan = null, $catatan = null)
    {
        $this->user = $user;
        $this->kegiatan = $kegiatan;
        $this->kunjungan = $kunjungan;
        $this->catatan = $catatan;
    }

    public function build()
    {
        return $this->subject('Pengajuan Anda Telah Disetujui')
            ->view('emails.pengajuan_disetujui')
            ->with([
                'user' => $this->user,
                'kegiatan' => $this->kegiatan,
                'kunjungan' => $this->kunjungan,
                'catatan' => $this->catatan,
            ]);
    }
}
