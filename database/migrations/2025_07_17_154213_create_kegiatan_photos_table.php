<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('kegiatan_photos', function (Blueprint $table) {
        $table->id(); // Primary key auto increment
        $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade'); // Relasi dengan tabel kegiatan
        $table->string('judul')->nullable();
        $table->text('deskripsi')->nullable();
        $table->string('photo_path');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_photos');
    }
};
