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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengaju');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('tujuan_kunjungan');
            $table->date('tanggal_kunjungan');
            $table->string('instansi');
            $table->date('tanggal_pengajuan')->default(now());
            $table->string('status')->default('menunggu');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kunjungans');
    }
};
