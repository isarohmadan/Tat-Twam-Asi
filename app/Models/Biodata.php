<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'nik',
        'nama',
        'nama_orangtua',
        'tanggal_lahir',
        'asal',
        'sekolah',
        'foto',
        'jenis_kelamin', // Jenis kelamin
        'tanggal_masuk_panti', // Tanggal masuk panti
        'keterangan', // Keterangan
    ];
}
