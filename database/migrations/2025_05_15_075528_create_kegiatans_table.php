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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengaju');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('judul_kegiatan');
            $table->text('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_instansi');
            $table->string('surat_pengajuan');
            $table->string('status_pengajuan')->default('menunggu');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
