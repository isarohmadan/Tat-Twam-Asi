<?php

namespace App\Mail;

use App\Models\Kegiatan;
use App\Models\Kunjungan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengajuanBaruNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $tipe;

    // Konstruktor untuk menerima objek yang sesuai dan tipe
    public function __construct($data, $tipe)
    {
        $this->data = $data;
        $this->tipe = $tipe;
    }

    public function build()
    {
        // Tentukan subjek email
        $subject = $this->tipe == 'kegiatan' ? 'Pengajuan Kegiatan Baru Diterima' : 'Pengajuan Kunjungan Baru Diterima';

        // Tentukan view email yang berbeda berdasarkan tipe
        if ($this->tipe == 'kegiatan') {
            return $this->subject($subject)
                ->view('emails.kegiatan_baru')
                ->with([
                    'kegiatan' => $this->data,  // Jika tipe kegiatan
                ]);
        } else {
            return $this->subject($subject)
                ->view('emails.kunjungan_baru')
                ->with([
                    'kunjungan' => $this->data,  // Jika tipe kunjungan
                ]);
        }
    }
}
