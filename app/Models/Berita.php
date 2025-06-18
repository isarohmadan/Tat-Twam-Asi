<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'tanggal_publikasi'
    ];

    protected $dates = [
        'tanggal_publikasi',
        'created_at',
        'updated_at'
    ];

    public function images()
    {
        return $this->hasMany(BeritaImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(BeritaImage::class)->where('is_featured', true);
    }
}

