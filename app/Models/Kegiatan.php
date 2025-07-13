<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengaju',
        'alamat',
        'no_telepon',
        'judul_kegiatan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_instansi',
        'surat_pengajuan',
        'status_pengajuan',
        'user_id',
        'catatan',
        'alasan_penolakan',
        'status_pembatalan',
        'alasan_pembatalan'
        
    ];
    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'status_pengajuan' => 'menunggu'
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
