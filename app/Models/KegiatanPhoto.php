<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanPhoto extends Model
{

    protected $fillable = [
        'kegiatan_id',
        'judul',
        'deskripsi',
        'photo_path'
    ];

    // Relasi ke tabel kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
