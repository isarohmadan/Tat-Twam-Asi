<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'gambar',
        'tanggal_publikasi'
    ];

   protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('tanggal_publikasi', '<=', now());
    }
}
