
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik')->unique();
            $table->string('nama');
            $table->string('nama_orangtua');
            $table->date('tanggal_lahir');
            $table->string('asal')->nullable();
            $table->string('sekolah')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin
            $table->date('tanggal_masuk_panti')->nullable(); // Tanggal masuk panti
            $table->enum('keterangan', ['Yatim', 'Tidak Mampu', 'Piatu', 'Yatim Piatu']); // Keterangan
            $table->string('foto')->nullable(); // ✅ Tambahkan ini di sini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
