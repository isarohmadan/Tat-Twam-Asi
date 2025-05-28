<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungans';

    protected $fillable = [
        'nama_pengaju',
        'alamat',
        'no_hp',
        'tujuan_kunjungan',
        'tanggal_kunjungan',
        'instansi',
        'tanggal_pengajuan',
        'status',
        'user_id',
        'catatan',
        'alasan_penolakan'
    ];
    protected $attributes = [
        'status' => 'menunggu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
