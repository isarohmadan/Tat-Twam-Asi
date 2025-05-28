<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan');
            $table->text('isi');
            $table->string('gambar');
            $table->date('tanggal_publikasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beritas');
    }
};
